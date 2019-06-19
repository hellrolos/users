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
                        <h1 class="panel-title">Introduce la siguiente información</h1>
                        <h4>Los campos son obligatorios</h4>
                    </div>
                    <div class="panel-body">
                        <div class="container">
                            <form method="POST" action="{{ route('resetlink') }}">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="correo">Correo Institucional</label>
                                    <input class="form-control" type="email" name="correo" placeholder="Introduce tu Correo Institucional" required>
                                    {!! $errors->first('correo', '<span class="help-block">:message</span>') !!}
                                </div>
                                <div class="form-group">
                                    <label for="nocontrol">No. de Control o RFC</label>
                                    <input class="form-control" type="text" name="nocontrol" placeholder="Introduce tu No. de control o RFC" required>
                                    {!! $errors->first('nocontrol', '<span class="help-block">:message</span>') !!}
                                </div>
                                <button class="btn btn-primary btn-block">Enviar correo</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>