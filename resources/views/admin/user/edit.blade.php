@extends('layouts.app')
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Update  user</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">User</a></li>
              <li class="breadcrumb-item active">Add</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- jquery validation -->
            <div class="card card-primary">

              <!-- /.card-header -->
              <!-- form start -->
              <form action="{{url('user/'.encrypt($user->id))}}" enctype="multipart/form-data" method="Post" id="quickForm">
                @method('PUT')
                @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Name</label>
                    <input type="text" id="name" name="name" class="@error('name') is-invalid @enderror form-control" id="exampleInputEmail1" placeholder="Name" value="{{$user->name}}" />
                    @error('name')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Email</label>
                    <input type="email" id="name" name="email" class="@error('email') is-invalid @enderror form-control" id="exampleInputEmail1" placeholder="Email" value="{{$user->email}}" readonly>
                    @error('email')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
                  </div>

                  {{-- <div class="form-group">
                    <label for="exampleInputEmail1">Password</label>
                    <input type="email" id="name" name="password" class="@error('password') is-invalid @enderror form-control" id="exampleInputEmail1" placeholder="password">
                    @error('password')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
                  </div> --}}

                  <div class="form-group">
                    <label for="exampleInputEmail1">Phone</label>
                    <input type="text" id="name" name="phone" class="@error('phone') is-invalid @enderror form-control" id="exampleInputEmail1" placeholder="Phone" onkeypress="return isNumber(event)" value="{{$user->phone}}"/>
                    @error('phone')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Photo</label>
                    <input type="file"  name="photo" class="@error('phone') is-invalid @enderror form-control" id="exampleInputEmail1"/>
                    @error('photo')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
                    <img src="{{url('/uploads/'.$user->profile_image)}}" height="40" width="40"/>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Role</label>
                    <select name="role" class="@error('role') is-invalid @enderror form-control">
                        <option value =''>--SELECT--</option>
                        @foreach($roles as $role)

                        <option @php echo $role->id == $user->role_id ?"selected":''; @endphp value ='{{$role->id}}'>{{$role->name}}</option>
                        @endforeach
                    </select>

                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Status</label>
                    <select name="status" class="@error('status') is-invalid @enderror form-control">
                        <option @php echo $user->status == '0'?"selected":''; @endphp value ='0'>Inactive</option>
                        <option @php echo $user->status == '1'?"selected":''; @endphp value ='1'>active</option>
                    </select>

                  </div>

                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
            </div>
            <!-- /.card -->
            </div>
          <!--/.col (left) -->
          <!-- right column -->
          <div class="col-md-6">

          </div>
          <!--/.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
@endsection
@section('script')
<script>
    function isNumber(evt) {
        evt = (evt) ? evt : window.event;
        var charCode = (evt.which) ? evt.which : evt.keyCode;
        if (charCode > 31 && (charCode < 48 || charCode > 57)) {
            return false;
        }
        return true;
    }
</script>
@endsection
