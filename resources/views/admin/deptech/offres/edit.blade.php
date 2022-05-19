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
                                        <h4 class="card-title m-0">Edit offre</h4>
                                        <div class="d-flex flex-row">
                                            {{--                                            <a href="#" class="btn mx-1 btn-success">PDF</a>--}}
                                            {{--                                            <a href="#" class="btn btn-success">Excel</a>--}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <form action="{{ route('technical-offres-list.update',$OneOffre->id) }}" method="post" enctype="multipart/form-data" class="was-validated">
                            @csrf
                            @method('put')
                        <div class="iq-card-body">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="offre-type">Liste des offres</label>
                                            <select class="form-control" id="offre-type" name="offre_type" required>
                                                <option></option>
                                                @foreach($offres as $offre)
                                                    <option value="{{ $offre->id }}" @if($OneOffre->OffreType->id == $offre->id) selected @endif>{{ $offre->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="objectif-type">Type objectifs</label>
                                            <select class="form-control" id="objectif-type" name="objectif_type" required>
                                                <option></option>
                                                @foreach($objectiftypes as $objectiftype)
                                                    <option value="{{ $objectiftype->id }}" @if($OneOffre->ObjectifType->id == $objectiftype->id) selected @endif>{{ $objectiftype->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="start_date">Date debut</label>
                                            <input type="date" class="form-control" id="start_date" name="start_date" value="{{ date('Y-m-d', strtotime($OneOffre->date_from)) }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="end_date">Date fin</label>
                                            <input type="date" class="form-control" id="end_date" name="end_date" value="{{ date('Y-m-d', strtotime($OneOffre->date_to)) }}" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="objectifs">Objectifs</label>
                                            <input type="text" class="form-control" id="objectifs" name="objectifs" value="{{ $OneOffre->DataOffre->objectifs }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="realisation">Realisation</label>
                                            <input type="text" class="form-control" id="realisation" name="realisation" value="{{ $OneOffre->DataOffre->realisation }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="realisation_rate">Taux de realisation</label>
                                            <input type="text" class="form-control" id="realisation_rate" name="realisation_rate" value="{{ $OneOffre->DataOffre->realisation_rate }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="rest_per_objectifs">Reste par objectifs</label>
                                            <input type="text" class="form-control" id="rest_per_objectifs" name="rest_per_objectifs" value="{{ $OneOffre->DataOffre->rest_per_objectifs }}" required>
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
            $('#offre-table').DataTable({
                "columnDefs": [{
                    "targets": 9,
                    "orderable": false
                }],
                language: {
                    url: 'https://cdn.datatables.net/plug-ins/1.11.3/i18n/fr_fr.json'
                }
            });
            $('#offre-type').selectpicker({
                liveSearch:false,
                noneResultsText:'Aucun résultat correspondant'
            });
            $('#objectif-type').selectpicker({
                liveSearch:false,
                noneResultsText:'Aucun résultat correspondant'
            });
        });
    </script>
@endsection
