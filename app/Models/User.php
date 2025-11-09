<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements CanResetPassword
{
    use HasFactory, Notifiable;
    
    protected $fillable = [
        'first_name',
        'middle_name',
        'last_name',
        'email',
        'password',
        'role',
        'status',
        'notice',
        'phone_number',
        'address',
        'profile_picture',
        'activation_token',
        'two_factor_auth',
    ];
    

    protected $hidden = [
        'password', 
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Get the orders created by the user. 
    public function createdOrders()
    {
        return $this->hasMany(Order::class, 'created_by_user_id');
    }

    // Get the orders updated by the user. 
    public function updatedOrders()
    {
        return $this->hasMany(Order::class, 'updated_by_user_id');
    }
    
    // Relationship: user can have many addresses
    public function addresses()
    {
        return $this->hasMany(Address::class);
    }

}
