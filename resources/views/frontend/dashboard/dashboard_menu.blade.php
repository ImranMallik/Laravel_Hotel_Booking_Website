@php
    $id = Auth::user()->id;
    $profileData = App\Models\User::find($id);
@endphp

<div class="service-side-bar">
    <div class="services-bar-widget">
        <h3 class="title">User Sidebar</h3>
        <div class="side-bar-categories">
            <img src=" {{ !empty($profileData->photo) ? url('upload/admin_images/' . $profileData->photo) : url('upload/no_image.jpg') }}"
                alt="Admin" class="rounded mx-auto d-block" width="110" style="height: 110px; width:110px" />
            <center>
                <b>
                    <p>{{ $profileData->name }}</p>
                </b>
                <b>
                    <p>{{ $profileData->email }}</p>
                </b>
            </center>

            <br /><br />


            <ul>
                <li>
                    <a href="{{ route('dashboard') }}">User Dashboard</a>
                </li>
                <li>
                    <a href="{{ route('user.profile') }}">User Profile </a>
                </li>
                <li>
                    <a href="{{ route('edit.password') }}">Change Password</a>
                </li>
                <li>
                    <a href="#">Booking Details </a>
                </li>
                <li>
                    <a href="{{ route('user.logout') }}">Logout </a>
                </li>
            </ul>
        </div>
    </div>
</div>
