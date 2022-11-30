<?php

namespace App\Exports;

use App\Models\Proxy;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Excel;

class ProxyExport implements FromCollection, WithHeadings
{
    use Exportable;

    private array $columns;

    public function __construct(array $columns)
    {
        $this->columns = $columns;
    }

    private string $writerType = Excel::CSV;

    private array $headers = [
        'Content-Type' => 'text/csv',
    ];

    public function collection(): Collection
    {
        return Proxy::select($this->columns)->get();
    }

    public function headings(): array
    {
        return $this->columns;
    }
}
