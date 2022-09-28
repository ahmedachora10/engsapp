<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminBaseController;
use App\Http\Controllers\Controller;
use App\Mail\ActivateService;
use App\Mail\UserActivated;
use App\Models\BankModel;
use App\Models\CompanyAdmisson;
use App\Models\CompanyProfile;
use App\Models\Country;
use App\Models\OffersModel;
use App\Models\ServiceRequests;
use App\Models\User;
use App\Notifications\UserAction;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Relationship;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use Yajra\DataTables\Facades\DataTables;

class WebsiteUsersController extends AdminBaseController
{

    public function getUsersDataByType($user_type)
    {
        $users = User::withAvg('rates', 'rating_value')
            ->where('user_type', $user_type);
        return DataTables::of($users)
            ->editColumn('created_at', function ($user) {
                return $user->created_at ? with(new Carbon($user->created_at))->format('Y-m-d') : '';
            })
            ->editColumn('profile_img', function ($user) {
                $profileImg = asset('adminAssets/assets/media/users/blank.png');
                if ($user->profile_img != null)
                    $profileImg = route('imagecache', ['template' => 'profile', 'filename' => $user->profile_img]);
                return  $profileImg;
            })
            ->addColumn('action', function ($user) {
                $userLink = route('admin.user.overview', ['userId' => $user->id]);
                $userActions = view('admin.templates.userActions', [
                    'user' => $user,
                    'userLink' => $userLink
                ])->render();
                $removeBtn = '<a href="#" class="btn btn-sm btn-clean btn-icon removeBtn" data-id="' . $user->id . '" title="حذف"><i class="la la-trash"></i></a>';


                return $userActions.$removeBtn;
            })
            ->make();
    }

    public function user_send_notification(Request $request)
    {
        // dd(/);
        $user = User::where('id', $request->only('userId'))->firstOrFail();

        $user->notify(new UserAction([
            'title' => $request->NotificationTitle,
            'message' => $request->NotificationMessage
        ]));

        return response()->json([
            'status' => true,
        ]);
    }

    public function request_delete(Request $request)
    {
        $user = User::where('id', $request->only('requestId'))
            ->first();

        if($user->operatorProfile() instanceof Relationship){
            $user->operatorProfile()->delete();
        }
        $user->user_services()->delete();
        $user->chatMsgs()->delete();
        $user->chatMsgsSn()->delete();
        $user->rates()->delete();
        $user->ratesR()->delete();
        $user->Service_requests()->delete();
        $user->jobs()->delete();
        $user->delete();

        return response()->json([
            'status' => true,
        ]);
    }

    public function user_overview(Request $request, $userId)
    {
        $user = User::where('id', $userId)
            ->withCount('rates')
            ->withAvg('rates', 'rating_value')
            ->first();


        $profileImg = 'style="background-image: url(' . asset('adminAssets/assets/media/users/blank.png') . ')"';
        if (isset($user->profile_img)) {
            $profileImg = 'style="background-image: url(' . route('imagecache', ['template' => 'profile', 'filename' => $user->profile_img]) . ')"';
        }

        if ($user->user_type == 'user') {
            $userProjects = ServiceRequests::where('user_id', $user->id)
                ->with('service_stage')
                ->with('service')
                ->orderByDesc('created_at')
                ->limit(8)
                ->get();
            return view('admin.users.viewUser', [
                'user' => $user,
                'profileImg' => $profileImg,
                'userProjects' => $userProjects,
                'currentPage' => 'overview'
            ]);
        } else {


            $userOffers = OffersModel::where('user_id', $user->id)
                ->with(['offer_status'])
                ->whereHas('request', function ($query) {
                    $query->select('id', 'service_request_stage_id', 'title', 'created_at')->with('service_stage');
                })
                ->limit(8)
                ->orderByDesc('created_at')
                ->get();
            // dd($userOffers );
            return view('admin.users.viewOperator', [
                'user' => $user,
                'profileImg' => $profileImg,
                'userOffers' => $userOffers,
                'currentPage' => 'overview'
            ]);
        }
    }

    public function user_update_active_status(Request $request)
    {


        $currentTime = Carbon::now();

        // if ($request->ajax()) {
        //     dd($request->all());
        // }

        $user = User::where('id', $request->only('userId'))->first();


        $is_new=0;
        if($user->confirmed == 0){
            $is_new=1;
        }

        $user->confirmed = $request->has('confirmed')  ? 1 : 0;

        if ($user->confirmed) {
            $user->notify(new UserAction([
                'title' => 'تم تفعيل حسابك!',
                'message' => 'يمكنك الان استخدام خدمات الموقع'
            ]));
            if($is_new){
                \Mail::to($user)->send(new UserActivated($user));

            }
        }

        $user->confirmed_date = $currentTime->toDateTimeString();
        $user->save();

        return redirect()->route('admin.user.details', ['userId' => $user->id])->with('success', 'تمت عملية الحفظ بنجاح');
    }

    public function GetUserDetails($userId)
    {
        $user = User::where('id', $userId)->first();

        $profileImg = 'style="background-image: url(' . asset('adminAssets/assets/media/users/blank.png') . ')"';
        if (isset($user->profile_img)) {
            $profileImg = 'style="background-image: url(' . route('imagecache', ['template' => 'profile', 'filename' => $user->profile_img]) . ')"';
        }
        // $userDetails = $this->GetUserDetails($userId);

        return (object) [
            'user' => $user,
            'profileImg' => $profileImg,
        ];
    }

    public function user_details(Request $request, $userId)
    {
        $userDetails = $this->GetUserDetails($userId);

        $fields = [
            (object) [
                'sectionName' => 'الملف الشخصي',
                'id' => 'confirmed',
                'title' => 'حالة الحساب',
                'type' => 'checkbox',
                'value' => $userDetails->user->confirmed
            ],
            (object) [
                'sectionName' => 'الملف الشخصي',
                'id' => 'id',
                'title' => 'id',
                'type' => 'id',
                'value' => $userDetails->user->id
            ],
            (object) [
                'sectionName' => 'الملف الشخصي',
                'id' => 'completed_profile',
                'title' => 'نسبة إدخال البيانات',
                'type' => 'progress',
                'value' => $userDetails->user->calculate_profile()
            ],
            (object) [
                'sectionName' => 'الملف الشخصي',
                'id' => 'name',
                'title' => 'الأسم',
                'type' => 'text',
                'value' => $userDetails->user->name
            ],
            (object) [
                'sectionName' => 'الملف الشخصي',
                'id' => 'nationality',
                'title' => 'الجنسية',
                'type' => 'text',
                'value' => $userDetails->user->nationality
            ],
            (object) [
                'sectionName' => 'الملف الشخصي',
                'id' => 'created_at',
                'title' => 'تاريخ الانشاء',
                'type' => 'text',
                'value' => $userDetails->user->created_at
            ],

            (object) [
                'sectionName' => 'الملف الشخصي',
                'id' => 'country',
                'title' => 'الدولة',
                'type' => 'text',
                'value' =>  Country::where('id', $userDetails->user->country_id)->select('name')->first()->name ?? ''
            ],

            (object) [
                'sectionName' => 'معلومات الاتصال',
                'id' => 'email',
                'title' => 'الايميل',
                'type' => 'text',
                'value' => $userDetails->user->email
            ],
            (object) [
                'sectionName' => 'الملف الشخصي',
                'id' => 'profile_img',
                'title' => 'الصورة الشخصية',
                'type' => 'image',
                'value' => $userDetails->user->profile_img
            ],
            (object) [
                'sectionName' => 'معلومات الاتصال',
                'id' => 'phone_number',
                'title' => 'رقم الجوال',
                'type' => 'text',
                'value' => '+' . $userDetails->user->country_code_phone_number . $userDetails->user->phone_number
            ],
            (object) [
                'sectionName' => 'معلومات الاتصال',
                'id' => 'whatsapp_number',
                'title' => 'رقم الواتسب',
                'type' => 'text',
                'value' => '+' . $userDetails->user->country_code_whatsapp . $userDetails->user->whatsapp_number
            ],
            (object) [
                'sectionName' => 'الملف الشخصي',
                'id' => 'confirmed_date',
                'title' => 'تاريخ حركة الحالة',
                'type' => 'text',
                'value' => $userDetails->user->confirmed_date
            ],


            (object) [
                'sectionName' => 'المعلومات البنكية',
                'id' => 'bank',
                'title' => 'الحساب البنكي',
                'type' => 'text',
                'value' => BankModel::where('id', $userDetails->user->bank_id)->select('name_ar')->first()->name_ar ?? ''
            ],
            (object) [
                'sectionName' => 'المعلومات البنكية',
                'id' => 'iban_code',
                'title' => 'رقم IBAN',
                'type' => 'text',
                'value' => $userDetails->user->iban_code
            ],

        ];

        $fields = collect($fields);

        if ($userDetails->user->user_type != "user") {
            $fields = $fields->filter(function ($item, $key) {
                if ($item->id != "nationality" && $item->id != "country")
                    return $item;
            });

            if ($userDetails->user->user_type == "company") {
                $fields =   $fields->concat($this->AppendCompanyData($userDetails->user));
            }

            if ($userDetails->user->user_type == "freelancer") {
                $fields =   $fields->concat($this->AppenedFreelancerData($userDetails->user));
            }
        }


        return view('admin.users.viewUserInformation', [
            'user' => $userDetails->user,
            'profileImg' => $userDetails->profileImg,
            'currentPage' => 'details',
            'fields' => $fields->groupBy('sectionName')
        ]);
    }


    public function user_company_license(Request $request, $userId)
    {
        if ($request->isMethod('POST')) {
            $currentTime = Carbon::now();
            $user = User::where('id', $userId)->first();
            // $companyProfile= CompanyProfile::where('user_id',$user->id);
            $user->operatorProfile->licence_confirmed = $request->only('licence_confirmed') != null ? true : false;
            $user->operatorProfile->licence_confirmed_date = $currentTime->toDateTimeString();
            $user->operatorProfile->save();

            if ($user->operatorProfile->licence_confirmed) {
                $user->notify(new UserAction([
                    'title' => 'تم اعتماد رخصة مزاولة المهنة الهندسية!',
                    'message' => 'شكراً لك !'
                ]));
            }

            return redirect()->route('admin.company.license', ['userId' => $user->id])->with('success', 'تمت عملية الحفظ بنجاح');
        }

        if ($request->isMethod('GET')) {
            $userDetails = $this->GetUserDetails($userId);
            $profile = $userDetails->user->operatorProfile;

            $fields = [
                (object) [
                    'sectionName' => 'الترخيص',
                    'id' => 'licence_confirmed',
                    'title' => 'حالة الاعتماد',
                    'type' => 'checkbox',
                    'value' => $profile->licence_confirmed
                ],
                (object) [
                    'sectionName' => 'الترخيص',
                    'id' => 'licensenumber',
                    'title' => 'رقم السجل التجاري',
                    'type' => 'text',
                    'value' => $profile->licensenumber
                ],
                (object) [
                    'sectionName' => 'الترخيص',
                    'id' => 'licence_copy_fileName',
                    'title' => 'رخصة مزاولة المهنة',
                    'type' => 'link',
                    'value' => asset('company/' . $profile->license_copy),
                    'text' => $profile->licence_copy_fileName
                ],
                (object) [
                    'sectionName' => 'الترخيص',
                    'id' => 'licence_confirmed_date',
                    'title' => 'تاريخ الحركة',
                    'type' => 'text',
                    'value' => $profile->licence_confirmed_date
                ],
            ];

            $fields = collect($fields);

            return view('admin.users.viewComapnyLicense', [
                'user' => $userDetails->user,
                'profileImg' => $userDetails->profileImg,
                'currentPage' => 'companylic',
                'fields' => $fields->groupBy('sectionName')
            ]);
        }
    }


    public function user_freelancer_membership(Request $request, $userId)
    {
        if ($request->isMethod('POST')) {
            $currentTime = Carbon::now();
            $user = User::where('id', $userId)->first();
            $user->operatorProfile->membership_confirmed = $request->only('membership_confirmed') != null ? true : false;
            $user->operatorProfile->membership_confirmed_date = $currentTime->toDateTimeString();
            $user->operatorProfile->save();
            if ($user->operatorProfile->membership_confirmed) {
                $user->notify(new UserAction([
                    'title' => 'تم اعتماد عضويتك الهندسية!',
                    'message' => 'شكراً لك !'
                ]));
            }


            return redirect()->route('admin.freelancer.membership', ['userId' => $user->id])->with('success', 'تمت عملية الحفظ بنجاح');
        }

        if ($request->isMethod('GET')) {

            $userDetails = $this->GetUserDetails($userId);
            $profile = $userDetails->user->operatorProfile;

            $fields = [
                (object) [
                    'sectionName' => 'عضوية الهيئة السعودية للمهندسين',
                    'id' => 'membership_confirmed',
                    'title' => 'حالة الاعتماد',
                    'type' => 'checkbox',
                    'value' => $profile->membership_confirmed
                ],
                (object) [
                    'sectionName' => 'عضوية الهيئة السعودية للمهندسين',
                    'id' => 'membershipId',
                    'title' => 'رقم السجل المدني',
                    'type' => 'text',
                    'value' => $profile->membershipId
                ],
                (object) [
                    'sectionName' => 'عضوية الهيئة السعودية للمهندسين',
                    'id' => 'membership_copy_filename',
                    'title' => 'شهادة التصنيف المهني',
                    'type' => 'link',
                    'value' => asset('freelancer/' . $profile->membership_copy),
                    'text' => $profile->membership_copy_filename
                ],
                (object) [
                    'sectionName' => 'عضوية الهيئة السعودية للمهندسين',
                    'id' => 'membership_confirmed_date',
                    'title' => 'تاريخ الحركة',
                    'type' => 'text',
                    'value' => $profile->membership_confirmed_date
                ],
            ];

            $fields = collect($fields);

            return view('admin.users.viewFreelancerMemberShip', [
                'user' => $userDetails->user,
                'profileImg' => $userDetails->profileImg,
                'currentPage' => 'freelancerMemberShip',
                'fields' => $fields->groupBy('sectionName')
            ]);
        }
    }


    public function user_company_arbitration(Request $request, $userId)
    {
        if ($request->isMethod('POST')) {

            $currentTime = Carbon::now();
            $user = User::where('id', $userId)->first();

            $user->operatorProfile->arbitrationcert_request_status = 0;
            $user->operatorProfile->arbitrationcert_confirmed = $request->only('arbitrationcert_confirmed') != null ? true : false;
            $user->operatorProfile->arbitrationcert_confirmed_date = $currentTime->toDateTimeString();
            if ($user->operatorProfile->arbitrationcert_confirmed) {
                $user->notify(new UserAction([
                    'title' => 'تم تفعيل خدمة التحكيم!',
                    'message' => 'يمكنك الان استخدام خدمة التحكيم بنجاح!'
                ]));
            }

            $user->operatorProfile->save();
            \Mail::to($user)->send(new ActivateService('التحكيم'));
            return redirect()->route('admin.company.arbitration', ['userId' => $user->id])->with('success', 'تمت عملية الحفظ بنجاح');
        }

        if ($request->isMethod('GET')) {
            $userDetails = $this->GetUserDetails($userId);
            $profile = $userDetails->user->operatorProfile;

            $fields = [
                (object) [
                    'sectionName' => 'خدمة التحكيم',
                    'id' => 'arbitrationcert_request_status',
                    'title' => 'حالة الطلب',
                    'type' => 'text',
                    'value' => $profile->arbitrationcert_request_status
                ],
                (object) [
                    'sectionName' => 'خدمة التحكيم',
                    'id' => 'arbitration_cert_copy',
                    'title' => 'ملف شهادة التحكيم',
                    'type' => 'link',
                    'value' => $profile->arbitration_cert_copy ?  asset('company/' . $profile->arbitration_cert_copy) : "#",
                    'text' => 'عرض الملف'
                ],
                (object) [
                    'sectionName' => 'خدمة التحكيم',
                    'id' => 'arbitrationcert_confirmed',
                    'title' => 'حالة الاعتماد',
                    'type' => 'checkbox',
                    'value' => $profile->arbitrationcert_confirmed
                ],
                (object) [
                    'sectionName' => 'خدمة التحكيم',
                    'id' => 'arbitrationcert_confirmed_date',
                    'title' => 'تاريخ الحركة',
                    'type' => 'text',
                    'value' => $profile->arbitrationcert_confirmed_date
                ],
            ];

            $fields = collect($fields);

            return view('admin.users.viewComapnyArbitration', [
                'user' => $userDetails->user,
                'profileImg' => $userDetails->profileImg,
                'currentPage' => 'companyarb',
                'fields' => $fields->groupBy('sectionName')
            ]);
        }
    }

    public function user_company_testQuality(Request $request, $userId)
    {
        if ($request->isMethod('POST')) {

            $currentTime = Carbon::now();
            $user = User::where('id', $userId)->first();

            $user->operatorProfile->test_quality_request_status = 0;
            $user->operatorProfile->test_quality_confirmed = $request->only('arbitrationcert_confirmed') != null ? true : false;
//            $user->operatorProfile->arbitrationcert_confirmed_date = $currentTime->toDateTimeString();
            if ($user->operatorProfile->test_quality_confirmed) {
                $user->notify(new UserAction([
                    'title' => 'تم تفعيل خدمات فحص الجودة!',
                    'message' => 'يمكنك الان استخدام خدمات فحص الجودة بنجاح!'
                ]));
            }

            $user->operatorProfile->save();
            \Mail::to($user)->send(new ActivateService('فحص الجودة'));


            return redirect()->route('admin.company.testQuality', ['userId' => $user->id])->with('success', 'تمت عملية الحفظ بنجاح');
        }

        if ($request->isMethod('GET')) {
            $userDetails = $this->GetUserDetails($userId);
            $profile = $userDetails->user->operatorProfile;

            $fields = [
                (object) [
                    'sectionName' => 'خدمات فحص الجودة',
                    'id' => 'arbitrationcert_request_status',
                    'title' => 'حالة الطلب',
                    'type' => 'text',
                    'value' => $profile->test_quality_request_status
                ],
                (object) [
                    'sectionName' => 'خدمات فحص الجودة',
                    'id' => 'arbitration_cert_copy',
                    'title' => 'ملف شهادة فحص جودة البناء',
                    'type' => 'link',
                    'value' => $profile->test_quality_cert_copy ?  asset('freelancer/' . $profile->test_quality_cert_copy) : "#",
                    'text' => 'عرض الملف'
                ],
                (object) [
                    'sectionName' => 'خدمات فحص الجودة',
                    'id' => 'arbitration_cert_copy',
                    'title' => 'ملف شهادة التأمين المهني',
                    'type' => 'link',
                    'value' => $profile->insurance_copy ?  asset('freelancer/' . $profile->insurance_copy) : "#",
                    'text' => 'عرض الملف'
                ],
                (object) [
                    'sectionName' => 'خدمة التحكيم',
                    'id' => 'arbitrationcert_confirmed',
                    'title' => 'حالة الاعتماد',
                    'type' => 'checkbox',
                    'value' => $profile->test_quality_confirmed
                ],
            ];

            $fields = collect($fields);

            return view('admin.users.viewComapnyArbitration', [
                'user' => $userDetails->user,
                'profileImg' => $userDetails->profileImg,
                'currentPage' => 'testQuality',
                'fields' => $fields->groupBy('sectionName')
            ]);
        }
    }

    public function user_company_testBuild(Request $request, $userId)
    {
        if ($request->isMethod('POST')) {

            $currentTime = Carbon::now();
            $user = User::where('id', $userId)->first();

            $user->operatorProfile->test_build_request_status = 0;
            $user->operatorProfile->test_build_confirmed = $request->only('arbitrationcert_confirmed') != null ? true : false;
//            $user->operatorProfile->arbitrationcert_confirmed_date = $currentTime->toDateTimeString();
            if ($user->operatorProfile->test_build_confirmed) {
                $user->notify(new UserAction([
                    'title' => 'تم تفعيل خدمة فحص المباني الجاهزة!',
                    'message' => 'يمكنك الان استخدام خدمة فحص المباني الجاهزة بنجاح!'
                ]));
            }

            $user->operatorProfile->save();
            \Mail::to($user)->send(new ActivateService('فحص المباني الجاهزة'));
            return redirect()->route('admin.company.testBuild', ['userId' => $user->id])->with('success', 'تمت عملية الحفظ بنجاح');
        }

        if ($request->isMethod('GET')) {
            $userDetails = $this->GetUserDetails($userId);
            $profile = $userDetails->user->operatorProfile;

            $fields = [
                (object) [
                    'sectionName' => 'خدمة فحص المباني الجاهزة',
                    'id' => 'arbitrationcert_request_status',
                    'title' => 'حالة الطلب',
                    'type' => 'text',
                    'value' => $profile->test_build_request_status
                ],
                (object) [
                    'sectionName' => 'خدمة فحص المباني الجاهزة',
                    'id' => 'arbitration_cert_copy',
                    'title' => 'ملف شهادة فحص المباني الجاهزة',
                    'type' => 'link',
                    'value' => $profile->test_build_cert_copy ?  asset('freelancer/' . $profile->test_build_cert_copy) : "#",
                    'text' => 'عرض الملف'
                ],
                (object) [
                    'sectionName' => 'خدمة فحص المباني الجاهزة',
                    'id' => 'arbitrationcert_confirmed',
                    'title' => 'حالة الاعتماد',
                    'type' => 'checkbox',
                    'value' => $profile->test_build_confirmed
                ],
            ];

            $fields = collect($fields);


            return view('admin.users.viewComapnyArbitration', [
                'user' => $userDetails->user,
                'profileImg' => $userDetails->profileImg,
                'currentPage' => 'testBuild',
                'fields' => $fields->groupBy('sectionName')
            ]);
        }
    }

    public function AppendCompanyData($user)
    {

        $profile = $user->operatorProfile;

        $fields = [
            (object) [
                'sectionName' => 'الترخيص',
                'id' => 'licensenumber',
                'title' => 'رقم السجل التجاري',
                'type' => 'text',
                'value' => $profile->licensenumber
            ],
            (object) [
                'sectionName' => 'الترخيص',
                'id' => 'license_copy',
                'title' => 'رخصة مزاولة المهنة',
                'type' => 'link',
                'value' => asset('company/' . $profile->license_copy),
                'text' => $profile->licence_copy_fileName
            ],
            (object) [
                'sectionName' => 'الترخيص',
                'id' => 'licence_confirmed',
                'title' => 'حالة اعتماد الترخيص الهندسي',
                'type' => 'checkbox',
                'value' => $profile->licence_confirmed
            ],
            (object) [
                'sectionName' => 'الترخيص',
                'id' => 'licence_confirmed',
                'title' => 'تاريخ الحركة',
                'type' => 'text',
                'value' => $profile->licence_confirmed_date
            ],
            (object) [
                'sectionName' => 'بيانات المكتب الهندسي',
                'id' => 'area',
                'title' => 'المنطقة',
                'type' => 'text',
                'value' => $profile->area
            ],
            (object) [
                'sectionName' => 'بيانات المكتب الهندسي',
                'id' => 'city',
                'title' => 'المدينة',
                'type' => 'text',
                'value' => $profile->city
            ],
            (object) [
                'sectionName' => 'الملف الشخصي',
                'id' => 'bio_text',
                'title' => 'السيرة الذاتية',
                'type' => 'textarea',
                'value' => $profile->bio_text
            ],
            (object) [
                'sectionName' => 'بيانات الشركة',
                'id' => 'owner_name',
                'title' => 'أسم مالك المكتب الهندسي',
                'type' => 'text',
                'value' => $profile->owner_name
            ],
            (object) [
                'sectionName' => 'بيانات الشركة',
                'id' => 'contact_person_name',
                'title' => 'اسم مسئول التواصل',
                'type' => 'text',
                'value' => $profile->contact_person_name
            ],
            (object) [
                'sectionName' => 'معلومات الاتصال',
                'id' => 'company_twitter',
                'title' => 'رابط تويتر',
                'type' => 'text',
                'value' => $profile->company_twitter
            ],
            (object) [
                'sectionName' => 'معلومات الاتصال',
                'id' => 'company_facebook',
                'title' => 'رابط فيس بوك',
                'type' => 'text',
                'value' => $profile->company_facebook
            ],
            (object) [
                'sectionName' => 'معلومات الاتصال',
                'id' => 'company_instagram',
                'title' => 'رابط الانستجرام',
                'type' => 'text',
                'value' => $profile->company_instagram
            ],
            (object) [
                'sectionName' => 'نوع الاعتماد',
                'id' => 'company_admission_id',
                'title' => '',
                'type' => 'text',
                'value' => CompanyAdmisson::where('id', $profile->company_admission_id)->select('name')->first()->name ?? ''
            ],
        ];


        return $fields;
    }

    public function AppenedFreelancerData($user)
    {
        $profile = $user->operatorProfile;

        $fields = [
            (object) [
                'sectionName' => 'عضوية النقابة الهندسية',
                'id' => 'membershipId',
                'title' => 'رقم العضوية',
                'type' => 'text',
                'value' => $profile->membershipId
            ],
            (object) [
                'sectionName' => 'عضوية النقابة الهندسية',
                'id' => 'membership_copy',
                'title' => 'ملف بطاقة العضوية',
                'type' => 'link',
                'value' => asset('freelancer/' . $profile->membership_copy),
                'text' => $profile->membership_copy_filename
            ],
            (object) [
                'sectionName' => 'عضوية النقابة الهندسية',
                'id' => 'membership_confirmed',
                'title' => 'حالة الاعتماد',
                'type' => 'checkbox',
                'value' => $profile->membership_confirmed
            ],
            (object) [
                'sectionName' => 'عضوية النقابة الهندسية',
                'id' => 'membership_confirmed_date',
                'title' => 'تاريخ الحركة',
                'type' => 'text',
                'value' => $profile->membership_confirmed_date
            ],
            (object) [
                'sectionName' => 'الملف الشخصي',
                'id' => 'occupation',
                'title' => 'الوظيفة',
                'type' => 'text',
                'value' => $profile->occupation_text
            ],
            (object) [
                'sectionName' => 'معلومات الاتصال',
                'id' => 'area',
                'title' => 'المنطقة',
                'type' => 'text',
                'value' => $profile->area
            ],
            (object) [
                'sectionName' => 'معلومات الاتصال',
                'id' => 'city',
                'title' => 'المدينة',
                'type' => 'text',
                'value' => $profile->city
            ],
            (object) [
                'sectionName' => 'الملف الشخصي',
                'id' => 'bio_text',
                'title' => 'السيرة الذاتية',
                'type' => 'textarea',
                'value' => $profile->bio_text
            ],
            (object) [
                'sectionName' => 'معلومات الاتصال',
                'id' => 'freelancer_twitter',
                'title' => 'رابط تويتر',
                'type' => 'text',
                'value' => $profile->freelancer_twitter
            ],
            (object) [
                'sectionName' => 'معلومات الاتصال',
                'id' => 'freelancer_facebook',
                'title' => 'رابط الفيس بوك',
                'type' => 'text',
                'value' => $profile->freelancer_facebook
            ],
            (object) [
                'sectionName' => 'معلومات الاتصال',
                'id' => 'freelancer_instagram',
                'title' => 'رابط الانستجرام',
                'type' => 'text',
                'value' => $profile->freelancer_instagram
            ],
            (object) [
                'sectionName' => 'نوع الاعتماد',
                'id' => 'admission_id',
                'title' => '',
                'type' => 'text',
                'value' => CompanyAdmisson::where('id', $profile->admission_id)->select('name')->first()->name ?? ''
            ],

        ];

        return $fields;
    }

    public function users_list(Request $request)
    {
        if ($request->isMethod('post')) {
            return $this->getUsersDataByType('user');
        }
        if ($request->isMethod('get')) {
            $dataURL = route('admin.users.list');
            $cardTitle = "المستخدمين";
            return view('admin.users.usersList', [
                'dataURL' => $dataURL,
                'export_url' => 'admin.users.export',
                'cardTitle' => $cardTitle
            ]);
        }
    }

    public function companies_list(Request $request)
    {
        if ($request->isMethod('post')) {
            return $this->getUsersDataByType('company');
        }
        if ($request->isMethod('get')) {
            $dataURL = route('admin.companies.list');
            $cardTitle = "مكاتب هندسية";
            return view('admin.users.usersList', [
                'dataURL' => $dataURL,
                'export_url' => 'admin.companies.export',
                'cardTitle' => $cardTitle
            ]);
        }
    }

    public function companies_export(Request $request)
    {

     $users = User::withAvg('rates', 'rating_value')
           ->where('user_type', 'company')->get();


//       dd($users);

        $spreadsheet = new Spreadsheet();

// Set document properties
        $spreadsheet->getProperties()->setCreator('engsapp.net')
            ->setLastModifiedBy('engsapp.net')
            ->setTitle('compoanies Exported')
            ->setSubject('compoanies')
            ->setDescription('compoanies')
            ->setKeywords('office 2007 openxml php')
            ->setCategory('compoanies');
// Add some data

        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A1', '#')
            ->setCellValue('B1', 'الاسم ')
            ->setCellValue('C1', 'الايميل')
            ->setCellValue('D1', 'الجوال')
            ->setCellValue('E1', 'تاريخ الانظمام')
            ->setCellValue('F1', 'رقم السجل التجاري')
            ->setCellValue('G1', 'رخصة مزاولة المهنة')
            ->setCellValue('H1', 'حالة اعتماد الترخيص الهندسي')
            ->setCellValue('I1', 'تاريخ اعتماد الترخيص الهندسي')
            ->setCellValue('J1', 'المنطقة')
            ->setCellValue('K1', 'المدينة')
            ->setCellValue('L1', 'السيرة الذاتية')
            ->setCellValue('M1', 'أسم مالك المكتب الهندسي')
            ->setCellValue('N1', 'اسم مسئول التواصل')
            ->setCellValue('O1', 'رابط تويتر')
            ->setCellValue('P1', 'رابط فيس بوك')
            ->setCellValue('Q1', 'رابط الانستجرام')
            ->setCellValue('R1', 'نوع الاعتماد');


        $spreadsheet->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('I')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('J')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('K')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('L')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('M')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('N')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('O')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('P')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('Q')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('R')->setAutoSize(true);
        $i=2;
        foreach ($users as $o){
            $other=$this->AppendCompanyData($o);
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A'.$i, $i-1)
                ->setCellValue('B'.$i, $o->name)
                ->setCellValue('C'.$i, $o->email)
                ->setCellValue('D'.$i, $o->phone_number)
                ->setCellValue('E'.$i, $o->created_at)
                ->setCellValue('F'.$i, $other[0]?$other[0]->value:'')
                ->setCellValue('G'.$i, $other[1]?$other[1]->value:'')
                ->setCellValue('H'.$i, $other[2]?$other[2]->value==1?'معتمد':'غير معتمد':'')
                ->setCellValue('I'.$i, $other[3]?$other[3]->value:'')
                ->setCellValue('J'.$i, $other[4]?$other[4]->value:'')
                ->setCellValue('K'.$i, $other[5]?$other[5]->value:'')
                ->setCellValue('L'.$i, $other[6]?$other[6]->value:'')
                ->setCellValue('M'.$i, $other[7]?$other[7]->value:'')
                ->setCellValue('N'.$i, $other[8]?$other[8]->value:'')
                ->setCellValue('O'.$i, $other[9]?$other[9]->value:'')
                ->setCellValue('P'.$i, $other[10]?$other[10]->value:'')
                ->setCellValue('Q'.$i, $other[11]?$other[11]->value:'')
                ->setCellValue('R'.$i, $other[12]?$other[12]->value:'');


            $i++;

        }


// Rename worksheet
        $spreadsheet->getActiveSheet()->setTitle('Companies Exported');

// Set active sheet index to the first sheet, so Excel opens this as the first sheet
        $spreadsheet->setActiveSheetIndex(0);

// Redirect output to a client’s web browser (Xlsx)
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="Companies Exported.xlsx"');
        header('Cache-Control: max-age=0');
// If you're serving to IE 9, then the following may be needed
        header('Cache-Control: max-age=1');

// If you're serving to IE over SSL, then the following may be needed
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
        header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
        header('Pragma: public'); // HTTP/1.0

        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save('php://output');
        exit;


    }

    public function freelancer_export(Request $request)
    {

     $users = User::withAvg('rates', 'rating_value')
           ->where('user_type', 'freelancer')->get();


//       dd($users);

        $spreadsheet = new Spreadsheet();

// Set document properties
        $spreadsheet->getProperties()->setCreator('engsapp.net')
            ->setLastModifiedBy('engsapp.net')
            ->setTitle('Freelancers Exported')
            ->setSubject('Freelancers')
            ->setDescription('Freelancers')
            ->setKeywords('office 2007 openxml php')
            ->setCategory('Freelancers');
// Add some data

        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A1', '#')
            ->setCellValue('B1', 'الاسم ')
            ->setCellValue('C1', 'الايميل')
            ->setCellValue('D1', 'الجوال')
            ->setCellValue('E1', 'تاريخ الانظمام')
            ->setCellValue('F1', 'عضوية النقابة الهندسية')
            ->setCellValue('G1', 'ملف بطاقة العضوية')
            ->setCellValue('H1', 'حالة الاعتماد')
            ->setCellValue('I1', 'تاريخ الاعتماد')
            ->setCellValue('J1', 'الوظيفة')
            ->setCellValue('K1', 'المنطقة')
            ->setCellValue('L1', 'المدينة')
            ->setCellValue('M1', 'السيرة الذاتية')
            ->setCellValue('N1', 'رابط تويتر')
            ->setCellValue('O1', 'رابط الفيس بوك')
            ->setCellValue('P1', 'رابط الانستجرام')
            ->setCellValue('Q1', 'نوع الاعتماد');


        $spreadsheet->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('I')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('J')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('K')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('L')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('M')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('N')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('O')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('P')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('Q')->setAutoSize(true);
        $i=2;
        foreach ($users as $o){
            $other=$this->AppenedFreelancerData($o);
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A'.$i, $i-1)
                ->setCellValue('B'.$i, $o->name)
                ->setCellValue('C'.$i, $o->email)
                ->setCellValue('D'.$i, $o->phone_number)
                ->setCellValue('E'.$i, $o->created_at)
                ->setCellValue('F'.$i, $other[0]?$other[0]->value:'')
                ->setCellValue('G'.$i, $other[1]?$other[1]->value:'')
                ->setCellValue('H'.$i, $other[2]?$other[2]->value==1?'معتمد':'غير معتمد':'')
                ->setCellValue('I'.$i, $other[3]?$other[3]->value:'')
                ->setCellValue('J'.$i, $other[4]?$other[4]->value:'')
                ->setCellValue('K'.$i, $other[5]?$other[5]->value:'')
                ->setCellValue('L'.$i, $other[6]?$other[6]->value:'')
                ->setCellValue('M'.$i, $other[7]?$other[7]->value:'')
                ->setCellValue('N'.$i, $other[8]?$other[8]->value:'')
                ->setCellValue('O'.$i, $other[9]?$other[9]->value:'')
                ->setCellValue('P'.$i, $other[10]?$other[10]->value:'')
                ->setCellValue('Q'.$i, $other[11]?$other[11]->value:'');


            $i++;

        }


// Rename worksheet
        $spreadsheet->getActiveSheet()->setTitle('Freelancers Exported');

// Set active sheet index to the first sheet, so Excel opens this as the first sheet
        $spreadsheet->setActiveSheetIndex(0);

// Redirect output to a client’s web browser (Xlsx)
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="Freelancers Exported.xlsx"');
        header('Cache-Control: max-age=0');
// If you're serving to IE 9, then the following may be needed
        header('Cache-Control: max-age=1');

// If you're serving to IE over SSL, then the following may be needed
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
        header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
        header('Pragma: public'); // HTTP/1.0

        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save('php://output');
        exit;


    }


    public function users_export(Request $request)
    {

     $users = User::withAvg('rates', 'rating_value')
           ->where('user_type', 'user')->get();


//       dd($users);

        $spreadsheet = new Spreadsheet();

// Set document properties
        $spreadsheet->getProperties()->setCreator('engsapp.net')
            ->setLastModifiedBy('engsapp.net')
            ->setTitle('Users Exported')
            ->setSubject('Users')
            ->setDescription('Users')
            ->setKeywords('office 2007 openxml php')
            ->setCategory('Users');
// Add some data

        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A1', '#')
            ->setCellValue('B1', 'الاسم ')
            ->setCellValue('C1', 'الايميل')
            ->setCellValue('D1', 'تاريخ الانظمام');


        $spreadsheet->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('I')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('J')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('K')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('L')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('M')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('N')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('O')->setAutoSize(true);
        $spreadsheet->getActiveSheet()->getColumnDimension('P')->setAutoSize(true);
        $i=2;
        foreach ($users as $o){
//            $other=$this->AppendFreelancerData($o);
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A'.$i, $i-1)
                ->setCellValue('B'.$i, $o->name)
                ->setCellValue('C'.$i, $o->email)
                ->setCellValue('D'.$i, $o->created_at);


            $i++;

        }


// Rename worksheet
        $spreadsheet->getActiveSheet()->setTitle('Users Exported');

// Set active sheet index to the first sheet, so Excel opens this as the first sheet
        $spreadsheet->setActiveSheetIndex(0);

// Redirect output to a client’s web browser (Xlsx)
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="Users Exported.xlsx"');
        header('Cache-Control: max-age=0');
// If you're serving to IE 9, then the following may be needed
        header('Cache-Control: max-age=1');

// If you're serving to IE over SSL, then the following may be needed
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
        header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
        header('Pragma: public'); // HTTP/1.0

        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save('php://output');
        exit;


    }


    public function freelancers_list(Request $request)
    {
        if ($request->isMethod('post')) {
            return $this->getUsersDataByType('freelancer');
        }
        if ($request->isMethod('get')) {
            $dataURL = route('admin.freelancers.list');
            $cardTitle = "المستقلين";
            return view('admin.users.usersList', [
                'dataURL' => $dataURL,
                'export_url' => 'admin.freelancers.export',
                'cardTitle' => $cardTitle
            ]);
        }
    }
}
