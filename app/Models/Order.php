<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_no',
        'user_id',
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
        'delivery_address_id',
        'pickup_address_id',
    ];

    // Customer who placed the order
    public function customer()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Delivery address
    public function deliveryAddress()
    {
        return $this->belongsTo(Address::class, 'delivery_address_id');
    }

    // Delivery address
    public function deliveryAddressWithTrashed()
    {
        return $this->belongsTo(Address::class, 'delivery_address_id')->withTrashed();
    }

 
    // Pickup address
    public function pickupAddress()
    {
        return $this->belongsTo(CompanyAddress::class, 'pickup_address_id')->withTrashed();
    }




    // User who created the order
    public function createdByUser()
    {
        return $this->belongsTo(User::class, 'created_by_user_id');
    }

    // User who last updated the order
    public function updatedByUser()
    {
        return $this->belongsTo(User::class, 'updated_by_user_id');
    }

    // Order items
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    // Clean delete
    public function deleteWithRelations()
    {
        $this->orderItems()->delete();
        $this->delete();
    }
}
