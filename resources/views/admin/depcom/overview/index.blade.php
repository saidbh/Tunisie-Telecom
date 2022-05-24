@extends('admin.master')
@section('content')
    <div id="content-page" class="content-page">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    @if (Session::has('error'))
                        <div class="alert alert-danger">{{ Session::get('error') }}</div>
                    @endif
                    @if (Session::has('success'))
                        <div class="alert alert-success">{{ Session::get('success') }}</div>
                    @endif
                </div>
                <div class="col-sm-12">
                    <div class="iq-card">
                        <div class="iq-card-header d-flex justify-content-between">
                            <div class="iq-header-title w-100">
                                <div class="row">
                                    <div class="col-md-12 d-flex flex-row align-items-center justify-content-between">
                                        <h4 class="card-title m-0">Statistiques</h4>
                                        <div class="d-flex flex-row">
                                            <a href="#" class="btn ml-1 btn-success" data-toggle="modal" data-target="#uploadfiles">Excel</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="iq-card-body">
                            <div class="container">
                                <div class="row justify-content-center">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="objectifs">Liste des objectifs</label>
                                            <select class="form-control" id="objectifs">
                                                <option></option>
                                                @foreach($offre as $off)
                                                    <option value="{{ $off->id }}" data-subtext="">{{ $off->CommercialOffre->name }} {{ $off->ObjectifType->name }} {{ $off->objectifs }} </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="container-fluid">
                                <div class="row justify-content-center">
                                    <div class="col-lg-12">
                                        <div id="chart"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <style rel="stylesheet">
        .custom-select {
            width: auto;
            display: inline-block;
            padding: 0 5px;
            height: 20px;
            line-height: 20px;
        }
        .dropdown-menu .inner ul li {
            position: relative;
            font-size: 14px;
            height: 30px;
            display: flex;
            align-items: center;
            padding: 0 10px;
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script>
        $(document).ready(function() {
            $('#objectifs').selectpicker({
                liveSearch:true,
                noneResultsText:'Aucun résultat correspondant'
            }).on('change', function(){
                $.ajax({
                    "headers": {
                        'X-CSRF-TOKEN': '{{csrf_token()}}',
                        'Authorization' : 'Bearer {{Auth::user()->api_token}}',
                    },
                    "url": "{{route('stat-offres')}}",
                    "type": "post",
                    "responseType": 'json',
                    "data":{
                        offre:$(this).val(),
                    },
                    success: function (data) {
                        var realisation = [];
                        var realisation_rate = [];
                        var rest = [];
                        var dates = [];
                        $.each(data.data, function(key, value){
                            realisation.push(data.data[key].realisation);
                        });
                        $.each(data.data, function(key, value){
                            realisation_rate.push(data.data[key].realisation_rate);
                        });
                        $.each(data.data, function(key, value){
                            rest.push(data.data[key].rest_per_objectifs);
                        });
                        $.each(data.data, function(key, value){
                            dates.push(data.data[key].realisation_date);
                        });
                        var options = {
                            series: [{
                                name: 'Realisation',
                                data: realisation,
                            }, {
                                name: 'Taux de realisation',
                                data: realisation_rate,
                            }, {
                                name: 'Reste par objectif',
                                data: rest,
                            }],
                            chart: {
                                type: 'bar',
                                height: 350,
                                stacked: true,
                                toolbar: {
                                    show: true
                                },
                                zoom: {
                                    enabled: true
                                }
                            },
                            responsive: [{
                                breakpoint: 480,
                                options: {
                                    legend: {
                                        position: 'bottom',
                                        offsetX: -10,
                                        offsetY: 0
                                    }
                                }
                            }],
                            plotOptions: {
                                bar: {
                                    horizontal: false,
                                    borderRadius: 10
                                },
                            },
                            xaxis: {
                                type: 'text',
                                categories: dates,
                            },
                            legend: {
                                position: 'right',
                                offsetY: 40
                            },
                            fill: {
                                opacity: 1
                            }
                        };
                        var chart = new ApexCharts(document.querySelector("#chart"), options);
                        chart.render();
                    }
                })
            });
        });
    </script>
@endsection
