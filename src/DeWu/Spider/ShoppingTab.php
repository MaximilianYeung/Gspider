<?php

declare(strict_types=1);

namespace Gspider\DeWu\Spider;

use Gspider\Http\Request;

class ShoppingTab extends Request
{
    protected $gateway = '/api/v1/h5/index/fire/shopping-tab';

    public function spider($data)
    {
        return $this->post($data);
    }
}