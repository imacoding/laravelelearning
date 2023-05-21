<?php

use App\Http\Controllers\LanguageController;

use App\Http\Controllers\CartController;

use App\Http\Controllers\Frontend\Auth\LoginController;
use App\Http\Controllers\Frontend\Auth\RegisterController;
use App\Http\Controllers\Frontend\Auth\SocialLoginController;
use App\Http\Controllers\Frontend\Auth\ResetPasswordController;
use App\Http\Controllers\Frontend\Auth\ConfirmAccountController;
use App\Http\Controllers\Frontend\Auth\ForgotPasswordController;
use App\Http\Controllers\Frontend\Auth\UpdatePasswordController;
use App\Http\Controllers\Frontend\Auth\PasswordExpiredController;

use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\ContactController;
use App\Http\Controllers\Frontend\User\AccountController;
use App\Http\Controllers\Frontend\User\ProfileController;
use App\Http\Controllers\Frontend\User\DashboardController;
use App\Http\Controllers\CoursesController;

use Illuminate\Support\Facades\Route;
//--------------------------AUTH FRONTEND ----------------//
/*
 * Frontend Access Controllers
 * All route names are prefixed with 'frontend.auth'.
 */
Route::group(['namespace' => 'Frontend', 'as' => 'frontend.'], function () {
Route::group(['namespace' => 'Auth', 'as' => 'auth.'], function () {

    /*
    * These routes require the user to be logged in
    */

    Route::group(['middleware' => 'auth'], function () {
        Route::get('logout', [LoginController::class, 'logout'])->name('logout');


        //For when admin is logged in as user from backend
        Route::get('logout-as', [LoginController::class, 'logoutAs'])->name('logout-as');

        // These routes can not be hit if the password is expired
        Route::group(['middleware' => 'password_expires'], function () {
            // Change Password Routes
            Route::patch('password/update', [UpdatePasswordController::class, 'update'])->name('password.update');
        });

        // Password expired routes
        if (is_numeric(config('access.users.password_expires_days'))) {
            Route::get('password/expired', [PasswordExpiredController::class, 'expired'])->name('password.expired');
            Route::patch('password/expired', [PasswordExpiredController::class, 'update'])->name('password.expired.update');
        }

        Route::get('change-password', 'Auth\ChangePasswordController@showChangePasswordForm')->name('change_password');
        Route::patch('change-password', 'Auth\ChangePasswordController@changePassword')->name('change_password');
    });

    /*
     * These routes require no user to be logged in
     */
    Route::group(['middleware' => 'guest'], function () {
        // Authentication Routes
        Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
        Route::post('login', [LoginController::class, 'login'])->name('login.post');

        // Socialite Routes
        Route::get('login/{provider}', [SocialLoginController::class, 'login'])->name('social.login');
        Route::get('login/{provider}/callback', [SocialLoginController::class, 'login']);

        // Registration Routes
        if (config('access.registration')) {
            Route::get('register', [LoginController::class, 'showLoginForm'])->name('register');
            Route::post('register', [RegisterController::class, 'register'])->name('register.post');
        }

        // Confirm Account Routes
        Route::get('account/confirm/{token}', [ConfirmAccountController::class, 'confirm'])->name('account.confirm');
        Route::get('account/confirm/resend/{uuid}', [ConfirmAccountController::class, 'sendConfirmationEmail'])->name('account.confirm.resend');

        // Password Reset Routes
        Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.email');
        Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email.post');

        Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset.form');
       Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.reset');
    });
});

Route::group(['middleware' => ['auth', 'password_expires']], function () {
    Route::group(['namespace' => 'User', 'as' => 'user.'], function () {
        /*
         * User Dashboard Specific
         */
        Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

        /*
         * User Account Specific
         */
        Route::get('account', [AccountController::class, 'index'])->name('account');

        /*
         * User Profile Specific
         */
        Route::patch('profile/update', [ProfileController::class, 'update'])->name('profile.update');
    });
});

});



//===============Blog Course ================//
Route::get('blog', 'BlogController@index')->name('blogs.all');

Route::get('category/{category}/blogs', 'BlogController@getByCategory')->name('blogs.category');

Route::get('category/{category}/blogs', 'BlogController@getByCategory')->name('blogs.category');
Route::get('tag/{tag}/blogs', 'BlogController@getByTag')->name('blogs.tag');
Route::get('blog/{slug?}', 'BlogController@getIndex')->name('blogs.index');
Route::post('blog/{id}/comment', 'BlogController@storeComment')->name('blogs.comment');
Route::get('blog/comment/delete/{id}', 'BlogController@deleteComment')->name('blogs.comment.delete');


Route::get('teachers', 'Frontend\HomeController@getTeachers')->name('teachers.index');
Route::get('teachers/{id}/show', 'Frontend\HomeController@showTeacher')->name('teachers.show');

Route::post('newsletter/subscribe', 'Frontend\HomeController@subscribe')->name('subscribe');


//============Course Routes=================//


Route::get('courses', [CoursesController::class, 'all'])->name('courses.all');
Route::get('course/{slug}', [CoursesController::class, 'show'])->name('courses.show');
//Route::post('course/payment', [CoursesController::class, 'payment'])->name('courses.payment');
Route::post('course/{course_id}/rating', [CoursesController::class, 'rating'])->name('courses.rating');
Route::get('category/{category}/courses', [CoursesController::class, 'getByCategory'])->name('courses.category');
Route::post('courses/{id}/review', [CoursesController::class, 'addReview'])->name('courses.review');
Route::get('courses/review/{id}/edit', [CoursesController::class, 'editReview'])->name('courses.review.edit');
Route::post('courses/review/{id}/edit', [CoursesController::class, 'updateReview'])->name('courses.review.update');
Route::get('courses/review/{id}/delete', [CoursesController::class, 'deleteReview'])->name('courses.review.delete');



//============Bundle Routes=================//
Route::get('bundles', ['uses' => 'BundlesController@all', 'as' => 'bundles.all']);
Route::get('bundle/{slug}', ['uses' => 'BundlesController@show', 'as' => 'bundles.show']);
//Route::post('course/payment', ['uses' => 'CoursesController@payment', 'as' => 'courses.payment']);
Route::post('bundle/{bundle_id}/rating', ['uses' => 'BundlesController@rating', 'as' => 'bundles.rating']);
Route::get('category/{category}/bundles', ['uses' => 'BundlesController@getByCategory', 'as' => 'bundles.category']);
Route::post('bundles/{id}/review', ['uses' => 'BundlesController@addReview', 'as' => 'bundles.review']);
Route::get('bundles/review/{id}/edit', ['uses' => 'BundlesController@editReview', 'as' => 'bundles.review.edit']);
Route::post('bundles/review/{id}/edit', ['uses' => 'BundlesController@updateReview', 'as' => 'bundles.review.update']);
Route::get('bundles/review/{id}/delete', ['uses' => 'BundlesController@deleteReview', 'as' => 'bundles.review.delete']);

Route::middleware(['auth'])->group(function () {
    Route::get('lesson/{course_id}/{slug}/', 'LessonsController@show')->name('lessons.show');
    Route::post('lesson/{slug}/test', 'LessonsController@test')->name('lessons.test');
    Route::post('lesson/{slug}/retest', 'LessonsController@retest')->name('lessons.retest');
    Route::post('video/progress', 'LessonsController@videoProgress')->name('update.videos.progress');
    Route::post('lesson/progress', 'LessonsController@courseProgress')->name('update.course.progress');
});




Route::get('/search', [HomeController::class, 'searchCourse'])->name('search');
Route::get('/search-course', [HomeController::class, 'searchCourse'])->name('search-course');
Route::get('/search-bundle', [HomeController::class, 'searchBundle'])->name('search-bundle');
Route::get('/search-blog', [HomeController::class, 'searchBlog'])->name('blogs.search');


Route::get('/faqs', 'Frontend\HomeController@getFaqs')->name('faqs');

/*=============== Theme blades routes ends ===================*/


Route::get('contact', 'Frontend\ContactController@index')->name('contact');
Route::post('contact/send', 'Frontend\ContactController@send')->name('contact.send');

Route::get('download', ['uses' => 'Frontend\HomeController@getDownload', 'as' => 'download']);

Route::middleware(['auth'])->group(function () {
Route::post('cart/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
Route::post('cart/add', [CartController::class, 'addToCart'])->name('cart.addToCart');
Route::get('cart', [CartController::class, 'index'])->name('cart.index');
Route::get('cart/clear', [CartController::class, 'clear'])->name('cart.clear');
Route::get('cart/remove', [CartController::class, 'remove'])->name('cart.remove');
Route::post('cart/apply-coupon', [CartController::class, 'applyCoupon'])->name('cart.applyCoupon');
Route::post('cart/remove-coupon', [CartController::class, 'removeCoupon'])->name('cart.removeCoupon');
Route::post('cart/stripe-payment', [CartController::class, 'stripePayment'])->name('cart.stripe.payment');
Route::post('cart/paypal-payment', [CartController::class, 'paypalPayment'])->name('cart.paypal.payment');
Route::get('cart/paypal-payment/status', [CartController::class, 'getPaymentStatus'])->name('cart.paypal.status');

Route::get('status', function () {
    return view('frontend.cart.status');
})->name('status');

Route::post('cart/offline-payment', [CartController::class, 'offlinePayment'])->name('cart.offline.payment');
Route::post('cart/getnow', [CartController::class, 'getNow'])->name('cart.getnow');

});


//============= Menu  Manager Routes ===============//



Route::get('certificate-verification','Backend\CertificateController@getVerificationForm')->name('frontend.certificates.getVerificationForm');

if(config('show_offers') == 1){
    Route::get('offers',['uses' => 'CartController@getOffers', 'as' => 'frontend.offers']);
}


// Switch between the included languages
Route::get('lang/{lang}', [LanguageController::class, 'swap']);
Route::group(['namespace' => 'Frontend', 'as' => 'frontend.'], function () {
    Route::get('/{page?}', [HomeController::class, 'index'])->name('index');
});



Route::prefix('user')
    ->middleware(['admin'])
    ->name('admin.')
    ->namespace('Backend')
    ->group(function () {
        // These routes need the 'view-backend' permission
        // (good if you want to allow more than one group in the backend,
        // then limit the backend features by different roles or permissions)
        //
        // Note: Administrator has all permissions so you do not have to specify the administrator role everywhere.
        // These routes can not be hit if the password is expired
         foreach (glob(__DIR__ . '/backend/*.php') as $filename) {
        require $filename;
    }
        
    });


Route::middleware(['auth'])->prefix('user')->namespace('Backend')->as('admin.')->group(function () {
//==== Messages Routes =====//
Route::get('messages', [\App\Http\Controllers\Backend\MessengerController::class, 'index'])->name('messages');
Route::post('messages/unread', [\App\Http\Controllers\Backend\MessengerController::class, 'getUnreadMessages'])->name('messages.unread');
Route::post('messages/send', [\App\Http\Controllers\Backend\MessengerController::class, 'send'])->name('messages.send');
Route::post('messages/reply', [\App\Http\Controllers\Backend\MessengerController::class, 'reply'])->name('messages.reply');
});













