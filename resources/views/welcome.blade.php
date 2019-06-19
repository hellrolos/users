<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
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
                        <h1 class="panel-title">Bienvenido {{ Auth()->User()->username}}</h1>
                    </div>
                    <div class="panel-body">
                        <form method="POST" action="{{ route('logout') }}">
                            {{ csrf_field() }}
                            <button class="btn btn-danger btn-block">Cerrar Sesión</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>