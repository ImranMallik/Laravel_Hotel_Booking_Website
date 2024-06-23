@extends('admin.admin_dashboard')
@section('content')
    <div class="page-content">
        <!--breadcrumb-->

        <!--end breadcrumb-->

        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Room Type List</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <div class="btn-group">
                    <a href="{{ route('add.room-type') }}" class="btn btn-outline-primary px-5">+ Add Room Team</a>
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
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($alldata as $index => $item)
                                {{-- @dd($item) --}}
                                @php
                                    $rooms = App\Models\Room::where('room_type_id', $item->id)->get();
                                    // @dd($rooms);
                                @endphp
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>
                                        <img src="{{ !empty($item->room->image) ? url('upload/rooming/' . $item->room->image) : url('upload/no_image.jpg') }}"
                                            alt="" style="width: 50px;height:50px">
                                    </td>
                                    <td>{{ $item->name }}</td>
                                    <td>
                                        @foreach ($rooms as $roo)
                                            <a href="{{ route('edit.room', $roo->id) }}"
                                                class="btn btn-info px-3 radius-30">Edit</a>
                                            <a href="{{ route('delete.room-type', $roo->id) }}"
                                                class="btn btn-danger px-3 radius-30" id="deleteTeam">Delete</a>
                                        @endforeach
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
