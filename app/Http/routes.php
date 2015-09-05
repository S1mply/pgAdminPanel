<?php


View::composer(['dashboard','header','sidebar','admin.*'], function($view){
    if(Auth::user()){
        $main_user = Auth::user()->id;
        $user = \Illuminate\Support\Facades\Cache::get('user'.$main_user);
        $profile = \Illuminate\Support\Facades\Cache::get('profile'.$main_user);
        $role_id = \Illuminate\Support\Facades\Cache::get('role_id'.$main_user);
        $view->with(['user'=>$user, 'profile' => $profile,'role_id'=>$role_id]);
    }
});


Route::get('/',['as' => 'index', 'uses' => 'WelcomeController@index']);

Route::get('/date',function(){

});

/* Авторизация (Authentication) */
Route::get('/auth/login', ['as' => 'login', 'uses' => 'Auth\AuthController@index']);
Route::get('/auth/logout', ['as' => 'logout', 'uses' => 'Auth\AuthController@logout']);
Route::post('/auth/login', ['as' => 'sing', 'uses' => 'Auth\AuthController@auth']);

/* Регистрация (Register)  */

Route::get('/user/register', ['as' => 'register', 'uses' => 'Auth\RegisterController@index']);
Route::post('/user/register', ['as' => 'reg', 'uses' => 'Auth\RegisterController@register']);

/*  Пользователи(Users)  */

Route::get('/user',['as'=>'users','middleware' => 'users', 'uses' =>'admin\UsersController@allUsers']);

/* Прифиль (Profile) */

//Route::get('/user/profile/{id}', ['as' => 'profile', 'uses' => 'ProfileController@index']);
$router->resource('profile', 'ProfileController');


/* Проекты (Projects) */

Route::get('/projects',['as'=>'projects','middleware' => 'users', 'uses' =>'admin\ProjectController@allProject']);
Route::get('/projects/add',['as'=>'projectAdd','middleware' => 'users', 'uses' =>'admin\ProjectController@projectAdd']);
Route::post('/projects/save',['as'=>'projectSave','middleware' => 'users', 'uses' =>'admin\ProjectController@projectSave']);

/* Диологи(Chat) */

Route::get('/chat/{main_id}',['as'=> 'chat', 'uses' => 'ChatController@index']);

Route::post('chat/sendMessage', ['uses'=> 'ChatController@sendMessage']);
Route::post('chat/isTyping', ['uses'=> 'ChatController@isTyping']);
Route::post('chat/noTyping', ['uses'=> 'ChatController@noTyping']);
Route::post('chat/createChat',['uses'=>'ChatController@createChat']);
Route::post('chat/retrieveChatMessage',['uses'=>'ChatController@retrieveChatMessage']);
Route::post('chat/retrieveTypingStatus',['uses'=>'ChatController@retrieveTypingStatus']);