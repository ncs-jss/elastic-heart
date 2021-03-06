<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Input;
use Auth;
use Redirect;
use View;
use Session;
use App\Society;
use App\Event;
use App\Answer;
use App\Message;
use App\Question;
use App\Score;
use App\User;
use App\UserDetails;
class QuestionsController extends BaseController
{
  use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
  public function __construct(){
    $this->middleware('auth');
  }
  public function addquestions(){
    $data = Input::all();
    $event = Event::where('id',Session::get('event_id'))->first();
    $question = new Question;
    $question->event_id = Session::get('event_id');
    $question->question = $data['question'];
    $image = array();
    if(isset($data['file'])){
      if (Input::file('file')->isValid()){
        $destinationPathvfile = 'uploads';
        $extensionvfile = Input::file('file')->getClientOriginalExtension(); 
      $fileNamevfile = $event->id.'.'.$extensionvfile; // renaming image
      Input::file('file')->move($destinationPathvfile, $fileNamevfile);
      $question->image = $fileNamevfile;
    }
  }
  if(isset($data['html'])){
    $question->html = $data['html'];      
  }
  if(intval($event->type) > 2){
   $question->options = serialize($data['options']);
   $answers = $data['answers'];
   $question->save();
   Session::put('qid',Question::all()->last()->id); 

   foreach($answers as $ans){
    $answer = new Answer;
    $answer->ques_id = Session::get('qid');
    $answer->answer = $ans;
    $answer->score = 1;
    $answer->incorrect = 0;
    $answer->save();
  }
}
else{
  $question->level = $data['level'];
  $question->save();
  Session::put('qid',Question::all()->last()->id);   
  $answer = new Answer;
  $answer->ques_id = Session::get('qid');
  $answer->answer = $data['answer'];
  $answer->score = 1;
  $answer->incorrect = 0;
  $answer->save();
}
Session::put('event_id',$event->id);

return Redirect::route('viewquestions',['event_id'=>$event->id])
->with('message','Question Successfully Added');
}

public function deletequestion($id)
{
  $data=Question::where('id','=',$id)->first();

   if(Auth::user()->privilege > 6 || 
  Event::where('id',$data->event_id)->first()->society_id == Auth::user()->id){    

  $event_id = $data->event_id;
  $data->delete();
  return Redirect::route('viewquestions',compact('event_id'))->with('message','Question Successfully Deleted');
  }
    else{
      return Redirect::route('dashboard')->with('error',"Access Denied");
    }

}

public function edit_question()
{

  $data = Input::all();
  $event = Event::where('id',Session::get('event_id'))->first();
  $question = Question::where('id','=',Session::get('qid'))->first();
  $question->event_id = Session::get('event_id');
  $question->question = $data['question'];
  $image = array();
  if(isset($data['file'])){
    if (Input::file('file')->isValid()){
      $destinationPathvfile = 'uploads';
      $extensionvfile = Input::file('file')->getClientOriginalExtension(); 
      $fileNamevfile = $event->id.'.'.$extensionvfile; // renaming image
      Input::file('file')->move($destinationPathvfile, $fileNamevfile);
      $question->image = $fileNamevfile;
    }
  }
  if(isset($data['html'])){
    $question->html = $data['html'];      
  }
  if(intval($event->type) > 2){
   $question->options = serialize($data['options']);
   $answers = $data['answers'];
   $question->save();
   Session::put('qid',Question::all()->last()->id); 
    $answer = Answer::where('ques_id','=',Session::get('qid'))->delete();

   foreach($answers as $ans){
    $answer = new Answer;
    $answer->ques_id = Session::get('qid');
    $answer->answer = $ans;
    $answer->score = 1;
    $answer->incorrect = 0;
    $answer->save();
  }
}
else{
  $question->level = $data['level'];
  $question->save();
  Session::put('qid',Question::all()->last()->id);  

  $answer = Answer::where('ques_id','=',Session::get('qid'))->first();
  $answer->ques_id = Session::get('qid');
  $answer->answer = $data['answer'];
  $answer->score = 1;
  $answer->incorrect = 0;
  $answer->save();
}
Session::put('event_id',$event->id);

return Redirect::route('viewquestions',['event_id'=>$event->id])->with('message','Question Successfully Edited');
}

/*public function edit_question()
{
  

    $data=Question::where('id','=',$id)->first();
    $event_id = $data->event_id;
    $data = Input::all();
    $question->event_id = Session::get('event_id');
    $question->question = $data['question'];
    $image = array();
    if(isset($data['file'])){
    if (Input::file('file')->isValid()){
      $destinationPathvfile = 'uploads';
      $extensionvfile = Input::file('file')->getClientOriginalExtension(); 
      $fileNamevfile = $event->id.'.'.$extensionvfile; // renaming image
      Input::file('file')->move($destinationPathvfile, $fileNamevfile);
      $question->image = $fileNamevfile;
    }
}



    if(isset($data['html'])){
      $question->html = $data['html'];      
    }
    if(intval($event->type) > 2){
     $question->options = serialize($data['options']);
     $answers = $data['answers'];
  $question->save();
  Session::put('qid',Question::all()->last()->id); 

     foreach($answers as $ans){
   
      $answer->ques_id = Session::get('qid');
      $answer->answer = $ans;
      $answer->score = 1;
      $answer->incorrect = 0;
      $answer->save();
    }
  }
  else{
    $question->level = $data['level'];
    $question->save();
  Session::put('qid',Question::all()->last()->id);   
    $answer->ques_id = Session::get('qid');
    $answer->answer = $data['answer'];
    $answer->score = 1;
    $answer->incorrect = 0;
    $answer->save();
  }
    Session::put('event_id',$event->id);

  return Redirect::route('edit_questions',compact('event_id'));
}*/

}