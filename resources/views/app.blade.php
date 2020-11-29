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
                                <a href="{{ route('register') }}" class="btn btn-outline-primary">Register</a>
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

                        <section>
                        <div class="row margin-none">
                @include('snipps.notify')

                <div class="col-md-12">
                    <span class="float-right"><a href="{{ route('schedule.export') }}" class="btn btn-success">Download Timetable</a></span>
                    <h3>Timetable</h3>
                    <table class="table table-striped table-sm table-bordered">
                        <tr>
                            <th>Date / Time</th>
                            <th>9AM - 10AM</th>
                            <th>10AM - 11AM</th>
                            <th>11AM - 12PM</th>
                            <th>12PM - 1PM</th>
                            <th>1PM - 2PM</th>
                            <th>2PM - 3PM</th>
                            <th>3PM - 4PM</th>
                            <th>4PM - 5PM</th>
                        </tr>
                        @foreach($timetable as $key => $values)
                            <tr>
                                <td>
                                    {{ $key }}
                                </td>
                                @foreach($values as $item)

                                    <td>
                                        {{ $item->course_code }}
                                    </td>

                                @endforeach
                            </tr>
                            {{--
                            <tr class="{{ ($data->break_eq == 'yes')? 'dark-bg' : '' }}">
                                <td>
                                    <em>{!! $data->course_code ?? '<span class="text text-danger">N/A</span>' !!}</em>
                                </td>
                                <td>
                                    {!! $data->course ?? '<span class="text text-danger">N/A</span>' !!}
                                </td>
                                <td>
                                    {!! $data->level ?? '<span class="text text-danger">N/A</span>' !!}
                                </td>
                                <td>
                                    {!! $data->lecturer  ?? '<span class="text text-danger">N/A</span>' !!}
                                </td>
                                <td>
                                    {!! $data->hall ?? '<span class="text text-danger">N/A</span>' !!}
                                </td>
                                <td>
                                    {{ $data->from }}
                                </td>
                                <td>
                                    {!! $data->to ?? '<span class="text text-danger">N/A</span>' !!}
                                </td>
                                <td>
                                    {!! $data->date ?? '<span class="text text-danger">N/A</span>' !!}
                                </td>
                                
                            </tr>
                            --}}
                        @endforeach 
                        
                    </table>
                </div>

            </div>
                        </section>
                    </div>
                </div>
            </div>   
        </div>

    <section>
        <div class="container">
            
        </div>
    </section>

    @include('snipps.confirm-action')
 </body>
</html>
