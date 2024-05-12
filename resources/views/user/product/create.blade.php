@extends('user.layout.index')
@section('title', 'Product Creation Page')
@section('content')

<div class="container">
    <h2 class="bg-primary p-3 text-light text-center">Welcome to Product Creation Page</h2>
</div>

<div class="mb-3">

    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
        <a href="{{ route('user.product.index')}}" class="btn btn-primary me-md-2">View Products</a>
    </div>
    <form action="{{ route('user.product.store')}}" method="POST" role="form" id="myForm">
        @csrf
        <div class="mt-5" id="success_message"></div>
        <div id="validation_error"></div>
        <div class="container d-flex min-vh-100 justify-content-center align-items-center">

            <div class="card border border-info col-md-6">
                <div class="mb-3 p-2">
                    <label for="name" class="form-label">Product Name</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Write Product Name" required>
                </div>
                <div class="p-2">
                    <label for="description">Product Description</label>
                </div>
                <div class="form-floating mb-3 p-2">
                    <textarea class="form-control" placeholder="Leave a comment here" name="description" id="description"></textarea>
                </div>
                <div class="mb-3 p-2">
                    <label for="price" class="form-label">Product Price</label>
                    <input type="number" class="form-control" id="price" name="price" placeholder="Write Product Price in PKR" required>
                </div>
                <div class="text-center p-2">
                    <button type="button" class="btn btn-outline-info" id="submitForm">Submit</button>
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
                    url: "{{ route('user.product.store')}}",
                    data: jQuery('#myForm').serialize(),
                    type: 'post',

                    success: function(result) {
                        if (result.status == 400) {
                            $('#validation_error').html("");
                            $('#validation_error').addClass('alert alert-danger');
                            $.each(result.errors, function(key, err_value) {
                                $('#validation_error').append('<li>' + err_value + '</li>');
                            });
                            $('submitForm').text("Submit");
                        } else {
                            $('#validation_error').html("");
                            $('#success_message').addClass('alert alert-success');
                            $('#success_message').text(result.message);
                            $('submitForm').text("Submit");
                            jQuery('#myForm')[0].reset();
                            
                        }
                    }
                })
            });
        });
    </script>
    @endsection