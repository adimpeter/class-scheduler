@extends('layouts.app')

@section('content')

<section>
    <div class="row margin-none">
        @include('snipps.notify')
        <div class="col-md-12 margin-vertical-md " id="notify">
            
        </div>
        <div class="col-md-6 offset-md-3">
            <form action="{{ route('hall.update', ['hall'=>$hall]) }}" id="hallForm" method="post">
                @method('PATCH')
                @csrf()

                <div class="forn-group">
                    <label for="hallname">Hall</label>
                    <input type="text" name="name" id="hallname" value="{{ $hall->name }}" class="form-control">
                </div>
                



                <div class="form-group margin-vertical-md">
                    <button class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</section>

@endsection