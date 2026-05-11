<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrderController extends Controller
{
    private function pathNego()
    {
        return storage_path('app/nego.json');
    }

    private function getNego()
    {
        $path = $this->pathNego();

        if (!file_exists($path)) {
            file_put_contents($path, json_encode([]));
        }

        $data = json_decode(file_get_contents($path), true);

        return is_array($data) ? $data : [];
    }

    private function saveNego($data)
    {
        file_put_contents($this->pathNego(), json_encode($data, JSON_PRETTY_PRINT));
    }

    // =========================
    // KIRIM NEGO (USER)
    // =========================
    public function kirimNego(Request $request, $id)
    {
        $request->validate([
            'tawaran' => 'required|numeric|min:1'
        ]);

        $data = $this->getNego();

        $data[] = [
            "id" => count($data) + 1,
            "produk_id" => $id,
            "nama_produk" => $request->nama_produk,
            "harga_asli" => (int)$request->harga,
            "tawaran" => (int)$request->tawaran,
            "status" => "pending",
            "balasan_admin" => null
        ];

        $this->saveNego($data);

        return back()->with('success', 'Nego berhasil dikirim');
    }

    // =========================
    // CART (AMAN)
    // =========================
    public function cart()
    {
        return view('cart');
    }

    // =========================
    // NEGO PAGE (USER VIEW)
    // =========================
    public function nego()
    {
        $data = $this->getNego();

        return view('nego', compact('data'));
    }
}