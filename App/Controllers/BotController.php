<?php
namespace App\Controllers;


class BotController
{
    public static $diagram = [
        "open front unrounded" => "a",
        "close front unrounded" => "i",
        "close back rounded" => "u",
        "close-mid front unrounded" => "e",
        "close-mid back rounded" => "o",
    ];


    public static function get_letter($text){
        $temp = "";
        try{
            $temp = self::$diagram[$text];
        } catch (Exception $e){
            return false;
        }
        return $temp;
    }


    public static function get_all_vowels(){
        $res = "";
        foreach (self::$diagram as $k => $v) {
            $res = $res . $v . ": " . $k . "\n";
        }
        return $res;
    }
}

