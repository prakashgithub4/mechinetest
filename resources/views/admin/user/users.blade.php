@extends('layouts.app')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>DataTables</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Roles</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            @include('alert')
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">DataTable with minimal features & hover style</h3>
              </div>
              <!-- /.card-header -->

              @if($user_list_display_by_role)
              <div class="card-body">
                @if($user_import_for_admin)
                   <a href="#" class="btn btn-primary">Import csv</a>
                @endif
                <a href="{{url('user/create')}}" class="btn btn-success">Add</a>
                <table id="example2" class="table table-bordered table-hover">

                  <thead>
                  <tr>
                    <th>SL#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Photo</th>
                    <th>Status</th>
                    <th>Action</th>

                  </tr>
                  </thead>
                  <tbody>
                    @foreach ($users as $key=>$user)
                    <tr>

                       <td>{{$key + 1}}</td>
                       <td>{{$user->name}}</td>
                       <td>{{$user->email}}</td>
                       <td><img src="{{url('/uploads/'.$user->profile_image)}}" height="40" width="40"/></td>
                       <td>{{$user->status == 1?"Active":"Inactive"}}</td>

                       <td><a class="btn btn-info" href="{{url('user/'.encrypt($user->id).'/edit')}}">Edit</a>&nbsp; <form action="{{ route('user.destroy', encrypt($user->id)) }}" method="POST">
                        @method('DELETE')
                        @csrf
                        <button class="btn btn-danger">Delete</button>
                    </form></td>
                    </tr>
                    @endforeach



                  </tbody>

                </table>
              </div>
              @else
              <label>This action is not available</label>
              @endif
              <!-- /.card-body -->
            </div>
            <!-- /.card -->


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
@section('script')

<script>
    $(function () {
      $("#example1").DataTable({
        "responsive": true, "lengthChange": false, "autoWidth": false,
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
      }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
      $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
      });
    });
  </script>
  @endsection
