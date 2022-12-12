<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\App;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;
function generateRandomString($length = 6) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
class AppController extends Controller
{
    public function index()
    {
        $xxx=array();
        foreach(App::all() as $app){
            $app['android_ads_banner']=url($app['android_ads_banner']);
            // $app['android_ads_video_reward']=url($app['android_ads_video_reward'];
            $app['ios_ads_banner']=url($app['ios_ads_banner']);
            // $app['ios_ads_video_reward']=url($app['ios_ads_video_reward'];
            $xxx[]=$app;
        }
        return response()->json(['code'=>200, 'status'=>true, 'apps' => $xxx]);
    }
    public function create(Request $request)
    {
        $data = $request->all();
        $validator = Validator::make($data, [
            'image' => 'required|mimes:png,jpg,jpeg',
            // 'ads' => 'mimes:mp4,mov,ogg '
        ]);
        if ($validator->fails()) {
            return response()->json(['status' => 0, 'message' => $validator->errors()]);
        } else {
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $reimage = time() . '.' . $image->getClientOriginalExtension();
                $dest = public_path('/imgs');
                $image->move($dest, $reimage);
                $data['image'] = 'imgs/' . $reimage;
                App::create($data);
            }
            return response()->json(['code'=>200, 'status'=>true, 'message' => 'Created App Successfully']);
        }
    }
    public function edit(Request $request)
    {
        $app = App::find($request->header('id'));
        if (!empty($app)) {
            if ($request->isMethod('post')) {
                $data = $request->all();
                $validator = Validator::make($data, [
                    'image' => 'required|mimes:png,jpg,jpeg',
                    // 'ads' => 'mimes:mp4,mov,ogg'
                ]);
                if ($validator->fails()) {
                    return response()->json(['code'=>500, 'status'=>false, 'message' => $validator->errors()]);
                } else {
                    if ($request->hasFile('image')) {
                        $image = $request->file('image');
                        $reimage = time() . '.' . $image->getClientOriginalExtension();
                        $dest = public_path('/imgs');
                        $image->move($dest, $reimage);
                        $data['image'] = 'imgs/' . $reimage;
                        File::delete(public_path($app['image']));
                        $app->update($data);
                    }else{
                        $app->update($data);
                    }
                    return response()->json(['code'=>200, 'status'=>true, 'message' => 'Updated App Successfully']);
                }
            }
            $app['image']=url($app['image']);
            return response()->json(['code'=>200, 'status'=>true, 'app' => $app]);
        } else {
            return response()->json(['code'=>404, 'status'=>false, 'message' => 'Somethings wrong!']);
        }
    }
    public function delete(Request $request){
        $app=App::find($request->header('id'));
        if(!empty($app)){
            $app->delete();
            return response()->json(['code'=>200, 'status'=>true,'message'=>'Deleted App Successfully']);
        }else{
            return response()->json(['code'=>404, 'status'=>false, 'message' => 'Somethings wrong!']);
        }
    }

    public function getCoupon(){
        $time=60*(60-date('i',strtotime(Carbon::now())))+(60-date('s',strtotime(Carbon::now())))+60*60*(24-date('H',strtotime(Carbon::now())));
        mt_srand(crc32(date('D d F Y')));
            $coupon=generateRandomString();
            return response()->json(['code'=>200, 'status'=>true, 'coupon'=>$coupon, 'time'=>$time]);

    }
}
