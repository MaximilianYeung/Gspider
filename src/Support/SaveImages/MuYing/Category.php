<?php

namespace Gspider\Support\SaveImages\MuYing;

use Gspider\Support\Utils;
use Gspider\Exceptions\GspiderException;

class Category
{
    public function handle($data, $path)
    {
        // 图片保存目录
        $dir = $path . '/Category/';
        if (!Utils::mkdirs($dir)) {
            throw new GspiderException('创建图片目录失败');
        }
        $url = 'https://www.babyzhiai.net';

        $result = [];
        foreach ($data as $item) {
            if (!empty($item['categoryIcoUrl'])) {
                $fileName = $dir . $item['categoryId'] . '.png';
                $replaceImg = true;
                if (!file_exists($fileName)) {
                    Utils::d('分类图片');
                    $img = @file_get_contents((Utils::isHttpPrefix($item['categoryIcoUrl']) ? $item['categoryIcoUrl'] : $url . $item['categoryIcoUrl']));
                    if ($img) {
                        @file_put_contents($fileName, $img);
                    } else {
                        $replaceImg = false;
                    }
                }

                // 替换原图片数据地址
                if ($replaceImg) {
                    Utils::f('分类图片');
                    $item['categoryIcoUrl'] = $fileName;
                }
                $result[] = $item;
            }
        }

        return $result;
    }
}
