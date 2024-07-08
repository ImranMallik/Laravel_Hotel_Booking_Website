<?php

use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Backend\BookingListController;
use App\Http\Controllers\Backend\RoomController;
use App\Http\Controllers\Backend\RoomListController;
use App\Http\Controllers\Backend\RoomTypeController;
use App\Http\Controllers\Backend\SettingController;
use App\Http\Controllers\Backend\TeamController;
use App\Http\Controllers\Frontend\BookingController;
use App\Http\Controllers\Frontend\FrontendRoomController;
use App\Http\Controllers\Frontend\UserController;
use App\Http\Controllers\ProfileController;
use App\Models\BookingRoomList;
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
        Route::get('/all/team', 'AllTeam')->name('all.team');
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
    });
});
// Mail Setting Or Setting route 
Route::middleware(['auth', 'roles:admin'])->group(function () {
    // CheckOut
    Route::controller(SettingController::class)->group(function () {
        Route::get('mail/setting', 'mailSetting')->name('mail.setting');
        Route::post('mail/setting', 'mailSettingUpdate')->name('smtp.update');
    });
});
