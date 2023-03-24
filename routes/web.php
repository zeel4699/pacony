<?php

use App\Http\Controllers\Admin\AboutController;
use App\Http\Controllers\Admin\AdminRoleController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\BlogSectionController;
use App\Http\Controllers\Admin\BreadcrumbController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ColorOptionController;
use App\Http\Controllers\Admin\CommentSectionController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\CurrencyController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DemoModeController;
use App\Http\Controllers\Admin\DemoRequestController;
use App\Http\Controllers\Admin\DemoRequestSectionController;
use App\Http\Controllers\Admin\ErrorPageController;
use App\Http\Controllers\Admin\ExternalUrlController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\FaqSectionController;
use App\Http\Controllers\Admin\FeatureController;
use App\Http\Controllers\Admin\FixedContentController;
use App\Http\Controllers\Admin\GoogleAnalyticController;
use App\Http\Controllers\Admin\HomepageVersionController;
use App\Http\Controllers\Admin\LanguageController;
use App\Http\Controllers\Admin\LanguageKeywordController;
use App\Http\Controllers\Admin\MessageController;
use App\Http\Controllers\Admin\OrderModeController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\PartnerController;
use App\Http\Controllers\Admin\PartnerSectionController;
use App\Http\Controllers\Admin\PhotoController;
use App\Http\Controllers\Admin\PreviewController;
use App\Http\Controllers\Admin\PriceController;
use App\Http\Controllers\Admin\PriceSectionController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\QuickAccessButtonController;
use App\Http\Controllers\Admin\SectionController;
use App\Http\Controllers\Admin\SeoController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\ServiceSectionController;
use App\Http\Controllers\Admin\SiteImageController;
use App\Http\Controllers\Admin\SiteInfoController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\SocialController;
use App\Http\Controllers\Admin\SoftwareCategoryController;
use App\Http\Controllers\Admin\SoftwareController;
use App\Http\Controllers\Admin\SoftwareSectionController;
use App\Http\Controllers\Admin\StartSaleController;
use App\Http\Controllers\Admin\SubscribeController;
use App\Http\Controllers\Admin\TawkToController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Admin\TestimonialSectionController;
use App\Http\Controllers\Admin\WhatsappChatController;
use App\Http\Controllers\Admin\WhatsappChatSectionController;
use App\Http\Controllers\Admin\WhatsappOrderRequestController;
use App\Http\Controllers\Admin\WorkProcessController;
use App\Http\Controllers\Admin\WorkProcessSectionController;
use App\Http\Controllers\Frontend\HomeController;
use App\Models\Admin\OrderMode;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

if (Schema::hasTable('order_modes')) {
    // Retrieve the first model
    $order_mode = OrderMode::first();

}


Route::get('register', function () {
    return redirect()->route('homepage');
});

// Start Password Reset Link
Route::post('/forgot-password', function (Request $request) {
    $request->validate(['email' => 'required|email']);

    $status = Password::sendResetLink(
        $request->only('email')
    );

    return $status === Password::RESET_LINK_SENT
        ? back()->with(['status' => __($status)])
        : back()->withErrors(['email' => __($status)]);
})->middleware('guest')->name('password.email');

Route::post('/reset-password', function (Request $request) {
    $request->validate([
        'token' => 'required',
        'email' => 'required|email',
        'password' => 'required|min:8|confirmed',
    ]);

    $status = Password::reset(
        $request->only('email', 'password', 'password_confirmation', 'token'),
        function ($user, $password) {
            $user->forceFill([
                'password' => Hash::make($password)
            ])->setRememberToken(Str::random(60));

            $user->save();

            event(new PasswordReset($user));
        }
    );

    return $status === Password::PASSWORD_RESET
        ? redirect()->route('login')->with('status', __($status))
        : back()->withErrors(['email' => [__($status)]]);
})->middleware('guest')->name('password.update');
// End Password Reset Link

// Start Site Frontend Route
Route::get('/', [HomeController::class, 'index'])->name('homepage')->middleware('XSS');

Route::middleware(['XSS'])->group(function () {
    Route::get('order/special/period/{slug}', [App\Http\Controllers\Frontend\OrderPeriodController::class, 'show'])
        ->name('order-period-page.show');
});

Route::middleware(['XSS'])->group(function () {
    Route::get('cart', [\App\Http\Controllers\Frontend\CartController::class, 'index'])
        ->name('cart-page.index');
    Route::post('add-to-cart', [App\Http\Controllers\Frontend\CartController::class, 'store'])
        ->name('add-to-cart-page.store');
    Route::post('add-to-cart-software', [App\Http\Controllers\Frontend\CartController::class, 'store_software'])
        ->name('add-to-cart-software-page.store_software');
    Route::delete('cart/destroy-my-cart-order/{id}', [App\Http\Controllers\Frontend\CartController::class, 'destroy_my_cart_order'])
        ->name('cart-page.destroy_my_cart_order');

});


Route::get('sign-up', [\App\Http\Controllers\Frontend\SignUpController::class, 'index'])
    ->name('sign-up-page.index');

Route::post('sign-up', [\App\Http\Controllers\Frontend\SignUpController::class, 'store'])
    ->name('sign-up-page.store');


Route::get('sign-in', [\App\Http\Controllers\Frontend\SignInController::class, 'index'])
    ->name('sign-in-page.index');

Route::post('sign-in', [\App\Http\Controllers\Frontend\SignInController::class, 'authenticate'])
    ->name('sign-in.authenticate');


Route::get('profile', [\App\Http\Controllers\Frontend\ProfileController::class, 'index'])
    ->name('profile-page.index');
Route::get('profile/edit', [\App\Http\Controllers\Frontend\ProfileController::class, 'edit'])
    ->name('profile-page.edit');
Route::put('profile/{id}', [\App\Http\Controllers\Frontend\ProfileController::class, 'update'])
    ->name('profile-page.update');
Route::get('profile/change-password', [\App\Http\Controllers\Frontend\ProfileController::class, 'change_password_edit'])
    ->name('profile-page.change_password_edit');
Route::put('profile/change-password/update', [\App\Http\Controllers\Frontend\ProfileController::class, 'change_password_update'])
    ->name('profile-page.change_password_update');


Route::middleware(['auth:sanctum', 'verified', 'XSS'])->group(function () {
    Route::get('my-cart', [\App\Http\Controllers\Frontend\CartController::class, 'index_my_cart'])
        ->name('cart-page.index_my_cart');
});

Route::get('cart/destroy-order/{order_id}', [\App\Http\Controllers\Frontend\CartController::class, 'destroy_order'])
    ->name('cart-page.destroy_order')->middleware('XSS');

Route::middleware(['XSS'])->group(function () {
    Route::get('services', [\App\Http\Controllers\Frontend\ServiceController::class, 'index'])
        ->name('service-page.index');
    Route::get('service/{slug}', [App\Http\Controllers\Frontend\ServiceController::class, 'show'])
        ->name('service-page.show');
});

Route::middleware(['XSS'])->group(function () {
    Route::get('software', [\App\Http\Controllers\Frontend\SoftwareController::class, 'index'])
        ->name('software-page.index');
    Route::get('software/{slug}', [App\Http\Controllers\Frontend\SoftwareController::class, 'show'])
        ->name('software-page.show');
    Route::get('software/category/{category_name}', [App\Http\Controllers\Frontend\SoftwareController::class, 'category_show'])
        ->name('software-category.show');
    Route::post('software/search', [App\Http\Controllers\Frontend\SoftwareController::class, 'search'])
        ->name('software-page.search');
});

Route::middleware(['XSS'])->group(function () {
    Route::get('order/software/period/{slug}', [App\Http\Controllers\Frontend\OrderSoftwarePeriodController::class, 'show'])
        ->name('order-software-period-page.show');
});

Route::get('demo-request/{slug}', [App\Http\Controllers\Frontend\DemoRequestController::class, 'show'])
    ->name('demo-request-page.show')->middleware('XSS');
Route::post('demo-request', [App\Http\Controllers\Frontend\DemoRequestController::class, 'store'])
    ->name('demo-request-page.store')->middleware('XSS');
Route::get('demo-request-info', [App\Http\Controllers\Frontend\DemoRequestController::class, 'show_demo_request_info'])
    ->name('demo-request-info-page.show_demo_request_info')->middleware('XSS');

Route::get('demo-request/software/{slug}', [App\Http\Controllers\Frontend\DemoRequestController::class, 'show_demo_software'])
    ->name('demo-request-page.show_demo_software')->middleware('XSS');

Route::get('order-via-whatsapp/{slug}', [App\Http\Controllers\Frontend\OrderViaWhatsappController::class, 'show'])
    ->name('order-via-whatsapp-page.show')->middleware('XSS');
Route::post('order-via-whatsapp', [App\Http\Controllers\Frontend\OrderViaWhatsappController::class, 'store'])
    ->name('order-via-whatsapp-page.store')->middleware('XSS');

Route::middleware(['XSS'])->group(function () {
    Route::get('blogs', [\App\Http\Controllers\Frontend\BlogController::class, 'index'])->name('blog-page.index');
    Route::get('blog/{slug}', [App\Http\Controllers\Frontend\BlogController::class, 'show'])->name('blog-page.show');
    Route::get('blog/category/{category_name}', [App\Http\Controllers\Frontend\BlogController::class, 'category_show'])->name('blog-category.show');
    Route::post('blog/search', [App\Http\Controllers\Frontend\BlogController::class, 'search'])->name('blog-page.search');
});

Route::get('page/{page_slug}', [App\Http\Controllers\Frontend\PageController::class, 'show'])
    ->name('any-page.show')->middleware('XSS');

Route::get('page/other/faqs', [App\Http\Controllers\Frontend\PageController::class, 'show_faq'])
    ->name('any-page.show_faq')->middleware('XSS');

Route::post('comment', [App\Http\Controllers\Frontend\CommentController::class, 'store'])
    ->name('comment.store')->middleware('XSS');

Route::post('subscribe', [\App\Http\Controllers\Frontend\SubscribeController::class, 'store'])
    ->name('subscribe-section.store')->middleware('XSS');

Route::post('message', [App\Http\Controllers\Frontend\MessageController::class, 'store'])
    ->name('message.store')->middleware('XSS');
// End Site Frontend Route

// Start Site Admin Route
Route::middleware(['auth:sanctum', 'verified', 'XSS', 'role:super-admin'])->prefix('admin')->group(function () {
    Route::get('admin-role', [AdminRoleController::class, 'index'])->name('admin-role.index');
    Route::get('admin-role/create', [AdminRoleController::class, 'create'])->name('admin-role.create');
    Route::post('admin-role', [AdminRoleController::class, 'store'])->name('admin-role.store');
    Route::get('admin-role/{id}/edit', [AdminRoleController::class, 'edit'])->name('admin-role.edit');
    Route::put('admin-role/{id}', [AdminRoleController::class, 'update'])->name('admin-role.update');
    Route::delete('admin-role/{id}', [AdminRoleController::class, 'destroy'])->name('admin-role.destroy');
});

Route::middleware(['auth:sanctum', 'verified', 'XSS', 'role:super-admin'])->prefix('admin')->group(function () {
    Route::get('admin-user', [AdminUserController::class, 'index'])->name('admin-user.index');
    Route::get('admin-user/create', [AdminUserController::class, 'create'])->name('admin-user.create');
    Route::post('admin-user', [AdminUserController::class, 'store'])->name('admin-user.store');
    Route::get('admin-user/{id}/edit', [AdminUserController::class, 'edit'])->name('admin-user.edit');
    Route::put('admin-user/{id}', [AdminUserController::class, 'update'])->name('admin-user.update');
    Route::delete('admin-user/{id}', [AdminUserController::class, 'destroy'])->name('admin-user.destroy');
});

Route::middleware(['auth:sanctum', 'verified', 'XSS', 'permission:uploads check'])->prefix('admin')->group(function () {
    Route::get('photo/create', [PhotoController::class, 'create'])->name('photo.create');
    Route::post('photo', [PhotoController::class, 'store'])->name('photo.store');
    Route::get('photo/{id}/edit', [PhotoController::class, 'edit'])->name('photo.edit');
    Route::put('photo/{id}', [PhotoController::class, 'update'])->name('photo.update');
    Route::delete('photo/{id}', [PhotoController::class, 'destroy'])->name('photo.destroy');
});

Route::middleware(['auth:sanctum', 'verified', 'XSS', 'permission:subscribe check'])->prefix('admin')->group(function () {
    Route::get('subscribe/create', [SubscribeController::class, 'create'])->name('subscribe.create');
    Route::post('subscribe', [SubscribeController::class, 'store'])->name('subscribe.store');
    Route::delete('subscribe/{id}', [SubscribeController::class, 'destroy'])->name('subscribe.destroy');
});

Route::middleware(['auth:sanctum', 'verified', 'XSS', 'permission:start sale check'])->prefix('admin')->group(function () {
    Route::get('start-sale', [StartSaleController::class, 'index'])->name('start-sale.index');
    Route::get('start-sale/create', [StartSaleController::class, 'create'])->name('start-sale.create');
    Route::post('start-sale', [StartSaleController::class, 'store'])->name('start-sale.store');
    Route::get('start-sale/{id}/edit', [StartSaleController::class, 'edit'])->name('start-sale.edit');
    Route::put('start-sale/{id}', [StartSaleController::class, 'update'])->name('start-sale.update');
    Route::delete('start-sale/{id}', [StartSaleController::class, 'destroy'])->name('start-sale.destroy');
    Route::delete('start-sale-checked', [StartSaleController::class, 'destroy_checked'])->name('start-sale.destroy_checked');
});

if (isset($order_mode)) {

    if ($order_mode->order_mode == "with_free_trial") {
        Route::middleware(['auth:sanctum', 'verified', 'XSS', 'permission:demo request check'])->prefix('admin')->group(function () {
            Route::get('demo-request', [DemoRequestController::class, 'index'])->name('demo-request.index');
            Route::put('demo-request-mark-read/{id}', [DemoRequestController::class, 'update_mark'])->name('demo-request.update_mark');
            Route::patch('demo-request/mark_all', [DemoRequestController::class, 'mark_all_read_update'])->name('demo-request.mark_all_read_update');
            Route::delete('demo-request/{id}', [DemoRequestController::class, 'destroy'])->name('demo-request.destroy');


            Route::get('demo-request/create', [DemoRequestSectionController::class, 'create'])->name('demo-request.create');
            Route::post('demo-request', [DemoRequestSectionController::class, 'store'])->name('demo-request.store');
            Route::put('demo-request/{id}', [DemoRequestSectionController::class, 'update'])->name('demo-request.update');
        });
    } elseif ($order_mode->order_mode == "via_whatsapp") {
        Route::middleware(['auth:sanctum', 'verified', 'XSS', 'permission:whatsapp order request check'])->prefix('admin')->group(function () {
            Route::get('whatsapp-order-request', [WhatsappOrderRequestController::class, 'index'])->name('whatsapp-order-request.index');
            Route::put('whatsapp-order-request-mark-read/{id}', [WhatsappOrderRequestController::class, 'update_mark'])->name('whatsapp-order-request.update_mark');
            Route::patch('whatsapp-order-request/mark_all', [WhatsappOrderRequestController::class, 'mark_all_read_update'])->name('whatsapp-order-request.mark_all_read_update');
            Route::delete('whatsapp-order-request/{id}', [WhatsappOrderRequestController::class, 'destroy'])->name('whatsapp-order-request.destroy');
        });
    }

} else {
    Route::middleware(['auth:sanctum', 'verified', 'XSS', 'permission:demo request check'])->prefix('admin')->group(function () {
        Route::get('demo-request', [DemoRequestController::class, 'index'])->name('demo-request.index');
        Route::put('demo-request-mark-read/{id}', [DemoRequestController::class, 'update_mark'])->name('demo-request.update_mark');
        Route::patch('demo-request/mark_all', [DemoRequestController::class, 'mark_all_read_update'])->name('demo-request.mark_all_read_update');
        Route::delete('demo-request/{id}', [DemoRequestController::class, 'destroy'])->name('demo-request.destroy');


        Route::get('demo-request/create', [DemoRequestSectionController::class, 'create'])->name('demo-request.create');
        Route::post('demo-request', [DemoRequestSectionController::class, 'store'])->name('demo-request.store');
        Route::put('demo-request/{id}', [DemoRequestSectionController::class, 'update'])->name('demo-request.update');
    });
}

Route::middleware(['auth:sanctum', 'verified', 'XSS', 'permission:blogs check'])->prefix('admin')->group(function () {
    Route::get('category/create', [CategoryController::class, 'create'])->name('blog-category.create');
    Route::post('category', [CategoryController::class, 'store'])->name('blog-category.store');
    Route::get('category/{id}/edit', [CategoryController::class, 'edit'])->name('blog-category.edit');
    Route::put('category/{id}', [CategoryController::class, 'update'])->name('blog-category.update');
    Route::delete('category/{id}', [CategoryController::class, 'destroy'])->name('blog-category.destroy');
    Route::delete('category-checked', [CategoryController::class, 'destroy_checked'])->name('blog-category.destroy_checked');
});

Route::middleware(['auth:sanctum', 'verified', 'XSS', 'permission:blogs check'])->prefix('admin')->group(function () {
    Route::get('blog', [BlogController::class, 'index'])->name('blog.index');
    Route::get('blog/create', [BlogController::class, 'create'])->name('blog.create');
    Route::post('blog', [BlogController::class, 'store'])->name('blog.store');
    Route::get('blog/{id}/edit', [BlogController::class, 'edit'])->name('blog.edit');
    Route::put('blog/{id}', [BlogController::class, 'update'])->name('blog.update');
    Route::delete('blog/{id}', [BlogController::class, 'destroy'])->name('blog.destroy');
    Route::delete('blog-checked', [BlogController::class, 'destroy_checked'])->name('blog.destroy_checked');

    Route::post('blog-section', [BlogSectionController::class, 'store'])->name('blog-section.store');
    Route::put('blog-section/{id}', [BlogSectionController::class, 'update'])->name('blog-section.update');

    Route::get('blog-paginate/create', [BlogController::class, 'create_paginate'])->name('blog-paginate.create_paginate');
    Route::post('blog-paginate', [BlogController::class, 'store_paginate'])->name('blog-paginate.store_paginate');
    Route::put('blog-paginate/{id}', [BlogController::class, 'update_paginate'])->name('blog-paginate.update_paginate');
});

Route::middleware(['auth:sanctum', 'verified', 'XSS', 'permission:banner check'])->prefix('admin')->group(function () {
    Route::get('slider/create', [SliderController::class, 'create'])->name('slider.create');
    Route::post('slider', [SliderController::class, 'store'])->name('slider.store');
    Route::get('slider/{id}/edit', [SliderController::class, 'edit'])->name('slider.edit');
    Route::put('slider/{id}', [SliderController::class, 'update'])->name('slider.update');
    Route::delete('slider/{id}', [SliderController::class, 'destroy'])->name('slider.destroy');
    Route::delete('slider-checked', [SliderController::class, 'destroy_checked'])->name('slider.destroy_checked');
});

Route::middleware(['auth:sanctum', 'verified', 'XSS', 'permission:banner check'])->prefix('admin')->group(function () {
    Route::get('fixed-content/create', [FixedContentController::class, 'create'])->name('fixed-content.create');
    Route::post('fixed-content', [FixedContentController::class, 'store'])->name('fixed-content.store');
    Route::put('fixed-content/{id}', [FixedContentController::class, 'update'])->name('fixed-content.update');
});

Route::middleware(['auth:sanctum', 'verified', 'XSS', 'permission:banner check'])->prefix('admin')->group(function () {
    Route::get('homepage-version/create', [HomepageVersionController::class, 'create'])->name('homepage-version.create');
    Route::put('homepage-version/{id}', [HomepageVersionController::class, 'update'])->name('homepage-version.update');
});

Route::middleware(['auth:sanctum', 'verified', 'XSS',  'permission:about us check'])->prefix('admin')->group(function () {
    Route::get('about/create', [AboutController::class, 'create'])->name('about.create');
    Route::post('about', [AboutController::class, 'store'])->name('about.store');
    Route::put('about/{id}', [AboutController::class, 'update'])->name('about.update');

    Route::post('info-list', [AboutController::class, 'store_info_list'])->name('about.store_info_list');
    Route::get('info-list/{id}/edit', [AboutController::class, 'edit_info_list'])->name('about.edit_info_list');
    Route::put('info-list/{id}', [AboutController::class, 'update_info_list'])->name('about.update_info_list');
    Route::delete('info-list/{id}', [AboutController::class, 'destroy_info_list'])->name('about.destroy_info_list');
    Route::delete('info-list-checked', [AboutController::class, 'destroy_checked'])->name('about.destroy_checked');
});

Route::middleware(['auth:sanctum', 'verified', 'XSS', 'permission:work processes check'])->prefix('admin')->group(function () {
    Route::get('work-process/create', [WorkProcessController::class, 'create'])->name('work-process.create');
    Route::post('work-process', [WorkProcessController::class, 'store'])->name('work-process.store');
    Route::get('work-process/{id}/edit', [WorkProcessController::class, 'edit'])->name('work-process.edit');
    Route::put('work-process/{id}', [WorkProcessController::class, 'update'])->name('work-process.update');
    Route::delete('work-process/{id}', [WorkProcessController::class, 'destroy'])->name('work-process.destroy');
    Route::delete('work-process-checked', [WorkProcessController::class, 'destroy_checked'])->name('work-process.destroy_checked');

    Route::post('work-process-section', [WorkProcessSectionController::class, 'store'])->name('work-process-section.store');
    Route::put('work-process-section/{id}', [WorkProcessSectionController::class, 'update'])->name('work-process-section.update');
});

Route::middleware(['auth:sanctum', 'verified', 'XSS',  'permission:about us check'])->prefix('admin')->group(function () {
    Route::get('feature/create', [FeatureController::class, 'create'])->name('feature.create');
    Route::post('feature', [FeatureController::class, 'store'])->name('feature.store');
    Route::put('feature/{id}', [FeatureController::class, 'update'])->name('feature.update');

    Route::post('feature-info-list', [FeatureController::class, 'store_info_list'])->name('feature.store_info_list');
    Route::get('feature-info-list/{id}/edit', [FeatureController::class, 'edit_info_list'])->name('feature.edit_info_list');
    Route::put('feature-info-list/{id}', [FeatureController::class, 'update_info_list'])->name('feature.update_info_list');
    Route::delete('feature-info-list/{id}', [FeatureController::class, 'destroy_info_list'])->name('feature.destroy_info_list');
    Route::delete('feature-info-list-checked', [FeatureController::class, 'destroy_checked'])->name('feature.destroy_checked');
});

Route::middleware(['auth:sanctum', 'verified', 'XSS', 'permission:testimonials check'])->prefix('admin')->group(function () {
    Route::get('testimonial/create', [TestimonialController::class, 'create'])->name('testimonial.create');
    Route::post('testimonial', [TestimonialController::class, 'store'])->name('testimonial.store');
    Route::get('testimonial/{id}/edit', [TestimonialController::class, 'edit'])->name('testimonial.edit');
    Route::put('testimonial/{id}', [TestimonialController::class, 'update'])->name('testimonial.update');
    Route::delete('testimonial/{id}', [TestimonialController::class, 'destroy'])->name('testimonial.destroy');
    Route::delete('testimonial-checked', [TestimonialController::class, 'destroy_checked'])->name('testimonial.destroy_checked');

    Route::post('testimonial-section', [TestimonialSectionController::class, 'store'])->name('testimonial-section.store');
    Route::put('testimonial-section/{id}', [TestimonialSectionController::class, 'update'])->name('testimonial-section.update');
});

Route::middleware(['auth:sanctum', 'verified', 'XSS', 'permission:partners check'])->prefix('admin')->group(function () {
    Route::get('partner/create', [PartnerController::class, 'create'])->name('partner.create');
    Route::post('partner', [PartnerController::class, 'store'])->name('partner.store');
    Route::get('partner/{id}/edit', [PartnerController::class, 'edit'])->name('partner.edit');
    Route::put('partner/{id}', [PartnerController::class, 'update'])->name('partner.update');
    Route::delete('partner/{id}', [PartnerController::class, 'destroy'])->name('partner.destroy');
    Route::delete('partner-checked', [PartnerController::class, 'destroy_checked'])->name('partner.destroy_checked');

    Route::post('partner-section', [PartnerSectionController::class, 'store'])->name('partner-section.store');
    Route::put('partner-section/{id}', [PartnerSectionController::class, 'update'])->name('partner-section.update');
});

Route::middleware(['auth:sanctum', 'verified', 'XSS', 'permission:faq check'])->prefix('admin')->group(function () {
    Route::get('faq/create', [FaqController::class, 'create'])->name('faq.create');
    Route::post('faq', [FaqController::class, 'store'])->name('faq.store');
    Route::get('faq/{id}/edit', [FaqController::class, 'edit'])->name('faq.edit');
    Route::put('faq/{id}', [FaqController::class, 'update'])->name('faq.update');
    Route::delete('faq/{id}', [FaqController::class, 'destroy'])->name('faq.destroy');
    Route::delete('faq-checked', [FaqController::class, 'destroy_checked'])->name('faq.destroy_checked');

    Route::post('faq-section', [FaqSectionController::class, 'store'])->name('faq-section.store');
    Route::put('faq-section/{id}', [FaqSectionController::class, 'update'])->name('faq-section.update');
});

Route::middleware(['auth:sanctum', 'verified', 'XSS', 'permission:prices check'])->prefix('admin')->group(function () {
    Route::get('price/create', [PriceController::class, 'create'])->name('price.create');
    Route::post('price', [PriceController::class, 'store'])->name('price.store');
    Route::get('price/{id}/edit', [PriceController::class, 'edit'])->name('price.edit');
    Route::put('price/{id}', [PriceController::class, 'update'])->name('price.update');
    Route::delete('price/{id}', [PriceController::class, 'destroy'])->name('price.destroy');
    Route::delete('price-checked', [PriceController::class, 'destroy_checked'])->name('price.destroy_checked');

    Route::post('price-section', [PriceSectionController::class, 'store'])->name('price-section.store');
    Route::put('price-section/{id}', [PriceSectionController::class, 'update'])->name('price-section.update');
});

Route::middleware(['auth:sanctum', 'verified', 'XSS', 'permission:services check'])->prefix('admin')->group(function () {
    Route::get('service', [ServiceController::class, 'index'])->name('service.index');
    Route::get('service/create', [ServiceController::class, 'create'])->name('service.create');
    Route::post('service', [ServiceController::class, 'store'])->name('service.store');
    Route::get('service/{id}/edit', [ServiceController::class, 'edit'])->name('service.edit');
    Route::put('service/{id}', [ServiceController::class, 'update'])->name('service.update');
    Route::delete('service/{id}', [ServiceController::class, 'destroy'])->name('service.destroy');
    Route::delete('service-checked', [ServiceController::class, 'destroy_checked'])->name('service.destroy_checked');

    Route::post('service-section', [ServiceSectionController::class, 'store'])->name('service-section.store');
    Route::put('service-section/{id}', [ServiceSectionController::class, 'update'])->name('service-section.update');
});

Route::middleware(['auth:sanctum', 'verified', 'XSS', 'permission:software check'])->prefix('admin')->group(function () {
    Route::get('software-category/create', [SoftwareCategoryController::class, 'create'])->name('software-category.create');
    Route::post('software-category', [SoftwareCategoryController::class, 'store'])->name('software-category.store');
    Route::get('software-category/{id}/edit', [SoftwareCategoryController::class, 'edit'])->name('software-category.edit');
    Route::put('software-category/{id}', [SoftwareCategoryController::class, 'update'])->name('software-category.update');
    Route::delete('software-category/{id}', [SoftwareCategoryController::class, 'destroy'])->name('software-category.destroy');
    Route::delete('software-category-checked', [SoftwareCategoryController::class, 'destroy_checked'])->name('software-category.destroy_checked');
});

Route::middleware(['auth:sanctum', 'verified', 'XSS', 'permission:software check'])->prefix('admin')->group(function () {
    Route::get('software', [SoftwareController::class, 'index'])->name('software.index');
    Route::get('software/create', [SoftwareController::class, 'create'])->name('software.create');
    Route::post('software', [SoftwareController::class, 'store'])->name('software.store');
    Route::get('software/{id}/edit', [SoftwareController::class, 'edit'])->name('software.edit');
    Route::put('software/{id}', [SoftwareController::class, 'update'])->name('software.update');
    Route::delete('software/{id}', [SoftwareController::class, 'destroy'])->name('software.destroy');
    Route::delete('software-checked', [SoftwareController::class, 'destroy_checked'])->name('software.destroy_checked');

    Route::post('software-section', [SoftwareSectionController::class, 'store'])->name('software-section.store');
    Route::put('software-section/{id}', [SoftwareSectionController::class, 'update'])->name('software-section.update');

});

Route::middleware(['auth:sanctum', 'verified', 'XSS', 'permission:currency check'])->prefix('admin')->group(function () {
    Route::get('currency/create', [CurrencyController::class, 'create'])->name('currency.create');
    Route::post('currency', [CurrencyController::class, 'store'])->name('currency.store');
    Route::put('currency/{id}', [CurrencyController::class, 'update'])->name('currency.update');
});


Route::middleware(['auth:sanctum', 'verified', 'XSS', 'permission:external url check'])->prefix('admin')->group(function () {
    Route::get('external-url/create', [ExternalUrlController::class, 'create'])->name('external-url.create');
    Route::post('external-url', [ExternalUrlController::class, 'store'])->name('external-url.store');
    Route::put('external-url/{id}', [ExternalUrlController::class, 'update'])->name('external-url.update');
});

Route::middleware(['auth:sanctum', 'verified', 'XSS', 'permission:settings check'])->prefix('admin')->group(function () {
    Route::get('site-info/create', [SiteInfoController::class, 'create'])->name('site-info.create');
    Route::post('site-info', [SiteInfoController::class, 'store'])->name('site-info.store');
    Route::put('site-info/{id}', [SiteInfoController::class, 'update'])->name('site-info.update');
});

Route::middleware(['auth:sanctum', 'verified', 'XSS', 'permission:settings check'])->prefix('admin')->group(function () {
    Route::get('site-image/create', [SiteImageController::class, 'create'])->name('site-image.create');
    Route::post('site-image', [SiteImageController::class, 'store'])->name('site-image.store');
    Route::put('site-image/{id}', [SiteImageController::class, 'update'])->name('site-image.update');
});

Route::middleware(['auth:sanctum', 'verified', 'XSS', 'permission:settings check'])->prefix('admin')->group(function () {
    Route::get('google-analytic/create', [GoogleAnalyticController::class, 'create'])->name('google-analytic.create');
    Route::post('google-analytic', [GoogleAnalyticController::class, 'store'])->name('google-analytic.store');
    Route::put('google-analytic/{id}', [GoogleAnalyticController::class, 'update'])->name('google-analytic.update');
});

Route::middleware(['auth:sanctum', 'verified', 'XSS', 'permission:settings check'])->prefix('admin')->group(function () {
    Route::get('breadcrumb/create', [BreadcrumbController::class, 'create'])->name('breadcrumb.create');
    Route::post('breadcrumb', [BreadcrumbController::class, 'store'])->name('breadcrumb.store');
    Route::put('breadcrumb/{id}', [BreadcrumbController::class, 'update'])->name('breadcrumb.update');
});

Route::middleware(['auth:sanctum', 'verified', 'XSS', 'permission:settings check'])->prefix('admin')->group(function () {
    Route::get('section/create',  [SectionController::class, 'create'])->name('section.create');
    Route::patch('section/{id}',  [SectionController::class, 'update'])->name('section.update');
});

Route::middleware(['auth:sanctum', 'verified', 'XSS', 'permission:settings check'])->prefix('admin')->group(function () {
    Route::get('seo/create', [SeoController::class, 'create'])->name('seo.create');
    Route::post('seo', [SeoController::class, 'store'])->name('seo.store');
    Route::put('seo/{id}', [SeoController::class, 'update'])->name('seo.update');
});

Route::middleware(['auth:sanctum', 'verified', 'XSS', 'permission:settings check'])->prefix('admin')->group(function () {
    Route::get('tawk-to/create', [TawkToController::class, 'create'])->name('tawk-to.create');
    Route::post('tawk-to', [TawkToController::class, 'store'])->name('tawk-to.store');
    Route::put('tawk-to/{id}', [TawkToController::class, 'update'])->name('tawk-to.update');
});

Route::middleware(['auth:sanctum', 'verified', 'XSS', 'permission:settings check'])->prefix('admin')->group(function () {
    Route::get('whatsapp-chat/create', [WhatsappChatController::class, 'create'])->name('whatsapp-chat.create');
    Route::post('whatsapp-chat', [WhatsappChatController::class, 'store'])->name('whatsapp-chat.store');
    Route::get('whatsapp-chat/{id}/edit', [WhatsappChatController::class, 'edit'])->name('whatsapp-chat.edit');
    Route::put('whatsapp-chat/{id}', [WhatsappChatController::class, 'update'])->name('whatsapp-chat.update');
    Route::delete('whatsapp-chat/{id}', [WhatsappChatController::class, 'destroy'])->name('whatsapp-chat.destroy');
    Route::delete('whatsapp-chat-checked', [WhatsappChatController::class, 'destroy_checked'])->name('whatsapp-chat.destroy_checked');

    Route::post('whatsapp-chat-section', [WhatsappChatSectionController::class, 'store'])->name('whatsapp-chat-section.store');
    Route::put('whatsapp-chat-section/{id}', [WhatsappChatSectionController::class, 'update'])->name('whatsapp-chat-section.update');
});

Route::middleware(['auth:sanctum', 'verified', 'XSS', 'permission:settings check'])->prefix('admin')->group(function () {
    Route::get('color-option/create', [ColorOptionController::class, 'create'])->name('color-option.create');
    Route::post('color-option', [ColorOptionController::class, 'store'])->name('color-option.store');
    Route::put('color-option/{id}', [ColorOptionController::class, 'update'])->name('color-option.update');
});

Route::middleware(['auth:sanctum', 'verified', 'XSS', 'permission:contact check'])->prefix('admin')->group(function () {
    Route::get('contact/create', [ContactController::class, 'create'])->name('contact.create');
    Route::post('contact', [ContactController::class, 'store'])->name('contact.store');
    Route::put('contact/{id}', [ContactController::class, 'update'])->name('contact.update');
});

Route::middleware(['auth:sanctum', 'verified', 'XSS', 'permission:contact check'])->prefix('admin')->group(function () {
    Route::get('social/create', [SocialController::class, 'create'])->name('social.create');
    Route::post('social', [SocialController::class, 'store'])->name('social.store');
    Route::get('social/{id}/edit', [SocialController::class, 'edit'])->name('social.edit');
    Route::put('social/{id}', [SocialController::class, 'update'])->name('social.update');
    Route::patch('social/update_status/{id}', [SocialController::class, 'update_status'])->name('social.update_status');
    Route::delete('social/{id}', [SocialController::class, 'destroy'])->name('social.destroy');
});

Route::middleware(['auth:sanctum', 'verified', 'XSS', 'permission:contact check'])->prefix('admin')->group(function () {
    Route::get('quick-access/create', [QuickAccessButtonController::class, 'create'])->name('quick-access.create');
    Route::post('quick-access', [QuickAccessButtonController::class, 'store'])->name('quick-access.store');
    Route::put('quick-access/{id}', [QuickAccessButtonController::class, 'update'])->name('quick-access.update');
});

Route::middleware(['auth:sanctum', 'verified', 'permission:contact check'])->prefix('admin')->group(function () {
    Route::get('message', [MessageController::class, 'index'])->name('message.index');
    Route::put('message/{id}', [MessageController::class, 'update'])->name('message.update');
    Route::patch('message/mark_all', [MessageController::class, 'mark_all_read_update'])->name('message.mark_all_read_update');
    Route::delete('message/{id}', [MessageController::class, 'destroy'])->name('message.destroy');
});

Route::middleware(['auth:sanctum', 'verified', 'XSS', 'permission:pages check'])->prefix('admin')->group(function () {
    Route::get('page', [PageController::class, 'index'])->name('page.index');
    Route::get('page/create', [PageController::class, 'create'])->name('page.create');
    Route::post('page', [PageController::class, 'store'])->name('page.store');
    Route::get('page/{id}/edit', [PageController::class, 'edit'])->name('page.edit');
    Route::put('page/{id}', [PageController::class, 'update'])->name('page.update');
    Route::delete('page/{id}', [PageController::class, 'destroy'])->name('page.destroy');
    Route::delete('page-checked', [PageController::class, 'destroy_checked'])->name('page.destroy_checked');
});

Route::middleware(['auth:sanctum', 'verified', 'XSS', 'permission:comments check'])->prefix('admin')->group(function () {
    Route::get('comment', [CommentSectionController::class, 'index'])->name('comment-section.index');
    Route::put('comment/{id}', [CommentSectionController::class, 'update'])->name('comment-section.update');
    Route::patch('comment/mark_all', [CommentSectionController::class, 'mark_all_approval_update'])->name('comment-section.mark_all_approval_update');
    Route::delete('comment/{id}', [CommentSectionController::class, 'destroy'])->name('comment-section.destroy');
});

Route::middleware(['auth:sanctum', 'verified', 'XSS', 'permission:order mode check'])->prefix('admin')->group(function () {
    Route::get('order-mode/create', [OrderModeController::class, 'create'])->name('order-mode.create');
    Route::post('order-mode', [OrderModeController::class, 'store'])->name('order-mode.store');
    Route::put('order-mode/{id}', [OrderModeController::class, 'update'])->name('order-mode.update');
});



Route::post('admin/demo-mode', [DemoModeController::class, 'update_demo_mode'])->name('admin.demo_mode');;

Route::get('preview', [PreviewController::class, 'index'])
    ->name('preview.index')->middleware('XSS');

Route::get('preview/set-homepage/{choose_version_id}', [PreviewController::class, 'set_homepage'])
    ->name('preview.set_homepage')->middleware('XSS');
// End Landing Site Admin Route



Route::middleware(['auth:sanctum', 'verified', 'XSS'])->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

Route::middleware(['auth:sanctum', 'verified', 'XSS'])->prefix('admin')->group(function () {
    Route::get('profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('profile/{id}', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('profile/change-password', [ProfileController::class, 'change_password_edit'])->name('profile.change_password_edit');
    Route::put('profile/change-password/update', [ProfileController::class, 'change_password_update'])->name('profile.change_password_update');
});

Route::middleware(['auth:sanctum', 'verified', 'XSS', 'permission:language check'])->prefix('admin')->group(function () {
    Route::get('language/create', [LanguageController::class, 'create'])->name('language.create');
    Route::post('language', [LanguageController::class, 'store'])->name('language.store');
    Route::get('language/{id}/edit', [LanguageController::class, 'edit'])->name('language.edit');
    Route::patch('language/language-select', [LanguageController::class, 'update_language'])->name('language.update_language');
    Route::patch('language/processed-language', [LanguageController::class, 'update_processed_language'])->name('language.update_processed_language');
    Route::put('language/{id}', [LanguageController::class, 'update'])->name('language.update');
    Route::patch('language/update_display_dropdown/{id}', [LanguageController::class, 'update_display_dropdown'])->name('language.update_display_dropdown');
    Route::delete('language/{id}', [LanguageController::class, 'destroy'])->name('language.destroy');
});

Route::get('language/set-locale/{language_id}', [LanguageController::class, 'set_locale'])
    ->name('language.set_locale')->middleware('XSS');

Route::middleware(['auth:sanctum', 'verified', 'XSS', 'permission:language check'])->prefix('admin')->group(function () {

    Route::get('language-keyword-for-adminpanel/create/{id}', [LanguageKeywordController::class, 'create'])
        ->name('language-keyword-for-adminpanel.create');
    Route::get('language-keyword-for-frontend/frontend-create/{id}', [LanguageKeywordController::class, 'frontend_create'])
        ->name('language-keyword-for-frontend.frontend_create');

    Route::post('panel-keyword', [LanguageKeywordController::class, 'store_panel_keyword'])
        ->name('panel-keyword.store_panel_keyword');
    Route::put('panel-keyword', [LanguageKeywordController::class, 'update_panel_keyword'])
        ->name('panel-keyword.update_panel_keyword');

    Route::post('frontend-keyword', [LanguageKeywordController::class, 'store_frontend_keyword'])
        ->name('frontend-keyword.store_frontend_keyword');
    Route::put('frontend-keyword', [LanguageKeywordController::class, 'update_frontend_keyword'])
        ->name('frontend-keyword.update_frontend_keyword');


});

Route::middleware(['auth:sanctum', 'verified', 'XSS', 'permission:clear cache check'])->prefix('admin')->group(function () {
    Route::get('clear-cache', function() {
        Artisan::call('cache:clear');
        Artisan::call('route:clear');
        Artisan::call('config:clear');
        Artisan::call('view:clear');
        return redirect()->route('dashboard')
            ->with('success','content.created_successfully');
    });
});

Route::middleware(['XSS'])->group(function () {
    Route::get('run-updater', function() {
        Artisan::call('migrate');
        return "The update is complete :)";
    });
});

Route::any('{catchall}', [ErrorPageController::class, 'not_found'])->where('catchall', '.*');




