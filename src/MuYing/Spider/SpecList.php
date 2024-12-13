<?php

declare(strict_types=1);

namespace Gspider\MuYing\Spider;

use Gspider\Http\Request;

class SpecList extends Request
{
    protected $gateway = '/za/api/spec/select';

    public function spider($data)
    {
        return $this->post($data);
    }
}