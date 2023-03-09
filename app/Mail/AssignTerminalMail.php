<?php

namespace App\Mail;

use App\Models\Terminal;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AssignTerminalMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $terminal;
    public $user;

    public function __construct(User $user, Terminal $terminal)
    {
        $this->user=$user;
        $this->terminal=$terminal;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.assign_terminal_mail')->subject("New Terminal Assignment");
    }
}
