<?php

namespace App\Models;

use DB;
use Illuminate\Support\Facades\Hash;
use Faker\Provider\File;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Profile extends Model
{

    protected $table = 'profile';
    protected $fillable = ['user_id', 'company', 'phone','avatar'];

    public function getUserProfile($id)
    {
        $profile = DB::table('users')->join('profile', "users.id",'=','profile.user_id')->select('*')->where('users.id', '=', $id)->get();

        return $profile;
    }

    public function getUpdateProfile($profile,$id, $avatar){
        $user_password = DB::table('users')->where('id','=',$id)->first();
        if($user_password->password == $profile['password']){
            $password = $profile['password'];
        }else{
            $password = Hash::make($profile['password']);
        }
        $user_update = DB::table('users')->where('id','=',$id)->update(['name'=>$profile['name'], 'password' => $password]);
        $profile_update = DB::table('profile')->where('user_id','=',$id)->update(['company'=>$profile['company'], 'phone' => $profile['phone'],'avatar'=>$avatar]);
    }
}
