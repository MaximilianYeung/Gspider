<?php

namespace Gspider\Support;

class FreeDuty
{
    public static function saveImages($data, $path, $api)
    {
        $application = "\\Gspider\\Support\\SaveImages\\FreeDuty\\{$api}";

        return (new $application)->handle($data, rtrim($path, '\/'));
    }
}
