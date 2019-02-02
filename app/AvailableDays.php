<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AvailableDays extends Model
{
    protected $table = 'available_days';

    protected $fillable = ['day_name']
}
