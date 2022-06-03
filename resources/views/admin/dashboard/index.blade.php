@extends('admin.master')
@section('content')
    <div id="content-page" class="content-page">
        <div class="container-fluid">
            <div class="row row-eq-height">
                <!-- Content Top Banner Start -->
                <div class="col-md-12 col-lg-12">
                    <div class="iq-card bg-primary sb-top-banner-card">
                        <div class="iq-card-body pt-5 pb-5">
                            <div class="row">
                                <div class="col-md-6 align-self-center">
                                    <h2 class="text-white">Bienvenue</h2>
                                    <p class="text-white">
                                        Bienvenue dans la plateforme BI permettant le suivi des clés de performance liés à la gestion des ventes et des offres chez Tunisie Télécom 
                                    </p>
                                    <button type="button" class="btn iq-bg-primary">Voir plus</button>
                                </div>
                                <div class="col-md-6 position-relative">
                                    <div class="an-img-two">
                                        <div class="bodymovin" data-bm-path={{asset("assets/images/small/data1.json")}} data-bm-renderer="svg"
                                             data-bm-loop="true"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="iq-card">
                                    <div class="iq-card-header d-flex justify-content-between">
                                        <div class="iq-header-title w-100">
                                            <div class="row">
                                                <div class="col-md-12 d-flex flex-row align-items-center justify-content-between">
                                                    <h4 class="card-title m-0">Statistiques annuel des offres techniques</h4>
                                                    <div class="d-flex flex-row">
                                                        {{--                                            <a href="#" class="btn mx-1 btn-success">PDF</a>--}}
                                                        {{--                                            <a href="#" class="btn btn-success">Excel</a>--}}                        
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="iq-card-body">
                                        <div id="technicals"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="iq-card">
                                    <div class="iq-card-header d-flex justify-content-between">
                                        <div class="iq-header-title w-100">
                                            <div class="row">
                                                <div class="col-md-12 d-flex flex-row align-items-center justify-content-between">
                                                    <h4 class="card-title m-0">Statistisues annuel des offres Commerciales</h4>
                                                    <div class="d-flex flex-row">
                                                        {{--                                            <a href="#" class="btn mx-1 btn-success">PDF</a>--}}
                                                        {{--                                            <a href="#" class="btn btn-success">Excel</a>--}}                        
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="iq-card-body">
                                        <div id="commercial123"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="iq-card">
                                    <div class="iq-card-header d-flex justify-content-between">
                                        <div class="iq-header-title w-100">
                                            <div class="row">
                                                <div class="col-md-12 d-flex flex-row align-items-center justify-content-between">
                                                    <h4 class="card-title m-0">Statistisues annuel suivi qualité ADSL</h4>
                                                    <div class="d-flex flex-row">
                                                        {{--                                            <a href="#" class="btn mx-1 btn-success">PDF</a>--}}
                                                        {{--                                            <a href="#" class="btn btn-success">Excel</a>--}}                        
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="iq-card-body">
                                        <div id="statADSL1"></div>
                                        <div id="statADSL2"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="iq-card">
                                    <div class="iq-card-header d-flex justify-content-between">
                                        <div class="iq-header-title w-100">
                                            <div class="row">
                                                <div class="col-md-12 d-flex flex-row align-items-center justify-content-between">
                                                    <h4 class="card-title m-0">Statistisues annuel suivi qualité Fixes</h4>
                                                    <div class="d-flex flex-row">
                                                        {{--                                            <a href="#" class="btn mx-1 btn-success">PDF</a>--}}
                                                        {{--                                            <a href="#" class="btn btn-success">Excel</a>--}}                        
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="iq-card-body">
                                        <div id="statfixes1"></div>
                                        <div id="statfixes2"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script>
        var options = {
          series: [{
          name: 'Département Technique',
          data: [{{$techObjectifs}},{{$techrealisation}} ,{{$techrate}} ,{{$techrest}}]
        }],
          annotations: {
          points: [{
            x: 'Bananas',
            seriesIndex: 0,
            label: {
              borderColor: '#775DD0',
              offsetY: 0,
              style: {
                color: '#fff',
                background: '#775DD0',
              },
              text: 'Département Technique',
            }
          }]
        },
        chart: {
          height: 350,
          type: 'bar',
        },
        plotOptions: {
          bar: {
            borderRadius: 10,
            columnWidth: '50%',
          }
        },
        dataLabels: {
          enabled: false
        },
        stroke: {
          width: 2
        },
        
        grid: {
          row: {
            colors: ['#fff', '#f2f2f2']
          }
        },
        xaxis: {
          labels: {
            rotate: -45
          },
          categories: ["Total objectifs", "Total réalisation","Total taux realisations","Total reste par objectifs"],
          tickPlacement: 'on'
        },
        yaxis: {
          title: {
            text: 'Département Technique',
          },
        },
        fill: {
          type: 'gradient',
          gradient: {
            shade: 'light',
            type: "horizontal",
            shadeIntensity: 0.25,
            gradientToColors: undefined,
            inverseColors: true,
            opacityFrom: 0.85,
            opacityTo: 0.85,
            stops: [50, 0, 100]
          },
        }
        };
        var chart = new ApexCharts(document.querySelector('#technicals'),
            options
        );
        chart.render();
    </script>
    <script>
        var options1 = {
          series: [{
          name: 'Département commerciale',
          data: [{{$comObjectifs}},{{$comrealisation}} ,{{$comrate}} ,{{$comrest}}]
        }],
          annotations: {
          points: [{
            x: 'Département commerciale',
            seriesIndex: 0,
            label: {
              borderColor: '#775DD0',
              offsetY: 0,
              style: {
                color: '#fff',
                background: '#775DD0',
              },
              text: 'Département commerciale',
            }
          }]
        },
        chart: {
          height: 350,
          type: 'bar',
        },
        plotOptions: {
          bar: {
            borderRadius: 10,
            columnWidth: '50%',
          }
        },
        dataLabels: {
          enabled: false
        },
        stroke: {
          width: 2
        },
        
        grid: {
          row: {
            colors: ['#fff', '#f2f2f2']
          }
        },
        xaxis: {
          labels: {
            rotate: -45
          },
          categories: ["Total objectifs", "Total réalisation","Total taux realisations","Total reste par objectifs"],
          tickPlacement: 'on'
        },
        yaxis: {
          title: {
            text: 'Département commerciale',
          },
        },
        fill: {
          type: 'gradient',
          gradient: {
            shade: 'light',
            type: "horizontal",
            shadeIntensity: 0.25,
            gradientToColors: undefined,
            inverseColors: true,
            opacityFrom: 0.85,
            opacityTo: 0.85,
            stops: [50, 0, 100]
          },
        }
        };
        var chart1 = new ApexCharts(document.querySelector('#commercial123'),
            options1
        );
        chart1.render();
    </script>
                                                            <script>
                                                                var options = {
                                                                    "chart": {
                                                                        "height": 350,
                                                                        "type": "pie",
                                                                        "toolbar": {
                                                                            "show": true,
                                                                            "tools": {
                                                                                "download": true,
                                                                                "selection": false,
                                                                                "zoom": false,
                                                                                "zoomin": false,
                                                                                "zoomout": false,
                                                                                "pan": false,
                                                                                "reset": false
                                                                            },
                                                                            "autoSelected": "zoom"
                                                                        },
                                                                        events: {
                                                                            dataPointSelection: function (event, chartContext, config) {
                                                                                console.log(config.dataPointIndex + " " + config.seriesIndex);
                                                                            },
                                                                            click: function (event, chartContext, config) {
                                                                                console.log(config.dataPointIndex + " " + config.seriesIndex);
                                                                            }
                                                                        }
                                                                    },
                                                                    "series": [ {{$adslSuccession_rate}}, {{$adslSuccession_rate_24h}}, {{$adslSuccession_rate_48h}}, {{$adslSuccession_rate_72h}}, {{$adslH48_drg_speed}}],
                                                                    "labels": ["Taux de relève", "Taux de relève en 24H","Taux relève en 48H","Taux de relève en 72H","Vitesse DRG 48H sans vol de cable"]
                                                                }
                                                                var chart = new ApexCharts(document.querySelector("#statADSL1"),
                                                                    options
                                                                );
                                                                chart.render();
                                                            </script>
                                                            <script>

                                                                var options = {
                                                                series: [{
                                                                data: [{{$adsldgt_raise}}, {{$adsldgt_raised_actual}},{{$adslmttr_adsl}}]
                                                                }],
                                                                chart: {
                                                                type: 'bar',
                                                                height: 150
                                                                },
                                                                plotOptions: {
                                                                bar: {
                                                                    borderRadius: 4,
                                                                    horizontal: true,
                                                                }
                                                                },
                                                                dataLabels: {
                                                                enabled: false
                                                                },
                                                                xaxis: {
                                                                categories: ['DGT à relever','DGT à relever réels','MTTR ADSL (Heures)'],
                                                                }
                                                                };

                                                                var chart = new ApexCharts(document.querySelector("#statADSL2"), options);
                                                                chart.render();
                                                            </script>

<script>
var options = {
    "chart": {
        "height": 350,
        "type": "pie",
        "toolbar": {
            "show": true,
            "tools": {
                "download": true,
                "selection": false,
                "zoom": false,
                "zoomin": false,
                "zoomout": false,
                "pan": false,
                "reset": false
            },
            "autoSelected": "zoom"
        },
        events: {
            dataPointSelection: function (event, chartContext, config) {
                console.log(config.dataPointIndex + " " + config.seriesIndex);
            },
            click: function (event, chartContext, config) {
                console.log(config.dataPointIndex + " " + config.seriesIndex);
            }
        }
    },
    "series": [ {{$fixesSuccession_rate}}, {{$fixesSuccession_rate_24h}}, {{$fixesSuccession_rate_48h}}, {{$fixesSuccession_rate_72h}}, {{$fixesH48_drg_speed}}],
    "labels": ["Taux de relève", "Taux de relève en 24H","Taux relève en 48H","Taux de relève en 72H","Vitesse DRG 48H sans vol de cable"]
}
var chart = new ApexCharts(document.querySelector("#statfixes1"),
    options
);
chart.render();
</script>
<script>

var options = {
series: [{
data: [{{$fixesdgt_raise}}, {{$fixesdgt_raised_actual}},]
}],
chart: {
type: 'bar',
height: 150
},
plotOptions: {
bar: {
    borderRadius: 4,
    horizontal: true,
}
},
dataLabels: {
enabled: false
},
xaxis: {
categories: ['DGT à relever','DGT à relever réels',],
}
};

var chart = new ApexCharts(document.querySelector("#statfixes2"), options);
chart.render();
</script>
@endsection