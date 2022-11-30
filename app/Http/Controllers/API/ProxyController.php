<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Services\ProxyService;
use Illuminate\Http\Request;

class ProxyController extends Controller
{
    public function index()
    {
        return ProxyService::list();
    }

    public function export(Request $request)
    {
    }
}
