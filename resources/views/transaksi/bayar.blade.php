<!DOCTYPE html>

<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1">

    <title>Pembayaran QRIS</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">

</head>

<body class="bg-light">

<div class="container py-5">

    <div class="row justify-content-center">

        <div class="col-12 col-sm-10 col-md-6 col-lg-5">

            <div class="card border-0 shadow">

                <div class="card-body text-center p-4">

                    {{-- JUDUL --}}
                    <h2 class="fw-bold text-success mb-2">

                        Pembayaran QRIS

                    </h2>

                    <p class="text-muted">

                        Konfirmasi pembayaran Anda

                    </p>

                    <hr>

                    {{-- INFORMASI PRODUK --}}
                    <div class="bg-light rounded p-3 mt-4">

                        <p class="text-muted mb-1">

                            Produk ID

                        </p>

                        <h4 class="fw-bold mb-0">

                            #{{ $transaksi['produk_id'] }}

                        </h4>

                    </div>

                    {{-- JUMLAH PEMBELIAN --}}
                    <div class="mt-4">

                        <p class="text-muted mb-1">

                            Jumlah Pembelian

                        </p>

                        <h3 class="fw-bold text-success">

                            {{ $transaksi['jumlah'] }}

                        </h3>

                    </div>

                    {{-- INFORMASI PEMBAYARAN --}}
                    <div class="alert alert-warning mt-4">

                        <strong>Pembayaran QRIS Dummy</strong>

                        <br>

                        Tekan tombol Bayar untuk melakukan
                        simulasi pembayaran.

                    </div>

                    {{-- FORM BAYAR --}}
                    <form action="{{ route('pembayaran.dummy.bayar') }}"
                          method="POST">

                        @csrf

                        <input type="hidden"
                               name="index"
                               value="{{ $index }}">

                        <button type="submit"
                                class="btn btn-success btn-lg w-100">

                            Bayar

                        </button>

                    </form>

                    {{-- CATATAN --}}
                    <p class="text-muted small mt-3 mb-0">

                        Pembayaran ini hanya digunakan
                        untuk simulasi sistem.

                    </p>

                </div>

            </div>

        </div>

    </div>

</div>

</body>

</html>