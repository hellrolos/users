@extends('layouts/ingreso')
@section('title','Login')
@section('titulo','Acceso')
@section('content')
<div class="container-fluid">
    <h4>Introduce la siguiente información</h4>
    <form class="user" method="POST" action="{{ route('login')}}">
        {{ csrf_field() }}
        <div class="form-label-group">
            <label for="email">Correo</label>
            <input class="form-control" type="email" value="{{ old('email') }}" name="email"
                placeholder="Introduce tu Correo">
            {!! $errors->first('email', '<span class="help-block">:message</span>') !!}
        </div>
        <div class="form-group">
            <label for="password">Contraseña</label>
            <input class="form-control" type="password" name="password" placeholder="Introduce tu Contraseña">
            {!! $errors->first('password', '<span class="help-block">:message</span>') !!}
        </div>
        <button class="btn btn-lg btn-primary btn-block btn-login text-uppercase my-1">Acceder</button>

    </form>
    <form method="GET" action="{{ route('passform')}}">
        <button class="btn btn-lg btn-danger btn-block btn-login text-uppercase my-1">¿Olvidaste tu contraseña?</button>
    </form>
</div>
@endsection
