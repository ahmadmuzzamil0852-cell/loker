@extends('layouts.main')

@section('content')

<div class="container mt-5">

<h2>Dashboard Admin</h2>
<p>Total Transaksi: {{ $total }}</p>

<canvas id="chart"></canvas>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
new Chart(document.getElementById('chart'), {
    type: 'bar',
    data: {
        labels: ['Transaksi'],
        datasets: [{
            label: 'Jumlah',
            data: [{{ $total }}]
        }]
    }
});
</script>

</div>

@endsection