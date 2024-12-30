<?php

namespace App\Mail;

use App\Models\SiteSetting;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderEmail extends Mailable
{
    use SerializesModels;

    public $orderItems;
    public $customerName;
    public $customerEmail;
    public $orderNo;
    public $deliveryFee;
    public $totalPrice;
    public $companyEmail;
    public $companyPhone;
    public $site_settings;

 
    public function __construct($orderItems, $customerName, $customerEmail, $orderNo, $deliveryFee, $totalPrice, $companyEmail, $companyPhone)
    {
        $this->site_settings  =   SiteSetting::latest()->first();

        $this->orderItems = $orderItems;
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
                        'orderItems' => $this->orderItems,
                        'customerName' => $this->customerName,
                        'customerEmail' => $this->customerEmail,
                        'orderNo' => $this->orderNo,
                        'deliveryFee' => $this->deliveryFee,
                        'totalPrice' => $this->totalPrice,
                        'companyEmail' => $this->companyEmail,
                        'companyPhone' => $this->companyPhone,
                        'site_settings' => $this->site_settings,
                    ]);
    }
}
