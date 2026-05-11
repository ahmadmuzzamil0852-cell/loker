<h2>Invoice Pembelian</h2>

@foreach($cart as $item)
<p>{{ $item['nama'] }} - Rp {{ number_format($item['harga']) }}</p>
@endforeach