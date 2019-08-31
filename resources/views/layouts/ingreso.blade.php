<!DOCTYPE html>
<html>
@include('layouts.head')

<body class="bg-dark">
    <div class="container">
        @if(session()->has('alert'))
        <div class="alert alert-info">{{ session('alert') }}</div>
        @endif
        <div class="row justify-content-center">
            <div class="col-12 col-sm-10 col-lg-12 col-xl-10 mx-auto">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body">
                        <div class="row align-content-center">
                            <div class="d-none d-md-flex col-md-4 bg-image">
                            </div>
                            <h2>@yield('titulo')</h2>

                            <div class="card-body">
                                @yield('content')

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
