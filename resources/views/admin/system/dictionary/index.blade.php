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
            </div>
            <div class="col-sm-12">
                <div class="row">
                    <div class="col-lg-3 col-md-4">
                        <div class="iq-card">
                            <div class="iq-card-header d-flex justify-content-between">
                                <div class="iq-header-title">
                                    <h4 class="card-title">Menu</h4>
                                </div>
                            </div>
                            <div class="iq-card-body">
                                <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                    <a class="nav-link dictionary-link active" id="v-pills-currencies-tab" data-toggle="pill" href="#v-pills-currencies" role="tab" aria-controls="v-pills-currencies" aria-selected="true">---</a>
                                    <div class="border-top my-1"></div>
                                    <a class="nav-link dictionary-link" id="v-pills-thirdsCategories-tab" data-toggle="pill" href="#v-pills-thirdsCategories" role="tab" aria-controls="v-pills-thirdsCategories" aria-selected="false">---</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-9 col-md-8">
                        <div class="tab-content mt-0" id="v-pills-tabContent">
                            <div class="tab-pane fade show active" id="v-pills-currencies" role="tabpanel" aria-labelledby="v-pills-currencies-tab">

                            </div>
                            <div class="tab-pane fade" id="v-pills-thirdsCategories" role="tabpanel" aria-labelledby="v-pills-thirdsCategories-tab">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {

        });

    </script>

@endsection
