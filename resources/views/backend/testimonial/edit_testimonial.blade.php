@extends('admin.admin_dashboard')
@section('content')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item">
                            <a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Edit Testimonial
                        </li>
                    </ol>
                </nav>
            </div>

        </div>
        <!--end breadcrumb-->
        <div class="container">
            <div class="main-body">
                <div class="row">

                    <div class="col-lg-12">
                        <div class="card">
                            <form id="myForm" action="{{ route('submit.testimonial', $id->id) }}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Name</h6>
                                        </div>
                                        <div class="col-sm-9 form-group text-secondary">
                                            <input type="text" name="name" class="form-control"
                                                value="{{ $id->name }}" />
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">City</h6>
                                        </div>
                                        <div class="col-sm-9 form-group text-secondary">
                                            <input type="text" class="form-control" name="city"
                                                value="{{ $id->city }}" />
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Message</h6>
                                        </div>
                                        <div class="col-sm-9 form-group text-secondary">
                                            <textarea name="message" class="form-control" placeholder="Leave a Message here" id="floatingTextarea2"
                                                style="height: 100px">{{ $id->message }}</textarea>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Image</h6>
                                        </div>
                                        <div class="col-sm-9 form-group text-secondary">
                                            <input type="file" name="image" class="form-control" id="image" />
                                        </div>

                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0"> </h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <img id="showImage" src="{{ asset($id->image) }}" alt="Admin"
                                                class="rounded-circle p-1 bg-primary" width="80">

                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-3"></div>
                                        <div class="col-sm-9 text-secondary">
                                            <input type="submit" class="btn btn-primary px-4" value="Update Changes" />
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

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
