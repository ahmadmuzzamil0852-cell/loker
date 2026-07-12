<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Produk;
use App\Models\Transaksi;
use App\Models\Nego;

class TransaksiController extends Controller
{
    // =========================
    // USER BELI PRODUK
    // =========================
    public function beli(Request $request)
    {
        $request->validate(
            [
                'produk_id' => 'required|integer|exists:produks,id',
                'jumlah' => 'required|integer|min:1',
            ],
            [
                'produk_id.required' => 'Produk wajib dipilih.',
                'produk_id.exists' => 'Produk tidak ditemukan.',
                'jumlah.required' => 'Jumlah beli wajib diisi.',
                'jumlah.integer' => 'Jumlah beli harus berupa angka bulat.',
                'jumlah.min' => 'Jumlah beli minimal 1.',
            ]
        );

        $produk = Produk::findOrFail(
            $request->produk_id
        );

        $jumlah = (int) $request->jumlah;

        // CEK STOK HABIS
        if ($produk->stok <= 0) {

            return redirect()
                ->back()
                ->with(
                    'error',
                    'Stok produk sedang habis'
                );
        }

        // CEK JUMLAH MELEBIHI STOK
        if ($jumlah > $produk->stok) {

            return redirect()
                ->back()
                ->with(
                    'error',
                    'Jumlah pembelian melebihi stok tersedia. Stok saat ini hanya '
                    . $produk->stok
                    . ' produk'
                );
        }

        $harga = (int) $produk->harga;

        $totalHarga = $harga * $jumlah;

        $transaksi = Transaksi::create([
            'user' => session('email'),
            'produk_id' => $produk->id,
            'nama_produk' => $produk->nama,
            'harga' => $harga,
            'jumlah' => $jumlah,
            'total_harga' => $totalHarga,
            'status' => 'Menunggu Pembayaran',
            'bukti' => null,
        ]);

        return redirect()
            ->route(
                'transaksi.qris',
                $transaksi->id
            )
            ->with(
                'success',
                'Pesanan berhasil dibuat. Silakan lakukan pembayaran QRIS'
            );
    }

    // =========================
    // USER BELI HARGA NEGO
    // =========================
    public function beliNego($id)
    {
        $user = session('email');

        $nego = Nego::with('produk')
            ->where('id', $id)
            ->where('user', $user)
            ->first();

        // CEK DATA NEGO
        if (!$nego) {

            return redirect()
                ->route('transaksi')
                ->with(
                    'error',
                    'Data nego tidak ditemukan'
                );
        }

        // CEK STATUS NEGO
        if ($nego->status != 'Disetujui') {

            return redirect()
                ->route('transaksi')
                ->with(
                    'error',
                    'Nego belum disetujui admin'
                );
        }

        // CEK PRODUK
        if (!$nego->produk) {

            return redirect()
                ->route('transaksi')
                ->with(
                    'error',
                    'Produk tidak ditemukan'
                );
        }

        // CEK STOK HABIS
        if ($nego->produk->stok <= 0) {

            return redirect()
                ->route('transaksi')
                ->with(
                    'error',
                    'Stok produk sedang habis'
                );
        }

        // CEK JUMLAH NEGO DENGAN STOK
        if ($nego->jumlah > $nego->produk->stok) {

            return redirect()
                ->route('transaksi')
                ->with(
                    'error',
                    'Jumlah produk hasil nego melebihi stok tersedia. Stok saat ini hanya '
                    . $nego->produk->stok
                    . ' produk'
                );
        }

        // =========================
        // CEK TRANSAKSI NEGO LAMA
        // =========================
        $transaksiLama = Transaksi::where(
                'user',
                $user
            )
            ->where(
                'produk_id',
                $nego->produk_id
            )
            ->where(
                'jumlah',
                $nego->jumlah
            )
            ->where(
                'total_harga',
                $nego->harga
            )
            ->latest()
            ->first();

        // JIKA TRANSAKSI SUDAH ADA
        if ($transaksiLama) {

            // BELUM BAYAR
            if (
                $transaksiLama->status
                == 'Menunggu Pembayaran'
            ) {

                return redirect()
                    ->route(
                        'transaksi.qris',
                        $transaksiLama->id
                    );
            }

            // MENUNGGU VERIFIKASI
            if (
                $transaksiLama->status
                == 'Menunggu Verifikasi Admin'
            ) {

                return redirect()
                    ->route('transaksi')
                    ->with(
                        'error',
                        'Pembayaran transaksi nego ini sedang menunggu verifikasi admin'
                    );
            }

            // SUDAH SELESAI
            if (
                $transaksiLama->status
                == 'Pembayaran Disetujui'
            ) {

                return redirect()
                    ->route('transaksi')
                    ->with(
                        'error',
                        'Harga nego ini sudah selesai digunakan untuk transaksi'
                    );
            }
        }

        // =========================
        // HITUNG HARGA SATUAN NEGO
        // =========================
        $hargaSatuanNego = (int) round(
            $nego->harga / $nego->jumlah
        );

        // =========================
        // BUAT TRANSAKSI NEGO
        // =========================
        $transaksi = Transaksi::create([
            'user' => $user,
            'produk_id' => $nego->produk->id,
            'nama_produk' => $nego->produk->nama,
            'harga' => $hargaSatuanNego,
            'jumlah' => $nego->jumlah,
            'total_harga' => $nego->harga,
            'status' => 'Menunggu Pembayaran',
            'bukti' => null,
        ]);

        // LANGSUNG KE QRIS
        return redirect()
            ->route(
                'transaksi.qris',
                $transaksi->id
            )
            ->with(
                'success',
                'Pembelian dengan harga nego berhasil dibuat. Silakan lakukan pembayaran QRIS'
            );
    }

    // =========================
    // HALAMAN TRANSAKSI USER
    // =========================
    public function transaksi()
    {
        $user = session('email');

        $data = Transaksi::where(
                'user',
                $user
            )
            ->latest()
            ->get();

        $nego = Nego::with('produk')
            ->where(
                'user',
                $user
            )
            ->latest()
            ->get();

        return view(
            'transaksi.index',
            compact(
                'data',
                'nego'
            )
        );
    }

    // =========================
    // HALAMAN PEMBAYARAN QRIS
    // =========================
    public function qris($index)
    {
        $transaksi = Transaksi::find(
            $index
        );

        if (!$transaksi) {

            return redirect()
                ->route('transaksi')
                ->with(
                    'error',
                    'Transaksi tidak ditemukan'
                );
        }

        if (
            $transaksi->user
            != session('email')
        ) {

            return redirect()
                ->route('transaksi')
                ->with(
                    'error',
                    'Transaksi tidak dapat diakses'
                );
        }

        if (
            $transaksi->status
            != 'Menunggu Pembayaran'
        ) {

            return redirect()
                ->route('transaksi')
                ->with(
                    'error',
                    'Transaksi ini tidak dapat dibayar'
                );
        }

        return view(
            'transaksi.qris',
            [
                'transaksi' => $transaksi,
                'index' => $transaksi->id,
            ]
        );
    }

    // =========================
    // PROSES PEMBAYARAN QRIS
    // =========================
    public function bayarQris(Request $request)
    {
        $request->validate([
            'index' => 'required|integer|exists:transaksis,id',
        ]);

        $transaksi = Transaksi::findOrFail(
            $request->index
        );

        if (
            $transaksi->user
            != session('email')
        ) {

            return redirect()
                ->route('transaksi')
                ->with(
                    'error',
                    'Transaksi tidak dapat diakses'
                );
        }

        if (
            $transaksi->status
            != 'Menunggu Pembayaran'
        ) {

            return redirect()
                ->route('transaksi')
                ->with(
                    'error',
                    'Transaksi ini tidak dapat dibayar'
                );
        }

        $transaksi->update([
            'bukti' => 'pembayaran-qris-dummy',
            'status' => 'Menunggu Verifikasi Admin',
        ]);

        return redirect()
            ->route('transaksi')
            ->with(
                'success',
                'Pembayaran QRIS berhasil dikirim dan menunggu verifikasi admin'
            );
    }

    // =========================
    // UPLOAD BUKTI BAYAR
    // =========================
    public function upload(Request $request)
    {
        $request->validate([
            'index' => 'required|integer|exists:transaksis,id',
        ]);

        $transaksi = Transaksi::findOrFail(
            $request->index
        );

        if (
            $transaksi->user
            != session('email')
        ) {

            return redirect()
                ->route('transaksi')
                ->with(
                    'error',
                    'Transaksi tidak dapat diakses'
                );
        }

        if (
            $transaksi->status
            != 'Menunggu Pembayaran'
        ) {

            return redirect()
                ->route('transaksi')
                ->with(
                    'error',
                    'Bukti pembayaran tidak dapat dikirim'
                );
        }

        $transaksi->update([
            'bukti' => 'bukti-transfer.jpg',
            'status' => 'Menunggu Verifikasi Admin',
        ]);

        return redirect()
            ->route('transaksi')
            ->with(
                'success',
                'Bukti pembayaran berhasil dikirim'
            );
    }

    // =========================
    // USER AJUKAN NEGO
    // =========================
    public function ajukanNego(Request $request)
    {
        $request->validate(
            [
                'produk_id' => 'required|integer|exists:produks,id',
                'jumlah' => 'required|integer|min:1',
                'harga' => 'required|numeric|min:1',
            ],
            [
                'produk_id.required' => 'Produk wajib dipilih.',
                'produk_id.exists' => 'Produk tidak ditemukan.',

                'jumlah.required' => 'Jumlah produk wajib diisi.',
                'jumlah.integer' => 'Jumlah produk harus berupa angka bulat.',
                'jumlah.min' => 'Jumlah produk minimal 1.',

                'harga.required' => 'Harga nego wajib diisi.',
                'harga.numeric' => 'Harga nego harus berupa angka.',
                'harga.min' => 'Harga nego minimal Rp1.',
            ]
        );

        $produk = Produk::findOrFail(
            $request->produk_id
        );

        $jumlah = (int) $request->jumlah;

        $hargaNego = (int) $request->harga;

        // CEK STOK HABIS
        if ($produk->stok <= 0) {

            return redirect()
                ->back()
                ->with(
                    'error',
                    'Stok produk sedang habis'
                );
        }

        // CEK JUMLAH MELEBIHI STOK
        if ($jumlah > $produk->stok) {

            return redirect()
                ->back()
                ->with(
                    'error',
                    'Jumlah produk yang dinego melebihi stok tersedia. Stok saat ini hanya '
                    . $produk->stok
                    . ' produk'
                );
        }

        // HITUNG TOTAL HARGA ASLI
        $totalHargaAsli = (
            (int) $produk->harga
            * $jumlah
        );

        // CEK HARGA NEGO
        if (
            $hargaNego >= $totalHargaAsli
        ) {

            return redirect()
                ->back()
                ->with(
                    'error',
                    'Harga nego harus lebih rendah dari total harga asli Rp'
                    . number_format(
                        $totalHargaAsli,
                        0,
                        ',',
                        '.'
                    )
                );
        }

        // CEK NEGO MASIH MENUNGGU
        $negoMenunggu = Nego::where(
                'user',
                session('email')
            )
            ->where(
                'produk_id',
                $produk->id
            )
            ->where(
                'status',
                'Menunggu Persetujuan'
            )
            ->exists();

        if ($negoMenunggu) {

            return redirect()
                ->back()
                ->with(
                    'error',
                    'Anda masih memiliki pengajuan nego yang menunggu persetujuan admin'
                );
        }

        // SIMPAN NEGO
        Nego::create([
            'user' => session('email'),
            'produk_id' => $produk->id,
            'jumlah' => $jumlah,
            'harga' => $hargaNego,
            'status' => 'Menunggu Persetujuan',
        ]);

        return redirect()
            ->back()
            ->with(
                'success',
                'Pengajuan nego untuk '
                . $jumlah
                . ' produk berhasil dikirim ke admin'
            );
    }

    // =========================
    // ADMIN RESPON NEGO
    // =========================
    public function responNego(Request $request)
    {
        $request->validate([
            'index' => 'required|integer|exists:negos,id',
            'aksi' => 'required|in:setujui,tolak',
        ]);

        $nego = Nego::with('produk')
            ->findOrFail(
                $request->index
            );

        if (
            $nego->status
            != 'Menunggu Persetujuan'
        ) {

            return redirect()
                ->route('nego.index')
                ->with(
                    'error',
                    'Nego ini sudah diproses sebelumnya'
                );
        }

        if (
            $request->aksi == 'setujui'
        ) {

            if (!$nego->produk) {

                return redirect()
                    ->route('nego.index')
                    ->with(
                        'error',
                        'Produk tidak ditemukan'
                    );
            }

            if (
                $nego->jumlah
                > $nego->produk->stok
            ) {

                return redirect()
                    ->route('nego.index')
                    ->with(
                        'error',
                        'Nego tidak dapat disetujui karena jumlah melebihi stok tersedia'
                    );
            }

            $nego->status = 'Disetujui';

        } else {

            $nego->status = 'Ditolak';
        }

        $nego->save();

        return redirect()
            ->route('nego.index')
            ->with(
                'success',
                'Status nego berhasil diperbarui'
            );
    }

    // =========================
    // HALAMAN ADMIN DATA NEGO
    // =========================
    public function list()
    {
        $data = Nego::with('produk')
            ->latest()
            ->get();

        return view(
            'nego.index',
            compact('data')
        );
    }

    // =========================
    // ADMIN VERIFIKASI PEMBAYARAN
    // =========================
    public function verifikasi(Request $request)
    {
        $request->validate([
            'index' => 'required|integer|exists:transaksis,id',
        ]);

        try {

            DB::transaction(function () use ($request) {

                $transaksi = Transaksi::where(
                        'id',
                        $request->index
                    )
                    ->lockForUpdate()
                    ->firstOrFail();

                if (
                    $transaksi->status
                    != 'Menunggu Verifikasi Admin'
                ) {

                    throw new \Exception(
                        'Transaksi tidak dapat diverifikasi'
                    );
                }

                $produk = Produk::where(
                        'id',
                        $transaksi->produk_id
                    )
                    ->lockForUpdate()
                    ->first();

                if (!$produk) {

                    throw new \Exception(
                        'Produk tidak ditemukan'
                    );
                }

                if (
                    $produk->stok
                    < $transaksi->jumlah
                ) {

                    throw new \Exception(
                        'Stok produk tidak mencukupi. Stok saat ini hanya '
                        . $produk->stok
                        . ' produk'
                    );
                }

                // KURANGI STOK
                $produk->stok = (
                    $produk->stok
                    - $transaksi->jumlah
                );

                $produk->save();

                // SETUJUI PEMBAYARAN
                $transaksi->status = 'Pembayaran Disetujui';

                $transaksi->save();
            });

        } catch (\Exception $e) {

            return redirect()
                ->route('admin.transaksi')
                ->with(
                    'error',
                    $e->getMessage()
                );
        }

        return redirect()
            ->route('admin.transaksi')
            ->with(
                'success',
                'Pembayaran berhasil diverifikasi dan stok produk otomatis berkurang'
            );
    }

    // =========================
    // CETAK STRUK TRANSAKSI
    // =========================
    public function cetakStruk($index)
    {
        $transaksi = Transaksi::find(
            $index
        );

        if (!$transaksi) {

            return $this->redirectStruk(
                'Data transaksi tidak ditemukan'
            );
        }

        if (
            $transaksi->status
            != 'Pembayaran Disetujui'
        ) {

            return $this->redirectStruk(
                'Struk hanya dapat dicetak setelah pembayaran disetujui'
            );
        }

        if (
            session('role') == 'user'
            &&
            $transaksi->user
            != session('email')
        ) {

            return redirect()
                ->route('transaksi')
                ->with(
                    'error',
                    'Struk transaksi tidak dapat diakses'
                );
        }

        return view(
            'transaksi.struk',
            [
                'data' => $transaksi,
                'index' => $transaksi->id,
            ]
        );
    }

    // =========================
    // REDIRECT ERROR STRUK
    // =========================
    private function redirectStruk($pesan)
    {
        if (
            session('role') == 'admin'
        ) {

            return redirect()
                ->route('admin.transaksi')
                ->with(
                    'error',
                    $pesan
                );
        }

        return redirect()
            ->route('transaksi')
            ->with(
                'error',
                $pesan
            );
    }

    // =========================
    // HALAMAN ADMIN TRANSAKSI
    // =========================
    public function adminTransaksi()
    {
        $data = Transaksi::latest()
            ->get();

        return view(
            'admin.transaksi',
            compact('data')
        );
    }
}