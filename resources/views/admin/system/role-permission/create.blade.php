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
                                        <h4 class="card-title m-0">Nouveau rôle</h4>
                                        <a href="{{route('system-role-permission')}}" class="btn btn-primary"><i class="ri-arrow-left-fill"></i> Retour</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="iq-card-body">
                            <form action="{{ route('system-role-permission.store') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="form-group col-sm-12">
                                        <label for="rolename">Nom du rôle</label>
                                        <input type="text" class="form-control" name="rolename" id="rolename" value="{{ old('rolename') }}" />
                                    </div>
                                    <div class="form-group col-sm-12">
                                        <label for="roledesc">Description du rôle</label>
                                        <textarea type="text" class="form-control" name="roledesc" id="roledesc" value="{{ old('roledesc') }}"></textarea>
                                    </div>

                                    <div class="col-sm-12 permissions">
                                        <label for="Access" class="col-form-label">Access et permission</label>
                                        <div class="accordion" id="Access">
                                            @foreach($cats as $cat)
                                                <div class="iq-card shadow-none m-0">
                                                    <div class="iq-card-header d-flex" id="_{{$cat->link}}">
                                                        <div class="row w-100 align-items-center justify-content-between">
                                                            <div class="col-auto">
                                                                <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#_{{$cat->link}}" aria-expanded="true" aria-controls="_{{$cat->link}}">
                                                                    {{$cat->title}}
                                                                </button>
                                                            </div>
                                                            <div class="col-auto">
                                                                <div class="form-group form-check m-0">
                                                                    <input type="hidden" name="access[{{$cat->link}}]" value="0" id="access_{{$cat->link}}">
                                                                    <input type="checkbox" class="form-check-input" value="1" name="access[{{$cat->link}}]" id="access_{{$cat->link}}">
                                                                    <label class="form-check-label" for="access_{{$cat->link}}">Accés</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div id="_{{$cat->link}}" class="collapse" aria-labelledby="_{{$cat->link}}" data-parent="#_{{$cat->link}}">
                                                        <div class="iq-card-body">
                                                            <table class="table table-striped table-bordered m-0" role="grid">
                                                                <thead>
                                                                <tr class="text-center">
                                                                    <th>Module</th>
                                                                    <th>Lire</th>
                                                                    <th>Ajouter</th>
                                                                    <th>Modifier</th>
                                                                    <th>Supprimer</th>
                                                                    <th>Accéss</th>
                                                                </tr>
                                                                </thead>
                                                                <tbody>
                                                                @foreach ($subcats as $subcat)
                                                                    @if($subcat->categories_id == $cat->id)
                                                                        <tr class="text-center">
                                                                            <td>{{$subcat->title}}</td>
                                                                            <td class="text-center">
                                                                                <input type="hidden" value="0" name="permissions[{{$subcat->link}}][can_read]">
                                                                                <input type="checkbox" value="1" id="permissions_{{$cat->link}}_canread_{{$subcat->link}}" name="permissions[{{$subcat->link}}][can_read]">
                                                                            </td>

                                                                            <td class="text-center">
                                                                                <input type="hidden" value="0" name="permissions[{{$subcat->link}}][can_create]">
                                                                                <input type="checkbox" value="1" id="permissions_{{$cat->link}}_cancreate_{{$subcat->link}}" name="permissions[{{$subcat->link}}][can_create]">
                                                                            </td>

                                                                            <td class="text-center">
                                                                                <input type="hidden" value="0" name="permissions[{{$subcat->link}}][can_update]">
                                                                                <input type="checkbox" value="1" id="permissions_{{$cat->link}}_canupdate_{{$subcat->link}}" name="permissions[{{$subcat->link}}][can_update]">
                                                                            </td>

                                                                            <td class="text-center">
                                                                                <input type="hidden" value="0" name="permissions[{{$subcat->link}}][can_delete]">
                                                                                <input type="checkbox" value="1" id="permissions_{{$cat->link}}_candelete_{{$subcat->link}}" name="permissions[{{$subcat->link}}][can_delete]">
                                                                            </td>

                                                                            <td class="text-center">
                                                                                <input type="hidden" value="0" name="permissions[{{$subcat->link}}][access]">
                                                                                <input type="checkbox" value="1" id="permissions_{{$cat->link}}_access_{{$subcat->link}}" name="permissions[{{$subcat->link}}][access]">
                                                                            </td>
                                                                        </tr>
                                                                    @endif
                                                                @endforeach
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 d-flex flex-row justify-content-end">
                                        <a href="{{route('system-role-permission')}}" class="btn mr-2 btn-danger">Annuler</a>
                                        <button type="submit" class="btn btn-success">Ajouter</button>
                                    </div>
                                </div>
                            </form>
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

        .bootstrap-select .dropdown-menu li.active small{
            color: #6c757d !important;
        }
    </style>

    <script>
        $(document).ready(function(){

            /* let checkboxesAccess = $("input[type=checkbox][id^=access_]").map(function (e) {
              console.log("Id: " + $(this).attr("id") + " Value: " + $(this).val());
            });

            let checkboxesPermissions = $("input[type=checkbox][id^=permissions_]").map(function (e) {
              console.log("Id: " + $(this).attr("id") + " Value: " + $(this).val());
            }); */

            $('input[type=checkbox][id^=access_]').on('change',function(){
                access = $(this).attr('id').split("_")[1];
                $('input[type=checkbox][id^=permissions_'+access+']').prop('checked', this.checked);
            });

            $('input[type=checkbox][id^=permissions_]').on('change',function(){
                $permissions = $(this).attr('id').split("_");
                if($permissions[2] == "access"){
                    $('input[type=checkbox][id^=permissions_'+$permissions[1]+'_canread_'+$permissions[3]+']').prop('checked', this.checked);
                    $('input[type=checkbox][id^=permissions_'+$permissions[1]+'_cancreate_'+$permissions[3]+']').prop('checked', this.checked);
                    $('input[type=checkbox][id^=permissions_'+$permissions[1]+'_canupdate_'+$permissions[3]+']').prop('checked', this.checked);
                    $('input[type=checkbox][id^=permissions_'+$permissions[1]+'_candelete_'+$permissions[3]+']').prop('checked', this.checked);
                }
            });



            /* console.log(checkboxesAccess);
            console.log(checkboxesPermissions); */
        })
    </script>
@endsection
