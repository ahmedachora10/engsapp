<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class SocialAuthController extends Controller
{

    public function login_google(Request $request)
    {
        return Socialite::driver('google')->redirect();
    }

    public function login_google_redirect(Request $request)
    {
        try {
            $GoogleDataUser = Socialite::driver('google')->user();
            // dd($GoogleDataUser);
            $user = User::where('email', $GoogleDataUser->email)->first();
            //User is not exists Create a new one
            if ($user == null) {
                $user = new User();
                $user->name = $GoogleDataUser->name;
                $user->email = $GoogleDataUser->email;
                $user->password = Hash::make(Str::random(24));
                // $user->country_code_phone_number = $request->usermobilecountrycode;
                $user->phone_number = '';
                $ImageProfileName = $this->generateProfileImg($GoogleDataUser->avatar_original);
                $user->profile_img = $ImageProfileName;
                $user->confirmed = true;
                $user->user_type = 'user';
                $user->save();
                // dd($user);
                // return redirect()->route('auth.register')->with('warning', 'contiune registration');
            }
//         else if ($user->user_type == 'register') {
//         return redirect()->route('auth.register')->with('warning', $user);
//         }

            Auth::login($user);

            return redirect()->intended(route('user.userDashboard'));
        }catch (\Exception $e){
            return redirect()->route('auth.register')->with('warning', 'فشل تسجيل الدخول');
        }

    }

    /**
     *
     *

     */

    public function generateProfileImg($avatar)
    {

        $img = Image::make(file_get_contents($avatar));
        // dd($img);
        $mime = $img->mime();  //edited due to updated to 2.x
        if ($mime == 'image/jpeg')
            $extension = '.jpg';
        elseif ($mime == 'image/png')
            $extension = '.png';
        elseif ($mime == 'image/gif')
            $extension = '.gif';
        else
            $extension = '';

        $filename = uniqid();
        $filename =  md5($filename) . $extension;
        // dd($filename);
        $path=realpath('public/user_files')?realpath('public/user_files'):realpath('user_files');

        $UserImg = $img->save($path.'/' . $filename);
//        \Storage::put('user_files/' . $filename, $img);
        return $UserImg->basename;
    }
}
