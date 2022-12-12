<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\QuestionAnswer;

class QuestionAnswerController extends Controller
{
    public function index($id)
    {
        $question_answers = QuestionAnswer::where('task_id', $id)->get();
        if (!empty($question_answers)) {
            return response()->json(['code'=>200, 'status'=>true, 'question_answers' => $question_answers]);
        } else {
            return response()->json(['code'=>404, 'status'=>false, 'message' => 'Somethings wrong!']);
        }
    }
    // public function create(Request $request, $id)
    // {
    //     $data = $request->all();
    //     $data['task_id'] = $id;
    //     $data['answer'] = implode("|", $data['answer']);
    //     QuestionAnswer::create($data);
    //     return response()->json(['status' => 1, 'message' => 'Created Question Answer Successfully']);
    // }
    public function edit(Request $request, $question_answer_id, $task_id)
    {
        $question_answer = QuestionAnswer::find($question_answer_id);
        if(!empty($question_answer)){
        // if ($request->isMethod('post')) {
        //     $data = $request->all();
        //     $data['answer'] = implode("|", $data['answer']);
        //     $question_answer->update($data);
        //     return response()->json(['status' => 1, 'message' => 'Updated Question Answer Successfully']);
        // }
            return response()->json(['code'=>200, 'status'=>true, 'question_answer' => $question_answer]);
        }else{
            return response()->json(['code'=>404, 'status'=>false, 'message' => 'Somethings wrong!']);
        }
    }
    // public function delete($id)
    // {
    //     $question_answer=QuestionAnswer::find($id);
    //     if(!empty($question_answer)){
    //         $question_answer->delete();
    //         return response()->json(['status' => 1, 'message' => 'Updated Question Answer Successfully']);
    //     }else{
    //         return response()->json(['status' => 0, 'message' => 'Somethings wrong!']);
    //     }
    // }
    public function questionAnswer(){
        return response()->json(['code'=>200, 'status'=>true, 'question'=>QuestionAnswer::all()]);
    }
}
