<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminBaseController;
use App\Models\Admin;
use App\Models\ContactUs;
use App\Models\WebsiteLinksModel;
use App\Models\WebsitePercModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Permission;
use Yajra\DataTables\Facades\DataTables;

class DashboardController extends AdminBaseController
{
    public function dashboard(Request $request)
    {
//        $admin_user =  Auth::guard('admin')->user();
//        $permissions = Permission::pluck('id');
//        $admin_user->syncPermissions($permissions);
        $totalRequests = DB::table('requests')
            ->selectRaw('count(*) as total')
            ->selectRaw("count(case when service_id = '1' then 1 end) as projects")
            ->selectRaw("count(case when service_id = '2' then 1 end) as consult")
            ->selectRaw("count(case when service_id = '4' then 1 end) as visit")
            ->selectRaw("count(case when service_request_stage_id = '1' then 1 end) as waiting")
            ->selectRaw("count(case when service_request_stage_id = '3' then 1 end) as implementation")
            ->selectRaw("count(case when service_request_stage_id = '4' then 1 end) as delivering")
            ->selectRaw("count(case when service_request_stage_id = '5' then 1 end) as completed")
            ->selectRaw("count(case when service_request_stage_id = '6' then 1 end) as canceled")
            ->first();

        // $totalContactNewMsgs = DB::table('contact_us')
        //     // ->selectRaw('count(*) as total')
        //     ->where('isread', false)
        //     ->count();


        $totalUsers = DB::table('users')
            ->selectRaw('count(*) as total')
            ->selectRaw("count(case when user_type = 'company' then 1 end) as companies")
            ->selectRaw("count(case when user_type = 'freelancer' then 1 end) as freelancers")
            ->selectRaw("count(case when user_type = 'user' then 1 end) as users")
            ->where('user_type', '!=', 'admin')
            ->first();

        $totalOffers = DB::table('offers')
            ->selectRaw('count(*) as total')
            ->selectRaw("sum(case when offer_status_id = '1' then offer_price_total else 0 end) as waiting")
            ->selectRaw("sum(case when offer_status_id = '2' then offer_price_total else 0 end) as accepted")
            ->selectRaw("sum(case when offer_status_id = '4' then offer_price_total else 0 end) as completed")
            ->first();

        // dd($totalOffers);

        return view('admin.dashboard', [
            'totalRequests' => $totalRequests,
            // 'totalContactUs' => $totalContactNewMsgs,
            'totalUsers' => $totalUsers,
            'totalOffers' => $totalOffers
        ]);
    }

    public function admin_notifications(Request $request)
    {

        $selectedNotifications = auth()->user()
            ->unreadNotifications
            ->whereIn('id', $request->notifications);
        $selectedNotifications->markAsRead();

        return $this->userAdminNotification($request);
    }

    public function userAdminNotification(Request $request)
    {
        $request->user()->refresh();
        $unreadNotificationList = view('layouts.admin.partials._extras.dropdown.unreadNotificationItem', [
            'unreadNotifications' => auth()->user()->unreadNotifications
        ])->render();
        // dd($unreadNotificationList);
        $notifications = view('layouts.admin.partials._extras.dropdown.notificationItem', [
            'notifications' => auth()->user()->notifications
        ])->render();

        return response()->json([
            'status' => true,
            'unreadNotifications' =>  $unreadNotificationList,
            'unreadCount' => 'تنبيهات جديدة (' . auth()->user()->unreadNotifications->count() . ')',
            'notifications' => $notifications,
        ]);
    }

    public function admin_mark_allNotifications(Request $request)
    {
        auth()->user()
            ->unreadNotifications
            ->markAsRead();

        return $this->userAdminNotification($request);
    }

    public function website_perc(Request $request)
    {

        if ($request->isMethod('post')) {
            $websitePerc = WebsitePercModel::first();
            $websitePerc->percentage =  $request->percentage;
            $websitePerc->save();
            return redirect()->route('admin.settings.perc')->with('success', 'تمت عملية الحفظ بنجاح');
        }

        if ($request->isMethod('get')) {
            $website_per = WebsitePercModel::select(['percentage', 'updated_at'])->first();
            return view('admin.general.websitePerantage', ['website_per' => $website_per]);
        }
    }


    public function website_links(Request $request)
    {
        if ($request->isMethod('post')) {
            $websiteLinks = WebsiteLinksModel::first();
            $websiteLinks->snapchat =  $request->snapchat;
            $websiteLinks->twitter =  $request->twitter;
            $websiteLinks->instagram =  $request->instagram;
            $websiteLinks->facebook =  $request->facebook;
            $websiteLinks->contactus_email =  $request->contactus_email;
            $websiteLinks->contactus_address =  $request->contactus_address;
            $websiteLinks->contactus_phone =  $request->contactus_phone;

            $websiteLinks->save();

            return redirect()->route('admin.settings.links')->with('success', 'تمت عملية الحفظ بنجاح');
        }

        if ($request->isMethod('get')) {
            $websiteLinks = WebsiteLinksModel::first();
            return view('admin.general.websiteLinks', ['websiteLinks' => $websiteLinks]);
        }
    }

    public function contactus_list(Request $request)
    {
        return view('admin.general.contactUs');
    }

    public function contactus_listData(Request $request)
    {
        $data = ContactUs::select('id', 'name', 'email', 'isread', 'created_at');
        return DataTables::of($data)
            ->editColumn('created_at', function ($message) {
                return $message->created_at ? with(new Carbon($message->created_at))->format('Y-m-d') : '';
            })
            ->addColumn('action', function ($message) {
                $viewBtn = '<a href="javascript:;" id="btnViewId_' . $message->id . '" data-url="' . route('admin.contactusData.messageDetails', ['id' => $message->id]) . '" class="btn btn-sm btn-clean btn-icon btnViewJob"  title="عرض"><i class="la la-eye"></i></a>';
                $removeBtn = '<a href="#" class="btn btn-sm btn-clean btn-icon removeBtn" data-id="' . $message->id . '" title="حذف"><i class="la la-trash"></i></a>';
                return $viewBtn . $removeBtn;
            })
            ->make();
    }
    public function contactus_messageDetails(Request $request, $id)
    {
        $message = ContactUs::where('id', $id)->first();
        $message->isread = true;
        $message->save();
        $messageDetails = view('admin.templates.contactusMessage', ['message' => $message])->render();



        return response()->json([
            'status' => true,
            'messageDetails' => $messageDetails,
            'totalContactNewMsgs' => $this->GetTotalMessages()
        ]);
    }


    public function admin_users(Request $request)
    {
        if ($request->isMethod('get')) {
            // $users = Admin::where('type', '!=', 'super_admin')->with('permissions')->get();
            // dd($users);
            return view('admin.general.adminUsers');
        }

        if ($request->isMethod('post')) {


            $users = Admin::where('type', '!=', 'super_admin')->with('permissions');

            return Datatables::of($users)
                ->editColumn('created_at', function ($user) {
                    return $user->created_at ? with(new Carbon($user->created_at))->format('Y-m-d') : '';
                })
                ->addColumn('user_permissions', function ($user) {
                    $permissions = $this->reNamePermissions($user->permissions);
                    return  $permissions->toArray();
                })
                ->addColumn('action', function ($user) {
                    $editBtn = '<a href="javascript:;" id="btnEditUserId_' . $user->id . '" data-id="' . $user->id . '" class="btn btn-sm btn-clean btn-icon btnEditUser"  title="تعديل"><i class="la la-edit"></i></a>';
                    $removeBtn = '<a href="#" class="btn btn-sm btn-clean btn-icon removeBtn" data-id="' . $user->id . '" title="حذف"><i class="la la-trash"></i></a>';
                    return $editBtn . $removeBtn;
                })
                ->make();
        }
    }

    public function add_edit_admin_user(Request $request)
    {
        if ($request->isMethod('get')) {
            $permissions = Permission::where('name', '!=', 'super-admin')->get();
            $permissions = $this->reNamePermissions($permissions);

            $admin_user = null;
            if ($request->only('user_id')) {
                $admin_user = Admin::find($request->user_id);
                // dd($admin_user);
            }

            return view('admin.templates.addNewUser', ['permissions' => $permissions, 'user' => $admin_user])->render();
        }
        if ($request->isMethod('post')) {
            // dd($request->all());
            // dd(App::getLocale());
            if ($request->user_id == null) {
                $request->validate([
                    'name' => 'required|string',
                    'email' => 'required|email|unique:admins,email',
                ], ['email.unique' => 'الايميل المدخل موجود مسبقاً']);
            }elseif ($request->user_id == Auth::id() && $request->edit_my_data) {
                $request->validate([
                    'name' => 'required|string',
                    'email' => ['required','email',Rule::unique('admins','email')->ignore(Auth::id())],
                ], ['email.unique' => 'الايميل المدخل موجود مسبقاً']);
            } else {
                $request->validate([
                    'name' => 'required|string',
                ]);
            }

        if ($request->user_id != null) {
                $admin_user =  Admin::find($request->user_id);
                $admin_user->name = $request->name;
                $admin_user->active = $request->active != null ? true : false;
                if ($request->password != "")
                    $admin_user->password =  Hash::make($request->password);

                $admin_user->save();
                $admin_user->syncPermissions($request->permissions);
            } else {
                $admin_user = new Admin();
                $admin_user->name = $request->name;
                $admin_user->email = $request->email;
                $admin_user->active = $request->active != null ? true : false;
                $admin_user->password =  Hash::make($request->password);
                $admin_user->type = "admin";
                $admin_user->save();
                $admin_user->syncPermissions($request->permissions);
            }

            return response()->json([
                'status' => true,
            ]);
        }
    }

    public function myData(Request $request)
    {

                $request->validate([
                    'name' => 'required|string',
                    'email' => ['required','email',Rule::unique('admins','email')->ignore(Auth::guard('admin')->id())],
                ], ['email.unique' => 'الايميل المدخل موجود مسبقاً']);

                $admin_user =  Auth::guard('admin')->user();
                $admin_user->name = $request->name;
                $admin_user->email = $request->email;
                if ($request->password != "")
                    $admin_user->password =  Hash::make($request->password);

                $admin_user->save();
                return redirect()->back()->with('success', 'تمت عملية الحفظ بنجاح');


    }

    public function delete_admin_user(Request $request)
    {
        $admin_user = Admin::where('id', $request->only('userId'))
            ->where('id', '!=', 1)
            ->first();
        $admin_user->syncPermissions([]);

        $admin_user->delete();

        return response()->json([
            'status' => true,
        ]);
    }


    public function GetTotalMessages()
    {
        return DB::table('contact_us')
            ->where('isread', false)
            ->count();
    }

    public function contactus_delete(Request $request)
    {
        // dd($request->all());
        $message = ContactUs::where('id', $request->only('messageId'))
            ->first();
        $message->delete();

        return response()->json([
            'status' => true,
            'totalContactNewMsgs' => $this->GetTotalMessages()
        ]);
    }
}
