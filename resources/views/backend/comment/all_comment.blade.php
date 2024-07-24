@extends('admin.admin_dashboard')
@section('content')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    @php
        use Illuminate\Support\Str;
    @endphp

    <div class="page-content">

        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">All Comments</li>
                    </ol>
                </nav>
            </div>
        </div>
        <hr />
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>Sl No</th>
                                <th>User Name</th>
                                <th>Post Name</th>
                                <th>Message</th>
                                <th>Status</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($data as $index => $teams)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $teams['user']['name'] }}</td>
                                    <td>{{ Str::limit($teams['post']['post_titile'], 20) }}</td>
                                    <td>{{ Str::limit($teams->message, 20) }}</td>
                                    {{-- <td>{{ $teams->message }}</td> --}}
                                    <td>
                                        <div class="form-check-danger form-check form-switch">
                                            <input class="form-check-input status-toggle large-checkbox" type="checkbox"
                                                id="flexSwitchCheckCheckedDanger" data-comment-id="{{ $teams->id }}"
                                                {{ $teams->status ? 'checked' : '' }}>
                                            <label class="form-check-label" for="flexSwitchCheckCheckedDanger"> </label>
                                        </div>

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <hr />
    </div>

    <script>
        $(document).ready(function() {
            $('.status-toggle').change(function() {
                var commentId = $(this).data('comment-id');
                var status = $(this).is(':checked') ? 1 : 0;

                $.ajax({
                    url: '{{ route('update.comment.status') }}',
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        id: commentId,
                        status: status
                    },
                    success: function(response) {
                        toastr.success(response.message);
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                        alert('Error updating status');
                    }
                });
            });
        });
    </script>
@endsection
