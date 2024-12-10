<?php

declare(strict_types=1);

namespace Gspider\MuYing\Spider;

use Gspider\Http\Request;

class Category extends Request
{
    protected $gateway = '/za/api/category/list';

    public function spider($data)
    {
        return $this->post($data);
    }
}