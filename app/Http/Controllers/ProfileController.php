<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Auth;
use Cache;
use DB;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function show($id){
        $main_user = Auth::user()->id;
        $role_id = Cache::get('role_id'.$main_user)->role_id;

            $select_user = DB::table('users')->where('id','=',$id)->first();
            $select_profile = DB::table('profile')->where('user_id','=',$id)->first();

        if($role_id == 1 || $role_id == 2){
            return view('page.profile',['user'=>$select_user,'profile'=>$select_profile]);
        }else{
            $select_user = DB::table('users')->where('id','=',$main_user)->first();
            $select_profile = DB::table('profile')->where('user_id','=',$main_user)->first();
            return view('page.profile-lock',['user'=>$select_user,'profile'=>$select_profile]);
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Profile $profileModel,Request $request, $id)
    {
        //
        $validator = Validator::make($request->all(),[
            'name' => 'min:5|required|max:25',
            'email' => 'email',
            'password' => 'min:6'
        ]);

        $password = Input::get('password');

        if(!$validator->fails()){
            if($request->file('avatar') != null) {
                $user = User::findOrfail($id);
                $photo = explode('/',$request->file('avatar')->getClientMimeType());
                $photo = $photo[1];
                $rand = rand(0,100000000);
                $avatar = $user->id.'-'.$rand.'.'.$photo;
                $uri = $request->url();
                $request->file('avatar')->move('images/avatars',$avatar);
                $domain = env('APP_DOMAIN');
                $avatar = $domain.'/images/avatars/'.$user->id.'-'.$rand.'.'.$photo;
            }else{
                $avatar = $request->input('logo');
            }
            $update = $profileModel->getUpdateProfile($request->all(), $id, $avatar);
            return redirect()->route('index');
        }else{
            echo "ERROR";
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
