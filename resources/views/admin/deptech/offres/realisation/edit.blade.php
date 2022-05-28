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
                                        <h4 class="card-title m-0">Edit Realisation</h4>
                                        <div class="d-flex flex-row">
                                            {{--                                            <a href="#" class="btn mx-1 btn-success">PDF</a>--}}
                                            {{--                                            <a href="#" class="btn btn-success">Excel</a>--}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <form action="{{ route('realisation-offres-list.update',$realisation->id) }}" method="post" enctype="multipart/form-data" class="was-validated">
                            @csrf
                            @method('put')
                        <div class="iq-card-body">
                            <div class="container-fluid">
                                <div class="row">
                                  <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="realisation_date">Date </label>
                                        <input type="datetime-local" class="form-control" id="realisation_date" name="realisation_date" value="{{ date("Y-m-d H:i",strtotime($realisation->realisation_date)) }}" required>
                                    </div>
                                </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="realisation">Realisation</label>
                                            <input type="text" class="form-control" id="realisation" name="realisation" value="{{ $realisation->realisation }}" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="container-fluid">
                                <div class="row justify-content-end">
                                    <div class="col-md-12 text-right">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">retour</button>
                                        <button type="submit" class="btn btn-success">Modifier</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </form>
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

    <script>
        $(document).ready(function() {
            $('#offre-type').selectpicker({
                liveSearch:false,
                noneResultsText:'Aucun résultat correspondant'
            });
            $('#objectif-type').selectpicker({
                liveSearch:false,
                noneResultsText:'Aucun résultat correspondant'
            });
        });
        $('#realisation').on('keyup', function(){
                if($(this).val())
                {
                    let value = $('#realisation').val()/{{ $offre->objectifs }} * 100;
                    $('#realisation_rate').val(value.toFixed(0));
                    $('#rest_per_objectifs').val({{ $offre->objectifs }} - $('#realisation').val());
                }else
                {
                    $('#rest_per_objectifs').val(0);
                }
            });
    </script>
@endsection
