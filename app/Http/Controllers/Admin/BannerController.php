<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
class BannerController extends Controller
{
    public function index()
    {
        $banners = Banner::all();
        return View('banners.index', compact('banners'));
    }
    public function create(Request $request)
    {

        $data = $request->all();
        $validator=Validator::make($data,[
            'image'=>'image|mimes:png,jpg,jpeg'
        ]);
        // dd($data);
        if($validator->fails()){
            return redirect()->back()->with('error_message', $validator->errors());
        }else{
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $reimage = time() . '.' . $image->getClientOriginalExtension();
                $dest = public_path('/imgs');
                $image->move($dest, $reimage);
                $data['image']='imgs/'.$reimage;
                Banner::create($data);
                return redirect()->back()->with('success_message', 'Tạo ảnh bìa thành công');
            }else{
                return redirect()->back()->with('error_message', 'Có gì đó sai!');
            }
        }
    }
    public function edit(Request $request, $id)
    {
        $banner=Banner::find($id);
        $data = $request->all();
        $validator=Validator::make($data,[
            'image'=>'image|mimes:png,jpg,jpeg'
        ]);
        // dd($data);
        if($validator->fails()){
            return redirect()->back()->with('error_message', $validator->errors());
        }else{
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $reimage = time() . '.' . $image->getClientOriginalExtension();
                $dest = public_path('/imgs');
                $image->move($dest, $reimage);
                $data['image']='imgs/'.$reimage;
                File::delete(public_path($banner['image']));
                $banner->update($data);
                return redirect()->back()->with('success_message', 'Cập nhật ảnh bìa thành công');
            }else{
                $banner->update($data);
                return redirect()->back()->with('success_message', 'Cập nhật ảnh bìa thành công');
            }
        }
    }
    public function delete($id){
        Banner::find($id)->delete();
        return redirect()->back()->with('success_message', 'Xóa ảnh bìa thành công');
    }
    public function deleteAll(Request $request){
        $data=$request->all();
        if(!empty($data['banner_id'])){
            $tasks=Banner::whereIn('id', $data['banner_id']);
            $tasks->delete();
            return redirect()->back()->with('success_message', 'Xóa ảnh bìa được chọn thành công');
        }else{
            return redirect()->back()->with('error_message', 'Có gì đó sai!');
        }
    }
}
