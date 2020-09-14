<?php

namespace App\Models\MApp;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = 
    [
        'id',
        'app_name',
        'app_email',
        'app_contact',
        'app_address',
        'app_logo',
        'created_at',
        'updated_at'
    ];
}
