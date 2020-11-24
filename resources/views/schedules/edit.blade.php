@extends('layouts.app')

@section('content')

<section>
    <div class="row margin-none">
        @include('snipps.notify')
        <div class="col-md-12 margin-vertical-md " id="notify">
            
        </div>
        <div class="col-md-6 offset-md-3">
            <form action="{{ route('schedule.update', ['schedule'=>$schedule]) }}" id="scheduleForm" method="post">
                @method('PATCH')
                @csrf()

                <div class="row">
                    <div class="form-group col-12">
                        <label for="courseid">Course</label>
                        <select name="course_id" id="courseid" class="select2 form-control">
                            @foreach($courses as $course)
                                <option value="{{ $course->id }}"  {{ ($schedule->course_id == $course->id)? 'selected' : '' }}>{{ $course->course_code }} {{ $course->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group col-12">
                        <label for="hallid">Hall</label>
                        <select name="hall_id" id="hallid" class="select2 form-control">
                            @foreach($halls as $hall)
                                <option value="{{ $hall->id }}" {{ ($schedule->hall_id == $hall->id)? 'selected' : '' }}>{{ $hall->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="form-group col-6">
                        <label for="occurence">Occurence per week</label>
                        <input type="number" min="1" max="5"  value="{{ $schedule->occurence }}" class="form-control" autocomplete="off" name="occurence" id="occurence">
                    </div>

                    <div class="form-group col-6">
                        <label for="duration">Duration ( Hours )</label>
                        <input type="number" min="1" max="24" value="{{ $schedule->duration }}" class="form-control" autocomplete="off" name="duration" id="duration">
                    </div>
                </div>
                



                <div class="form-group">
                    <button class="btn btn-primary add-schedule">Update</button>
                </div>
            </form>
        </div>
    </div>
</section>

@endsection