<?php

namespace App\Charts;

use App\Models\Dispensasi;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class DispensasiTypeChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build($selectedYear): \ArielMejiaDev\LarapexCharts\PieChart
    {
        $dispensasiType = Dispensasi::whereYear('created_at', $selectedYear)->get();

        // Inisialisasi jumlah dispensasi untuk setiap type
        $masukCount = 0;
        $keluarCount = 0;

        // Loop melalui setiap dispensasi dan hitung jumlahnya untuk setiap alasan
        foreach ($dispensasiType as $dispensasi) {
            if ($dispensasi->type_id == 1 && in_array($dispensasi->status_id, [2])) {
                $masukCount++;
            } elseif ($dispensasi->type_id == 2 && in_array($dispensasi->status_id, [4])) {
                $keluarCount++;
            }
        }

        // Buat array data untuk chart
        $data = [$masukCount, $keluarCount];
        $labels = ['Dispensasi Izin Masuk ke Sekolah', 'Dispensasi Izin Pulang Sekolah'];

        return $this->chart->pieChart()
            // ->setTitle('Type Dispensasi')
            // ->setSubtitle($selectedYear)
            ->addData($data)
            ->setLabels($labels);
    }
}
