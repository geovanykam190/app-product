<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NotifyMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    private $name;
    private $link;
    private $titlen;
    private $viewc;

    public function __construct($name, $link, $titlen = '', $viewc = 'reset')
    {
        $this->name     = $name;
        $this->link     = $link;
        $this->titlen   = $titlen;
        $this->viewc    = $viewc;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $name       = $this->name;
        $link       = $this->link;
        $titlen     = $this->titlen;
        $viewc      = $this->viewc;

        return $this->from(env('MAIL_FROM_ADDRESS'), 'App Product')
                    ->subject($titlen)
                    ->view('mail.' . $viewc, compact('name', 'link'));
    }
}
