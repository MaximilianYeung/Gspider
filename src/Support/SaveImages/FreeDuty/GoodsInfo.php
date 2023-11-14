<?php

namespace Gspider\Support\SaveImages\FreeDuty;

use Gspider\Support\Utils;
use Gspider\Exceptions\GspiderException;

class GoodsInfo
{
    public function handle($data, $path)
    {
        $imagePathMap = ['img', 'body', 'brand_pic', 'attach'];
        // 图片保存目录
        $dir = $path . '/GoodsInfo/';
        foreach($imagePathMap as $imgPath) {
            if (!Utils::mkdirs($dir . $imgPath . '/')) {
                throw new GspiderException('创建图片目录失败');
            }
        }

        // 正则匹配详情图
        preg_match_all("/<img.*?src=[\"|\'](.*?)[\"|\'].*?>/i", $data['body'], $match);
        $bodyImages = $match[1] ?? [];
        
        try {
            // 主图
            if (!empty($data['img'])) {
                $fileName = $dir .'img/' . $data['id'] . '.png';
                if (!file_exists($fileName)) {
                    file_put_contents($fileName, file_get_contents($data['img']));
                }

                // 替换原图片数据地址
                $data['img'] = $fileName;
            }

            // 品牌图
            if (!empty($data['brand_pic'])) {
                $brandFileName = $dir .'brand_pic/' . $data['id'] . '.png';
                if (!file_exists($brandFileName)) {
                    file_put_contents($brandFileName, file_get_contents($data['brand_pic']));
                }

                // 替换原图片数据地址
                $data['brand_pic'] = $brandFileName;
            }

            // 详情图
            if (!empty($bodyImages)) {
                $bodyPathData = [];
                foreach ($bodyImages as $bodyImageIndex => $bodyImage) {
                    $bodyFileName = $dir .'body/' . $data['id'] . '-' . $bodyImageIndex . '.png';
                    if (!file_exists($bodyFileName)) {
                        file_put_contents($bodyFileName, file_get_contents($bodyImage));
                    }
                    $bodyPathData[] = $bodyFileName;
                }
                $data['body'] = $bodyPathData;
            }

            // 附加图
            if (!empty($data['attach'])) {
                $attachPathData = [];
                foreach ($data['attach'] as $attachIndex => $attach) {
                    $attachFileName = $dir .'attach/' . $data['id'] . '-' . $attachIndex . '.png';
                    if (!file_exists($attachFileName)) {
                        file_put_contents($attachFileName, file_get_contents($attach['url']));
                    }
                    $attachPathData[] = $attachFileName;
                }
                $data['attach'] = $attachPathData;
            }

        } catch (\Exception $e) {
            throw new GspiderException('详情图片保存失败');
        }

        return $data;
    }
}
