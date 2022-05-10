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
                    <form action="{{route('system-assign-role.update',[$contact->id])}}" method="post">
                        @csrf
                        @method('put')
                        <div class="iq-card">
                            <div class="iq-card-header d-flex justify-content-between">
                                <div class="iq-header-title w-100">
                                    <div class="row">
                                        <div class="col-md-12 d-flex flex-row align-items-center justify-content-between">
                                            <h4 class="card-title m-0">Nouveau utilisateur</h4>
                                            <a href="{{route('system-assign-role')}}" class="btn btn-primary"><i class="ri-arrow-left-fill"></i> Retour</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="iq-card-body">
                                <h5 class="mb-3">Utilisateur</h5>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <input type="hidden" name="assignUser" class="form-control mb-0" id="assignUser" value="{{ $contact->id }}">
                                        <input type="text" class="form-control mb-0" value="{{ $contact->first_name }} {{ $contact->last_name }}" readonly>
                                    </div>
                                </div>
                                <h5 class="mb-3">Sécurité</h5>
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label class="control-label" for="assignRole">Assigné Rôle</label>
                                        <select class="form-control" title="Séléctionner un rôle..." id="assignRole" name="assignRole">
                                            @foreach($roles as $role)
                                                <option value="{{$role->id}}" >{{$role->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label class="control-label" for="password">Mot de passe</label>
                                        <input type="password" name="password" class="form-control mb-0" id="password" value="{{ old('password') }}">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label class="control-label" for="confPassword">Confirmer mot de passe</label>
                                        <input type="password" name="confPassword" class="form-control mb-0" id="confPassword" value="{{ old('confPassword') }}">
                                    </div>
                                </div>
                                <h5 class="mb-3">Compte</h5>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-check form-check-inline">
                                            <input type="hidden" name="activated" value="0">
                                            <input class="form-check-input" type="checkbox" name="activated" id="activated" value="1" @if($user->activated ==1 ) checked @endif>
                                            <label class="form-check-label" for="activated">Activé</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input type="hidden" name="blocked" value="0">
                                            <input class="form-check-input" type="checkbox" name="blocked" id="blocked" value="1" @if($user->blocked == 1) checked @endif>
                                            <label class="form-check-label" for="blocked">Bloqué</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 d-flex flex-row justify-content-end">
                                        <a href="{{route('system-assign-role')}}" class="btn mr-2 btn-danger">Annuler</a>
                                        <button type="submit" class="btn btn-success">Ajouter</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
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

        .bootstrap-select .dropdown-menu li.active small{
            color: #6c757d !important;
        }
    </style>

    <script>
        $(document).ready(function() {

            $('#userEmployee').selectpicker({
                liveSearch:true,
                noneResultsText:'Aucun résultat correspondant'
            }).on('change',function() {
                $('#userClient').val('');
                //alert($(this).data('email'))
                $('#email').val($(this).find('option:selected').data('email'));
                //createEmail($(this).find('option:selected').text().replace(/\s+/g, ".").toLowerCase());
            });
            $('#assignRole').selectpicker({
                liveSearch:true,
                noneResultsText:'Aucun résultat correspondant'
            });
            $('#assignUser').selectpicker({
                liveSearch:true,
                noneResultsText:'Aucun résultat correspondant'
            });
        });

    </script>
@endsection
