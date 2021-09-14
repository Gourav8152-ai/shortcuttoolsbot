<?php

function dictionary($word){
    $result = file_get_contents("https://api.dictionaryapi.dev/api/v2/entries/en/$word");
    $result = json_decode($result,true);
    if (!$result) {
        exit;
    }else{
        $meaning = $result[0]['meanings'][0]['definitions'][0]['definition'];
        $meaning1 = $result[0]['meanings'][1]['definitions'][0]['definition'];
        $meaning2 = $result[0]['meanings'][2]['definitions'][0]['definition'];
        echo $meaning;
        echo "<br><br>";
        echo $meaning1;
        echo "<br><br>";
        echo $meaning2;
    }
}
?>