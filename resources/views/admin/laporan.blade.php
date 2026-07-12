@extends('layouts.main')

@section('title', 'Laporan Transaksi')

@section('content')

@if(session('role') != 'admin')

    <div class="container mt-5">

        <div class="alert alert-danger">
            Halaman ini hanya untuk admin.
        </div>

    </div>

@else

<div class="container mt-4 mb-5">

    <div class="d-flex justify-content-between
                align-items-center mb-4">

        <h2 class="fw-bold text-success mb-0">

            Laporan Transaksi

        </h2>

        <div>

            <a href="{{ route('admin.laporan.pdf') }}"
               class="btn btn-danger">

                <i class="bi bi-file-earmark-pdf me-1"></i>

                Cetak PDF

            </a>

            <a href="{{ route('admin.laporan.excel') }}"
               class="btn btn-success">

                <i class="bi bi-file-earmark-excel me-1"></i>

                Export Excel

            </a>

        </div>

    </div>

    {{-- RINGKASAN --}}
    <div class="row mb-4">

        <div class="col-md-6">

            <div class="card border-0 shadow-sm">

                <div class="card-body">

                    <small class="text-muted">

                        Total Transaksi Selesai

                    </small>

                    <h3 class="fw-bold text-success mb-0">

                        {{ $totalTransaksi }}

                    </h3>

                </div>

            </div>

        </div>

        <div class="col-md-6">

            <div class="card border-0 shadow-sm">

                <div class="card-body">

                    <small class="text-muted">

                        Total Pendapatan

                    </small>

                    <h3 class="fw-bold text-success mb-0">

                        Rp{{ number_format(
                            $totalPendapatan,
                            0,
                            ',',
                            '.'
                        ) }}

                    </h3>

                </div>

            </div>

        </div>

    </div>

    {{-- TABEL LAPORAN --}}
    <div class="card border-0 shadow-sm">

        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-striped
                              table-hover align-middle">

                    <thead class="table-success">

                        <tr>

                            <th>ID</th>

                            <th>User</th>

                            <th>Produk</th>

                            <th>Harga</th>

                            <th>Jumlah</th>

                            <th>Total</th>

                            <th>Tanggal</th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse($data as $item)

                            <tr>

                                <td>
                                    #{{ $item->id }}
                                </td>

                                <td>
                                    {{ $item->user }}
                                </td>

                                <td>
                                    {{ $item->nama_produk }}
                                </td>

                                <td>

                                    Rp{{ number_format(
                                        $item->harga,
                                        0,
                                        ',',
                                        '.'
                                    ) }}

                                </td>

                                <td>
                                    {{ $item->jumlah }}
                                </td>

                                <td class="fw-bold text-success">

                                    Rp{{ number_format(
                                        $item->total_harga,
                                        0,
                                        ',',
                                        '.'
                                    ) }}

                                </td>

                                <td>

                                    {{ $item->created_at
                                        ? $item->created_at
                                            ->format('d-m-Y H:i')
                                        : '-'
                                    }}

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="7"
                                    class="text-center text-muted">

                                    Belum ada transaksi selesai.

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>

@endif

@endsection