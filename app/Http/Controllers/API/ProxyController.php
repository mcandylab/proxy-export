<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Services\ProxyService;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ProxyController extends Controller
{
    public function index()
    {
        return ProxyService::list();
    }

    public function export(Request $request)
    {
        return ProxyService::export(
            $request->validate([
                'format' => ['required', Rule::in(['ip:port@login:password', 'ip:port', 'ip', 'ip@login:password'])],
            ])
        );
    }
}
