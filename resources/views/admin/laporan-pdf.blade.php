<!DOCTYPE html>

<html>

<head>

    <meta charset="UTF-8">

    <title>
        Laporan Transaksi Gudang Kerinci
    </title>

    <style>

        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }

        h1 {
            text-align: center;
            margin-bottom: 5px;
        }

        .subtitle {
            text-align: center;
            margin-bottom: 25px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 7px;
        }

        th {
            background: #d1e7dd;
        }

        .total {
            margin-top: 20px;
            font-size: 14px;
        }

    </style>

</head>

<body>

    <h1>
        GUDANG KERINCI
    </h1>

    <div class="subtitle">

        Laporan Transaksi Penjualan

    </div>

    <table>

        <thead>

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

            @foreach($data as $item)

                <tr>

                    <td>
                        {{ $item->id }}
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

                    <td>

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
                                ->format('d-m-Y')
                            : '-'
                        }}

                    </td>

                </tr>

            @endforeach

        </tbody>

    </table>

    <div class="total">

        <p>

            <strong>
                Total Transaksi:
            </strong>

            {{ $totalTransaksi }}

        </p>

        <p>

            <strong>
                Total Pendapatan:
            </strong>

            Rp{{ number_format(
                $totalPendapatan,
                0,
                ',',
                '.'
            ) }}

        </p>

    </div>

</body>

</html>