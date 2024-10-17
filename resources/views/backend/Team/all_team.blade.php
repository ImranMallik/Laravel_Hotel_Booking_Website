@extends('admin.admin_dashboard')
@section('content')
    <div class="page-content">

        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">All Team</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <div class="btn-group">
                    <a href="{{ route('add.team') }}" class="btn btn-outline-primary px-5">+ Add Team</a>
                </div>
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
                                        @if (Auth::user()->can('team.edit'))
                                            <a href="{{ route('edit.team', $teams->id) }}"
                                                class="btn btn-info px-3 radius-30">Edit</a>
                                        @endif
                                        @if (Auth::user()->can('team.delete'))
                                            <a href="{{ route('delete.team', $teams->id) }}"
                                                class="btn btn-danger px-3 radius-30" id="deleteTeam">Delete</a>
                                        @endif
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
