<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CompanyWorkingHour extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'day_of_week',
        'opens_at',
        'closes_at',
        'is_closed',
    ];

    protected $casts = [
        'opens_at' => 'datetime:H:i',
        'closes_at' => 'datetime:H:i',
        'is_closed' => 'boolean',
    ];

    // to format hours
    public function getFormattedHoursAttribute()
    {
        if ($this->is_closed) {
            return 'Closed';
        }

        return $this->opens_at . ' - ' . $this->closes_at;
    }
}
