@extends('admin.admin_dashboard')
@section('content')
    <div class="page-content">

        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">All Room List</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <div class="btn-group">
                    <a href="{{ route('add.room-list') }}" class="btn btn-outline-primary px-5">+ Add Room</a>
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
                                <th>Room Type</th>
                                <th>Room Number</th>
                                <th>B Status</th>
                                <th>In/Out Date</th>
                                <th>Booking Num</th>
                                <th>Customer</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($room_number_list as $index => $teams)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>
                                        {{ @$teams->name }}
                                    </td>
                                    <td>{{ @$teams->room_no }}</td>
                                    <td>
                                        @if ($teams->booking_id != '')
                                            @if ($teams->booking_stauts == 1)
                                                <span class="badge bg-danger">Booked</span>
                                            @else
                                                <span class="badge bg-warning">Pending</span>
                                            @endif
                                        @else
                                            <span class="badge bg-success">Available</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($teams->booking_id != '')
                                            <span class="badge rounded-pill bg-secondary">
                                                {{ date('d-m-Y', strtotime($teams->check_in)) }}
                                            </span>
                                            to
                                            <span class="badge rounded-pill bg-info text-dark">
                                                {{ date('d-m-Y', strtotime($teams->check_out)) }}
                                            </span>
                                        @endif
                                    </td>
                                    {{-- <td>{{ $teams->facebook }}</td> --}}
                                    <td>
                                        @if ($teams->booking_id != '')
                                            {{ $teams->booking_no }}
                                        @endif
                                    </td>

                                    <td>
                                        @if ($teams->booking_id != '')
                                            {{ $teams->customer_name }}
                                        @endif
                                    </td>

                                    <td>
                                        @if ($teams->status == 'Active')
                                            <span class="badge bg-success">Published</span>
                                        @else
                                            <span class="badge bg-danger">InActive</span>
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
