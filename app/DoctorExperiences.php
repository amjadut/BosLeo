<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DoctorExperiences extends Model
{
    protected $table = 'doctor_experiences';

    protected $fillable = ['doctor_id','role_id','start_year','end_year','organisation_name'];
}
