@extends('admin.admin_dashboard')
@section('content')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Add Book Area</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item">
                            <a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Add Book Area
                        </li>
                    </ol>
                </nav>
            </div>

        </div>
        <!--end breadcrumb-->
        <div class="container">
            <div class="main-body">
                <div class="row">

                    <div class="col-lg-8">
                        <div class="card">
                            <form id="myForm" action="{{ route('update.book-area', $bookarea->id) }}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Short Title</h6>
                                        </div>
                                        <div class="col-sm-9 form-group text-secondary">
                                            <input type="text" name="short_title" value="{{ $bookarea->short_title }}"
                                                class="form-control" value="" />
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Main Title</h6>
                                        </div>
                                        <div class="col-sm-9 form-group text-secondary">
                                            <input type="text" class="form-control" name="main_title"
                                                value="{{ $bookarea->main_title }}" />
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Short Description</h6>
                                        </div>
                                        <div class="col-sm-9 form-group text-secondary">
                                            <textarea class="form-control" id="input40" name="short_desc" rows="3" placeholder="Description">{{ $bookarea->short_desc }}</textarea>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Link URL</h6>
                                        </div>
                                        <div class="col-sm-9 form-group text-secondary">
                                            <input type="text" class="form-control" value="{{ $bookarea->link_url }}"
                                                name="link_url" value="" />
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Photo</h6>
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
                                            <img id="showImage"
                                                src=" {{ !empty($bookarea->image) ? url('upload/bookarea/' . $bookarea->image) : url('upload/no_image.jpg') }}"
                                                alt="Admin" class="rounded-circle p-1 bg-primary" width="80" />

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
    {{-- <script type="text/javascript">
        $(document).ready(function() {
            $('#myForm').validate({
                rules: {
                    short_title: {
                        required: true,
                    },
                    main_title: {
                        required: true,
                    },
                    short_desc: {
                        required: true,
                    },
                    link_url: {
                        required: true,
                    },
                    image: {
                        required: true,
                    }

                },
                messages: {
                    short_title: {
                        required: 'Please Enter Short Title',
                    },
                    main_title: {
                        required: 'Please Enter Main Title',
                    },
                    short_desc: {
                        required: 'Please Enter Short Deccription',
                    },
                    link_url: {
                        required: 'Please Enter Link Url',
                    },
                    image: {
                        required: 'Please Enter Image'
                    }


                },
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                },
            });
        });
    </script> --}}
@endsection
