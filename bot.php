<?php
$update = json_decode(file_get_contents('php://input'), TRUE);

$message = $update["message"]["text"];
$chatId = $update["message"]["chat"]["id"];
$message_id = $update["message"]["message_id"];
$id = $update["message"]["from"]["id"];
$username = $update["message"]["from"]["username"];
$firstname = $update["message"]["from"]["first_name"];
$mention = "<a href='tg://user?id=$id'>$firstname</a>";
$info ="<b>ID : </b>$id\n<b>First Name: </b>$firstname\n<b>Username : </b>@$username\n<b>Permanent Link : </b><a href='tg://user?id=$id'>$firstname</a>";
$info = urlencode($info);
$welcome = $_ENV['WELCOME_MSG'];
$inputcmd = "NOT YET ADDED";
switch($message) {
    case "/start":
        sendMessage($chatId, "<b>Type /cmd to know the command! </b>");
        break;
    case "/cmd":
        sendMessage($chatId,"This are the command: \n$inputcmd");
        break;
    case "/info":
        sendMessage($chatId,$info);
        break;
    case "/status";
        sendMessage($chatId, "<b>ALIVE</b>");
        break;
}

function send_message($chatId,$message){
    $apiToken = $_ENV['TOKEN'];
    $text = urlencode($message);  
    file_get_contents("https://api.telegram.org/bot$apiToken/sendMessage?chat_id=$chatId&reply_to_message_id=$message_id&text=$text&parse_mode=HTML");
}