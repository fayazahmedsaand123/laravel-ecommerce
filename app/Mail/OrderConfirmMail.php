<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderConfirmMail extends Mailable {
    use Queueable, SerializesModels;

    public $order;
    public $items;
    public $userEmail;

    public function __construct($order, $items, $userEmail) {
        $this->order = $order;
        $this->items = $items;
        $this->userEmail = $userEmail;
    }   

    public function build() {
        return $this->subject('Your Order Has Been Confirmed')->view('emails.orders_confirm');
    }
}
