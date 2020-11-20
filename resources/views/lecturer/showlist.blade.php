@extends('layouts.app')

@section('content')

<section>
    <div class="row margin-none">
        @include('snipps.notify')
        <div class="col-md-12">
            <h3>All lecturers</h3>
            <table class="table table-striped table-sm">
                <tr>
                    <th>Lecturer</th>
                    <th></th>
                </tr>
                @foreach($lecturers as $lecturer)
                    <tr>
                        
                        <td>
                            {{ $lecturer->lastname }} {{ $lecturer->firstname }}
                        </td>
                        <td>
                            <div class="row">
                                <div class="col-6">
                                    <a href="{{ route('lecturer.edit' , ['lecturer'=> $lecturer]) }}" class="btn btn-primary">Edit</a>
                                </div>
                                <div class="col-6">
                                    <form action="{{ route('lecturer.delete', ['lecturer' => $lecturer]) }}" class="delete-lecturer-form-{{ $lecturer->id }}" method="post">
                                        @method('DELETE')
                                        @csrf()
                                        <button class="btn btn-danger btn-block delete-lecturer" data-toggle="modal" data-target="#confirmActionModal">Delete</button>
                                    </form>
                                </div>
                            </div>
                            
                            
                        </td>
                    </tr>
                @endforeach 
                
            </table>
        </div>

        <div class="col-md-12 margin-vertical-md">
            {{ $lecturers->links() }}    
        </div>
    </div>
</section>

@include('snipps.confirm-action')

@endsection