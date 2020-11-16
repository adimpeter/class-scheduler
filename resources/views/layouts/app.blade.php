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
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
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

                    <div id="menu">
                        <div class="menu-item">
                            <a href="#">Dashboard</a>
                        </div>
                        <div class="menu-item">
                            <a href="#">Classes</a>
                            <div class="dropdown">
                                <a href="{{ route('schedule.create') }}">Create</a>
                                <a href="#">Edit</a>
                                <a href="#">Show</a>
                            </div>
                        </div>

                        <div class="menu-item">
                            <a href="#">Hall</a>
                            <div class="dropdown">
                                <a href="{{ route('hall.create') }}">Create</a>
                                <a href="#">Edit</a>
                                <a href="#">Show</a>
                            </div>
                        </div>

                        <div class="menu-item">
                            <a href="#">Course</a>
                            <div class="dropdown">
                                <a href="{{ route('course.create') }}">Create</a>
                                <a href="#">Edit</a>
                                <a href="#">Show</a>
                            </div>
                        </div>

                        <div class="menu-item">
                            <a href="#">Lecturer</a>
                            <div class="dropdown">
                                <a href="{{ route('lecturer.create') }}">Create</a>
                                <a href="#">Edit</a>
                                <a href="#">Show</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-9 padding-none margin-none">
                <div id="main">
                    <header>

                        <div class="action-btns">
                            <button class="btn btn-outline-primary">Logout</button>
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
             $('.date').datepicker();
             $('.timepicker').timepicker({
                timeFormat: 'h:mm p',
                interval: 60,
                // minTime: '10',
                // maxTime: '6:00pm',
                // defaultTime: '11',
                // startTime: '10:00',
                dynamic: false,
                dropdown: true,
                scrollbar: true
            });
        </script>
    </body>
</html>
