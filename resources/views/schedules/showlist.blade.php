@extends('layouts.app')

@section('content')


<section>
    <div class="row margin-none">
        @include('snipps.notify')
        <div class="col-md-12">
            <h3>All Schedules</h3>
            <table class="table table-striped table-sm">
                <tr>
                    <th>Subject Code</th>
                    <th>Subject Name</th>
                    <th>Level</th>
                    <th>Lecturer</th>
                    <th>Venue</th>
                    <th>Starts</th>
                    <th>Ends</th>
                    <th>Date</th>
                    <th></th>
                </tr>
                @foreach($timetable as $data)
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
                        
                        <td>
                        @if($data->break_eq == 'no')
                            <div class="row">
                                <div class="col-6">
                                    <a href="{{ route('schedule.edit' , ['schedule'=> $data->schedule]) }}" class="btn btn-sm btn-primary btn-block">Edit</a>
                                </div>
                                <div class="col-6">
                                    <form action="{{ route('schedule.delete', ['schedule' => $data->schedule]) }}" class="delete-schedule-form-{{ $data->schedule->id }}" method="post">
                                        @method('DELETE')
                                        @csrf()
                                        <button class="btn btn-danger btn-sm btn-block delete-schedule" data-toggle="modal" data-target="#confirmActionModal">Delete</button>
                                    </form>
                                </div>
                            </div>
                        @endif
                            
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