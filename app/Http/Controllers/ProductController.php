<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;

class ProductController extends Controller
{
    // =========================
    // HOME
    // =========================
    public function home()
    {
        $namaGudang = 'Gudang Kerinci';

        $tagline = 'Hasil Bumi Terbaik dari Tanah Kerinci';

        $visi = 'Menjadi platform terpercaya yang menghubungkan hasil bumi unggulan Kerinci dengan seluruh penjuru Indonesia.';

        $misi = [
            'Menyediakan produk asli Kerinci dengan kualitas terjamin.',
            'Mendukung petani lokal Kerinci melalui pemasaran digital.',
            'Memberikan pengalaman belanja yang mudah dan terpercaya.',
        ];

        return view(
            'home',
            compact(
                'namaGudang',
                'tagline',
                'visi',
                'misi'
            )
        );
    }

    // =========================
    // HALAMAN KATALOG
    // =========================
    public function index()
    {
        $produk = Produk::all();

        return view(
            'produk.index',
            compact('produk')
        );
    }

    // =========================
    // HALAMAN DETAIL PRODUK
    // =========================
    public function show($id)
    {
        $produk = Produk::findOrFail($id);

        return view(
            'produk.show',
            compact('produk')
        );
    }

    // =========================
    // HALAMAN ADMIN PRODUK
    // =========================
    public function admin()
    {
        $produk = Produk::all();

        return view(
            'admin.produk',
            compact('produk')
        );
    }

    // =========================
    // FORM TAMBAH PRODUK
    // =========================
    public function formTambah()
    {
        return view('admin.tambah');
    }

    // =========================
    // SIMPAN PRODUK
    // =========================
    public function simpan(Request $request)
    {
        $request->validate(
            [
                'nama' => 'required|string|max:255',
                'harga' => 'required|numeric|min:1',
                'kategori' => 'required|string|max:255',
                'deskripsi' => 'nullable|string',
                'berat' => 'nullable|string|max:255',
                'stok' => 'required|integer|min:0',
            ],
            [
                'nama.required' => 'Nama produk wajib diisi.',
                'nama.string' => 'Nama produk harus berupa teks.',
                'nama.max' => 'Nama produk maksimal 255 karakter.',

                'harga.required' => 'Harga produk wajib diisi.',
                'harga.numeric' => 'Harga produk harus berupa angka.',
                'harga.min' => 'Harga produk minimal Rp1.',

                'kategori.required' => 'Kategori produk wajib diisi.',
                'kategori.string' => 'Kategori harus berupa teks.',
                'kategori.max' => 'Kategori maksimal 255 karakter.',

                'deskripsi.string' => 'Deskripsi harus berupa teks.',

                'berat.string' => 'Berat harus berupa teks.',
                'berat.max' => 'Berat maksimal 255 karakter.',

                'stok.required' => 'Jumlah stok wajib diisi.',
                'stok.integer' => 'Jumlah stok harus berupa angka bulat.',
                'stok.min' => 'Jumlah stok tidak boleh kurang dari 0.',
            ]
        );

        Produk::create([
            'nama' => $request->nama,
            'harga' => $request->harga,
            'kategori' => $request->kategori,
            'deskripsi' => $request->deskripsi ?? '-',
            'berat' => $request->berat ?? '-',
            'stok' => $request->stok,
        ]);

        return redirect()
            ->route('admin.produk')
            ->with(
                'success',
                'Produk berhasil ditambahkan ke database'
            );
    }

    // =========================
    // FORM EDIT PRODUK
    // =========================
    public function edit($id)
    {
        $produk = Produk::findOrFail($id);

        return view(
            'admin.edit',
            compact('produk')
        );
    }

    // =========================
    // UPDATE PRODUK
    // =========================
    public function update(Request $request, $id)
    {
        $request->validate(
            [
                'nama' => 'required|string|max:255',
                'harga' => 'required|numeric|min:1',
                'kategori' => 'required|string|max:255',
                'deskripsi' => 'nullable|string',
                'berat' => 'nullable|string|max:255',
                'stok' => 'required|integer|min:0',
            ],
            [
                'nama.required' => 'Nama produk wajib diisi.',
                'nama.string' => 'Nama produk harus berupa teks.',
                'nama.max' => 'Nama produk maksimal 255 karakter.',

                'harga.required' => 'Harga produk wajib diisi.',
                'harga.numeric' => 'Harga produk harus berupa angka.',
                'harga.min' => 'Harga produk minimal Rp1.',

                'kategori.required' => 'Kategori produk wajib diisi.',
                'kategori.string' => 'Kategori harus berupa teks.',
                'kategori.max' => 'Kategori maksimal 255 karakter.',

                'deskripsi.string' => 'Deskripsi harus berupa teks.',

                'berat.string' => 'Berat harus berupa teks.',
                'berat.max' => 'Berat maksimal 255 karakter.',

                'stok.required' => 'Jumlah stok wajib diisi.',
                'stok.integer' => 'Jumlah stok harus berupa angka bulat.',
                'stok.min' => 'Jumlah stok tidak boleh kurang dari 0.',
            ]
        );

        $produk = Produk::findOrFail($id);

        $produk->update([
            'nama' => $request->nama,
            'harga' => $request->harga,
            'kategori' => $request->kategori,
            'berat' => $request->berat ?? '-',
            'deskripsi' => $request->deskripsi ?? '-',
            'stok' => $request->stok,
        ]);

        return redirect()
            ->route('admin.produk')
            ->with(
                'success',
                'Produk berhasil diupdate di database'
            );
    }

    // =========================
    // HAPUS PRODUK
    // =========================
    public function hapus($id)
    {
        $produk = Produk::findOrFail($id);

        $produk->delete();

        return redirect()
            ->route('admin.produk')
            ->with(
                'success',
                'Produk berhasil dihapus dari database'
            );
    }
}