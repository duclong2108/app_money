<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
class UserController extends Controller
{
    public function index(){
        $users=User::all();
        return View('users.index', compact('users'));
    }
    public function getMoney(Request $request){
        if($request->ajax()){
            $data=$request->all();
            $user=User::find($data['user_id']);
            $user['money']-=5000;
            $user->update(['money'=>$user['money']]);
            // Session::flash('success_message', 'Gửi tiền khách hàng thành công');
            return response()->json(['status'=>1, 'new_money'=>$user['money']]);
        }
    }
}
