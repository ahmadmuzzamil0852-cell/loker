<!DOCTYPE html>

<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1">

    <title>Struk Transaksi</title>

    <style>

        * {
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background: #f5f5f5;
            margin: 0;
            padding: 30px;
        }

        .struk {
            width: 400px;
            max-width: 100%;
            margin: auto;
            background: #ffffff;
            padding: 25px;
            border-radius: 10px;
            border: 1px solid #dddddd;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
        }

        .judul {
            text-align: center;
        }

        .judul h2 {
            color: #198754;
            margin-top: 0;
            margin-bottom: 5px;
        }

        .judul p {
            margin-top: 0;
            margin-bottom: 5px;
        }

        .judul small {
            color: #666666;
        }

        .garis {
            border-top: 1px dashed #333333;
            margin: 18px 0;
        }

        .data {
            display: flex;
            justify-content: space-between;
            gap: 20px;
            margin-bottom: 12px;
        }

        .data span:first-child {
            color: #555555;
        }

        .data strong,
        .data span:last-child {
            text-align: right;
        }

        .status {
            color: #198754;
            font-weight: bold;
        }

        .terima-kasih {
            text-align: center;
            margin-top: 20px;
        }

        .terima-kasih p {
            margin-bottom: 5px;
        }

        .tombol {
            display: block;
            width: 100%;
            margin-top: 20px;
            padding: 12px;
            background: #198754;
            color: #ffffff;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 16px;
            font-weight: bold;
        }

        .tombol:hover {
            background: #157347;
        }

        .kembali {
            display: block;
            width: 100%;
            margin-top: 10px;
            padding: 10px;
            text-align: center;
            text-decoration: none;
            color: #555555;
            border: 1px solid #cccccc;
            border-radius: 6px;
        }

        .kembali:hover {
            background: #eeeeee;
        }

        @media print {

            body {
                background: #ffffff;
                padding: 0;
            }

            .struk {
                width: 100%;
                max-width: 400px;
                border: none;
                border-radius: 0;
                box-shadow: none;
            }

            .tombol,
            .kembali {
                display: none;
            }

        }

    </style>

</head>

<body>

<div class="struk">

    {{-- JUDUL STRUK --}}
    <div class="judul">

        <h2>
            LOKER
        </h2>

        <p>
            Kayu Manis Kerinci Premium
        </p>

        <small>
            STRUK TRANSAKSI
        </small>

    </div>

    <div class="garis"></div>

    {{-- NOMOR TRANSAKSI --}}
    <div class="data">

        <span>
            No. Transaksi
        </span>

        <strong>

            TRX-{{ str_pad($index + 1, 4, '0', STR_PAD_LEFT) }}

        </strong>

    </div>

    {{-- USER --}}
    <div class="data">

        <span>
            User
        </span>

        <strong>

            {{ $data['user'] }}

        </strong>

    </div>

    {{-- PRODUK --}}
    <div class="data">

        <span>
            Produk ID
        </span>

        <strong>

            #{{ $data['produk_id'] }}

        </strong>

    </div>

    {{-- JUMLAH --}}
    <div class="data">

        <span>
            Jumlah
        </span>

        <strong>

            {{ $data['jumlah'] }}

        </strong>

    </div>

    {{-- METODE PEMBAYARAN --}}
    <div class="data">

        <span>
            Metode Pembayaran
        </span>

        <strong>
            QRIS
        </strong>

    </div>

    <div class="garis"></div>

    {{-- STATUS --}}
    <div class="data">

        <span>
            Status
        </span>

        <span class="status">

            Pembayaran Berhasil

        </span>

    </div>

    <div class="garis"></div>

    {{-- UCAPAN --}}
    <div class="terima-kasih">

        <p>

            <strong>
                Terima Kasih
            </strong>

        </p>

        <small>

            Terima kasih telah melakukan transaksi
            di LOKER.

        </small>

    </div>

    {{-- CETAK --}}
    <button
        type="button"
        class="tombol"
        onclick="window.print()"
    >

        Cetak Struk

    </button>

    {{-- KEMBALI --}}
    <a
        href="{{ url()->previous() }}"
        class="kembali"
    >

        Kembali

    </a>

</div>

</body>

</html>