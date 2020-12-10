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
    private $absen = [];
    private $count = -1;
    public function __construct($data)
    {
        $this->data = $data;
    }

    public function collection()
    {
        foreach ($this->data as $absen) {
            if (!isset($this->absen[$absen->user_id])) {
                $this->absen[$absen->user_id]['name'] = $absen->name;
                $this->absen[$absen->user_id]['inAbsen'] = 0;
                $this->absen[$absen->user_id]['outAbsen'] = 0;
            }
        }

        foreach ($this->absen as $dataAbsen) {
            foreach ($this->data as $collection) {
                if ($dataAbsen['name'] == $collection->name) {
                    if ($collection->status == '1') {
                        $this->absen[$collection->user_id]['inAbsen'] += 1;
                    } else {
                        $this->absen[$collection->user_id]['outAbsen'] += 1;
                    }
                }
            }
        }
        $new = [];
        foreach ($this->absen as $dd) {
            $new[] = [$dd['name'], $dd['inAbsen'], $dd['outAbsen']];
        }
        $this->absen = $new;
        return $this->data;
    }

    public function map($data): array
    {
        $this->count += 1;
        return [
            $data->created_at,
            $data->name,
            $data->division,
            $data->type_absensi == '1' ? "Kantor" : "Luar Kantor",
            $data->verification == '0' ? "Process" : ($data->verification == '1' ? "Accept" : "Reject"),
            $data->address,
            $data->noted,
            '           ',
            isset($this->absen[$this->count]) ? $this->absen[$this->count]['0'] : '',
            isset($this->absen[$this->count]) ? $this->absen[$this->count]['1'] : '',
            isset($this->absen[$this->count]) ? $this->absen[$this->count]['2'] : '',
            isset($this->absen[$this->count]) ? $this->absen[$this->count]['2'] : '',
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
            'Catatan',
            '        ',
            'Nama',
            'Total Absen Masuk',
            'Total Absen Keluar',
            'Total Absen'
        ];
    }
}
