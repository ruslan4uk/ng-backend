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

        {{-- Header include --}}
        @include('partials.navigation')

        <section class="lk-panel mb-5">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-md-3">
                        <ul class="nav flex-column">
                            <li class="nav-item {{ (\Request::route()->getName() == 'admin.guide.index') ? 'active' : '' }}">
                                <a class="nav-link" href="{{ route('admin.guide.index') }}">Гиды</a>
                            </li>
                            <li class="nav-item {{ (\Request::route()->getName() == 'admin.services.index') ? 'active' : '' }}">
                                <a class="nav-link" href="{{ route('admin.services.index') }}">Услуги гидов</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Комментарии</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('admin.article.index') }}">Статьи</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-12 col-md-9">
                        @yield('content')
                    </div>
                </div>
            </div>
        </section>
                
        {{-- Footer include --}}
        @include('partials/footer')
        
    </div>
    <!-- END content -->

    <!-- BEGIN scripts -->
    <script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.7.1/js/all.js" integrity="sha384-eVEQC9zshBn0rFj4+TU78eNA19HMNigMviK/PU/FFjLXqa/GKPgX58rvt5Z8PLs7" crossorigin="anonymous"></script>
    <!-- END scripts -->

    {{-- CKEditor 4 --}}
    {{-- <script src="//cdn.ckeditor.com/4.6.2/standard/ckeditor.js"></script>
    <script>
        var options = {
            filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
            filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token={{csrf_token()}}',
            filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
            filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token={{csrf_token()}}'
        };
    </script>
    <script>
        CKEDITOR.replace('ckeditor', options);
    </script> --}}

    {{-- CKEditor 5 --}}
    <script src="https://cdn.ckeditor.com/ckeditor5/11.2.0/classic/ckeditor.js"></script>
    <script>
        ClassicEditor
            .create( document.querySelector( '#ckeditor' ), {
                ckfinder: {
                    // Upload the images to the server using the CKFinder QuickUpload command.
                    uploadUrl: "{{ route('admin.article.upload') }}"
                }
            } )
            .catch( error => {
                console.error( error );
            } );
    </script>


  </body>
</html>
