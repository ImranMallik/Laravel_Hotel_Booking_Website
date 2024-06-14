@php
    $id = Auth::user()->id;
    $profileData = App\Models\User::find($id);
@endphp
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
                            <h3 class="title">Edit Password</h3>
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
                                <form action="{{ route('password-update') }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="card-body">
                                        <div class="row mb-3">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Old Password</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                <input type="password" name="old_password"
                                                    class="form-control @error('old_password') is-invalid @enderror"
                                                    id="old_password" />
                                                @error('old_password')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">New Password</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                <input type="password" name="new_password"
                                                    class="form-control @error('new_password') is-invalid @enderror"
                                                    id="new_password" />
                                                @error('new_password')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-sm-3">
                                                <h6 class="mb-0">Confirm Password</h6>
                                            </div>
                                            <div class="col-sm-9 text-secondary">
                                                <input type="password" name="new_password_confirmation" class="form-control"
                                                    id="new_password_confirmation" />

                                            </div>
                                        </div>



                                        <div class="row">
                                            <div class="col-sm-3"></div>
                                            <div class="col-sm-9 text-secondary">
                                                <input type="submit" class="btn btn-primary px-4" value="Save Changes" />
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
