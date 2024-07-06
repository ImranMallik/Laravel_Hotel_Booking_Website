@extends('admin.admin_dashboard')
@section('content')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Add Room List</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Add Room List</li>
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
                            <div class="card-body p-4">


                                <form class="row g-3">
                                    <div class="col-md-4">
                                        <label for="input1" class="form-label">Room Type</label>
                                        <select id="input7" name="room_id" class="form-select">
                                            <option selected="">Select Room Type </option>
                                            @foreach ($roomtype as $item)
                                                <option value="{{ $item->room->id }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="input2" class="form-label">Checkin</label>
                                        <input type="text" class="form-control" id="input2" placeholder="Last Name">
                                    </div>

                                    <div class="col-md-4">
                                        <label for="input2" class="form-label">CheckOut</label>
                                        <input type="text" class="form-control" id="input2" placeholder="Last Name">
                                    </div>

                                    <div class="col-md-4">
                                        <label for="input4" class="form-label">Room</label>
                                        <input type="text" name="number_of_room" class="form-control" id="input4">
                                        <input type="hidden" name="available_room" class="form-control">
                                        <div class="mt-2">
                                            <label for="">Availability <span
                                                    class="text-success availability"></span> </label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="input4" class="form-label">Guest</label>
                                        <input type="text" name="number_of_person" class="form-control"
                                            id="number_of_person">
                                    </div>
                                    <h3 class="mt-3 mb-5 text-center">Customer Information </h3>
                                    <div class="col-md-4">
                                        <label for="input5" class="form-label">Name</label>
                                        <input type="text" name="name" class="form-control" id="input5"
                                            value="{{ old('name') }}">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="input5" class="form-label">Email</label>
                                        <input type="email" name="email" class="form-control"
                                            value="{{ old('email') }}">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="input5" class="form-label">Phone</label>
                                        <input type="text" name="phone" class="form-control"
                                            value="{{ old('phone') }}">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="input5" class="form-label">Country</label>
                                        <input type="text" name="country" class="form-control"
                                            value="{{ old('country') }}">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="input5" class="form-label">Zip Code</label>
                                        <input type="text" name="zip_code" class="form-control"
                                            value="{{ old('zip_code') }}">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="input5" class="form-label">State</label>
                                        <input type="text" name="state" class="form-control"
                                            value="{{ old('state') }}">
                                    </div>

                                    <div class="col-md-12">
                                        <label for="input11" class="form-label">Address</label>
                                        <textarea name="address" class="form-control" rows="3">{{ old('address') }}</textarea>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="d-md-flex d-grid align-items-center gap-3">
                                            <button type="submit" class="btn btn-primary px-4">Submit</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>



                    </div>
                </div>
            </div>
        </div>
    </div>


    <script type="text/javascript">
        $(document).ready(function() {
            $('#myForm').validate({
                rules: {
                    name: {
                        required: true,
                    },
                    postion: {
                        required: true,
                    },
                    facebook: {
                        required: true,
                    },
                    image: {
                        required: true,
                    },

                },
                messages: {
                    name: {
                        required: 'Please Enter Team Name',
                    },
                    postion: {
                        required: 'Please Enter Team Postion',
                    },
                    facebook: {
                        required: 'Please Enter Facebook Url',
                    },
                    image: {
                        required: 'Please Select Image',
                    },


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
    </script>
@endsection
