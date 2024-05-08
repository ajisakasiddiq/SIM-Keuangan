<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BillingEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $tagihans;

    public function __construct($user, $tagihans)
    {
        $this->user = $user;
        $this->tagihans = $tagihans;
    }

    public function build()
    {
        return $this->subject('Tagihan Bulanan')->view('emails.billing');
    }
}
