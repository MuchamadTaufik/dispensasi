<?php

namespace App\Charts;

use App\Models\Dispensasi;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class DispensasiChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    // public function build()
    // {
    //     // Ambil data dispensasi berdasarkan aturan yang Anda tentukan
    //     $dispensasi = Dispensasi::whereIn('type_id', [1, 2])
    //         ->where(function ($query) {
    //             $query->where('type_id', 1)->where('status_id', 2)
    //                 ->orWhere(function ($query) {
    //                     $query->where('type_id', 2)->where('status_id', 4);
    //                 });
    //         })
    //         ->get(['type_id', 'status_id', 'created_at']);

    //     // Inisialisasi array untuk menyimpan jumlah dispensasi per bulan untuk masing-masing type_id
    //     $dispensasiPerBulan = [
    //         'Type 1' => [],
    //         'Type 2' => [],
    //     ];

    //     // Loop melalui setiap dispensasi dan hitung jumlahnya per bulan untuk masing-masing type_id
    //     foreach ($dispensasi as $disp) {
    //         $bulanTahun = $disp->created_at->format('Y-m'); // Ambil bulan dan tahun dari tanggal pencatatan dispensasi
    //         $type = 'Type ' . $disp->type_id; // Ambil type_id dispensasi
    //         if (!isset($dispensasiPerBulan[$type][$bulanTahun])) {
    //             $dispensasiPerBulan[$type][$bulanTahun] = 0; // Inisialisasi jumlah dispensasi per bulan untuk type_id ini jika belum ada
    //         }
    //         // Hitung jumlah dispensasi per bulan untuk type_id ini
    //         $dispensasiPerBulan[$type][$bulanTahun]++;
    //     }

    //     // Buat array untuk data chart
    //     $data1 = [];
    //     $data2 = [];
    //     $labels = [];

    //     // Loop untuk mengisi data dan label
    //     foreach ($dispensasiPerBulan as $type => $data) {
    //         foreach ($data as $bulanTahun => $jumlah) {
    //             $labels[] = date('F Y', strtotime($bulanTahun)); // Label berupa nama bulan dan tahun
    //             if ($type === 'Type 1') {
    //                 $data1[] = $jumlah; // Data untuk Type 1 (dispensasi masuk)
    //                 $data2[] = null; // Data untuk Type 2 (dispensasi keluar) diisi dengan null
    //             } else {
    //                 $data1[] = null; // Data untuk Type 1 (dispensasi masuk) diisi dengan null
    //                 $data2[] = $jumlah; // Data untuk Type 2 (dispensasi keluar)
    //             }
    //         }
    //     }

    //     // Membuat chart
    //     $chart = $this->chart->barChart()
    //         ->setTitle('Total Dispensasi per Bulan')
    //         ->setSubtitle(date('Y'))
    //         ->setXAxis($labels)
    //         ->addData('Dispensasi Masuk', $data1)
    //         ->addData('Dispensasi Keluar', $data2);

    //     return $chart;
    // }

    public function build($selectedYear)
    {
        // Ambil data dispensasi berdasarkan aturan yang Anda tentukan
        $dispensasi = Dispensasi::whereIn('type_id', [1, 2])
            ->where(function ($query) {
                $query->where('type_id', 1)->where('status_id', 2)
                    ->orWhere(function ($query) {
                        $query->where('type_id', 2)->where('status_id', 4);
                    });
            })
            ->whereYear('created_at', $selectedYear) // Filter berdasarkan tahun yang dipilih
            ->get(['type_id', 'status_id', 'created_at']);

        // Inisialisasi array untuk menyimpan jumlah dispensasi per bulan untuk masing-masing type_id
        $dispensasiPerBulan = [
            'Type 1' => [],
            'Type 2' => [],
        ];

        // Loop melalui setiap dispensasi dan hitung jumlahnya per bulan untuk masing-masing type_id
        foreach ($dispensasi as $disp) {
            $bulanTahun = $disp->created_at->format('Y-m'); // Ambil bulan dan tahun dari tanggal pencatatan dispensasi
            $type = 'Type ' . $disp->type_id; // Ambil type_id dispensasi
            if (!isset($dispensasiPerBulan[$type][$bulanTahun])) {
                $dispensasiPerBulan[$type][$bulanTahun] = 0; // Inisialisasi jumlah dispensasi per bulan untuk type_id ini jika belum ada
            }
            // Hitung jumlah dispensasi per bulan untuk type_id ini
            $dispensasiPerBulan[$type][$bulanTahun]++;
        }

        // Buat array untuk data chart
        $data1 = [];
        $data2 = [];
        $labels = [];

        // Loop untuk mengisi data dan label
        foreach ($dispensasiPerBulan as $type => $data) {
            foreach ($data as $bulanTahun => $jumlah) {
                $labels[] = date('F Y', strtotime($bulanTahun)); // Label berupa nama bulan dan tahun
                if ($type === 'Type 1') {
                    $data1[] = $jumlah; // Data untuk Type 1 (dispensasi masuk)
                    $data2[] = null; // Data untuk Type 2 (dispensasi keluar) diisi dengan null
                } else {
                    $data1[] = null; // Data untuk Type 1 (dispensasi masuk) diisi dengan null
                    $data2[] = $jumlah; // Data untuk Type 2 (dispensasi keluar)
                }
            }
        }

        // Membuat chart
        $chart = $this->chart->barChart()
            // ->setTitle('Dispensasi Masuk dan Keluar')
            // ->setSubtitle($selectedYear) // Menggunakan tahun yang dipilih sebagai subtitle
            ->setXAxis($labels)
            ->addData('Dispensasi Izin Masuk ke Sekolah', $data1)
            ->addData('Dispensasi Izin Pulang Sekolah', $data2);

        return $chart;
    }

}
