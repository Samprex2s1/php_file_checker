<?php

namespace App\Http\Controllers;

use App\Services\GetFileTextService;

class BaseController extends Controller
{
    public $service;

    public function __construct(GetFileTextService $service)
    {
        $this->service = $service;
    }
}