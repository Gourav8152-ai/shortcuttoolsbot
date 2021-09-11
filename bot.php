<?php
$update = json_decode(file_get_contents('php://input'), TRUE);
$message = $update["message"]["text"];
$chatId = $update["message"]["chat"]["id"];
$message_id = $update["message"]["message_id"];
$id = $update["message"]["from"]["id"];
$username = $update["message"]["from"]["username"];
$firstname = $update["message"]["from"]["first_name"];
$mention = "["+$username+"](tg://user?id="+str(id)+")";


if($message == "/start"){
    send_message($chat_id,$message_id, "Welcome To The Group $mention. \nUse /cmds to know the command.\n $WELCOME_MSG");
}

function send_message($chatId,$message_id, $message){
    $apiToken = $_ENV['TOKEN'];
    $text = urlencode($message);  
    file_get_contents("https://api.telegram.org/bot$apiToken/sendMessage?chat_id=$chat_id&reply_to_message_id=$message_id&text=$text&parse_mode=HTML");
}