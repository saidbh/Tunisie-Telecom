<div class="iq-card">
    <div class="iq-card-header d-flex justify-content-between">
        <div class="iq-header-title w-100">
            <div class="row">
                <div class="col-md-12 d-flex flex-row align-items-center justify-content-between">
                    <h4 class="card-title m-0">Les sous offres commerciales</h4>
                    <div class="d-flex flex-row">
                        <a data-toggle="modal" href="#" data-target="#addsuboffresCom" class="btn btn-success"><i class="ri-add-line"></i>Ajouter</a>
                        <div class="modal fade" id="addsuboffresCom" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Ajouter Sous-offre</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form action="{{ route('system-dictionary.store') }}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" class="form-control" id="action" name="action" value="suboffrescom">
                                        <div class="modal-body">
                                            <div class="container">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="offres">Offre</label>
                                                            <select class="form-control" aria-label="Default select example" id="Comoffres" name="Comoffres">
                                                                <option></option>
                                                                @foreach($offreCom as $offre)
                                                                <option value="{{ $offre->id }}">{{ $offre->name }}</option>
                                                                    @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="suboffres">Sous Offre</label>
                                                            <input type="text" class="form-control" id="suboffres" name="suboffres" required>
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
            <table id="suboffresCom-table" class="table table-striped table-bordered mt-4" role="grid" aria-describedby="user-list-page-info">
                <thead>
                <tr class="text-center">
                    <th>ID</th>
                    <th>Offre</th>
                    <th>Sous Offre</th>
                    <th>Description</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($suboffreCom as $offreC)
                    <tr class="text-center">
                        <td>{{ $offreC->id }}</td>
                        <td>{{ $offreC->offre->name }}</td>
                        <td>{{ $offreC->name }}</td>
                        <td>{{ $offreC->description }}</td>
                        <td>
                            <div class="flex align-items-center list-user-action">
                              <span data-toggle="modal" data-target="#editsuboffresCom{{$offreC->id}}">
                                <a data-toggle="tooltip" data-placement="top" title="Modifier" href="#"><i class="ri-pencil-line"></i></a>
                              </span>
                                <div class="modal fade" id="editsuboffresCom{{$offreC->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Modifier Sous Offres</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form action="{{ route('system-dictionary.update',$offreC->id) }}" method="post" enctype="multipart/form-data">
                                                @csrf
                                                @method('put')
                                                <input type="hidden" class="form-control" id="action" name="action" value="suboffrescom">
                                                <div class="modal-body">
                                                    <div class="container">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label for="offres">Offre</label>
                                                                    <select class="form-control" aria-label="Default select example" id="" name="Comoffres" required>
                                                                        <option></option>
                                                                        @foreach($offreCom as $offre)
                                                                            <option value="{{ $offre->id }}" @if($offreC->offre->id == $offre->id) selected @endif>{{ $offre->name }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12 text-left">
                                                                <div class="form-group">
                                                                    <label for="suboffres">Sous Offres</label>
                                                                    <input type="text" class="form-control" id="suboffres" name="suboffres" value="{{ $offreC->name }}" required>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12 text-left">
                                                                <div class="form-group">
                                                                    <label for="description">Description</label>
                                                                    <textarea class="form-control" id="description" name="description" rows="3">{{ $offreC->description }}</textarea>
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
                                <span data-toggle="modal" data-target="#deletesuboffresCom{{$offreC->id}}">
                                <a data-toggle="tooltip" data-placement="top" title="Supprimer" href="#"><i class="ri-delete-bin-line"></i></a>
                              </span>
                                <div class="modal fade" id="deletesuboffresCom{{$offreC->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Supprimer Sous offre</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form action="{{ route('system-dictionary.destroy',$offreC->id) }}" method="post" >
                                                @csrf
                                                @method('delete')
                                                <input type="hidden" class="form-control" id="action" name="action" value="suboffrescom">
                                                <div class="modal-body">
                                                    Voulez vous vraiment supprimer ce sous offre ?
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
        $('#suboffresCom-table').DataTable({
            "columnDefs": [{
                "targets": [0, 4]
                , "orderable": false
            }]
            , 'language': {
                'url': 'https://cdn.datatables.net/plug-ins/1.11.3/i18n/fr_fr.json'
            }
        });
        $('#Comoffres').selectpicker({
            liveSearch:false,
            noneResultsText:'Aucun résultat correspondant'
        });
    });

</script>
