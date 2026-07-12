<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\TransaksiExport;

class LaporanController extends Controller
{
    // =========================
    // HALAMAN LAPORAN
    // =========================
    public function index()
    {
        if (session('role') != 'admin') {
            return redirect('/login')->with(
                'error',
                'Halaman laporan hanya untuk admin'
            );
        }

        $data = Transaksi::where(
            'status',
            'Pembayaran Disetujui'
        )
        ->latest()
        ->get();

        $totalTransaksi = $data->count();

        $totalPendapatan = $data->sum('total_harga');

        return view(
            'admin.laporan',
            compact(
                'data',
                'totalTransaksi',
                'totalPendapatan'
            )
        );
    }

    // =========================
    // CETAK PDF
    // =========================
    public function pdf()
    {
        if (session('role') != 'admin') {
            return redirect('/login')->with(
                'error',
                'Akses ditolak'
            );
        }

        $data = Transaksi::where(
            'status',
            'Pembayaran Disetujui'
        )
        ->latest()
        ->get();

        $totalTransaksi = $data->count();

        $totalPendapatan = $data->sum('total_harga');

        $pdf = Pdf::loadView(
            'admin.laporan-pdf',
            compact(
                'data',
                'totalTransaksi',
                'totalPendapatan'
            )
        );

        return $pdf->download(
            'laporan-transaksi-gudang-kerinci.pdf'
        );
    }

    // =========================
    // EXPORT EXCEL
    // =========================
    public function excel()
    {
        if (session('role') != 'admin') {
            return redirect('/login')->with(
                'error',
                'Akses ditolak'
            );
        }

        return Excel::download(
            new TransaksiExport,
            'laporan-transaksi-gudang-kerinci.xlsx'
        );
    }
}