<?php

namespace App\Http\Controllers;

use App\Mail\NewMessage;
use App\Models\Admin;
use App\Models\User;
use App\Notifications\UserAction;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Notification;

class FrontBaseController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    // public function __construct()
    // {
    // }

    public function NotifyAdminUsers($data)
    {
        $adminUsers = Admin::all();

        if(isset($data['title'])&&isset($data['message'])){
            \Mail::to('engsapp@gmail.com')->cc(['haljohani85@gmail.com','info@engsapp.net'])->send(new NewMessage($data['title'],$data['message']));

        }

        Notification::send($adminUsers, new UserAction($data));
    }


    public function NotifyUser($user, $data)
    {
        $user = User::where('id', $user->id)->get();

        Notification::send($user, new UserAction($data));
    }
}
