@extends('layout.index')

@section('title', 'Dashboard')

@section('css')

@endsection

@section('breadcumb')

    <!-- PAGE-HEADER -->
    <div class="page-header">
        <h1 class="page-title my-auto">Dashboard</h1>
        <div>
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item">
            <a href="javascript:void(0)">Home</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
        </ol>
        </div>
    </div>
    <!-- PAGE-HEADER END -->

@endsection

@section('content')

    <!-- ROW-1 -->
    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-12 col-xxl-6">
            <div class="card overflow-hidden">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="mt-2">
                            <h6 class="fw-normal">Total Users</h6>
                            <h2 class="mb-0 text-dark fw-semibold">44,278</h2>
                        </div>
                        <div class="ms-auto">
                            <div class="chart-wrapper mt-1">
                                <canvas id="saleschart" class="chart-dropshadow"></canvas>
                            </div>
                        </div>
                    </div>
                    <span class="text-muted fs-12"><span class="text-secondary"><i
                                class="fe fe-arrow-up-circle text-secondary"></i> 5%</span>
                        Last week</span>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12 col-xxl-6">
            <div class="card overflow-hidden">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="mt-2">
                            <h6 class="fw-normal">Total Profit</h6>
                            <h2 class="mb-0 text-dark fw-semibold">67,987</h2>
                        </div>
                        <div class="ms-auto">
                            <div class="chart-wrapper mt-1">
                                <canvas id="leadschart"
                                    class="chart-dropshadow"></canvas>
                            </div>
                        </div>
                    </div>
                    <span class="text-muted fs-12"><span class="text-pink"><i
                                class="fe fe-arrow-down-circle text-pink"></i> 0.75%</span>
                        Last 6 days</span>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xxl-12">
            <div class="card overflow-hidden">
                <div class="card-header">
                    <h3 class="card-title">Sales Analytics</h3>
                </div>
                <div class="card-body">
                    <div class="d-flex mx-auto text-center justify-content-center mb-4">
                        <div class="d-flex text-center justify-content-center me-3"><span
                                class="dot-label bg-primary my-auto"></span>Total Sales</div>
                        <div class="d-flex text-center justify-content-center"><span
                                class="dot-label bg-secondary my-auto"></span>Total Orders</div>
                    </div>
                    <div class="chartjs-wrapper-demo w-100">
                        <canvas id="transactions" class="chart-dropshadow w-100"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
    <!-- ROW-2 END -->

@endsection

@section('script')



@endsection