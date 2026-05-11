<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    // =========================
    // USER BELI PRODUK
    // =========================
    public function beli(Request $request)
    {
        $transaksi = session()->get('transaksi', []);

        $transaksi[] = [

            'user' => session('email') ?? 'user@gmail.com',

            'produk_id' => $request->produk_id,

            'jumlah' => $request->jumlah ?? 1,

            'status' => 'Menunggu Pembayaran',

            'bukti' => null,

        ];

        session()->put('transaksi', $transaksi);

        return redirect('/transaksi')->with(
            'success',
            'Pesanan berhasil dibuat, silakan upload bukti pembayaran'
        );
    }

    // =========================
    // USER AJUKAN NEGO
    // ADMIN RESPON NEGO
    // =========================
    public function respon(Request $request)
    {
        $data = session()->get('nego', []);

        // USER AJUKAN NEGO
        if(!$request->has('aksi')) {

            $data[] = [

                'user' => session('email') ?? 'user@gmail.com',

                'produk_id' => $request->produk_id,

                'harga' => $request->harga,

                'status' => 'Menunggu Persetujuan',

            ];

            session()->put('nego', $data);

            return redirect()->back()->with(
                'success',
                'Pengajuan nego berhasil dikirim ke admin'
            );
        }

        // ADMIN SETUJUI
        if($request->aksi == 'setujui') {

            if(isset($data[$request->index])) {

                $data[$request->index]['status']
                    = 'Disetujui';
            }
        }

        // ADMIN TOLAK
        elseif($request->aksi == 'tolak') {

            if(isset($data[$request->index])) {

                $data[$request->index]['status']
                    = 'Ditolak';
            }
        }

        session()->put('nego', $data);

        return redirect('/nego')->with(
            'success',
            'Status nego berhasil diperbarui'
        );
    }

    // =========================
    // HALAMAN ADMIN DATA NEGO
    // =========================
    public function list()
    {
        $data = session()->get('nego', []);

        return view(
            'nego.index',
            compact('data')
        );
    }

    // =========================
    // HALAMAN TRANSAKSI USER
    // =========================
    public function transaksi()
    {
        $data = session()->get('transaksi', []);

        return view(
            'transaksi.index',
            compact('data')
        );
    }

    // =========================
    // UPLOAD BUKTI BAYAR
    // =========================
    public function upload(Request $request)
    {
        $transaksi = session()->get('transaksi', []);

        if(isset($transaksi[$request->index])) {

            // SIMULASI FILE BUKTI
            $transaksi[$request->index]['bukti']
                = 'bukti-transfer.jpg';

            // UPDATE STATUS
            $transaksi[$request->index]['status']
                = 'Menunggu Verifikasi Admin';

            session()->put('transaksi', $transaksi);

            return redirect('/transaksi')->with(
                'success',
                'Bukti pembayaran berhasil dikirim'
            );
        }

        return redirect('/transaksi')->with(
            'error',
            'Transaksi tidak ditemukan'
        );
    }

    // =========================
    // ADMIN VERIFIKASI PEMBAYARAN
    // =========================
    public function verifikasi(Request $request)
    {
        $transaksi = session()->get('transaksi', []);

        if(isset($transaksi[$request->index])) {

            $transaksi[$request->index]['status']
                = 'Pembayaran Disetujui';

            session()->put('transaksi', $transaksi);

            return redirect('/admin/transaksi')->with(
                'success',
                'Pembayaran berhasil diverifikasi'
            );
        }

        return redirect('/admin/transaksi')->with(
            'error',
            'Data transaksi tidak ditemukan'
        );
    }

    // =========================
    // HALAMAN ADMIN TRANSAKSI
    // =========================
    public function adminTransaksi()
    {
        $data = session()->get('transaksi', []);

        return view(
            'admin.transaksi',
            compact('data')
        );
    }
}