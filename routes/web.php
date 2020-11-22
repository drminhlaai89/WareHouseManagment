<?php

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

//Route::get('/', 'DashboardController@index');

// Route::get('product', 'ProductController@index');
// Route::get('product/create', 'ProductController@create');
// Route::post('product/create', 'ProductController@postCreate');

//Login

Route::get('/login','AccountController@login');
Route::post('/login','AccountController@checkLogin');
Route::get('/logout','AccountController@logout');


Route::prefix('')->name('')->middleware('checkLogin')->group(function(){
    //Catalog
     Route::get('/catalog','CatalogController@index');
     Route::get('/catalog/create','CatalogController@create');
     Route::post('/catalog/create','CatalogController@postCreate');
     Route::get('/catalog/update/{id}','CatalogController@update');
     Route::post('/catalog/update/{id}','CatalogController@postUpdate');
     Route::get('/catalog/detail/{id}','CatalogController@detail');
     Route::get('/catalog/search','CatalogController@searchCatalog');

    //customer
    Route::get('/customer','CustomerController@index');
    Route::get('/customer/create','CustomerController@create');
    Route::post('/customer/create','CustomerController@postCreate');
    Route::get('/customer/update/{id}','CustomerController@update');
    Route::post('/customer/update/{id}','CustomerController@postUpdate');
    Route::get('/customer/detail/{id}','CustomerController@detail');
    Route::get('/customer/search','CustomerController@searchCustomer');

    //supplier
    Route::get('/supplier','SupplierController@index');
    Route::get('/supplier/create','SupplierController@create');
    Route::post('/supplier/create','SupplierController@postCreate');
    Route::get('/supplier/update/{id}','SupplierController@update');
    Route::post('/supplier/update/{id}','SupplierController@postUpdate');
    Route::get('/supplier/detail/{id}','SupplierController@detail');
    Route::get('/supplier/search','SupplierController@searchSupplier');

    //product
    Route::get('product','ProductController@index');
    Route::get('product/create','ProductController@create');
    Route::post('product/create','ProductController@postCreate');
    Route::get('product/update/{id}','ProductController@update');
    Route::post('product/update/{id}','ProductController@postUpdate');
    Route::get('product/detail/{id}','ProductController@detail');
    Route::get('product/search','ProductController@search');
    Route::get('catalog/{id}/product','ProductController@productType');

    //import
    Route::get('import','ImportController@index');
    Route::get('import/create','ImportController@create');
    Route::get('import/search','ImportController@searchSupplier');
    Route::get('import/{id}','ImportController@product');
    Route::get('import/product/search','ImportController@searchProduct');
    Route::get('import/{supplierid}/product/{productid}','ImportController@import');
    Route::post('import/{supplierid}/product/{productid}','ImportController@createImport');
    Route::get('import/detail/{id}','ImportController@detail');
    Route::get('import/invoice/{id}','ImportController@invoice');
    Route::get('import/update/{id}','ImportController@update');
    Route::post('import/update/{id}','ImportController@postUpdate');
    Route::get('/import/search','ImportController@searchImport');
    Route::get('/import/update/{id}/update-transaction','ImportController@updateTransaction');
    Route::post('/import/update/{id}/update-transaction','ImportController@postUpdateTransaction');
    Route::get('/import/update/{id}/cancel-shipping','ImportController@cancelShipping');



    //return-import
    Route::get('/return/import','ImportController@return');
    Route::get('return/import/create','ImportController@returnCreate');
    Route::get('return/import/create/{id}','ImportController@getCreateReturn');
    Route::post('return/import/create/{id}','ImportController@postCreateReturn');

    
    

    //export
    Route::get('export','ExportController@index');
    Route::get('export/create','ExportController@create');
    Route::get('export/search','ExportController@searchProduct');
    Route::get('export/{id}','ExportController@customer');
    Route::get('export/customer/search','ExportController@searchCustomer');
    Route::get('export/{productid}/customer/{customerid}','ExportController@export');
    Route::post('export/{productid}/customer/{customerid}','ExportController@createExport');
    Route::get('export/detail/{id}','ExportController@detail');
    Route::get('export/invoice/{id}','ExportController@invoice');
    Route::get('export/update/{id}','ExportController@update');
    Route::post('export/update/{id}','ExportController@postUpdate');
    Route::get('/export/search','ExportController@searchExport');
    Route::get('/export/update/{id}/update-transaction','ExportController@updateTransaction');
    Route::post('/export/update/{id}/update-transaction','ExportController@postUpdateTransaction');
    Route::get('/export/update/{id}/cancel-shipping','ExportController@cancelShipping');

    //preorder
    Route::get('preorder/export','ExportController@preorder');
    Route::get('preorder/export/customer','ExportController@preorderCustomer');
    Route::get('preorder/export/{customerid}/','ExportController@preorderProduct');
    Route::get('preorder/export/{customerid}/{productid}','ExportController@preorderCreate');
    Route::post('preorder/export/{customerid}/{productid}','ExportController@preorderPostCreate');

    //return-export
    Route::get('/return/export','ExportController@return');
    Route::get('return/export/create','ExportController@returnCreate');
    Route::get('return/export/create/{id}','ExportController@getCreateReturn');
    Route::post('return/export/create/{id}','ExportController@postCreateReturn');

    //report
    Route::get('/report/inventory','ReportController@index');
    Route::get('/report/inventory/search','ReportController@search');
    Route::get('/report/graph','ReportController@import');

    Route::get('/user/dashboard','AccountController@userIndex');


    Route::get('/','AccountController@index');
    Route::prefix('admin')->name('admin')->middleware('checkAdmin')->group(function(){
        Route::get('/dashboard','AccountController@index');
        Route::get('/listuser','AccountController@listUser');
        Route::get('/search','AccountController@searchAccount');
        Route::get('/create','AccountController@create');
        Route::post('/create','AccountController@postCreate');
        Route::get('/detail/{id}','AccountController@detailUser');
        Route::get('/update/{id}','AccountController@update');
        Route::post('/update/{id}','AccountController@postUpdate');
        Route::get('/changepassword/{id}','AccountController@changePassword');
        Route::post('/changepassword/{id}','AccountController@postChangePassword');
        Route::get('/resetpassword/{id}','AccountController@resetPassword');

        Route::get('/import/order-pending','ImportController@pending');
        Route::get('import/accept/{id}','ImportController@accept');
        Route::get('import/cancel/{id}','ImportController@cancel');
        Route::get('/import/order-pending/search','ImportController@searchPending');

        Route::get('/export/order-pending','ExportController@pending');
        Route::get('export/accept/{id}','ExportController@accept');
        Route::get('export/cancel/{id}','ExportController@cancel');
        Route::get('/export/order-pending/search','ExportController@searchPending');

        Route::get('/inventory','ReportController@inventory');
        Route::get('/inventory/update/{id}','ReportController@update');
        Route::post('/inventory/update/{id}','ReportController@postUpdate');
        
    });
    Route::prefix('user')->name('user')->middleware('checkUser')->group(function(){
        
        Route::get('/detail','AccountController@userDetail');
        Route::get('/changepassword','AccountController@userChangePass');
        Route::post('/changepassword','AccountController@userPostChangePass');

            });

 
});








 


// Route::get('/','DashboardController@index');

Route::group(['prefix' => 'basic-ui'], function(){
    Route::get('accordions', function () { return view('pages.basic-ui.accordions'); });
    Route::get('buttons', function () { return view('pages.basic-ui.buttons'); });
    Route::get('badges', function () { return view('pages.basic-ui.badges'); });
    Route::get('breadcrumbs', function () { return view('pages.basic-ui.breadcrumbs'); });
    Route::get('dropdowns', function () { return view('pages.basic-ui.dropdowns'); });
    Route::get('modals', function () { return view('pages.basic-ui.modals'); });
    Route::get('progress-bar', function () { return view('pages.basic-ui.progress-bar'); });
    Route::get('pagination', function () { return view('pages.basic-ui.pagination'); });
    Route::get('tabs', function () { return view('pages.basic-ui.tabs'); });
    Route::get('typography', function () { return view('pages.basic-ui.typography'); });
    Route::get('tooltips', function () { return view('pages.basic-ui.tooltips'); });
});

Route::group(['prefix' => 'advanced-ui'], function(){
    Route::get('dragula', function () { return view('pages.advanced-ui.dragula'); });
    Route::get('clipboard', function () { return view('pages.advanced-ui.clipboard'); });
    Route::get('context-menu', function () { return view('pages.advanced-ui.context-menu'); });
    Route::get('popups', function () { return view('pages.advanced-ui.popups'); });
    Route::get('sliders', function () { return view('pages.advanced-ui.sliders'); });
    Route::get('carousel', function () { return view('pages.advanced-ui.carousel'); });
    Route::get('loaders', function () { return view('pages.advanced-ui.loaders'); });
    Route::get('tree-view', function () { return view('pages.advanced-ui.tree-view'); });
});

Route::group(['prefix' => 'forms'], function(){
    Route::get('basic-elements', function () { return view('pages.forms.basic-elements'); });
    Route::get('advanced-elements', function () { return view('pages.forms.advanced-elements'); });
    Route::get('dropify', function () { return view('pages.forms.dropify'); });
    Route::get('form-validation', function () { return view('pages.forms.form-validation'); });
    Route::get('step-wizard', function () { return view('pages.forms.step-wizard'); });
    Route::get('wizard', function () { return view('pages.forms.wizard'); });
});

Route::group(['prefix' => 'editors'], function(){
    Route::get('text-editor', function () { return view('pages.editors.text-editor'); });
    Route::get('code-editor', function () { return view('pages.editors.code-editor'); });
});

Route::group(['prefix' => 'charts'], function(){
    Route::get('chartjs', function () { return view('pages.charts.chartjs'); });
    Route::get('morris', function () { return view('pages.charts.morris'); });
    Route::get('flot', function () { return view('pages.charts.flot'); });
    Route::get('google-charts', function () { return view('pages.charts.google-charts'); });
    Route::get('sparklinejs', function () { return view('pages.charts.sparklinejs'); });
    Route::get('c3-charts', function () { return view('pages.charts.c3-charts'); });
    Route::get('chartist', function () { return view('pages.charts.chartist'); });
    Route::get('justgage', function () { return view('pages.charts.justgage'); });
});

Route::group(['prefix' => 'tables'], function(){
    Route::get('basic-table', function () { return view('pages.tables.basic-table'); });
    Route::get('data-table', function () { return view('pages.tables.data-table'); });
    Route::get('js-grid', function () { return view('pages.tables.js-grid'); });
    Route::get('sortable-table', function () { return view('pages.tables.sortable-table'); });
});

Route::get('notifications', function () {
    return view('pages.notifications.index');
});

Route::group(['prefix' => 'icons'], function(){
    Route::get('material', function () { return view('pages.icons.material'); });
    Route::get('flag-icons', function () { return view('pages.icons.flag-icons'); });
    Route::get('font-awesome', function () { return view('pages.icons.font-awesome'); });
    Route::get('simple-line-icons', function () { return view('pages.icons.simple-line-icons'); });
    Route::get('themify', function () { return view('pages.icons.themify'); });
});

Route::group(['prefix' => 'maps'], function(){
    Route::get('vector-map', function () { return view('pages.maps.vector-map'); });
    Route::get('mapael', function () { return view('pages.maps.mapael'); });
    Route::get('google-maps', function () { return view('pages.maps.google-maps'); });
});

Route::group(['prefix' => 'user-pages'], function(){
    Route::get('login', function () { return view('pages.user-pages.login'); });
    Route::get('login-2', function () { return view('pages.user-pages.login-2'); });
    Route::get('multi-step-login', function () { return view('pages.user-pages.multi-step-login'); });
    Route::get('register', function () { return view('pages.user-pages.register'); });
    Route::get('register-2', function () { return view('pages.user-pages.register-2'); });
    Route::get('lock-screen', function () { return view('pages.user-pages.lock-screen'); });
});

Route::group(['prefix' => 'error-pages'], function(){
    Route::get('error-404', function () { return view('pages.error-pages.error-404'); });
    Route::get('error-500', function () { return view('pages.error-pages.error-500'); });
});

Route::group(['prefix' => 'general-pages'], function(){
    Route::get('blank-page', function () { return view('pages.general-pages.blank-page'); });
    Route::get('landing-page', function () { return view('pages.general-pages.landing-page'); });
    Route::get('profile', function () { return view('pages.general-pages.profile'); });
    Route::get('email-templates', function () { return view('pages.general-pages.email-templates'); });
    Route::get('faq', function () { return view('pages.general-pages.faq'); });
    Route::get('faq-2', function () { return view('pages.general-pages.faq-2'); });
    Route::get('news-grid', function () { return view('pages.general-pages.news-grid'); });
    Route::get('timeline', function () { return view('pages.general-pages.timeline'); });
    Route::get('search-results', function () { return view('pages.general-pages.search-results'); });
    Route::get('portfolio', function () { return view('pages.general-pages.portfolio'); });
    Route::get('user-listing', function () { return view('pages.general-pages.user-listing'); });
});

Route::group(['prefix' => 'ecommerce'], function(){
    Route::get('invoice', function () { return view('pages.ecommerce.invoice'); });
    Route::get('invoice-2', function () { return view('pages.ecommerce.invoice-2'); });
    Route::get('pricing', function () { return view('pages.ecommerce.pricing'); });
    Route::get('product-catalogue', function () { return view('pages.ecommerce.product-catalogue'); });
    Route::get('project-list', function () { return view('pages.ecommerce.project-list'); });
    Route::get('orders', function () { return view('pages.ecommerce.orders'); });
});

// For Clear cache
Route::get('/clear-cache', function() {
    Artisan::call('cache:clear');
    return "Cache is cleared";
});

// 404 for undefined routes
Route::any('/{page?}',function(){
    return View::make('pages.error-pages');
})->where('page','.*');
