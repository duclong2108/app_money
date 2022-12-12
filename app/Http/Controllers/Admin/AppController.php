<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\App;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
class AppController extends Controller
{
    public function index()
    {
        $apps = App::all();

        return View('apps.index', compact('apps'));
    }
    public function create(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();
            $validator = Validator::make($data, [
                'android_ads_banner' => 'image|mimes:png,jpg,jpeg',
                'ios_ads_banner' => 'image|mimes:png,jpg,jpeg '
            ]);
            if ($validator->fails()) {
                return redirect()->back()->with('error_message', $validator->errors());
            } else {
                if ($request->hasFile('android_ads_banner')&&$request->hasFile('ios_ads_banner')) {
                    $image = $request->file('android_ads_banner');
                    $reimage = time() . '.' . $image->getClientOriginalExtension();
                    $dest = public_path('/imgs');
                    $image->move($dest, $reimage);
                    $data['android_ads_banner'] = 'imgs/' . $reimage;
                    // if ($request->hasFile('ads')) {
                        // $image1 = $request->file('android_ads_video_reward');
                        // $reimage1 = time() . '.' . $image1->getClientOriginalExtension();
                        // $dest1 = public_path('/videos');
                        // $image1->move($dest1, $reimage1);
                        // $data['android_ads_video_reward'] = 'videos/' . $reimage1;

                        $image2 = $request->file('ios_ads_banner');
                        $reimage2 = rand(10,100000000000).time() . '.' . $image2->getClientOriginalExtension();
                        $dest2 = public_path('/imgs');
                        $image2->move($dest2, $reimage2);
                        $data['ios_ads_banner'] = 'imgs/' . $reimage2;
                        // if ($request->hasFile('ads')) {
                            // $image3 = $request->file('ios_ads_video_reward');
                            // $reimage3 = rand(10,100000000000).time() . '.' . $image3->getClientOriginalExtension();
                            // $dest3 = public_path('/videos');
                            // $image3->move($dest3, $reimage3);
                            // $data['ios_ads_video_reward'] = 'videos/' . $reimage3;
                    App::create($data);
                }
                return redirect('/apps')->with('success_message', 'Ứng dụng tạo thành công');
            }
        }
        return View('apps.create');
    }
    public function edit(Request $request, $id)
    {
        $app = App::find($id);
        if ($request->isMethod('post')) {
            $data = $request->all();
            $validator = Validator::make($data, [
                'android_ads_banner' => 'image|mimes:png,jpg,jpeg',
                'ios_ads_banner' => 'image|mimes:png,jpg,jpeg '
            ]);
            if ($validator->fails()) {
                return redirect()->back()->with('error_message', $validator->errors());
            } else {
                if ($request->hasFile('android_ads_banner')) {
                    $image = $request->file('android_ads_banner');
                    $reimage = time() . '.' . $image->getClientOriginalExtension();
                    $dest = public_path('/imgs');
                    $image->move($dest, $reimage);
                    $data['android_ads_banner'] = 'imgs/' . $reimage;
                    File::delete(public_path($app['android_ads_banner']));
                    $app->update($data);
                    // if ($request->hasFile('ads')) {
                    }
                // if($request->hasFile('android_ads_video_reward')){
                //         $image1 = $request->file('android_ads_video_reward');
                //         $reimage1 = time() . '.' . $image1->getClientOriginalExtension();
                //         $dest1 = public_path('/videos');
                //         $image1->move($dest1, $reimage1);
                //         $data['android_ads_video_reward'] = 'videos/' . $reimage1;

                //     File::delete(public_path($app['android_ads_video_reward']));
                //     $app->update($data);
                // }
                if ($request->hasFile('ios_ads_banner')) {
                    $image = $request->file('ios_ads_banner');
                    $reimage = time() . '.' . $image->getClientOriginalExtension();
                    $dest = public_path('/imgs');
                    $image->move($dest, $reimage);
                    $data['ios_ads_banner'] = 'imgs/' . $reimage;
                    File::delete(public_path($app['ios_ads_banner']));
                    $app->update($data);
                    // if ($request->hasFile('ads')) {
                    }
                // if($request->hasFile('ios_ads_video_reward')){
                //         $image1 = $request->file('ios_ads_video_reward');
                //         $reimage1 = time() . '.' . $image1->getClientOriginalExtension();
                //         $dest1 = public_path('/videos');
                //         $image1->move($dest1, $reimage1);
                //         $data['ios_ads_video_reward'] = 'videos/' . $reimage1;

                //     File::delete(public_path($app['ios_ads_video_reward']));
                //     $app->update($data);
                // }
                    // if ($request->hasFile('ads')) {
                    //     $image = $request->file('ads');
                    //     $reimage = time() . '.' . $image->getClientOriginalExtension();
                    //     $dest = public_path('/videos');
                    //     $image->move($dest, $reimage);
                    //     $data['ads'] = 'videos/' . $reimage;
                    //     File::delete(public_path($app['ads']));
                    //     $app->update($data);
                    // }else{
                    //     $app->update($data);
                    // }

                else{
                    // if ($request->hasFile('ads')) {
                    //     $image = $request->file('ads');
                    //     $reimage = time() . '.' . $image->getClientOriginalExtension();
                    //     $dest = public_path('/videos');
                    //     $image->move($dest, $reimage);
                    //     $data['ads'] = 'videos/' . $reimage;
                    //     File::delete(public_path($app['ads']));
                    //     $app->update($data);
                    // }else{
                    //     $app->update($data);
                    // }
                    $app->update($data);
                }
                return redirect('/apps')->with('success_message', 'Ứng dụng cập nhật thành công');
            }
        }
        return View('apps.edit', compact('app'));
    }
    public function delete($id)
    {
        App::find($id)->delete();
        return redirect()->back()->with('success_message','Ứng dụng xóa thành công');
    }
    public function deleteAll(Request $request)
    {
        $data = $request->all();
        // dd(implode(",",$data['task_id']));
        if (!empty($data['app_id'])) {
            $apps = App::whereIn('id', $data['app_id']);
            $apps->delete();
            return redirect()->back()->with('success_message', 'Ứng dụng được chọn xóa thành công');
        } else {
            return redirect()->back()->with('error_message', 'Có gì đó sai!');
        }
    }
}
