var user_id;
var second_id;
var date = new Date();

$(document).ready(function(){
    $('.direct-chat-messages').scrollTo('100%');
    user_id = $('#user_id').html();

    pullData()

    $("#send").click(function(){
        sendMessage();
    });

    $(document).keyup(function(e){

        if(e.keyCode === 13){
            sendMessage();
        }else{
           // isTyping();
        }
    });
});

function pullData(){
    retrieveChatMessage();
    //retrieveTypingStatus();
    setTimeout(pullData,3000);
}
function objToString (obj) {
    var str = '';
    for (var p in obj) {
        if (obj.hasOwnProperty(p)) {
            str += p + '::' + obj[p] + '\n';
        }
    }
    alert(str);
}
function retrieveChatMessage(){
    user_id = $('#user_id').html();
    second_id = $('#second_user_id').html();
    var token = $('#token').val();
    $.post('http://localhost/chat/retrieveChatMessage', {_token:token,user_id:user_id,second_user_id:second_id}, function(date){
        var json = JSON.parse(date);
        if(date.length >0)
            $('.direct-chat-messages').append(' <div class="direct-chat-msg"> <div class="direct-chat-info clearfix"> <span class="direct-chat-name pull-left">'+json.name+'</span> <span class="direct-chat-timestamp pull-right">' +json.date.date.split('.')[0]+'</span> </div><!-- /.direct-chat-info --> <img class="direct-chat-img" src="'+json.avatar+'" alt="message user image"><!-- /.direct-chat-img --> <div class="direct-chat-text" style="float: left;max-width:75%;word-wrap: break-word">'+json.message+' </div><!-- /.direct-chat-text --> </div><!-- /.direct-chat-msg -->').scrollTo('100%');
    });
}

function retrieveTypingStatus(){
    user_id = $('#user_id').html();
    second_id = $('#second_user_id').html();
    var token = $('#token').val();
    /*$.post('http://localhost/chat/retrieveTypingStatus', {_token:token,user_id:user_id,second_user_id:second_id}, function(date){
        //objToString(date);
        if(date.length >0) {
            $('#typing').html(date + ' is typing');
        }else {
            $('#typing').html(' ');
        }
    });*/
}

function sendMessage(){

    var message = $('#message').val();
    var clearChat = $('.direct-chat-messages').html();
    var token = $('#token').val();
    user_id = $('#user_id').html();
    second_id = $('#second_user_id').html();

        if(message.length > 0){
            var main_avatar = $('.pull-left:first img').attr('src');
            var user_name = $('.hidden-xs:first').html();
            $.post('http://localhost/chat/sendMessage', {_token:token,message: message, user_id:user_id,second_user_id:second_id}, function(){
                $('.direct-chat-messages').append("<div class='direct-chat-msg right'><div class='direct-chat-info clearfix'><span class='direct-chat-name pull-right'>"+user_name+"</span> <span class='direct-chat-timestamp pull-left'>"+date.getFullYear()+"-"+date.getMonth()+"-"+date.getDay()+" "+date.getHours()+":"+date.getMinutes()+":"+date.getSeconds()+"</span> </div><!-- /.direct-chat-info --> <img class='direct-chat-img' src='"+main_avatar+"' alt='message user image'><!-- /.direct-chat-img --> <div class='direct-chat-text' style='float: right;max-width:75%;word-wrap: break-word'>"+message+"</div><!-- /.direct-chat-text --> </div><!-- /.direct-chat-msg -->").scrollTo('100%');

                $('#message').val('');
                noTyping();
            });
        }

}

function isTyping(){

    user_id = $('#user_id').html();
    second_id = $('#second_user_id').html();
    var token = $('#token').val();
    $.post('http://localhost/chat/isTyping', {_token:token,user_id:user_id,second_user_id:second_id});
}

function noTyping(){
    user_id = $('#user_id').html();
    second_id = $('#second_user_id').html();
    var token = $('#token').val();
    $.post('http://localhost/chat/noTyping', {_token:token,user_id:user_id,second_user_id:second_id});
}