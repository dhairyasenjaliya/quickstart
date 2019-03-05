@extends('layouts.app')

@section('content')
 
<div class="container">
<div class="uper">
  @if(session()->get('success'))
    <div class="alert alert-success">
      {{ session()->get('success') }}  
    </div><br />
  @endif
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><h3>Edit Celebrities</h3></div>               
                <div class="table-responsive">                            
             </div>
        </div>
    
        <div class="d-flex justify-content-center">

        <div class="modal-body">
                    <form method="post" action="{{ route('crud.update', $Celebrities->id) }}">
                        @method('PATCH')
                        @csrf
                          <div class="form-group">
                          <label for="recipient-name" class="col-form-label">Name:</label>
                          <input type="text" name="name"  class="form-control" id="recipient-name" value= {{ $Celebrities->name }}>
                        </div>
                        <div class="form-group">
                                  <label for="recipient-name" class="col-form-label">Height:</label>
                                  <input type="text" required name="height" value= {{ $Celebrities->height }} class="form-control" id="recipient-name">
                                </div>
                                <div class="form-group">
                                  <label for="recipient-name" class="col-form-label">Weight:</label>
                                  <input type="text" required name="weight" value= {{ $Celebrities->weight }} class="form-control" id="recipient-name">
                                </div>
                                <div class="form-group">
                                  <label for="recipient-name" class="col-form-label">Net Worth:</label>
                                  <input type="text" required name="networth" value= {{ $Celebrities->networth }} class="form-control" id="recipient-name">
                                </div>
                                 
                        <button type="submit" class="btn btn-primary">Update</button>
                        <a href="{{route('addceleb') }}" class="btn btn-danger">Cancle</a>
                      </form>
                    </div>
                    <div class="modal-footer">                      
                     
                    </div>
        </div>
</div>
@endsection
