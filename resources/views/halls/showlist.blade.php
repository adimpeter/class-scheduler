@extends('layouts.app')

@section('content')

<section>
    <div class="row margin-none">
        @include('snipps.notify')
        <div class="col-md-12">
            <h3>All Halls</h3>
            <table class="table table-striped">
                <tr>
                    <th>Hall Name</th>
                    <th></th>
                </tr>
                @foreach($halls as $hall)
                    <tr>
                        <td>
                            <em>{{ $hall->name }}</em>
                        </td>
                        <td>
                            <div class="row">
                                <div class="col-6">
                                    <a href="{{ route('hall.edit' , ['hall'=> $hall]) }}" class="btn btn-primary btn-block">Edit</a>
                                </div>
                                <div class="col-6">
                                    <form action="{{ route('hall.delete', ['hall' => $hall]) }}" class="delete-hall-form-{{ $hall->id }}" method="post">
                                        @method('DELETE')
                                        @csrf()
                                        <button class="btn btn-danger btn-block delete-hall" data-toggle="modal" data-target="#confirmActionModal">Delete</button>
                                    </form>
                                </div>
                            </div>
                            
                            
                        </td>
                    </tr>
                @endforeach 
                
            </table>
        </div>

        <div class="col-md-12 margin-vertical-md">
            {{ $halls->links() }}    
        </div>
    </div>
</section>

@include('snipps.confirm-action')

@endsection