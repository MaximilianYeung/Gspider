<?php

namespace Gspider\Support\SaveImages\MuYing;

use Gspider\Support\Utils;
use Gspider\Exceptions\GspiderException;

class GoodsList
{
    public function handle($data, $path)
    {
        $imagePathMap = ['thumb', 'detail', 'images', 'sku', 'brand', 'country'];
        // 图片保存目录
        $dir = $path . '/GoodsInfo/';
        $url = 'http://imgcdn.babyzhiai.net';

        $dirMap = [];
        $result = [];
        foreach ($data['list'] as $item) {
            foreach ($imagePathMap as $imgPath) {
                $map = $dir . $item['id'] . '/' . $imgPath . '/';
                $dirMap[$item['id']][$imgPath] = $map;
                if (!Utils::mkdirs($map)) {
                    throw new GspiderException('创建图片目录失败');
                }
            }

            try {
                // 国家
                if (isset($item['moreInfo']) && isset($item['moreInfo']['countryImage'])) {
                    $fileName = $dirMap[$item['id']]['country'] . $item['moreInfo']['supplierId'] . '.png';
                    if (!file_exists($fileName)) {
                        file_put_contents($fileName, file_get_contents((Utils::isHttpPrefix($item['moreInfo']['countryImage']) ? $item['moreInfo']['countryImage'] : $url . $item['moreInfo']['countryImage'])));
                    }
                    $item['moreInfo']['countryImage'] = $fileName;
                }

                // 品牌
                if (!empty($item['brand_logo'])) {
                    $fileName = $dirMap[$item['id']]['brand'] . $item['brand_id'] . '.png';
                    if (!file_exists($fileName)) {
                        file_put_contents($fileName, file_get_contents((Utils::isHttpPrefix($item['brand_logo']) ? $item['brand_logo'] : $url . $item['brand_logo'])));
                    }
                    $item['brand_logo'] = $fileName;
                }

                // 缩略图
                if (!empty($item['small_img'])) {
                    $fileName = $dirMap[$item['id']]['thumb'] . $item['id'] . '.png';
                    if (!file_exists($fileName)) {
                        file_put_contents($fileName, file_get_contents((Utils::isHttpPrefix($item['small_img']) ? $item['small_img'] : $url . $item['small_img'])));
                    }
                    $item['small_img'] = $fileName;
                }

                // 组图
                if (isset($item['head_img'])) {
                    foreach ($item['head_img'] as $headIndex => $headImage) {
                        $fileName = $dirMap[$item['id']]['images'] . $headIndex . '.png';
                        if (!file_exists($fileName)) {
                            file_put_contents($fileName, file_get_contents((Utils::isHttpPrefix($headImage) ? $headImage : $url . $headImage)));
                        }
                        $item['head_img'][$headIndex] = $fileName;
                    }
                }

                // 详情图
                if (isset($item['desc_info']) && isset($item['desc_info']['imgs'])) {
                    foreach ($item['desc_info']['imgs'] as $bodyIndex => $bodyImage) {
                        $fileName = $dirMap[$item['id']]['detail'] . $bodyIndex . '.png';
                        if (!file_exists($fileName)) {
                            file_put_contents($fileName, file_get_contents((Utils::isHttpPrefix($bodyImage) ? $bodyImage : $url . $bodyImage)));
                        }
                        $item['desc_info']['imgs'][$bodyIndex] = $fileName;
                    }
                }

                // sku图
                if (isset($item['skus'])) {
                    foreach ($item['skus'] as $skuIndex => $skuImage) {
                        $fileName = $dirMap[$item['id']]['sku'] . $skuImage['sku_id'] . '.png';
                        if (!file_exists($fileName)) {
                            file_put_contents($fileName, file_get_contents((Utils::isHttpPrefix($skuImage['thumb_img']) ? $skuImage['thumb_img'] : $url . $skuImage['thumb_img'])));
                        }
                        $item['skus'][$skuIndex]['thumb_img'] = $fileName;
                    }
                }

                $result[] = $item;
            } catch (\Exception $e) {
                throw new GspiderException('详情图片保存失败');
            }
        }

        $data['list'] = $result;
        return $data;
    }
}
