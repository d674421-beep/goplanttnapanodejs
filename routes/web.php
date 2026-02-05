<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\User\PostController;
use App\Http\Controllers\User\PostCommentController;
use App\Http\Controllers\Auth\OtpVerificationController;

/*
|--------------------------------------------------------------------------
| PUBLIC ROUTES
|--------------------------------------------------------------------------
*/
Route::get('/', fn () => view('landing'))->name('landing');

/*
|--------------------------------------------------------------------------
| AUTH REDIRECT (SETELAH LOGIN)
|--------------------------------------------------------------------------
*/
Route::get('/dashboard', function () {

    if (auth()->user()->is_admin) {
        return redirect()->route('admin.dashboard');
    }

    return redirect()->route('user.dashboard');

})->middleware(['auth', 'otp.verified'])->name('dashboard');

/*
|--------------------------------------------------------------------------
| OTP VERIFICATION ROUTES
|--------------------------------------------------------------------------
| User HARUS login dulu, tapi BELUM boleh masuk dashboard
*/
Route::middleware('auth')->group(function () {

    Route::get('/verify-otp',
        [OtpVerificationController::class, 'show']
    )->name('otp.verify.form');

    Route::post('/verify-otp',
        [OtpVerificationController::class, 'verify']
    )->name('otp.verify');

    Route::post('/resend-otp',
        [OtpVerificationController::class, 'resend']
    )->name('otp.resend');
});

/*
|--------------------------------------------------------------------------
| ADMIN ROUTES
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'otp.verified', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

    // Dashboard
    Route::get('/dashboard',
        [\App\Http\Controllers\Admin\DashboardController::class, 'index']
    )->name('dashboard');

    // Content
    Route::resource('plants',
        \App\Http\Controllers\Admin\PlantController::class);

    Route::resource('encyclopedia',
        \App\Http\Controllers\Admin\EncyclopediaController::class);

    Route::resource('forums',
        \App\Http\Controllers\Admin\ForumController::class);

    Route::resource('posts',
        \App\Http\Controllers\Admin\PostController::class);

    Route::resource('reminders',
        \App\Http\Controllers\Admin\ReminderController::class);

    // Forum Approval
    Route::put('forums/{forum}/approve',
        [\App\Http\Controllers\Admin\ForumController::class, 'approve']
    )->name('forums.approve');

    /*
    |--------------------------------------------------------------------------
    | ADMIN – FORUM COMMENTS
    |--------------------------------------------------------------------------
    */
    Route::post('forums/{forum}/comments',
        [\App\Http\Controllers\Admin\ForumCommentController::class, 'store']
    )->name('forums.comments.store');

    Route::get('forums/comments/{comment}/edit',
        [\App\Http\Controllers\Admin\ForumCommentController::class, 'edit']
    )->name('forums.comments.edit');

    Route::put('forums/comments/{comment}',
        [\App\Http\Controllers\Admin\ForumCommentController::class, 'update']
    )->name('forums.comments.update');

    Route::delete('forums/comments/{comment}',
        [\App\Http\Controllers\Admin\ForumCommentController::class, 'destroy']
    )->name('forums.comments.destroy');

    /*
    |--------------------------------------------------------------------------
    | ADMIN – POST COMMENTS
    |--------------------------------------------------------------------------
    */
    Route::post('posts/{post}/comments',
        [\App\Http\Controllers\Admin\PostCommentController::class, 'store']
    )->name('posts.comments.store');

    Route::get('posts/comments/{comment}/edit',
        [\App\Http\Controllers\Admin\PostCommentController::class, 'edit']
    )->name('posts.comments.edit');

    Route::put('posts/comments/{comment}',
        [\App\Http\Controllers\Admin\PostCommentController::class, 'update']
    )->name('posts.comments.update');

    Route::delete('posts/comments/{comment}',
        [\App\Http\Controllers\Admin\PostCommentController::class, 'destroy']
    )->name('posts.comments.destroy');
});

/*
|--------------------------------------------------------------------------
| USER ROUTES
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'otp.verified'])
    ->prefix('user')
    ->name('user.')
    ->group(function () {

    // Dashboard
    Route::get('/dashboard',
        [\App\Http\Controllers\User\DashboardController::class, 'index']
    )->name('dashboard');

    /*
    |--------------------------------------------------------------------------
    | USER – ENCYCLOPEDIA (READ ONLY)
    |--------------------------------------------------------------------------
    */
    Route::get('/encyclopedia',
        [\App\Http\Controllers\User\EncyclopediaController::class, 'index']
    )->name('encyclopedia.index');

    Route::get('/encyclopedia/{item}',
        [\App\Http\Controllers\User\EncyclopediaController::class, 'show']
    )->name('encyclopedia.show');

    /*
    |--------------------------------------------------------------------------
    | USER – FORUM
    |--------------------------------------------------------------------------
    */
    Route::get('/forums',
        [\App\Http\Controllers\User\ForumController::class, 'index']
    )->name('forums.index');

    Route::get('/forums/create',
        [\App\Http\Controllers\User\ForumController::class, 'create']
    )->name('forums.create');

    Route::post('/forums',
        [\App\Http\Controllers\User\ForumController::class, 'store']
    )->name('forums.store');

    Route::get('/forums/{forum}',
        [\App\Http\Controllers\User\ForumController::class, 'show']
    )->name('forums.show');

    Route::get('/forums/{forum}/edit',
        [\App\Http\Controllers\User\ForumController::class, 'edit']
    )->name('forums.edit');

    Route::put('/forums/{forum}',
        [\App\Http\Controllers\User\ForumController::class, 'update']
    )->name('forums.update');
	
	Route::delete(
		'/forums/{forum}',
		[\App\Http\Controllers\User\ForumController::class, 'destroy']
	)->name('forums.destroy');


    /*
    |--------------------------------------------------------------------------
    | USER – FORUM COMMENTS
    |--------------------------------------------------------------------------
    */
    Route::post('/forums/{forum}/comments',
        [\App\Http\Controllers\User\ForumCommentController::class, 'store']
    )->name('forums.comments.store');

    Route::get('/forums/comments/{comment}/edit',
        [\App\Http\Controllers\User\ForumCommentController::class, 'edit']
    )->name('forums.comments.edit');

    Route::put('/forums/comments/{comment}',
        [\App\Http\Controllers\User\ForumCommentController::class, 'update']
    )->name('forums.comments.update');

    Route::delete('/forums/comments/{comment}',
        [\App\Http\Controllers\User\ForumCommentController::class, 'destroy']
    )->name('forums.comments.destroy');

    /*
    |--------------------------------------------------------------------------
    | USER – POSTS
    |--------------------------------------------------------------------------
    */
    Route::resource('posts', PostController::class)
        ->names('posts');

    Route::post('/posts/{post}/comments',
        [PostCommentController::class, 'store']
    )->name('posts.comments.store');

    Route::get('/posts/comments/{comment}/edit',
        [PostCommentController::class, 'edit']
    )->name('posts.comments.edit');

    Route::put('/posts/comments/{comment}',
        [PostCommentController::class, 'update']
    )->name('posts.comments.update');

    Route::delete('/posts/comments/{comment}',
        [PostCommentController::class, 'destroy']
    )->name('posts.comments.destroy');

    /*
    |--------------------------------------------------------------------------
    | USER – REMINDERS
    |--------------------------------------------------------------------------
    */
    Route::resource('reminders',
        \App\Http\Controllers\User\ReminderController::class);
});

/*
|--------------------------------------------------------------------------
| PROFILE
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'otp.verified'])->group(function () {

    Route::get('/profile',
        [ProfileController::class, 'edit']
    )->name('profile.edit');

    Route::patch('/profile',
        [ProfileController::class, 'update']
    )->name('profile.update');

    Route::delete('/profile',
        [ProfileController::class, 'destroy']
    )->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| AUTH ROUTES (LOGIN, REGISTER, LOGOUT, PASSWORD)
|--------------------------------------------------------------------------
*/
require __DIR__.'/auth.php';
