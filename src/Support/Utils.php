<?php

namespace Gspider\Support;

class Utils
{
    /**
     * 创建目录
     *
     * @param  [type] $dir
     * @return void
     */
    public static function mkdirs($dir, $mode = 0777)
    {
        if (is_dir($dir) || @mkdir($dir, $mode)) {
            return true;
        }

        if (!self::mkdirs(dirname($dir), $mode)) {
            return false;
        }

        return @mkdir($dir, $mode);
    }

    /**
     * 判断http开头
     *
     * @param  string   $string
     * @return boolean
     */
    public static function isHttpPrefix($string) {
        return strpos($string, 'http') === 0;
    }
}
