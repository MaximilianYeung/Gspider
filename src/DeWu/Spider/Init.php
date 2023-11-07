<?php

declare(strict_types=1);

namespace Gspider\DeWu\Spider;

use Gspider\Http\Request;

class Init extends Request
{
    protected $gateway = '/api/v1/h5/index/fire/init';

    public function spider($data)
    {
        return $this->post($data);
    }
}