<?php
use CodeIgniter\I18n\Time;

define('HASH_PASSWORD', 'PRC_HASH_PASSWORD_@#$2018');

if (!function_exists('groupBy')) {

    function groupBy($array, $key): array
    {
        $return = array();
        foreach ($array as $val) {
            $return[$val[$key]][] = $val;
        }
        return $return;
    }
}

if (!function_exists('getCountryInformationByCountryCode')) {

    function getCountryInformationByCountryCode()
    {


    }

}


if (!function_exists('generateRandomToken')) {

    function generateRandomToken(): string
    {
        $temp_token = openssl_random_pseudo_bytes(32) . time();
        $token = bin2hex($temp_token);
        return $token;

    }

}


if (!function_exists('generateRandomPassword')) {
    function generateRandomPassword(): string
    {
        $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $pass = array(); //remember to declare $pass as an array
        $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
        for ($i = 0; $i < 8; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        return implode($pass); //turn the array into a string
    }
}


if (!function_exists('generateRandomString')) {
    function generateRandomString($length = 8): string
    {
        $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $string = array(); //remember to declare $pass as an array
        $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
        for ($i = 0; $i < $length; $i++) {
            $n = rand(0, $alphaLength);
            $string[] = $alphabet[$n];
        }
        return implode($string); //turn the array into a string
    }
}

if (!function_exists('encrypto')) {
    function encrypto($password)
    {
        return md5(HASH_PASSWORD . $password);
    }
}

if (!function_exists('getDateBefore')) {
    function getDateBefore($count, $type)
    {
        $before2Days = new Time('-'.$count .' '.$type);
        return $before2Days->toDateTimeString();
    }
}


if (!function_exists('getDateAfter')) {
    function getDateAfter($count, $type)
    {
        $before2Days = new Time('+'.$count .' '.$type);
        return $before2Days->toDateTimeString();
    }
}
if (!function_exists('slug')) {
    function slug($string, $spaceRepl = "-")
    {
        $string = str_replace("&", "and", $string);

        $string = preg_replace("/[^a-zA-Z0-9 _-]/", "", $string);

        $string = strtolower($string);

        $string = preg_replace("/[ ]+/", " ", $string);

        $string = str_replace(" ", $spaceRepl, $string);

        return $string;
    }
}
