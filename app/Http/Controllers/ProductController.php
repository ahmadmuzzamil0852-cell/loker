<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    // DATA PRODUK
    private function getProducts()
    {
        if(session()->has('produk')) {

            return session('produk');

        }

        $produk = [

            [
                'id'        => 1,
                'nama'      => 'Kayu Manis Kerinci Premium',
                'harga'     => 85000,
                'kategori'  => 'Rempah',
                'deskripsi' => 'Kayu manis pilihan langsung dari perkebunan Kerinci, aroma kuat dan cita rasa tinggi.',
                'berat'     => '250 gram',
                'stok'      => 'Tersedia',
            ],

            [
                'id'        => 2,
                'nama'      => 'Teh Kayu Aro Kerinci',
                'harga'     => 65000,
                'kategori'  => 'Minuman',
                'deskripsi' => 'Teh hitam premium dari perkebunan tertinggi di Asia Tenggara.',
                'berat'     => '100 gram',
                'stok'      => 'Tersedia',
            ],

            [
                'id'        => 3,
                'nama'      => 'Kopi Arabika Kerinci',
                'harga'     => 120000,
                'kategori'  => 'Minuman',
                'deskripsi' => 'Kopi arabika single origin Kerinci dengan notes cokelat dan buah tropis.',
                'berat'     => '200 gram',
                'stok'      => 'Tersedia',
            ],

            [
                'id'        => 4,
                'nama'      => 'Madu Hutan Kerinci',
                'harga'     => 150000,
                'kategori'  => 'Kesehatan',
                'deskripsi' => 'Madu murni hutan Kerinci tanpa campuran.',
                'berat'     => '500 ml',
                'stok'      => 'Tersedia',
            ],

            [
                'id'        => 5,
                'nama'      => 'Kentang Kerinci Organik',
                'harga'     => 25000,
                'kategori'  => 'Sayuran',
                'deskripsi' => 'Kentang segar organik dari ladang dataran tinggi Kerinci.',
                'berat'     => '1 kg',
                'stok'      => 'Tersedia',
            ],

            [
                'id'        => 6,
                'nama'      => 'Cabai Merah Kerinci',
                'harga'     => 30000,
                'kategori'  => 'Sayuran',
                'deskripsi' => 'Cabai merah segar berkualitas tinggi.',
                'berat'     => '500 gram',
                'stok'      => 'Tersedia',
            ],

        ];

        session(['produk' => $produk]);

        return $produk;
    }

    // HOME
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

    // HALAMAN KATALOG
    public function index()
    {
        $produk = $this->getProducts();

        return view(
            'produk.index',
            compact('produk')
        );
    }

    // HALAMAN DETAIL
    public function show($id)
    {
        $produk = collect($this->getProducts())
                    ->firstWhere('id', $id);

        return view(
            'produk.show',
            compact('produk')
        );
    }

    // HALAMAN ADMIN
    public function admin()
    {
        $produk = $this->getProducts();

        return view(
            'admin.produk',
            compact('produk')
        );
    }

    // FORM TAMBAH PRODUK
    public function formTambah()
    {
        return view('admin.tambah');
    }

    // SIMPAN PRODUK
    public function simpan(Request $request)
    {
        $produk = $this->getProducts();

        $produk[] = [

            'id'        => count($produk) + 1,

            'nama'      => $request->nama,

            'harga'     => $request->harga,

            'kategori'  => $request->kategori,

            'deskripsi' => $request->deskripsi ?? '-',

            'berat'     => $request->berat ?? '-',

            'stok'      => 'Tersedia',

        ];

        session(['produk' => $produk]);

        return redirect('/admin/produk')->with(
            'success',
            'Produk berhasil ditambahkan'
        );
    }

    // FORM EDIT
    public function edit($id)
    {
        $produk = collect($this->getProducts())
                    ->firstWhere('id', $id);

        return view(
            'admin.edit',
            compact('produk')
        );
    }

    // UPDATE PRODUK
    public function update(Request $request, $id)
    {
        $produk = $this->getProducts();

        foreach($produk as $key => $item) {

            if($item['id'] == $id) {

                $produk[$key]['nama'] = $request->nama;

                $produk[$key]['harga'] = $request->harga;

                $produk[$key]['kategori'] = $request->kategori;

                $produk[$key]['berat'] = $request->berat;

                $produk[$key]['deskripsi'] = $request->deskripsi;

            }
        }

        session(['produk' => $produk]);

        return redirect('/admin/produk')->with(
            'success',
            'Produk berhasil diupdate'
        );
    }

    // HAPUS PRODUK
    public function hapus($id)
    {
        $produk = $this->getProducts();

        $hasil = [];

        foreach($produk as $item) {

            if($item['id'] != $id) {

                $hasil[] = $item;

            }
        }

        session(['produk' => $hasil]);

        return redirect('/admin/produk')->with(
            'success',
            'Produk berhasil dihapus'
        );
    }
}