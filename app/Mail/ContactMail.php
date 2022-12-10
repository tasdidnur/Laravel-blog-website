<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $conName;
    public function __construct($name){
        $this->conName=$name;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(){
        $email_name=$this->conName;
        return $this->subject('Notifying You for sendind message')->view('frontend.mail',compact('email_name'));
    }
}
