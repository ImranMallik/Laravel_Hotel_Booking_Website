@extends('admin.admin_dashboard')

@section('content')
    <div class="page-content">
        <div class="row row-cols-1 row-cols-md-2 row-cols-xl-5">
            <div class="col">
                <div class="card radius-10 border-start border-0 border-4 border-info">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <p class="mb-0 text-secondary">Booking No:</p>
                                <h4 class="my-1 text-info">{{ $editData->code }}</h4>
                            </div>
                            <div class="widgets-icons-2 rounded-circle bg-gradient-blues text-white ms-auto"><i
                                    class='bx bxs-cart'></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card radius-10 border-start border-0 border-4 border-danger">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <p class="mb-0 text-secondary">Booking Date:</p>
                                <h4 class="my-1 text-danger">
                                    {{ \Carbon\Carbon::parse($editData->created_at)->format('d/m/Y') }}</h4>
                            </div>
                            <div class="widgets-icons-2 rounded-circle bg-gradient-burning text-white ms-auto">
                                <i class='bx bxs-wallet'></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card radius-10 border-start border-0 border-3 border-success">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <p class="mb-0 text-secondary">Payment Method</p>
                                <h4 class="my-1 text-success">
                                    {{ $editData->payment_method }}
                                </h4>
                            </div>
                            <div class="widgets-icons-2 rounded-circle bg-gradient-ohhappiness text-white ms-auto">
                                <i class='bx bxs-bar-chart-alt-2'></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card radius-10 border-start border-0 border-4 border-warning">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <p class="mb-0 text-secondary">Payment Status</p>
                                <h4 class="my-1 text-warning">
                                    @if ($editData->payment_status == '1')
                                        <span class="text-success">Complete</span>
                                    @else
                                        <span class="text-danger">Pending</span>
                                    @endif
                                </h4>
                            </div>
                            <div class="widgets-icons-2 rounded-circle bg-gradient-orange text-white ms-auto">
                                <i class='bx bxs-group'>
                                </i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card radius-10 border-start border-0 border-4 border-warning">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <p class="mb-0 text-secondary">Booking Status</p>
                                <h4 class="my-1 text-warning">
                                    @if ($editData->status == '1')
                                        <span class="text-success">Complete</span>
                                    @else
                                        <span class="text-danger">Pending</span>
                                    @endif
                                </h4>
                            </div>
                            <div class="widgets-icons-2 rounded-circle bg-gradient-orange text-white ms-auto">
                                <i class='bx bxs-group'></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!--end row-->

        <div class="row">
            <div class="col-12 col-lg-8 d-flex">
                <div class="card radius-10 w-100">

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table aling-middle mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th>Room Type</th>
                                        <th>Total Room</th>
                                        <th>Price</th>
                                        <th>Check In / Out Date</th>
                                        <th>Total Days</th>
                                        <th>Total Price</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>{{ $editData->room->type->name }}</td>
                                        <td>{{ $editData->number_of_rooms }}</td>
                                        <td>₹{{ $editData->actual_price }}</td>
                                        <td><span class="badge bg-primary text-dark">{{ $editData->check_in }}</span> /<br>
                                            <span class="badge bg-warning text-dark">{{ $editData->check_out }} </span>
                                        </td>
                                        <td>{{ $editData->total_night }}</td>
                                        <td>₹{{ $editData->actual_price * $editData->number_of_rooms }}</td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="col-md-6" style="float: right;">
                                <style>
                                    .test_table td {
                                        text-align: right;

                                    }
                                </style>
                                <table class="table test_table" style="float: right;">
                                    <tr>
                                        <td>SubTotal:</td>
                                        <td>₹{{ $editData->subtotal }}</td>
                                    </tr>
                                    <tr>
                                        <td>Discount:</td>
                                        <td>₹{{ $editData->discount }}</td>
                                    </tr>
                                    <tr>
                                        <td>Grand Total:</td>
                                        <td>₹{{ $editData->total_price }}</td>
                                    </tr>
                                </table>
                            </div>
                            <div style="clear: both"></div>
                            <div style="margin-top: 40px; margin-bottom:20px;">
                                <a href="javascript:void(0)" class="btn btn-primary assign_room">Assign Room</a>

                                @php
                                    $assign_room = App\Models\BookingRoomList::with('room_number')
                                        ->where('booking_id', $editData->id)
                                        ->get();
                                @endphp
                                @if (count($assign_room) > 0)
                                    <table class="table table-bordered mt-2">
                                        <tr>
                                            <th>Room Number</th>
                                            <th>Action</th>
                                        </tr>
                                        @foreach ($assign_room as $ass_room)
                                            <tr>
                                                <td>{{ $ass_room->room_number->room_no }}</td>
                                                <td><a href="{{ route('assing_room_delele', $ass_room->id) }}"
                                                        id="deleteTeam" class="btn btn-danger">Delete</a></td>
                                            </tr>
                                        @endforeach
                                    </table>
                                @else
                                    <div class="alert alert-danger text-center mt-2">Not Found Assign Room</div>
                                @endif
                            </div>
                        </div>
                        <form action="{{ route('update.booking.status', $editData->id) }} " method="POST">
                            @csrf

                            <div class="row" style="margin-top: 40px;">
                                <div class="col-md-5">
                                    <label for="">Payment Status</label>
                                    <select name="payment_status" id="input7" class="form-select">
                                        <option selected="">Select Status..</option>
                                        <option value="0" {{ $editData->payment_status == 0 ? 'selected' : '' }}>
                                            Pending </option>
                                        <option value="1" {{ $editData->payment_status == 1 ? 'selected' : '' }}>
                                            Complete
                                        </option>
                                    </select>
                                </div>


                                <div class="col-md-5">
                                    <label for="">Booking Status</label>
                                    <select name="status" id="input7" class="form-select">
                                        <option selected="">Select Status..</option>
                                        <option value="0" {{ $editData->status == 0 ? 'selected' : '' }}> Pending
                                        </option>
                                        <option value="1" {{ $editData->status == 1 ? 'selected' : '' }}>Complete
                                        </option>
                                    </select>
                                </div>

                                <div class="col-md-12" style="margin-top: 20px;">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>

                            </div>


                        </form>


                    </div>

                </div>
            </div>
            <div class="col-12 col-lg-4 ">
                <div class="card radius-10 w-100">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <div>
                                <h6 class="mb-0">Manage Room and Date</h6>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('update.booking', $editData->id) }}">
                            @csrf
                            <div class="row">
                                <div class="col-md-12 mb-2">
                                    <label for="check_in">Check-In</label>
                                    <input type="date" id="check_in" name="check_in" class="form-control"
                                        value="{{ $editData->check_in }}" required>
                                </div>

                                <div class="col-md-12 mb-2">
                                    <label for="check_out">Check-Out</label>
                                    <input type="date" id="check_out" name="check_out" class="form-control"
                                        value="{{ $editData->check_out }}" required>
                                </div>

                                <div class="col-md-12 mb-2">
                                    @php
                                        $roomsNumbers = App\Models\RoomNumber::where(
                                            'room_id',
                                            $editData->rooms_id,
                                        )->get();
                                        $roomsCount = $roomsNumbers->count();
                                    @endphp
                                    <label for="number_of_rooms">Number of Rooms</label>
                                    <input type="number" id="number_of_rooms" name="number_of_rooms"
                                        class="form-control" value="{{ $editData->number_of_rooms }}" required
                                        max="{{ $roomsCount }}">
                                </div>

                                <div class="col-md-12 mb-2">
                                    @php
                                        // $roomsNumbers = App\Models\RoomNumber::where(
                                        //     'room_id',
                                        //     $editData->rooms_id,
                                        // )->get();
                                        // $roomsCount = $roomsNumbers->count();
                                        $roomsNumbers = App\Models\RoomNumber::where(
                                            'room_id',
                                            $editData->rooms_id,
                                        )->get();
                                        $roomsCount = $roomsNumbers->count();

                                        // Fetch the booking count for these room numbers
                                        $bookroomCount = App\Models\BookingRoomList::whereIn(
                                            'room_id',
                                            $roomsNumbers->pluck('room_id'),
                                        )->count();

                                        // Calculate availability
                                        $availability = $roomsCount - $bookroomCount;
                                    @endphp
                                    <label>Availability: <span
                                            class="text-success availability">{{ $availability }}</span></label>
                                </div>

                                <div class="col-md-12 mb-2">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="card radius-10 w-100">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <div>
                                <h6 class="mb-0">Customer Infromation </h6>
                            </div>

                        </div>
                    </div>
                    <div class="card-body">
                        <ul class="list-group list-group-flush">
                            <li
                                class="list-group-item d-flex bg-transparent justify-content-between align-items-center border-top">
                                Name <span class="badge bg-success rounded-pill">{{ $editData['user']['name'] }}</span>
                            </li>
                            <li class="list-group-item d-flex bg-transparent justify-content-between align-items-center">
                                Email
                                <span class="badge bg-danger rounded-pill">{{ $editData['user']['email'] }} </span>
                            </li>
                            <li class="list-group-item d-flex bg-transparent justify-content-between align-items-center">
                                Phone
                                <span class="badge bg-primary rounded-pill">{{ $editData['user']['phone'] }}</span>
                            </li>
                            <li class="list-group-item d-flex bg-transparent justify-content-between align-items-center">
                                Country <span
                                    class="badge bg-warning text-dark rounded-pill">{{ $editData->country }}</span>
                            </li>

                            <li
                                class="list-group-item d-flex bg-transparent justify-content-between align-items-center border-top">
                                State <span class="badge bg-success rounded-pill">{{ $editData->state }}</span>
                            </li>
                            <li class="list-group-item d-flex bg-transparent justify-content-between align-items-center">
                                Zip
                                Code <span class="badge bg-danger rounded-pill"> {{ $editData->zip_code }} </span>
                            </li>
                            <li class="list-group-item d-flex bg-transparent justify-content-between align-items-center">
                                Address <span class="badge bg-danger rounded-pill"> {{ $editData->address }} </span>
                            </li>


                        </ul>


                    </div>

                </div>
            </div>
        </div><!--end row-->





    </div>
    <div class="modal fade myModal" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Rooms</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                </div>

            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $(".assign_room").on('click', function() {
                $.ajax({
                    url: "{{ route('assing_room', $editData->id) }}",
                    method: 'POST',
                    success: function(data) {
                        $('.myModal .modal-body').html(data);
                        $('.myModal').modal('show');
                    }
                });
                return false;
            });
        });
    </script>
@endsection
