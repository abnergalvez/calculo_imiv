<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AdminSendNearExpiredBudgets extends Mailable
{
    use Queueable, SerializesModels;

    public $admin;
    public $budgetsSoonExpired;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($admin, $budgetsSoonExpired)
    {
        $this->admin = $admin;
        $this->budgetsSoonExpired = $budgetsSoonExpired;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.near_expired_entry_budget')
        ->subject('Sistema GYS: Atencion! existen presupuestos por ingresar cercanos a vencer!');
    }
}
