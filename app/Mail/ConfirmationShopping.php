<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ConfirmationShopping extends Mailable
{
    use Queueable, SerializesModels;
    public $order, $url;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($order, $url=null)
    {
        $this->url = $url;
        $this->order = $order;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.confirmation');
    }
}
