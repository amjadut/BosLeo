<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AvailableRoles extends Model
{
    protected $table = 'available_roles';

    protected $fillable = ['user_roles'];
}
