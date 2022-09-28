<?php

namespace App\Http\Controllers;

use App\Mail\NewRegister;
use App\Models\CompanyAdmisson;
use App\Models\CompanyProfile;
use App\Models\Country;
use App\Models\FreelancerProfile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class RegisterController extends FrontBaseController
{
    public function index()
    {
        $countriesCode = Country::all();
        $companyAdmissions = CompanyAdmisson::all();
        return view('auth.register', [
            'countriesCode' => $countriesCode,
            'defaultCode' => '966',
            'companyAdmissions' => $companyAdmissions
        ]);
    }


    public function register_user(Request $request)
    {
        $request->validateWithBag('user', [
            'nameforuser' => 'required|string',
            'useremail' => ['required','email',Rule::unique('users','email')->where('user_type','user')],
            'usermobilenumber' => ['required',Rule::unique('users','phone_number')->where('user_type','user')],
            'userpassword' => 'required|string'
        ], ['useremail.unique' => 'الايميل المدخل موجود مسبقاً']);

        $user = new User();
        $user->name = $request->nameforuser;
        $user->email = $request->useremail;
        $user->password = Hash::make($request->userpassword);
        $user->country_code_phone_number = $request->usermobilecountrycode;
        $user->phone_number = $request->usermobilenumber;
        $user->confirmed = true;
        $user->user_type = 'user';

        $user->save();

        Auth::login($user);

        $this->NotifyAdminUsers([
            'title' => 'مستخدم جديد !',
            'message' => 'قام ' . $user->name . ' بالانظمام الى قائمة المستخدمين للموقع'
        ]);

        return  redirect()->route('user.userDashboard')->with('status', 'user has been registered!');
    }


    public function register_company(Request $request)
    {
        $request->validateWithBag('company', [
            'companyname' => 'required',
            'companyemail' => ['required','email',Rule::unique('users','email')->where('user_type','company')],
            'mobilenumber' => ['required',Rule::unique('users','phone_number')->where('user_type','company')],
            'licencenumber' => 'required',
            'companylicencefile' => 'required|mimes:png,jpg,pdf',
            'admissiontype' => 'required',
            'companypassword' => 'required',
        ], ['companyemail.unique' => 'الايميل المدخل موجود مسبقاً']);
        $company = new User();
        DB::transaction(function () use ($request, $company) {

            $company->name = $request->companyname;
            $company->email = $request->companyemail;
            $company->password = Hash::make($request->companypassword);
            $company->country_code_phone_number = $request->companymobilecountrycode;
            $company->phone_number = $request->mobilenumber;
            $company->confirmed = 0;
            $company->user_type = 'company';

            $company->save();

            $companyProfile = new CompanyProfile();

            $request->companylicencefile->store('company');

            $companyProfile->licensenumber = $request->licencenumber;
            $companyProfile->license_copy = $request->companylicencefile->hashName();
            $companyProfile->licence_copy_fileName = $request->companylicencefile->getClientOriginalName();
            $companyProfile->company_admission_id = $request->admissiontype;
            $companyProfile->user_id = $company->id;

            $companyProfile->save();
        });

        \Mail::to('engsapp@gmail.com')->cc('haljohani85@gmail.com')->send(new NewRegister('مكتب هندسي',$company));

//        Auth::login($company);


        $this->NotifyAdminUsers([
            'title' => 'مكتب هندسي جديد ! !',
            'message' => 'قامت ' . $company->name . ' بالانظمام الى قائمة المكاتب الهندسية للموقع'
        ]);

                    return redirect()->route('auth.login')->with('warning', '  سيتم تفعيل حسابك من قبل إدارة الموقع بعد التأكد من البيانات يرجى متابعة البريد الإلكتروني');
    }

    public function register_freelancer(Request $request)
    {
        $request->validateWithBag('freelancer', [
            'freelancername' => 'required',
            'freelanceremail' => ['required','email',Rule::unique('users','email')->where('user_type','freelancer')],
            'freelancermobilenumber' => ['required',Rule::unique('users','phone_number')->where('user_type','freelancer')],
            'membershipid' => 'required',
            'occupation' => 'required',
            'membershipattachment' => 'required|mimes:png,jpg,pdf',
            'freelancepassword' => 'required',
        ], ['freelanceremail.unique' => 'الايميل المدخل موجود مسبقاً']);

        $freelancer = new User();

        DB::transaction(function () use ($request, $freelancer) {
            $freelancer->name = $request->freelancername;
            $freelancer->email = $request->freelanceremail;
            $freelancer->password = Hash::make($request->freelancepassword);
            $freelancer->country_code_phone_number = $request->freelancermobilecountrycode;
            $freelancer->phone_number = $request->freelancermobilenumber;
            $freelancer->confirmed = 0;
            $freelancer->user_type = 'freelancer';

            $freelancer->save();

            $freelancerProfile = new FreelancerProfile();

            $request->membershipattachment->store('freelancer');
            $freelancerProfile->membershipId = $request->membershipid;
            $freelancerProfile->membership_copy = $request->membershipattachment->hashName();
            $freelancerProfile->membership_copy_filename = $request->membershipattachment->getClientOriginalName();
            $freelancerProfile->occupation = $request->occupation;
            $freelancerProfile->admission_id = $request->admissiontype;
            $freelancerProfile->user_id = $freelancer->id;
            $freelancerProfile->save();
        });

                \Mail::to('engsapp@gmail.com')->cc('haljohani85@gmail.com')->send(new NewRegister('مستقل',$freelancer));

//        Auth::login($freelancer);

        $this->NotifyAdminUsers([
            'title' => 'مستقل جديد ! !',
            'message' => 'قام ' . $freelancer->name . ' بالانظمام الى قائمة المستقليين للموقع'
        ]);

                    return redirect()->route('auth.login')->with('warning', '  سيتم تفعيل حسابك من قبل إدارة الموقع بعد التأكد من البيانات يرجى متابعة البريد الإلكتروني');

     }
}
