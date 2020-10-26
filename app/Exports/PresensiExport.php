<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;
use Maatwebsite\Excel\Concerns\WithStrictNullComparison;

class PresensiExport implements FromCollection, WithHeadings, ShouldAutoSize, WithMapping, WithStrictNullComparison
{
    private $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function collection()
    {
        return $this->data;
    }

    public function map($data): array
    {
        return [
            $data->created_at,
            $data->name,
            $data->division,
            $data->type_absensi == '1' ? "Kantor" : "Luar Kantor",
            $data->verification == '0' ? "Process" : ($data->verification == '1' ? "Accept" : "Reject"),
            $data->address,
            $data->noted
        ];
    }

    public function headings(): array
    {
        return [
            'Tanggal',
            'Nama',
            'Divisi',
            'Tipe Absensi',
            'Verifikasi',
            'Alamat',
            'Catatan'
        ];
    }
}
