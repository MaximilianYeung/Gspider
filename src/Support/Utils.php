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

    /**
     * 文字输出
     *
     * @param  miexd $content
     * @return mixed
     */
    public static function e($content) {
        echo $content . '...' . PHP_EOL;
    }

    /**
     * 下载开始
     *
     * @param  miexd $content
     * @return mixed
     */
    public static function d($content) {
        self::e('正在下载' . $content);
    }

    /**
     * 下载完成
     *
     * @param  miexd $content
     * @return mixed
     */
    public static function f($content) {
        self::e($content . '下载完成');
    }
}
