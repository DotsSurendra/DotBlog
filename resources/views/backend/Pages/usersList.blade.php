@extends('backend.app')

@section('body-class', 'hold-transition sidebar-mini layout-fixed')

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">Users</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Users List</li>
              </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>

      <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">DataTable with minimal features & hover style</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <table id="example2" class="table table-bordered table-hover">
                    <thead>
                    <tr>
                      <th>S.no</th>
                      <th>Id</th>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Email Varify</th>
                      <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if (!empty($users))
                        @foreach ( $users as $key => $user )

                        <tr>
                            <td>{{$key +1}}</td>
                            <td>{{$user->id}}</td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{$user->email_verify =='1' ? 'Yes':'No'}}</td>
                            <td><a href="{{route('user',['id'=>$user->id])}}" class="btn btn-primary">view</a>
                                <a href="#" class="btn btn-secondary">Edit</a>
                                <a href="#" class="btn btn-danger">delete</a>
                            </td>
                          </tr>

                            
                        @endforeach
                        
                    @endif
                   
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>S.no</th>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Email Varify</th>
                            <th>Action</th>
                          </tr>
                    </tfoot>
                  </table>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
  
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
      </section>
      <!-- /.content -->
</div>


@endsection





