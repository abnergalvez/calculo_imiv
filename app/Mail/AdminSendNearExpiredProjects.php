<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AdminSendNearExpiredProjects extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $project;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user,$project)
    {
        $this->user = $user;
        $this->project = $project;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.near_expired_reentry_project')
            ->subject('Sistema GYS: Atencion! existen proyectos cercanos a vencer!');
    }
}
