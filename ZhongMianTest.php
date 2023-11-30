<?php

require __DIR__ . '/vendor/autoload.php';

use Gspider\Factory;

$zhongMian = Factory::ZhongMian(
    // [
    //     'save_images_path' => './zhongmian/'
    // ]
);

// $result = $zhongMian->category(
//     [
//         'merchantId' => '',
//         'purchaseType' => '1'
//     ]
// );

// $result = $zhongMian->GoodsList(
//     [
//         'filter' => (object)[],
//         'pageNumber' => 1,
//         'pageSize' => 20,
//         'keys' => (object)[
//             '4' => '020101',
//         ],
//         'order' => 1,
//         'activityIds' => (array)[],
//         'param' => (object)[
//             'source' => '2',
//             'scene' => 'suia',
//             'category' => '口红',
//             'order' => '1',
//             'merchantId' => '',
//             'categoryId' => '020101',
//             'purchaseType' => '1',
//         ],
//         'sceneId' => 0,
//         'source' => 2
//     ]
// );

// 详情
$result = $zhongMian->GoodsInfo(
    [
        'goodsId' => '61a98f3bcd881a0001950797',
        'purchaseType' => '1',
    ]
);

print_r($result);
