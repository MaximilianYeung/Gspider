<?php

namespace Gspider\Support;

class DeWu
{
    public static function sign($data)
    {
        ksort($data);

        $str = '';
        foreach ($data as $k => $v) {
            if ($k != 'sign' && $v !== null) {
                $str .= $k . (is_array($v) ? json_encode($v) : $v);
            }
        }
        $str .= '19bc545a393a25177083d4a748807cc0';

        return md5($str);
    }

    public static function decrypt($data, $iv)
    {
        return openssl_decrypt(base64_encode(hex2bin($data)), 'AES-128-CBC', substr($iv, 0xA, 0x10), 0, substr($iv, 0x14, 0x10));
    }
}
