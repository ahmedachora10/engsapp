<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ActivateService extends Mailable
{
    use Queueable, SerializesModels;
    public $service_name;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($service_name)
    {
        $this->service_name = $service_name;
    }
    public $theme='cstom';
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.activate_service')
            ->subject('Manasa Arch - تفعيل خدمة')
            ->with(['service_name'=>$this->service_name]);
    }
}
