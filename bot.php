<?php
 
$botToken = $_ENV['TOKEN'];
$website = "https://api.telegram.org/bot".$botToken;
error_reporting(0);
$update = file_get_contents('php://input');
$update = json_decode($update, TRUE);
$e = print_r($update);
 
 
$chatId = $update["message"]["chat"]["id"];    
$userId = $update["message"]["from"]["id"];   
$firstname = $update["message"]["from"]["first_name"];   
$username = $update["message"]["from"]["username"];    
$message = $update["message"]["text"];                
$message_id = $update["message"]["message_id"];       
$r_userId = $update["message"]["reply_to_message"]["from"]["id"];    
$r_firstname = $update["message"]["reply_to_message"]["from"]["first_name"]; 
$r_username = $update["message"]["reply_to_message"]["from"]["username"];
$r_msg_id = $update["message"]["reply_to_message"]["message_id"];
$info ="<b>ID : </b>$userId\n<b>First Name: </b>$firstname\n<b>Username : </b>@$username\n<b>Permanent Link : </b><a href='tg://user?id=$userId'>$firstname</a>";
$info = urlencode($info);
$info2 ="<b>ID : </b>$r_userId\n<b>First Name: </b>$r_firstname\n<b>Username : </b>@$r_username\n<b>Permanent Link : </b><a href='tg://user?id=$r_userId'>$r_firstname</a>";
$info2 = urlencode($info2);
$cmds11 = "NOT YET ADDED";

switch($message) {
       
        case "/start":
            sendMessage($chatId, "<b>Type /cmd to know the command! </b>");
            break;
        case "/cmd":
            sendMessage($chatId,"This are the command %0A$cmds11");
            break;
        case "/info":
            if($r_userId ===null){
               sendMessage($chatId,$info);
            }else{
                sendMessage($chatId,$info2);
            }
            break;
        case "/status";
            sendMessage($chatId, "<b>ALIVE</b>");
            break;
        case "Pin";
            pinChatMessage($chatId,$r_msg_id);
            deleteMessage($chatId, $message_id);
            break;
        case "Unpin";
            unpinChatMessage($chatId);
            deleteMessage($chatId, $message_id);
            break;
        case "del"; 
            deleteMessage($chatId, $r_msg_id);
            deleteMessage($chatId, $message_id);
            break;
}

function sendMessage ($chatId,$message) {
       
        $url = $GLOBALS[website]."/sendMessage?chat_id=$chatId&text=$message&reply_to_message_id=$message_id&parse_mode=HTML";
        file_get_contents($url);      
}
function pinChatMessage ($chatId,$r_msg_id) {
       
        $url = $GLOBALS[website]."/pinChatMessage?chat_id=$chatId&message_id=$r_msg_id&disable_notification=true";
        file_get_contents($url);       
}
function  deleteMessage ($chatId, $r_msg_id) {
       
        $url = $GLOBALS[website]."/deleteMessage?chat_id=$chatId&message_id=$r_msg_id";
        file_get_contents($url);
}
function unpinChatMessage ($chatId) {
       
        $url = $GLOBALS[website]."/unpinChatMessage?chat_id=$chatId";
        file_get_contents($url);
}
curl_close($ch);
ob_flush();

?>