@extends('user.layout.index')
@section('title', 'User Profile Page')
@section('content')

<div class="container">

    <h2 class="bg-primary p-3 text-light text-center">Ajex With Laravel</h2>
</div>
<div class="mt-5" id="success_message"></div>
<div class="modal fade" id="userDeleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    @csrf
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3 p-2">
                    <input type="hidden" id="delete_user_id" value="{{$users->id}}">
                    <h4>Are Yoys Sure? You want to Delete This Product</h4>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary delete_user_btn">Yes Delete</button>
            </div>
        </div>
    </div>
</div>
<table class="container table table-bordered mt-3">

    <thead>
        <tr>
            <th>Username</th>
            <th>Email</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>{{ $users->username }}</td>
            <td>{{ $users->email }}</td>
            <td>
                <input type="hidden" id="get_user_id" value="{{$users->id}}">
                <a href="{{ route('user.user_profile.edit', $users->id)}}" class="btn btn-primary btn-sm me-2">Edit</a>
                <button type="button" class="btn btn-danger delete_user btn-sm me-2">Delete</button>
            </td>
        </tr>
    </tbody>

</table>

<script>
    $(document).ready(function() {

        $(document).on('click', '.delete_user', function(e) {
            e.preventDefault();

            var user_id = $(this).val();
            $('#delete_user_id').val(user_id);
            $('#userDeleteModal').modal('show');
        });

        $(document).on('click', '.delete_user_btn', function(e) {
            e.preventDefault();
            var user_id = $('#delete_user_id').val();
            $(this).text('Deleting..');

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: "DELETE",
                url: "{{ route('user.user_profile.delete', $users->id)}}",
                dataType: "json",
                success: function(response) {
                    // console.log(response);
                    $('#success_message').html("");
                    $('#success_message').addClass('alert alert-success');
                    $('#success_message').text(response.message);
                    $('.delete_user_btn').text('Yes Delete');
                    $('#userDeleteModal').modal('hide');
                    setTimeout(function() {
                        location.reload();
                    }, 6000);
                }
            });
        });
    });
</script>
@endsection