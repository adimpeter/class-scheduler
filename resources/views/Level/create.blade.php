@extends('layouts.app')

@section('content')

<section>
    <div class="row margin-none">
        @include('snipps.notify')
        <div class="col-md-12 margin-vertical-md " id="notify">
            
        </div>
        <div class="col-md-6 offset-md-3">
            <form action="{{ route('level.store') }}" method="post">
                @csrf()

                <div class="row">
                    <div class="form-group col-12">
                        <label for="levelname">Level</label>
                        <input type="text" name="name" id="levelname" class="form-control">
                    </div>

                    <div class="form-group col-12">
                        <label for="maxcourse">Max number of courses</label>
                        <input type="number" min=1 max=100 name="max_courses" id="maxcourse" value="1" class="form-control">
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
                    <th>Level</th>
                    <th>Maximum number of courses</th>
                </tr>
                @foreach($levels as $level)
                    <tr>
                        <td>
                            <em>{{ $level->name }}</em>
                        </td>
                        <td>
                            <em>{{ $level->max_number_of_courses }}</em>
                        </td>
                    </tr>
                @endforeach 
            </table>
        </div>
    </div>
</section>

@endsection