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

    switch ($message) {
        case '/start':
            sendMessage($chat_id,$r_message_id, "Welcome To The Group. \nUse /cmds to know the command.\n $WELCOME_MSG");
            break;
        case '/cmds':
            sendMessage($chat_id,$r_message_id, "<b>Here is the list of commands :</b>\n<code>/info </code>(To Know the info of the user)\n<code>/status </code>(To check bot is alive or not)");
            break;
        case 'info':
            sendMessage($chat_id,$r_message_id,"<b>ID : </b>$r_userId\n<b>First Name: </b>$r_firstname\n<b>Username : </b>@$r_username\n<b>Permanent Link : </b><a href='tg://user?id=$r_userId'>$r_firstname</a>");
            break;
        case '/status':
            sendMessage($chat_id,$r_message_id,"ACTIVE");
            break;
    }
}
function sendMessage($chat_id,$message_id, $message){
    $botToken = $_ENV['TOKEN'];
    $text = urlencode($message); 
    file_get_contents("https://api.telegram.org/bot$botToken/sendMessage?chat_id=$chat_id&reply_to_message_id=$message_id&text=$text&parse_mode=HTML");
}

?>