<!DOCTYPE html>
<html>

<head>
    @include('partial._head')
    @yield('stylesheet')
    @include('partial._stylesheet')
</head>

<body class="hold-transition sidebar-mini">
    @include('sweetalert::alert')

    @include('partial._navbar')
    <div class="container-fluid mb-5">
        <section class="content mt-3">
            @if (Auth::user())
            <div class="row m-3">
                <div class="col-md-3 ">
                    @include('partial._sidebar')
                </div>
                <div class="col-md-9">
                    @yield('content')
                </div>
            </div>
            @else
            <div class="col-md-9 m-auto">
                @yield('content')
            </div>
            @endif
        </section>
    </div>
    <br><br><br><br><br>
    @include('partial._footer')

    @include('partial._scripts')
    @stack('scripts')
</body>

</html>