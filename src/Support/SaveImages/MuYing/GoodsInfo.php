<?php

namespace Gspider\Support\SaveImages\MuYing;

use Gspider\Support\SaveImages\MuYing\GoodsList;

class GoodsInfo
{
    public function handle($data, $path)
    {
        return (new GoodsList)->handle(['list' => [$data]], $path)['list'][0];
    }
}
