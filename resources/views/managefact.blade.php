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
                <div class="card-header"><h3>Manage Facts</h3></div> 

                <form action="/searchfact" method="POST" role="search">
                    {{ csrf_field() }}
                    <div class="input-group">
                        <input required type="text" class="form-control" name="q"
                            placeholder="Search facts"> <span class="input-group-btn">
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
                              <h5 class="modal-title" id="exampleModalLabel">Add Facts</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                              <form method="post" action="{{ route('fact.store') }}">                               
                                @csrf
                                <div class="form-group">    
                                  <label for="recipient-name" class="col-form-label">Description:</label>
                                  <textarea required name="description" class="form-control" id="recipient-name"> </textarea>
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
                      <a href="{{ route('managefact')}}" class="btn btn-primary">Manage</a> 
                                  
                <div class="table-responsive">                            
             </div>
        </div>
 
    <table class="table table-striped table-hover table-condensed">
    <thead class="thead-dark" >
      <tr>
        <th><strong>Number</strong></th>
        <th><strong>Description</strong></th>
        <th><strong>Edit</strong></th>   
        <th><strong>Delete</strong></th>   
      </tr>
    </thead>
    <tbody>
    @foreach ($facts as $fact)
      <tr> 
        <td>{{ $fact->id }}</td>
        <td>{{ $fact->description }}</td>       
        <td> 
        <a href="{{ route('fact.edit',$fact->id)}}" class="btn btn-primary">Edit</a>      
            </td>
            <td>
                <form action="{{ route('fact.destroy', $fact->id)}}" method="post">
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
