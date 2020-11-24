@extends('layouts.app')

@section('content')

<section>
    <div class="row margin-none">
        @include('snipps.notify')
    {{--
        <div class="col-md-12">
            <div class="btn-group" role="group" aria-label="BtnGroup">
                <a type="button" href="{{ route('schedule.dashboard', ['scheduleType' => 'today']) }}" class="btn btn-primary">Today</a>
                <a type="button" href="{{ route('schedule.dashboard', ['scheduleType' => 'tomorrow']) }}" class="btn btn-primary">Tomorrow</a>
                <a type="button" href="{{ route('schedule.dashboard', ['scheduleType' => 'all']) }}" class="btn btn-primary">All</a>
            </div>
        </div>
        --}}
        <div class="col-md-12">
            <span class="float-right"><a href="{{ route('schedule.export') }}" class="btn btn-success">Download Excel</a></span>
            <h3>{{ ucwords($scheduleType)}} Schedules</h3>
            {{--<table class="table table-striped table-sm">
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
                
            </table> --}}
        </div>
{{--
        <div class="col-md-12 margin-vertical-md">
            {{ $schedules->links() }}    
        </div> --}}
    </div> 
</section>

@include('snipps.confirm-action')

@endsection