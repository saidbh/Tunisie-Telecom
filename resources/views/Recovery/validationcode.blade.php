@extends('layouts.app')
@section('content')
<div class="container-fluid" style="margin-top: 15%">
    <form action="{{ route('newpwd') }}" method="get" class="was-validated">
        @csrf
    <div class="row justify-content-center">
        <div class="col-md-4 text-center">
            <label for="pwd_recovery">Verification du code</label>
            <input type="hidden" id="user_recovery" name="user_recovery" value="{{ $user->id }}" required>
            <input type="text" class="form-control" id="pwd_recovery" name="pwd_recovery" required>
            <br>
            <button type="submit" class="btn btn-success">Valider</button>
        </div>
    </div>
</form>
</div>
@endsection