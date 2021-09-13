<?php

$content = file_get_contents("php://input");
$update = json_decode($content, true);
if (!$update) {
    exit;
}else{
    $message = $update['message']['text'];
    $chat_id = $update['message']['chat']['id'];
    $message_id = $update['message']['message_id'];
    $user_id = $update['message']['from']['id'];
    $first_name = $update['message']['from']['first_name'];
    $username = $update['message']['from']['username'];
    $r_user_id = $update['message']['reply_to_message']['from']['id'];
    $r_first_name = $update['message']['reply_to_message']['from']['first_name'];
    $r_username = $update['message']['reply_to_message']['from']['username'];
    $r_message_id = $update['message']['reply_to_message']['message_id'];
    $WELCOME_MSG = $_ENV['WELCOME_MSG'];

    if (!$r_user_id){
        $r_user_id = $user_id;
        $r_first_name = $first_name;
        $r_username = $first_name;
        $r_message_id = $message_id;
    }


    if (strpos($message, "/start") === 0) {
        sendMessage($chat_id,$r_message_id, "Welcome To The Group. \nUse /cmds to know the command.\n $WELCOME_MSG");
    }elseif (strpos($message, "/cmds") === 0) {
        sendMessage($chat_id,$r_message_id, "Not yet added");
    }elseif (strpos($message, "/info") === 0) {
        sendMessage($chat_id,$r_message_id,"<b>ID : </b>$r_user_id\n<b>First Name: </b>$r_first_name\n<b>Username : </b>@$r_username\n<b>Permanent Link : </b><a href='tg://user?id=$r_user_id'>$r_first_name</a>");
    }elseif (strpos($message, "/status") === 0) {
        sendMessage($chat_id,$r_message_id,"ACTIVE");
    }
}
function sendMessage($chat_id,$message_id, $message){
    $botToken = $_ENV['TOKEN'];
    $text = urlencode($message); 
    file_get_contents("https://api.telegram.org/bot$botToken/sendMessage?chat_id=$chat_id&reply_to_message_id=$message_id&text=$text&parse_mode=HTML");
}

?>
