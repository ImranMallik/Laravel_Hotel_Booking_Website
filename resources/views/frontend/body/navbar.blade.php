@php
    $setting = App\Models\SiteSetting::find(1);
@endphp
<div class="navbar-area">
    <!-- Menu For Mobile Device -->
    <div class="mobile-nav">
        <a href="{{ route('dashboard') }}" class="logo">
            {{-- <img src="assets/img/logos/logo-1.png" class="logo-one" alt="Logo" />
            <img src="assets/img/logos/footer-logo1.png" class="logo-two" alt="Logo" /> --}}
            <img src="{{ asset($setting->logo) }}" class="logo-one" alt="Logo">
            <img src="{{ asset($setting->logo) }}" class="logo-two" alt="Logo">
        </a>
    </div>

    <!-- Menu For Desktop Device -->
    <div class="main-nav">
        <div class="container">
            <nav class="navbar navbar-expand-md navbar-light">
                <a class="navbar-brand" href="{{ route('index') }}">
                    {{-- <img src="{{ asset('Frontend/assets/img/logos/logo-1.png') }}" class="logo-one" alt="Logo" />
                    <img src="{{ asset('Frontend/assets/img/logos/footer-logo1.png') }}" class="logo-two"
                        alt="Logo" /> --}}
                    <img src="{{ asset($setting->logo) }}" class="logo-one" alt="Logo">
                    <img src="{{ asset($setting->logo) }}" class="logo-two" alt="Logo">
                </a>

                <div class="collapse navbar-collapse mean-menu" id="navbarSupportedContent">
                    <ul class="navbar-nav m-auto">
                        <li class="nav-item">
                            <a href="{{ url('/') }}" class="nav-link active">
                                Home
                            </a>

                        </li>
                        <li class="nav-item">
                            <a href="about.html" class="nav-link"> About </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('show.gallery') }}" class="nav-link">
                                Gallery
                            </a>

                        </li>

                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                Services
                                <i class="bx bx-chevron-down"></i>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="nav-item">
                                    <a href="services-1.html" class="nav-link">
                                        Services Style One
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="services-2.html" class="nav-link">
                                        Services Style Two
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="service-details.html" class="nav-link">
                                        Service Details
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('blog.list') }}" class="nav-link">
                                Blog
                                <i class="bx bx-chevron-down"></i>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="nav-item">
                                    <a href="blog-1.html" class="nav-link">
                                        Blog Style One
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="blog-2.html" class="nav-link">
                                        Blog Style Two
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="blog-details.html" class="nav-link">
                                        Blog Details
                                    </a>
                                </li>
                            </ul>
                        </li>
                        @php
                            $room_name = App\Models\Room::latest()->get();
                        @endphp
                        <li class="nav-item">
                            <a href="{{ route('froom.all') }}" class="nav-link">
                                All Rooms
                                <i class="bx bx-chevron-down"></i>
                            </a>
                            <ul class="dropdown-menu">
                                @foreach ($room_name as $name)
                                    <li class="nav-item">
                                        <a href="room.html" class="nav-link"> {{ $name['type']['name'] }} </a>
                                    </li>
                                @endforeach
                            </ul>
                        </li>

                        <a href="{{ route('contact.us') }}" class="nav-link">
                            Contact
                        </a>

                        <li class="nav-item-btn">
                            <a href="#" class="default-btn btn-bg-one border-radius-5">Book Now</a>
                        </li>
                    </ul>

                    <div class="nav-btn">
                        <a href="#" class="default-btn btn-bg-one border-radius-5">Book Now</a>
                    </div>
                </div>
            </nav>
        </div>
    </div>
</div>
