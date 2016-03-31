<?php 
namespace app\Http\Controllers;
use View;
use Auth;
use App\User;
use App\Event;
use App\Score;
use App\Question;


use Illuminate\Support\Facades\Redirect;
use Illuminate\Routing\Controller as BaseController;

define('redirect_home', "http://google.com");
class PagesController extends BaseController{


	public function root($event = null){
		$event = Event::where('event_name', $event)->first();
		if($event == null){
			return "event null @ root";
			return redirect(redirect_home);
		}
		if(Auth::check()){
			return Redirect::intended('battleground');
		}
		// dd($_SERVER);
		return View::make('welcome');
	}

	public function plexus_dashboard(){
		$ongoing = [];
		$upcoming = [];
		$events = Event::where('approve', 1)->get()->toArray();
		// For Indian time zone
		// adding 5:30 hrs (time IST is ahead of GMT)
		$now = time() + 5.5 * 60 * 60;
		foreach ($events as $event) {
			$start = strtotime($event['start_time']);
			$end = strtotime($event['end_time']);

			if($start < $now && $end > $now){
				array_push($ongoing, $event);
			}else{
				array_push($upcoming, $event);
			}
		}

		$return_values = ['ongoing'=> $ongoing , 'upcoming'=> $upcoming];
		return View::make('home', $return_values);
	}

	public function battleground($event){
		
		$event = Event::where('event_name', $event)->first();

		if($event == null){
			return "event null";
			return redirect(redirect_home);
		}

		$score = Score::where('user_id', Auth::user()->id)->where('event_id', $event->id)->first();
		$resume = 1;
		if($score == null){
			$resume = 0;
			$score = new Score;
			$score->user_id = Auth::user()->id;
			$score->event_id = $event->id;
			$score->level = 0;
			$score->score = 0;
			$score->save();
		}

		$start = strtotime($event->start_time);
		$end = strtotime($event->end_time);
		$now = time() + 5.5 * 60 * 60;

		if($end < $now){
			//Event has finished ...
			return Redirect::route('winners', $event);
		}else if($start < $now && $end > $now){
			//Event is ongoing ...
			if($score->level == $event->num_ques){
				// return 'a';
				return View::make('event_completed', ['event'=>$event, 'question'=>null]);
			}
			$ques = Question::where('event_id', $event->id)->where('level', $score->level +1)->first();


			return View::make('single_ans', ['event'=>$event, 
											'resume'=>$resume, 
											'question'=>$ques, 
											'level'=>($score->level)+1]);
			//return more values to spice it up?? 
		}else{
			//Event hasn't started yet ...
			return View::make('waiting_area');
			//can make this interesting ??
			//perhaps a waiting area.. ?  <<<---- To be done...
		}
	}

	public function dashboard_event(){
		$event = Event::where('event_name', $event)->first();
		if($event == null){
			return redirect(redirect_home);
		}

	}

	public function leaderboard($event_id){
		$event = Event::where('event_name', $event_id)->first();
		$performers = Score::where('event_id', $event->id)
							->orderBy('level', 'desc')
							->orderBy('updated_at')
							->take(10)->get()
							->toArray();
		$leaders = [];

		foreach ($performers as $someone) {
			$user = User::where('id', $someone['user_id'])->first();
			array_push($leaders, ['user'=>$user, 'score'=>$someone]);
		}
		return View::make('leaderboard', ['leaders'=>$leaders, 'event'=>$event]);
	}
}
?>