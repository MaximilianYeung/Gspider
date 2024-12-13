<?php

require __DIR__ . '/vendor/autoload.php';

use Gspider\Factory;

$muYing = Factory::MuYing(
    [
        // 'save_images_path' => './images/' // 保存图片到本地
    ]
);

// $result = $muYing->Category(
//     [
//         'fid' => '651', // 父级id
//     ]
// );

// $result = $muYing->GoodsList(
//     [
//         'cid' => 652, // 分类id
//         'page' => 1,
//         'size' => 3
//     ]
// );

// $result = $muYing->GoodsInfo(
//     [
//         'productId' => 22860, // 商品id
//     ]
// );

// $result = $muYing->SpecList(
//     [
//         'productId' => 22860, // 商品id
//     ]
// );
