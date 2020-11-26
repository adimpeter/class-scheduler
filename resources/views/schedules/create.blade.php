@extends('layouts.app')

@section('content')

<section>
    <div class="row margin-none">
        @include('snipps.notify')
        <div class="col-md-12 margin-vertical-md " id="notify">
            
        </div>
        <div class="col-md-6 offset-md-3">
            <form action="{{ route('schedule.store') }}" id="scheduleForm" method="post">
                @csrf()

                <div class="row">
                    <div class="form-group col-12">
                        <label for="courseid">Course</label>
                        <select name="course_id" id="courseid" class="select2 form-control">
                            @foreach($courses as $course)
                                <option value="{{ $course->id }}">{{ $course->course_code }} {{ $course->name }} -- {{ $course->level->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group col-12">
                        <label for="hallid">Hall</label>
                        <select name="hall_id" id="hallid" class="select2 form-control">
                            @foreach($halls as $hall)
                                <option value="{{ $hall->id }}">{{ $hall->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group col-6">
                        <label for="occurence">Occurence per week</label>
                        <input type="number" min="1" max="5" value="1" class="form-control" autocomplete="off" name="occurence" id="occurence">
                    </div>

                    <div class="form-group col-6">
                        <label for="duration">Duration ( Hours )</label>
                        <input type="number" min="1" max="3" value="3" class="form-control" autocomplete="off" name="duration" id="duration">
                    </div>
                </div>
                



                <div class="form-group">
                    <button class="btn btn-primary add-schedule">Add</button>
                </div>
            </form>
        </div>
    </div>
</section>

<section>
    <div class="row margin-none">
        <div class="col-md-12">
            <h3>Last 10 Additions</h3>
            <table class="table table-striped">
                <tr>
                    <th>Subject Code</th>
                    <th>Subject Name</th>
                    <th>Lecturer</th>
                    <th>Venue</th>
                    <th>Date</th>
                    <th>duration</th>
                </tr>
                @foreach($schedules as $schedule)
                    <tr>
                        <td>
                            <em>{!! $schedule->course->course_code  ?? '<span class="text text-danger">N/A</span>' !!}</em>
                        </td>
                        <td>
                            {!! $schedule->course->name ?? '<span class="text text-danger">N/A</span>' !!}
                        </td>
                        <td>
                            {!! $schedule->course->lecturer->lastname  ?? '<span class="text text-danger">N/A</span>' !!} {!! $schedule->course->lecturer->firstname  ?? '<span class="text text-danger">N/A</span>' !!}
                        </td>
                        <td>
                            {!! $schedule->hall->name  ?? '<span class="text text-danger">N/A</span>' !!}
                        </td>
                        <td>
                            {{ $schedule->date }}
                        </td>
                        <td>
                            {{ $schedule->duration }}
                        </td>
                    </tr>
                @endforeach 
            </table>
        </div>
    </div>
</section>

@endsection