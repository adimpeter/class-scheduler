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

 <body class="font-sans antialiased">
        <div class="container">
            <div class="row">
                <div class="col-md-12 padding-none margin-none">
                    <div id="main">
                        <header>
                            <div class="logo">Class Scheduler</div>
                            <div class="action-btns">
                            @guest 
                                <a href="/login" class="btn btn-primary">Login</a>
                            @else 

                            <a class="btn btn-primary" href="{{ route('logout') }}" onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}</a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>

                            @endguest

                            </div>
                        </header>
                    </div>
                </div>
            </div>   
        </div>

    <section>
        <div class="container">
        <div class="row margin-none">
            @include('snipps.notify')

            <div class="col-md-12">
                <div class="btn-group" role="group" aria-label="BtnGroup">
                    <a type="button" href="{{ route('home', ['scheduleType' => 'today']) }}" class="btn btn-primary">Today</a>
                    <a type="button" href="{{ route('home', ['scheduleType' => 'tomorrow']) }}" class="btn btn-primary">Tomorrow</a>
                    <a type="button" href="{{ route('home', ['scheduleType' => 'all']) }}" class="btn btn-primary">All</a>
                </div>
            </div>
            <div class="col-md-12">
                <h3>{{ ucwords($scheduleType)}} Schedules</h3>
                <table class="table table-striped table-sm">
                    <tr>
                        <th>Subject Code</th>
                        <th>Subject Name</th>
                        <th>Lecturer</th>
                        <th>Venue</th>
                        <th>Date</th>
                        <th>Duration (Hr)</th>
                        <th>Occurence</th>
                    </tr>
                    @foreach($schedules as $schedule)
                        <tr>
                            <td>
                                <em>{!! $schedule->course->course_code ?? '<span class="text text-danger">N/A</span>' !!}</em>
                            </td>
                            <td>
                                {!! $schedule->course->name ?? '<span class="text text-danger">N/A</span>' !!}
                            </td>
                            <td>
                                {!! $schedule->lecturer->lastname  ?? '<span class="text text-danger">N/A</span>' !!} {!! $schedule->lecturer->firstname  ?? '<span class="text text-danger">N/A</span>' !!}
                            </td>
                            <td>
                                {!! $schedule->hall->name ?? '<span class="text text-danger">N/A</span>' !!}
                            </td>
                            <td>
                                {{ $schedule->date }}
                            </td>
                            <td>
                                {{ $schedule->duration }}
                            </td>
                            <td>
                                {!! $schedule->occurence() ?? '<span class="text text-danger">N/A</span>' !!}
                            </td>
                        </tr>
                    @endforeach 
                    
                </table>
            </div>

            <div class="col-md-12 margin-vertical-md">
                {{ $schedules->links() }}    
            </div>
        </div>
        </div>
    </section>

    @include('snipps.confirm-action')
 </body>
</html>
