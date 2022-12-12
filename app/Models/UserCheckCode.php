<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserCheckCode extends Model
{
    use HasFactory;
    protected $table='user_check_codes';
    protected $fillable=[
        'user_id',
        'task_id',
        'code',
        'point',
        'check'
    ];
}
