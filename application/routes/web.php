<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BackEnd\BackEndController;
use App\Http\Controllers\BackEnd\UserController;
use App\Http\Controllers\BackEnd\ProductController;
use App\Http\Controllers\BackEnd\NotificationController;
use App\Http\Controllers\BackEnd\SettingController;
use App\Http\Controllers\BackEnd\OrderController;
use App\Http\Controllers\BackEnd\MemberController;
use App\Http\Controllers\BackEnd\CategoryController;
use App\Http\Controllers\BackEnd\UnitController;
use App\Http\Controllers\BackEnd\HomeController;
use App\Http\Controllers\BackEnd\AboutController;
use App\Http\Controllers\BackEnd\CareerController;
use App\Http\Controllers\BackEnd\PromoController;
use App\Http\Controllers\BackEnd\OutletController;
use App\Http\Controllers\BackEnd\ContactController;
use App\Http\Controllers\BackEnd\ArticleController;
use App\Http\Controllers\BackEnd\ProvinceController;
use App\Http\Controllers\BackEnd\LocationController;
use App\Http\Controllers\FrontEnd\PageController;

Auth::routes();

// PAGES //
Route::get('/', [PageController::class,'home'])->name('home');
Route::get('/about', [PageController::class,'about'])->name('about');
Route::get('/product/{slug?}', [\App\Http\Controllers\FrontEnd\ProductController::class,'index'])->name('product.detail');
Route::get('/promo', [\App\Http\Controllers\FrontEnd\PromoController::class,'index'])->name('promo');
Route::get('/promo-load-more/{offset?}', [\App\Http\Controllers\FrontEnd\PromoController::class,'loadMore'])->name('promo.get');
Route::get('/outlet', [\App\Http\Controllers\FrontEnd\OutletController::class,'index'])->name('outlet');
Route::get('/outlet-data', [\App\Http\Controllers\FrontEnd\OutletController::class,'indexData'])->name('outlet.data');

Route::get('/career', [\App\Http\Controllers\FrontEnd\CareerController::class,'index'])->name('career');
Route::get('/career-load-more', [\App\Http\Controllers\FrontEnd\CareerController::class,'loadMore'])->name('career.get');
Route::get('/career/{slug?}', [\App\Http\Controllers\FrontEnd\CareerController::class,'detail'])->name('career.detail');
Route::post('/career', [\App\Http\Controllers\FrontEnd\CareerController::class,'save'])->name('career.save');

Route::get('/article', [\App\Http\Controllers\FrontEnd\ArticleController::class,'index'])->name('article');
Route::get('/article-load-more/{offset?}', [\App\Http\Controllers\FrontEnd\ArticleController::class,'loadMore'])->name('article.get');
Route::get('/article/{slug?}', [\App\Http\Controllers\FrontEnd\ArticleController::class,'detail'])->name('article.detail');
Route::get('/contact', [\App\Http\Controllers\FrontEnd\ContactController::class,'index'])->name('contact');
Route::post('/contact', [\App\Http\Controllers\FrontEnd\ContactController::class,'send'])->name('contact.send');

Route::get('/login', [BackEndController::class,'login'])->name('admin.login');
Route::group(['prefix' => 'admin'], function () {
    Route::get('/login', [BackEndController::class,'login'])->name('admin.login');
});

Route::group(['prefix' => 'admin', 'middleware' => ['auth','admin']], function () {
    Route::get('/', [BackEndController::class,'dashboard'])->name('admin.dashboard');
    //Users
    Route::get('/users', [UserController::class,'index'])->name('admin.users');
    Route::get('/userData', [UserController::class,'indexData'])->name('admin.user.data');
    Route::get('/userGet/{id?}', [UserController::class,'getUser'])->name('admin.user.get');
    Route::get('/userDetail/{id?}', [UserController::class,'detail'])->name('admin.user.detail');
    Route::post('/userSave', [UserController::class,'save'])->name('admin.user.save');
    Route::post('/userDelete/{id?}', [UserController::class,'delete'])->name('admin.user.delete');
    Route::get('/userExport', [UserController::class,'export'])->name('admin.user.export');
    Route::get('/userSearch/{search?}', [UserController::class,'search'])->name('admin.user.search');

    //notification
    Route::get('/notifications', [NotificationController::class,'index'])->name('admin.notifications');
    Route::get('/notificationData', [NotificationController::class,'indexData'])->name('admin.notification.data');
    Route::post('/notificationClear', [NotificationController::class,'clear'])->name('admin.notification.clear');

    //SETTING
    Route::get('/settings', [SettingController::class,'index'])->name('admin.settings');
    Route::post('/settingSave', [SettingController::class,'save'])->name('admin.setting.save');

    Route::get('/abouts', [SettingController::class,'about'])->name('admin.abouts');
    Route::post('/aboutSave', [SettingController::class,'aboutSave'])->name('admin.about.save');
    Route::get('/faqs', [SettingController::class,'faq'])->name('admin.faqs');
    Route::post('/faqSave', [SettingController::class,'faqSave'])->name('admin.faq.save');
    Route::get('/sliders', [SettingController::class,'slider'])->name('admin.sliders');
    Route::post('/sliderSave', [SettingController::class,'sliderSave'])->name('admin.slider.save');
    Route::post('/sliderDelete', [SettingController::class,'sliderDelete'])->name('admin.slider.delete');
    Route::get('/banks', [SettingController::class,'bank'])->name('admin.banks');
    Route::post('/bankSave', [SettingController::class,'bankSave'])->name('admin.bank.save');

    // PAGES HOME
    Route::get('/setting-home', [HomeController::class,'index'])->name('admin.pages.home');

    Route::post('/setting-home-hero-save', [HomeController::class,'heroSave'])->name('admin.pages.home.hero.save');
    Route::post('/setting-home-hero-slider-save', [HomeController::class,'heroSliderSave'])->name('admin.pages.home.hero.slider.save');
    Route::post('/setting-home-hero-slider-delete', [HomeController::class,'heroSliderDelete'])->name('admin.pages.home.hero.slider.delete');

    Route::post('/setting-home-about-save', [HomeController::class,'aboutSave'])->name('admin.pages.home.about.save');
    Route::post('/setting-home-product-save', [HomeController::class,'productSave'])->name('admin.pages.home.product.save');

    Route::post('/setting-home-why-us-save', [HomeController::class,'whyUsSave'])->name('admin.pages.home.why-us.save');
    Route::post('/setting-home-why-us-delete', [HomeController::class,'whyUsDelete'])->name('admin.pages.home.why-us.delete');

    Route::post('/setting-home-testimony-save', [HomeController::class,'testimonySave'])->name('admin.pages.home.testimony.save');
    Route::post('/setting-home-testimony-slider-save', [HomeController::class,'testimonySliderSave'])->name('admin.pages.home.testimony.slider.save');
    Route::post('/setting-home-testimony-slider-delete', [HomeController::class,'testimonySliderDelete'])->name('admin.pages.home.testimony.slider.delete');

    // PAGES ABOUT
    Route::get('/setting-about', [AboutController::class,'index'])->name('admin.pages.about');
    Route::post('/setting-about-general-save', [AboutController::class,'save'])->name('admin.pages.about.general.save');
    Route::post('/setting-about-vision-save', [AboutController::class,'visionSave'])->name('admin.pages.about.vision.save');

    Route::post('/setting-about-value-save', [AboutController::class,'valueSave'])->name('admin.pages.about.value.save');
    Route::post('/setting-about-value-delete', [AboutController::class,'valueDelete'])->name('admin.pages.about.value.delete');

    Route::post('/setting-about-area-save', [AboutController::class,'areaSave'])->name('admin.pages.about.area.save');

    Route::post('/setting-about-activity-save', [AboutController::class,'activitySave'])->name('admin.pages.about.activity.save');
    Route::post('/setting-about-activity-image-save', [AboutController::class,'activityImageSave'])->name('admin.pages.about.activity.image.save');
    Route::post('/setting-about-activity-image-delete', [AboutController::class,'activityImageDelete'])->name('admin.pages.about.activity.image.delete');

    // CAREER

    Route::get('/careers', [CareerController::class,'index'])->name('admin.career');
    Route::get('/career-data', [CareerController::class,'indexData'])->name('admin.career.data');
    Route::get('/career-detail/{id?}', [CareerController::class,'detail'])->name('admin.career.detail');
    Route::post('/career-save', [CareerController::class,'save'])->name('admin.career.save');
    Route::post('/career-delete/{id?}', [CareerController::class,'delete'])->name('admin.career.delete');
    Route::get('/career-export', [CareerController::class,'export'])->name('admin.career.export');

    Route::get('/career-submission', [CareerController::class,'indexSubmission'])->name('admin.career.submission');
    Route::get('/career-submission-data', [CareerController::class,'indexDataSubmission'])->name('admin.career.submission.data');
    Route::get('/career-submission-export', [CareerController::class,'exportSubmission'])->name('admin.career.submission.export');

    Route::get('/setting-career', [CareerController::class,'setting'])->name('admin.pages.career');
    Route::post('/setting-career-save', [CareerController::class,'settingSave'])->name('admin.pages.career.general.save');

    Route::post('/setting-career-testimony-item-save', [CareerController::class,'testimonyItemSave'])->name('admin.pages.career.testimony.item.save');
    Route::post('/setting-career-testimony-item-delete', [CareerController::class,'testimonyItemDelete'])->name('admin.pages.career.testimony.item.delete');

    // PROMO
    Route::get('/promos', [PromoController::class,'index'])->name('admin.promo');
    Route::get('/promo-data', [PromoController::class,'indexData'])->name('admin.promo.data');
    Route::get('/promo-get/{id?}', [PromoController::class,'getData'])->name('admin.promo.get');
    Route::post('/promo-save', [PromoController::class,'save'])->name('admin.promo.save');
    Route::post('/promo-delete/{id?}', [PromoController::class,'delete'])->name('admin.promo.delete');
    Route::get('/promo-export', [PromoController::class,'export'])->name('admin.promo.export');

    // OUTLET
    Route::get('/outlets', [OutletController::class,'index'])->name('admin.outlet');
    Route::get('/outlet-data', [OutletController::class,'indexData'])->name('admin.outlet.data');
    Route::get('/outlet-get/{id?}', [OutletController::class,'getData'])->name('admin.outlet.get');
    Route::post('/outlet-save', [OutletController::class,'save'])->name('admin.outlet.save');
    Route::post('/outlet-delete/{id?}', [OutletController::class,'delete'])->name('admin.outlet.delete');
    Route::get('/outlet-export', [OutletController::class,'export'])->name('admin.outlet.export');

    // CONTACT
    Route::get('/contacts', [ContactController::class,'index'])->name('admin.contact');
    Route::get('/contact-data', [ContactController::class,'indexData'])->name('admin.contact.data');
    Route::get('/contact-export', [ContactController::class,'export'])->name('admin.contact.export');

    // ARTICLE
    Route::get('/articles', [ArticleController::class,'index'])->name('admin.article');
    Route::get('/article-data', [ArticleController::class,'indexData'])->name('admin.article.data');
    Route::get('/article-detail/{id?}', [ArticleController::class,'detail'])->name('admin.article.detail');
    Route::post('/article-save', [ArticleController::class,'save'])->name('admin.article.save');
    Route::post('/article-delete/{id?}', [ArticleController::class,'delete'])->name('admin.article.delete');
    Route::get('/article-export', [ArticleController::class,'export'])->name('admin.article.export');

    // PRODUCT
    Route::get('/products', [ProductController::class,'index'])->name('admin.product');
    Route::get('/product-data', [ProductController::class,'indexData'])->name('admin.product.data');
    Route::get('/product-detail/{id?}', [ProductController::class,'detail'])->name('admin.product.detail');
    Route::post('/product-save', [ProductController::class,'save'])->name('admin.product.save');
    Route::post('/product-delete/{id?}', [ProductController::class,'delete'])->name('admin.product.delete');
    Route::get('/product-export', [ProductController::class,'export'])->name('admin.product.export');

    Route::get('/setting-product', [ProductController::class,'setting'])->name('admin.pages.product');
    Route::post('/setting-product-save', [ProductController::class,'settingSave'])->name('admin.pages.product.general.save');


    // PROVINCE
    Route::get('/provinces', [ProvinceController::class,'index'])->name('admin.province');
    Route::get('/province-data', [ProvinceController::class,'indexData'])->name('admin.province.data');
    Route::get('/province-get/{id?}', [ProvinceController::class,'getData'])->name('admin.province.get');
    Route::post('/province-save', [ProvinceController::class,'save'])->name('admin.province.save');
    Route::post('/province-delete/{id?}', [ProvinceController::class,'delete'])->name('admin.province.delete');
    Route::get('/province-export', [ProvinceController::class,'export'])->name('admin.province.export');

    // LOCATION
    Route::get('/locations', [LocationController::class,'index'])->name('admin.location');
    Route::get('/location-data', [LocationController::class,'indexData'])->name('admin.location.data');
    Route::get('/location-get/{id?}', [LocationController::class,'getData'])->name('admin.location.get');
    Route::post('/location-save', [LocationController::class,'save'])->name('admin.location.save');
    Route::post('/location-delete/{id?}', [LocationController::class,'delete'])->name('admin.location.delete');
    Route::get('/location-export', [LocationController::class,'export'])->name('admin.location.export');

    //Orders
    Route::get('/orders', [OrderController::class,'index'])->name('admin.orders');
    Route::get('/orderData', [OrderController::class,'indexData'])->name('admin.order.data');
    Route::get('/orderGet/{id?}', [OrderController::class,'getData'])->name('admin.order.get');
    Route::post('/orderSave', [OrderController::class,'save'])->name('admin.order.save');
    Route::post('/orderDelete/{id?}', [OrderController::class,'delete'])->name('admin.order.delete');
    Route::get('/orderExport', [OrderController::class,'export'])->name('admin.order.export');
    Route::post('/orderPayment', [OrderController::class,'setPayment'])->name('admin.order.payment');
    Route::post('/orderStatus', [OrderController::class,'setStatus'])->name('admin.order.status');
    Route::get('/orderMachine/{id?}', [OrderController::class,'getMachine'])->name('admin.order.machine');
    Route::get('/orderReceipt/{id?}', [OrderController::class,'getReceipt'])->name('admin.order.receipt');

    //Members
    Route::get('/members', [MemberController::class,'index'])->name('admin.members');
    Route::get('/memberData', [MemberController::class,'indexData'])->name('admin.member.data');
    Route::get('/memberGet/{id?}', [MemberController::class,'getData'])->name('admin.member.get');
    Route::post('/memberSave', [MemberController::class,'save'])->name('admin.member.save');
    Route::post('/memberDelete/{id?}', [MemberController::class,'delete'])->name('admin.member.delete');
    Route::get('/memberExport', [MemberController::class,'export'])->name('admin.member.export');
    Route::get('/memberSearch/{search?}', [MemberController::class,'search'])->name('admin.member.search');

    //Categories
    Route::get('/categories', [CategoryController::class,'index'])->name('admin.categories');
    Route::get('/categoryData', [CategoryController::class,'indexData'])->name('admin.category.data');
    Route::get('/categoryGet/{id?}', [CategoryController::class,'getData'])->name('admin.category.get');
    Route::post('/categorySave', [CategoryController::class,'save'])->name('admin.category.save');
    Route::post('/categoryDelete/{id?}', [CategoryController::class,'delete'])->name('admin.category.delete');
    Route::get('/categoryExport', [CategoryController::class,'export'])->name('admin.category.export');

    //Units
    Route::get('/units', [UnitController::class,'index'])->name('admin.units');
    Route::get('/unitData', [UnitController::class,'indexData'])->name('admin.unit.data');
    Route::get('/unitGet/{id?}', [UnitController::class,'getData'])->name('admin.unit.get');
    Route::post('/unitSave', [UnitController::class,'save'])->name('admin.unit.save');
    Route::post('/unitDelete/{id?}', [UnitController::class,'delete'])->name('admin.unit.delete');
    Route::get('/unitExport', [UnitController::class,'export'])->name('admin.unit.export');
});

Route::get('/province', [BackEndController::class,'getProvince'])->name('get.province');
Route::get('/city/{province?}', [BackEndController::class,'getCity'])->name('get.city');
Route::get('/district/{city?}', [BackEndController::class,'getDistrict'])->name('get.district');


Route::get('/logout', function(){
    \Auth::logout();
    return redirect()->route('admin.login');
});

Route::get('/login', [BackEndController::class,'login'])->name('login');
