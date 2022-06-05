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
                                            <h4 class="card-title m-0">Liste des rôles</h4>
                                            @can('create')
                                            <a href="{{route('system-role-permission.create')}}" class="btn btn-success"><i class="ri-add-line"></i> Ajouter</a>
                                            @endcan
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="iq-card-body">
                                <div class="table-responsive table-sm">
                                    <table id="roles-permission-table" class="table table-striped table-bordered mt-4" role="grid" aria-describedby="user-list-page-info">
                                        <thead>
                                        <tr class="text-center">
                                            <th>ID</th>
                                            <th>Nom</th>
                                            <th>Description</th>
                                            <th>Créer</th>
                                            <th>Modifier</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($rolesList as $key => $value)
                                            <tr class="text-center">
                                                <td>{{$key+1}}</td>
                                                <td>{{$value['name']}}</td>
                                                <td>{{($value['description'] == null)?'--':$value['description']}}</td>
                                                <td>{{$value['created_at']}}</td>
                                                <td>{{$value['updated_at']}}</td>
                                                <td>
                                                    <div class="flex align-items-center list-user-action">
                                                        @can('update')
                                                        <a data-toggle="tooltip" data-placement="top" title="Modifier" href="{{route('system-role-permission.edit',[$value->id])}}"><i class="ri-pencil-line"></i></a>
                                                        @endcan
                                                        @can('delete')
                                                        <span data-toggle="modal" data-target="#role{{$value['id']}}">
                                                            <a data-toggle="tooltip" data-placement="top" title="Supprimer" href="#"><i class="ri-delete-bin-line"></i></a>
                                                            </span>
                                                        @endcan
                                                            <div class="modal fade" id="role{{$value['id']}}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                                <div class="modal-dialog">
                                                                    <form method="POST" action="{{route('system-role-permission.destroy',[$value->id])}}">
                                                                        @csrf
                                                                        @method('delete')
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title" id="staticBackdropLabel">Supprimer rôle</h5>
                                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                    <span aria-hidden="true">&times;</span>
                                                                                </button>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                Vous êtes sûr de vouloir supprimer le rôle {{$value['name']}}
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button type="button" class="btn btn-primary" data-dismiss="modal">Annuler</button>
                                                                                <button type="submit" class="btn btn-danger">Confirmer</button>
                                                                            </div>
                                                                        </div>
                                                                    </form>
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

    </style>
    <script>
        $(document).ready(function() {
            $('#roles-permission-table').DataTable({
                "columnDefs": [{
                    "targets": [0, 5]
                    , "orderable": false
                }]
                , language: {
                    url: 'https://cdn.datatables.net/plug-ins/1.11.3/i18n/fr_fr.json'
                }
            });
        });

    </script>
@endsection
