<?php

namespace App\Http\Controllers\Auth;

use App\Models\Role;
use Illuminate\Http\Request;

use App;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

use App\Models\User;

class RegisterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $authority = App::make('authority');
        $user = $authority->getCurrentUser();
        $role_id = $user->roles[0]->id;
        if($role_id == 2 || $role_id == 1){
            return view('auth/register');
        }else{
            return redirect()->route('index');
        }

    }

    public function register(Role $roleModel){

        $validator = Validator::make(Input::all(), array(
            'name' => 'min:1',
            'email' => array('required', 'email', 'unique:users'),
            'password' => array('required', 'confirmed')
        ));

        if($validator->passes()){
            $user = new User();
            $user->name = Input::get('name');
            $user->email = Input::get('email');
            $user->password = Hash::make(Input::get('password'));
            $user->save();

            $role = Input::get('role');
            $role_padding = $roleModel->getRoleId($role);
            $user->roles()->attach($role_padding);

            $phone = Input::get('phone');
            $company = Input::get('company');

            $profile = new App\Models\Profile();
            $profile->user_id = $user->id;
            $profile->phone = $phone;
            $profile->company = $company;
            $profile->save();

            return redirect()->route('index');
        }else{
            return redirect()->route('register');
        }

    }
}
