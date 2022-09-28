<?php

namespace App\Http\Controllers;

use App\Mail\NewOffer;
use App\Models\BankModel;
use App\Models\CompanyAdmisson;
use App\Models\CompanyProfile;
use App\Models\Country;
use App\Models\JobsModel;
use App\Models\OffersModel;
use App\Models\serviceCategories;
use App\Models\ServiceRequests;
use App\Models\ServicesModel;
use App\Models\User;
use App\Models\UserPortfolio;
use App\Models\UserRatingModel;
use App\Models\VisitReport;
use App\Models\VisitReportAttachments;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class OperatorController extends FrontBaseController
{

    public function getRequests($userServices, $searchValue = null)
    {
        //TODO : replace with current operator services

        $userCanImplementServices = $userServices;

        return ServiceRequests::whereHas('requested_services_per_project', function ($query) use ($userCanImplementServices) {
            $query->whereIn('service_category_id', $userCanImplementServices);
        })
            ->where('service_request_stage_id',  1)
            ->where('canceled', false)
            ->whereDate('deadline_date', '>=', Carbon::today()->toDateString())
            ->where('title', 'like', '%' . $searchValue . '%')
            ->with('service_request_owner', function ($query) {
                $query->select('id')->withAvg('rates', 'rating_value');
            })
            ->orderByDesc('created_at')
            ->get();
    }
    //
    public function operatorExplore(Request $request)
    {
        $userServices = $request->user()->user_services()->pluck('service_category_id')->toArray();
        // dd($userServices);
        $service_requests = $this->getRequests($userServices);
        // dd($service_requests);
        $chatMsgs = $request->user()
            ->chatMsgs()->selectRaw('count(*) as total')
            ->selectRaw("count(case when isread = 0 then 1 end) as unread_count")
            ->first();
        // dd($chatMsgs);
        // $service_requests = $this->getRequests()->paginate(4);
        $currentUserServices = $request->user()->user_services()->with(['service_category','service_category.parent_service'])->get();
        // dd($currentUserServices);
        return view('operators.operatorExplore', [
            'service_requests' => $service_requests,
            'currentUserServices' => $currentUserServices,
            'chatMsgs' => $chatMsgs
        ]);
    }

    public function operatorExploreSearch(Request $request)
    {
        $request->validate([
            'searchValue' => 'string|nullable',
        ]);
        $userServices = $request->user()->user_services()->pluck('service_category_id')->toArray();
        $service_requests = $this->getRequests($userServices, $request->searchValue);
        // sleep(1);
        $results = view('operators.service_request_item', ['service_requests' => $service_requests])->render();

        return response()->json([
            'status' => true,
            'message' => "results",
            'data' => $results
        ]);
    }

    public function operatorProfile(Request $request)
    {
        $userDetails = $request->user();
        $currentUserServices = $request->user()->user_services()->with(['service_category','service_category.parent_service'])->get();
//        dd($currentUserServices);

        // DB::enableQueryLog();
        $previousProjects = OffersModel::where('user_id', $request->user()->id)
            ->with(['offer_status'])
            ->with('request', function ($query) {
                $query->select('id', 'title', 'created_at')->with('requested_services');
            })
            ->orderByDesc('created_at')
            ->get();

        $userRates = UserRatingModel::where('rated_user_id', $request->user()->id)
            ->with('rater', function ($query) {
                $query->select('id', 'email', 'name', 'profile_img');
            })
            ->with('request', function ($query) {
                $query->select('id', 'title', 'created_at')->with('requested_services');
            })
            ->orderByDesc('created_at')
            ->get();

        // dd();

        //Get all opreator rates for users based on userAlreadyRates model

        $operatorRateUser = UserRatingModel::where('rater_user_id', $request->user()->id)
            ->select('id', 'request_id')
            ->whereIn('request_id', $userRates->pluck('request_id')->toArray())->get();
        // dd($operatorRateUser);

        $works = UserPortfolio::where('user_id', $request->user()->id)
            ->orderByDesc('created_at')
            ->get();

        // dd(DB::getQueryLog());

        return view('operators.operatorProfile', [
            'currentUserServices' => $currentUserServices,
            'userDetails' => $userDetails,
            'previousProjects' => $previousProjects,
            'reviews' => $userRates,
            'works' => $works,
            'alreadyRatedUsers' => $operatorRateUser
        ]);
    }

    public function operatorPortfolio()
    {
        // if ($request->ajax()) {

        // }
        # code...
    }

    public function operatorJobs(Request $request)
    {

        $jobs = JobsModel::where('user_id', $request->user()->id)->orderByDesc('created_at')->paginate(12);

        return view('operators.operatorJobs', [
            'jobs' => $jobs
        ]);
    }



    public function operatorAddPortfolio(Request $request)
    {
        // dd($request->all());

        $request->validate([
            'workTitle' => 'required|string',
            'workFile' => 'required|file|mimes:jpg,png,pdf'
        ]);

        $work = new UserPortfolio();
        $work->user_id = $request->user()->id;

        $request->workFile->store('user_files');

        $work->title = $request->workTitle;
        $work->filename = $request->workFile->getClientOriginalName();
        $work->hashName = $request->workFile->hashName();

        $work->save();

        $addedWork = view('operators.operator_portfolio_item', ['work' => $work, 'CanDelete' => true])->render();

        return response()->json([
            'status' => true,
            'message' => __('form.messages.success_added_portfolio'),
            'addedWork' => $addedWork
        ]);
    }


    public function accountSettings(Request $request)
    {

        if ($request->isMethod('post')) {
            // dd($request->all());

            if ($request->user()->user_type == 'freelancer') {
                $request->validate([
                    'freelancername' => 'required|string',
                    'occupation' => 'required|string',
                    'city' => 'required|string',
                    'area' => 'required|string',
                    'membershipid' => 'required|string',
                    'bio_text' => 'required|string'
                ]);
                $fileTemplate = null;

                DB::transaction(function () use ($request, &$fileTemplate) {

                    $user = User::find($request->user()->id);
                    $user->name = $request->freelancername;
//                    $user->confirmed = false;
                    $user->operatorProfile()->update([
                        'occupation' => $request->occupation,
                        'city' => $request->city,
                        'area' => $request->area,
                        'membershipId' => $request->membershipid,
                        'bio_text' => $request->bio_text
                    ]);

                    if ($request->hasFile('licenceFile')) {
                        $request->licenceFile->store('freelancer');
                        $fileName = $request->licenceFile->getClientOriginalName();
                        $hashName = $request->licenceFile->hashName();
                        $user->operatorProfile()->update([
                            'membership_copy' => $hashName,
                            'membership_copy_filename' =>  $fileName,
                            'membership_confirmed' => false,
                            'membership_confirmed_date' => null,
                        ]);
                        $fileTemplate = view('general.file_template', ['fileName' => $fileName, 'hashName' => $hashName])->render();
                    }
                    $user->save();
                });

                $perc = $request->user()->calculate_profile(true);

                return response()->json([
                    'status' => true,
                    'message' => __('form.messages.success_info_updated'),
                    'accountPerc' => $perc,
                    'fileTemplate' => $fileTemplate
                ]);
            }

            if ($request->user()->user_type == 'company') {
                $request->validate([
                    'companyname' => 'required|string',
                    'companyowner' => 'required|string',
                    'contact_person_name' => 'required|string',
                    'city' => 'required|string',
                    'area' => 'required|string',
                    'licencenumber' => 'required|string',
                    'admissiontype' => 'required|integer',
                    'bio_text' => 'required|string'
                ]);
                $fileTemplate = null;

                DB::transaction(function () use ($request, &$fileTemplate) {

                    $user = User::find($request->user()->id);
                    $user->name = $request->companyname;
                    $user->confirmed = false;
                    $user->operatorProfile()->update([
                        'owner_name' => $request->companyowner,
                        'contact_person_name' => $request->contact_person_name,
                        'city' => $request->city,
                        'area' => $request->area,
                        'company_admission_id' => $request->admissiontype,
                        'licensenumber' => $request->licencenumber,
                        'bio_text' => $request->bio_text
                    ]);

                    if ($request->hasFile('licenceFile')) {
                        $request->licenceFile->store('company');
                        $fileName = $request->licenceFile->getClientOriginalName();
                        $hashName = $request->licenceFile->hashName();
                        $user->operatorProfile()->update([
                            'license_copy' => $hashName,
                            'licence_copy_fileName' =>  $fileName,
                            'licence_confirmed' => false,
                            'licence_confirmed_date' => null,
                        ]);
                        $fileTemplate = view('general.file_template', ['fileName' => $fileName, 'hashName' => $hashName])->render();
                    }
                    $user->save();
                });

                $perc = $request->user()->calculate_profile(true);

                return response()->json([
                    'status' => true,
                    'message' => __('form.messages.success_info_updated'),
                    'accountPerc' => $perc,
                    'fileTemplate' => $fileTemplate
                ]);
            }
        }
        if ($request->isMethod('get')) {

            $companyAdmissions = CompanyAdmisson::all();
            return view('operators.accountSettings.accountInformation', [
                'confirmed' => $request->user()->confirmed,
                'avatar' => $request->user()->profile_img,
                // 'company_name' => $request->user()->name,
                // 'email' => $request->user()->email,
                // 'owner_name' => $request->user()->operatorProfile->owner_name,
                // 'contact_person_name' => $request->user()->operatorProfile->contact_person_name,
                // 'address' => $request->user()->operatorProfile->address,
                // 'company_admission_id' => $request->user()->operatorProfile->company_admission_id,
                // 'licensenumber' => $request->user()->operatorProfile->licensenumber,
                // 'license_copy' => $request->user()->operatorProfile->license_copy,
                // 'licence_copy_fileName' => $request->user()->operatorProfile->licence_copy_fileName,
                // 'licence_confirmed' => $request->user()->operatorProfile->licence_confirmed,
                'bio_text' => $request->user()->operatorProfile->bio_text,
                'companyAdmissions' => $companyAdmissions,

            ]);
        }
    }



    public function operatorChangePassword(Request $request)
    {
        if ($request->isMethod('post')) {


            $request->validate([
                'oldPassword' => 'required|password',
                'password' => 'required|confirmed',
            ]);

            $user = User::find($request->user()->id);

            $user->fill([
                'password' => Hash::make($request->password)
            ])->save();


            // $perc = $request->user()->calculate_profile();

            return response()->json([
                'status' => true,
                'message' => __('passwords.reset'),
                // 'accountPerc' => $perc
            ]);
        }

        if ($request->isMethod('get')) {
            return view('operators.accountSettings.changePassword');
        }
    }

    public function operatorJudgeService(Request $request)
    {

        if ($request->isMethod('post')) {
            // dd($request->all());
            $request->validate([
                'arbitration' => 'required|file|mimes:jpg,pdf'
            ]);

            $user = User::find($request->user()->id);

            $hashName = null;
            if ($request->user()->user_type == 'company') {
                $request->arbitration->store('company');
                $hashName = $request->arbitration->hashName();
            }
            if ($request->user()->user_type == 'freelancer') {
                $request->arbitration->store('freelancer');
                $hashName = $request->arbitration->hashName();
            }

            $user->operatorProfile()->update([
                'arbitration_cert_copy' => $hashName,
                'arbitrationcert_request_status' => true,
                'arbitrationcert_confirmed' => false,
            ]);

            $user->save();
            $this->NotifyAdminUsers([
                'title' => 'طلب تفعيل خدمة التحكيم',
                'message' => 'طلب ' . $user->name . ' تفعيل خدمة التحكيم'
            ]);

            return redirect()->route('operator.judgeService');
        }
        if ($request->isMethod('get')) {
            $status = $request->user()->operatorProfile->arbitrationcert_confirmed;
            $RequestStatus = $request->user()->operatorProfile->arbitrationcert_request_status;
            return view('operators.accountSettings.judgeService', ['status' => $status, 'request_status' => $RequestStatus]);
        }
    }

    public function operatorTestBuildService(Request $request)
    {

        if ($request->isMethod('post')) {
            // dd($request->all());
            $request->validate([
                'arbitration' => 'required|file|mimes:jpg,pdf'
            ]);

            $user = User::find($request->user()->id);

            $hashName = null;
            if ($request->user()->user_type == 'company') {
                $request->arbitration->store('company');
                $hashName = $request->arbitration->hashName();
            }
            if ($request->user()->user_type == 'freelancer') {
                $request->arbitration->store('freelancer');
                $hashName = $request->arbitration->hashName();
            }

            $user->operatorProfile()->update([
                'test_build_cert_copy' => $hashName,
                'test_build_request_status' => true,
                'test_build_confirmed' => false,
            ]);

            $user->save();
            $this->NotifyAdminUsers([
                'title' => 'طلب تفعيل خدمة فحص المباني الجاهزة',
                'message' => 'طلب ' . $user->name . ' تفعيل خدمة فحص المباني الجاهزة'
            ]);
            return redirect()->back();
        }
        if ($request->isMethod('get')) {
            $status = $request->user()->operatorProfile->test_build_confirmed;
            $RequestStatus = $request->user()->operatorProfile->test_build_request_status;
            return view('operators.accountSettings.testBuildService', ['status' => $status, 'request_status' => $RequestStatus]);
        }
    }

    public function operatorTestQualityService(Request $request)
    {

        if ($request->isMethod('post')) {
            // dd($request->all());
            $request->validate([
                'arbitration' => 'required|file|mimes:jpg,pdf'
            ]);

            $user = User::find($request->user()->id);

            $hashName = null;
            $hashName2 = null;
            if ($request->user()->user_type == 'company') {
                $request->arbitration->store('company');
                $hashName = $request->arbitration->hashName();
            }
            if ($request->user()->user_type == 'freelancer') {
                $request->arbitration->store('freelancer');
                $hashName = $request->arbitration->hashName();

                if($request->insurance_copy){
                    $request->insurance_copy->store('freelancer');
                    $hashName2 = $request->insurance_copy->hashName();

                }
            }

            $user->operatorProfile()->update([
                'test_quality_cert_copy' => $hashName,
                'insurance_copy' => $hashName2,
                'test_quality_request_status' => true,
                'test_quality_confirmed' => false,
            ]);

            $user->save();
            $this->NotifyAdminUsers([
                'title' => 'طلب تفعيل خدمة فحص جودة البناء',
                'message' => 'طلب ' . $user->name . ' تفعيل خدمة فحص جودة البناء'
            ]);
            return redirect()->back();
        }
        if ($request->isMethod('get')) {
            $status = $request->user()->operatorProfile->test_quality_confirmed;
            $RequestStatus = $request->user()->operatorProfile->test_quality_request_status;
            return view('operators.accountSettings.testQualityService', ['status' => $status, 'request_status' => $RequestStatus]);
        }
    }

    public function operatorworkFields(Request $request)
    {

        if ($request->isMethod('post')) {

            $request->validate([
                // 'selectedservices' => 'array',
                'selectedservices'   => 'required|array',
                'selectedservices.*' => 'integer',
            ]);
            // $results = $request->user()->user_services()->with('user_services.service_category')->get();
            // $results = $request->user()::with('user_services.service_category')->find($request->user()->id);
            // $results = User::with('user_services.service_category')->find($request->user()->id);
            // $results =$request->user();
            // dd();

            // $currentUserServices = $request->user()->user_services()->with('service_category')->get();
            $currentUserServices = $request->user()->user_services()->get();

            // dd($currentUserServices);
            // $results = UserServices::with('service_category')->where('user_id', 4)->get();
            // $collection = collect($request->only('selectedservices'));


            // foreach ($request->selectedservices as $serviceCategoryId) {
            //     $collection->combine([$serviceCategoryId]);
            //     $collection->all();
            // }
            $IdsAlreadyExists = $currentUserServices->pluck('service_category_id')->all();
            // $keysToInsert = $collection->diffKeys($currentUserServices->pluck('service_category_id')->all());
            // $integerIDs = array_map('intval', explode(',', $request->selectedservices));
            $numArray = array_map('intval', $request->selectedservices);
            $KeysToInsert = array_diff($numArray, $IdsAlreadyExists);
            $keysToDelete = array_diff($IdsAlreadyExists, $numArray);
            // dd($KeysToInsert, $keysToDelete);
            $servicesSelected = [];
            foreach ($KeysToInsert as $Id) {
                array_push($servicesSelected, ['user_id' => $request->user()->id, 'service_category_id' => $Id]);
            }

            DB::table('user_services')->insert($servicesSelected);
            DB::table('user_services')->where('user_id', $request->user()->id)->whereIn('service_category_id', $keysToDelete)->delete();




            return response()->json([
                'status' => true,
                'message' => __('form.messages.success_info_updated'),
            ]);
        }
        if ($request->isMethod('get')) {


            $services = new serviceCategories();
            $service_types = new ServicesModel();
            if ($request->user()->user_type == "company") {
                $service_types = $service_types->getServices();
            } else {
                $service_types = $service_types->getFreeLancerServices();
            }
            $servicesList = $services->getServicesCategroiesByTypeIdAndParent(Config::get('constants.services.licence'), null);
            $subServicesList = [];
            foreach ($servicesList as $value) {
                $serviceParentId = $value->id;
                // dd($value->name);
                $subServicesList[] = [
                    'serviceParentId' => $serviceParentId,
                    'subservices' => $services->getServicesCategroiesByTypeIdAndParent(Config::get('constants.services.licence'), $serviceParentId)
                ];
            }

            // 36 //  ترخيص انشاء Residential Projects
            // 37 //  ترخيص انشاء Commercial Projects
            // 38 //  ترخيص انشاء Large Projects
            // 47 // ترخيص تشغيل Commercial Projects
            // 48 // مشاريع كبرى Large Projects
            $licence_subCategories = [];
            foreach ($subServicesList as $value) {
                foreach ($value['subservices'] as $value) {
                    $serviceParentId = $value->id;
                    $licence_subCategories[] = [
                        'serviceParentId' => $serviceParentId,
                        'subservices' => $services->getServicesCategroiesByTypeIdAndParent(Config::get('constants.services.licence'), $serviceParentId)
                    ];
                }
            }
            // dd($licence_subCategories);

            // $services = $services->getServicesCategroiesByTypeIdAndParent(Config::get('constants.services.licence'), 36);
            // $services = $services->getServicesCategroiesByTypeIdAndParent(Config::get('constants.services.licence'), 36);
            // $services = $services->getServicesCategroiesByTypeIdAndParent(Config::get('constants.services.licence'), 36);

            // dd($test);

            $currentUserServices = $request->user()->user_services()->get();
            // dd();
            return view('operators.accountSettings.workFields', [
                'service_types' => $service_types,
                'services_projects' => $services->getServicesCategroiesByTypeId(Config::get('constants.services.project')),
                'services_consult' =>  $services->getServicesCategroiesByTypeId(Config::get('constants.services.consult')),
                'services_judge' =>  $services->getServicesCategroiesByTypeId(Config::get('constants.services.judge')),
                'services_visit' =>  $services->getServicesCategroiesByTypeId(Config::get('constants.services.visit')),
                'services_licence' =>  $servicesList,
                'subservices' => $subServicesList,
                'licence_subCategories' => $licence_subCategories,
                'currentUserServices' => $currentUserServices->pluck('service_category_id')->all()
            ]);
        }
    }

    public function operatorContactInfo(Request $request)
    {

        if ($request->isMethod('post')) {
            $request->validate([
                'operator_number' => 'required',
                'usermobilecountrycode' => 'required',
            ]);
            // DB::enableQueryLog();


            DB::transaction(function () use ($request) {
                $user = User::find($request->user()->id);
                $user->phone_number = $request->operator_number;
                $user->country_code_phone_number = $request->usermobilecountrycode;
                if ($user->user_type == 'company') {
                    $user->operatorProfile()->update([
                        'company_instagram' => $request->instagram_link,
                        'company_twitter' => $request->twitter_link,
                        'company_facebook' => $request->facebook_link,
                    ]);
                } else {
                    $user->operatorProfile()->update([
                        'freelancer_instagram' => $request->instagram_link,
                        'freelancer_twitter' => $request->twitter_link,
                        'freelancer_facebook' => $request->facebook_link,
                    ]);
                }

                $user->save();
            });

            $perc = $request->user()->calculate_profile(true);

            // dd(DB::getQueryLog());

            return response()->json([
                'status' => true,
                'message' => __('form.messages.success_info_updated'),
                'accountPerc' => $perc
            ]);
        }

        if ($request->isMethod('get')) {

            $countriesCode = Country::select('code')->get();
            $userProfile = $request->user()->operatorProfile;

            $instagram = $request->user()->user_type == 'company' ? $userProfile->company_instagram : $userProfile->freelancer_instagram;
            $twitter = $request->user()->user_type == 'company' ? $userProfile->company_twitter : $userProfile->freelancer_twitter;
            $facebook = $request->user()->user_type == 'company' ? $userProfile->company_facebook : $userProfile->freelancer_facebook;

            return view('operators.accountSettings.contactInfo', [
                'countriesCode' => $countriesCode,
                'defaultCode' => '966',
                'phone_number' => $request->user()->phone_number,
                'phone_number_country_code' => $request->user()->country_code_phone_number,
                'email' => $request->user()->email,
                'company_instagram' => $instagram,
                'company_twitter' => $twitter,
                'company_facebook' => $facebook,
            ]);
        }
    }


    public function operatorCreateJob(Request $request)
    {
        if ($request->isMethod('post')) {
            $request->validate([
                'jobId' => 'integer|nullable',
                'title' => 'required|string',
                'deadline' => 'required|date',
                'desc' => 'required|string',
                'recruiter_phone' => 'required_without:recruiter_email',
                'recruiter_email' => 'required_without:recruiter_phone',
                'image' => 'image',
            ]);
            if($request->recruiter_email){
                $request->validate([
                    'recruiter_email' => 'email',
                ]);
            }
            $message = __('form.messages.success_job_created');
            $type = 'create';
            $job = new JobsModel();
            if (isset($request->jobId)) {
                $job = JobsModel::where('user_id', $request->user()->id)->find($request->jobId);
                $message = __('form.messages.success_info_updated');
                $type = 'update';
            }

            $job->title = $request->title;
            $job->deadline =   date("Y-m-d", strtotime($request->deadline));
            $job->desc = $request->desc;
            $job->recruiter_phone = $request->recruiter_phone;
            $job->recruiter_email = $request->recruiter_email;
            $job->user_id = $request->user()->id;

            if($request->image){
                $request->image->store('user_files');
                $job->image = $request->image->hashName();
            }
            $job->save();

            $jobs = collect([$job]);
            $newJobTemplate  =  view('operators.operatorJobs_items', ['jobs' => $jobs])->render();

            return response()->json([
                'status' => true,
                'type' => $type,
                'jobId' => $job->id,
                'message' =>  $message,
                'newJobTemplate' => $newJobTemplate
            ]);
        }
    }

    public function operatorDeleteJob(Request $request)
    {
        if ($request->isMethod('delete')) {
            $request->validate([
                'JobId' => 'required'
            ]);
            $job = JobsModel::where('user_id', $request->user()->id)
                ->where('id', $request->only('JobId'))
                ->first();
            $job->delete();
            // dd($job);
            return response()->json([
                'status' => true,
                'jobId' => $job->id
            ]);
        }
    }



    public function operatorDeleteWork(Request $request)
    {
        if ($request->isMethod('delete')) {
            $request->validate([
                'workId' => 'required'
            ]);
            $work = UserPortfolio::where('user_id', $request->user()->id)
                ->where('id', $request->only('workId'))
                ->first();
            $work->delete();
            // dd($job);
            return response()->json([
                'status' => true,
                'workId' => $work->id
            ]);
        }
    }


    public function operatorBankInfo(Request $request)
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

            return view('operators.accountSettings.bankInfo', [
                'userBank' => $request->user()->bank_id,
                'iban_code' => $request->user()->iban_code,
                'banks' => $banks->getBanks()
            ]);
        }
    }


    public function operatorApplyOffer(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'request_id' => 'required',
            'offerCost' => 'required',
            'workingDays' => 'nullable|numeric',
            'websitePerc' => 'nullable|numeric',
            'message' => 'required|string',
        ]);

        if ($request->workingDays == null)
            $request->workingDays = 0;

        if ($request->websitePerc == null)
            $request->websitePerc = $request->offerCost;


        $messages = [
            'request_id.unique' => 'Given request_id and user_id are already registerd',
        ];

        $this->validate(request(), [
            'request_id' => [
                'required',
                Rule::unique('offers', 'request_id')->where(function ($query) use ($request) {
                    return $query->where('user_id', $request->user()->id)->whereNull('deleted_at');
                }),
            ],
        ], $messages);

        DB::transaction(function () use ($request) {

            $offer = new OffersModel();
            $offer->user_id = $request->user()->id;
            $offer->offer_status_id = Config::get('constants.offer_status.Waiting');
            $offer->request_id = $request->request_id;
            $offer->offer_price =   $request->offerCost;
            $offer->expected_period =  $request->workingDays;
            $offer->offer_price_total =   $request->websitePerc;
            $offer->offer_desc =  $request->message;

            $offer->save();

            $files = $request->uploaded_files;
            $savedFilesArray = [];
            if ($files) {
                foreach ($files as $file) {
                    $file = explode("|", $file);
                    $fileToAdd = ['offer_id' => $offer->id, 'filename' => $file[0], 'hashName' => $file[1]];
                    array_push($savedFilesArray, $fileToAdd);
                }
                DB::table('offer_attachments')->insert($savedFilesArray);
            }
        });

        $service_request = ServiceRequests::where('id', $request->request_id)->first();
        $request_owner = $service_request->service_request_owner;

        $this->NotifyUser($request_owner, [
            'title' => 'عرض جديد !',
            'message' => 'عرض جديد من قبل : ' .  $request->user()->name,
            'link' => route('request.view', ['service_request' => $service_request->id])
        ]);
        \Mail::to($request_owner)->send(new NewOffer($request->user()->name, $service_request));


        return response()->json([
            'status' => true,
            'message' => __('form.messages.success_offer_sent'),
            'redirectTo' => route('request.view', ['service_request' => $request->request_id])
        ]);
    }

    public function operatorEditOffer(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'request_id' => 'required',
            'offerCost' => 'required',
            'workingDays' => 'nullable|numeric',
            'websitePerc' => 'nullable|numeric',
        ]);

        if ($request->workingDays == null)
            $request->workingDays = 0;

        if ($request->websitePerc == null)
            $request->websitePerc = $request->offerCost;


        DB::transaction(function () use ($request) {

            $offer =  OffersModel::where('user_id',$request->user()->id)->where('request_id',$request->request_id)->first();
            $offer->offer_price =   $request->offerCost;
            $offer->expected_period =  $request->workingDays;
            $offer->offer_price_total =   $request->websitePerc;
            $offer->save();
        });

        return response()->json([
            'status' => true,
            'message' => __('form.messages.success_offer_sent'),
            'redirectTo' => route('request.view', ['service_request' => $request->request_id])
        ]);
    }

    public function operatorUploadOfferFiles(Request $request)
    {
        $request->validate([
            'file_offer' => 'required|mimes:jpg,doc,docx,pdf,dwg,png',
        ]);

        // $messages = [
        //     'request_id.unique' => 'Given request_id and user_id are already registerd',
        // ];

        // $this->validate(request(), [
        //     'file_offer' => 'required|mimes:jpg,doc,docx,pdf',
        //     'request_id' => [
        //         Rule::unique('offers', 'request_id')->where(function ($query) use ($request) {
        //             return $query->where('user_id', $request->user()->id)->whereNull('deleted_at');
        //         }),
        //     ],
        // ], $messages);

        $request->file_offer->store('request_files');
        $filename = $request->file_offer->getClientOriginalName();
        $hashName = $request->file_offer->hashName();
        return response()->json([
            'status' => true,
            'filename' => $filename,
            'hashName' => $hashName
        ]);
    }

    private function deliverProject($request, $service_request)
    {
        $acceptedOffer = $service_request->accpeted_offer();
        $currentUserId = $request->user()->id;
        $offerUserID = $acceptedOffer->operator->id;
        $stageStatus = $service_request->service_request_stage_id;
        // dd($offerUserID);
        if ($currentUserId != $offerUserID && $stageStatus == Config::get('constants.request_stages.implementation')) {
            return false;
        }

        $service_request->service_request_stage_id = Config::get('constants.request_stages.delivering');
        $service_request->save();


        $this->NotifyUser($service_request->service_request_owner, [
            'title' => 'تسليم مشروع',
            'message' => 'وصل مشروعك ' . $service_request->title . ' الى مرحلة التسليم',
            'link' => route('request.view', ['service_request' => $service_request])
        ]);

        return true;
    }

    public function operatorDeliverProject(Request $request, ServiceRequests $service_request)
    {
        // $acceptedOffer = $service_request->accpeted_offer();
        // $currentUserId = $request->user()->id;
        // $offerUserID = $acceptedOffer->operator->id;
        // $stageStatus = $service_request->service_request_stage_id;
        // // dd($offerUserID);
        // if ($currentUserId != $offerUserID && $stageStatus == Config::get('constants.request_stages.implementation')) {
        //     return response()->json([
        //         'status' => false,
        //         'message' => 'Forbidden request',
        //     ], 403);
        // }

        // $service_request->service_request_stage_id = Config::get('constants.request_stages.delivering');
        // $service_request->save();
        $status = $this->deliverProject($request, $service_request);

        if ($status == false) {
            return response()->json([
                'status' => false,
                'message' => 'Forbidden request',
            ], 403);
        } else {
            return response()->json([
                'status' => true,
                'message' => 'delivering stage done',
                'redirectTo' => route('request.view', ['service_request' => $service_request->id])
            ]);
        }
    }

    public function operatorProjects(Request $request)
    {
        $previousProjects = OffersModel::where('user_id', $request->user()->id)
            ->with(['offer_status'])
            ->whereIn('offer_status_id', [2, 4])
            ->with('request', function ($query) {
                $query->select('id', 'title', 'created_at')->with('requested_services');
            })
            ->orderByDesc('created_at')
            ->get();


        return view('operators.operator_projects', ['previousProjects' => $previousProjects]);
    }



    public function operatorProjects_search(Request $request)
    {
        $searchValue = $request->searchValue;

        // $latest = $request->all;
        // $latest = $latest ? true : false;

        $previousProjects = OffersModel::where('user_id', $request->user()->id)
            ->with(['offer_status'])
            ->whereIn('offer_status_id', [2, 4])
            ->whereHas('request', function ($query) use ($searchValue) {
                $query->select('id', 'title', 'created_at')
                    ->where('title', 'like', '%' . $searchValue . '%')
                    ->with('requested_services');
            })
            ->orderByDesc('created_at')
            ->get();

        $results  =  view('operators.operator_projects_items', ['previousProjects' => $previousProjects])->render();

        return response()->json([
            'status' => true,
            'message' => "results",
            'data' => $results
        ]);
    }


    public function operatorOffers(Request $request)
    {

        // 'Waiting' => 1,
        // 'Accepted' => 2,
        // 'Reject' => 3,
        // 'Completed' => 4,

        $previousProjects = OffersModel::where('user_id', $request->user()->id)
            ->with(['offer_status'])
            // ->where('offer_status_id', '!=', 4)
            ->with('request', function ($query) {
                $query->select('id', 'title', 'created_at')->with('requested_services');
            })
            // ->orderByDesc('created_at')
            ->get();
        // dd(  $previousProjects);
        return view('operators.operator_offers', ['previousProjects' => $previousProjects]);
    }
    public function operatorOffers_search(Request $request)
    {
        // dd($request->all());
        $searchValue = $request->searchValue;
        // $options = collect($request->latest);
        $latest = $request->latest;

        // $latest = $options->contains(function ($value, $key) {
        //     return $value == "latest";
        // });
        $latest = $latest ? "desc" : "asc";
        // if ($request->selectedservices) {

        // }
        // dd();
        $statusList = $request->selectedservices ? $request->selectedservices : [1, 2, 3];

        $results = OffersModel::where('user_id', $request->user()->id)
            ->with(['offer_status'])
            // ->where('offer_status_id', '!=', 4)
            ->whereIn('offer_status_id', $statusList)
            ->whereHas('request', function ($query) use ($searchValue) {
                $query->select('id', 'title', 'created_at')
                    ->where('title', 'like', '%' . $searchValue . '%')
                    ->with('requested_services');
            })
            ->orderBy('created_at', $latest)
            ->get();

        // $results->all();
        // dd($results);

        $results  =  view('operators.operator_offers_items', ['previousProjects' => $results])->render();

        return response()->json([
            'status' => true,
            'message' => "results",
            'data' => $results
        ]);
    }

    public function operatorRateUser(Request $request)
    {
        // dd($request->all());

        $requestID = $request->requestId;
        $projectOwnerEmail = $request->projectOwnerEmail;
        $rate_speed = $request->responseSpeed;
        $rate_quality = $request->Quality;
        $rate_cost = $request->Cost;
        $projecOwnerId = User::where('email', $projectOwnerEmail)->first();

        $totalRates = collect([$rate_speed, $rate_quality, $rate_cost])->avg();

        // check if request and rated user is actually the project owner
        $ServiceRequest = ServiceRequests::where('user_id', $projecOwnerId->id)->where('id', $requestID)->first();
        if ($ServiceRequest == null) {
            return response()->json([
                'status' => false,
                'message' => 'Forbidden request',
            ], 403);
        }


        $messages = [
            'requestId.unique' => 'Operator already gave a rate for this user on this project',
        ];

        $this->validate(request(), [
            'requestId' => [
                'required',
                Rule::unique('user_rating', 'request_id')->where(function ($query) use ($request, $projecOwnerId) {
                    return $query->where('rater_user_id', $request->user()->id)
                        ->where('rated_user_id', $projecOwnerId->id);
                }),
            ],
        ], $messages);



        $rating = new UserRatingModel();

        $rating->rater_user_id = $request->user()->id;
        $rating->rated_user_id =  $projecOwnerId->id;
        $rating->request_id = $requestID;
        $rating->rate_speed = $rate_speed;
        $rating->rate_quality = $rate_quality;
        $rating->rate_cost = $rate_cost;
        $rating->rating_value = $totalRates;
        $rating->review_msg = $request->message;
        $rating->admin_isshown = true;
        $rating->admin_isread = false;

        $rating->save();

        return response()->json([
            'status' => true,
            'message' => __('form.messages.success_rated'),
            'requestId' => $requestID
        ]);
    }


    public function operatorUploadVisitReport(Request $request, ServiceRequests $service_request)
    {
        // dd($request->all());
        DB::transaction(function () use ($request, $service_request) {

            $visitReport = new VisitReport();
            $visitReport->request_id = $service_request->id;
            $visitReport->user_id = $request->user()->id;
            $visitReport->confirmed = true;

            $request->reportFile->store('request_files');
            $visitReport->filename = $request->reportFile->getClientOriginalName();
            $visitReport->hashName = $request->reportFile->hashName();
            $visitReport->save();

            $ReportPhotos = [];
            if ($request->has('reportPhotos')) {

                foreach ($request->reportPhotos as $photo) {
                    $photo->store('request_files');
                    $fileToAdd = ['visit_report_id' => $visitReport->id, 'filename' => $photo->getClientOriginalName(), 'hashName' => $photo->hashName()];
                    array_push($ReportPhotos, $fileToAdd);
                }

                DB::table('visit_report_attachments')->insert($ReportPhotos);
            }
        });

        $status = $this->deliverProject($request, $service_request);

        if ($status == false) {
            return response()->json([
                'status' => false,
                'message' => 'Forbidden request',
            ], 403);
        } else {

            $success = view('services_request.viewRequest_visitReportSent')->render();

            return response()->json([
                'status' => true,
                'message' => 'تم ارسال التقرير النهائي للعميل',
                'success' => $success,
                'redirectTo' => route('request.view', ['service_request' => $service_request->id])
            ]);
        }
    }
}
