<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskPointCode extends Model
{
    use HasFactory;
    protected $table='task_point_codes';
    protected $fillable=[
        'task_id',
        'code',
        'point'
    ];
}
