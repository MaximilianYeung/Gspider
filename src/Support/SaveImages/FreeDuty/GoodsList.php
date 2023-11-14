<?php

namespace Gspider\Support\SaveImages\FreeDuty;

use Gspider\Support\Utils;
use Gspider\Exceptions\GspiderException;

class GoodsList
{
    public function handle($data, $path)
    {
        // 图片保存目录
        $dir = $path . '/GoodsList/';
        if (!Utils::mkdirs($dir)) {
            throw new GspiderException('创建图片目录失败');
        }

        $result = [];
        foreach($data['list'] as $item) {
            try {
                if (!empty($item['img'])) {
                    $fileName = $dir . $item['id'] . '.png';
                    if (!file_exists($fileName)) {
                        file_put_contents($fileName, file_get_contents($item['img']));
                    }

                    // 替换原图片数据地址
                    $item['img'] = $fileName;
                    $result[] = $item;
                }
            } catch (\Exception $e) {
                throw new GspiderException('列表图片保存失败');
            }
        }

        return $result;
    }
}
