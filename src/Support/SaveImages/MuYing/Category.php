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
        foreach($data as $item) {
            try {
                if (!empty($item['categoryIcoUrl'])) {
                    $fileName = $dir . $item['categoryId'] . '.png';
                    if (!file_exists($fileName)) {
                        file_put_contents($fileName, file_get_contents((Utils::isHttpPrefix($item['categoryIcoUrl']) ? $item['categoryIcoUrl'] : $url . $item['categoryIcoUrl'])));
                    }

                    // 替换原图片数据地址
                    $item['categoryIcoUrl'] = $fileName;
                    $result[] = $item;
                }
            } catch (\Exception $e) {
                throw new GspiderException('分类图片保存失败');
            }
        }

        return $result;
    }
}
