@extends('Admin.Layouts.app')

@section('css')
    
@endsection

@section('content')
<!-- Page content -->
<div class="container-fluid" style="margin-top: 3%; margin-bottom: 6%;">

    <div class="card">
        <div class="card-header">
          <h2 class="text-primary">Edit Data User</h2>
        </div>
        <div class="card-body">
            <form method="POST" action="/admin/user/view/{!!$data->id!!}/update">
                {{ csrf_field() }}
                <div class="container" style="margin-top: -10px;">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Name</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Your Name" value="{!! $data->name !!}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Email address</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com" value="{!! $data->email !!}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Password</label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Role</label>
                                <select class="form-control" name="roles_id">
                                    <option value="">Select role</option>
                                    @foreach ($roles as $item)
                                    <option value="{!! $item->id !!}">{!! $item->name !!}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group" style="float: right; margin-top: 20px;">
                                <input class="btn btn-primary" type="submit" value="Save">
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    
</div>    
@endsection

@section('js')
<script>
    $(document).ready(function() {   
        $("#users").addClass("active");
    });
</script>
@endsection