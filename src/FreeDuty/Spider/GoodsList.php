<?php

declare(strict_types=1);

namespace Gspider\FreeDuty\Spider;

use Gspider\Http\Request;

class GoodsList extends Request
{
    protected $gateway = '/Distribution/globalGoodsList';

    public function spider($data)
    {
        return $this->get($data);
    }
}