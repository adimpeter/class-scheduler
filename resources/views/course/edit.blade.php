@extends('layouts.app')

@section('content')

<section>
    <div class="row margin-none">
        @include('snipps.notify')
        <div class="col-md-6 offset-md-3">
            <form action="{{ route('course.update', ['course' => $course]) }}" method="post">
                @method('PATCH')
                @csrf()
                <div class="form-group">
                    <label for="coursecode">Course Code</label>
                    <select name="course_code" id="coursecode" class="select2 form-control">
                        @foreach($courses as $course_value)
                            <option value="{{ $course_value->course_code }}" {{ ($course_value->id == $course->id)? 'selected' : '' }}>{{ $course_value->course_code }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="level">Level</label>
                    <select name="level_id" id="level" class="select2 form-control">
                        @foreach($levels as $level)
                            <option value="{{ $level->id }}" {{ ($course->level_id == $level->id)? 'selected' : '' }}>{{ $level->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="course">Course Name</label>
                    <input type="text" class="form-control" name="name" id="course" value="{{ $course->name }}">
                </div>

                <div class="form-group">
                    <button class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</section>


@endsection