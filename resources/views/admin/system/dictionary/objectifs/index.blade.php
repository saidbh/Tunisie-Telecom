<div class="iq-card">
    <div class="iq-card-header d-flex justify-content-between">
        <div class="iq-header-title w-100">
            <div class="row">
                <div class="col-md-12 d-flex flex-row align-items-center justify-content-between">
                    <h4 class="card-title m-0">Objectifs</h4>
                    <div class="d-flex flex-row">
                        <a data-toggle="modal" href="#" data-target="#addobjectifs" class="btn btn-success"><i class="ri-add-line"></i>Ajouter</a>
                        <div class="modal fade" id="addobjectifs" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Ajouter Objectifs</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form action="{{ route('system-dictionary.store') }}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" class="form-control" id="action" name="action" value="objectifs">
                                    <div class="modal-body">
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="exampleFormControlInput1">Objectifs</label>
                                                        <input type="text" class="form-control" id="objectifs" name="objectifs" required>
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
            <table id="Objectifs-table" class="table table-striped table-bordered mt-4" role="grid" aria-describedby="user-list-page-info">
                <thead>
                <tr class="text-center">
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Description</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($objectifs as $objectif)
                    <tr class="text-center">
                        <td>{{ $objectif->id }}</td>
                        <td>{{ $objectif->name }}</td>
                        <td>{{ $objectif->description }}</td>
                        <td>
                            <div class="flex align-items-center list-user-action">
                              <span data-toggle="modal" data-target="#editobjectif{{$objectif->id}}">
                                <a data-toggle="tooltip" data-placement="top" title="Modifier" href="#"><i class="ri-pencil-line"></i></a>
                              </span>
                                <div class="modal fade" id="editobjectif{{$objectif->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Modifier Objectifs</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form action="{{ route('system-dictionary.update',$objectif->id) }}" method="post" enctype="multipart/form-data">
                                                @csrf
                                                @method('put')
                                                <input type="hidden" class="form-control" id="action" name="action" value="objectifs">
                                                <div class="modal-body">
                                                    <div class="container">
                                                        <div class="row">
                                                            <div class="col-md-12 text-left">
                                                                <div class="form-group">
                                                                    <label for="exampleFormControlInput1">Objectifs</label>
                                                                    <input type="text" class="form-control" id="objectifs" name="objectifs" value="{{ $objectif->name }}" required>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12 text-left">
                                                                <div class="form-group">
                                                                    <label for="description">Description</label>
                                                                    <textarea class="form-control" id="description" name="description" rows="3">{{ $objectif->description }}</textarea>
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
                                <span data-toggle="modal" data-target="#deleteobjectif{{$objectif->id}}">
                                <a data-toggle="tooltip" data-placement="top" title="Supprimer" href="#"><i class="ri-delete-bin-line"></i></a>
                              </span>
                                <div class="modal fade" id="deleteobjectif{{$objectif->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Supprimer Objectif</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form action="{{ route('system-dictionary.destroy',$objectif->id) }}" method="post" >
                                                @csrf
                                                @method('delete')
                                                <input type="hidden" class="form-control" id="action" name="action" value="objectifs">
                                                <div class="modal-body">
                                                Voulez vous vraiment supprimer cet objectif ?
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
        $('#Objectifs-table').DataTable({
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
