@extends('layouts.app_operator')

@section('title', 'Dashboard Operator')

@section('content')
    <div class="panel-header bg-primary-gradient">
        <div class="page-inner py-5">
            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                <div>
                    <h2 class="text-white pb-2 fw-bold">Assalamualaikum</h2>
                    <h5 class="text-white op-7 mb-2">Selamat datang di halaman dashboard Operator
                        {{ $operator->nama_operator }}</h5>
                </div>
            </div>
        </div>
    </div>
    <div class="page-inner mt--5">
        <div class="row mt--2">
            <div class="col-md-12">
                <div class="card full-height">
                    <div class="card-body">
                        <div class="card-title">Perhatian !</div>
                        <div class="card-category">Ini adalah halaman dashboard operator. Silakan kelola sistem sesuai tugas
                            Anda.</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Widget: Total Jumlah Pendaftar -->
            <div class="col-sm-6 col-lg-3">
                <div class="card p-3">
                    <div class="d-flex align-items-center">
                        <span class="stamp stamp-md bg-secondary mr-3">
                            <i class="fa fa-users"></i>
                        </span>
                        <div>
                            <h5 class="mb-1"><b><a href="#">{{ $jumlahPendaftar }} <small>Pendaftar</small></a></b>
                            </h5>
                            <small class="text-muted">Total pendaftar</small>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Widget: Jumlah Pendaftar Jenjang SMP -->
            <div class="col-sm-6 col-lg-3">
                <div class="card p-3">
                    <div class="d-flex align-items-center">
                        <span class="stamp stamp-md bg-success mr-3">
                            <i class="fa fa-school"></i>
                        </span>
                        <div>
                            <h5 class="mb-1"><b><a href="#">{{ $jumlahPendaftarSMP }} <small>Pendaftar
                                            SMP</small></a></b></h5>
                            <small class="text-muted">Pendaftar jenjang SMP</small>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Widget: Jumlah Pendaftar Jenjang SMA -->
            <div class="col-sm-6 col-lg-3">
                <div class="card p-3">
                    <div class="d-flex align-items-center">
                        <span class="stamp stamp-md bg-danger mr-3">
                            <i class="fa fa-graduation-cap"></i>
                        </span>
                        <div>
                            <h5 class="mb-1"><b><a href="#">{{ $jumlahPendaftarSMA }} <small>Pendaftar
                                            SMA</small></a></b></h5>
                            <small class="text-muted">Pendaftar jenjang SMA</small>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Widget: Pendaftar Sudah Membayar -->
            <div class="col-sm-6 col-lg-3">
                <div class="card p-3">
                    <div class="d-flex align-items-center">
                        <span class="stamp stamp-md bg-warning mr-3">
                            <i class="fa fa-credit-card"></i>
                        </span>
                        <div>
                            <h5 class="mb-1"><b><a href="#">{{ $jumlahSudahBayar }} <small>Sudah
                                            Membayar</small></a></b></h5>
                            <small class="text-muted">Jumlah yang sudah membayar</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">
                            Grafik Statistik Pendaftar
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="chart-container" style="min-height: 375px">
                            <canvas id="statisticsChart"></canvas>
                        </div>
                        <div id="myChartLegend"></div>
                    </div>
                </div>
            </div>
            {{-- <div class="col-md-4">
                <div class="card full-height">
                    <div class="card-body">
                        <div class="card-title">Total income & spend statistics</div>
                        <div class="row py-3">
                            <div class="col-md-4 d-flex flex-column justify-content-around">
                                <div>
                                    <h6 class="fw-bold text-uppercase text-success op-8">Total Income</h6>
                                    <h3 class="fw-bold">$9.782</h3>
                                </div>
                                <div>
                                    <h6 class="fw-bold text-uppercase text-danger op-8">Total Spend</h6>
                                    <h3 class="fw-bold">$1,248</h3>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div id="chart-container">
                                    <canvas id="totalIncomeChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}
        </div>
        <!-- Load jQuery -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <!-- Load Chart.js -->
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            // Mengambil elemen canvas untuk grafik
            var ctx = document.getElementById('statisticsChart').getContext('2d');

            // Data untuk grafik
            var statisticsChart = new Chart(ctx, {
                type: 'line', // Tipe grafik (line chart)
                data: {
                    labels: {!! json_encode($months) !!}, // Label bulan dari controller
                    datasets: [{
                        label: "SMA", // Label untuk dataset SMA
                        borderColor: '#177dff', // Warna garis SMA
                        pointBackgroundColor: 'rgba(23, 125, 255, 0.6)', // Warna titik
                        pointRadius: 5, // Ukuran titik
                        backgroundColor: 'rgba(23, 125, 255, 0.4)', // Warna background SMA
                        legendColor: '#177dff', // Warna untuk legend
                        fill: true, // Isi area di bawah garis
                        borderWidth: 2, // Ketebalan garis
                        data: {!! json_encode($smaCounts) !!}, // Data SMA dari controller
                    }, {
                        label: "SMP", // Label untuk dataset SMP
                        borderColor: '#fdaf4b', // Warna garis SMP
                        pointBackgroundColor: 'rgba(253, 175, 75, 0.6)', // Warna titik
                        pointRadius: 5, // Ukuran titik
                        backgroundColor: 'rgba(253, 175, 75, 0.4)', // Warna background SMP
                        legendColor: '#fdaf4b', // Warna untuk legend
                        fill: true, // Isi area di bawah garis
                        borderWidth: 2, // Ketebalan garis
                        data: {!! json_encode($smpCounts) !!}, // Data SMP dari controller
                    }, {
                        label: "Belum Memilih Jenjang", // Label untuk dataset tanpa jenjang
                        borderColor: '#cccccc', // Warna garis abu-abu
                        pointBackgroundColor: 'rgba(204, 204, 204, 0.6)', // Warna titik abu-abu
                        pointRadius: 5, // Ukuran titik
                        backgroundColor: 'rgba(204, 204, 204, 0.4)', // Warna background abu-abu
                        legendColor: '#cccccc', // Warna untuk legend
                        fill: true, // Isi area di bawah garis
                        borderWidth: 2, // Ketebalan garis
                        data: {!! json_encode($noJenjangCounts) !!}, // Data pendaftar tanpa jenjang dari controller
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    tooltips: {
                        mode: 'index', // Mode untuk menampilkan semua data saat hover
                        intersect: false, // Agar tooltip muncul meski tidak tepat di titik
                        callbacks: {
                            label: function(tooltipItem, data) {
                                // Menampilkan tooltip dengan format khusus
                                var datasetLabel = data.datasets[tooltipItem.datasetIndex].label || '';
                                return datasetLabel + ': ' + tooltipItem.yLabel + ' pendaftar';
                            }
                        }
                    },
                    hover: {
                        mode: 'nearest', // Mode hover pada titik terdekat
                        intersect: true
                    },
                    scales: {
                        yAxes: [{
                            ticks: {
                                fontStyle: "500",
                                beginAtZero: true, // Memulai skala dari 0
                                maxTicksLimit: 5,
                                padding: 10
                            },
                            gridLines: {
                                drawTicks: false,
                                display: true // Menampilkan garis skala Y
                            }
                        }],
                        xAxes: [{
                            gridLines: {
                                zeroLineColor: "transparent"
                            },
                            ticks: {
                                padding: 10,
                                fontStyle: "500"
                            }
                        }]
                    },
                    legendCallback: function(chart) {
                        var text = [];
                        text.push('<ul class="' + chart.id + '-legend html-legend">');
                        for (var i = 0; i < chart.data.datasets.length; i++) {
                            text.push('<li><span style="background-color:' + chart.data.datasets[i].legendColor +
                                '"></span>');
                            if (chart.data.datasets[i].label) {
                                text.push(chart.data.datasets[i].label);
                            }
                            text.push('</li>');
                        }
                        text.push('</ul>');
                        return text.join('');
                    }
                }
            });
        </script>


        {{-- Timeline --}}
        {{-- <div class="row mt--2">
            <div class="col-md-12">
                <h4 class="page-title">Pusat Informasi Sistem</h4>
                <div class="row">
                    <div class="col-md-12">
                        <ul class="timeline">
                            @foreach ($informasi as $info)
                                <li class="{{ $loop->iteration % 2 == 0 ? 'timeline-inverted' : '' }}">
                                    <div class="timeline-badge {{ $info->status ? 'success' : 'danger' }}">
                                        <i class="flaticon-alarm-1"></i>
                                    </div>
                                    <div class="timeline-panel">
                                        <div class="timeline-heading">
                                            <h4 class="timeline-title">{{ $info->judul_informasi }}</h4>
                                            <p><small class="text-muted"><i class="flaticon-alarm-1"></i> 
                                                {{ $info->created_at->diffForHumans() }}</small></p>
                                        </div>
                                        <div class="timeline-body">
                                            <p>{{ $info->isi_informasi }}</p>
                                            @if ($info->photo)
                                                <img src="{{ asset('storage/' . $info->photo) }}" alt="Informasi Image" class="img-fluid">
                                            @endif
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div> --}}
        {{-- End --}}
    </div>
@endsection
