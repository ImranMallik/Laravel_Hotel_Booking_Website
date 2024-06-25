@extends('frontend.master')
@section('content')
    <!-- Banner Area -->
    <div class="banner-area" style="height: 480px">
        <div class="container">
            <div class="banner-content">
                <h1>Discover a Hotel & Resort to Book a Suitable Room</h1>
            </div>
        </div>
    </div>
    <!-- Banner Area End -->

    <!-- Banner Form Area -->
    <div class="banner-form-area">
        <div class="container">
            <div class="banner-form">
                <form method="GET" action="{{ route('booking.search') }}">
                    @csrf
                    <div class="row align-items-center">
                        <div class="col-lg-3 col-md-3">
                            <div class="form-group">
                                <label>CHECK IN TIME</label>
                                <div class="input-group">
                                    <input autocomplete="off" required name="check_in" type="text"
                                        class="form-control dt_picker" placeholder="YY-MM-DD" />
                                    <span class="input-group-addon"></span>
                                </div>
                                <i class="bx bxs-chevron-down"></i>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-3">
                            <div class="form-group">
                                <label>CHECK OUT TIME</label>
                                <div class="input-group">
                                    <input autocomplete="off" required name="check_out" type="text"
                                        class="form-control dt_picker" placeholder="YY-MM-DD" />
                                    <span class="input-group-addon"></span>
                                </div>
                                <i class="bx bxs-chevron-down"></i>
                            </div>
                        </div>

                        <div class="col-lg-2 col-md-2">
                            <div class="form-group">
                                <label>GUESTS</label>
                                <select name="persion" class="form-control">
                                    <option>01</option>
                                    <option>02</option>
                                    <option>03</option>
                                    <option>04</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-4">
                            <button type="submit" class="default-btn btn-bg-one border-radius-5">
                                Check Availability
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Banner Form Area End -->

    @include('frontend.home.home_area')

    @include('frontend.home.home_area_two')

    @include('frontend.home.services')

    @include('frontend.home.team')

    @include('frontend.home.testimonial')

    @include('frontend.home.faq')

    @include('frontend.home.blog')
@endsection
