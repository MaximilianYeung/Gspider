<?php

declare(strict_types=1);

namespace Gspider;

use Gspider\Support\Str;
use Gspider\Exceptions\GspiderException;

class Factory
{

    public static function make($name, array $config = [])
    {
        $namespace = Str::studly($name);
        $application = "\\Gspider\\{$namespace}\\Application";

        if (class_exists($application)) {
            return new $application($config);
        }
        
        throw new GspiderException("class \"{$namespace}\" not found");
    }


    public static function __callStatic($name, $arguments)
    {
        return self::make($name, ...$arguments);
    }
}
