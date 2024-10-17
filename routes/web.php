<?php

use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Backend\BlogController;
use App\Http\Controllers\Backend\BookingListController;
use App\Http\Controllers\Backend\CommentController;
use App\Http\Controllers\Backend\GalleryController;
use App\Http\Controllers\Backend\ReportController;
use App\Http\Controllers\Backend\RoleController;
use App\Http\Controllers\Backend\RoomController;
use App\Http\Controllers\Backend\RoomListController;
use App\Http\Controllers\Backend\RoomTypeController;
use App\Http\Controllers\Backend\SettingController;
use App\Http\Controllers\Backend\TeamController;
use App\Http\Controllers\Backend\TestimonialController;
use App\Http\Controllers\Frontend\BookingController;
use App\Http\Controllers\Frontend\FrontendRoomController;
use App\Http\Controllers\Frontend\UserController;
// use App\Http\Controllers\ProfileController;
// use App\Models\BookingRoomList;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// })->name('index');

Route::get('/dashboard', function () {
    return view('frontend.dashboard.index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/edit/profile', [UserController::class, 'userProfile'])->name('user.profile');
    Route::post('/profile/store', [UserController::class, 'profileStore'])->name('profile.store');
    Route::get('logout', [UserController::class, 'logout'])->name('user.logout');
    Route::get('edit/password', [UserController::class, 'editPass'])->name('edit.password');
    Route::post('edit/password', [UserController::class, 'storePass'])->name('password-update');
    Route::get('user/booking', [UserController::class, 'userBooking'])->name('user.booking');
    Route::get('user/invoice/{id}', [UserController::class, 'userInvoice'])->name('user.invoice');
});

require __DIR__ . '/auth.php';
// 
Route::get('/', [UserController::class, 'index'])->name('index');



// Admin Route-----______
Route::group(['middleware' => ['auth', 'roles:admin'], 'prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::get('dashboard', [AdminController::class, 'adminDashboard'])->name('dashboard');
    Route::get('logout', [AdminController::class, 'adminLogout'])->name('logout');
    Route::get('admin/profile', [AdminController::class, 'profile'])->name('profile');
    Route::post('admin/profile/stote', [AdminController::class, 'profileStore'])->name('profile-store');
    Route::get('password/change', [AdminController::class, 'changePassword'])->name('password-change');
    Route::post('password/update', [AdminController::class, 'updatePassword'])->name('password-update');
});

Route::get('admin/login', [AdminController::class, 'index'])->name('admin.login');
// Team Route
Route::middleware(['auth', 'roles:admin'])->group(function () {
    Route::controller(TeamController::class)->group(function () {
        Route::get('/all/team', 'AllTeam')->name('all.team')->middleware('permission:team.all');
        Route::get('/add/team', 'AddTeam')->name('add.team');
        Route::post('/add/team', 'StoreTeam')->name('list.store');
        Route::get('/edit/team/{id}', 'editTeam')->name('edit.team');
        Route::post('/update/team/', 'updateTeam')->name('update.team');
        Route::get('/delete/team/{id}', 'deleteTeam')->name('delete.team');
    });
    // Admin BookingList Controller
    Route::controller(BookingListController::class)->group(function () {
        Route::get('booking/list', 'bookingList')->name('booking.list');
        Route::get('edit/booking/list/{id}', 'editBookingList')->name('edit.booking');
        Route::post('update/booking/status/{id}', 'updateBookingStatus')->name('update.booking.status');
        Route::post('update/booking/{id}', 'UpdateBooking')->name('update.booking');
        Route::get('assign_room/{id}', 'assignRoom')->name('assing_room');
        Route::get('assign_room/store/{booking_id}/{room_number_id}', 'assignRoomStore')->name('assign_room_store');
        Route::get('assign_room/delete/{id}', 'assignRoomDelete')->name('assing_room_delele');
        Route::get('download/invoice/{id}', 'downloadInvoice')->name('download.invoice');
    });
});

// Area Book

Route::middleware(['auth', 'roles:admin'])->group(function () {
    Route::controller(TeamController::class)->group(function () {
        Route::get('/book-area', 'bookArea')->name('book-area');
        Route::post('/update-book-area/{id}', 'updatebookArea')->name('update.book-area');
    });
});
// Room Type list
Route::middleware(['auth', 'roles:admin'])->group(function () {
    Route::controller(RoomTypeController::class)->group(function () {
        Route::get('/room/type/list', 'roomlypelist')->name('room.type-list');
        Route::get('/add/room/type', 'AddRoomType')->name('add.room-type');
        Route::post('/room/type/store', 'RoomTypeStore')->name('room.type-store');
    });
});
// Room
Route::middleware(['auth', 'roles:admin'])->group(function () {
    Route::controller(RoomController::class)->group(function () {
        Route::get('/edit/room/{id}', 'editRoom')->name('edit.room');
        Route::get('/delete/room/{id}', 'deleteRoom')->name('delete.room-type');
        Route::post('/update/room/{id}', 'updateRoom')->name('update.room');
        Route::get('multiImg-delete/{id}', 'multiImgDelet')->name('multi-img.delet');
        Route::post('add/room-number/{id}', 'addRoomNumber')->name('add.room-name');
        // Edit Room Id
        Route::get('/edit/room-number/{id}', 'editRoomId')->name('edit.room-number');
        Route::post('/edit/room-number/{id}', 'updateRoomNumber')->name('update.room-num');
        Route::get('/delete/room-number/{id}', 'deleteRoomNumber')->name('delete.room-number');
    });
});
// Room List
Route::middleware(['auth', 'roles:admin'])->group(function () {
    Route::controller(RoomListController::class)->group(function () {
        Route::get('/view/room/list', 'viewRoomList')->name('view.roomlist');
        Route::get('/add/room/list', 'addRoomList')->name('add.room-list');
        Route::post('/store/roomlist', 'StoreRoomList')->name('store.roomlist');
    });
});

// Room Route Frontend
Route::controller(FrontendRoomController::class)->group(function () {
    Route::get('rooms/list', 'AllFrontendRoom')->name('froom.all');
    Route::get('rooms/list/details/{id}', 'AllRoomDtails')->name('room-details');
    Route::get('bookings', 'BookingSearch')->name('booking.search');
    Route::get('search/room/details/{id}', 'searchRoomDetails')->name('search.room-details');
    Route::get('check_room_availability/', 'CheckRoomAvailability')->name('check_room_availability');
});


Route::middleware(['auth'])->group(function () {
    // CheckOut
    Route::controller(BookingController::class)->group(function () {
        Route::get('checkout', 'checkout')->name('checkout');
        Route::post('booking/store', 'BookingStore')->name('checkout.book');
        Route::post('checkout/store', 'checkoutStore')->name('checkout.store');
        Route::match(['get', 'post'], '/stripe_pay', 'stripe_pay')->name('stripe_pay');
        Route::post('/mark-notification-as-read/{notification}', 'MarkAsRead');
    });
});
// Mail Setting Or Setting route 
Route::middleware(['auth', 'roles:admin'])->group(function () {
    // CheckOut
    Route::controller(SettingController::class)->group(function () {
        Route::get('mail/setting', 'mailSetting')->name('mail.setting');
        Route::post('mail/setting', 'mailSettingUpdate')->name('smtp.update');
        Route::get('/site/setting', 'SiteSetting')->name('site.setting');
        Route::post('/site/update', 'SiteUpdate')->name('site.update');
    });
    Route::controller(TestimonialController::class)->group(function () {
        Route::get('all/testimonial', 'allTestimonial')->name('all.testimonial');
        Route::get('add/testimonial', 'addTestimonial')->name('add.testimonial');
        Route::post('store/testimonial', 'storeTestimonial')->name('store.testimonial');
        Route::get('edit/testimonial/{id}', 'editTestimonial')->name('edit.testimonial');
        Route::get('delete/testimonial/{id}', 'deleteTestimonial')->name('delete.testimonial');
        Route::post('update/testimonial/{id}', 'submitTestimonial')->name('submit.testimonial');
    });
    Route::controller(BlogController::class)->group(function () {
        Route::get('blog/category', 'blogcategory')->name('blog.category');
        Route::post('/store/blog/category', 'StoreBlogCategory')->name('store.blog.category');
        Route::get('/edit/blog/category/{id}', 'EditBlogCategory');
        Route::post('/update/blog/category', 'UpdateBlogCategory')->name('update.blog.category');
        Route::get('/delete/blog/category/{id}', 'DeleteBlogCategory')->name('delete.blog.category');
        // BogPost
        Route::get('all/blog/post', 'allBlogPost')->name('all.blog-post');
        Route::get('add/blog/post', 'addBlogPost')->name('add.blog-post');
        Route::post('add/blog/post', 'storeBlogPost')->name('blog-post.store');
        Route::get('/edit/blog/post/{id}', 'EditBlogPost')->name('edit.blog.post');
        Route::post('/update/blog/post', 'UpdateBlogPost')->name('update.blog.post');
        Route::get('/delete/blog/post/{id}', 'DeleteBlogPost')->name('delete.blog.post');
    });
    // Comment
    Route::controller(CommentController::class)->group(function () {
        Route::get('all/comment/', 'allComment')->name('all-comment');
        Route::post('/update-comment-status', 'updateStatus')->name('update.comment.status');
    });
    // ReportController
    Route::controller(ReportController::class)->group(function () {
        Route::get('booking/report/', 'bookingReport')->name('booking.report');
        Route::post('/search-by-date', 'SearchByDate')->name('search-by-date');
    });
    // GalleryController
    Route::controller(GalleryController::class)->group(function () {
        Route::get('all/gallery/', 'AllGallery')->name('all.gallery');
        Route::get('/add/gallery', 'AddGallery')->name('add.gallery');
        Route::post('/store/gallery', 'StoreGallery')->name('store.gallery');
        Route::get('/edit/gallery/{id}', 'EditGallery')->name('edit.gallery');
        Route::post('/update/gallery', 'UpdateGallery')->name('update.gallery');
        Route::get('/delete/gallery/{id}', 'DeleteGallery')->name('delete.gallery');
        Route::post('/delete/gallery/multiple', 'DeleteGalleryMultiple')->name('delete.gallery.multiple');
        // Contact Data Show In Admin
        Route::get('/contact/message', 'AdminContactMessage')->name('contact.message');
    });
    // Permission  Controller
    Route::controller(RoleController::class)->group(function () {
        Route::get('/all/permission', 'AllPermission')->name('all.permission');
        Route::get('/add/permission', 'AddPermission')->name('add.permission');
        Route::post('/store/permission', 'StorePermission')->name('store.permission');
        Route::get('/edit/permission/{id}', 'EditPermission')->name('edit.permission');
        Route::post('/update/permission', 'UpdatePermission')->name('update.permission');
        Route::get('/delete/permission/{id}', 'DeletePermission')->name('delete.permission');
        Route::get('/import/permission', 'ImportPermission')->name('import.permission');
        Route::get('/export', 'Export')->name('export');
        Route::post('/import', 'Import')->name('import');
    });
    // Role Controller
    Route::controller(RoleController::class)->group(function () {
        Route::get('/all/role', 'Allrole')->name('all.role');
        Route::get('/add/roles', 'AddRoles')->name('add.roles');
        Route::post('/store/roles', 'StoreRoles')->name('store.roles');
        Route::get('/edit/roles/{id}', 'EditRoles')->name('edit.role');
        Route::post('/update/roles', 'UpdateRoles')->name('update.roles');
        Route::get('/delete/roles/{id}', 'DeleteRoles')->name('delete.roles');
        Route::get('/add/roles/permission', 'addRolePermission')->name('add.roles.permission');
        Route::post('/role/permission/store', 'rolePermissionStore')->name('role.permission.store');
        Route::get('all-roles/permission', 'allrolesPermission')->name('all.roles.permission');
        Route::get('/admin/edit/roles/{id}', 'AdminEditRoles')->name('edit.roles');
        Route::post('/admin/roles/update/{id}', 'AdminRolesUpdate')->name('role.permission.update');
        Route::get('/admin/delete/roles/{id}', 'AdminDeleteRoles')->name('delete.roles.haspermission');
    });
    // Admin Role
    Route::controller(AdminController::class)->group(function () {
        Route::get('all/admin', 'allAdmin')->name('all.admin');
        Route::get('add/admin', 'addAdmin')->name('add.admin');
        Route::post('store/admin', 'storeAdmin')->name('store.admin');
        Route::get('edit/admin/{id}', 'editAdmin')->name('edit.admin');
        Route::post('update/admin/{id}', 'updateAdmin')->name('update.admin');
        Route::get('delete/admin/{id}', 'DeleteAdmin')->name('delete.admin');
    });
});
// User Show Blog Details

Route::middleware('auth')->group(function () {
    Route::controller(BlogController::class)->group(function () {
        Route::get('blog/details/{slug}', 'blogDetails')->name('blog-details');
        Route::get('blog/category/{id}', 'blogCatdetails')->name('blog-cat.details');
        Route::get('/blog', 'BlogList')->name('blog.list');
    });
    Route::controller(CommentController::class)->group(function () {
        Route::post('comment/store/', 'storeComment')->name('store-comment');
    });
});

/// Frontend Gallery All Route 
Route::controller(GalleryController::class)->group(function () {

    Route::get('/gallery', 'ShowGallery')->name('show.gallery');
    Route::get('/contact', 'ContactUs')->name('contact.us');
    Route::post('/store/contact', 'StoreContactUs')->name('store.contact');
    // Contact Data show in Admin

});
