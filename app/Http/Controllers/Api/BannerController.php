<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Banner;
class BannerController extends Controller
{
    public function index(){
        $xxx=array();
        foreach(Banner::all() as $banner){
            $banner['image']=url($banner['image']);
            $xxx[]=$banner;
        }
        return response()->json(['code'=>200, 'status'=>true, 'banners'=>$xxx]);
    }
}
