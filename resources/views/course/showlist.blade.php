@extends('layouts.app')

@section('content')

<section>
    <div class="row margin-none">
        @include('snipps.notify')
        <div class="col-md-12">
            <h3>All courses</h3>
            <table class="table table-striped">
                <tr>
                    <th>Course ID</th>
                    <th>Course Name</th>
                    <th>Course Level</th>
                    <th>Lecturer</th>
                    <th></th>
                </tr>
                @foreach($courses as $course)
                    <tr>
                        <td>
                            <em>{!! $course->course_code ?? '<span class="text text-danger">N/A</span>' !!}</em>
                        </td>
                        <td>
                            {!! $course->name ?? '<span class="text text-danger">N/A</span>' !!}
                        </td>
                        <td>
                            {!! $course->level->name ?? '<span class="text text-danger">N/A</span>' !!}
                        </td>
                        <td>
                            {!! $course->lecturer->lastname ?? '<span class="text text-danger">N/A</span>' !!} {!! $course->lecturer->firstname ?? '<span class="text text-danger">N/A</span>' !!}
                        </td>
                        <td>
                            <div class="row">
                                <div class="col-6">
                                    <a href="{{ route('course.edit' , ['course'=> $course]) }}" class="btn btn-primary">Edit</a>
                                </div>
                                <div class="col-6">
                                    <form action="{{ route('course.delete', ['course' => $course]) }}" class="delete-course-form-{{ $course->id }}" method="post">
                                        @method('DELETE')
                                        @csrf()
                                        <button class="btn btn-danger btn-block delete-course" data-toggle="modal" data-target="#confirmActionModal">Delete</button>
                                    </form>
                                </div>
                            </div>
                            
                            
                        </td>
                    </tr>
                @endforeach 
                
            </table>
        </div>

        <div class="col-md-12 margin-vertical-md">
            {{ $courses->links() }}    
        </div>
    </div>
</section>

@include('snipps.confirm-action')

@endsection