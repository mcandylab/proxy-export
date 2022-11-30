<?php

namespace App\Services;

use App\Models\Proxy;
use Illuminate\Support\Collection;

class ProxyService
{
    public static function list(): Collection
    {
        return Proxy::with('provider')->get();
    }

    public static function export(array $payload)
    {
        dd($payload);
    }
}
