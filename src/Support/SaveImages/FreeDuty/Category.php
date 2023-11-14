<?php

namespace Gspider\Support\SaveImages\FreeDuty;

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

        $result = [];
        foreach($data as $item) {
            try {
                if (!empty($item['icon'])) {
                    $fileName = $dir . $item['id'] . '.png';
                    if (!file_exists($fileName)) {
                        file_put_contents($fileName, file_get_contents($item['icon']));
                    }

                    // 替换原图片数据地址
                    $item['icon'] = $fileName;

                    // 递归处理子分类
                    if (!empty($item['son'])) {
                        $item['son'] = $this->handle($item['son'], $path);
                    }
                    $result[] = $item;
                }
            } catch (\Exception $e) {
                throw new GspiderException('分类图片保存失败');
            }
        }

        return $result;
    }
}
