<?php

namespace App\Http\Controllers;

use App\Mail\NewProject;
use App\Models\BankModel;
use App\Models\Country;
use App\Models\OffersModel;
use App\Models\serviceCategories;
use App\Models\ServiceRequests;
use App\Models\User;
use App\Models\UserPortfolio;
use App\Models\UserRatingModel;
use App\Models\UserServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends FrontBaseController
{
    //

    public function index()
    {

        if (Auth::check()) {
            // The user is logged in...
            return redirect()->route('user.userDashboard');
        }

        return view('auth.login');
    }


    public function login(Request $request)
    {

        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        $user=User::where('user_type',$request->user_type)->where('email',$request->email)->first();
        if($user){

            if(Hash::check($request->password,$user->password)){
                if ($user->confirmed == false) {
                    return redirect()->route('auth.login')->with('warning', 'الحساب غير مفعل، يرجى التواصل مع إدارة الموقع');
                }
                Auth::login($user, true);
                if ($user->user_type == 'user')
                    return redirect()->intended(route('user.userDashboard'));
                else
                    return redirect()->intended(route('operator.explore'));
            } else
                return redirect()->route('auth.login')->with('warning', __('form.messages.wrong_credentials'));

        } else
            return redirect()->route('auth.login')->with('warning', __('form.messages.wrong_credentials'));


    }


    public function userDashboard(Request $request)
    {
        $totalRequests = DB::table('requests')
            ->selectRaw('count(*) as total')
            ->selectRaw("count(case when service_request_stage_id = '1' then 1 end) as Waiting")
            ->selectRaw("count(case when service_request_stage_id = '2' then 1 end) as Accepting")
            ->selectRaw("count(case when service_request_stage_id = '3' then 1 end) as Implementation")
            ->selectRaw("count(case when service_request_stage_id = '4' then 1 end) as Delivering")
            ->selectRaw("count(case when service_request_stage_id = '5' then 1 end) as Completed")
            ->selectRaw("count(case when service_request_stage_id = '6' then 1 end) as Canceled")
            ->where('user_id', $request->user()->id)
            ->first();

        $LatestRequests = ServiceRequests::with('service')
            ->withCount('offers')
            ->where('user_id', $request->user()->id)
            ->orderBy('created_at', 'DESC')
            ->limit(9)
            ->get();
        // dd($request->user()->calculate_profile());

        return view('user.userDashboard', [
            'totalRequests' => $totalRequests,
            'latestRequests' => $LatestRequests
        ]);
    }

    public function allUserChatMsgs(Request $request)
    {
        $messages =  $request->user()->chatMsgs()
            ->with('sender')
            ->orderByDesc('created_at')
            ->get();

        $messages = view('general.chat_message_navbar_item', ['ChatMessages' => $messages])->render();
        return response()->json([
            'status' => true,
            'messages' => $messages,
        ]);
    }

    public function allNotifications(Request $request)
    {
        $notifications = view('general.notification_navbar_item', ['notifications' => $request->user()->notifications])->render();

        return response()->json([
            'status' => true,
            'notifications' =>  $notifications,
        ]);
    }

    public function unreadNotifications(Request $request)
    {

        $notifications = view('general.notification_navbar_item', ['notifications' => $request->user()->unreadNotifications])->render();
        $unreadNotifications = $request->user()->unreadNotifications;
        $unreadNotifications->markAsRead();

        return response()->json([
            'status' => true,
            'notifications' =>  $notifications,
        ]);
    }

    public function userProfile(Request $request)
    {
        return view('user.profile.index');
    }


    public function service_index(Request $request, $serviceName)
    {
        // $serivceName = $request->route()->hasParameter('serviceName');
        // dd($serivceName);
        $service = "";
        $serviceRequestBtnText = "";
        $requestsList = [];
        $serviceRequestRoute = route('user.request.project');
        if ($serviceName == "project") {
            $service = "تنفيذ مشروع / استشارة";
            $serviceRequestRoute = route('user.request.project');
            $serviceRequestBtnText = "اضافة مشروع";
            // $requestsList = ServiceRequests::with(['service_stage', 'service', 'attachments', 'requested_services'])->get();
            $requestsList = ServiceRequests::with(['service_stage', 'requested_services'])
                ->withCount('offers')
                ->where('user_id', $request->user()->id)
                ->where('service_id', Config::get('constants.services.project'))
                ->orderBy('created_at', 'DESC')
                ->get();
        } else if ($serviceName == "consult") {
            $service = "خدمات المكاتب الهندسية";
            $serviceRequestRoute = route('user.request.consult');
            $serviceRequestBtnText = "اضافة طلب";
            $requestsList = ServiceRequests::with(['service_stage', 'requested_services'])
                ->where('user_id', $request->user()->id)
                ->withCount('offers')
                ->where('service_id', Config::get('constants.services.consult'))
                ->orderBy('created_at', 'DESC')
                ->get();
        } else if ($serviceName == "visit") {
            $service = "زيارة موقع";
            $serviceRequestRoute = route('user.request.visit');
            $serviceRequestBtnText = "اضافة طلب";
            $requestsList = ServiceRequests::with(['service_stage', 'requested_services'])
                ->where('user_id', $request->user()->id)
                ->withCount('offers')
                ->where('service_id', Config::get('constants.services.visit'))
                ->orderBy('created_at', 'DESC')
                ->get();
        }

        return view('user.serviceIndex', [
            'serviceName' => $serviceName,
            'serviceText' => $service,
            'btnText' => $serviceRequestBtnText,
            'requestsList' => $requestsList,
            'serviceRequestRoute' => $serviceRequestRoute
        ]);
    }


    public function service_request_judge(Request $request)
    {
        $serviceName = "judge";
        $service = "الدليل الهندسي";
        $services = new serviceCategories();
        $service_id = Config::get('constants.services.judge');
        return view('user.serviceRequests.judge', [
            'serviceName' => $serviceName,
            'serviceText' => $service,
            'service_id' => $service_id,
            'services' => $services->getServicesCategroiesByTypeId($service_id)
        ]);
    }



    public function service_request_licence(Request $request)
    {
        $serviceName = "licence";
        $service = "طلب شهادة ترخيص";
        $services = new serviceCategories();
        $service_id = Config::get('constants.services.licence');
        $servicesList = $services->getServicesCategroiesByTypeIdAndParent($service_id, null);
        $subServicesList = [];
        foreach ($servicesList as $value) {
            $serviceParentId = $value->id;
            // dd($value->name);
            $subServicesList[] = [
                'serviceParentId' => $serviceParentId,
                'subservices' => $services->getServicesCategroiesByTypeIdAndParent($service_id, $serviceParentId)
            ];
        }

        return view('user.serviceRequests.licence', [
            'serviceName' => $serviceName,
            'serviceText' => $service,
            'services' => $servicesList,
            'subservices' => $subServicesList,
            'service_id' => $service_id
        ]);
    }

    public function get_licence_services(Request $request)
    {
        if ($request->isMethod('post')) {
            $serviceParentId = $request->only('projectType');
            $services = new serviceCategories();
            $services = $services->getServicesCategroiesByTypeIdAndParent(Config::get('constants.services.licence'), $serviceParentId);

            return view('user.serviceRequests.checklist_template', ['services' => $services]);
        }
    }

    public function requestingAproject(Request $request, $serviceId, $serviceName, $serviceText)
    {
        $request->validate([
            'selectedservices' => 'array|min:1|required',
            'title' => 'required',
            'expectedDate' => 'required',
            'budgetMin' => 'required',
            'budgetMax' => 'required',
            'deadlineDate' => 'required|date',
            'projectFiles.*' => 'nullable|mimes:jpg,doc,docx,pdf,png,dwg',
            'description' => 'required',
        ]);



        DB::transaction(function () use ($request, $serviceId,$serviceName) {
            $ServiceRequest = new ServiceRequests();

            $ServiceRequest->service_id = $serviceId;
            $ServiceRequest->user_id = $request->user()->id;
            $ServiceRequest->service_request_stage_id = 0;
//            $ServiceRequest->service_request_stage_id = Config::get('constants.request_stages.waiting_offers');

            $ServiceRequest->title = $request->title;
            $ServiceRequest->expected_period =  $request->expectedDate;
            $ServiceRequest->budget_min = $request->budgetMin;
            $ServiceRequest->budget_max = $request->budgetMax;
            $ServiceRequest->deadline_date = date("Y-m-d", strtotime($request->deadlineDate));
            $ServiceRequest->description = $request->description;

            $ServiceRequest->save();


            // attachments
            $files =  $request->projectFiles;

            $savedFilesArray = [];
            if ($files) {
                foreach ($files as $file) {
                    $file->store('request_files');
                    $fileToAdd = ['request_id' => $ServiceRequest->id, 'filename' => $file->getClientOriginalName(), 'hashName' => $file->hashName()];
                    array_push($savedFilesArray, $fileToAdd);
                }
                DB::table('request_attachments')->insert($savedFilesArray);
            }

            //services categories needed
            $servicesSelected = [];

            foreach ($request->selectedservices as $serviceCategoryId) {
                array_push($servicesSelected, ['request_id' => $ServiceRequest->id, 'service_category_id' => $serviceCategoryId]);
            }
            DB::table('request_services')->insert($servicesSelected);

//            if($serviceName=='consult'){
//                $us=UserServices::whereIn('service_category_id',$request->selectedservices)->get();
//                foreach ($us as $uu){
//                    if($uu->user){
//                        \Mail::to($uu->user)->send(new NewProject($ServiceRequest,$serviceName!='consult'?'مشروع جديد':'خدمة هندسية'));
//                    }
//                }
//            }


        });

//        if($serviceName=='consult'){
//            return view('user.serviceRequests.success2', [
//                'serviceName' => $serviceName,
//                'serviceText' => $serviceText,
//                'redirectTo' => route('user.services', ['serviceName' => $serviceName])
//            ]);
//        }
        return view('user.serviceRequests.success', [
            'serviceName' => $serviceName,
            'serviceText' => $serviceText,
            'redirectTo' => route('user.services', ['serviceName' => $serviceName])
        ]);
    }

    public function service_request_project(Request $request)
    {

        $serviceName = "project";
        $service = "طلبات تنفيذ مشروع / استشارة";

        if ($request->isMethod('post')) {
            return $this->requestingAproject($request, Config::get('constants.services.project'), $serviceName, $service);
        }

        if ($request->isMethod('get')) {

            $services = new serviceCategories();

            return view('user.serviceRequests.project', [
                'serviceName' => $serviceName,
                'serviceText' => $service,
                'services' => $services->getServicesCategroiesByTypeId(Config::get('constants.services.project'))
            ]);
        }
    }

    public function service_request_visit(Request $request)
    {
        $serviceName = "visit";
        $service = "طلبات زيارة موقع";

        if ($request->isMethod('post')) {
            $request->validate([
                'selectedservices' => 'array|min:1|required',
                'title' => 'required',
                'deadlineDate' => 'required|date',
                'address' => 'required',
                'location' => 'required'
            ]);
            $serviceId = Config::get('constants.services.visit');
            DB::transaction(function () use ($request, $serviceId) {
                $ServiceRequest = new ServiceRequests();

                $ServiceRequest->service_id = $serviceId;
                $ServiceRequest->user_id = $request->user()->id;
                $ServiceRequest->service_request_stage_id = 0;
//                $ServiceRequest->service_request_stage_id = Config::get('constants.request_stages.waiting_offers');

                $ServiceRequest->title = $request->title;
                $ServiceRequest->deadline_date = date("Y-m-d", strtotime($request->deadlineDate));
                $ServiceRequest->address = $request->address;
                $location = explode(",", $request->location);
                $ServiceRequest->xPoint =  $location[0];
                $ServiceRequest->yPoint =  $location[1];
                // $ServiceRequest->location_lng =  $location[1];
                $ServiceRequest->save();


                // attachments
                $files =  $request->projectFiles;

                $savedFilesArray = [];
                if ($files) {
                    foreach ($files as $file) {
                        $file->store('request_files');
                        $fileToAdd = ['request_id' => $ServiceRequest->id, 'filename' => $file->getClientOriginalName(), 'hashName' => $file->hashName()];
                        array_push($savedFilesArray, $fileToAdd);
                    }
                    DB::table('request_attachments')->insert($savedFilesArray);
                }
                //services categories needed
                $servicesSelected = [];
                foreach ($request->selectedservices as $serviceCategoryId) {
                    array_push($servicesSelected, ['request_id' => $ServiceRequest->id, 'service_category_id' => $serviceCategoryId]);
                }
                DB::table('request_services')->insert($servicesSelected);
//                $us=UserServices::whereIn('service_category_id',$request->selectedservices)->get();
//                foreach ($us as $uu){
//                    if($uu->user){
//                        \Mail::to($uu->user)->send(new NewProject($ServiceRequest,'طلب زيارة'));
//                    }
//                }
            });


            return view('user.serviceRequests.success', [
                'serviceName' => $serviceName,
                'serviceText' => $service,
                'redirectTo' => route('user.services', ['serviceName' => $serviceName])
            ]);
        }
        if ($request->isMethod('get')) {

            $services = new serviceCategories();

            return view('user.serviceRequests.visit', [
                'serviceName' => $serviceName,
                'serviceText' => $service,
                'services' => $services->getServicesCategroiesByTypeId(Config::get('constants.services.visit'))
            ]);
        }
    }



    public function service_request_consult(Request $request)
    {
        $serviceName = "consult";
        $service = "خدمات المكاتب الهندسية";

        if ($request->isMethod('post')) {
            return $this->requestingAproject($request, Config::get('constants.services.consult'), $serviceName, $service);
        }
        if ($request->isMethod('get')) {

            $services = new serviceCategories();

            return view('user.serviceRequests.consult', [
                'serviceName' => $serviceName,
                'serviceText' => $service,
                'services' => $services->getServicesCategroiesByTypeId(Config::get('constants.services.consult'))
            ]);
        }
    }


    public function userPersonalInfo(Request $request)
    {

        if ($request->isMethod('post')) {

            $request->validate([
                'nameforuser' => 'required',
                'usercountry' => 'required',
                'nationality' => 'required',
            ]);

            $user = User::find($request->user()->id);

            $user->name = $request->nameforuser;
            $user->country_id = $request->usercountry;
            $user->nationality = $request->nationality;

            $user->save();
            $perc = $request->user()->calculate_profile(true);

            return response()->json([
                'status' => true,
                'message' => __('form.messages.success_info_updated'),
                'accountPerc' => $perc
            ]);
        }
        if ($request->isMethod('get')) {
            $countries = new Country();

            return view('user.profile.personal', [
                'avatar' => $request->user()->profile_img,
                'userCountry' => $request->user()->country_id,
                'name' => $request->user()->name,
                'nationality' => $request->user()->nationality,
                'userType' => App::getLocale() == 'ar' ? 'عميل' : 'Client',
                'countries' => $countries->getCountries()
            ]);
        }
    }

    public function userUpdateProfileImage(Request $request)
    {
        if ($request->isMethod('post')) {
            // dd($request->avatarFile);

            $request->validate([
                'avatarFile' => 'required|mimes:jpg,png',
            ]);
            $request->avatarFile->store('user_files');

            $user = User::find($request->user()->id);
            $user->profile_img  = $request->avatarFile->hashName();
            $user->save();

            $perc = $request->user()->calculate_profile(true);


            return response()->json([
                'status' => true,
                'message' => 'Image successfileReplaced',
                'imageUrl' => route('imagecache', ['template' => 'profile', 'filename' => $user->profile_img]),
                'accountPerc' => $perc
            ]);
        }
    }

    public function userBankInfo(Request $request)
    {

        if ($request->isMethod('post')) {

            $request->validate([
                'bank_id' => 'required',
                'iban_code' => 'required',
            ]);


            $user = User::find($request->user()->id);

            $user->bank_id = $request->bank_id;
            $user->iban_code = $request->iban_code;

            $user->save();

            $perc = $request->user()->calculate_profile(true);

            return response()->json([
                'status' => true,
                'message' => __('form.messages.success_info_updated'),
                'accountPerc' => $perc
            ]);
        }
        if ($request->isMethod('get')) {

            $banks = new BankModel();

            return view('user.profile.bankinfo', [
                'userBank' => $request->user()->bank_id,
                'iban_code' => $request->user()->iban_code,
                'banks' => $banks->getBanks()
            ]);
        }
    }

    public function userContactInfo(Request $request)
    {

        if ($request->isMethod('post')) {
            // dd($request);

            $request->validate([
                'email' => 'required',
                'userphone_number' => 'required',
                'usermobilecountrycode' => 'required',
            ]);

            $user = User::find($request->user()->id);

            $user->phone_number = $request->userphone_number;
            $user->country_code_phone_number = $request->usermobilecountrycode;
            $user->whatsapp_number = $request->userwhatsapp_number;
            $user->country_code_whatsapp = $request->whatsapp_number_country_code;

            $user->save();

            $perc = $request->user()->calculate_profile(true);

            return response()->json([
                'status' => true,
                'message' => __('form.messages.success_info_updated'),
                'accountPerc' => $perc
            ]);
        }
        if ($request->isMethod('get')) {

            $countriesCode = Country::all();

            return view('user.profile.contactinfo', [
                'countriesCode' => $countriesCode,
                'defaultCode' => '966',
                'phone_number' => $request->user()->phone_number,
                'email' => $request->user()->email,
                'whatsapp_number_country_code' => $request->user()->country_code_whatsapp,
                'phone_number_country_code' => $request->user()->country_code_phone_number,
                'whatsapp_number' => $request->user()->whatsapp_number,

            ]);
        }
    }
    public function userChangePassword(Request $request)
    {
        if ($request->isMethod('post')) {


            $request->validate([
                'oldPassword' => 'required|password',
                'password' => 'required|confirmed',
            ]);

            $user = User::find(Auth::user()->id);

            $user->fill([
                'password' => Hash::make($request->password)
            ])->save();

            return response()->json([
                'status' => true,
                'message' => __('passwords.reset'),
            ]);
        }

        if ($request->isMethod('get')) {
            return view('user.profile.changePassword');
        }
    }

    public function accept_offer(Request $request, ServiceRequests $service_request, OffersModel $accpetedOffer)
    {
        if ($service_request->user_id != $request->user()->id) {
            return response()->json([
                'status' => false,
                'message' => 'Forbidden request',
            ], 403);
        }

        $service_request->service_request_stage_id = Config::get('constants.request_stages.implementation');


        // update
        $service_request
            ->offers()
            ->where('id', '!=', $accpetedOffer->id)
            ->update(['offer_status_id' => Config::get('constants.offer_status.Reject')]);
        $service_request->save();

        $accpetedOffer->offer_status_id = Config::get('constants.offer_status.Accepted');
        $accpetedOffer->save();

        $offer_owner = User::where('id', $accpetedOffer->user_id)->first();

        $this->NotifyUser($offer_owner, [
            'title' => 'تم قبول عرضك!',
            'message' => 'تم قبول عرضك المقدم الى : ' .  $request->user()->name,
            'link' => route('request.view', ['service_request' => $service_request])
        ]);

        return response()->json([
            'status' => true,
            'message' => __('form.messages.success_offer_accepted'),
            'redirectTo' => route('request.view', ['service_request' => $service_request])
        ]);
        // dd($service_request->id, $offer->id);
    }


    public function service_search_results(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'selectedservices' => 'required|array',
            'service_type' => 'required',
            "lienceType" => "nullable|integer",
            "projectType" => "nullable|integer"
        ]);



        $currentRequestServiceText = null;
        $steps = null;
        $projectType = null;
        if ($request->service_type == Config::get('constants.services.judge')) {
            $currentRequestServiceText = __('main.judging');
            $steps = 2;
        }
        if ($request->service_type == Config::get('constants.services.licence')) {
            $currentRequestServiceText = "طلب شهادة ترخيص";
            $steps = 3;
            $columnName = App::currentLocale() == 'ar' ? 'service_name_ar as name' : 'service_name_en as name';
            $projectType = serviceCategories::select('id', $columnName)->where('id', $request->projectType)->first();
        }

        $columnName = App::currentLocale() == 'ar' ? 'service_name_ar as name' : 'service_name_en as name';
        $selectedServices = serviceCategories::select('id', $columnName)->whereIn('id', $request->selectedservices)->get();
        $usersHasServices = User::with('operatorProfile')->whereHas('user_services', function ($query) use ($request) {
            $query->whereIn('service_category_id', $request->selectedservices);
        })
            ->select('id', 'name', 'profile_img', 'email', 'country_code_phone_number', 'phone_number', 'user_type')
            ->paginate(12);

        if ($request->ajax()) {
            return $usersHasServices;
        }
        return view('user.serviceResults', [
            'operators' => $usersHasServices,
            'selectedservices' => $selectedServices,
            'service_type' => $request->service_type,
            'currentRequestServiceText' => $currentRequestServiceText,
            'steps' => $steps,
            'projectType' => $projectType
        ]);
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('auth.login');
    }

    public function changeUser($id)
    {

        $us=User::where('email',auth()->user()->email)->where('phone_number',auth()->user()->phone_number)->where('confirmed',1)->findOrFail($id);
//        dd($lang,$id,$us);
        Auth::login($us);
        return redirect()->route('home');


    }

    public function rateOperator(Request $request, ServiceRequests $service_request)
    {

        $acceptedOffer = $service_request->accpeted_offer();
        $currentUserId = $request->user()->id;
        $service_requset_user_id = $service_request->user_id;
        $offerUserID = $acceptedOffer->operator->id;
        $stageStatus = $service_request->service_request_stage_id;
        // dd($acceptedOffer);
        if ($currentUserId != $service_requset_user_id && $stageStatus == Config::get('constants.request_stages.delivering')) {
            return response()->json([
                'status' => false,
                'message' => 'Forbidden request',
            ], 403);
        }


        $rate_speed = $request->responseSpeed;
        $rate_quality = $request->Quality;
        $rate_cost = $request->Cost;

        $totalRates = collect([$rate_speed, $rate_quality, $rate_cost])->avg();


        // $rate_speed = $request->message;

        // dd($totalRates);

        $service_request->service_request_stage_id = Config::get('constants.request_stages.completed');
        $service_request->save();

        $acceptedOffer->offer_status_id = Config::get('constants.offer_status.Completed');
        $acceptedOffer->save();

        $rating = new UserRatingModel();

        $rating->rater_user_id = $request->user()->id;
        $rating->rated_user_id =  $offerUserID;
        $rating->request_id = $service_request->id;
        $rating->rate_speed = $rate_speed;
        $rating->rate_quality = $rate_quality;
        $rating->rate_cost = $rate_cost;
        $rating->rating_value = $totalRates;
        $rating->review_msg = $request->message;
        $rating->admin_isshown = true;
        $rating->admin_isread = false;

        $rating->save();


        $this->NotifyUser($acceptedOffer->operator, [
            'title' => 'تقييم جديد !',
            'message' => 'تم تقييمك في مشروع : ' . $service_request->title,
            'link' => route('request.view', ['service_request' => $service_request])
        ]);

        $requestCompletedView = view('services_request.viewRequest_completed')->render();

        return response()->json([
            'status' => true,
            'message' => __('form.messages.success_rated'),
            'completedView' => $requestCompletedView
        ]);
    }

    public function cancelProject(Request $request, ServiceRequests $service_request)
    {

        //check if the current user request is the owner
        if ($service_request->user_id != $request->user()->id) {
            return response('Forbidden request', 403);
        }

        $service_request->service_request_stage_id = Config::get('constants.request_stages.canceled');

        $service_request
            ->offers()
            ->update(['offer_status_id' => Config::get('constants.offer_status.Reject')]);
        $service_request->save();

        return redirect()->route('request.view', ['service_request' => $service_request]);
    }


    public function freelancerCompanyProfile(Request $request, User $user)
    {
        // dd($user);

        $userDetails = User::with('user_services.service_category')
            ->findOrFail($user->id);

        if(!$userDetails->operatorProfile){
            abort(404);
        }
        $previousProjects = OffersModel::has('request')->with('request')->where('user_id', $userDetails->id)
            ->with(['offer_status'])
            ->with('request', function ($query) {
                $query->select('id', 'title', 'created_at')->with('requested_services');
            })
            ->orderByDesc('created_at')
            ->get();

        $totalCompletedOffers = $previousProjects->where('offer_status_id', 4)->count();


        $userRates = UserRatingModel::where('rated_user_id', $userDetails->id)
            ->with('request', function ($query) {
                $query->select('id', 'title', 'created_at')->with('requested_services');
            })
            ->orderByDesc('created_at')
            ->get();


        $works = UserPortfolio::where('user_id', $userDetails->id)
            ->orderByDesc('created_at')
            ->get();


        // $currentUserServices = $userDetails->->get();
        return view('general.freelanceCompanyProfile', [
            'operator' => $userDetails,
            'previousProjects' => $previousProjects,
            'totalCompletedOffers' => $totalCompletedOffers,
            'reviews' => $userRates,
            'works' => $works,
        ]);
    }
}
