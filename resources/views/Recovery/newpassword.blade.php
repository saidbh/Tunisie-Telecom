@extends('layouts.app')
@section('content')
<div class="container-fluid" style="margin-top: 15%">
    <div class="row justify-content-center">
        <div class="col-sm-4 text-center">
            @if (Session::has('error'))
                <div class="alert alert-danger">{{ Session::get('error') }}</div>
            @endif
            @if (Session::has('success'))
                <div class="alert alert-success">{{ Session::get('success') }}</div>
            @endif
        </div>
    </div>
    <form action="{{ route('new_password') }}" method="GET" class="was-validated">
        @csrf
    <div class="row justify-content-center">
        <div class="col-md-4 text-left">
            <input type="hidden" class="form-control" id="user" name="user" value="{{ $user }}" required>
            <label for="password">Nouveau mot de passe</label>
            <input type="password" class="form-control" id="password" data-rule-password="true" name="password" value="{{ old('password') }}" required>
            <label for="confirmed">Confirmer mot de passe</label>
            <input type="password" class="form-control" id="confirmed" data-rule-confirmed="true" data-rule-equalTo="#password" name="confirmed" required>
            <small id="CheckPasswordMatch" class="form-text text-muted text-left"></small>
            <br><br>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-1 align-self-end">
            <button type="submit" class="btn btn-success">Valider</button>
        </div>
    </div>
</form>
</div>
@endsection