@extends('layouts.app')

@section('content')


<section>
    <div class="row margin-none">
        @include('snipps.notify')
        <div class="col-md-12">
            <h3>All Schedules</h3>
            <table class="table table-striped table-sm">
                <tr>
                    <th>Course Code</th>
                    <th>Course</th>
                    <th>Level</th>
                    <th>Hall</th>
                    <th>Lecturer</th>
                    <th>Duration ( Hours )</th>
                    <th>Occurence</th>
                    <th></th>
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
                            {!! $schedule->course->level->name ?? '<span class="text text-danger">N/A</span>' !!}
                        </td>
                        <td>
                            {!! $schedule->course->lecturer->lastname  ?? '<span class="text text-danger">N/A</span>' !!} {!! $schedule->course->lecturer->firstname  ?? '<span class="text text-danger">N/A</span>' !!}
                        </td>
                        <td>
                            {!! $schedule->duration ?? '<span class="text text-danger">N/A</span>' !!}
                        </td>
                        <td>
                            {{ $schedule->occurence }}
                        </td>
                        
                        <td>
                            <div class="row">
                                <div class="col-6">
                                    <a href="{{ route('schedule.edit' , ['schedule'=> $schedule]) }}" class="btn btn-sm btn-primary btn-block">Edit</a>
                                </div>
                                <div class="col-6">
                                    <form action="{{ route('schedule.delete', ['schedule' => $schedule]) }}" class="delete-schedule-form-{{ $schedule->id }}" method="post">
                                        @method('DELETE')
                                        @csrf()
                                        <button class="btn btn-danger btn-sm btn-block delete-schedule" data-toggle="modal" data-target="#confirmActionModal">Delete</button>
                                    </form>
                                </div>
                            </div>    
                        </td>
                        
                    </tr>
                @endforeach 
                
            </table>
        </div>

{{--
        <div class="col-md-12 margin-vertical-md">
            {{ $timetable->links() }}    
        </div>
--}}
    </div>
</section>

@include('snipps.confirm-action')

@endsection