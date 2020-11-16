<?php dump(session('status')) ?>

@if (session('status'))
    <div class="col-md-12">
      <div class="alert alert-success" role="alert">
          {{ session('status') }}
      </div>
    </div>
@endif



@if (session('error'))
    <div class="col-md-12">
      <div class="alert alert-danger" role="alert">
          {{ session('error') }}
      </div>
    </div>
@endif


<div class="col-md-12">
    @if($errors->any())
       @foreach ($errors->all() as $error)
           <div class="alert alert-danger" role="alert">
              {{ $error }}
            </div>
      @endforeach
    @endif
</div>