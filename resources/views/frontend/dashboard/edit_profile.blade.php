@extends('frontend.master')
@section('content')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <!-- Inner Banner -->
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
                    <div class="service-side-bar">
                        <div class="services-bar-widget">
                            <h3 class="title">Edit Profile</h3>
                            <div class="side-bar-categories">
                                <img src=" {{ !empty($profileData->photo) ? url('upload/admin_images/' . $profileData->photo) : url('upload/no_image.jpg') }}"
                                    alt="Admin" class="rounded mx-auto d-block" width="110"
                                    style="height: 110px; width:110px" />
                                <center>
                                    <b>
                                        <p>{{ $profileData->name }}</p>
                                    </b>
                                    <b>
                                        <p>{{ $profileData->email }}</p>
                                    </b>
                                </center>
                                <br /><br />


                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-9">
                    <div class="service-article">
                        <section class="checkout-area pb-70">
                            <div class="container">
                                <form action="{{ route('profile.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12">
                                            <div class="billing-details">
                                                <h3 class="title">User Profile</h3>

                                                <div class="row">
                                                    <div class="col-lg-6 col-md-6">
                                                        <div class="form-group">
                                                            <label>User Name
                                                                <span class="required">*</span></label>
                                                            <input type="text" name="name"
                                                                value="{{ $profileData->name }}" class="form-control" />
                                                        </div>
                                                    </div>


                                                    <div class="col-lg-6 col-md-6">
                                                        <div class="form-group">
                                                            <label>Email Address
                                                                <span class="required">*</span></label>
                                                            <input type="email" name="email"
                                                                value="{{ $profileData->email }}" class="form-control" />
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-md-6">
                                                        <div class="form-group">
                                                            <label> Address
                                                                <span class="required">*</span></label>
                                                            <input type="text" name="address"
                                                                value="{{ $profileData->address }}" class="form-control" />
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-6 col-md-6">
                                                        <div class="form-group">
                                                            <label>Phone <span class="required">*</span></label>
                                                            <input type="text" name="phone"
                                                                value="{{ $profileData->phone }}" class="form-control" />
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-12 col-md-6">
                                                        <div class="form-group">
                                                            <label>User Profile
                                                                <span class="required">*</span></label>
                                                            <input type="file" name="photo" id="image"
                                                                class="form-control" />
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-12 col-md-6">
                                                        <div class="form-group">
                                                            <label><span class="required"></span></label>
                                                            <img id="showImage"
                                                                src=" {{ !empty($profileData->photo) ? url('upload/admin_images/' . $profileData->photo) : url('upload/no_image.jpg') }}"
                                                                alt="Admin" class="rounded-circle p-1 bg-primary"
                                                                width="80" />
                                                        </div>
                                                    </div>

                                                    <button type="submit" class="btn btn-danger">
                                                        Save Changes
                                                    </button>
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
