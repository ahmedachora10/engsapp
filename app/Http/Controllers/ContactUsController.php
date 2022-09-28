<?php

namespace App\Http\Controllers;

use App\Models\ContactUs;
use Illuminate\Http\Request;

class ContactUsController extends FrontBaseController
{
    //


    public function send_message(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'message' => 'required',
        ]);


        $contactUs = new ContactUs();

        $contactUs->name = $request->name;
        $contactUs->email = $request->email;
        $contactUs->message = $request->message;
        $contactUs->isread = false;

        $contactUs->save();
        // sleep(1);
        $this->NotifyAdminUsers([
            'title' => 'رسالة جديدة !',
            'message' => 'قام ' . $contactUs->name . 'بإرسالة رسالة جديدة لإدارة الموقع ، قم بتصفحها من خلال قائمة اتصل بنا'
        ]);


        return response()->json([
            'status' => true,
            'message' => __('form.messages.success_msg_send'),
        ]);
    }
}
