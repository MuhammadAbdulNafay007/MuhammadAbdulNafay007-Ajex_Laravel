@extends('user.layout.index')
@section('title', 'Product Edit Page')
@section('content')

<div class="container">
    <h2 class="bg-primary p-3 text-light text-center">Welcome to Product Edit Page</h2>
</div>

<div class="d-grid gap-2 d-md-flex justify-content-md-end">
    <a href="{{ route('user.product.index')}}" class="btn btn-primary me-md-2">View Products</a>
</div>
<div class="mt-5" id="success_message"></div>
<form action="{{ route('user.product.update', $product->id)}}" method="POST" role="form" id="editForm">
    @csrf
   
    <div id="validation_error_update"></div>
    <div class="container d-flex min-vh-100 justify-content-center align-items-center">

        <div class="card border border-info col-md-6">
            <div class="mb-3 p-2">
                <input type="hidden" id="edit_product_id" value="{{$product->id}}">
            </div>
            <div class="mb-3 p-2">
                <label for="name" class="form-label">Product Name</label>
                <input type="text" class="form-control" id="edit_name" name="name" value="{{$product->name}}">
            </div>
            <div class="p-2">
                <label for="description">Product Description</label>
            </div>
            <div class="form-floating mb-3 p-2">
                <textarea class="form-control" name="description" id="edit_description">{{$product->description}}</textarea>
            </div>
            <div class="mb-3 p-2">
                <label for="price" class="form-label">Product Price</label>
                <input type="number" class="form-control" id="edit_price" name="price" value="{{$product->price}}">
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
                url: "{{ route('user.product.update', $product->id)}}",
                data: jQuery('#editForm').serialize(),
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
                        jQuery('#editForm')[0].remove();

                    }
                }
            })
        });
    });
</script>

@endsection