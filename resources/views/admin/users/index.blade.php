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
                                        <h4 class="card-title m-0">Liste des utilisateurs</h4>
                                        <div class="d-flex flex-row">
                                            <a href="#" class="btn mx-1 btn-success" data-toggle="modal" data-target="#adduser">Ajouter</a>
                                            <div class="modal fade" id="adduser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-lg" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Ajouter utilisateur</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <form action="{{ route('users-accounts.store') }}" method="post" enctype="multipart/form-data" class="was-validated">
                                                            @csrf
                                                            @method('post')
                                                        <div class="modal-body">
                                                            <div class="container">
                                                                <div class="row">
                                                                    <div class="col-md-4">
                                                                        <div class="form-group">
                                                                            <label for="firstName">Nom</label>
                                                                            <input type="text" class="form-control" id="firstName" name="firstName" aria-describedby="firstName" value="{{old('firstName')}}">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <div class="form-group">
                                                                            <label for="lastName">Prénom</label>
                                                                            <input type="text" class="form-control" id="lastName" name="lastName" aria-describedby="firstName" value="{{ old('lastName') }}">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <div class="form-group">
                                                                            <label for="email">E-mail</label>
                                                                            <input type="email" class="form-control" id="email" name="email" aria-describedby="email" value="{{ old('email') }}">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-4">
                                                                        <div class="form-group">
                                                                            <label for="phone">téléphone</label>
                                                                            <input type="text" class="form-control" id="phone"  name="phone" aria-describedby="phone" value="{{ old('phone') }}">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <div class="form-group">
                                                                            <label for="gender">Genre</label>
                                                                            <select class="form-control" id="gender" name="gender">
                                                                                <option value="Male">Homme</option>
                                                                                <option value="Female">Femme</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <div class="form-group">
                                                                            <label for="birthday">Date de naissance</label>
                                                                            <input type="date" class="form-control" id="birthday" name="birthday" aria-describedby="birthday" value="{{ old('birthday') }}">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-4">
                                                                        <div class="form-group">
                                                                            <label for="address">Adresse</label>
                                                                            <input type="text" class="form-control" id="address" name="address" aria-describedby="address" value="{{ old('address') }}">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <div class="form-group">
                                                                            <label for="city">Ville</label>
                                                                            <input type="text" class="form-control" id="city" name="city" aria-describedby="city" value="{{ old('city') }}">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <div class="form-group">
                                                                            <label for="region">Region</label>
                                                                            <input type="text" class="form-control" id="region" name="region" aria-describedby="region" value="{{ old('region') }}">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-4">
                                                                        <div class="form-group">
                                                                            <label for="zipcode">Code postal</label>
                                                                            <input type="text" class="form-control" id="zipcode" name="zipcode" aria-describedby="zipcode" value="{{ old('zipcode') }}">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                                                            <button type="submit" class="btn btn-success">Valider</button>
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
                                <table id="users-table" class="table table-sm table-striped table-bordered mt-4" role="grid" aria-describedby="user-list-page-info">
                                    <thead>
                                    <tr class="text-center">
                                        <th>ID</th>
                                        <th>Nom</th>
                                        <th>prénom</th>
                                        <th>Email</th>
                                        <th>Téléphone</th>
                                        <th>Genre</th>
                                        <th>Date naissance</th>
                                        <th>Adresse</th>
                                        <th>City</th>
                                        <th>Region</th>
                                        <th>Code postal</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($users as $user)
                                    <tr>
                                        <td class="text-center">{{ $user->id }}</td>
                                        <td class="text-center">{{ $user->first_name }}</td>
                                        <td class="text-center">{{ $user->last_name }}</td>
                                        <td class="text-center">{{ $user->email }}</td>
                                        <td class="text-center">{{ $user->phone }}</td>
                                        <td class="text-center">{{ $user->gender }}</td>
                                        <td class="text-center">{{ $user->birthday }}</td>
                                        <td class="text-center">{{ $user->address_line }}</td>
                                        <td class="text-center">{{ $user->city }}</td>
                                        <td class="text-center">{{ $user->region }}</td>
                                        <td class="text-center">{{ $user->zip_code }}</td>
                                        <td>
                                            <div class="flex align-items-center list-user-action">
                                                <span data-toggle="modal" data-target="#edit{{$user->id}}">
                                                <a data-toggle="tooltip" data-placement="top" title="Modifier" href="#"><i class="ri-pencil-line"></i></a>
                                                </span>
                                                <div class="modal fade" id="edit{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-lg" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Modifier utilisateur</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <form action="{{ route('users-accounts.update',[$user->id]) }}" method="post">
                                                                @csrf
                                                                @method('put')
                                                            <div class="modal-body">
                                                                <div class="container">
                                                                    <div class="row">
                                                                        <div class="col-md-4">
                                                                            <div class="form-group">
                                                                                <label for="firstName">Nom</label>
                                                                                <input type="text" class="form-control" id="firstName" name="firstName" aria-describedby="firstName" value="{{ $user->first_name }}">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <div class="form-group">
                                                                                <label for="lastName">Prénom</label>
                                                                                <input type="text" class="form-control" id="lastName" name="lastName" aria-describedby="firstName" value="{{ $user->last_name }}">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <div class="form-group">
                                                                                <label for="email">E-mail</label>
                                                                                <input type="email" class="form-control" id="email" name="email" aria-describedby="email" value="{{ $user->email }}">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-4">
                                                                            <div class="form-group">
                                                                                <label for="phone">téléphone</label>
                                                                                <input type="text" class="form-control" id="phone"  name="phone" aria-describedby="phone" value="{{ $user->phone }}">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <div class="form-group">
                                                                                <label for="gender">Genre</label>
                                                                                <select class="form-control" id="gender" name="gender">
                                                                                    <option value="Male" @if($user->gender == 'Male') selected @endif>Homme</option>
                                                                                    <option value="Female" @if($user->gender == 'Female') selected @endif>Femme</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <div class="form-group">
                                                                                <label for="birthday">Date de naissance</label>
                                                                                <input type="date" class="form-control" id="birthday" name="birthday" aria-describedby="birthday" value="{{ $user->birthday }}">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-4">
                                                                            <div class="form-group">
                                                                                <label for="address">Adresse</label>
                                                                                <input type="text" class="form-control" id="address" name="address" aria-describedby="address" value="{{ $user->address_line }}">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <div class="form-group">
                                                                                <label for="city">Ville</label>
                                                                                <input type="text" class="form-control" id="city" name="city" aria-describedby="city" value="{{ $user->city }}">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <div class="form-group">
                                                                                <label for="region">Region</label>
                                                                                <input type="text" class="form-control" id="region" name="region" aria-describedby="region" value="{{ $user->region }}">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-4">
                                                                            <div class="form-group">
                                                                                <label for="zipcode">Code postal</label>
                                                                                <input type="text" class="form-control" id="zipcode" name="zipcode" aria-describedby="zipcode" value="{{ $user->zip_code }}">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                                                                <button type="submit" class="btn btn-success">Modifier</button>
                                                            </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                                <span data-toggle="modal" data-target="#delete{{$user->id}}">
                                                    <a data-toggle="tooltip" data-placement="top" title="Supprimer" href="#"><i class="ri-delete-bin-line"></i></a>
                                                  </span>
                                                    <div class="modal fade" id="delete{{$user->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <form method="post" action="{{ route('users-accounts.destroy',[$user->id]) }}">
                                                                @csrf
                                                                @method('delete')
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalLabel">Supprimer classe
                                                                        </h5>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        voulez vous vraiment supprimer cet utilisateur ?
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn mr-2 btn-success" data-dismiss="modal">Annuler</button>
                                                                        <button type="submit" class="btn btn-danger">Supprimer</button>
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
            $('#users-table').DataTable({
                "columnDefs": [{
                    "targets": 9,
                    "orderable": false
                }],
                language: {
                    url: 'https://cdn.datatables.net/plug-ins/1.11.3/i18n/fr_fr.json'
                }
            });
            $('#gender').selectpicker({
                liveSearch:true,
                noneResultsText:'Aucun résultat correspondant'
            });
        });
    </script>
@endsection
