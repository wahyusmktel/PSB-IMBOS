<?php

namespace App\Http\Controllers;

use App\Models\AkunPendaftar;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class OperatorDashboardController extends Controller
{
    /**
     * Tampilkan halaman dashboard operator.
     */
    public function index()
    {
        // Dapatkan data operator yang sedang login (jika diperlukan)
        $operator = Auth::guard('operator')->user();

        // Buat array untuk menyimpan data per bulan
        $months = collect([]);
        $smpCounts = collect([]);
        $smaCounts = collect([]);
        $noJenjangCounts = collect([]); // Pendaftar tanpa jenjang

        // Menghitung data untuk 6 bulan terakhir
        for ($i = 5; $i >= 0; $i--) {
            $month = Carbon::now()->subMonths($i)->format('Y-m'); // Ambil bulan dalam format 'YYYY-MM'
            $months->push(Carbon::now()->subMonths($i)->format('F')); // Nama bulan untuk label chart

            // Hitung jumlah pendaftar SMP per bulan
            $smpCounts->push(AkunPendaftar::whereHas('pendaftarJenjang.jenjang', function ($query) {
                $query->where('tingkat_jenjang', 'SMP');
            })->whereMonth('created_at', Carbon::now()->subMonths($i)->month)
                ->whereYear('created_at', Carbon::now()->subMonths($i)->year)
                ->count());

            // Hitung jumlah pendaftar SMA per bulan
            $smaCounts->push(AkunPendaftar::whereHas('pendaftarJenjang.jenjang', function ($query) {
                $query->where('tingkat_jenjang', 'SMA');
            })->whereMonth('created_at', Carbon::now()->subMonths($i)->month)
                ->whereYear('created_at', Carbon::now()->subMonths($i)->year)
                ->count());

            // Hitung jumlah pendaftar tanpa jenjang per bulan
            $noJenjangCounts->push(AkunPendaftar::doesntHave('pendaftarJenjang') // Pendaftar yang tidak punya jenjang
                ->whereMonth('created_at', Carbon::now()->subMonths($i)->month)
                ->whereYear('created_at', Carbon::now()->subMonths($i)->year)
                ->count());
        }

        // Statistik pendaftar
        $jumlahPendaftar = AkunPendaftar::count(); // Total jumlah pendaftar

        // Jumlah pendaftar berdasarkan jenjang (SMP)
        $jumlahPendaftarSMP = AkunPendaftar::whereHas('pendaftarJenjang.jenjang', function ($query) {
            $query->where('tingkat_jenjang', 'SMP'); // Mengambil pendaftar dengan tingkat jenjang 'SMP'
        })->count();

        // Jumlah pendaftar berdasarkan jenjang (SMA)
        $jumlahPendaftarSMA = AkunPendaftar::whereHas('pendaftarJenjang.jenjang', function ($query) {
            $query->where('tingkat_jenjang', 'SMA'); // Mengambil pendaftar dengan tingkat jenjang 'SMA'
        })->count();

        // Jumlah pendaftar yang sudah membayar
        $jumlahSudahBayar = AkunPendaftar::whereHas('transaksi', function ($query) {
            $query->where('status_pembayaran', 1); // status_pembayaran = 1 berarti sudah membayar
        })->count();

        // Hitung jumlah pendaftar tanpa jenjang per bulan
        $noJenjangCounts->push(AkunPendaftar::doesntHave('pendaftarJenjang') // Pendaftar yang tidak punya jenjang
            ->whereMonth('created_at', Carbon::now()->subMonths($i)->month)
            ->whereYear('created_at', Carbon::now()->subMonths($i)->year)
            ->count());

        // Render view dashboard untuk operator
        return view('operator.dashboard.index', compact(
            'operator',
            'jumlahPendaftar',
            'jumlahPendaftarSMP',
            'jumlahPendaftarSMA',
            'jumlahSudahBayar',
            'months', // Nama bulan (label chart)
            'smpCounts', // Data pendaftar SMP per bulan
            'smaCounts',  // Data pendaftar SMA per bulan
            'noJenjangCounts'  // Data pendaftar tanpa jenjang
        ));
    }
}
