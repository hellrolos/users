@extends('layouts/ingreso')
@section('title','Recuperar Contraseña')
@section('titulo','Recuperar Contraseña')
@section('content')
<h4>Introduce la siguiente información</h4>
{{-- <h5>Los campos son obligatorios</h5> --}}
<form method="POST" action="{{ route('resetlink') }}">
    {{ csrf_field() }}
    <div class="form-group">
        <label for="correo">Correo Institucional</label>
        <input class="form-control" type="email" name="correo" placeholder="Introduce tu Correo Institucional" required>
        {!! $errors->first('correo', '<span class="help-block">:message</span>') !!}
    </div>
    <div class="form-group">
        <label for="nocontrol">No. de Control o RFC</label>
        <input class="form-control" type="text" name="nocontrol" placeholder="Introduce tu No. de control o RFC"
            required>
        {!! $errors->first('nocontrol', '<span class="help-block">:message</span>') !!}
    </div>
    <button class="btn btn-primary btn-block">Enviar correo</button>
</form>
</div>
@endsection
