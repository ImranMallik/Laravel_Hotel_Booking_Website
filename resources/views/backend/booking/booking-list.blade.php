@extends('admin.admin_dashboard')
@section('content')
    <div class="page-content">
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">All Booking</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <div class="btn-group">
                    <a href="{{ route('add.team') }}" class="btn btn-outline-primary px-5">+ Add Booking</a>
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
                                <th>B No</th>
                                <th>B Date</th>
                                <th>Coustomer</th>
                                <th>Room</th>
                                <th>Check In/Out</th>
                                <th>Total Room</th>
                                <th>Guest</th>
                                <th>Payment Method</th>
                                <th>Payment</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($bookingRoom as $index => $teams)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td><a href="{{ route('edit.booking', $teams->id) }}"> {{ $teams->code }}</a></td>
                                    <td>{{ $teams->created_at->format('d/m/Y') }}</td>
                                    <td>{{ $teams['user']['name'] }}</td>
                                    <td>{{ $teams['room']['type']['name'] }}</td>
                                    <td><span class="badge bg-primary text-dark">{{ $teams->check_in }}</span> /<br>
                                        <span class="badge bg-warning text-dark">{{ $teams->check_out }}</span>
                                    </td>
                                    <td>{{ $teams->number_of_rooms }}</td>
                                    <td>{{ $teams->person }}</td>
                                    <td>{{ $teams->payment_method }}</td>
                                    <td>
                                        @if ($teams->payment_status == '1')
                                            <span class="text-success">Complete</span>
                                        @else
                                            <span class="text-danger">Pending</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($teams->status == '1')
                                            <span class="text-success">Complete</span>
                                        @else
                                            <span class="text-danger">Pending</span>
                                        @endif
                                    </td>
                                    <td>

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
