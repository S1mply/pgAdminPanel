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

class ProjectController extends Controller
{

    public function allProject(){
        $projects = DB::table('projects')->select('*')->join('users','projects.user_id','=','users.id')->get();
        return view('admin.page.project.all_project',['projects'=>$projects]);
    }

    public function projectAdd(){
        $client = DB::table('role_user')->join('users','users.id','=','role_user.user_id')->where('role_user.role_id','=','3')->get();

        for($i = 0; $i<count($client); $i++){
            $clients[$client[$i]->id] = $client[$i]->name;
        }
        return view('admin.page.project.add_project', ['client'=>$clients]);
    }

    public function projectSave(){
        $name = Input::get('name');
        $client = Input::get('client');
        $yandex_metrika = Input::get('yandex_metrika');

        $insert =  DB::table('projects')->insert(['project_name'=>$name, 'user_id'=>$client,'yandex_metrika'=>$yandex_metrika]);

        return redirect()->route('projects');
    }

}