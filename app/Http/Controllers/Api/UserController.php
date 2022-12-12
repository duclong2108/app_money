<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\App;
use App\Models\AwardDay;
use App\Models\AwardShare;
use App\Models\Rule;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\Privacy;
use App\Models\Banner;
use App\Models\FeedBack;
use App\Models\QuestionAnswer;
use App\Models\TaskUser;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Carbon\Carbon;
use App\Models\Question;
use App\Models\Type;
use GuzzleHttp\Client;
use App\Models\Ads;
function translate($q, $tl){
    if(empty($q)){
        $res="";
        return $res;
    }else{
        $res= file_get_contents("https://translate.googleapis.com/translate_a/single?client=gtx&ie=UTF-8&oe=UTF-8&dt=bd&dt=ex&dt=ld&dt=md&dt=qca&dt=rw&dt=rm&dt=ss&dt=t&dt=at&sl="."vi"."&tl=".$tl."&hl=hl&q=".urlencode($q), $_SERVER['DOCUMENT_ROOT']."/transes.html");
        $res=json_decode($res);
        return $res[0][0][0];
    }
}
class UserController extends Controller
{

    public function pagination($items, $perPage = 10, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }
    // public function login(Request $request){
    //     $data=$request->all();
    //     $validator=Validator::make($data,[
    //         'email'=>'required|email',
    //         'password'=>'required'
    //     ]);
    //     if($validator->fails()){
    //         return response()->json(['status'=>0, 'message'=>$validator->errors()]);
    //     }else{
    //         if(Auth::attempt(['email' => $data['email'], 'password' => $data['password']])){
    //             $user = Auth::user();
    //             $token=$user->createToken('MyApp')->accessToken;
    //             // User::find($user['id'])->update(['remember_token'=>$token]);
    //             return response()->json(['status'=>1, 'message'=>'Login Successfully', 'token'=>$token]);
    //         }else{
    //             return response()->json(['status'=>0, 'message'=>'Somethings wrong!']);
    //         }
    //     }
    // }
    // public function register(Request $request){
    //     $data=$request->all();
    //     $validator=Validator::make($data,[
    //         'email'=>'required|email|unique:users,email',
    //         'password'=>'required',
    //         'confirm_password'=>'required|same:password'
    //     ]);
    //     if($validator->fails()){
    //         return response()->json(['status'=>0, 'message'=>$validator->errors()]);
    //     }else{
    //         $user=User::create(['email'=>$data['email'],'password'=>Hash::make($data['password'])]);
    //         $token=$user->createToken('MyApp')->accessToken;
    //         // $user->update(['remember_token'=>$token]);
    //         return response()->json(['status'=>1, 'message'=>'Register Successfully', 'token'=>$token]);
    //     }
    // }
    // public function logout(){
    //     Auth::guard('web')->logout();
    //     return response()->json(['status'=>1, 'message'=>'Logout Successfully']);
    // }
    public function users()
    {
        return response()->json(['code' => 200, 'status' => true, 'users' => User::all()]);
    }
    public function makeTask(Request $request, $id, $token)
    {
        $task = Task::with('question_answer')->find($id);
        if (!empty($task)) {
            if ($request->isMethod('post')) {
                // if(!in_array(Auth::user()->id, explode(",",$task['user_id']))){
                $user = User::where('token', $token)->first();
                if (count(TaskUser::where('user_id', $user['id'])->where('task_id', $id)->get()) == 0) {
                    TaskUser::create(['task_id' => $id, 'user_id' => $user['id']]);
                    $user['money'] += $task['price'];
                    $user->update(['money' => $user['money']]);
                }
                // $all_user_id=$task['user_id'].",".Auth::user()->id;
                // $task->update(['user_id'=>$all_user_id]);
                return response()->json(['code' => 200, 'status' => true, 'message' => 'Task make done']);
                // }else{
                //     return response()->json(['status'=>0, 'message'=>'User did this task']);
                // }
            } else {
                return response()->json(['code' => 200, 'status' => true, 'task' => $task]);
            }
        } else {
            return response()->json(['code' => 404, 'status' => false, 'message' => 'Task not exists']);
        }
    }
    public function moneyShare(Request $request)
    {
        $token = 12345678;
        $user = User::where('token', $token)->first();
        $new_banner = array();
        foreach (Banner::all() as $banner) {
            $banner['image'] = url($banner['image']);
            $new_banner[] = $banner;
        }

        return response()->json(['code' => 200, 'status' => true, 'banner' => $new_banner, 'award_share' => AwardShare::first()->money, 'user_money' => $user['money']]);
    }
    public function getMoney(Request $request)
    {
        $user = User::where('token', $request->token)->first();
        if ($request->isMethod('post')) {
            if (!empty($user)) {
                if ($user['check'] == 0) {
                    $user['money'] += AwardDay::first()->money;
                    $user->update(['money' => $user['money'], 'updated_at' => Carbon::now(), 'check' => 1]);
                    return response()->json(['code' => 200, 'status' => true, 'message' => 'Money add in account', 'countdown' => strtotime('+24 hours', strtotime($user['updated_at'])) - strtotime(Carbon::now())]);
                } elseif ($user['check'] == 1) {
                    if (strtotime('+24 hours', strtotime($user['updated_at'])) - strtotime(Carbon::now()) > 0) {
                        return response()->json(['code' => 200, 'status' => true, 'countdown' => strtotime('+24 hours', strtotime($user['updated_at'])) - strtotime(Carbon::now())]);
                    } else {
                        $user->update(['check' => 0]);
                    }
                }
            } else {
                return response()->json(['code' => 404, 'status' => false, 'message' => 'Not found user']);
            }
        }
        // return response()->json(['code' => 200, 'status' => true,  'time_end_count_down' => date('Y-m-d H:i:s', strtotime('+24 hours', strtotime(Carbon::now()))), 'award_day' => AwardDay::first()->money, 'banner' => $new_banner, 'task_ads_merger' => $task_ads_merger, 'user_money' => $user['money']]);
    }
    public function getEmail(Request $request)
    {
        $data = $request->all();
        $validator = Validator::make($data, [
            'email' => 'required|email',
        ]);
        if ($validator->fails()) {
            return response()->json(['code' => 500, 'status' => false, 'message' => $validator->errors()]);
        } else {
            if (count(User::where('email', $request->email)->get()) == 0) {
                User::where('token', $request->token)->update(['email' => $request->email]);
            }
            // User::find(Auth::user()->id)->update(['email'=>$data['email']]);
            return response()->json(['code' => 200, 'status' => true, 'message' => 'Save email successfully']);
        }
    }
    public function saveToken(Request $request)
    {

        if (count(User::where('token', $request->token)->get()) == 0) {
            User::create(['token' => $request->token]);
        }
        return response()->json(['code' => 200, 'status' => true, 'message' => 'Save token successfully']);
    }
    public function privacyPolicy(Request $request)
    {
        return response()->json(['code' => 200, 'status' => true, 'privacy' => Privacy::first()]);
    }
    public function rule(Request $request)
    {
        return response()->json(['code' => 200, 'status' => true, 'rule' => Rule::first()]);
    }
    public function home(Request $request)
    {
        $user = User::where('token', $request->token)->first();
        $new_banner = array();
        foreach (Banner::all() as $banner) {
            $banner['image'] = url($banner['image']);
            $new_banner[] = $banner;
        }
        $new_ads = array();
        foreach (Ads::all() as $ads) {
            $ads['title']=$ads['title'];
            $ads['description']=$ads['description'];
            $ads['image'] = url($ads['image']);
            $new_ads[] = $ads;
        }

        $task_ads_merger = array();
        // $user=User::where('token', $token)->first();
        $tasks = Task::all();
        $i = 0;
        foreach ($tasks as $key => $task) {
            ++$key;
            // $task['image']='https://bakesrc.com/public/'.$task['image'];
            $task['title']=$task['title'];
            $task['desciption']=$task['description'];
            $task['image'] = url($task['image']);
            if (!empty($task['link'])) {
                $stepx=array();
                foreach(explode("|||", $task['step']) as $step){
                    $stepx[]=$step;
                }
                $task['step'] = $stepx;
            }
            if (empty(TaskUser::where('user_id', $user['id'])->where('task_id', $task['id'])->first()->check)) {
                if (!empty($task['link']) || count(QuestionAnswer::where('task_id', $task['id'])->get()) > 0) {
                    array_push($task_ads_merger, $task);
                }
            }elseif(!empty(TaskUser::where('user_id', $user['id'])->where('task_id', $task['id'])->first()->check)){
                if(TaskUser::where('user_id', $user['id'])->where('task_id', $task['id'])->first()->check!=2){
                    array_push($task_ads_merger, $task);
                }
            }
            if ($key % 4 == 0) {
                if ($i <= count($new_ads)) {
                    array_push($task_ads_merger, $new_ads[$i]);
                    ++$i;
                }
            }

        }

        $data = $this->pagination($task_ads_merger);
        $data->withPath('/api/home');
        if(strtotime('+24 hours', strtotime($user['updated_at'])) - strtotime(Carbon::now()) > 0&&$user['check'] == 1){
            return response()->json(['code' => 200, 'status' => true,'check'=>1, 'award_day' => AwardDay::first()->money, 'banner' => $new_banner, 'task_ads_merger' => $data, 'user_money' => $user['money']]);
        }else{
            return response()->json(['code' => 200, 'status' => true,'award_day' => AwardDay::first()->money, 'banner' => $new_banner, 'task_ads_merger' => $data, 'user_money' => $user['money']]);
        }
    }
    public function setting(Request $request)
    {
        $new_banner = array();
        foreach (Banner::all() as $banner) {
            $banner['image'] = url($banner['image']);
            $new_banner[] = $banner;
        }
        $new_question=[];
        foreach(Question::all() as $question){
            $question['description']=$question['description'];
            $new_question[]=$question;
        }
        $new_privacy=[];
        foreach(Privacy::all() as $privacy){
            $privacy['description']=$privacy['description'];
            $new_privacy[]=$privacy;
        }
        $new_rule=[];
        foreach(Rule::all() as $rule){
            $rule['description']=$rule['description'];
            $new_rule[]=$rule;
        }
        $new_feedback=[];
        foreach(Feedback::all() as $feedback){
            $feedback['description']=$feedback['description'];
            $new_feedback[]=$feedback;
        }
        return response()->json(['code' => 200, 'status' => true, 'question' => $new_question, 'privacy_policy' => $new_privacy, 'rule' => $new_rule, 'feedback' => $new_feedback, 'banner' => $new_banner]);
    }
    public function user($token)
    {
        $user = User::where('token', $token)->first();
        if (!empty($user)) {
            return response()->json(['code' => 200, 'status' => true, 'user_money' => $user['money']]);
        } else {
            return response()->json(['code' => 404, 'status' => false, 'message' => 'Somethings wrong!']);
        }
    }
}
