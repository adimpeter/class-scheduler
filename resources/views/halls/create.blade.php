@extends('layouts.app')

@section('content')

<section>
    <div class="row margin-none">
        @include('snipps.notify')
        <div class="col-md-6 offset-md-3">
            <form action="{{ route('hall.store') }}" method="post">
                @csrf()
                <div class="form-group">
                    <label for="name">Hall Name</label>
                    <input type="text" class="form-control" name="name" id="name">
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
                    <th>Hall Name</th>
                </tr>
                @foreach($halls as $hall)
                    <tr>
                        <td>
                            <em>{{ $hall->name }}</em>
                        </td>
                    </tr>
                @endforeach 
            </table>
        </div>
    </div>
</section>

@endsection