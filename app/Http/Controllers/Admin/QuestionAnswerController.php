<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\QuestionAnswer;
use Illuminate\Http\Request;
use App\Models\Task;
class QuestionAnswerController extends Controller
{
    public function index($id){
        // dd(Task::with('question_answer')->find($id)->toArray());
        $question_answers=QuestionAnswer::where('task_id', $id)->get();
        return View('question_answers.index', compact('question_answers', 'id'));
    }
    public function create(Request $request, $id){
        if($request->isMethod('post')){
            $data=$request->all();
            $data['task_id']=$id;
            $data['answer']=implode("|||",$data['answer']);
            QuestionAnswer::create($data);
            return redirect('/question_answer/task/'.$id)->with('success_message', 'T&#1073;&#1108;&#1038;o C&#1043;&#1118;u H&#1073;»&#1039;i v&#1043;  C&#1043;&#1118;u Tr&#1073;&#1108;&#1032; L&#1073;»&#1116;i Th&#1043; nh C&#1043;&#1169;ng');
        }
        return View('question_answers.create', compact('id'));
    }
    public function edit(Request $request,$question_answer_id, $task_id){
        $question_answer=QuestionAnswer::find($question_answer_id);
        if($request->isMethod('post')){
            $data=$request->all();
            $data['answer']=implode("|||",$data['answer']);
            $question_answer->update($data);
            return redirect('/question_answer/task/'.$task_id)->with('success_message', 'C&#1073;&#1108;­p Nh&#1073;&#1108;­t C&#1043;&#1118;u H&#1073;»&#1039;i v&#1043;  C&#1043;&#1118;u Tr&#1073;&#1108;&#1032; L&#1073;»&#1116;i Th&#1043; nh C&#1043;&#1169;ng');
        }
        return View('question_answers.edit', compact('question_answer_id', 'task_id', 'question_answer'));
    }
    public function delete($id){
        QuestionAnswer::find($id)->delete();
        return redirect()->back()->with('success_message', 'X&#1043;&#1110;a C&#1043;&#1118;u H&#1073;»&#1039;i v&#1043;  C&#1043;&#1118;u Tr&#1073;&#1108;&#1032; L&#1073;»&#1116;i Th&#1043; nh C&#1043;&#1169;ng');
    }
    public function deleteAll(Request $request){
        $data=$request->all();
        if(!empty($data['question_answer_id'])){
            $question_answers=QuestionAnswer::whereIn('id', $data['question_answer_id']);
            $question_answers->delete();
            return redirect()->back()->with('success_message', 'X&#1043;&#1110;a C&#1043;&#1118;u H&#1073;»&#1039;i v&#1043;  C&#1043;&#1118;u Tr&#1073;&#1108;&#1032; L&#1073;»&#1116;i &#1044;&#1106;&#1046;°&#1073;»&#1032;c Ch&#1073;»&#1036;n Th&#1043; nh C&#1043;&#1169;ng');
        }else{
            return redirect()->back()->with('error_message', 'C&#1043;&#1110; g&#1043;¬ &#1044;‘&#1043;&#1110; sai!');
        }
    }
}
