<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\Pivot;

class CategoryOrder extends Pivot
{
    protected $dates = [
        'date_start', 'date_end'
    ];

    public function setDateStartAttribute($value)
    {
        $this->attributes['date_start'] = Carbon::parse($value)->format('Y-m-d');
    }

    public function setDateEndAttribute($value)
    {
        $this->attributes['date_end'] = Carbon::parse($value)->format('Y-m-d');
    }
}
