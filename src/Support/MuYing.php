<?php

namespace Gspider\Support;

class MuYing
{
    public static function saveImages($data, $path, $api)
    {
        $application = "\\Gspider\\Support\\SaveImages\\MuYing\\{$api}";

        return (new $application)->handle($data, rtrim($path, '\/'));
    }
}
