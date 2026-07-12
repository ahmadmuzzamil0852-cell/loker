<!DOCTYPE html>

<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1">

    <title>Pembayaran Gagal</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">

</head>

<body class="bg-light">

<div class="container py-5">

    <div class="row justify-content-center">

        <div class="col-12 col-sm-10 col-md-6 col-lg-5">

            <div class="card border-0 shadow">

                <div class="card-body text-center p-5">

                    {{-- ICON GAGAL --}}
                    <div class="display-1 text-danger mb-3">

                        ×

                    </div>

                    {{-- JUDUL --}}
                    <h2 class="fw-bold text-danger">

                        Pembayaran Gagal

                    </h2>

                    {{-- KETERANGAN --}}
                    <p class="text-muted mt-3">

                        Transaksi pembayaran tidak ditemukan.

                    </p>

                    {{-- STATUS --}}
                    <div class="alert alert-danger mt-4">

                        <strong>Transaksi Tidak Ditemukan</strong>

                        <br>

                        QR pembayaran tidak valid atau data transaksi
                        sudah tidak tersedia.

                    </div>

                    {{-- INFORMASI --}}
                    <p class="text-muted small mb-0">

                        Silakan scan kembali QR pembayaran
                        dari halaman transaksi.

                    </p>

                </div>

            </div>

        </div>

    </div>

</div>

</body>

</html>