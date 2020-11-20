@extends('layouts.app')

@section('content')

<section>
    <div class="row margin-none">
        @include('snipps.notify')
        <div class="col-md-6 offset-md-3">
            <form action="{{ route('lecturer.update', ['lecturer' => $lecturer]) }}" method="post">
                @method('PATCH')
                @csrf()
                <div class="form-group">
                    <label for="lastname">Surname</label>
                    <input type="text" class="form-control" name="lastname" id="lastname" value="{{ $lecturer->lastname }}">
                </div>

                <div class="form-group">
                    <label for="firstname">Firstname</label>
                    <input type="text" class="form-control" name="firstname" id="firstname" value="{{ $lecturer->firstname }}">
                </div>

                <div class="form-group">
                    <button class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</section>

@endsection