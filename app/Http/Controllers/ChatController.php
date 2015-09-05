<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\ChatMessage;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;
use Auth;
use DB;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

class ChatController extends Controller
{

    public function index($id){
        $chat_message = new ChatMessage();


        $main_user = Auth::user();
        $main_user_profile = $main_user->find($main_user->id)->profile;


        $second_user = new User();
        $second_user = $second_user->find($id);
        $second_user_profile = $second_user->find($id)->profile;

        $message = $chat_message->where('sender_user_id','=',$main_user->id)->where('send_to','=',$id)->orWhere('sender_user_id','=',$id)->where('send_to','=',$main_user->id)->get();

        $no_read_message = $chat_message->where('sender_user_id','=',$main_user->id)->where('send_to','=',$id)->where('read',false)->orWhere('sender_user_id','=',$id)->where('send_to','=',$main_user->id)->where('read','=',false)->get();

        foreach($no_read_message as $no_read){
            $no_read->read = true;
            $no_read->save();
        }

        return view('page/chat',['user' =>$main_user, 'profile'=>$main_user_profile, 'second_user' => $second_user, 'second_profile' => $second_user_profile, 'message'=>$message]);



    }

    public function sendMessage(){
        $user_id = Input::get('user_id');
        $message = Input::get('message');
        $second_user_id = Input::get('second_user_id');

        $chat_message = new ChatMessage();
        $chat_message->sender_user_id = $user_id;
        $chat_message->send_to = $second_user_id;
        $chat_message->message = $message;
        $chat_message->save();
    }

    public function createChat(Request $request){
        $main_user_id = Input::get('user_id');
        $second_user_id = Input::get('second_user_id');

        $chat = new Chat();
        $chat->user1_id = $main_user_id;
        $chat->user2_id = $second_user_id;
        $chat->save();
    }

    public function isTyping(){
        $user_id = Input::get('user_id');
        $second_user_id = Input::get('second_user_id');
        $chat = new Chat();
        $chat = $chat->where('user1_id','=',$user_id)->where('user2_id', '=', $second_user_id)->first();

        if($chat['user1_id'] == $user_id){
            $chat->user1_typing = true;
            Chat::where('user1_id','=',$user_id)->where('user2_id', '=', $second_user_id)->update(array('user1_typing'=>true));
        }else{
            Chat::where('user1_id','=',$user_id)->where('user2_id', '=', $second_user_id)->update(array('user2_typing'=>true));
        }

    }

    public function noTyping(){
        $user_id = Input::get('user_id');
        $second_user_id = Input::get('second_user_id');
        $chat = new Chat();
        $chat = $chat->where('user1_id','=',$user_id)->where('user2_id', '=', $second_user_id)->first();
        if($chat->user1_id == $user_id){
            $chat->user1_typing = false;
        }else{
            $chat->user2_typing = false;
        }
        $chat->save();
    }

    public function retrieveChatMessage(){
        $user_id = Input::get('user_id');
        $second_user_id = Input::get('second_user_id');
        $chat_message = new ChatMessage();
        $profile = new Profile();
        $user = new User();
        //$message = DB::select('SELECT * FROM `chats_messages` WHERE (`send_to` =`'.$user_id.'` AND `sender_user_id` =`'.$second_user_id.'` AND `read` = false)');
        $message = $chat_message->where('send_to','=',$user_id)->where('sender_user_id','=',$second_user_id)->where('read','=',false)->first();
        $profile = $profile->where('user_id','=',$second_user_id)->first();
        $user = $user->where('id','=',$second_user_id)->first();

        if(count($message) > 0){
            $message->read = true;
            $message->save();
            $all_date = array('message'=>$message->message,'name'=>$user->name,'avatar'=>$profile->avatar,'date'=>$message->created_at);
            return json_encode($all_date);
        }
    }

    public function retrieveTypingStatus(){
        $user_id = Input::get('user_id');
        $second_user_id = Input::get('second_user_id');

        $chat = new Chat();
        $chat = $chat->select('*')->where('user1_id','=',$user_id)->where('user2_id', '=', $second_user_id)->first();
        if($chat->user1_id == $user_id){
            if($chat->user2_typing == 1){
                return $chat->user2_id;
            }
        }else{
            if($chat->user1_typing == 1){
                return $chat->user1_id;
            }
        }
    }
}
