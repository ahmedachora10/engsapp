<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class NewOffer extends Mailable
{
    use Queueable, SerializesModels;
    public $name;
    public $service_request;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name,$service_request)
    {
        $this->name = $name;
        $this->service_request = $service_request;
    }
    public $theme='cstom';
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.new_offer')
            ->subject('Manasa Arch - عرض جديد')
            ->with(['name'=>$this->name,'service_request'=>$this->service_request]);
    }
}
