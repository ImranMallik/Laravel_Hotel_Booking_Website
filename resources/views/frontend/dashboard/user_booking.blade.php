@extends('frontend.master')
@section('content')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <!-- Inner Banner -->
    <style>
        .table-custom thead th {
            background-color: #343a40;
            color: #fff;
        }

        .table-custom tbody tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .badge-check-in {
            background-color: #007bff;
            color: #fff;
        }

        .badge-check-out {
            background-color: #ffc107;
            color: #000;
        }
    </style>
    <div class="inner-banner inner-bg6">
        <div class="container">
            <div class="inner-title">
                <ul>
                    <li>
                        <a href="index.html">Home</a>
                    </li>
                    <li><i class="bx bx-chevron-right"></i></li>
                    <li>User Dashboard</li>
                </ul>
                <h3>User Dashboard</h3>
            </div>
        </div>
    </div>
    <!-- Inner Banner End -->

    <!-- Service Details Area -->
    <div class="service-details-area pt-100 pb-70">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    @include('frontend.dashboard.dashboard_menu')
                </div>

                <div class="col-lg-9">
                    <div class="service-article">
                        <section class="checkout-area pb-70">
                            <div class="container">
                                <form action="{{ route('password-update') }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12">
                                            <div class="billing-details">
                                                <h3 class="title">User Booking List </h3>



                                                <div class="container mt-4">
                                                    <table class="table table-striped table-custom">
                                                        <thead>
                                                            <tr>
                                                                <th scope="col">B No</th>
                                                                <th scope="col">B Date</th>
                                                                <th scope="col">Customer</th>
                                                                <th scope="col">Room</th>
                                                                <th scope="col">Check In/Out</th>
                                                                <th scope="col">Total Room</th>
                                                                <th scope="col">Status</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($allData as $item)
                                                                <tr>
                                                                    <td> <a
                                                                            href="{{ route('user.invoice', $item->id) }}">{{ $item->code }}</a>
                                                                    </td>
                                                                    <td>{{ $item->created_at->format('d/m/Y') }}</td>
                                                                    <td>{{ $item['user']['name'] }}</td>
                                                                    <td>{{ $item['room']['type']['name'] }}</td>
                                                                    <td>
                                                                        <span
                                                                            class="badge badge-check-in">{{ $item->check_in }}</span>
                                                                        <span
                                                                            class="badge badge-check-out">{{ $item->check_out }}</span>
                                                                    </td>
                                                                    <td>{{ $item->number_of_rooms }}</td>
                                                                    <td>
                                                                        @if ($item->status == 1)
                                                                            <span
                                                                                class="badge bg-success text-dark">Complete</span>
                                                                        @else
                                                                            <span
                                                                                class="badge bg-warning text-dark">Pending</span>
                                                                        @endif
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>



                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Service Details Area End -->

    <script type="text/javascript">
        $(document).ready(function() {
            $('#image').change(function(e) {
                let render = new FileReader();
                render.onload = function(e) {
                    $('#showImage').attr('src', e.target.result);
                }
                render.readAsDataURL(e.target.files['0']);
            });
        });
    </script>
@endsection
