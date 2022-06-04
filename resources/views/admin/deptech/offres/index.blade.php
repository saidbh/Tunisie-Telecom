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
                                        <h4 class="card-title m-0">Liste des offres Techniques</h4>
                                        <div class="d-flex flex-row">
{{--                                            <a href="#" class="btn mx-1 btn-success">PDF</a>--}}
{{--                                            <a href="#" class="btn btn-success">Excel</a>--}}
                                            <a href="#" class="btn ml-1 btn-success" data-toggle="modal" data-target="#offres-managment">Ajouter</a>
                                            <div class="modal fade" id="offres-managment" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                                                <div class="modal-dialog modal-xl" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLongTitle">Gestion des offres</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <form action="{{ route('technical-offres-list.store') }}" method="post" enctype="multipart/form-data" class="was-validated">
                                                            @csrf
                                                        <div class="modal-body">
                                                            <div class="container-fluid">
                                                                <div class="row">
                                                                    <div class="col-md-3">
                                                                        <div class="form-group">
                                                                            <label for="offre-type">Liste des offres</label>
                                                                            <select class="form-control" id="offre-type" name="offre_type" required>
                                                                                <option></option>
                                                                                @foreach($offres as $offre)
                                                                                <option value="{{ $offre->id }}">{{ $offre->name }}</option>
                                                                                    @endforeach
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <div class="form-group">
                                                                            <label for="objectif-type">Type objectifs</label>
                                                                            <select class="form-control" id="objectif-type" name="objectif_type" required>
                                                                                <option value=" " selected>Pas de type</option>
                                                                                @foreach($objectiftypes as $objectiftype)
                                                                                    <option value="{{ $objectiftype->id }}">{{ $objectiftype->name }}</option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <div class="form-group">
                                                                            <label for="objectif_date">Date </label>
                                                                            <input type="month" class="form-control" id="objectif_date" name="objectif_date" required>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <div class="form-group">
                                                                            <label for="objectifs">Objectifs</label>
                                                                            <input type="text" class="form-control" id="objectifs" name="objectifs" required>
                                                                        </div>
                                                                    </div>
{{--                                                                     <div class="col-md-3">
                                                                        <div class="form-group">
                                                                            <label for="end_date">Date fin</label>
                                                                            <input type="date" class="form-control" id="end_date" name="end_date" required>
                                                                        </div>
                                                                    </div> --}}
                                                                </div>
                                                                <div class="row">
{{--                                                                     <div class="col-md-3">
                                                                        <div class="form-group">
                                                                            <label for="realisation">Realisation</label>
                                                                            <input type="text" class="form-control" id="realisation" name="realisation" required>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <div class="form-group">
                                                                            <label for="realisation_rate">Taux de realisation</label>
                                                                            <input type="text" class="form-control" id="realisation_rate" name="realisation_rate" required>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <div class="form-group">
                                                                            <label for="rest_per_objectifs">Reste par objectifs</label>
                                                                            <input type="text" class="form-control" id="rest_per_objectifs" name="rest_per_objectifs" required>
                                                                        </div>
                                                                    </div> --}}
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                                                            <button type="submit" class="btn btn-success">Ajouter</button>
                                                        </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="iq-card-body">
                            <div class="table-responsive table-sm">
                                <table id="offre-table" class="table table-striped table-bordered mt-4" role="grid" aria-describedby="user-list-page-info">
                                    <thead>
                                    <tr class="text-center">
                                        <th>ID</th>
                                        <th>Offre</th>
                                        <th>Date</th>
                                        <th>type d'objectif</th>
                                        <th>Objectif</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($offrelist as $offres)
                                    <tr class="text-center">
                                        <td>{{ $offres->id }}</td>
                                        <td>{{ $offres->OffreType->name }}</td>
                                        <td>{{ $offres->objectif_date }}</td>
                                        <td>{{ $offres->ObjectifType?$offres->ObjectifType->name:'--' }}</td>
                                        <td>{{ $offres->objectifs }}</td>
                                        <td>
                                            <div class="flex align-items-center list-user-action">
                                                <span data-toggle="modal" data-target="#">
                                                    <a data-toggle="tooltip" data-placement="top" title="Ajouter realisation" href="{{ route('realisation-offres-list.show',$offres->id) }}"><i class="ri-bar-chart-grouped-line"></i></a>
                                                  </span>
                                                  <span data-toggle="modal" data-target="#editoffres">
                                                    <a data-toggle="tooltip" data-placement="top" title="Modifier" href="{{ route('technical-offres-list.edit',$offres->id) }}"><i class="ri-pencil-line"></i></a>
                                                  </span>
                                                  <span data-toggle="modal" data-target="#deleteoffres{{$offres->id}}">
                                                    <a data-toggle="tooltip" data-placement="top" title="Supprimer" href="#"><i class="ri-delete-bin-line"></i></a>
                                                  </span> 
                                                <div class="modal fade" id="deleteoffres{{$offres->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Supprimer offre</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <form action="{{ route('technical-offres-list.destroy',$offres->id) }}" method="post">
                                                                @csrf
                                                                @method('delete')
                                                            <div class="modal-body">
                                                                Vouler vou vraiment supprimer cet offre ?
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                                                                <button type="submit" class="btn btn-danger">Supprimer</button>
                                                            </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                        @endforeach
                                    </tbody>
                                </table>
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

    <script>
        $(document).ready(function() {
            $('#offre-table').DataTable({
                "columnDefs": [{
                    "targets": 5,
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
