@extends('layouts.app')

@section('content')

<section>
    <div class="row margin-none">
        @include('snipps.notify')
        <div class="col-md-12">
            <span class="float-right"><a href="{{ route('schedule.export') }}" class="btn btn-success">Download Timetable</a></span>
            <h3>Timetable</h3>
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
                        
                    </tr>
                @endforeach 
                
            </table>
        </div>
    </div> 
</section>

@include('snipps.confirm-action')

@endsection