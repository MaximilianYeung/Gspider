<?php

declare(strict_types=1);

namespace Gspider\FreeDuty\Spider;

use Gspider\Http\Request;

class Category extends Request
{
    protected $gateway = '/goodsclass/getclass';

    public function spider($data)
    {
        return $this->get($data);
    }
}