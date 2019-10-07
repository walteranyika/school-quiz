<?php

namespace App\Http\Controllers;

use App\Answer;
use App\Question;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    public function index()
    {
       $questions=Question::all();
       return view('quiz',compact('questions'));
    }

    public function store(Request $request)
    {
        $request->validate([
          'name'=>'required|min:5',
          'phone'=>'required',
          'school'=>'required',
          'total'=>'required',
          'email'=>'sometimes|email'
        ]);
        //collect all the results
        $name= $request->name;
        $phone= $request->phone;
        $school= $request->school;
        $total= $request->total;
        $email= $request->email;
        //clean the results
        $scores= $request->all();
        unset($scores["name"]);
        unset($scores["_token"]);
        unset($scores["phone"]);
        unset($scores["school"]);
        unset($scores["total"]);
        unset($scores["email"]);
        //process the results
        $score=0;
        foreach($scores as $key=>$value){
            $id = str_replace("q_","",$key);
            $question = Question::findOrFail($id);
            if ($question->ans==$value){
                $score++;
            }
        }
        $result = $score/$total;

        $result=Answer::create([
            'name'=>$name,
            'score'=>$result,
            'phone'=>$phone,
            'school'=>$school,
            'email'=>$email,
        ]);

        return view('quiz',compact('result'));
    }
}
