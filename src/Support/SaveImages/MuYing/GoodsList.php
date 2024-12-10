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

            // 国家
            if (isset($item['moreInfo']) && isset($item['moreInfo']['countryImage'])) {
                $fileName = $dirMap[$item['id']]['country'] . $item['moreInfo']['supplierId'] . '.png';
                $replaceImg = true;
                if (!file_exists($fileName)) {
                    $countryImg = @file_get_contents((Utils::isHttpPrefix($item['moreInfo']['countryImage']) ? $item['moreInfo']['countryImage'] : $url . $item['moreInfo']['countryImage']));
                    if ($countryImg) {
                        @file_put_contents($fileName, $countryImg);
                    } else {
                        $replaceImg = false;
                    }
                }
                if ($replaceImg) {
                    $item['moreInfo']['countryImage'] = $fileName;
                }
            }

            // 品牌
            if (!empty($item['brand_logo'])) {
                $fileName = $dirMap[$item['id']]['brand'] . $item['brand_id'] . '.png';
                $replaceImg = true;
                if (!file_exists($fileName)) {
                    $brandLogo = @file_get_contents((Utils::isHttpPrefix($item['brand_logo']) ? $item['brand_logo'] : $url . $item['brand_logo']));
                    if ($brandLogo) {
                        @file_put_contents($fileName, $brandLogo);
                    } else {
                        $replaceImg = false;
                    }
                }
                if ($replaceImg) {
                    $item['brand_logo'] = $fileName;
                }
            }

            // 缩略图
            if (!empty($item['small_img'])) {
                $fileName = $dirMap[$item['id']]['thumb'] . $item['id'] . '.png';
                $replaceImg = true;
                if (!file_exists($fileName)) {
                    $smallImg = @file_get_contents((Utils::isHttpPrefix($item['small_img']) ? $item['small_img'] : $url . $item['small_img']));
                    if ($smallImg) {
                        @file_put_contents($fileName, $smallImg);
                    } else {
                        $replaceImg = false;
                    }
                }
                if ($replaceImg) {
                    $item['small_img'] = $fileName;
                }
            }

            // 组图
            if (isset($item['head_img'])) {
                foreach ($item['head_img'] as $headIndex => $headImage) {
                    $fileName = $dirMap[$item['id']]['images'] . $headIndex . '.png';
                    $replaceImg = true;
                    if (!file_exists($fileName)) {
                        $headImageImg = @file_get_contents((Utils::isHttpPrefix($headImage) ? $headImage : $url . $headImage));
                        if ($headImageImg) {
                            @file_put_contents($fileName, $headImageImg);
                        } else {
                            $replaceImg = false;
                        }
                    }
                    if ($replaceImg) {
                        $item['head_img'][$headIndex] = $fileName;
                    }
                }
            }

            // 详情图
            if (isset($item['desc_info']) && isset($item['desc_info']['imgs'])) {
                foreach ($item['desc_info']['imgs'] as $bodyIndex => $bodyImage) {
                    $fileName = $dirMap[$item['id']]['detail'] . $bodyIndex . '.png';
                    $replaceImg = true;
                    if (!file_exists($fileName)) {
                        $bodyImageImg = @file_get_contents((Utils::isHttpPrefix($bodyImage) ? $bodyImage : $url . $bodyImage));
                        if ($bodyImageImg) {
                            @file_put_contents($fileName, $bodyImageImg);
                        } else {
                            $replaceImg = false;
                        }
                    }
                    if ($replaceImg) {
                        $item['desc_info']['imgs'][$bodyIndex] = $fileName;
                    }
                }
            }

            // sku图
            if (isset($item['skus'])) {
                foreach ($item['skus'] as $skuIndex => $skuImage) {
                    $fileName = $dirMap[$item['id']]['sku'] . $skuImage['sku_id'] . '.png';
                    $replaceImg = true;
                    if (!file_exists($fileName)) {
                        $skuImageImg = @file_get_contents((Utils::isHttpPrefix($skuImage['thumb_img']) ? $skuImage['thumb_img'] : $url . $skuImage['thumb_img']));
                        if ($skuImageImg) {
                            @file_put_contents($fileName, $skuImageImg);
                        } else {
                            $replaceImg = false;
                        }
                    }
                    if ($replaceImg) {
                        $item['skus'][$skuIndex]['thumb_img'] = $fileName;
                    }
                }
            }

            $result[] = $item;
        }

        $data['list'] = $result;
        return $data;
    }
}
