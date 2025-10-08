<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\GallaryController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\EnquiryController;
use App\Http\Controllers\Admin\HomeBannerController;
use App\Http\Controllers\Admin\BlogsManagementController;
use App\Http\Controllers\EventMapController;
use App\Http\Controllers\Front\CommentController;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Front\UserController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Front\BlogsController;
use App\Http\Controllers\LocaleController;
use App\Models\Event;
use Stichoza\GoogleTranslate\GoogleTranslate;




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
// });


Route::get('/',[HomeController::class,'index'])->name('home');
Route::get('contact',[HomeController::class,'contact'])->name('contact');
Route::get('create-post',[HomeController::class,'createpost'])->name('create-post');
Route::get('event',[HomeController::class,'event'])->name('event');
Route::get('about',[HomeController::class,'about'])->name('about');
Route::get('eventdetail/{id}', [HomeController::class, 'eventdetail'])->name('eventdetail');
Route::get('term',[HomeController::class,'term'])->name('term');
Route::get('privacy',[HomeController::class,'privacy'])->name('privacy');
Route::get('community',[HomeController::class,'community'])->name('community');
Route::get('login',[HomeController::class,'login'])->name('login');
Route::get('register',[HomeController::class,'register'])->name('register');
Route::get('map-view',[HomeController::class,'map'])->name('map');

Route::post('/register', [UserController::class, 'store'])->name('register.store');
Route::post('/login', [UserController::class, 'login'])->name('login.post');


Route::get('forget-password', [UserController::class, 'showForgetPasswordForm'])->name('forget.password.form');
Route::post('forget-password', [UserController::class, 'submitForgetPasswordForm'])->name('forget.password.submit');

// This route is used in the email link
Route::get('reset-password/{token}', [UserController::class, 'showResetPasswordForm'])
    ->name('password.reset');

// This route is used to submit the new password
Route::post('reset-password', [UserController::class, 'submitResetPasswordForm'])
    ->name('password.update');

Route::post('post/{post}/comment', [HomeController::class, 'store'])->name('post.comment');
Route::post('event/{event}/comment', [CommentController::class, 'store'])->name('event.comment');

// Sign up Via  google
Route::get('auth/google', [UserController::class, 'redirectToGoogle'])->name('google.login');
Route::get('auth/google/callback', [UserController::class, 'handleGoogleCallback']);

Route::get('blog', [BlogsController::class, 'blog'])->name('blog');
Route::get('blog/{slug}', [BlogsController::class, 'blogDetails'])->name('blog-details');
Route::post('blog-review-store', [BlogsController::class, 'storeBlogReview'])->name('store.blog.review');
Route::post('blog-contactus/store', [EnquiryController::class, 'blogContactUsStore'])->name('blog-contactus-store');
// web.php
Route::get('/search-blog', [BlogsController::class, 'searchBlog'])->name('search.blog');
Route::get('category/{category_slug}', [BlogsController::class, 'blogByCategory'])->name('blog-by-category');

Route::post('/logout', function () {
    Auth::logout();
    return redirect('/');
})->name('logout');

Route::post('/enquiry-form', [HomeController::class, 'storeEnquiryForm'])->name('enquiry-form.storeDetails');

// Show map for one event + related
Route::get('/map/{id}', [HomeController::class, 'showEventMap'])->name('events.map.single');

//  Store Post
Route::post('/eventFront/store', [HomeController::class, 'storePost'])->name('eventFront.store');

Route::post('/event/{id}/like', [HomeController::class, 'toggleLike'])->middleware('auth');



Route::get('set-locale/{locale}', [LocaleController::class, 'setLocale'])->name('set-locale');
Route::get('/thank-you', function () {
    return view('front.thankyou');
})->name('thankyou');





Route::get('/test-translate', function() {
    // Pick an event from DB
    $event = Event::first();

    // Initialize Google Translate
    $tr = new GoogleTranslate('hi'); // target language: Hindi

    // Translate title
    $translatedTitle = $tr->translate($event->title);

    // Translate description
    $translatedDescription = $tr->translate($event->description);

    return view('test-translate', compact('event', 'translatedTitle', 'translatedDescription'));
});



Route::prefix('admin')->group(function () {
    Route::match(['get', 'post'], 'login', [AdminController::class, 'login'])->name('admin.login');

    // Forgot Password
    Route::get('forgot-password', [AdminController::class, 'showForgotForm'])->name('admin.forgot.password');
    Route::post('forgot-password', [AdminController::class, 'submitForgotForm'])->name('admin.forgot.submit');

    // Reset Password
    Route::get('reset-password/{token}', [AdminController::class, 'showResetForm'])->name('admin.reset.password');
    Route::post('reset-password', [AdminController::class, 'submitResetForm'])->name('admin.reset.submit');

    Route::middleware(['admin'])->group(function () {
        Route::get('dashboard', [AdminController::class, 'index']);

        Route::get('home-banner', [HomeBannerController::class, 'banner']);
        Route::get('home-banner/create', [HomeBannerController::class, 'create']);
        Route::post('home-banner/store', [HomeBannerController::class, 'store'])->name('admin.home-banner.store');
        Route::get('home-banner/edit/{id}', [HomeBannerController::class, 'edit'])->name('admin.home-banner.edit');
        Route::post('home-banner/update/{id}', [HomeBannerController::class, 'update'])->name('admin.home-banner.update');
        Route::get('home-banner/delete/{id}', [HomeBannerController::class, 'delete'])->name('admin.home-banner.delete');
        Route::get('home-banner/status/{id}', [HomeBannerController::class, 'toggleStatus'])->name('admin.home-banner.toggleStatus');


        Route::match(['get', 'post'], 'profile', [AdminController::class, 'profile'])->name('admin.profile');
        Route::post('profile/change-password', [AdminController::class, 'changePassword'])->name('admin.change.password');
        Route::get('/profile/edit', [AdminController::class, 'editProfile'])->name('admin.profile.edit');
        Route::put('/profile/update', [AdminController::class, 'updateProfile'])->name('admin.profile.update');

        // User management
        Route::get('user-management', [AdminController::class, 'UserManagement']);
        Route::put('user-management/toggle-status/{id}', [AdminController::class, 'toggleStatus'])->name('admin.user-management.toggleStatus');
        Route::get('user-management/edit/{id}', [AdminController::class, 'edit'])->name('admin.user.edit');
        Route::post('user-management/update/{id}', [AdminController::class, 'update'])->name('admin.user.update');
        Route::delete('user-management/delete/{id}', [AdminController::class, 'destroy'])->name('admin.user.destroy');
        Route::get('user-management/create', [AdminController::class, 'create'])->name('admin.user.create');
        Route::post('user-management/store', [AdminController::class, 'store'])->name('admin.user.store');

        // contact Management
        Route::get('contact-management', [ContactController::class, 'ContactManagement']);
        Route::get('contact-management/create', [ContactController::class, 'create'])->name('contact.create');
        Route::post('contact-management/store', [ContactController::class, 'store'])->name('admin.contact.store');
        Route::get('contact-management/edit/{id}', [ContactController::class, 'edit'])->name('contact.edit');
        Route::post('contact-management/update/{id}', [ContactController::class, 'update'])->name('contact.update');
        Route::get('contact-management/delete/{id}', [ContactController::class, 'delete'])->name('contact.delete');


        // gallery management
        Route::get('gallary-management', [GallaryController::class, 'GallaryManagement']);
        Route::get('gallary-management/create', [GallaryController::class, 'create']);
        Route::post('gallary-management/store', [GallaryController::class, 'store'])->name('admin.gallary.store');
        Route::get('gallary-management/edit/{id}', [GallaryController::class, 'edit'])->name('gallary.edit');
        Route::post('gallary-management/update/{id}', [GallaryController::class, 'update'])->name('gallary.update');
        Route::get('gallary-management/delete/{id}', [GallaryController::class, 'delete'])->name('gallary.delete');
        Route::get('gallary-management/status/{id}', [GallaryController::class, 'toggleStatus'])->name('gallary.status');


        // Blog Category Management
        Route::get('blog-category-management', [BlogController::class, 'BlogCategoryManagement']);
        Route::get('blog-management/create-blog-category', [BlogController::class, 'createBlogCategory']);
        Route::post('blog-management/category-store', [BlogController::class, 'BlogCategoryStore'])->name('admin.category.store');
        Route::get('blog-management/edit_blog/{id}', [BlogController::class, 'editBlog'])->name('blog.edit_blog');
        Route::post('blog-management/update_blog/{id}', [BlogController::class, 'updateBlog'])->name('blog.update_blog');
        Route::get('blog-management/delete_blog/{id}', [BlogController::class, 'deleteBlog'])->name('blog.delete_blog');

        // Blog Page

        Route::get('blogs', [BlogController::class, 'blogs']);
        Route::post('store-blogs', [BlogController::class, 'Storeblogs'])->name('admin.blog.store');
        Route::get('blog-list', [BlogController::class, 'blogList']);
        Route::get('edit-blog/{id}', [BlogController::class, 'edit'])->name('admin.blog.edit');
        Route::post('update-blog/{id}', [BlogController::class, 'update'])->name('admin.blog.update');
        Route::delete('delete-blog/{id}', [BlogController::class, 'destroy'])->name('admin.blog.delete');




        Route::get('event-management', [EventController::class, 'event']);
        Route::get('event-management/create', [EventController::class, 'create']);
        Route::post('event-management/store', [EventController::class, 'storeEvent'])->name('admin.event.store');
        Route::get('event-management/edit_event/{id}', [EventController::class, 'editevent'])->name('event.edit_event');
        Route::post('event-management/update_event/{id}', [EventController::class, 'updateevent'])->name('event.update_event');
        Route::get('event-management/delete_event/{id}', [EventController::class, 'deleteevent'])->name('event.delete_event');
        Route::get('event/toggle-status/{id}', [EventController::class, 'toggleStatus'])->name('event.toggleStatus');


        Route::get('enquiry-management', [EnquiryController::class, 'enquiry']);
        Route::get('enquiry-management/create', [EnquiryController::class, 'create']);
        Route::post('enquiry-management/store', [EnquiryController::class, 'storeEnquiry'])->name('admin.enquiry.store');
        Route::get('enquiry-management/edit_enquiry/{id}', [EnquiryController::class, 'editenquiry'])->name('enquiry.edit_enquiry');
        Route::post('enquiry-management/update_enquiry/{id}', [EnquiryController::class, 'updateenquiry'])->name('enquiry.update_enquiry');
        Route::get('enquiry-management/delete_enquiry/{id}', [EnquiryController::class, 'deleteenquiry'])->name('enquiry.delete_enquiry');


        // Test  Map
        Route::get('map-management', [EventMapController::class, 'index'])->name('admin.map.index');

        // Comment
        Route::get('comment-management', [CommentController::class, 'comment']);
        Route::get('comment/toggle-status/{id}', [CommentController::class, 'toggleStatus'])->name('comment.toggleStatus');



        //########################################### Blogs Management #########################//
    Route::get('/blog-categories-list', [BlogsManagementController::class, 'blogCategoryIndex'])->name('blog-categories-list');
    Route::get('/blog-categories-list-add-item', [BlogsManagementController::class, 'createBlogCategory'])->name('create-blog-categories');
    Route::post('blog-categories-management/add-blog-categories', [BlogsManagementController::class, 'storeBlogCategory'])->name('store-blog-categories');
    Route::get('blog-categories-management/edit-blog-categories/{id}', [BlogsManagementController::class, 'editBlogCategory'])->name('edit-blog-categories');
    Route::post('blog-categories-management/update-blog-categories/{id}', [BlogsManagementController::class, 'updateBlogCategory'])->name('update-blog-categories');
    Route::post('blog-categories-management/update-blog-category-status', [BlogsManagementController::class, 'updateBlogCategoryStatus'])->name('update-blog-categories-status');
    Route::get('blog-categories-management/delete/{id}', [BlogsManagementController::class, 'deleteBlogCategory'])->name('delete-blog-categories');

    Route::get('/blogs-list', [BlogsManagementController::class, 'blogsIndex'])->name('blogs-list');
    Route::get('/blogs-list-add-item', [BlogsManagementController::class, 'createBlogs'])->name('create-blogs');
    Route::post('blogs-management/add-blogs', [BlogsManagementController::class, 'storeBlogs'])->name('store-blogs');
    Route::get('blogs-management/edit-blogs/{id}', [BlogsManagementController::class, 'editBlogs'])->name('edit-blogs');
    Route::post('blogs-management/update-blogs/{id}', [BlogsManagementController::class, 'updateBlogs'])->name('update-blogs');
    Route::post('blogs-management/update-blogs-status', [BlogsManagementController::class, 'updateBlogsStatus'])->name('update-blogs-status');
    Route::get('blogs-management/delete/{id}', [BlogsManagementController::class, 'deleteBlogs'])->name('delete-blogs');

    Route::get('blogs-management/blogs-comments/{id}', [BlogsManagementController::class, 'showBlogComments'])->name('blog-comments');
    Route::post('blogs-management/update-blogs-review-status', [BlogsManagementController::class, 'updateBlogsReviewStatus'])->name('update-blogs-reviews-status');
    Route::get('blogs-management/delete-blogs-review/{id}', [BlogsManagementController::class, 'deleteBlogsReview'])->name('delete-blogs-reviews');



        Route::get('logout', [AdminController::class, 'logout'])->name('admin.logout');
    });
});

