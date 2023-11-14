<?php

require __DIR__ . '/vendor/autoload.php';

use Gspider\Factory;

$freeDuty = Factory::FreeDuty(
    [
        'save_images_path' => './images/'
    ]
);

// 分类
$result = $freeDuty->Category(
    [
        'mnid' => '4',
        'mn_sid' => '654',
        'cid' => '2',
        'token' => '',
    ]
);

// 商品列表
// $result = $freeDuty->GoodsList(
//     [
//         'class_id' => '35',
//         'sort' => '1',
//         'limit' => '10',
//         'page' => '1',
//         'mnid' => '4',
//         'mn_sid' => '654',
//         'cid' => '2',
//         'token' => '',
//     ]
// );

// 详情
// $result = $freeDuty->GoodsInfo(
//     [
//         'goods_id' => '2740',
//         'cid' => '2',
//         'mnid' => '4',
//         'mn_sid' => '654',
//         'token' => '',
//         'spec_num' => '1'
//     ]
// );

print_r($result);
