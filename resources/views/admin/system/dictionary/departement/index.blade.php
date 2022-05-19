<div class="iq-card">
    <div class="iq-card-header d-flex justify-content-between">
        <div class="iq-header-title w-100">
            <div class="row">
                <div class="col-md-12 d-flex flex-row align-items-center justify-content-between">
                    <h4 class="card-title m-0">Département</h4>
                    <div class="d-flex flex-row">
                        <a data-toggle="modal" href="#" data-target="#adddepartement" class="btn btn-success"><i class="ri-add-line"></i>Ajouter</a>
                        <div class="modal fade" id="adddepartement" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Ajouter Département</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form action="{{ route('system-dictionary.store') }}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" class="form-control" id="action" name="action" value="departement">
                                        <div class="modal-body">
                                            <div class="container">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="departement">Département</label>
                                                            <input type="text" class="form-control" id="departement" name="departement" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="description">Description</label>
                                                            <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                                                        </div>
                                                    </div>
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
            <table id="dep-table" class="table table-striped table-bordered mt-4" role="grid" aria-describedby="user-list-page-info">
                <thead>
                <tr class="text-center">
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Description</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($departement as $dep)
                    <tr class="text-center">
                        <td>{{ $dep->id }}</td>
                        <td>{{ $dep->name }}</td>
                        <td>{{ $dep->description }}</td>
                        <td>
                            <div class="flex align-items-center list-user-action">
                              <span data-toggle="modal" data-target="#editdep{{$dep->id}}">
                                <a data-toggle="tooltip" data-placement="top" title="Modifier" href="#"><i class="ri-pencil-line"></i></a>
                              </span>
                                <div class="modal fade" id="editdep{{$dep->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Modifier Departement</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form action="{{ route('system-dictionary.update',$dep->id) }}" method="post" enctype="multipart/form-data">
                                                @csrf
                                                @method('put')
                                                <input type="hidden" class="form-control" id="action" name="action" value="departement">
                                                <div class="modal-body">
                                                    <div class="container">
                                                        <div class="row">
                                                            <div class="col-md-12 text-left">
                                                                <div class="form-group">
                                                                    <label for="exampleFormControlInput1">Objectifs</label>
                                                                    <input type="text" class="form-control" id="objectifs" name="departement" value="{{ $dep->name }}" required>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12 text-left">
                                                                <div class="form-group">
                                                                    <label for="description">Description</label>
                                                                    <textarea class="form-control" id="description" name="description" rows="3">{{ $dep->description }}</textarea>
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
                                <span data-toggle="modal" data-target="#deletedep{{$dep->id}}">
                                <a data-toggle="tooltip" data-placement="top" title="Supprimer" href="#"><i class="ri-delete-bin-line"></i></a>
                              </span>
                                <div class="modal fade" id="deletedep{{$dep->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Supprimer departement</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form action="{{ route('system-dictionary.destroy',$dep->id) }}" method="post" >
                                                @csrf
                                                @method('delete')
                                                <input type="hidden" class="form-control" id="action" name="action" value="departement">
                                                <div class="modal-body">
                                                    Voulez vous vraiment supprimer cet departement ?
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
        $('#dep-table').DataTable({
            "columnDefs": [{
                "targets": [0, 3]
                , "orderable": false
            }]
            , 'language': {
                'url': 'https://cdn.datatables.net/plug-ins/1.11.3/i18n/fr_fr.json'
            }
        });
    });

</script>
