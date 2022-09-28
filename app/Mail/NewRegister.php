<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class NewRegister extends Mailable
{
    use Queueable, SerializesModels;
    public $type;
    public $user;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($type,$user)
    {
        $this->type = $type;
        $this->user = $user;
    }
    public $theme='cstom';
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.new_register')
            ->subject('منصة مهندسون - تسجيل جديد')
            ->with(['type'=>$this->type,'user'=>$this->user]);
    }
}
