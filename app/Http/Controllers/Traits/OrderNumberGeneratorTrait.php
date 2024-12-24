<?php

namespace App\Http\Controllers\Traits;

use App\Models\Order;

trait OrderNumberGeneratorTrait
{
    protected function generateOrderNumber()
    {
        do {
            $order_no = random_int(1000000, 9999999);
        } while (Order::where('order_no', $order_no)->exists());

        return $order_no;
    }
}
