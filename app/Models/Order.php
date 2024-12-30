<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;


    protected $fillable = [
        'order_no',
        'customer_id',
        'order_type',
        'created_by_user_id',
        'updated_by_user_id',
        'total_price',
        'status',
        'status_online_pay',
        'session_id',
        'payment_method',
        'additional_info',
        'delivery_fee',
        'delivery_distance',
        'price_per_mile',
    ];
    

    // Get the customer associated with the order.
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    //Get the user who created the order.

    public function createdByUser()
    {
        return $this->belongsTo(User::class, 'created_by_user_id');
    }

    //Get the user who last updated the order.
 
    public function updatedByUser()
    {
        return $this->belongsTo(User::class, 'updated_by_user_id');
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function deleteWithRelations()
    {
        $this->orderItems()->delete();
        $this->customer()->delete();
        $this->delete();
    }   
}
