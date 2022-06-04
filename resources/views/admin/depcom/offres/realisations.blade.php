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
                                        <h4 class="card-title m-0">Liste des realisations pour {{ $offre->CommercialOffre->name  }} objectif ( {{ $offre->ObjectifType->name }} )</h4>
                                        <div class="d-flex flex-row">
                                            {{--                                            <a href="#" class="btn mx-1 btn-success">PDF</a>--}}
                                            {{--                                            <a href="#" class="btn btn-success">Excel</a>--}}
                                            <a href="#" class="btn ml-1 btn-success" data-toggle="modal" data-target="#offres-managment">Upload fichies</a>
                                            <div class="modal fade" id="offres-managment" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                                                <div class="modal-dialog modal-lg" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLongTitle">Ajouter Realisations</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <form action="{{ route('realisation-commercial.store') }}" method="post" enctype="multipart/form-data" class="was-validated">
                                                            @csrf
                                                            <div class="modal-body">
                                                                <div class="container-fluid">
                                                                    <input type="hidden" class="form-control" id="offres_id" name="offres_id" value="{{ $offre->id  }}" required>
                                                                    <input type="hidden" class="form-control" id="offresCom_id" name="offresCom_id" value="{{ $offre->CommercialOffre->id  }}" required>
                                                                    <input type="hidden" class="form-control" id="objectifs" name="objectifs" value="{{ $offre->objectifs  }}" required>
                                                                    <input type="hidden" class="form-control" id="type" name="type" value="{{ $offre->ObjectifType->name  }}" required>
                                                                    @foreach($realisations as $realisation)
                                                                    @if($loop->last)
                                                                    <input type="hidden" class="form-control" id="last_realisation" name="last_realisation" value="{{ $realisation->id  }}" required>
                                                                    @endif
                                                                    @endforeach
                                                                    <div class="row">
                                                                        <div class="col-md-4">
                                                                            <div class="form-group">
                                                                                <label for="realisation_date">Date</label>
                                                                                <input type="datetime-local" class="form-control" id="realisation_date" name="date"  required>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-8">
                                                                            <div class="form-group">
                                                                                <label for="sub_offre">Listes des offres</label>
                                                                                <select class="form-control" id="sub_offre" name="sub_offre[]" multiple aria-label="multiple select example" required>
                                                                                    <option></option>
                                                                                    @foreach ($suboffres as $sub)
                                                                                        <option value="{{ $sub->name }}">{{ $sub->name }}</option>
                                                                                    @endforeach
                                                                                  </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <div class="form-group">
                                                                                <label for="files">Upload fichiers</label>
                                                                                @if ($offre->CommercialOffre->id == 8)
                                                                                <input type="file" class="form-control" id="files" name="files[]" multiple required>
                                                                                 @else
                                                                                <input type="file" class="form-control" id="files" name="files" required>
                                                                                @endif
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                                                                <button type="submit" class="btn btn-success">Upload</button>
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
                                        <th>Date</th>
                                        <th>Realisation</th>
                                        <th>Taux de realisation</th>
                                        <th>Reste par objectif</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($realisations as $realisation)
                                        <tr class="text-center">
                                            <td>{{ $realisation->id }}</td>
                                            <td>{{ $realisation->realisation_date }}</td>
                                            <td>{{ $realisation->realisation }}</td>
                                            <td>{{ $realisation->realisation_rate }} %</td>
                                            <td>{{ $realisation->rest_per_objectifs }}</td>
                                            <td>
                                                <div class="flex align-items-center list-user-action">
{{--                                                  <span data-toggle="modal" data-target="#editoffres{{ $realisation->id }}">--}}
{{--                                                    <a data-toggle="tooltip" data-placement="top" title="Modifier" href="{{ route('realisation-offres-list.edit',$realisation->id) }}"><i class="ri-pencil-line"></i></a>--}}
{{--                                                  </span>--}}
                                                    <div class="modal fade" id="#" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                                                        <div class="modal-dialog modal-xl" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLongTitle">Gestion des offres</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <form action="" method="post" enctype="multipart/form-data" class="was-validated">
                                                                    @csrf
                                                                    @method('put')
                                                                    <div class="modal-body">
                                                                        <div class="container-fluid">
                                                                            <div class="row">
                                                                                <div class="col-md-3">
                                                                                    <div class="form-group">
                                                                                        <label for="realisation_date">Date</label>
                                                                                        <input type="datetime-local" class="form-control" id="realisation_date" name="realisation_date" value="{{ $realisation->realisation_date }}" required>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-3">
                                                                                    <div class="form-group">
                                                                                        <label for="realisation{{ $realisation->id }}">Realisation</label>
                                                                                        <input type="text" class="form-control" id="realisation{{ $realisation->id }}" name="realisation" value="{{ $realisation->realisation }}" required>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-3">
                                                                                    <div class="form-group">
                                                                                        <label for="realisation_rate{{ $realisation->id }}">Taux de realisation</label>
                                                                                        <input type="text" class="form-control" id="realisation_rate{{ $realisation->id }}" name="realisation_rate" value="{{ $realisation->realisation_rate }}" readonly required>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-3">
                                                                                    <div class="form-group">
                                                                                        <label for="rest_per_objectifs{{ $realisation->id }}">Reste par objectifs</label>
                                                                                        <input type="text" class="form-control" id="rest_per_objectifs{{ $realisation->id }}" name="rest_per_objectifs" value="{{ $realisation->rest_per_objectifs }}" readonly required>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                                                                        <button type="submit" class="btn btn-success">Modifier</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @if($loop->last)
                                                    <span data-toggle="modal" data-target="#deleteoffres{{ $realisation->id }}">
                                                    <a data-toggle="tooltip" data-placement="top" title="Supprimer" href="#"><i class="ri-delete-bin-line"></i></a>
                                                  </span>
                                                  @endif
                                                    <div class="modal fade" id="deleteoffres{{ $realisation->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">Supprimer Realisation</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <form action="{{ route('realisation-offres-list.destroy',$realisation->id) }}" method="post">
                                                                    @csrf
                                                                    @method('delete')
                                                                    <div class="modal-body">
                                                                        Vouler vou vraiment supprimer cette realisation ?
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
            let month = {{ date("m",strtotime($offre->objectif_date)) }};
            if(month<10)
            {
                months = '0'+month;
            }else{
                month = months;
            }
            $('#realisation_date').attr("min",new Date().getFullYear()+'-'+ months +'-01'+'T00:00:00');
            let day = "";
            let inpairmonths = [1,3,5,7,9,11]
            if($.inArray(month, inpairmonths) !== -1)
            {
                day = "31";
            }else
            {
                day = "30";
            }
            $('#realisation_date').attr("max",new Date().getFullYear()+'-'+ months + '-'+day+'T00:00:00');
            $('#sub_offre').selectpicker({
                liveSearch:true,
                noneResultsText:'Aucun résultat correspondant'
            });
            $('#offre-type').selectpicker({
                liveSearch:false,
                noneResultsText:'Aucun résultat correspondant'
            });
            $('#objectif-type').selectpicker({
                liveSearch:false,
                noneResultsText:'Aucun résultat correspondant'
            });
            $('#realisation').on('keyup', function(){
                if($(this).val())
                {
                    let value = $('#realisation').val() / {{ $offre->objectifs }} * 100;
                    $('#realisation_rate').val(value.toFixed(0));
                    $('#rest_per_objectifs').val({{ $offre->objectifs }} - $('#realisation').val());
                }else
                {
                    $('#rest_per_objectifs').val(0);
                }
            });
        });
    </script>
@endsection
