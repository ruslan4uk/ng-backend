
{{-- Frontend main page layout --}}

<!doctype html>
<html>
  <head>
    <base href="/" />
    <meta charset="utf-8"/>
    <title>@yield('title') - EG </title>
    <meta http-equiv="X-UA-Compatible" content="IE=Edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta name="theme-color" content="#fff"/>
    <meta name="format-detection" content="telephone=no"/>
    {{-- CSRF token --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" media="all" href="{{ asset('/css/app.css') }}"/>
  </head>
  <body>
    <!-- BEGIN content -->
    <div class="app" id="app">

        @yield('content')
                
        {{-- Footer include --}}
        @include('partials/footer')
        
    </div>
    <!-- END content -->

    <!-- BEGIN scripts -->
    <script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.7.1/js/all.js" integrity="sha384-eVEQC9zshBn0rFj4+TU78eNA19HMNigMviK/PU/FFjLXqa/GKPgX58rvt5Z8PLs7" crossorigin="anonymous"></script>
    <!-- END scripts -->

  </body>
</html>
