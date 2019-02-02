<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Clinics extends Model
{
    protected $table = 'clinics';

    protected $fillable = ['doctor_id','clinic_name','clinic_email','clinic_phone','clinic_bio'];
}
