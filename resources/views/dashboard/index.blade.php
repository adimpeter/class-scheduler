@extends('layouts.app')

@section('content')

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

@include('snipps.confirm-action')

@endsection