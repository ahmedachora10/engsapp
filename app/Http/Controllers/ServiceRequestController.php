<?php

namespace App\Http\Controllers;

use App\Mail\NewProject;
use App\Models\ChatAttachmentsModel;
use App\Models\ChatMessagesModel;
use App\Models\OffersModel;
use App\Models\ServiceRequests;
use App\Models\WebsitePercModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ServiceRequestController extends Controller
{
    //

    public function ensureUserCanSeeRequest($requestUser, $serviceRequestingUserId)
    {
        return $requestUser->getUserType() == 'user' ? $requestUser->id == $serviceRequestingUserId :  true;
    }


    public function ensureOperatorCanSeeRequest($currentRequestUser, $operatorOfferUser)
    {
        if ($currentRequestUser->user_type == 'company' || $currentRequestUser->user_type == 'freelancer') {
            return $operatorOfferUser->id == $currentRequestUser->id ? true : false;
        }
        return true;
    }

    public function viewRequest(Request $request, ServiceRequests $service_request)
    {
        if (!$this->ensureUserCanSeeRequest($request->user(), $service_request->user_id)) {
            return redirect()->route('auth.login');
        }
        // DB::enableQueryLog();
        // $newChatMessages = $request
        // ->user()
        // ->unreadChatMsgs()
        // ->limit(3)
        // ->get();
        // dd($newChatMessages);

        $executingOrRequestedUserProfile = null;
        $unreadMessagesCount = 0;
        $chatMessages = null;
        $offerRejected = null;
        $offerApplied = null;
        $website_per = WebsitePercModel::select('percentage')->first();

        if ($request->user()->user_type != 'user') {
            if ($service_request->service_request_stage_id == 1 || $service_request->service_request_stage_id == 2) {
                $offerApplied = OffersModel::where('request_id', $service_request->id)
                    ->where('user_id', $request->user()->id)->first();
            }
        }

        if ($service_request->service_request_stage_id >= 3 && $service_request->service_request_stage_id != 6) {

            $executingOrRequestedUserProfile = $service_request->accpeted_offer()->operator;
            // dd($service_request->accpeted_offer(), $request->user()->id);
            if (!$this->ensureOperatorCanSeeRequest($request->user(), $executingOrRequestedUserProfile)) {
                // return redirect()->route('auth.login');
                $offerRejected = true;
            }
            if ($request->user()->user_type == 'company' || $request->user()->user_type == 'freelancer') {
                $executingOrRequestedUserProfile = $service_request->service_request_owner;
            }
            // dd(DB::getQueryLog());

            $unreadMessagesCount = $request->user()
                ->chatMsgs()
                // ->with('sender')
                ->where('isread', false)
                ->where('request_id', $service_request->id)
                ->count();
            $chatMessages = ChatMessagesModel::where('request_id', $service_request->id)
                ->with(['sender', 'attachments'])
                ->get();
            // sleep(1);

            ChatMessagesModel::where('request_id', $service_request->id)
                ->where('recipient_user_id', $request->user()->id)
                ->where('isread', false)->update(['isread' => true]);

            $chatMessages = view('services_request.request_chat_item', ['chatMsgs' => $chatMessages])->render();
            // return response()->json([
            //     'status' => true,
            //     'messages' => $chatMessages,
            // ]);
        }

        // dd(DB::getQueryLog());
        // }
        // dd($executingOrRequestedUserProfile);

        return view('services_request.viewRequest', [
            'service_request' => $service_request,
            'userProfile' => $executingOrRequestedUserProfile,
            'unreadMessagesCount' => $unreadMessagesCount,
            'chatMessages' => $chatMessages,
            'offerRejected' => $offerRejected,
            'percentage' => $website_per->percentage,
            'offerApplied' => $offerApplied,
        ]);
    }

    public function viewOffer(Request $request, ServiceRequests $service_request, OffersModel $offer)
    {
        if (!$this->ensureUserCanSeeRequest($request->user(), $service_request->user_id)) {
            return redirect()->route('auth.login');
        }
        if ($offer->request_id != $service_request->id) {
            return abort(404);
        }

        return view('services_request.viewOffer', ['service_request' => $service_request, 'offer' => $offer]);
    }
    public function chat_msgs(Request $request, ServiceRequests $service_request)
    {

        $chatMessages = ChatMessagesModel::where('request_id', $service_request->id)
            ->with(['sender', 'attachments'])
            ->get();
        // sleep(1);

        ChatMessagesModel::where('request_id', $service_request->id)
            ->where('recipient_user_id', $request->user()->id)
            ->where('isread', false)->update(['isread' => true]);

        $chatMessages = view('services_request.request_chat_item', ['chatMsgs' => $chatMessages])->render();
        return response()->json([
            'status' => true,
            'messages' => $chatMessages,
        ]);
    }

    public function send_chat_msg(Request $request, ServiceRequests $service_request, OffersModel $offer)
    {
        // sleep(1);
        // dd($request->all());
        $request->validate([
            'message' => 'string|nullable',
            'chat_attachment' => 'nullable|mimes:jpg,doc,docx,pdf,dwg,png',
        ]);

        $message = new ChatMessagesModel();
        $message->sender_user_id = $request->user()->id;
        $message->recipient_user_id =
            $service_request->service_request_owner->id == $request->user()->id
            ? $offer->user_id
            : $service_request->service_request_owner->id;
        $message->request_id = $service_request->id;
        $message->message = $request->message;
        $message->isread = false;
        $message->save();

        if ($request->chat_attachment) {
            $chat_attachment = new ChatAttachmentsModel();
            $request->chat_attachment->store('request_files');
            $filename = $request->chat_attachment->getClientOriginalName();
            $hashName = $request->chat_attachment->hashName();
            $chat_attachment->message_id = $message->id;
            $chat_attachment->filename = $filename;
            $chat_attachment->hashName = $hashName;
            $chat_attachment->save();
        }

        // $message->load(['sender', 'recipient', 'attachments']);

        return response()->json([
            'status' => true,
            'message' => __('form.messages.chat_sent'),
            // 'messageData' => $message
        ]);
    }


    public function delete_unused_request()
    {
        $requests=ServiceRequests::with('service_stage')->doesntHave('offers')->where('service_request_stage_id',1)->where('deadline_date','<',Carbon::now()->subDay()->toDateString())->get();

        foreach ($requests as $re){
            $re->service_request_stage_id=6;
            $re->save();
        }
        return ;
    }
}
