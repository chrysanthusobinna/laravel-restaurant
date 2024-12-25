<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderEmail extends Mailable
{
    use SerializesModels;

    public $cartItems;
    public $customerName;
    public $customerEmail;
    public $orderNo;
    public $deliveryFee;
    public $totalPrice;
    public $companyEmail;
    public $companyPhone;

 
    public function __construct($cartItems, $customerName, $customerEmail, $orderNo, $deliveryFee, $totalPrice, $companyEmail, $companyPhone)
    {
        $this->cartItems = $cartItems;
        $this->customerName = $customerName;
        $this->customerEmail = $customerEmail;
        $this->orderNo = $orderNo;
        $this->deliveryFee = $deliveryFee;
        $this->totalPrice = $totalPrice;
        $this->companyEmail = $companyEmail;
        $this->companyPhone = $companyPhone;
    }

   
    public function build()
    {
        return $this->view('emails.order')
                    ->subject('Your Order Details')
                    ->with([
                        'cartItems' => $this->cartItems,
                        'customerName' => $this->customerName,
                        'customerEmail' => $this->customerEmail,
                        'orderNo' => $this->orderNo,
                        'deliveryFee' => $this->deliveryFee,
                        'totalPrice' => $this->totalPrice,
                        'companyEmail' => $this->companyEmail,
                        'companyPhone' => $this->companyPhone,
                    ]);
    }
}
