@extends('layouts.app')

@section('content')
 
 
  @if(session()->get('success'))
    <div class="alert alert-success">
      {{ session()->get('success') }}  
     <br />  
  @endif
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><h3>Manage Celebrities Data</h3></div> 

                <form action="/search" method="POST" role="search">
                    {{ csrf_field() }}
                    <div class="input-group">
                        <input required type="text" class="form-control" name="q"
                            placeholder="Search users"> <span class="input-group-btn">
                            <button type="submit" class="btn btn-primary">
                               Search
                            </button>
                        </span>
                    </div>
                </form>
                
                <div class="d-flex justify-content-center">
            <button type="button" class="btn btn-success btn-lg" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">Add </button>
                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel">Add Celebrities</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                              <form method="post" enctype="multipart/form-data" action="{{ route('crud.store') }}">  
                                @csrf
                                <div class="form-group">
                                  <label for="recipient-name" class="col-form-label">Name:</label>
                                  <input type="text" required name="name" class="form-control" id="recipient-name">
                                </div>

                                <label for="recipient-img" class="col-form-label">Image :</label>

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

                                <div class="form-group">
                                  <label for="recipient-name" class="col-form-label">Top Celeb :</label>                                 
                                      Yes<input type="radio"  name="top"  value="true" >
                                      No<input type="radio" name="top"  value="false"  >
                                  <br>    
                                </div>

                                <div class="form-group">
                                  <label for="recipient-name" class="col-form-label">Height:</label> 
                                  <input type="text" placeholder = "Enter in Meter" name="heightmeter" class="form-control" id="recipient-name"> 
                                  <input type="text" placeholder = "Enter in Feet" name="heightfeet" class="form-control" id="recipient-name"> 
                                  <input type="text" placeholder = "Enter in Inches" name="heightinches" class="form-control" id="recipient-name">
                                </div>
                                <div class="form-group">
                                  <label for="recipient-name" class="col-form-label">Weight:</label>
                                  <input type="text" name="weightkg" placeholder = "Enter in KG" class="form-control" id="recipient-name">
                                  <input type="text" name="weightlbs" placeholder = "Enter in lbs"   class="form-control" id="recipient-name">
                                </div>
                                <div class="form-group">
                                  <label for="recipient-name" class="col-form-label">Net Worth:</label>
                                  <input type="text" required name="networth" class="form-control" id="recipient-name">
                                </div>
                                <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                              <button type="submit" class="btn btn-primary">Add</button>                             
                            </div>                            
                             </div>
                                @if ($errors->any())
                                  <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                          <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                  </div><br />
                                @endif
                              </form>                                                           
                            </div>                            
                          </div>                    
                      </div>
                       
                      <a href="{{ route('home')}}" class="btn btn-warning">Home</a> 
                      <a href="{{ route('addceleb')}}" class="btn btn-primary">Manage</a> 
                       
                <div class="table-responsive">   
             </div>
        </div>
 
    <table class="table table-striped table-hover table-condensed">
    {{ $celebs->links() }} 
    <thead class="thead-dark" >
      <tr>
        <th><strong>Id</strong></th>
        <th><strong>Name</strong></th>
        <th><strong>Image</strong></th>
        <th><strong>Height</strong></th>
        <th><strong>Weight</strong></th>
        <th><strong>Net Worth</strong></th>
        <th><strong>Top</strong></th>
        <th><strong>Edit</strong></th>
        <th><strong>Delete</strong></th>
      </tr>
    </thead>
    <tbody>
    @foreach ($celebs as $celeb)
      <tr> 
        <td>{{ $celeb->id }}</td>    
        <td>{{ $celeb->name }}</td>
        <td>
          @if($celeb->image!=null)
            <div><img src="{{url($celeb->image)}}" height=80 width=80/></div> 
          @else
              <i>Upload Image</i>
          @endif
        </td> 
        <td>{{ $celeb->height }}</td> 
        <td>{{ $celeb->weight }}</td>  
        <td>{{ $celeb->networth }}</td> 
        <td>{{ $celeb->top }}</td> 
        <td> 
        <a href="{{ route('crud.edit',$celeb->id)}}" class="btn btn-primary">Edit</a>      
            </td>
            <td>
                <form action="{{ route('crud.destroy', $celeb->id)}}" method="post">
                  @csrf
                  @method('DELETE')
                  <button class="btn btn-danger" type="submit">Delete</button>
                </form>
            </td>
      </tr>
      
      @endforeach
    </tbody>   
  </table> 
                </div>  
            </div>
        </div>
    </div>
</div>
@endsection