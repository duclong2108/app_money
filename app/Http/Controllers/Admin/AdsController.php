<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ads;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
class AdsController extends Controller
{
    public function index()
    {
        $adss = Ads::all();
        return View('ads.index', compact('adss'));
    }
    public function create(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();
            $validator = Validator::make($data, [
                'image' => 'image|mimes:png,jpg,jpeg',
                // 'ads' => 'mimes:mp4,mov,ogg '
            ]);
            if ($validator->fails()) {
                return redirect()->back()->with('error_message', $validator->errors());
            } else {
                if ($request->hasFile('image')) {
                    $image = $request->file('image');
                    $reimage = time() . '.' . $image->getClientOriginalExtension();
                    $dest = public_path('/imgs');
                    $image->move($dest, $reimage);
                    $data['image'] = 'imgs/' . $reimage;
                    // if ($request->hasFile('ads')) {
                    //     $image = $request->file('ads');
                    //     $reimage = time() . '.' . $image->getClientOriginalExtension();
                    //     $dest = public_path('/videos');
                    //     $image->move($dest, $reimage);
                    //     $data['ads'] = 'videos/' . $reimage;
                    //     App::create($data);
                    // }else{
                    //     App::create($data);
                    // }
                    Ads::create($data);
                }
                return redirect('/adss')->with('success_message', 'Quảng Cáo tạo thành công');
            }
        }
        return View('ads.create');
    }
    public function edit(Request $request, $id)
    {
        $ads = Ads::find($id);
        if ($request->isMethod('post')) {
            $data = $request->all();
            $validator = Validator::make($data, [
                'image' => 'image|mimes:png,jpg,jpeg',
                // 'ads' => 'mimes:mp4,mov,ogg '
            ]);
            if ($validator->fails()) {
                return redirect()->back()->with('error_message', $validator->errors());
            } else {
                if ($request->hasFile('image')) {
                    $image = $request->file('image');
                    $reimage = time() . '.' . $image->getClientOriginalExtension();
                    $dest = public_path('/imgs');
                    $image->move($dest, $reimage);
                    $data['image'] = 'imgs/' . $reimage;
                    File::delete(public_path($ads['image']));
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
                    $ads->update($data);
                }else{
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
                    $ads->update($data);
                }
                return redirect('/adss')->with('success_message', 'Quảng Cáo cập nhật thành công');
            }
        }
        return View('ads.edit', compact('ads'));
    }
    public function delete($id)
    {
        Ads::find($id)->delete();
        return redirect()->back()->with('success_message','Quảng Cáo xóa thành công');
    }
    public function deleteAll(Request $request)
    {
        $data = $request->all();
        // dd(implode(",",$data['task_id']));
        if (!empty($data['ads_id'])) {
            $adss = Ads::whereIn('id', $data['ads_id']);
            $adss->delete();
            return redirect()->back()->with('success_message', 'Quảng Cáo được chọn xóa thành công');
        } else {
            return redirect()->back()->with('error_message', 'Có gì đó sai!');
        }
    }
}
