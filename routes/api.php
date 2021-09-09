<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group(['prefix'=>'', ['middleware' => ['XSS']], 'namespace'=>'Api'], function(){  
    //app logo and name
    Route::get('app_info', 'AppController@app');
	// for user
	Route::post('signup', 'UserController@signUp');
    Route::post('verify_phone', 'UserController@verifyPhone');
    
    Route::post('forget_password', 'UserController@forgotPassword');
    Route::post('verify_otp', 'UserController@verifyOtp');
    Route::post('change_password', 'UserController@changePassword');
    Route::post('login', 'UserController@login');
    Route::post('checkotp', 'UserController@checkOTP');
    Route::post('myprofile', 'UserController@myprofile');
    //////address///////
    Route::post('add_address', 'AddressController@address');
    Route::get('city', 'AddressController@city');
    Route::post('society', 'AddressController@society');
    Route::post('show_address', 'AddressController@show_address');
    Route::post('select_address', 'AddressController@select_address');
    Route::post('edit_address', 'AddressController@edit_add');
    Route::post('remove_address', 'AddressController@rem_user_address');
    
    ////category product, product_varient///////
    Route::get('cat', 'CategoryController@cat');
    Route::post('varient', 'CategoryController@varient');
    Route::post('dealproduct', 'CategoryController@dealproduct');
    
    //orders//
     Route::post('make_an_order', 'OrderController@order');
     Route::post('ongoing_orders', 'OrderController@ongoing');
     Route::get('cancelling_reasons', 'OrderController@cancel_for');
     Route::post('delete_order', 'OrderController@delete_order');
     Route::post('top_selling', 'OrderController@top_selling');
     Route::post('checkout', 'OrderController@checkout');
     Route::post('completed_orders', 'OrderController@completed_orders');
     Route::post('recentselling', 'OrderController@recentselling');
    
    //coupon//
    Route::post('apply_coupon', 'CouponController@apply_coupon');
    Route::post('couponlist', 'CouponController@coupon_list');
    Route::post('walletamount', 'WalletController@walletamount');
    
    //search//
    Route::post('search', 'SearchController@search');
    
    //currency//
     Route::get('currency', 'CurrencyController@currency');
    /////time slot////// 
    Route::post('timeslot', 'TimeslotController@timeslot'); 
  
    //////minimum/maximum order value///////
    Route::get('minmax', 'CartvalueController@minmax'); 
     
    /////rating/////
    Route::post('review_on_delivery', 'RatingController@review_on_delivery');
    
    ////pages//
     Route::get('appaboutus', 'PagesController@appaboutus');
     Route::get('appterms', 'PagesController@appterms');
     
     //banner//
     Route::get('banner', 'BannerController@bannerlist');
     
     Route::get('catee', 'CategoryController@cate');
     Route::post('cat_product', 'CategoryController@cat_product');
     
     //wallet
     Route::post('recharge_wallet', 'WalletController@add_credit');
     Route::post('totalbill', 'WalletController@totalbill');
     Route::post('show_recharge_history', 'WalletController@show_recharge_history');
     
     
     //notification by///
     Route::post('notifyby', 'NotifybyController@notifyby');
     Route::post('updatenotifyby', 'NotifybyController@updatenotifyby');
     
    //secbanner//
    Route::get('secondary_banner', 'BannerController@secbannerlist');
     
     //redeem rewards//
      Route::post('redeem_rewards', 'RewardController@redeem');
      Route::get('rewardvalues', 'RewardController@rewardvalues');
      
      //notifications//
      Route::post('notificationlist', 'UsernotificationController@notificationlist');
      Route::post('read_by_user', 'UsernotificationController@read_by_user');
      Route::post('mark_all_as_read', 'UsernotificationController@mark_all_as_read');
      Route::post('delete_all_notification', 'UsernotificationController@delete_all');
      
     //////cancel order list////
      Route::post('can_orders', 'OrderController@can_orders');
      ///profile edit
      Route::post('profile_edit', 'UserController@profile_edit');
      ///////what's new//////
       Route::post('whatsnew', 'OrderController@whatsnew');
       
       ////rewardlines////
       Route::post('rewardlines', 'RewardController@rewardlines');
       
       //top six categories//
        Route::post('topsix', 'CategoryController@top_six');
        
         //Delivery fee info////
        Route::get('delivery_info', 'AppController@delivery_info');
        
        /////user_block_check////
         Route::post('user_block_check', 'UserController@user_block_check');
         
         Route::post('forgot_password','forgotpasswordController@forgot_password'); 
         Route::get('checkotponoff','forgotpasswordController@checkotponoff'); 
         Route::get('pymnt_via','PaymentController@pymnt_via');
         Route::get('mapby','MapsetController@mapby');
         Route::get('google_map','MapsetController@google_map');
         Route::get('mapbox','MapsetController@mapbox');
         Route::post('homecat', 'CategoryController@homecat');
         Route::get('countrycode', 'FirebaseController@countrycode');
         Route::get('firebase', 'FirebaseController@firebase');
         Route::get('app_notice', 'FirebaseController@app_notice');
         Route::post('firebase_otp_ver','forgotpasswordController@verifyOtp3'); 
          Route::post('checknum','forgotpasswordController@checknum');
         Route::post('verify_via_firebase', 'UserController@verifyotpfirebase');
         Route::post('homepage', 'CategoryController@homepage'); //ctae
       
      
});

Route::group(['prefix'=>'store', ['middleware' => ['XSS']], 'namespace'=>'Storeapi'], function(){
    
    //////store login/////
    Route::post('store_login', 'StoreloginController@store_login');
    Route::post('store_profile', 'StoreloginController@storeprofile');
    
      Route::post('storetoday_orders', 'StoreorderController@todayorders');
    Route::post('storenextday_orders', 'StoreorderController@nextdayorders');
    Route::post('productcancelled', 'StoreorderController@productcancelled');
    Route::post('order_rejected', 'StoreorderController@order_rejected');
    Route::post('storeconfirm', 'AssignController@storeconfirm');
    
    
    Route::post('productselect', 'AddproductController@productselect');
    Route::post('storeproducts', 'AddproductController@store_products');
    Route::post('store_stock_update', 'AddproductController@stock_update');
    Route::post('store_delete_product', 'AddproductController@delete_product');
    Route::post('store_add_products', 'AddproductController@add_products');
    Route::post('earn', 'AmountController@earn');
    
  //notifications//
  Route::post('notificationlist', 'NotificationController@notificationlist');
  Route::post('read_by_store', 'NotificationController@read_by_store');
  Route::post('all_as_read', 'NotificationController@all_as_read');
  Route::post('delete_all_notification', 'NotificationController@delete_all');
  Route::post('nearbydboys','AssignController@delivery_boy_list');
  Route::post('cart_invoice','StoreinvoiceController@cart_invoice');
  
  ////store registration/////
   Route::post('regstore', 'RegController@regstore');
   
   /////search api
    Route::post('todayordersearch', 'StoreordersearchController@todaysearch');
    Route::post('nextdayordersearch', 'StoreordersearchController@nextdaysearch');
});


Route::group(['prefix'=>'driver', ['middleware' => ['XSS']], 'namespace'=>'Driverapi'], function(){
    Route::post('driver_login', 'DriverloginController@driver_login');
    Route::post('driver_profile', 'DriverloginController@driverprofile');
    Route::post('ordersfortoday', 'DriverorderController@ordersfortoday');
    Route::post('ordersfornextday', 'DriverorderController@ordersfornextday');
    Route::post('out_for_delivery', 'DriverorderController@delivery_out');
    Route::post('delivery_completed', 'DriverorderController@delivery_completed');
    Route::post('avg_rating', 'RatingController@avg_rating');
    Route::get('map_api', 'MapController@map_api_key');
    Route::post('completed_orders', 'DriverorderController@completed_orders');
    Route::post('update_status', 'DriverstatusController@status');
     Route::post('todayordsearch', 'SearchordController@todaysearch');
    Route::post('nextdayordsearch', 'SearchordController@nextdaysearch');
    
});


Route::group(['prefix'=>'', ['middleware' => ['XSS']], 'namespace'=>'Ios'], function(){
    
    
	// for user
	Route::post('ios_register', 'UserController@ios_signUp');
	Route::post('ios_com', 'IosordersController@completed_orders');
	Route::post('ios_on', 'IosordersController@ongoing');
	Route::post('ios_cart_add', 'CartController@add_to_cart');
	Route::post('ios_make_order', 'CartController@make_an_order');
	Route::post('show_cart', 'CartController@show_cart');
	
	/////time slot////// 
    Route::post('iostimeslot', 'IostimeslotController@timeslot'); 
});


Route::group(['prefix'=>'protocol', ['middleware' => ['XSS']], 'namespace'=>'Api_protocol'], function(){
    //Route::post('auth/register', 'AuthController@register');
    Route::post('auth/login', 'AuthController@MobileLogin');
    Route::post('mobile/verify', 'AuthController@loginverify');
    Route::post('pages', 'PagesController@pageContent');
    Route::group(['middleware' => 'jwt.auth'], function () {
        Route::post('getuser', 'AuthController@getAuthUser');
        Route::post('updateuser', 'AuthController@UserUpdate');
        Route::post('get_user_orders_list', 'UserStoreController@getUserOrdersList');
        Route::post('get_user_order_detail', 'UserStoreController@getUserOrderDetail');
        Route::post('getnotify', 'NotifybyController@notificationlist');
        
        Route::post('create-order', 'OrderController@createOrder');
        Route::post('order-list', 'OrderController@OrderList');
        Route::post('online-payment', 'OrderController@onlinePayment');
    });
    Route::post('order-details', 'OrderController@OrderDetails');
    Route::post('thanks', 'OrderController@thanksForOrder');
    Route::post('cancel-reason', 'OrderController@cancelReason');
    Route::post('order-cancel', 'OrderController@cancelOrder');
    Route::post('successpayment', 'OrderController@successPayment');

    //search//
    Route::post('search', 'SearchController@search');
    Route::post('search-item', 'SearchController@search2');
    
    //app logo and name
    Route::post('app_info', 'AppController@app');
    
    // for user
    Route::post('signup', 'UserController@signUp');
    Route::post('verify_phone', 'UserController@verifyPhone');
    
    Route::post('forget_password', 'UserController@forgotPassword');
    Route::post('verify_otp', 'UserController@verifyOtp');
    Route::post('change_password', 'UserController@changePassword');
    Route::post('login', 'UserController@login');
    Route::post('checkotp', 'UserController@checkOTP');
    Route::post('myprofile', 'UserController@myprofile');
    //////address///////
    Route::post('add_address', 'AddressController@address');
    Route::get('city', 'AddressController@city');
    Route::post('society', 'AddressController@society');
    Route::post('show_address', 'AddressController@show_address');
    Route::post('select_address', 'AddressController@select_address');
    Route::post('edit_address', 'AddressController@edit_add');
    Route::post('remove_address', 'AddressController@rem_user_address');
    
    ////category product, product_varient///////
    Route::get('cat', 'CategoryController@cat');
    Route::post('varient', 'CategoryController@varient');
    Route::post('dealproduct', 'CategoryController@dealproduct');
    
    //orders//
     Route::post('make_an_order', 'OrderController@order');
     Route::post('ongoing_orders', 'OrderController@ongoing');
     Route::get('cancelling_reasons', 'OrderController@cancel_for');
     Route::post('delete_order', 'OrderController@delete_order');
     Route::post('top_selling', 'OrderController@top_selling');
     Route::post('checkout', 'OrderController@checkout');
     Route::post('completed_orders', 'OrderController@completed_orders');
     Route::post('recentselling', 'OrderController@recentselling');
    
    //coupon//
    Route::post('apply_coupon', 'CouponController@apply_coupon');
    Route::post('couponlist', 'CouponController@coupon_list');
    Route::post('walletamount', 'WalletController@walletamount');
    

    //currency//
     Route::get('currency', 'CurrencyController@currency');
    /////time slot////// 
    Route::post('timeslot', 'TimeslotController@timeslot'); 
  
    //////minimum/maximum order value///////
    Route::get('minmax', 'CartvalueController@minmax'); 
     
    /////rating/////
    Route::post('review_on_delivery', 'RatingController@review_on_delivery');
    
    ////pages//
     //old
     Route::get('appaboutus', 'PagesController@appaboutus');
     Route::get('appterms', 'PagesController@appterms');
     
     //banner//
     Route::get('banner', 'BannerController@bannerlist');
     
     Route::get('catee', 'CategoryController@cate');
     Route::post('cat_product', 'CategoryController@cat_product');
     
     //wallet
     Route::post('recharge_wallet', 'WalletController@add_credit');
     Route::post('totalbill', 'WalletController@totalbill');
     Route::post('show_recharge_history', 'WalletController@show_recharge_history');
     
     
     //notification by///
     Route::post('notifyby', 'NotifybyController@notifyby');
     Route::post('updatenotifyby', 'NotifybyController@updatenotifyby');
     
    //secbanner//
    Route::get('secondary_banner', 'BannerController@secbannerlist');
     
     //redeem rewards//
      Route::post('redeem_rewards', 'RewardController@redeem');
      Route::get('rewardvalues', 'RewardController@rewardvalues');
      
      //notifications//
      Route::post('notificationlist', 'UsernotificationController@notificationlist');
      Route::post('read_by_user', 'UsernotificationController@read_by_user');
      Route::post('mark_all_as_read', 'UsernotificationController@mark_all_as_read');
      Route::post('delete_all_notification', 'UsernotificationController@delete_all');
      
     //////cancel order list////
      Route::post('can_orders', 'OrderController@can_orders');
      ///profile edit
      Route::post('profile_edit', 'UserController@profile_edit');
      ///////what's new//////
       Route::post('whatsnew', 'OrderController@whatsnew');
       
       ////rewardlines////
       Route::post('rewardlines', 'RewardController@rewardlines');
       
       //top six categories//
        Route::post('topsix', 'CategoryController@top_six');
        
         //Delivery fee info////
        Route::get('delivery_info', 'AppController@delivery_info');
        
        /////user_block_check////
         Route::post('user_block_check', 'UserController@user_block_check');
         
         Route::post('forgot_password','forgotpasswordController@forgot_password'); 
         Route::get('checkotponoff','forgotpasswordController@checkotponoff'); 
         Route::get('pymnt_via','PaymentController@pymnt_via');
         Route::get('mapby','MapsetController@mapby');
         Route::get('google_map','MapsetController@google_map');
         Route::get('mapbox','MapsetController@mapbox');
         Route::post('homecat', 'CategoryController@homecat');
         Route::get('countrycode', 'FirebaseController@countrycode');
         Route::get('firebase', 'FirebaseController@firebase');
         Route::get('app_notice', 'FirebaseController@app_notice');
         Route::post('firebase_otp_ver','forgotpasswordController@verifyOtp3'); 
          Route::post('checknum','forgotpasswordController@checknum');
         Route::post('verify_via_firebase', 'UserController@verifyotpfirebase');

         //Route::post('homepage', 'CategoryController@homepage'); 
       
      
});

Route::group(['prefix'=>'protocol/store', ['middleware' => ['XSS']], 'namespace'=>'Storeapi_protocol'], function(){
    
    Route::post('auth/register', 'AuthController@register');
    // Route::post('auth/login', 'AuthController@MobileLogin');
    // Route::post('mobile/verify', 'AuthController@loginverify');
    Route::post('storelogin', 'AuthController@storeLogin');
    Route::group(['middleware' => 'auth:store_api'], function () {
        Route::post('getuser', 'AuthController@getAuthUser');
        Route::post('update-profile', 'AuthController@UserUpdate');
        Route::post('update-password', 'AuthController@updatePassword');
        Route::post('change-status', 'AuthController@StoreIsActive');
        Route::post('storeproductslist', 'StoreorderController@storeProducts');
        Route::post('productslist', 'StoreorderController@Products');
        Route::post('store_orders', 'StoreorderController@storeOrders');
        Route::post('store_orders_with_range', 'StoreorderController@storeOrdersWithRange');
        Route::post('order-details', 'StoreorderController@ordersDetails');
        Route::post('add-products', 'StoreorderController@addProducts');
        Route::post('stock-request', 'StoreorderController@stockRequest');
        Route::post('remove-product', 'StoreorderController@removeProducts');
        Route::post('request-list', 'StoreorderController@stockRequestList');
        Route::post('getnotify', 'NotificationController@notificationlist');
        Route::post('allocate-stock', 'StoreorderController@AllocateStock');
        Route::post('reject-stock', 'StoreorderController@rejectStockRequest');
        Route::post('dboy-cash-list', 'AmountController@CashListByDboy');
        Route::post('dboy-order-payment', 'AmountController@DboyPayOrder');
        Route::post('accept-dboy-payment', 'AmountController@acceptPaymentFromDboy');
        //order
        Route::post('nearbydboys','AssignController@delivery_boy_list');
    });

    //order
    Route::post('get/all/categories', 'AllCategoriesController@getAllCategories');
    Route::post('confirm-order', 'StoreorderController@confirmOrder');
    Route::post('reject-order', 'StoreorderController@rejectOrder');
    
    Route::post('allocate-driver', 'AssignController@allocateDriver');
    Route::post('remove-driver', 'AssignController@removeDriver');

    //////store login///// old
    Route::post('store_login', 'StoreloginController@store_login');
    Route::post('store_profile', 'StoreloginController@storeprofile');
    
    //old
    Route::post('storetoday_orders', 'StoreorderController@todayorders');
    Route::post('storenextday_orders', 'StoreorderController@nextdayorders');
    Route::post('productcancelled', 'StoreorderController@productcancelled');
    Route::post('order_rejected', 'StoreorderController@order_rejected');
    Route::post('storeconfirm', 'AssignController@storeconfirm');
    
    Route::post('get_orders_list', 'StoreController@getOrdersList');
    Route::post('get_order_detail', 'StoreController@getOrderDetail');
    
    // Store Owner Login
    Route::post('store_owner_login', 'StoreloginController@store_owner_login');

    Route::post('productselect', 'AddproductController@productselect');
    Route::post('storeproducts', 'AddproductController@store_products');
    Route::post('store_stock_update', 'AddproductController@stock_update');
    Route::post('store_delete_product', 'AddproductController@delete_product');
    Route::post('store_add_products', 'AddproductController@add_products');
    Route::post('earn', 'AmountController@earn');
    
  //notifications//
  Route::post('notificationlist', 'NotificationController@notificationlist');
  Route::post('read_by_store', 'NotificationController@read_by_store');
  Route::post('all_as_read', 'NotificationController@all_as_read');
  Route::post('delete_all_notification', 'NotificationController@delete_all');
  
  Route::post('cart_invoice','StoreinvoiceController@cart_invoice');
  
  ////store registration/////
   Route::post('regstore', 'RegController@regstore');
   
   /////search api
    Route::post('todayordersearch', 'StoreordersearchController@todaysearch');
    Route::post('nextdayordersearch', 'StoreordersearchController@nextdaysearch');
});


Route::group(['prefix'=>'protocol/driver', ['middleware' => ['XSS']], 'namespace'=>'Driverapi_protocol'], function(){

    Route::post('driver-register', 'AuthController@register');
    Route::post('driver-login', 'AuthController@driverLogin');
    //with otp
    Route::post('driverlogin', 'AuthController@MobileLogin');
    Route::post('loginverify', 'AuthController@loginverify');

    Route::group(['middleware' => 'auth:driver_api'], function () {
        Route::post('getprofile', 'AuthController@getAuthUser');
        Route::post('update-profile', 'AuthController@UserUpdate');
        Route::post('update-password', 'AuthController@updatePassword');
        Route::post('change-status', 'AuthController@DriverIsActive');
        Route::post('orders-list', 'DriverorderController@driverOrders');
        Route::post('orders-list-with-range', 'DriverorderController@driverOrdersWithRange');
        Route::post('order-delivered', 'DriverorderController@orderDelivered');
        Route::post('order-is_accept', 'DriverorderController@orderIsAccept');
        Route::post('getnotify', 'NotificationController@notificationlist');

        Route::post('dboy-order-payment', 'DriverstatusController@DboyPayOrder');
        Route::post('dboy-payment-request', 'DriverstatusController@dboyRequestForPayment');
    });
    

    //old
    Route::post('driver_login', 'DriverloginController@driver_login');
    Route::post('driver_profile', 'DriverloginController@driverprofile');
    Route::post('ordersfortoday', 'DriverorderController@ordersfortoday');
    Route::post('ordersfornextday', 'DriverorderController@ordersfornextday');
    Route::post('out_for_delivery', 'DriverorderController@delivery_out');
    Route::post('delivery_completed', 'DriverorderController@delivery_completed');
    Route::post('avg_rating', 'RatingController@avg_rating');
    Route::get('map_api', 'MapController@map_api_key');
    Route::post('completed_orders', 'DriverorderController@completed_orders');
    Route::post('update_status', 'DriverstatusController@status');
     Route::post('todayordsearch', 'SearchordController@todaysearch');
    Route::post('nextdayordsearch', 'SearchordController@nextdaysearch');
    
});


Route::group(['prefix'=>'protocol', ['middleware' => ['XSS']], 'namespace'=>'Ios_protocol'], function(){
    
    
    // for user
    Route::post('ios_register', 'UserController@ios_signUp');
    Route::post('ios_com', 'IosordersController@completed_orders');
    Route::post('ios_on', 'IosordersController@ongoing');
    Route::post('ios_cart_add', 'CartController@add_to_cart');
    Route::post('ios_make_order', 'CartController@make_an_order');
    Route::post('show_cart', 'CartController@show_cart');
    
    /////time slot////// 
    Route::post('iostimeslot', 'IostimeslotController@timeslot'); 
});



Route::group(['prefix'=>'protocol', ['middleware' => ['XSS']], 'namespace'=>'Protocol\Home'], function(){
   
    // Store
    //Route::group(['middleware' => 'jwt.auth'], function () {
        Route::post('homepage', 'HomeController@index');
    //});
    Route::post('test', 'HomeController@test');
    Route::post('get/sub/categories/of/categories', 'HomeController@get_sub_categories_of_categories');
    Route::post('get/products/of/categories', 'HomeController@get_products_of_categories'); 
    Route::post('get/all/categories', 'HomeController@getAllCategories');
    Route::post('get/all/categorieslist', 'HomeController@getAllCategoriesList');
    Route::post('get/product/detail', 'HomeController@getProductDetail');
    Route::post('get/related/product', 'HomeController@getRelatedProduct');
    Route::post('fetch/location', 'HomeController@fetchLocation');
    Route::post('get/nearest/store', 'HomeController@getNearestStore');


    Route::post('get/test', 'HomeController@getTest');


});




Route::group(['prefix'=>'protocol', ['middleware' => ['XSS']], 'namespace'=>'Protocol\Home'], function(){ 
    // Cart Controller
    Route::post('remove/cart/product', 'CartController@removeCartProduct');
    Route::post('show/address', 'CartController@showAddress');
    Route::post('delete/address', 'CartController@deleteAddress');
    Route::post('get/timeslot', 'CartController@getStoreTimeSlot');
    
    Route::group(['middleware' => 'jwt.auth'], function () {
        Route::post('add/to/cart', 'CartController@addToCart');
        Route::post('get/sub-total/of/cart-items', 'CartController@getSubTotalOfCartItems');
        Route::post('choose-address', 'CartController@chooseAddress');
        Route::post('cart-items/check-out', 'CartController@getCheckOut');
        Route::post('get/user/addresslist', 'CartController@user_address_list');
        Route::post('add/user/address', 'CartController@user_address_add');
        Route::post('active/address', 'CartController@activeAddress');
    });
});