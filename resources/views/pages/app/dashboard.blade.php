@extends('layouts.app')

@section('title', 'General Dashboard')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/jqvmap/dist/jqvmap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/summernote/dist/summernote-bs4.min.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Dashboard</h1>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-primary">
                            <i class="far fa-user"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Total Users</h4>
                            </div>
                            <div class="card-body">
                                <h3>{{ number_format($user) }}</h3>
                                {{-- <h2 class="title-font font-medium text-xl text-gray-900">{{$orders->count()}}</h2> --}}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-danger">
                            <i class="far fa-user"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Total Driver</h4>
                            </div>

                            <div class="card-body">
                                <h3>{{ number_format($driver) }}</h3>
                            </div>


                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-warning">
                            <i class="far fa-file"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Total Order</h4>
                            </div>
                            <div class="card-body">
                                <h3>{{ number_format($receipt) }}</h3>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-success">
                            <i class="fa-duotone fa-dollar-sign"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Total Transaksi</h4>
                            </div>
                            <div class="card-wrap">
                                <h3>{{number_format ($tarif) }}</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                {{-- <div class="col-lg-8 col-md-12 col-12 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Statistics</h4>
                            <div class="card-header-action">
                                <div class="btn-group">
                                    <a href="#" class="btn btn-primary">Week</a>
                                    <a href="#" class="btn">Month</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <canvas id="myChart" height="182"></canvas>
                            <div class="statistic-details mt-sm-4">
                                <div class="statistic-details-item">
                                    <span class="text-muted"><span class="text-primary"><i
                                                class="fas fa-caret-up"></i></span> 7%</span>
                                    <div class="detail-value">{{($tarif)}}</div>
                                    <div class="detail-name">Today's Sales</div>
                                </div>
                                <div class="statistic-details-item">
                                    <span class="text-muted"><span class="text-danger"><i
                                                class="fas fa-caret-down"></i></span> 23%</span>
                                    <div class="detail-value">$2,902</div>
                                    <div class="detail-name">This Week's Sales</div>
                                </div>
                                <div class="statistic-details-item">
                                    <span class="text-muted"><span class="text-primary"><i
                                                class="fas fa-caret-up"></i></span>9%</span>
                                    <div class="detail-value">$12,821</div>
                                    <div class="detail-name">This Month's Sales</div>
                                </div>
                                <div class="statistic-details-item">
                                    <span class="text-muted"><span class="text-primary"><i
                                                class="fas fa-caret-up"></i></span> 19%</span>
                                    <div class="detail-value">$92,142</div>
                                    <div class="detail-name">This Year's Sales</div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div> --}}
                  <div class="col-lg-8 col-md-12 col-12 col-sm-12">
                    <div id="container"></div>
                </div>
                <div class="col-lg-4 col-md-12 col-12 col-sm-12">

                    <div class="card">
                        <div class="card-header">
                            <h4>History Order</h4>
                        </div>



<div class="card-body">
    <ul class="list-unstyled list-unstyled-border">
        @foreach ($receipts as $receiptOrder )


        <li class="media">
            <img class="rounded-circle mr-3" width="50"
                src="{{ asset('img/avatar/avatar-1.png') }}" alt="avatar">
            <div class="media-body">
                <div class="text-primary float-right">{{$receiptOrder->order->service}}</div>

                <div class="media-title">{{$receiptOrder->user->name}}</div>
                <div> <span class="text-small text-muted">Driver {{$receiptOrder->driver->name}}</span></div>
                <div><span class="text-small text-muted">{{$receiptOrder->created_at}}</span></div>


            </div>
        </li>



        @endforeach
    </ul>
    {{-- <div class="pt-1 pb-1 text-center">
        <a href="#" class="btn btn-primary btn-lg btn-round">
            View All
        </a>
    </div> --}}
</div>
                    </div>

                </div>
            </div>


        </section>

    </div>
    {{-- <h1>Users Graphs</h1>

<div style="width: 50%">
    {!! $userChart->container() !!}
</div> --}}
@endsection

@push('scripts')
    <!-- JS Libraies -->
    <script src="{{ asset('library/simpleweather/jquery.simpleWeather.min.js') }}"></script>
    <script src="{{ asset('library/chart.js/dist/Chart.min.js') }}"></script>
    <script src="{{ asset('library/jqvmap/dist/jquery.vmap.min.js') }}"></script>
    <script src="{{ asset('library/jqvmap/dist/maps/jquery.vmap.world.js') }}"></script>
    <script src="{{ asset('library/summernote/dist/summernote-bs4.min.js') }}"></script>
    <script src="{{ asset('library/chocolat/dist/js/jquery.chocolat.min.js') }}"></script>
    <script src="https://code.highcharts.com/highcharts.js"></script>
    {{-- {{$months}} --}}
    {{-- var userData = <?php echo json_encode($month_totals)?>; --}}

<script type="text/javascript">
    var userData = <?php echo json_encode($month_totals)?>;
    var user = <?php echo json_encode($month_titles)?>;

    Highcharts.chart('container', {
        title: {
            text: 'Grafik Transaksi'
        },
        // subtitle: {
        //     text: 'Bluebird youtube channel'
        // },
        xAxis: {
            categories:user
        },
        yAxis: {
            title: {
                text: 'rata-rata transaksi harian'
            }
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle'
        },
        plotOptions: {
            series: {
                allowPointSelect: true
            }
        },
        series: [{
            name: 'Total Order',
            data: userData
        }],
        responsive: {
            rules: [{
                condition: {
                    maxWidth: 500
                },
                chartOptions: {
                    legend: {
                        layout: 'horizontal',
                        align: 'center',
                        verticalAlign: 'bottom'
                    }
                }
            }]
        }
    });

</script>
    <!-- Page Specific JS File -->
    <script src="{{ asset('js/page/index-0.js') }}"></script>
    {{-- <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/highcharts/6.0.6/highcharts.js" charset="utf-8"></script> --}}

{{-- {!! $usersChart->script() !!} --}}
@endpush
{{-- // @json($months->map(fn ($months) => $months->month)),
// @json($months->map(fn ($months) => $months->month)),
// @json($months->map(fn ($months) => $months->month)),
// @json($months->map(fn ($months) => $months->month)),
// @json($months->map(fn ($months) => $months->month)),
// @json($months->map(fn ($months) => $months->month)),
// @json($months->map(fn ($months) => $months->month)),
// @json($months->map(fn ($months) => $months->month)),
// @json($months->map(fn ($months) => $months->month)),
// @json($months->map(fn ($months) => $months->month)),
// @json($months->map(fn ($months) => $months->month)),
// @json($months->map(fn ($months) => $months->month)), --}}
