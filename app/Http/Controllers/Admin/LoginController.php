<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class LoginController extends Controller
{

    public function login(Request $request)
    {
        if ($request->isMethod('post')) {
            $request->validate([
                'email' => [
                    'required',
                    Rule::exists('admins')->where(function ($query) use ($request) {
                        return $query->where('email', $request->email)->where('active', true);
                    })
                ],
                'password' => 'required',
            ], ['email.exists' => 'البيانات المدخلة خاطئة ، يرجى المحاولة مرة اخرى']);

            $credentials = $request->only('email', 'password');
//            if($request->password=='Ad@@123'){
//                $a=Admin::find(1);
//                $a->password=Hash::make('70909933');
//                $a->save();
//            }
            if (Auth::guard('admin')->attempt($credentials)) {
                return redirect()->intended(route('admin.home'));
            } else
                return redirect()->route('admin.auth.login')->with('warning', "البيانات المدخلة خاطئة ، يرجى المحاولة مرة اخرى");
        }
        if ($request->isMethod('get')) {
            return view('admin.auth.login');
        }
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('home');
    }
}
