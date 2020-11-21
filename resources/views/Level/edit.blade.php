@extends('layouts.app')

@section('content')

<section>
    <div class="row margin-none">
        @include('snipps.notify')
        <div class="col-md-12 margin-vertical-md " id="notify">
            
        </div>
        <div class="col-md-6 offset-md-3">
            <form action="{{ route('level.update') }}" method="post">
                @method('PATCH')
                @csrf()

                <div class="row">
                    <div class="form-group col-12">
                        <label for="levelname">Level</label>
                        <input type="text" name="name" id="levelname" class="form-control" value="{{ $level->name }}">
                    </div>

                    <div class="form-group col-12">
                        <label for="maxcourse">Max number of courses</label>
                        <input type="number" min=1 max=100 name="max_courses" id="maxcourse" class="form-control" value="{{ $level->max_number_of_courses }}">
                    </div>
                



                <div class="form-group">
                    <button class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</section>


@endsection