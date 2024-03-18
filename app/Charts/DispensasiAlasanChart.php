<?php

namespace App\Charts;

use App\Models\Dispensasi;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class DispensasiAlasanChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build($selectedYear): \ArielMejiaDev\LarapexCharts\PieChart
    {
        // Ambil data dispensasi berdasarkan tahun yang dipilih
        $dispensasiAlasan = Dispensasi::whereYear('created_at', $selectedYear)->get();
    
        // Inisialisasi jumlah dispensasi untuk setiap alasan
        $sakitCount = 0;
        $izinCount = 0;
    
        // Loop melalui setiap dispensasi dan hitung jumlahnya untuk setiap alasan
        foreach ($dispensasiAlasan as $dispensasi) {
            // Jika alasan_id adalah 1 dan type_id adalah 1 serta status_id adalah 2, tambahkan ke $sakitCount
            if ($dispensasi->alasan_id == 1 && $dispensasi->type_id == 1 && $dispensasi->status_id == 2) {
                $sakitCount++;
            }
            // Jika alasan_id adalah 1 dan type_id adalah 2 serta status_id adalah 4, tambahkan ke $sakitCount
            elseif ($dispensasi->alasan_id == 1 && $dispensasi->type_id == 2 && $dispensasi->status_id == 4) {
                $sakitCount++;
            }
            // Jika alasan_id adalah 2 dan type_id adalah 1 serta status_id adalah 2, tambahkan ke $izinCount
            elseif ($dispensasi->alasan_id == 2 && $dispensasi->type_id == 1 && $dispensasi->status_id == 2) {
                $izinCount++;
            }
            // Jika alasan_id adalah 2 dan type_id adalah 2 serta status_id adalah 4, tambahkan ke $izinCount
            elseif ($dispensasi->alasan_id == 2 && $dispensasi->type_id == 2 && $dispensasi->status_id == 4) {
                $izinCount++;
            }
        }
    
        // Buat array data untuk chart
        $data = [$sakitCount, $izinCount];
        $labels = ['Alasan Sakit', 'Alasan Izin'];
    
        // Buat dan kembalikan objek chart dengan data yang telah disiapkan
        return $this->chart->pieChart()
            ->setTitle('Alasan Dispensasi')
            ->setSubtitle($selectedYear)
            ->addData($data)
            ->setLabels($labels);
    }
    

}
