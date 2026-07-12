<?php

namespace App\Exports;

use App\Models\Transaksi;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class TransaksiExport implements
    FromCollection,
    WithHeadings,
    WithMapping
{
    public function collection()
    {
        return Transaksi::where(
            'status',
            'Pembayaran Disetujui'
        )
        ->latest()
        ->get();
    }

    public function headings(): array
    {
        return [
            'ID Transaksi',
            'Email User',
            'Nama Produk',
            'Harga Satuan',
            'Jumlah',
            'Total Harga',
            'Status',
            'Tanggal Transaksi',
        ];
    }

    public function map($transaksi): array
    {
        return [
            $transaksi->id,
            $transaksi->user,
            $transaksi->nama_produk,
            $transaksi->harga,
            $transaksi->jumlah,
            $transaksi->total_harga,
            $transaksi->status,
            $transaksi->created_at
                ? $transaksi->created_at->format('d-m-Y H:i')
                : '-',
        ];
    }
}