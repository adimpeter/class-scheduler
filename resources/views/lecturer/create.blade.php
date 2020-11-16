@extends('layouts.app')

@section('content')

<section>
    <div class="row margin-none">
        @include('snipps.notify')
        <div class="col-md-6 offset-md-3">
            <form action="{{ route('lecturer.store') }}" method="post">
                @csrf()
                <div class="form-group">
                    <label for="lastname">Surname</label>
                    <input type="text" class="form-control" name="lastname" id="lastname">
                </div>

                <div class="form-group">
                    <label for="firstname">Firstname</label>
                    <input type="text" class="form-control" name="firstname" id="firstname">
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
                    <th>Lastname</th>
                    <th>Firstname</th>
                </tr>
                @foreach($lecturers as $lecturer)
                    <tr>
                        <td>
                            <strong>{{ $lecturer->lastname }}</strong>
                        </td>
                        <td>
                            {{ $lecturer->firstname }}
                        </td>
                    </tr>
                @endforeach 
            </table>
        </div>
    </div>
</section>

@endsection