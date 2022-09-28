<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class NewProject extends Mailable
{
    use Queueable, SerializesModels;
    public $project;
    public $type;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($project,$type='مشروع جديد')
    {
        $this->project = $project;
        $this->type = $type;
    }
    public $theme='cstom';
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.new_project')
            ->subject('Manasa Arch - '.$this->type)
            ->with(['project'=>$this->project,'type'=>$this->type]);
    }
}
