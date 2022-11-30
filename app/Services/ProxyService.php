<?php

namespace App\Services;

use App\Exports\ProxyExport;
use App\Models\Proxy;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class ProxyService
{
    public static function list(): Collection
    {
        return Proxy::with('provider')->get();
    }

    public static function export(array $payload): BinaryFileResponse
    {
        return Excel::download(new ProxyExport(self::parseColumns($payload['format'])), 'proxies.csv');
    }

    private static function parseColumns(string $format): array
    {
        return match ($format) {
            'ip:port@login:password' => ['ip', 'port', 'login', 'password'],
            'ip:port' => ['ip', 'port'],
            'ip' => ['ip'],
            'ip@login:password' => ['ip', 'login', 'password'],
        };
    }
}
