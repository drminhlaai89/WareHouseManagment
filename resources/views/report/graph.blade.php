@extends('layout.master')

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>

@push('plugin-styles')
    <!-- {!!  Html::style('/assets/plugins/plugin.css') !!} -->
@endpush

@section('content')
    <div class="row">
        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
            <div class="card card-statistics">
                <div class="card-body">
                    <div
                        class="d-flex flex-md-column flex-xl-row flex-wrap justify-content-between align-items-md-center justify-content-xl-between">
                        <div class="float-left">
                            <i class="mdi mdi-cube text-danger icon-lg"></i>
                        </div>
                        <div class="float-right">
                            <p class="mb-0 text-right">Total Import</p>
                            <div class="fluid-container">
                            <h3 class="font-weight-medium text-right mb-0">{{$totalimp}}VNĐ</h3>
                            </div>
                        </div>
                    </div>
                    <p class="text-muted mt-3 mb-0 text-left text-md-center text-xl-left">
                        <i class="mdi mdi-alert-octagon mr-1" aria-hidden="true"></i> 30 Days </p>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
            <div class="card card-statistics">
                <div class="card-body">
                    <div
                        class="d-flex flex-md-column flex-xl-row flex-wrap justify-content-between align-items-md-center justify-content-xl-between">
                        <div class="float-left">
                            <i class="mdi mdi-receipt text-warning icon-lg"></i>
                        </div>
                        <div class="float-right">
                            <p class="mb-0 text-right">Total Export</p>
                            <div class="fluid-container">
                            <h3 class="font-weight-medium text-right mb-0">{{$totalexp}}VNĐ</h3>
                            </div>
                        </div>
                    </div>
                    <p class="text-muted mt-3 mb-0 text-left text-md-center text-xl-left">
                        <i class="mdi mdi-bookmark-outline mr-1" aria-hidden="true"></i> 30 Days </p>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
            <div class="card card-statistics">
                <div class="card-body">
                    <div
                        class="d-flex flex-md-column flex-xl-row flex-wrap justify-content-between align-items-md-center justify-content-xl-between">
                        <div class="float-left">
                            <i class="mdi mdi-poll-box text-success icon-lg"></i>
                        </div>
                        <div class="float-right">
                            <p class="mb-0 text-right">Product</p>
                            <div class="fluid-container">
                            <h3 class="font-weight-medium text-right mb-0">{{$totalpro}}</h3>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
            <div class="card card-statistics">
                <div class="card-body">
                    <div
                        class="d-flex flex-md-column flex-xl-row flex-wrap justify-content-between align-items-md-center justify-content-xl-between">
                        <div class="float-left">
                            <i class="mdi mdi-account-box-multiple text-info icon-lg"></i>
                        </div>
                        <div class="float-right">
                            <p class="mb-0 text-right">Employees</p>
                            <div class="fluid-container">
                            <h3 class="font-weight-medium text-right mb-0">{{$totalemp}}</h3>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 grid-margin">
            <div class="card">
                <div class="card-body">
                    <div class="d-sm-flex justify-content-between align-items-center mb-4">
                        <h2 class="card-title mb-0">Import Analysis</h2>
                        <div class="wrapper d-flex">
                            {{-- <div class="d-flex align-items-center mr-3">
                                <span class="dot-indicator bg-success"></span>
                                <p class="mb-0 ml-2 text-muted">Export</p>
                            </div> --}}
                            <div class="d-flex align-items-center">
                                <span class="dot-indicator bg-primary"></span>
                                <p class="mb-0 ml-2 text-muted">Import</p>
                            </div>
                        </div>
                    </div>
                    <div class="chart-container">
                        <canvas id="test10" height="80"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 grid-margin">
            <div class="card">
                <div class="card-body">
                    <div class="d-sm-flex justify-content-between align-items-center mb-4">
                        <h2 class="card-title mb-0">Export Analysis</h2>
                        <div class="wrapper d-flex">
                            {{-- <div class="d-flex align-items-center mr-3">
                                <span class="dot-indicator bg-success"></span>
                                <p class="mb-0 ml-2 text-muted">Export</p>
                            </div> --}}
                            <div class="d-flex align-items-center">
                                <span class="dot-indicator bg-primary"></span>
                                <p class="mb-0 ml-2 text-muted">Export</p>
                            </div>
                        </div>
                    </div>
                    <div class="chart-container">
                        <canvas id="test12" height="80"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
    
    <script>
        $(document).ready(function() {
            var lineChartStyleOption_1 = {
                scales: {
                    yAxes: [{
                        display: false
                    }],
                    xAxes: [{
                        display: false
                    }]
                },
                legend: {
                    display: false
                },
                elements: {
                    point: {
                        radius: 1
                    },
                    line: {
                        tension: 0
                    }
                },
                stepsize: 100000
            };
            if ($("#test10").length) {
                var lineChartCanvas = $("#test10")
                    .get(0)
                    .getContext("2d");
                var date = <?php echo json_encode($dateimport)?>;
                var value = <?php echo json_encode($valueimport)?>;
                var data = {
                    labels: date,
                    datasets: [{
                            label: "Product",
                            data: value,
                            backgroundColor: "#2196f3",
                            borderColor: "#0c83e2",
                            borderWidth: 1,
                            fill: true

                        },
                        // {
                        //     label: "Product",
                        //     data: [7, 5, 14, 7, 12, 6, 10, 6, 11, 5],
                        //     backgroundColor: "#19d895",
                        //     borderColor: "#15b67d",
                        //     borderWidth: 1,
                        //     fill: true
                        // }
                    ]

                };
                var options = {
                    responsive: true,
                    maintainAspectRatio: true,
                    scales: {
                        yAxes: [{
                            gridLines: {
                                color: "#F2F6F9"
                            },
                            ticks: {
                                beginAtZero: true,
                                min: 0,
                                max: 5000000,
                                stepSize: 10000
                            }
                        }],
                        xAxes: [{
                            gridLines: {
                                color: "#F2F6F9"
                            },
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    },
                    legend: {
                        display: false
                    },
                    elements: {
                        point: {
                            radius: 2
                        }
                    },
                    layout: {
                        padding: {
                            left: 0,
                            right: 0,
                            top: 0,
                            bottom: 0
                        }
                    },
                    stepsize: 1
                };
                var lineChart = new Chart(lineChartCanvas, {
                    type: "line",
                    data: data,
                    options: options
                });

            }
        })

    </script>
    <script>
        $(document).ready(function() {
            var lineChartStyleOption_1 = {
                scales: {
                    yAxes: [{
                        display: false
                    }],
                    xAxes: [{
                        display: false
                    }]
                },
                legend: {
                    display: false
                },
                elements: {
                    point: {
                        radius: 1
                    },
                    line: {
                        tension: 0
                    }
                },
                stepsize: 100000
            };
            if ($("#test12").length) {
                var lineChartCanvas = $("#test12")
                    .get(0)
                    .getContext("2d");
                var date = <?php echo json_encode($dateimport)?>;
                var value = <?php echo json_encode($valueexport)?>;
                var data = {
                    labels: date,
                    datasets: [{
                            label: "Product",
                            data: value,
                            backgroundColor: "#2196f3",
                            borderColor: "#0c83e2",
                            borderWidth: 1,
                            fill: true

                        },
                        // {
                        //     label: "Product",
                        //     data: [7, 5, 14, 7, 12, 6, 10, 6, 11, 5],
                        //     backgroundColor: "#19d895",
                        //     borderColor: "#15b67d",
                        //     borderWidth: 1,
                        //     fill: true
                        // }
                    ]

                };
                var options = {
                    responsive: true,
                    maintainAspectRatio: true,
                    scales: {
                        yAxes: [{
                            gridLines: {
                                color: "#F2F6F9"
                            },
                            ticks: {
                                beginAtZero: true,
                                min: 0,
                                max: 5000000,
                                stepSize: 10000
                            }
                        }],
                        xAxes: [{
                            gridLines: {
                                color: "#F2F6F9"
                            },
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    },
                    legend: {
                        display: false
                    },
                    elements: {
                        point: {
                            radius: 2
                        }
                    },
                    layout: {
                        padding: {
                            left: 0,
                            right: 0,
                            top: 0,
                            bottom: 0
                        }
                    },
                    stepsize: 1
                };
                var lineChart = new Chart(lineChartCanvas, {
                    type: "line",
                    data: data,
                    options: options
                });

            }
        })

    </script>


@endsection

@push('plugin-scripts')
    {!! Html::script('/assets/plugins/chartjs/chart.min.js') !!}
    {!! Html::script('/assets/plugins/jquery-sparkline/jquery.sparkline.min.js') !!}
@endpush

@push('custom-scripts')
    {!! Html::script('/assets/js/dashboard.js') !!}
@endpush
