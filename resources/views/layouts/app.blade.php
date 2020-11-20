<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">

        @livewireStyles

        <!-- Scripts -->
        <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.7.3/dist/alpine.js" defer></script>
        <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>        
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>        <script src="{{ asset('js/script.js') }}"></script>

        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">

        <link rel="stylesheet" href="{{ asset('css/bootstrap-datepicker3.standalone.css') }}">

        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>

        <script src="{{ asset('js/bootstrap-datepicker.min.js') }}"></script>

    </head>
    <body>
        <div class="row padding-none margin-none">
            <div class="col-md-3 padding-none margin-none">
                <div id="side-bar">
                    <header>
                        <div class="logo">
                            CLASS SCHEDULER
                        </div>
                    </header>

                    @include('includes.menu')
                </div>
            </div>
            <div class="col-md-9 padding-none margin-none">
                <div id="main">
                    <header>

                        <div class="action-btns">
                                <a class="btn btn-primary" href="{{ route('logout') }}" onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}</a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>
                        </div>
                    </header>

                    @yield('content')
                </div>
            </div>
        </div>

        <script>
             $(".select2").select2({
                 'tags' : true
             });

             //$('input.timepicker').timepicker({});
             $('.date').datepicker({
                format: 'yyyy/mm/dd',
                startDate: '0d',
                todayHighlight: 'true'
             });
            //  $('.timepicker').timepicker({
            //     timeFormat: 'h:mm p',
            //     interval: 60,
            //     // minTime: '10',
            //     // maxTime: '6:00pm',
            //     // defaultTime: '11',
            //     // startTime: '10:00',
            //     dynamic: false,
            //     dropdown: true,
            //     scrollbar: true
            // });
        </script>
    </body>
</html>
