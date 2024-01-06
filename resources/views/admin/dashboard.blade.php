@extends('admin.body.admin_master')
@section('main')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Dashboard</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">{{ __('Home') }}</a></li>
                    <li class="breadcrumb-item active">{{ __('Dashboard') }}</li>
                </ol>
            </nav>
        </div>

        <section class="section dashboard">
            <div class="row">
                <div class="col-lg-12 ">
                    <div class="row">
                        <div class="col-xxl-2 col-md-4">
                            <div class="card info-card sales-card">

                                <div class="card-body">
                                    <h5 class="card-title">{{ __('Balance') }}</h5>
                                    <div class="d-flex align-items-center">
                                        <div
                                            class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="fa-solid fa-money-check-dollar"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6>{{ number_format($user_data->balance) }}ETB
                                            </h6>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-2 col-md-4">
                            <div class="card info-card sales-card">

                                <div class="card-body">
                                    <h5 class="card-title">{{ __('Total Package') }}</h5>
                                    <div class="d-flex align-items-center">
                                        <div
                                            class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="fa-solid fa-cubes"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6>{{ $total_packages }}</h6>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @can('Staff access')
                        <div class="col-xxl-2 col-md-4">
                            <div class="card info-card sales-card">

                                <div class="card-body">
                                    <h5 class="card-title">{{ __('Total Comission') }}</h5>
                                    <div class="d-flex align-items-center">
                                        <div
                                            class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="fa-solid fa-briefcase"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6>{{ number_format($user_data->Tot_commission) }}ETB</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endcan
                        <div class="col-xxl-2 col-md-4">
                            <div class="card info-card revenue-card">

                                <div class="card-body">
                                    <h5 class="card-title">Package on hand </h5>
                                    <div class="d-flex align-items-center">
                                        <div
                                            class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="fa-solid fa-box"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6>{{ $count_collected_packages }}</h6>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-2 col-md-4">
                            <div class="card info-card revenue-card">
                                <div class="card-body">
                                    <h5 class="card-title">{{ __('Delivered') }}</h5>
                                    <div class="d-flex align-items-center">
                                        <div
                                            class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="fa-solid fa-truck-fast"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6>{{ $count_delivered_packages }}</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-2 col-md-4">
                            <div class="card info-card revenue-card">
                                <div class="card-body">
                                    <h5 class="card-title">{{ __('Daily Collected Cash') }}</h5>
                                    <div class="d-flex align-items-center">
                                        <div
                                            class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="fa-solid fa-truck-fast"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6>{{ number_format($total_price) }}ETB</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <h3>Latest Transaction</h3>
                        <section class="section">
                            <div class="row">
                                <div class="col-lg-10">
                                    <div class="card">
                                        <div class="card-body">
                                            <table class="table datatable ">
                                                <thead class="text-capitalize">
                                                    <tr>
                                                        <th scope="col">{{ __('ID') }}</th>
                                                        <th scope="col">{{ __('Date') }}</th>
                                                        <th scope="col">{{ __('Status') }}</th>
                                                        <th scope="col">{{ __('Package Price') }}</th>
                                                        <th scope="col">{{ __('Ded_amount') }}</th>
                                                        <th scope="col">{{ __('Commission') }}</th>
                                                        <th scope="col">{{ __('Closing Balance') }}</th>       
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                    </tr>
                                                    @foreach ($Leatest_Trancation as $Leatest_Trancation)
                                                        <tr>
                                                            <td>{{ $loop->iteration }}</td>
                                                            <td>{{ $Leatest_Trancation->created_at }}</td>
                                                            <td>
                                                                @if ($Leatest_Trancation->status == 'collected')
                                                                <span class="badge bg-warning text-white">{{ __('Collected') }}</span>
                                                                @elseif($Leatest_Trancation->status == 'in-transit')
                                                                    <span class="badge bg-warning text-dark">{{ __('In-Transit') }}</span>
                                                                @elseif($Leatest_Trancation->status == 'received')
                                                                    <span class="badge bg-success text-white">{{ __('Received') }}</span>
                                                                @endif
                                                            </td>
                                                            <td>{{ number_format($Leatest_Trancation->price) }}ETB</td>
                                                            <td>-{{ number_format($Leatest_Trancation->Ded_amount) }}ETB</td>
                                                            <td>+{{ number_format($Leatest_Trancation->commission) }}ETB</td>
                                                            <td>{{ number_format($Leatest_Trancation->current_balance,2) }}ETB</td>
                                                            {{-- <td>{{ $Leatest_Trancation->user->first_name }} {{ $data->user->last_name }}</td> --}}
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                        {{-- Graph --}}
                        @can('Staff access')
                        <div class="col-12">
                            <div class="card">
                                <div class="filter">
                                    <a class="icon" href="#" data-bs-toggle="dropdown"><i
                                            class="bi bi-three-dots"></i></a>
                                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                        <li class="dropdown-header text-start">
                                            <h6>Filter</h6>
                                        </li>
                                        <li><a class="dropdown-item" href="#">Today</a></li>
                                        <li><a class="dropdown-item" href="#">This Month</a></li>
                                        <li><a class="dropdown-item" href="#">This Year</a></li>
                                    </ul>
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title">Reports <span>/Today</span></h5>
                                    <div id="reportsChart"></div>
                                    <script>
                                        document.addEventListener("DOMContentLoaded", () => {
                                            new ApexCharts(document.querySelector("#reportsChart"), {
                                                series: [{
                                                    name: 'Sales',
                                                    data: [31, 40, 28, 51, 42, 82, 56],
                                                }, {
                                                    name: 'Revenue',
                                                    data: [11, 32, 45, 32, 34, 52, 41]
                                                }, {
                                                    name: 'Customers',
                                                    data: [15, 11, 32, 18, 9, 24, 11]
                                                }],
                                                chart: {
                                                    height: 350,
                                                    type: 'area',
                                                    toolbar: {
                                                        show: false
                                                    },
                                                },
                                                markers: {
                                                    size: 4
                                                },
                                                colors: ['#4154f1', '#2eca6a', '#ff771d'],
                                                fill: {
                                                    type: "gradient",
                                                    gradient: {
                                                        shadeIntensity: 1,
                                                        opacityFrom: 0.3,
                                                        opacityTo: 0.4,
                                                        stops: [0, 90, 100]
                                                    }
                                                },
                                                dataLabels: {
                                                    enabled: false
                                                },
                                                stroke: {
                                                    curve: 'smooth',
                                                    width: 2
                                                },
                                                xaxis: {
                                                    type: 'datetime',
                                                    categories: ["2018-09-19T00:00:00.000Z", "2018-09-19T01:30:00.000Z",
                                                        "2018-09-19T02:30:00.000Z", "2018-09-19T03:30:00.000Z",
                                                        "2018-09-19T04:30:00.000Z", "2018-09-19T05:30:00.000Z",
                                                        "2018-09-19T06:30:00.000Z"
                                                    ]
                                                },
                                                tooltip: {
                                                    x: {
                                                        format: 'dd/MM/yy HH:mm'
                                                    },
                                                }
                                            }).render();
                                        });
                                    </script>
                                </div>
                                @endcan
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </section>
    </main>
@endsection

