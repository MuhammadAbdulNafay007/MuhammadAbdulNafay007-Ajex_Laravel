@extends('user.layout.index')
@section('title', 'Product View Page')
@section('content')

<div class="container">
    <h2 class="bg-primary p-3 text-light text-center">Welcome to Product View Page</h2>
</div>

<div class="d-grid gap-2 d-md-flex justify-content-md-end">
    <a href="{{ route('user.product.create')}}" class="btn btn-primary me-md-2">Add Product</a>
</div>
<div class="mt-5" id="success_message"></div>
<!-- Modal -->
@if($products->count() > 0)
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    @csrf
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3 p-2">
                    @foreach($products as $product)
                    <input type="hidden" id="delete_product_id" value="{{$product->id}}">
                    @endforeach
                    <h4>Are Yoys Sure? You want to Delete This Product</h4>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary delete_product_btn">Yes Delete</button>
            </div>
        </div>
    </div>
</div>
<!-- End Modal -->
<table class="container table table-bordered mt-3">

    <thead>
        <tr>
            <th>Serial No.</th>
            <th>Product Name</th>
            <th>Product Description</th>
            <th>Product Price</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @php
        $i = 0;
        @endphp
        @foreach($products as $product)
        <tr>
            <td>{{ ++$i }}</td>
            <td>{{ $product->name }}</td>
            <td>{{ $product->description }}</td>
            <td>{{ $product->price }}</td>
            <td>
                <input type="hidden" id="get_product_id" value="{{$product->id}}">
                <a href="{{ route('user.product.edit', $product->id)}}" class="btn btn-primary btn-sm me-2">Edit</a>
                <button type="button" class="btn btn-danger delete_product btn-sm me-2">Delete</button>
            </td>
        </tr>
        @endforeach
    </tbody>

</table>
@else
<div class="container">
    <div class="row">
        <div class="col-lg-12 col-sm-12 col-12 main-section">
            <h2 class="text-danger">There is no product here. Add to see products !</h2>
        </div>
    </div>
</div>
@endif
<script>
    $(document).ready(function() {


        $(document).on('click', '.delete_product', function(e) {
            e.preventDefault();

            var product_id = $(this).val();
            $('#get_product_id').val(product_id);
            $('#deleteModal').modal('show');
        });

        $(document).on('click', '.delete_product_btn', function(e) {
            e.preventDefault();
            var product_id = $('#get_product_id').val();
            
            $(this).text('Deleting..');

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: "DELETE",
                url: "{{ route('user.product.delete', $product->id)}}",
                dataType: "json",
                success: function(response) {
                    // console.log(response);
                    $('#success_message').html("");
                    $('#success_message').addClass('alert alert-success');
                    $('#success_message').text(response.message);
                    $('.delete_product_btn').text('Yes Delete');
                    $('#deleteModal').modal('hide');
                    setTimeout(function() {
                        location.reload();
                    }, 3000);
                }
            });
        });


    });
</script>
@endsection