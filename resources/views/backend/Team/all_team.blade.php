@extends('admin.admin_dashboard')
@section('content')
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="ms-auto">
                <a href="{{ route('add.team') }}" class="btn btn-outline-primary px-5">+Add Team</a>
            </div>

        </div>
        <!--end breadcrumb-->
        <h6 class="mb-0 text-uppercase">All Team</h6>
        <hr />
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>Sl No</th>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Position</th>
                                <th>Facebook</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($team as $index => $teams)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>
                                        <img src="{{ asset($teams->image) }}" alt="img"
                                            style="width: 70px; height: 40px;">
                                    </td>
                                    <td>{{ $teams->name }}</td>
                                    <td>{{ $teams->position }}</td>
                                    <td>{{ $teams->facebook }}</td>
                                    <td>
                                        <a href="{{ route('edit.team', $teams->id) }}"
                                            class="btn btn-info px-3 radius-30">Edit</a>
                                        <a href="{{ route('delete.team', $teams->id) }}"
                                            class="btn btn-danger px-3 radius-30" id="deleteTeam">Delete</a>
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
@endsection
