<?php

$content = file_get_contents("php://input");
$update = json_decode($content, true);
if (!$update) {
    exit;
}else{
    $message = $update['message']['text'];
    $chat_id = $update['message']['chat']['id'];
    $message_id = $update['message']['message_id'];
    $WELCOME_MSG = $_ENV['WELCOME_MSG'];

    if (strpos($text, "/start") === 0) {
        sendMessage($chat_id,$message_id, "Welcome To The Group. \nUse /cmds to know the command.\n $WELCOME_MSG");
    }
}
function sendMessage($chat_id,$message_id, $message){
    $botToken = $_ENV['TOKEN'];
    $text = urlencode($message); 
    file_get_contents("https://api.telegram.org/bot$botToken/sendMessage?chat_id=$chat_id&reply_to_message_id=$message_id&text=$text&parse_mode=HTML");
}

?>