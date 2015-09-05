<?php
namespace App\Http\Controllers\Auth;

use Auth;
use DB;
use Cache;
use App\Models\User;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

class AuthController extends Controller {


	public function index(){
			return view('auth/login');

	}

	public function auth(){
		$email = Input::get('email');
		$password = Input::get('password');
		$remember = Input::get('remember_token');

		if(Auth::attempt(array('email'=>$email,'password'=>$password), $remember)){

			$select_user = DB::table('users')->where('email','=',$email)->first();
			$select_profile = DB::table('profile')->where('user_id','=',$select_user->id)->first();
			$expiresAt = Carbon::now()->addMinutes(480);
			$user= Cache::add('user'.$select_user->id, $select_user, $expiresAt);
			$profile = Cache::add('profile'.$select_user->id,$select_profile,$expiresAt);

			$profiles = User::find($select_user->id)->profile;
			$role_id = User::find($select_user->id)->roles[0]->pivot;

			$role_id = Cache::add('role_id'.$select_user->id,$role_id, $expiresAt);

			return redirect()->route('index');
		}else{
			return redirect()->route('login');
		}

	}

	public function logout(){
		$id = Auth::user()->id;
		Cache::forget('user'.$id );
		Cache::forget('profile'.$id );
		Cache::forget('role_id'.$id);
		Auth::logout();
		return redirect()->route('login');
	}

}
