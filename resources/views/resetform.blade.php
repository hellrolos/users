<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <link rel="stylesheet" href={{ asset('css/app.css')}} />
</head>
<body>
    <div class="container">
        <hr>
        @if(session()->has('alert'))
            <div class="alert alert-info">{{ session('alert') }}</div>
        @endif
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h1 class="panel-title">Introduce la nueva contraseña</h1>
                    </div>
                    <div class="panel-body">
                        <div class="container">
                            <form method="POST" action="{{ route('resetpass') }}">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <input class="form-control" type="hidden" name="token" value="{{ $data['token'] }}"/>
                                    {!! $errors->first('token', '<span class="help-block">:message</span>') !!}
                                </div>
                                <div class="form-group">
                                    <label for="email">Correo</label>
                                    <input class="form-control" type="email" id="email" name="email" value="{{ $data['email'] }}" disabled />
                                    {!! $errors->first('email', '<span class="help-block">:message</span>') !!}
                                </div>
                                <div class="form-group">
                                    <label for="time">Tiempo creado del Token</label>
                                    <input class="form-control" type="text" id="time" name="time" value="{{ $data['time'] }}" disabled />
                                    {!! $errors->first('time', '<span class="help-block">:message</span>') !!}
                                </div>
                                <div class="form-group">
                                    <label for="pass1">Nueva Contraseña</label>
                                    <input class="form-control" type="password" name="pass1" placeholder="Introduce tu nueva contraseña" required />
                                    {!! $errors->first('pass1', '<span class="help-block">:message</span>') !!}
                                </div>
                                <div class="form-group">
                                    <label for="reppass">Repetir Nueva Contraseña</label>
                                    <input class="form-control" type="password" name="reppass" placeholder="Repite tu nueva contraseña" required />
                                    {!! $errors->first('reppass', '<span class="help-block">:message</span>') !!}
                                </div>
                                <button class="btn btn-primary btn-block">Actucalizar contraseña</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>