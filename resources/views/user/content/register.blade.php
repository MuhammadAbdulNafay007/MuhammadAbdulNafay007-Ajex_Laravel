@extends('user.layout.index')
@section('title', 'Registration Page')
@section('content')

<div class="container">
    <h2 class="bg-primary p-3 text-light text-center">Welcome to Registration Page</h2>
</div>
<form action="{{ route('user.register.store')}}" method="POST" id="registerForm">
    @csrf
    <div class="mt-5" id="success_message"></div>
    <div id="validation_error"></div>
    <div class="container d-flex min-vh-100 justify-content-center align-items-center">

        <div class="card border border-info col-md-6">
            <div class="mb-3 p-2">
                <label for="username" class="form-label">Username</label>
                <input type="username" class="form-control" id="username" name="username" placeholder="Write your username here">
            </div>
            <div class="mb-3 p-2">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="example@example.com">
            </div>
            <div class="mb-3 p-2">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="password">
            </div>
            <div class="text-center p-2">
                <button type="button" class="btn btn-outline-info" id="submitForm">Register</button>
            </div>
        </div>

    </div>
</form>

<script>
    $(document).ready(function() {

        $('#submitForm').on('click', function(event) {
            event.preventDefault();
            $(this).text("Submitted");
            $.ajax({
                url: "{{ route('user.register.store')}}",
                data: jQuery('#registerForm').serialize(),
                type: 'post',

                success: function(result) {
                    if (result.status == 400) {
                        $('#validation_error').html("");
                        $('#validation_error').addClass('alert alert-danger');
                        $.each(result.errors, function(key, err_value) {
                            $('#validation_error').append('<li>' + err_value + '</li>');
                        });
                    } else {
                        $('#validation_error').html("");
                        $('#success_message').addClass('alert alert-success');
                        $('#success_message').text(result.message);
                        $('submitForm').text("Register");
                        jQuery('#registerForm')[0].reset();

                    }
                }
            })
        });
    });
</script>
@endsection