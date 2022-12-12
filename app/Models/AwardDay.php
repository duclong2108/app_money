<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AwardDay extends Model
{
    use HasFactory;
    protected $table='award_days';
    protected $fillable=[
        'money'
    ];
}