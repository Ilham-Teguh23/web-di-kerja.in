<?php

use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ContactMessageController;
use App\Http\Controllers\Master\BenefitController;
use App\Http\Controllers\Master\DetailConsultantController;
use App\Http\Controllers\Master\FAQController;
use App\Http\Controllers\Master\FavoriteItemController;
use App\Http\Controllers\Master\KatalogController;
use App\Http\Controllers\Master\LandingPageController;
use App\Http\Controllers\Master\PriceItemController;
use App\Http\Controllers\Master\TestimonialController;
use App\Http\Controllers\Master\UsersController;
use App\Http\Controllers\PackageItemController;
use App\Http\Controllers\ProductController;
use App\Models\PackageItem;

Route::get("/", [LandingPageController::class,  "index"]);
Route::post('/sending-message', [LandingPageController::class, 'store'])->name('contact-message-store');
Route::prefix("produk")->group(function() {
    Route::get("{slug}", [ProductController::class, "detail"]);
});

Route::group(["middleware" => ["guest"]], function() {
    Route::prefix("auth")->group(function() {
        Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
        Route::post('/login', [LoginController::class, 'login'])->name('login.post');
    });
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['web', 'auth'])->group(function () {

    Route::prefix("auth")->group(function() {
        Route::get("/logout", [DashboardController::class, "authLogout"])->name("auth.logout");
    });
    Route::prefix("master")->group(function() {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('contact-message/datatable', [ContactMessageController::class, 'datatable'])->name('contact-message.datatable');
        Route::resource('contact-message', ContactMessageController::class);

        // Users
        Route::get("/users/datatable", [UsersController::class, "datatable"])->name("users.datatable");
        Route::resource("users", UsersController::class);

        // Katalog
        Route::get("/katalog/datatable", [KatalogController::class, "datatable"])->name("katalog.datatable");
        Route::resource("katalog", KatalogController::class);

        // Testimonials
        Route::put("/testimonials/{id}/update-status", [TestimonialController::class, "updateStatus"])->name("testimonials.updateStatus");
        Route::get("/testimonials/datatable", [TestimonialController::class, "datatable"])->name("testimonials.datatable");
        Route::resource("testimonials", TestimonialController::class);

        // FAQ
        Route::get("/faq/datatable", [FAQController::class, "datatable"])->name("faq.datatable");
        Route::resource("faq", FAQController::class);

        // Benefit
        Route::put("/benefit/{id}/update-status", [BenefitController::class, "updateStatus"])->name("benefit.updateStatus");
        Route::get("/benefit/datatable", [BenefitController::class, "datatable"])->name("benefit.datatable");
        Route::resource("benefit", BenefitController::class);

        // PackageItem
        Route::get("/package-item/datatable", [PackageItemController::class, "datatable"])->name("package-item.datatable");
        Route::get('/package-item/price-options', [PackageItemController::class, 'getPriceOptions'])->name('package-item.price-options');
        Route::get('/package-item/favorite-item-options', [PackageItemController::class, 'getFavoriteItemOptions'])->name('package-item.favorite-item-options');
        Route::get('/package-item/item-consultant-options', [PackageItemController::class, 'getItemConsultantOptions'])->name('package-item.item-consultant-options');
        Route::post('/package-item/update-status-favorite/{id}', [PackageItemController::class, 'updateStatus'])->name('package-item.iupdate-status-favorite-item');
        Route::resource("package-item", PackageItemController::class);

        // Meta Data Favorite Item
        Route::get("/favorite-item/datatable", [FavoriteItemController::class, "datatable"])->name("favorite-item.datatable");
        Route::resource("favorite-item", FavoriteItemController::class);

        // Meta Data Price Item
        Route::get("/price-item/datatable", [PriceItemController::class, "datatable"])->name("price-item.datatable");
        Route::resource("price-item", PriceItemController::class);

        // Meta Data Konsultasi Item
        Route::get("/detail-consultant/datatable", [DetailConsultantController::class, "datatable"])->name("detail-consultant.datatable");
        Route::resource("detail-consultant", DetailConsultantController::class);
    });
});
