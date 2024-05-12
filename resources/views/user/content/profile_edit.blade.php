@extends('user.layout.index')
@section('title', 'Profile Edit Page')
@section('content')


<div class="container">
    <h2 class="bg-primary p-3 text-light text-center">User Profile Edit Page</h2>
</div>

<div class="d-grid gap-2 d-md-flex justify-content-md-end">
    <a href="{{ route('user.content.user_profile')}}" class="btn btn-primary me-md-2">View Users</a>
</div>
<div class="mt-5" id="success_message"></div>
<form action="{{ route('user.user_profile.update', $user->id)}}" method="POST" id="userUpdateForm">
    @csrf
    
    <div id="validation_error_update"></div>
    <div class="container d-flex min-vh-100 justify-content-center align-items-center">

        <div class="card border border-info col-md-6">
            <div class="mb-3 p-2">
                <label for="username" class="form-label">Username</label>
                <input type="username" class="form-control" id="username" name="username" value="{{$user->username}}" placeholder="Write your username here">
            </div>
            <div class="mb-3 p-2">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="{{$user->email}}" placeholder="example@example.com">
            </div>
            <div class="mb-3 p-2">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" value="{{$user->password_string}}" placeholder="password">
            </div>
            <div class="text-center p-2">
                <button type="button" class="btn btn-outline-info" id="updateForm">Update</button>
            </div>
        </div>

    </div>
</form>

<script>
    $(document).ready(function() {
  
        $('#updateForm').on('click', function(event) {
            event.preventDefault();
             
            $.ajax({
                url: "{{ route('user.user_profile.update', $user->id)}}",
                data: jQuery('#userUpdateForm').serialize(),
                type: 'post',
                dataType: "json",

                success: function(result) {
                    if (result.status == 400) {
                        $('#validation_error_update').html("");
                        $('#validation_error_update').addClass('alert alert-danger');
                        $.each(result.errors, function(key, err_value) {
                            $('#validation_error_update').append('<li>' + err_value + '</li>');
                        });
                    } else {
                        $('#validation_error_update').html("");
                        $('#success_message').addClass('alert alert-success');
                        $('#success_message').text(result.message);
                        $('updateForm').text("Update");
                        jQuery('#userUpdateForm')[0].remove();

                    }
                }
            })
        });
    });
</script>

@endsection