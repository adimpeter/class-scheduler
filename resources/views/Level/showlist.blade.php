@extends('layouts.app')

@section('content')

<section>
    <div class="row margin-none">
        @include('snipps.notify')
        <div class="col-md-12">
            <h3>All Schedules</h3>
            <table class="table table-striped table-sm">
                <tr>
                    <th>Level</th>
                    <th>Maximum number of courses</th>
                    <th>Current number of courses</th>
                    <th></th>
                </tr>
                @foreach($levels as $level)
                    <tr>
                        <td>
                            <em>{{ $level->name }}</em>
                        </td>
                        <td>
                            <em>{{ $level->max_number_of_courses }}</em>
                        </td>
                        <td>
                            {{ $level->courseCount() }}
                        </td>
                        <td>
                            <div class="row">
                                <div class="col-6">
                                    <a href="{{ route('level.edit' , ['level'=> $level]) }}" class="btn btn-primary">Edit</a>
                                </div>
                                <div class="col-6">
                                    <form action="{{ route('level.delete', ['level' => $level]) }}" class="delete-level-form-{{ $level->id }}" method="post">
                                        @method('DELETE')
                                        @csrf()
                                        <button class="btn btn-danger btn-block delete-level" data-toggle="modal" data-target="#confirmActionModal">Delete</button>
                                    </form>
                                </div>
                            </div>
                            
                            
                        </td>
                    </tr>
                @endforeach 
                
            </table>
        </div>

        <div class="col-md-12 margin-vertical-md">
            {{ $levels->links() }}    
        </div>
    </div>
</section>

@include('snipps.confirm-action')

@endsection