<div class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
        <div>
            <img src="{{ asset('Backend/assets/images/logo-icon.png') }}" class="logo-icon" alt="logo icon">
        </div>
        <div>
            <h4 class="logo-text">IMRAN</h4>
        </div>
        <div class="toggle-icon ms-auto"><i class='bx bx-arrow-back'></i>
        </div>
    </div>
    <!--navigation-->
    <ul class="metismenu" id="menu">

        <li>
            <a href="{{ route('admin.dashboard') }}">
                <div class="parent-icon"><i class='bx bx-home-alt'></i>
                </div>
                <div class="menu-title">Dashboard</div>
            </a>
        </li>

        @if (Auth::user()->can('team.menu'))
            <li>
                <a href="javascript:;" class="has-arrow">
                    <div class="parent-icon"><i class="bx bx-user-check"></i>
                    </div>
                    <div class="menu-title">Manage Teams</div>

                </a>
                <ul>
                    @if (Auth::user()->can('team.all'))
                        <li> <a href="{{ route('all.team') }}"><i class='bx bx-radio-circle'></i>All Team</a>
                        </li>
                    @endif
                    @if (Auth::user()->can('add.team'))
                        <li> <a href="{{ route('add.team') }}"><i class='bx bx-radio-circle'></i>Add Team</a>
                        </li>
                    @endif

                </ul>
            </li>
        @endif
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bx bx-book-open"></i>
                </div>
                <div class="menu-title">Manage BookArea</div>

            </a>
            <ul>
                <li> <a href="{{ route('book-area') }}"><i class='bx bx-radio-circle'></i>Update Book Area</a>
                </li>


            </ul>
        </li>
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bx bx-bed"></i>
                </div>
                <div class="menu-title">Manage Room Type</div>

            </a>
            <ul>
                <li> <a href="{{ route('room.type-list') }}"><i class='bx bx-radio-circle'></i>Room Type List</a>
                </li>


            </ul>
        </li>
        <li class="menu-label">Booking Manage</li>

        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class='bx bx-calendar-check'></i>
                </div>
                <div class="menu-title">Booking</div>

            </a>
            <ul>
                <li> <a href="{{ route('booking.list') }}"><i class='bx bx-radio-circle'></i>Booking List</a>
                </li>
                <li> <a href="{{ route('add.team') }}"><i class='bx bx-radio-circle'></i>Add Booking </a>

            </ul>
        </li>
        <li>
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon"><i class='bx bx-list-ul'></i>
                </div>
                <div class="menu-title">Manage RoomList</div>

            </a>
            <ul>
                <li> <a href="{{ route('view.roomlist') }}"><i class='bx bx-radio-circle'></i>Room List</a>
                </li>



            </ul>
        </li>
        <li>
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon"><i class='bx bx-cog'></i>
                </div>
                <div class="menu-title">Settings</div>

            </a>
            <ul>
                <li> <a href="{{ route('mail.setting') }}"><i class='bx bx-radio-circle'></i>SMTP Setting</a>
                </li>
                <li> <a href="{{ route('site.setting') }}"><i class='bx bx-radio-circle'></i>Site Setting</a>
                </li>
            </ul>
        </li>

        <li>
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon"><i class='bx bx-message-square-dots'></i>
                </div>
                <div class="menu-title">Testimonial</div>

            </a>
            <ul>
                <li> <a href="{{ route('all.testimonial') }}"><i class='bx bx-radio-circle'></i>All Testimonial</a>
                </li>
                <li> <a href="{{ route('add.testimonial') }}"><i class='bx bx-radio-circle'></i>Add Testimonial</a>
                </li>



            </ul>
        </li>
        <li>
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon"><i class='bx bx-news'></i>
                </div>
                <div class="menu-title">Blog</div>

            </a>
            <ul>
                <li> <a href="{{ route('blog.category') }}"><i class='bx bx-radio-circle'></i>Blog Category</a>
                </li>
                <li> <a href="{{ route('all.blog-post') }}"><i class='bx bx-radio-circle'></i>All Blog Post</a>
                </li>



            </ul>
        </li>
        <li>
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon"><i class='bx bx-comment'></i>
                </div>
                <div class="menu-title">Comments</div>

            </a>
            <ul>

                <li> <a href="{{ route('all-comment') }}"><i class='bx bx-radio-circle'></i>All Comments</a>
                </li>



            </ul>
        </li>
        <li>
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon"><i class='bx bx-file'></i>
                </div>
                <div class="menu-title">Report</div>

            </a>
            <ul>

                <li> <a href="{{ route('booking.report') }}"><i class='bx bx-radio-circle'></i>Booking Report</a>
                </li>



            </ul>
        </li>
        <li>
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon"><i class='bx bx-envelope'></i>
                </div>
                <div class="menu-title">Contact Message</div>

            </a>
            <ul>
                <li> <a href="{{ route('contact.message') }}"><i class='bx bx-radio-circle'></i>Contact Message
                    </a>
                </li>

            </ul>
        </li>
        <li>
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon"><i class='bx bx-images'></i>
                </div>
                <div class="menu-title">Hotel Gallery</div>

            </a>
            <ul>

                <li> <a href="{{ route('all.gallery') }}"><i class='bx bx-radio-circle'></i>All Gallery</a>
                </li>

            </ul>
        </li>

        <li class="menu-label">Role & Permission </li>

        <li>
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon"><i class='bx bx-shield'></i>
                </div>
                <div class="menu-title">Role & Permission</div>

            </a>
            <ul>
                <li> <a href="{{ route('all.permission') }}"><i class='bx bx-radio-circle'></i>All Permission
                    </a>
                </li>
                <li> <a href="{{ route('all.role') }}"><i class='bx bx-radio-circle'></i>All Role </a>
                </li>
                <li> <a href="{{ route('add.roles.permission') }}"><i class='bx bx-radio-circle'></i>Role In
                        Permission</a>
                </li>
                <li> <a href="{{ route('all.roles.permission') }}"><i class='bx bx-radio-circle'></i>All Role In
                        Permission</a>
                </li>

            </ul>
        </li>
        <li>
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon"><i class='bx bx-user-pin'></i>
                </div>
                <div class="menu-title">Manage Admin User</div>


            </a>
            <ul>
                <li> <a href="{{ route('all.admin') }}"><i class='bx bx-radio-circle'></i>All Admin </a>
                </li>
                <li> <a href="{{ route('all.admin') }}"><i class='bx bx-radio-circle'></i>Add Admin </a>
                </li>


            </ul>
        </li>






        <li>
            <a href="#" target="_blank">
                <div class="parent-icon"><i class="bx bx-support"></i>
                </div>
                <div class="menu-title">Support</div>
            </a>
        </li>
    </ul>
    <!--end navigation-->
</div>
