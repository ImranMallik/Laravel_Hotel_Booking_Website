@extends('frontend.master')
@section('content')
    <!-- Inner Banner -->
    <div class="inner-banner inner-bg10">
        <div class="container">
            <div class="inner-title">
                <ul>
                    <li>
                        <a href="index.html">Home</a>
                    </li>
                    <li><i class="bx bx-chevron-right"></i></li>
                    <li>Room Details</li>
                </ul>
                <h3>{{ $roomDetails->type->name }}</h3>
            </div>
        </div>
    </div>
    <!-- Inner Banner End -->

    <!-- Room Details Area End -->
    <div class="room-details-area pt-100 pb-70">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="room-details-side">
                        <div class="side-bar-form">
                            <h3>Booking Sheet</h3>
                            <form>
                                <div class="row align-items-center">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>Check in</label>
                                            <div class="input-group">
                                                <input id="datetimepicker" type="text" class="form-control"
                                                    placeholder="09/29/2020" />
                                                <span class="input-group-addon"></span>
                                            </div>
                                            <i class="bx bxs-calendar"></i>
                                        </div>
                                    </div>

                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>Check Out</label>
                                            <div class="input-group">
                                                <input id="datetimepicker-check" type="text" class="form-control"
                                                    placeholder="09/29/2020" />
                                                <span class="input-group-addon"></span>
                                            </div>
                                            <i class="bx bxs-calendar"></i>
                                        </div>
                                    </div>

                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>Numbers of Persons</label>
                                            <select class="form-control">
                                                <option>01</option>
                                                <option>02</option>
                                                <option>03</option>
                                                <option>04</option>
                                                <option>05</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>Numbers of Rooms</label>
                                            <select class="form-control">
                                                <option>01</option>
                                                <option>02</option>
                                                <option>03</option>
                                                <option>04</option>
                                                <option>05</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-lg-12 col-md-12">
                                        <button type="submit" class="default-btn btn-bg-three border-radius-5">
                                            Book Now
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-lg-8">
                    <div class="room-details-article">
                        <div class="room-details-slider owl-carousel owl-theme">
                            @foreach ($multi_img as $mul_img)
                                <div class="room-details-item">
                                    <img src="{{ asset('upload/rooming/multi_img/' . $mul_img->multi_img) }}"
                                        alt="Images" />
                                </div>
                            @endforeach

                        </div>

                        <div class="room-details-title">
                            <h2>
                                {{ $roomDetails->type->name }}
                            </h2>
                            <ul>
                                <li>
                                    <b> Basic : ₹{{ $roomDetails->price }}/Night/Room</b>
                                </li>
                            </ul>
                        </div>

                        <div class="room-details-content">
                            <p>
                                {!! $roomDetails->long_desc !!}
                            </p>


                            <div class="side-bar-plan">
                                <h3>Basic Plan Facilities</h3>
                                <ul>
                                    @foreach ($facility as $item)
                                        <li><a href="#">{{ $item->facility_name }}</a></li>
                                    @endforeach

                                </ul>
                            </div>

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="services-bar-widget">
                                        <h3 class="title">Room Details</h3>
                                        <div class="side-bar-list">
                                            <ul>
                                                <li>
                                                    <a href="#">
                                                        <b>Capacity : </b> {{ $roomDetails->room_capacity }} Person
                                                        <i class="bx bxs-cloud-download"></i></a>
                                                </li>
                                                <li>
                                                    <a href="#">
                                                        <b>Size : </b> {{ $roomDetails->size }} ft2
                                                        <i class="bx bxs-cloud-download"></i></a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="services-bar-widget">
                                        <h3 class="title">Room Details</h3>
                                        <div class="side-bar-list">
                                            <ul>
                                                <li>
                                                    <a href="#">
                                                        <b>View : </b> {{ $roomDetails->view }}
                                                        <i class="bx bxs-cloud-download"></i></a>
                                                </li>
                                                <li>
                                                    <a href="#">
                                                        <b>Bad Style : </b> {{ strtoupper($roomDetails->bed_style) }}
                                                        <i class="bx bxs-cloud-download"></i></a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="room-details-review">
                            <h2>Clients Review and Retting's</h2>
                            <div class="review-ratting">
                                <h3>Your retting:</h3>
                                <i class="bx bx-star"></i>
                                <i class="bx bx-star"></i>
                                <i class="bx bx-star"></i>
                                <i class="bx bx-star"></i>
                                <i class="bx bx-star"></i>
                            </div>
                            <form>
                                <div class="row">
                                    <div class="col-lg-12 col-md-12">
                                        <div class="form-group">
                                            <textarea name="message" class="form-control" cols="30" rows="8" required data-error="Write your message"
                                                placeholder="Write your review here.... "></textarea>
                                        </div>
                                    </div>

                                    <div class="col-lg-12 col-md-12">
                                        <button type="submit" class="default-btn btn-bg-three">
                                            Submit Review
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Room Details Area End -->

    <!-- Room Details Other -->
    <div class="room-details-other pb-70">
        <div class="container">
            <div class="room-details-text">
                <h2>Our Other Room</h2>
            </div>

            <div class="row">
                @foreach ($otherRoom as $other)
                    <div class="col-lg-6">
                        <div class="room-card-two">
                            <div class="row align-items-center">
                                <div class="col-lg-5 col-md-4 p-0">
                                    <div class="room-card-img">
                                        <a href="{{ route('room-details', $other->id) }}">
                                            <img src="{{ asset('upload/rooming/' . $other->image) }}" alt="Images" />
                                        </a>
                                    </div>
                                </div>

                                <div class="col-lg-7 col-md-8 p-0">
                                    <div class="room-card-content">
                                        <h3>
                                            <a
                                                href="{{ route('room-details', $other->id) }}">{{ $other['type']['name'] }}</a>
                                        </h3>
                                        <span>₹{{ $other->price }} / Per Night </span>
                                        <div class="rating">
                                            <i class="bx bxs-star"></i>
                                            <i class="bx bxs-star"></i>
                                            <i class="bx bxs-star"></i>
                                            <i class="bx bxs-star"></i>
                                            <i class="bx bxs-star"></i>
                                        </div>
                                        <p>

                                        </p>
                                        <ul>
                                            <li><i class="bx bx-user"></i> {{ $other->room_capacity }} Person</li>
                                            <li><i class="bx bx-expand"></i> 35m2 / 376ft2</li>
                                        </ul>

                                        <ul>
                                            <li><i class="bx bx-show-alt"></i>{{ $other->view }}</li>
                                            <li><i class="bx bxs-hotel"></i>{{ $other->bed_style }}</li>
                                        </ul>

                                        <a href="room-details.html" class="book-more-btn">
                                            Book Now
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach


            </div>
        </div>
    </div>
    <!-- Room Details Other End -->
@endsection
