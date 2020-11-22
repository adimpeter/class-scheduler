@extends('layouts.app')

@section('content')

<section>
    <div class="row margin-none">
        @include('snipps.notify')
        <div class="col-md-12 margin-vertical-md " id="notify">
            
        </div>
        <div class="col-md-6 offset-md-3">
            <form action="{{ route('course.store') }}" method="post">
                @csrf()
                <div class="form-group">
                    <label for="coursecode">Course Code</label>
                    <select name="course_code" id="coursecode" class="select2 form-control">
                        @foreach($courses as $course)
                            <option value="{{ $course->course_code }}">{{ $course->course_code }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="level">Level</label>
                    <select name="level_id" id="level" class="select2 form-control">
                        <option >-- select level --</option>
                        @foreach($levels as $level)
                            <option value="{{ $level->id }}">{{ $level->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="course">Course Name</label>
                    <input type="text" class="form-control" name="name" id="course">
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
        <div class="col-md-6 offset-md-3">
            <h3>Last 10 Additions</h3>
            <table class="table table-striped">
                <tr>
                    <th>Course Code</th>
                    <th>Course name</th>
                    <th>Level</th>
                </tr>
                @foreach($courses as $course)
                    <tr>
                        <td>
                            <strong>{{ $course->course_code }}</strong>
                        </td>
                        <td>
                            {{ $course->name }}
                        </td>
                        <td>
                            {{ $course->level->name ?? 'N/A' }}
                        </td>
                    </tr>
                @endforeach 
            </table>
        </div>
    </div>
</section>

@endsection