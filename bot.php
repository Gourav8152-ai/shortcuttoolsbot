<?php
$update = json_decode(file_get_contents('php://input'), TRUE);
$message = $update["message"]["text"];
$chatId = $update["message"]["chat"]["id"];
$message_id = $update["message"]["message_id"];
$id = $update["message"]["from"]["id"];
$username = $update["message"]["from"]["username"];
$firstname = $update["message"]["from"]["first_name"];
$mention = "<a href='tg://user?id=$id'>$firstname</a>";
$r_userId = $update["message"]["reply_to_message"]["from"]["id"];
$r_firstname = $update["message"]["reply_to_message"]["from"]["first_name"]; 
$r_username = $update["message"]["reply_to_message"]["from"]["username"];
$r_msg_id = $update["message"]["reply_to_message"]["message_id"];
$info ="<b>ID : </b>$id\n<b>First Name: </b>$firstname\n<b>Username : </b>@$username\n<b>Permanent Link : </b><a href='tg://user?id=$id'>$firstname</a>";
$info = urlencode($info);
$info2 ="<b>ID : </b>$r_userId\n<b>First Name: </b>$r_firstname\n<b>Username : </b>@$r_username\n<b>Permanent Link : </b><a href='tg://user?id=$r_userId'>$r_firstname</a>";
$info2 = urlencode($info2);
$welcome = $_ENV['WELCOME_MSG'];

if($message == "/start"){
    send_message($chat_id,$message_id, "Welcome To The Group $mention. \nUse /cmds to know the command.\n $welcome");
}elseif($message == "/info"){
    if($r_userId == null){
        sendMessage($chatId,$message_id,$info);
    }else{
        send_message($chatId,$message_id,$info2);
    }
}

function send_message($chatId,$message_id,$message){
    $apiToken = $_ENV['TOKEN'];
    $text = urlencode($message);  
    file_get_contents("https://api.telegram.org/bot$apiToken/sendMessage?chat_id=$chatId&reply_to_message_id=$message_id&text=$text&parse_mode=HTML");
}