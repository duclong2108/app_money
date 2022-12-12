<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;
use App\Models\AwardDay;
use App\Models\AwardShare;
use App\Models\Privacy;
use App\Models\Task;
use App\Models\Rule;
use App\Models\Question;
use App\Models\FeedBack;
class AdminController extends Controller
{
    public function login(Request $request){
        // dd(Hash::make(1));
        if($request->isMethod('post')){
            $data=$request->all();
            if(Auth::guard('admin')->attempt(['email' => $data['email'], 'password' => $data['password']])){
                return redirect('/dashboard');
            }else{
                return redirect()->back()->with('error_message', 'Có gì đó sai!');
            }
        }
        return View('login');
    }
    public function dashboard(){
        return View('admin.dashboard');
    }
    public function logout(){
        Auth::guard('admin')->logout();
        return redirect('/admin');
    }
    public function account(Request $request){
        $admin=Admin::find(Auth::guard('admin')->user()->id);
        if($request->isMethod('post')){
            $data=$request->all();
            if($data['new_password']==$data['confirm_password']&&!empty($data['new_password'])){
                $data['password']=Hash::make($data['new_password']);
                $admin->update($data);
                return redirect()->back()->with('success_message', 'Quản trị cập nhật thành công');
            }else if(empty($data['new_password'])&&empty($data['confirm_password'])){
                $data['password']=$admin['password'];
                $admin->update($data);
                return redirect()->back()->with('success_message', 'Quản trị cập nhật thành công');
            }else{
                return redirect()->back()->with('error_message', 'Có gì đó sai!');
            }
        }
        return View('admin.account', compact('admin'));
    }
    public function checkPassword(Request $request){
        if($request->ajax()){
            $data=$request->all();
            if(Hash::check($data['password'], Auth::guard('admin')->user()->password)){
                return response()->json(['status'=>1]);
            }else{
                return response()->json(['status'=>0]);
            }
        }
    }
    public function changeStatus(Request $request){
        if($request->ajax()){
            $data=$request->all();
            if($data['text']=='Active'){
                $data['name']::find($data['id'])->update(['status'=>0]);
                return response()->json(['status'=>0]);
            }else{
                $data['name']::find($data['id'])->update(['status'=>1]);
                return response()->json(['status'=>1]);
            }
        }
    }
    public function privacyPolicy(Request $request){
        $privacy=Privacy::first();
        if($request->isMethod('post')){
            $data=$request->all();
            $privacy->update($data);
            return redirect()->back()->with('success_message', 'Chính Sách Cập Nhật Thành Công');
        }
        return View('admin.privacy',compact('privacy'));
    }
    public function rule(Request $request){
        $rule=Rule::first();
        if($request->isMethod('post')){
            $data=$request->all();
            $rule->update($data);
            return redirect()->back()->with('success_message', 'Điều Khoản Cập Nhật Thành Công');
        }
        return View('admin.rule',compact('rule'));
    }
    public function question(Request $request){
        $question=Question::first();
        if($request->isMethod('post')){
            $data=$request->all();
            $question->update($data);
            return redirect()->back()->with('success_message', 'Câu Hỏi Cập Nhật Thành Công');
        }
        return View('admin.question',compact('question'));
    }
    public function feedBack(Request $request){
        $feedback=FeedBack::first();
        if($request->isMethod('post')){
            $data=$request->all();
            $feedback->update($data);
            return redirect()->back()->with('success_message', 'Phản Hồi Cập Nhật Thành Công');
        }
        return View('admin.feedback',compact('feedback'));
    }
    public function awardShare(Request $request){
        $share=AwardShare::first();
        if($request->isMethod('post')){
            $data=$request->all();
            $share->update($data);
            return redirect()->back()->with('success_message', 'Tiền Giới Thiệu Cập Nhật Thành Công');
        }
        return View('admin.award_share',compact('share'));
    }
    public function awardDay(Request $request){
        $day=AwardDay::first();
        if($request->isMethod('post')){
            $data=$request->all();
            $day->update($data);
            return redirect()->back()->with('success_message', 'Tiền Mỗi Ngày Cập Nhật Thành Công');
        }
        return View('admin.award_day',compact('day'));
    }
}
