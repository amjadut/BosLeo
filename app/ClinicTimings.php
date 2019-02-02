<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClinicTimings extends Model
{
    protected $table = 'clinic_timings';

    protected $fillable = ['clinic_id','day_id','from_time','to_time'];
}
