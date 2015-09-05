<?php
namespace App\Http\Controllers;

use App;
use Auth;
use DB;
use App\Models\ChatMessage;
use App\Models\User;
use Cache;

class WelcomeController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Welcome Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders the "marketing page" for the application and
	| is configured to only allow guests. Like most of the other sample
	| controllers, you are free to modify or remove it as you desire.
	|
	*/

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function index()
	{
		$user = Auth::user();
		$user = Cache::get('user'.$user->id);
		$profile = Cache::get('profile'.$user->id);
		$role_id = Cache::get('role_id'.$user->id)->role_id;
		if($role_id == 1 || $role_id == 2){
			return view('dashboard');
		}else {
			$project = DB::table('projects')->where('user_id','=',$user->id)->first();
			return view('dashboard_full_client_stat',['project'=>$project]);
		}

	}

}
