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
                                        <h4 class="card-title m-0">Liste des rapports</h4>
                                        <div class="d-flex flex-row">
                                            <form action="{{ route('DownloadExcel') }}" method="post" id="submitFormExcel" enctype="multipart/form-data" class="was-validated">
                                                @csrf
                                                @method('post')
                                                <input type="hidden" name="reportExcel" id="reportExcel" value="">
                                                @can('create')
                                                <button type="button"  class="btn btn-success" id="submitExcel">Download rapport</button>                                                    
                                                @endcan
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="iq-card-body">
                            <div class="container">
                                <div class="row justify-content-center">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="departement" class="form-label">Département</label>
                                            <select class="form-control" aria-label="departement" id="departement">
                                                <option value="">Tous</option>
                                                <option value="Département techniques">Département techniques</option>
                                                <option value="Département Commerciale">Département Commerciale	</option>
                                              </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="date" class="form-label">Date</label>
                                            <select class="form-control" aria-label="date" id="date">
                                                <option value="">Tous</option>
                                                @foreach ($dates as $date)
                                                <option value="{{ $date[0]['objectif_date'] }}">{{ $date[0]['objectif_date'] }}</option>
                                                @endforeach
                                              </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="type_objectifs" class="form-label">Type d'objectifs</label>
                                            <select class="form-control" aria-label="type_objectifs" id="type_objectifs">
                                                <option value="">Tous</option>
                                                @foreach ($types as $type)
                                                <option value="{{ $type->name }}">{{ $type->name }}</option>
                                                @endforeach
                                              </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="container">
                                <div class="table-responsive table-sm">
                                    <table id="report-table" class="table table-striped table-bordered mt-4" role="grid" aria-describedby="user-list-page-info">
                                        <thead>
                                        <tr class="text-center">
                                            <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input class="form-check-input" type="checkbox" value="" id="checkall"></th>
                                            <th>ID</th>
                                            <th>Departement</th>
                                            <th>Offre</th>
                                            <th>Date</th>
                                            <th>type d'objectif</th>
                                            <th>Objectif</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($offrelist as $list)
                                            <tr class="text-center">
                                            <td><input class="form-check-input checkBoxClass" type="checkbox" value="{{ $list->id }}" name="list_offres[]"></td>
                                            <td>{{ $list->id }}</td>
                                            <td>{{ $list->departement->name }}</td>
                                            <td>{{ $list->OffreType?$list->OffreType->name:$list->CommercialOffre->name }}</td>
                                            <td>{{ $list->objectif_date }}</td>
                                            <td>{{ $list->ObjectifType?$list->ObjectifType->name:'**' }}</td>
                                            <td>{{ $list->objectifs }}</td>
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
           let report = $('#report-table').DataTable({
                "columnDefs": [{
                    "targets": 6,
                    "orderable": false
                }],
                language: {
                    url: 'https://cdn.datatables.net/plug-ins/1.11.3/i18n/fr_fr.json'
                }
            });
            $('#departement').selectpicker({
            liveSearch:true,
            noneResultsText:'Aucun résultat correspondant'
            }).on('change',function(){
                report.column(2).search($(this).val()).draw()
            });
            $('#type_objectifs').selectpicker({
            liveSearch:true,
            noneResultsText:'Aucun résultat correspondant'
            }).on('change',function(){
                report.column(5).search($(this).val()).draw()
            });
            $('#date').selectpicker({
            liveSearch:true,
            noneResultsText:'Aucun résultat correspondant'
            }).on('change',function(){
                report.column(4).search($(this).val()).draw()
            });
            report.on('change','#checkall',function(){
            var rows = report.rows({ 'search': 'applied' }).nodes();
           $('input[name="list_offres[]"]', rows).prop('checked', this.checked);
           });

           $("#submitExcel").on('click', function () {
            var arrayOfValues = [];
            arrayOfValues =  $('.checkBoxClass:checked').map(function(_, el) {
            return $(el).val();
            }).get();
        if (arrayOfValues.length === 0) {
            $.toast({
            heading: 'Information',
            text: 'Veillez sélectionner des offres',
            icon: 'info',
            loader: true,
            loaderBg: '#9EC600',
            position: 'top-right'
            })
        }else {
            $('#reportExcel').val(arrayOfValues);
            $('#submitFormExcel').submit();
        }
        });
        });
    </script>
@endsection
