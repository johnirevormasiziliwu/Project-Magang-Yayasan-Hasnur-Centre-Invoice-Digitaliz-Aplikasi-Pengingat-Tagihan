<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        @include('includes.meta')

        <title>{{ config('app.name', 'Digitaliz') }}</title>

        @include('includes.styles')
        @stack('after-styles')
    </head>

    <body>
        <div id="app">
            @include('includes.navbar')

            <div class="container-fluid">
                <div class="row">
                    @include('includes.sidebar')
                    
                    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                        @yield('content')
                    </main>

                </div>
            </div>
        </div>

        @stack('modal-section')
        @include('includes.scripts')
        @stack('after-scripts')
    </body>

</html>