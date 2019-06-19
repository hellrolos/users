<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="css/app.css" />
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
                        <h1 class="panel-title">Acceso</h1>
                    </div>
                    <div class="panel-body">
                        <form method="POST" action="{{ route('login')}}">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="email">Correo</label>
                                <input class="form-control" type="email" value="{{ old('email') }}" name="email" placeholder="Introduce tu Correo">
                                {!! $errors->first('email', '<span class="help-block">:message</span>') !!}
                            </div>
                            <div class="form-group">
                                <label for="password">Contraseña</label>
                                <input class="form-control" type="password" name="password" placeholder="Introduce tu Contraseña">
                                {!! $errors->first('password', '<span class="help-block">:message</span>') !!}
                            </div>
                            <button class="btn btn-primary btn-block">Acceder</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>