<?php

namespace App\Models\MBranch;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    
    protected $primaryKey = 'b_id';

    protected $fillable = [
        'b_id',
        'b_code',
        'b_name',
        'b_email',
        'b_contact',
        'b_desc',
        'b_address',
        'b_status',
        'created_at',
        'updated_at'
    ];
}
