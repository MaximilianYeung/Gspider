<?php

require __DIR__ . '/vendor/autoload.php';

use Gspider\Factory;

$muYing = Factory::MuYing(
    [
        'save_images_path' => './images/'
    ]
);

// $result = $muYing->Category(
//     [
//         'fid' => '651',
//     ]
// );

$result = $muYing->GoodsList(
    [
        'cid' => 652,
        'page' => 1,
        'size' => 1
    ]
);

print_r($result);
