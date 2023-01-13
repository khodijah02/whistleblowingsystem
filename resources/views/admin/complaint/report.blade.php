@extends('layouts.admin.master')

@section('title', 'Dashboard')

@section('breadcrumb-title')
<h3>Report Summary</h3>
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item"><a href=""> Report Summary</i></a></li>
@endsection

@section('content')
<div class="container-fluid">
	<div class="row">
        <div class="col-12">
			<div class="card" data-aos="fade-up" data-aos-anchor-placement="top-bottom">
                <div class="card-header">
                        <form action="{{ route('admin.complaint.export') }}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-xl-6">
                                    <div class="row">
                                        <div class="col-xl-4 mt-2">
                                            <input type="date" class="form-control" id="i_date" name="i_date" value="{{ date('Y-m-d') }}" required>
                                            <label for="i_date" class="mt-1">Tanggal Awal</label>
                                        </div>
                                        <div class="col-xl-4 mt-2">
                                            <input type="date" class="form-control" id="e_date" name="e_date" value="{{ date('Y-m-d') }}" required>
                                            <label for="e_date" class="mt-1">Tanggal Akhir</label>
                                        </div>
                                        <div class="col-xl-4 mt-2">
                                            <button class="btn btn-success" type="submit" id="export_submit_button">Export Excel</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                </div>
				<div class="card-body">
                    <div class="row">
                        <div class="col-xl-6">
                            <h5 class="text-center">Pengaduan Bulan {{ date('F') }}</h5>
                            <canvas id="monthly_report"></canvas>
                        </div>
                        <div class="col-xl-6">
                            <h5 class="text-center">Jumlah Pengaduan Tahun {{ date('Y') }}</h5>
                            <canvas id="annual_report"></canvas>
                        </div>
                    </div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

@push('after-script')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
const monthlyChart = document.getElementById('monthly_report');
const annualChart = document.getElementById('annual_report');
// const labels = Utils.months({count: 7});

var violation = JSON.parse('{!! json_encode($violation) !!}')
var monthly = JSON.parse('{!! json_encode($monthly) !!}')
var annual = JSON.parse('{!! json_encode($annual) !!}')


new Chart(monthlyChart, {
    type: 'bar',
    data: {
        labels: violation,
        datasets: [{
            label: 'Jumlah Pengaduan',
            data: monthly,
            borderWidth: 1,
            backgroundColor: '#012970'
        }]
    },
    options: {
        responsive: true,
        scales: {
            y: {
                beginAtZero: true,
                max: 20,
                ticks: {stepSize: 1}
            },
        },
    }
});

new Chart(annualChart, {
    type: 'line',
    data: {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Ags', 'Sep', 'Okt', 'Nov', 'Des'],
        datasets: [{
            label: 'Jumlah Pengaduan',
            data: annual,
            borderColor: '#012970',
            fill: false,
            tension: 0.1
        }]
    },
    options: {
        responsive: true,
        scales: {
            y: {
                beginAtZero: true,
                max: 20,
                ticks: {stepSize: 1}
            },
        },
    }
});
</script>
@endpush

