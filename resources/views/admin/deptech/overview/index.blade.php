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
                                        <h4 class="card-title m-0">Liste des fichies</h4>
                                        <div class="d-flex flex-row">
                                            <a href="#" class="btn ml-1 btn-success" data-toggle="modal" data-target="#uploadfiles">Upload</a>
                                            <div class="modal fade" id="uploadfiles" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
{{--                                                            <h5 class="modal-title" id="exampleModalLabel">Upload fichiers</h5>--}}
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <form action="" method="post" enctype="multipart/form-data">
                                                            @csrf
                                                            @method('put')
                                                        <div class="modal-body">
                                                            <div class="container">
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <input type="file" class="form-control" id="excel_file" required>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                                                            <button type="button" class="btn btn-success">Upload</button>
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
{{--                            <div class="table-responsive table-sm">--}}
{{--                                <table id="teacher-table" class="table table-striped table-bordered mt-4" role="grid" aria-describedby="user-list-page-info">--}}
{{--                                    <thead>--}}
{{--                                    <tr class="text-center">--}}
{{--                                        <th>ID</th>--}}
{{--                                        <th>Nom de fichier</th>--}}
{{--                                        <th>Date upload</th>--}}
{{--                                        <th>taille</th>--}}
{{--                                        <th>Type</th>--}}
{{--                                        <th>Action</th>--}}
{{--                                    </tr>--}}
{{--                                    </thead>--}}
{{--                                    <tbody>--}}
{{--                                    <tr class="text-center">--}}
{{--                                        <td>1</td>--}}
{{--                                        <td>--</td>--}}
{{--                                        <td>--</td>--}}
{{--                                        <td>--</td>--}}
{{--                                        <td>--</td>--}}
{{--                                        <td>--}}
{{--                                            <div class="flex align-items-center list-user-action">--}}
{{--                                                <a data-toggle="tooltip" data-placement="top" title="Détail" href=""><i class="ri-eye-line"></i></a>--}}
{{--                                                <a data-toggle="tooltip" data-placement="top" title="statistique" href=""><i class="ri-bar-chart-grouped-line"></i></a>--}}
{{--                                            </div>--}}
{{--                                        </td>--}}
{{--                                    </tr>--}}
{{--                                    </tbody>--}}
{{--                                </table>--}}
{{--                            </div>--}}
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
            $('#teacher-table').DataTable({
                "columnDefs": [{
                    "targets": 11,
                    "orderable": false
                }],
                language: {
                    url: 'https://cdn.datatables.net/plug-ins/1.11.3/i18n/fr_fr.json'
                }
            });
        });
    </script>
@endsection
