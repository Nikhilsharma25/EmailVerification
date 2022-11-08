
@extends('layouts.app')

@section('content')
<div class="alert" style="font-size: 10px;">
                  @if (session('status'))
                      <h1 class="alert alert-success">{{session('status')}}</h1>
                  @endif 
              </div> 
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
                   <div class="card">
                <div class="card-body">
                    <div class="row">
                      <div class="col-md-12">
                        <a href="{{route('create')}}" class="btn btn-primary">Add Users</a>
                          <div class="table-responsive">
                              <table class="table">
                              <thead>
                                <tr>
                                <th>#</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Email</th>
                                <th>Mobile</th>
                                <th>Action</th>
                                </tr>
                              </thead>
                              <?php $count = 1; ?>
                              @if(isset($user))
                              @foreach($user as $item)
                              
                                  <tbody>
                                      <tr>
                                      <td>{{$count ++}}</td>
                                      <td>{{$item->name}}</td>
                                      <td>{{$item->lastname}}</td>
                                      <td>{{$item->email}}</td>
                                      <td>{{$item->phone}}</td>
                                      <td><a href="{{route('edit',$item->id)}}" class="btn btn-primary">Edit</a></td>
                                      <td><a href="{{route('delete',$item->id)}}" class="btn btn-danger">Delete</a></td>
                                      </tr>
                                  </tbody>
                              
                              @endforeach
                              @endif
                            </table>
                          </div>
                     </div>
                  </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
