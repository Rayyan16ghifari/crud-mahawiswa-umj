<?php
namespace App\Utils;

class Logger
{
    public static function log($action, $data = [])
    {
        $file = __DIR__ . "/../../log.txt";
        $time = date("Y-m-d H:i:s");
        $detail = json_encode($data);

        file_put_contents($file, "[$time][$action] $detail\n", FILE_APPEND);
    }
}
