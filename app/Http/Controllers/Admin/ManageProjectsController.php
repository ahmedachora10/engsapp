<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminBaseController;
use App\Http\Controllers\Controller;
use App\Mail\NewProject;
use App\Models\ChatMessagesModel;
use App\Models\ServiceRequests;
use App\Models\UserServices;
use App\Models\WebsiteContentModel;
use App\Models\WebsiteLinksModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Yajra\DataTables\Facades\DataTables;

class ManageProjectsController extends AdminBaseController
{
    //
    public function request_view(Request $request, $requestId)
    {

        $request = ServiceRequests::withCount('offers')
            ->with('service_request_owner', function ($query) {
                $query->withAvg('rates', 'rating_value');
            })
            ->with('offers', function ($query) {
                $query->with(['offer_attachments', 'operator', 'offer_status']);
            })
            ->withCount('offers')
            ->with('attachments', 'service', 'service_stage', 'requested_services', 'operator_offer')
            ->find($requestId);

        if ($request == null)
            return abort(404);

        $chatMessages = ChatMessagesModel::where('request_id', $request->id)
            ->with(['sender', 'attachments'])
            ->get();
        // $request = $request->load('accpeted_offer');
        // dd($chatMessages);

//        return new NewProject($request);
        return view('admin.requests.viewRequest', [
            'request' => $request,
            'chatMessages' => $chatMessages
        ]);
    }

    public function confirm_request( $requestId,Request $request)
    {


        $requestObj = ServiceRequests::find($requestId);

        if ($requestObj == null)
            return abort(404);

        if(request('action_type') == 'accept'){
            $requestObj->service_request_stage_id=Config::get('constants.request_stages.waiting_offers');
            $requestObj->save();
            $us=UserServices::whereIn('service_category_id',$requestObj->requested_services()->pluck('id'))->get();
            $name='مشروع جديد';
            if($requestObj->service_id == 4){
                $name='طلب زيارة';
            }
            if($requestObj->service_id == 2){
                $name='خدمة هندسية';
            }
            $links=WebsiteLinksModel::first();
            $contactus_email=$links->contactus_email;
            foreach ($us as $uu){
                if($uu->user){

                    \Mail::to($uu->user)->cc($contactus_email)->send(new NewProject($requestObj,$name));
                }
            }
        }elseif(request('action_type') == 'edit'){

            $requestObj->title=$request->title;
            $requestObj->expected_period=$request->expected_period;
            $requestObj->deadline_date=Carbon::parse($request->deadline_date)->toDateString();
            $requestObj->budget_min=$request->budget_min;
            $requestObj->budget_max=$request->budget_max;
            $requestObj->description=$request->description;
            $requestObj->save();

        }else{
            $requestObj->service_request_stage_id=Config::get('constants.request_stages.canceled');
            $requestObj->save();
        }

        return back();
    }


    public function request_delete(Request $request)
    {
        $job = ServiceRequests::where('id', $request->only('requestId'))
            ->first();
        $job->delete();

        return response()->json([
            'status' => true,
        ]);
    }


    public function request_list(Request $request)
    {

        if ($request->isMethod('post')) {
            $requests = ServiceRequests::has('service_request_owner')->with('service_request_owner', 'service', 'service_stage')
                ->select('requests.id', 'requests.service_id', 'requests.user_id', 'requests.service_request_stage_id', 'requests.title', 'requests.deadline_date', 'requests.created_at')
                ->withCount('offers');
            // dd($requests);
            return DataTables::of($requests)
                ->editColumn('created_at', function ($request) {
                    return $request->created_at ? with(new Carbon($request->created_at))->format('Y-m-d') : '';
                })
                ->editColumn('deadline_date', function ($request) {
                    return $request->deadline_date ? with(new Carbon($request->deadline_date))->format('Y-m-d') : '';
                })
                ->editColumn('service_request_owner.profile_img', function ($request) {
                    $profileImg = asset('adminAssets/assets/media/users/blank.png');
                    if ($request->service_request_owner->profile_img != null) {
                        $profileImg = route('imagecache', ['template' => 'profile', 'filename' => $request->service_request_owner->profile_img]);
                    }
                    return  $profileImg;
                })
                ->addColumn('serviceOwnerUrl', function ($request) {
                    $url = route('admin.user.overview', ['userId' => $request->service_request_owner->id]);
                    return $url;
                })
                ->addColumn('viewRequestUrl', function ($request) {
                    $url = route('admin.request.view', ['requestId' => $request->id]);
                    return $url;
                })
                ->addColumn('action', function ($request) {
                    $viewBtn = '<a href="' . route('admin.request.view', ['requestId' => $request->id]) . '" id="btnView_' . $request->id . '" class="btn btn-sm btn-clean btn-icon"  title="عرض"><i class="la la-eye"></i></a>';
                    $removeBtn = '<a href="#" class="btn btn-sm btn-clean btn-icon removeBtn" data-id="' . $request->id . '" title="حذف"><i class="la la-trash"></i></a>';
                    return $viewBtn . $removeBtn;
                })
                ->make();
        } else if ($request->isMethod('get')) {
            return view('admin.requests.requestsList');
        }
    }
}
