<?php
require_once __DIR__ . '/vendor/autoload.php';


if (array_key_exists("TOKEN", $_ENV)){
    $token = $_ENV["TOKEN"];
} else {
    $token = file_get_contents("token");
}
$aqm = new \App\Models\ApiQueryMaker($token);


$data = file_get_contents("php://input");


$message = json_decode($data, true);

file_put_contents("log", $data . PHP_EOL, FILE_APPEND | LOCK_EX);

$msgtxt = $message["message"]["text"];
$chat_id = $message["message"]["chat"]["id"];
if ($msgtxt === "/start") {
    $response = $aqm->send_message($chat_id , "Привет!\nЯ - бот, произносящий гласный по его научному названию.\n Например так: \"open front unrounded (vowel)\"");
} else {
    $l = \App\Controllers\BotController::get_letter($msgtxt);
    if ($l){
        $response = $aqm->send_message($chat_id , $l);
    } else {
        $list = \App\Controllers\BotController::get_all_vowels();
        $response = $aqm->send_message($chat_id , "Я не знаю такого гласного.\nВот всё что я знаю:\n$list");
    }
}





