<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Task;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Banner;
use App\Models\QuestionAnswer;
use App\Models\TaskUser;
use Carbon\Carbon;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Models\TaskCode;
use App\Models\TaskGrade;
use App\Models\TaskPointCode;
use App\Models\UserCheckCode;
use Illuminate\Support\Facades\Auth;

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
class TaskController extends Controller
{
    public function pagination($items, $perPage = 10, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }
    // public function index()
    // {
    //     foreach (Task::all() as $task) {
    //         // $task['image']='https://bakesrc.com/public/'.$task['image'];
    //         $task['image'] = url($task['image'];

    //     }
    //     return response()->json(['code' => 200, 'status' => true, 'tasks' => $xxx]);
    // }

    public function edit(Request $request)
    {
        $task = Task::with('user_check_code')->find($request->id);
        
        $user=User::where('token', $request->token)->first();
        // $question_answer = QuestionAnswer::where('task_id', $id)->get();
        if($request->isMethod('post')){
            if(TaskPointCode::where('task_id', $request->id)->where('code', $request->code)->where('point', $request->point)->get()->count()>0){
                if(UserCheckCode::where('task_id', $request->id)->where('user_id', $user['id'])->where('code', $request->code)->where('point', $request->point)->where('check',1)->get()->count()>0){
                    return response()->json(['code'=>200,'status'=>true, 'message'=>'Code was used']);
                    
                }else if(UserCheckCode::where('task_id', $request->id)->where('user_id', $user['id'])->where('code', $request->code)->where('point', $request->point)->get()->count()==0){
                    return response()->json(['code'=>200,'status'=>true, 'message'=>'Code not work']);
                }
                else{
                    UserCheckCode::where('task_id', $request->id)->where('user_id', $user['id'])->where('code', $request->code)->where('point', $request->point)->first()->update(['check'=>1]);
                    return response()->json(['code'=>200,'status'=>200, 'message'=>'Code appied successfully']);
                }
            }else{
                return response()->json(['code'=>403,'status'=>false, 'message'=>'Code or Point not true']);
            }
        }
        if (!empty($task)&&!empty($user)) {
            foreach($task['task_point_code'] as $tpc){
                    if(UserCheckCode::where('task_id', $request->id)->where('user_id', $user['id'])->where('code', $tpc['code'])->where('point', $tpc['point'])->where('check',1)->get()->count()>0){
                        $tpc['check']=1;
                    }else{
                        $tpc['check']=0;
                    }
            }
            $task['title']=$task['title'];
            $task['description']=$task['description'];
            $task['image'] = isset($task['image'])?url($task['image']):"";
            
            if (!empty($task['link'])) {
                $new_step=[];
                $task['image_game'] = isset($task['image_game'])?url($task['image_game']):"";
                foreach(explode("|||", $task['step']) as $step){
                    $new_step[]=$step;
                }
                $task['step']=$new_step;
                $task['check']=!empty(TaskUser::where('user_id', $user['id'])->where('task_id', $request->id)->first()->check)?TaskUser::where('user_id', $user['id'])->where('task_id', $request->id)->first()->check:0;
                return response()->json(['code' => 200, 'status' => true, 'task' => $task]);
            } else {
                $new_question_answer=array();
                foreach (QuestionAnswer::where('task_id', $request->id)->get() as $question) {
                    $new_answer=[];
                    $question['question']=$question['question'];
                    foreach(explode("|||", $question['answer']) as $answer){
                        $new_answer[]=$answer;
                    }
                    $question['answer']=$new_answer;
                    $new_question_answer[] = $question;
                }
                $task['check']=!empty(TaskUser::where('user_id', $user['id'])->where('task_id', $request->id)->first()->check)?TaskUser::where('user_id', $user['id'])->where('task_id', $request->id)->first()->check:0;
                return response()->json(['code' => 200, 'status' => true, 'task' => $task, 'question_answer' => $new_question_answer]);
            }
        } else {
            return response()->json(['code' => 404, 'status' => false, 'message' => 'Task not exists']);
        }
    }

    // public function taskUserDoing(Request $request, $task_id, $token)
    // {
    //     $user = User::where('token', $token)->first();
    //     $task = Task::with('question_answer')->find($task_id);
    //     if ($request->isMethod('post')) {
    //         if(!in_array($user['id'], explode(",", $task['user_id']))){
    //             $task->update(['user_id' => $task['user_id'] . "," . $user['id']]);
    //         }
    //         if (in_array($user['id'], explode(",", $task['user_id']))) {
    //             return response()->json(['code' => 200, 'status' => true, 'message' => 'User doing this task']);
    //         } else {
    //             return response()->json(['code' => 404, 'status' => false, 'message' => 'User not doing this task']);
    //         }
    //     }
    //     else {
    //         if (!empty($user)) {
    //             $tt = array();
    //             foreach (explode(",", $task['image']) as $image) {
    //                 $tt[] = url($image;
    //             }
    //             $task['image'] = $tt;
    //             return response()->json(['code' => 200, 'status' => true, 'tasks_user_doing' => $task]);
    //         } else {
    //             return response()->json(['code' => 404, 'status' => false, 'message' => 'Somethings wrong!']);
    //         }
    //     }
    // }
    public function taskUserDoing(Request $request)
    {
        $user = User::where('token', $request->token)->first();
        $task = Task::find($request->id);
        if ($request->isMethod('post')) {
            if (count(TaskUser::where('task_id', $request->id)->where('user_id', $user['id'])->get()) == 0) {
                TaskUser::create(['task_id' => $request->id, 'user_id' => $user['id'], 'check'=>1]);
            }else{
                TaskUser::where('task_id', $request->id)->where('user_id', $user['id'])->update(['check'=>1]);
            }
            return response()->json(['code' => 200, 'status' => true, 'message' => 'User doing this task']);
        }
    }
    public function tasksUserComplete(Request $request)
    {
        $new_banner = array();
        foreach (Banner::all() as $banner) {
            $banner['image'] = isset($banner['image'])?url($banner['image']):"";
            $new_banner[] = $banner;
        }
        $user = User::where('token',$request->token)->first();
        $new_taskuser = [];
        if (!empty($user)) {
            $award = 0;
            foreach (TaskUser::where('user_id', $user['id'])->with('task')->get()->take((empty($request->page) ? 10 : 10 * $request->page)) as $key => $taskuser) {
                // $new_taskuser=[];
                $stepx=array();
                foreach(explode("|||", $taskuser['task']['step']) as $step){
                    $stepx[]=$step;
                }
                $taskuser['task']['step'] = $stepx;
                $taskuser['task']['image'] = isset($taskuser['task']['image'])?url($taskuser['task']['image']):"";
                $init = date(strtotime(Carbon::now())) - date(strtotime($taskuser['updated_at']));
                $day = floor($init / 86400);
                $hours = floor(($init - $day * 86400) / 3600);
                $minutes = floor(($init / 60) % 60);
                $seconds = $init % 60;
                if ($init >= 24 * 60 * 60) {
                    $new_taskuser[] = ['id'=>$taskuser['task']['id'],"title" => $taskuser['task']['title'], 'image' => $taskuser['task']['image'], 'description' => $taskuser['task']['description'], 'price' => $taskuser['task']['price'], 'link' => $taskuser['task']['link'], 'rating' => $taskuser['task']['rating'], 'level' => $taskuser['task']['level'],'step'=>$taskuser['task']['step'],'select'=>$taskuser['task']['select'],'status'=>$taskuser['task']['status'],'type'=>$taskuser['task']['type'],'check'=>$taskuser['check'],'created_at'=>$taskuser['task']['created_at'], 'updated_at'=>$taskuser['task']['updated_at'], 'time' => $day .' '. ' ng&#1043; y'];
                } elseif ($init >= 60 * 60) {
                    $new_taskuser[] = ['id'=>$taskuser['task']['id'],"title" => $taskuser['task']['title'], 'image' => $taskuser['task']['image'], 'description' => $taskuser['task']['description'], 'price' => $taskuser['task']['price'], 'link' => $taskuser['task']['link'], 'rating' => $taskuser['task']['rating'], 'level' => $taskuser['task']['level'],'step'=>$taskuser['task']['step'],'select'=>$taskuser['task']['select'],'status'=>$taskuser['task']['status'],'type'=>$taskuser['task']['type'],'check'=>$taskuser['check'],'created_at'=>$taskuser['task']['created_at'], 'updated_at'=>$taskuser['task']['updated_at'], 'time' => $hours .' '. ' gi&#1073;»&#1116;'];
                } elseif ($minutes >= 60) {
                    $new_taskuser[] = ['id'=>$taskuser['task']['id'],"title" => $taskuser['task']['title'], 'image' => $taskuser['task']['image'], 'description' => $taskuser['task']['description'], 'price' => $taskuser['task']['price'], 'link' => $taskuser['task']['link'], 'rating' => $taskuser['task']['rating'], 'level' => $taskuser['task']['level'],'step'=>$taskuser['task']['step'],'select'=>$taskuser['task']['select'],'status'=>$taskuser['task']['status'],'type'=>$taskuser['task']['type'],'check'=>$taskuser['check'],'created_at'=>$taskuser['task']['created_at'], 'updated_at'=>$taskuser['task']['updated_at'], 'time' => $minutes .' '. ' ph&#1043;&#1108;t'];
                } else {
                    $new_taskuser[] = ['id'=>$taskuser['task']['id'],"title" => $taskuser['task']['title'], 'image' => $taskuser['task']['image'], 'description' => $taskuser['task']['description'], 'price' => $taskuser['task']['price'], 'link' => $taskuser['task']['link'], 'rating' => $taskuser['task']['rating'], 'level' => $taskuser['task']['level'],'step'=>$taskuser['task']['step'],'select'=>$taskuser['task']['select'],'status'=>$taskuser['task']['status'],'type'=>$taskuser['task']['type'],'check'=>$taskuser['check'],'created_at'=>$taskuser['task']['created_at'], 'updated_at'=>$taskuser['task']['updated_at'], 'time' => $seconds .' '. ' gi&#1043;&#1118;y'];
                }
                $award += $taskuser['task']['price'];
            }
            $data=$this->pagination($new_taskuser);
            $data->withPath('/api/tasks/complete');
            return response()->json(['code' => 200, 'status' => true, 'banner' => $new_banner, 'user_money' => $user['money'], 'tasks_user_did' => $data, 'all_award_task_get' => $award]);
        } else {
            return response()->json(['code' => 404, 'status' => false, 'message' => 'Somethings wrong!']);
        }
    }
    public function userClickTask(Request $request)
    {
        $new_banner = array();
        foreach (Banner::all() as $banner) {
            $banner['image'] = isset($banner['image'])?url($banner['image']):"";
            $new_banner[] = $banner;
        }
        $user = User::where('token', $request->token)->first();

        $new_taskuser = [];
        if (!empty($user)) {
            foreach (TaskUser::where('user_id', $user['id'])->with('task')->get() as $key => $taskuser) {
                $stepx=array();
                foreach(explode("|||", $taskuser['task']['step']) as $step){
                    $stepx[]=$step;
                }
                $taskuser['task']['step']=$stepx;
                $taskuser['task']['image'] = isset($taskuser['task']['image'])?url($taskuser['task']['image']):"";
                $init = date(strtotime(Carbon::now())) - date(strtotime($taskuser['created_at']));
                $day = floor($init / 86400);
                $hours = floor(($init - $day * 86400) / 3600);
                $minutes = floor(($init / 60) % 60);
                $seconds = $init % 60;
                if ($init >= 24 * 60 * 60) {
                    $new_taskuser[] = ['id'=>$taskuser['task']['id'],"title" => $taskuser['task']['title'], 'image' => $taskuser['task']['image'], 'description' => $taskuser['task']['description'], 'price' => $taskuser['task']['price'], 'link' => $taskuser['task']['link'], 'rating' => $taskuser['task']['rating'], 'level' => $taskuser['task']['level'],'step'=>$taskuser['task']['step'],'select'=>$taskuser['task']['select'],'status'=>$taskuser['task']['status'],'type'=>$taskuser['task']['type'],'check'=>$taskuser['check'],'created_at'=>$taskuser['task']['created_at'], 'updated_at'=>$taskuser['task']['updated_at'], 'time' => $day .' '. ' ng&#1043; y'];
                } elseif ($init >= 60 * 60) {
                    $new_taskuser[] = ['id'=>$taskuser['task']['id'],"title" => $taskuser['task']['title'], 'image' => $taskuser['task']['image'], 'description' => $taskuser['task']['description'], 'price' => $taskuser['task']['price'], 'link' => $taskuser['task']['link'], 'rating' => $taskuser['task']['rating'], 'level' => $taskuser['task']['level'],'step'=>$taskuser['task']['step'],'select'=>$taskuser['task']['select'],'status'=>$taskuser['task']['status'],'type'=>$taskuser['task']['type'],'check'=>$taskuser['check'],'created_at'=>$taskuser['task']['created_at'], 'updated_at'=>$taskuser['task']['updated_at'], 'time' => $hours .' '. ' gi&#1073;»&#1116;'];
                } elseif ($minutes >= 60) {
                    $new_taskuser[] = ['id'=>$taskuser['task']['id'],"title" => $taskuser['task']['title'], 'image' => $taskuser['task']['image'], 'description' => $taskuser['task']['description'], 'price' => $taskuser['task']['price'], 'link' => $taskuser['task']['link'], 'rating' => $taskuser['task']['rating'], 'level' => $taskuser['task']['level'],'step'=>$taskuser['task']['step'],'select'=>$taskuser['task']['select'],'status'=>$taskuser['task']['status'],'type'=>$taskuser['task']['type'],'check'=>$taskuser['check'],'created_at'=>$taskuser['task']['created_at'], 'updated_at'=>$taskuser['task']['updated_at'], 'time' => $minutes .' '. ' ph&#1043;&#1108;t'];
                } else {
                    $new_taskuser[] = ['id'=>$taskuser['task']['id'],"title" => $taskuser['task']['title'], 'image' => $taskuser['task']['image'], 'description' => $taskuser['task']['description'], 'price' => $taskuser['task']['price'], 'link' => $taskuser['task']['link'], 'rating' => $taskuser['task']['rating'], 'level' => $taskuser['task']['level'],'step'=>$taskuser['task']['step'],'select'=>$taskuser['task']['select'],'status'=>$taskuser['task']['status'],'type'=>$taskuser['task']['type'],'check'=>$taskuser['check'],'created_at'=>$taskuser['task']['created_at'], 'updated_at'=>$taskuser['task']['updated_at'], 'time' => $seconds .' '. ' gi&#1043;&#1118;y'];
                }
            }
            $data=$this->pagination($new_taskuser);
            $data->withPath('/api/all-task-click');
            return response()->json(['code' => 200, 'status' => true, 'banner' => $new_banner, 'user_money' => $user['money'], 'tasks_user_click' => $data]);
        } else {
            return response()->json(['code' => 404, 'status' => false, 'message' => 'Somethings wrong!']);
        }
    }
    public function userFinishTask(Request $request)
    {
        $user = User::where('token', $request->token)->first();
        if (!empty($user)) {
            if ($request->isMethod('post')) {

                
                if(empty(Task::find($request->id)->link)){
                    $user['money'] += Task::find($request->id)->price;
                    $user->update(['money' => $user['money']]);
                    $taskuser=TaskUser::create(['task_id'=>$request->id, 'user_id'=>$user['id'], 'check'=>2, 'updated_at'=>Carbon::now()]);
                    return response()->json(['code' => 200, 'status' => true, 'message' => 'Finish Task Successfully and User get money']);
                }else if(UserCheckCode::where('task_id', $request->id)->where('user_id', $user['id'])->get()->count()==TaskPointCode::where('task_id', $request->id)->get()->count()&&!empty(Task::find($request->id)->link)){
                    $user['money'] += Task::find($request->id)->price;
                    $user->update(['money' => $user['money']]);
                    TaskUser::where('task_id', $request->id)->where('user_id', $user['id'])->update(['updated_at' => Carbon::now(), 'check'=>2]);
                    return response()->json(['code' => 200, 'status' => true, 'message' => 'Finish Task Successfully and User get money']);
                }else{
                    return response()->json(['code' => 403, 'status' => false, 'message' => 'You not finish this task']);
                }
                
            }
        } else {
            return response()->json(['code' => 404, 'status' => false, 'message' => 'Somethings wrong!']);
        }
    }
    public function sendCodePointTask(Request $request){
        $user=User::where('token', $request->token)->first();
        $code=TaskPointCode::where('task_id', $request->id)->where('point', $request->point)->first()->code;
        if(UserCheckCode::where('task_id', $request->id)->where('code', $code)->where('point', $request->point)->where('user_id', $user['id'])->get()->count()>0){
            return response()->json(['code'=>200,'status'=>true, 'message'=>'Code was send']);
        }else{
            UserCheckCode::create(['task_id'=>$request->id, 'code'=>$code, 'point'=>$request->point, 'user_id'=>$user['id']]);
            return response()->json(['code'=>200,'status'=>true, 'message'=>'Send Code to App Successfully', 'code'=>$code]);
        }
    }
}
