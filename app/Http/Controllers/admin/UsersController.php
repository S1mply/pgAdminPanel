<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Auth;
use DB;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class UsersController extends Controller
{

    public function allUsers(){
        $users = DB::table('users')->join('profile','users.id','=','profile.user_id')->join('role_user','users.id','=','role_user.user_id')->where('role_user.role_id','=','3')->get();
        return view('admin.page.all_users',['users'=>$users]);
    }
}