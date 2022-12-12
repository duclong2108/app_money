<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class App extends Model
{
    use HasFactory;
    protected $table='apps';
    protected $fillable=[
        'android_app_id',
        'ios_app_id',
        'game',
        'android_ads_banner',
        'ios_ads_banner',
        'android_ads_interstitial',
        'ios_ads_interstitial',
        'package_name',
        'android_ads_video_reward',
        'ios_ads_video_reward',
        'status'
    ];
}
