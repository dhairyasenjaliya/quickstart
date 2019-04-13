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
                    <form method="post"  enctype="multipart/form-data" action="{{ route('crud.update', $Celebrities->id) }}">
                        @method('PATCH')
                        @csrf
                          <div class="form-group">
                          <label for="recipient-name" class="col-form-label">Name:</label>
                          <textarea type="text" required name="name" class="form-control" id="recipient-name">{{ $Celebrities->name }} </textarea>
                        </div>

                     
                          <label for="recipient-img" class="col-form-label">Image :</label>
                          @if($Celebrities->image != null)
                            <div ><img src="{{url($Celebrities->image)}}" height=80 width=80/></div> 
                            <br>
                            <div class="file is-danger has-name is-boxed">
                                <label class="file-label">
                                
                                  <input class="file-input" type="file" name="filenames">
                                  <span class="file-cta">

                                    <span class="file-icon">
                                      <i class="fas fa-cloud-upload-alt"></i>
                                    </span>
                                  
                                    <span class="file-label">
                                        Update
                                    </span>
                                  </span>
                                  <span class="file-name">
                                  
                                  </span>
                                </label>
                              </div>
                          @else 
                            <div class="file is-danger has-name is-boxed">
                                <label class="file-label">
                                
                                  <input class="file-input" type="file" name="filenames">
                                  <span class="file-cta">

                                    <span class="file-icon">
                                      <i class="fas fa-cloud-upload-alt"></i>
                                    </span>
                                  
                                    <span class="file-label">
                                        Upload Image
                                    </span>
                                  </span>
                                  <span class="file-name">
                                  
                                  </span>
                                </label>
                              </div>
                          @endif
                          
                        <input type="checkbox" name="chkimage"  > No image 
                        <br>

                        <label for="recipient-name" class="col-form-label">Top :</label>
                         Yes
                          <input type="radio"  name="top"  value="true" 
                          {{ $Celebrities->top  == '1' ? 'checked' : '' }} >
                            No
                          <input type="radio" name="top"  value="false" 
                          {{ $Celebrities->top  == '0' ? 'checked' : '' }} >   
                          <br>
                        
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Height:</label>
                            <textarea type="text" required name="height"  class="form-control" id="recipient-name"> {{ $Celebrities->height }}</textarea>                            
                        </div>
                      
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Weight:</label>
                            <textarea type="text" required name="weight"  class="form-control" id="recipient-name"> {{ $Celebrities->weight }}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Net Worth:</label>
                            <textarea type="text" required name="networth" class="form-control" id="recipient-name">{{ $Celebrities->networth }} </textarea>
                        </div>
                                 
                        <button type="submit" class="btn btn-primary">Update</button>
                        <a href="{{route('addceleb') }}" class="btn btn-danger">Cancel</a>
                      </form>
                    </div>
                <div class="modal-footer">  
            </div>
        </div>
</div>
@endsection