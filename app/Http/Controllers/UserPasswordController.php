<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Mail\UserPasswordReset;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;


class UserPasswordController extends Controller
{

    public static function sendPasswordEmail($user){
        $code = str_random(40).Carbon::now()->timestamp;
        \DB::table('password_resets')->insert([
            'token'=>$code,
            'email'=>$user->email,
            'created_at'=>Carbon::now()->toDateTimeString(),
        ]);
        \Mail::to($user)->send(new UserPasswordReset($code,'user.password.reset-form'));
        return true;


    }
    public function forget(){

        return  view('auth.passwords.user.forget');
    }
    public function forgetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|string|exists:users,email',
        ]);
        if ($user = \App\Models\User::where('email', $request->email)->first()) {
            self::sendPasswordEmail($user);
            return view('auth.passwords.user.forget_done');
        } else {
            session()->flash('warning','لم يتم العثور على الايميل');
            return back();
        }
    }

    public function showResetForm($token){
        $code = \DB::table('password_resets')
            ->where('token', $token)
            ->first();
        if ($code) {
            if(Carbon::parse($code->created_at)->addHours(12)->toDateTimeString() < Carbon::now()->toDateTimeString()){
                return  view('auth.passwords.user.failed');
            }
            return view('auth.passwords.user.reset',['token'=>$code->token,'email'=>$code->email]);

        }
        return  view('auth.passwords.user.failed');
    }

    public function reset(Request $request)
    {
        $request->validate(
            [
                'password' => 'required|string|min:6|confirmed',
            ]);
        $code = \DB::table('password_resets')
            ->where('token', $request->token)
            ->first();
        $user = \App\Models\User::where('email', $code->email)->first();


        if ($code && $user) {

            if(Carbon::parse($code->created_at)->addHours(12)->toDateTimeString() < Carbon::now()->toDateTimeString()){
                return  view('auth.passwords.failed');
            }
            $users=\App\Models\User::where('email', $code->email)->get();
            foreach ($users as $user){
                $user->password = bcrypt($request->password);
                $user->save();
            }

            \DB::table('password_resets')
                ->where('token', $request->token)
                ->where('email', $request->email)
                ->delete();
            auth()->login($user);
            return view('auth.passwords.user.done');

        } else {
            return view('auth.passwords.user.failed');
        }
    }


}
