@extends('layouts.app')

@section('content')

<section>
    <div class="row margin-none">
        @include('snipps.notify')
        <div class="col-md-6 offset-md-3">
            <form action="{{ route('schedule.store') }}" method="post">
                @csrf()

                <div class="row">
                    <div class="form-group col-12">
                        <label for="course">Course</label>
                        <select name="course_id" id="course" class="select2 form-control">
                            @foreach($courses as $course)
                                <option value="{{ $course->id }}">{{ $course->course_code }} {{ $course->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group col-12">
                        <label for="hall">Hall</label>
                        <select name="hall_id" id="hall" class="select2 form-control">
                            @foreach($halls as $hall)
                                <option value="{{ $hall->id }}">{{ $hall->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-12">
                        <label for="lecturer">lecturer</label>
                        <select name="lecturer_id" id="lecturer" class="select2 form-control">
                            @foreach($lecturers as $lecturer)
                                <option value="{{ $lecturer->id }}">{{ $lecturer->lastname }} {{ $lecturer->firstname }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group col-12">
                        <label for="date">Date</label>
                        <!-- Datepicker as text field -->         
                        <div class="input-group date" data-date-format="dd.mm.yyyy">
                            <input  type="text" class="form-control" placeholder="dd.mm.yyyy"name="date" id="date">
                            <div class="input-group-addon" >
                            <span class="glyphicon glyphicon-th"></span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group col-6">
                        <label for="from">From</label>
                        <input type="text" class="form-control timepicker" autocomplete="off" name="from" id="from">
                    </div>
                    <div class="form-group col-6">
                        <label for="to">To</label>
                        <input type="text" class="form-control timepicker" autocomplete="off" name="to" id="to">
                    </div>
                </div>
                



                <div class="form-group">
                    <button class="btn btn-primary">Add</button>
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
                    <th>Start</th>
                    <th>End</th>
                </tr>
                @foreach($schedules as $schedule)
                    <tr>
                        <td>
                            <em>{{ $schedule->course->course_code }}</em>
                        </td>
                        <td>
                            {{ $schedule->course->name }}
                        </td>
                        <td>
                            {{ $schedule->lecturer->lastname }} {{ $schedule->lecturer->firstname }}
                        </td>
                        <td>
                            {{ $schedule->hall->name }}
                        </td>
                        <td>
                            {{ $schedule->date }}
                        </td>
                        <td>
                            {{ $schedule->start_time }}
                        </td>
                        <td>
                            {{ $schedule->end_time }}
                        </td>
                    </tr>
                @endforeach 
            </table>
        </div>
    </div>
</section>

@endsection