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
Route::get('cityss',function(){
	echo"<pre>"; print_r(getAddress('30.691364','76.665213'));
});
Route::get('/clear-cache', function() {
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('route:clear');
    Artisan::call('view:clear');
   // Artisan::call('config:clear');
    return "Cache is cleared";
    // addActivityLog('hdhhdhdhddhdhdhdh');
    die('djjjjjjjjj');
});

Route::get('aboutus', 'PagesController@aboutus')->name('appAboutUs');
Route::get('termsandconditions', 'PagesController@terms')->name('AppTerm');
Route::get('appfaqs', 'PagesController@appfaqs')->name('AppFaqs');

Route::group(['prefix'=>'web', ['middleware' => ['XSS']], 'namespace'=>'Protocol\Web'], function(){
   // for login
	Route::get('/', 'UserloginController@userlogin')->name('userLogin');
	Route::post('custloginCheck','UserloginController@logincheck')->name('custLoginCheck');

	Route::get('landing/page','LandingPageController@index')->name('landing.page');
	
	Route::get('sign-up', 'RegisterController@register_user')->name('userregister');
	Route::post('registration','RegisterController@usersignup')->name('user_registration');
    Route::post('registration/otp_verify','RegisterController@web_verify_otp')->name('web_verify_otp');

   	Route::group(['middleware'=>'bamaCust'], function(){
   	Route::get('about', 'WebHomeController@aboutus')->name('webabout');   
   	Route::get('terms', 'WebHomeController@terms')->name('terms'); 
	Route::get('home/', 'WebHomeController@web')->name('webhome');
	Route::get('products', 'AllProductController@products')->name('products');
    Route::get('products/{cat_id}','AllProductController@cate')->name('catee');
    Route::get('user/logout', 'UserloginController@logout')->name('userlogout');

	});
});

Route::group(['prefix'=>'', ['middleware' => ['XSS']], 'namespace'=>'Protocol\Admin'], function(){

	// for login
	Route::get('/', 'LoginController@adminLogin')->name('adminLogin');
	Route::post('loginCheck','LoginController@adminLoginCheck')->name('adminLoginCheck');

	Route::group(['middleware'=>'bamaAdmin'], function(){
	Route::get('home', 'HomeController@adminHome')->name('adminHome');
	Route::get('test', 'HomeController@hitFireBase');
	Route::get('logout', 'LoginController@logout')->name('logout');
    Route::get('profile','ProfileController@adminProfile')->name('prof');
    Route::post('profile/update/{id}','ProfileController@adminUpdateProfile')->name('updateprof');
    Route::get('password/change','ProfileController@adminChangePass')->name('passchange');
    Route::post('password/update/{id}','ProfileController@adminChangePassword')->name('updatepass');
	
	/////layout/////
	Route::get('admin/home-layout/form/view/category/{section_id}','HomeLayoutController@homeLayoutFormView')->name('admin.home.layout.form.view.category');
	Route::post('admin/home-layout/form/submit/category','HomeLayoutController@homeLayoutFormAddCategory')->name('admin.home.layout.form.add.category');

	Route::get('admin/home-layout/form/view/sub-category/{section_id}','HomeLayoutController@homeLayoutFormView')->name('admin.home.layout.form.view.sub.category');
	Route::get('admin/home-layout/form/view/product/{section_id}','HomeLayoutController@homeLayoutFormViewProduct')->name('admin.home.layout.form.view.product');

	/////section/////
      Route::get('section/type/list','SectionTypeController@sectionTypeList')->name('section.type.list');
      Route::get('section/type/create','SectionTypeController@sectionTypeCreate')->name('section.type.create');
      Route::post('section/type/craeted','SectionTypeController@sectionTypeCraeted')->name('section.type.craeted');
      Route::get('section/type/edit/{section_id}','SectionTypeController@sectionTypeEdit')->name('section.type.edit');
      Route::post('section/type/update','SectionTypeController@sectionTypeUpdate')->name('section.type.update');

      //stock request
      	Route::get('stock-request','NotificationController@stockRequestList')->name('stockRequestList');
      	Route::post('stock-request','NotificationController@AllocateStock')->name('AllocateStock');
	/////settings/////

      Route::get('home/design','HomeDesignController@homeDesign')->name('homeDesign');
      Route::post('delete/home/design','HomeDesignController@deletehomeDesign')->name('deletehomeDesign');
      Route::any('create/section','HomeDesignController@createSection')->name('create.section');
      Route::post('update/section','HomeDesignController@updateSection')->name('update.section');
      Route::get('edit/section/{id}','HomeDesignController@editSection')->name('edit.section');
      Route::post('get/category/product','HomeDesignController@getCategoryProduct')->name('get.category.product');
      Route::post('get/sub/category','HomeDesignController@getSubCategory')->name('get.sub.category');
      Route::post('get/sub/categories','HomeDesignController@getSubCategories')->name('get.sub.categories');
      Route::post('save/content/to/section','HomeDesignController@saveContentToSection')->name('save.content.to.section');
      Route::post('save/subcategory/content','HomeDesignController@saveSubcategoryContent')->name('save.subcategory.content');
      Route::post('save/category/content','HomeDesignController@saveCategoryContent')->name('save.category.content');
      Route::get('toggle/section/status/{id}','HomeDesignController@toggleSectionStatus')->name('toggle.section.status');

      Route::get('global_settings','SettingsController@app_details')->name('app_details');
      Route::post('app_details/update','SettingsController@updateappdetails')->name('updateappdetails');
      
      
      Route::get('msgby','SettingsController@msg91')->name('msg91');
      Route::post('msg91/update','SettingsController@updatemsg91')->name('updatemsg91');
      Route::post('twilio/update','TwilioController@updatetwilio')->name('updatetwilio');
      Route::post('msgoff','TwilioController@msgoff')->name('msgoff');
      
      Route::get('map_api','MapController@mapsettings')->name('mapapi');
      Route::post('map_api/update','MapController@updategooglemap')->name('updatemap');
      Route::post('mapbox/update','MapController@updatemapbox')->name('updatemapbox');
      
      Route::get('app_settings','SettingsController@fcm')->name('app_settings');
      Route::post('app_settings/update','SettingsController@updatefcm')->name('updatefcm');
      
      Route::post('del_charge/update','SettingsController@updatedel_charge')->name('updatedel_charge');
      
      Route::get('Notification','NotificationController@adminNotification')->name('adminNotification');
      Route::post('Notification/send','NotificationController@adminNotificationSend')->name('adminNotificationSend');
        
      Route::post('currency/update','SettingsController@updatecurrency')->name('updatecurrency');
      
      Route::get('Notification_to_store','NotificationController@Notification_to_store')->name('Notification_to_store');
      Route::post('Notification_to_store/send','NotificationController@Notification_to_store_Send')->name('adminNotificationSendtostore');
    ///////category////////
    Route::post('getsubcategory/list', 'CategoryController@getsubcategorylist')->name('getsubcategorylist');

    Route::get('category/list', 'CategoryController@list')->name('catlist');
    Route::get('category/add','CategoryController@AddCategory')->name('AddCategory');
	Route::post('category/add/new','CategoryController@AddNewCategory')->name('AddNewCategory');
	Route::get('category/edit/{category_id}','CategoryController@EditCategory')->name('EditCategory');
 	Route::post('category/update/{category_id}','CategoryController@UpdateCategory')->name('UpdateCategory');
 	Route::get('category/delete/{category_id}','CategoryController@DeleteCategory')->name('DeleteCategory');
 	 Route::post('change-postion', 'CategoryController@changePostion')->name('change-postion');

 	///////Product////////
    Route::get('product/list', 'ProductController@list')->name('productlist');
    Route::get('product/add','ProductController@AddProduct')->name('AddProduct');
	Route::post('product/add/new','ProductController@AddNewProduct')->name('AddNewProduct');
	Route::get('product/edit/{product_id}','ProductController@EditProduct')->name('EditProduct');
 	Route::post('product/update/{product_id}','ProductController@UpdateProduct')->name('UpdateProduct');
 	Route::get('product/delete/{product_id}','ProductController@DeleteProduct')->name('DeleteProduct');
      
	Route::get('add/info-highlight/{product_id}','ProductController@addInfoHighLight')->name('add.info.highlight');
	Route::post('update/info-highlight/{product_id}','ProductController@updateInfoHighlight')->name('update.info.highlight');

	Route::get('add/product/images/{product_id}','ProductController@addProductImages')->name('add.product.images');
	Route::post('update/product/images','ProductController@updateProductImages')->name('update.product.images');
	Route::get('delete/product/images/{image_id}','ProductController@deleteProductImages')->name('delete.product.images');
      
    //////Product Varient//////////
    Route::get('varient/{id}','VarientController@varient')->name('varient');
    Route::get('varient/add/{id}','VarientController@Addproduct')->name('add-varient');
    Route::post('varient/add/new','VarientController@AddNewproduct')->name('AddNewvarient');
    Route::get('varient/edit/{id}','VarientController@Editproduct')->name('edit-varient');
    Route::post('varient/update/{id}','VarientController@Updateproduct')->name('update-varient');
    Route::get('varient/delete/{id}','VarientController@deleteproduct')->name('delete-varient');
    
      ///////Delivery Boy////////
    Route::get('d_boy/list', 'DeliveryController@list')->name('d_boylist');
    Route::get('d_boy/add','DeliveryController@AddD_boy')->name('AddD_boy');
	Route::post('d_boy/add/new','DeliveryController@AddNewD_boy')->name('AddNewD_boy');
	Route::get('d_boy/edit/{id}','DeliveryController@EditD_boy')->name('EditD_boy');
 	Route::post('d_boy/update/{id}','DeliveryController@UpdateD_boy')->name('UpdateD_boy');
 	Route::get('d_boy/delete/{id}','DeliveryController@DeleteD_boy')->name('DeleteD_boy');
 	
 	    ///////Deal Product////////
    Route::get('deal/list', 'DealController@list')->name('deallist');
    Route::get('deal/add','DealController@AddDeal')->name('AddDeal');
	Route::post('deal/add/new','DealController@AddNewDeal')->name('AddNewDeal');
	Route::get('deal/edit/{id}','DealController@EditDeal')->name('EditDeal');
 	Route::post('deal/update/{id}','DealController@UpdateDeal')->name('UpdateDeal');
 	Route::get('deal/delete/{id}','DealController@DeleteDeal')->name('DeleteDeal');
      
      
      ///////User////////
    Route::get('user/list', 'UserController@list')->name('userlist');  
    Route::get('user/block/{id}','UserController@block')->name('userblock');
     Route::get('user/unblock/{id}','UserController@unblock')->name('userunblock');
     // for city
	 Route::get('citylist','CityController@citylist')->name('citylist');
	 Route::get('city','CityController@city')->name('city');
	 Route::post('cityadd','CityController@cityadd')->name('cityadd');
	 Route::get('cityedit/{city_id}','CityController@cityedit')->name('cityedit');
	 Route::post('cityupdate','CityController@cityupdate')->name('cityupdate');
	 Route::get('citydelete/{city_id}','CityController@citydelete')->name('citydelete');
	 // for society
	 Route::get('societylist','SocietyController@societylist')->name('societylist');
	 Route::get('society','SocietyController@society')->name('society');
	 Route::post('societyadd','SocietyController@societyadd')->name('societyadd');
	 Route::get('societyedit/{society_id}','SocietyController@societyedit')->name('societyedit');
	 Route::post('societyupdate','SocietyController@societyupdate')->name('societyupdate');
	 Route::get('societydelete/{society_id}','SocietyController@societydelete')->name('societydelete');
	 // for banner
	 Route::get('bannerlist','BannerController@bannerlist')->name('bannerlist');
	 Route::get('banner','BannerController@banner')->name('banner');
	 Route::post('banneradd','BannerController@banneradd')->name('banneradd');
	 Route::get('banneredit/{banner_id}','BannerController@banneredit')->name('banneredit');
	 Route::post('bannerupdate/{banner_id}','BannerController@bannerupdate')->name('bannerupdate');
	 Route::get('bannerdelete/{society_id}','BannerController@bannerdelete')->name('bannerdelete');
	 
	 // for coupon
// 	 
     Route::get('couponlist','CouponController@couponlist')->name('couponlist');
	 Route::get('coupon','CouponController@coupon')->name('coupon');
	 Route::post('addcoupon','CouponController@addcoupon')->name('addcoupon');
	 Route::get('editcoupon/{coupon_id}','CouponController@editcoupon')->name('editcoupon');
	 Route::post('updatecoupon','CouponController@updatecoupon')->name('updatecoupon');
	 Route::get('deletecoupon/{coupon_id}','CouponController@deletecoupon')->name('deletecoupon');

	 Route::get('add-bulk-coupon','CouponController@Bulkcoupon')->name('Bulkcoupon');
	 Route::post('add-bulk-coupon','CouponController@Bulkaddcoupon')->name('Bulkaddcoupon');

	  // for minimum order
// 	 Route::get('bannerlist','SocietyController@societylist')->name('societylist');
        //for order value edit
	 Route::get('orderedit','Minimum_Max_OrderController@orderedit')->name('orderedit');
	 Route::post('amountupdate','Minimum_Max_OrderController@amountupdate')->name('amountupdate');
	 // for delivery time
	 Route::get('timeslot','TimeSlotController@timeslot')->name('timeslot');
	 Route::post('timeslotupdate','TimeSlotController@timeslotupdate')->name('timeslotupdate');
	 Route::get('closehour','ClosehourController@closehour')->name('closehour');
	 Route::post('closehrsupdate','ClosehourController@closehrsupdate')->name('closehrsupdate');

	 //Route::get('timeslot/list','TimeSlotController@timeslot_list')->name('timeslot_list');
	 Route::get('add/timeslot/{id?}','TimeSlotController@add_timeslot')->name('add_timeslot');
	 Route::post('add/timeslot/{id?}','TimeSlotController@add_timeslot')->name('add_timeslot_post');
	Route::get('delete/timeslot/{id}','TimeSlotController@delete_timeslot')->name('delete_timeslot');

	  // for Store Owner Controller
	 Route::get('store/owner/list','StoreOwnerController@storeOwnerList')->name('store.owner.list');
	 Route::get('store/owner/add','StoreOwnerController@storeOwner')->name('store.owner');
	 Route::any('store/owner/added','StoreOwnerController@storeOwnerAdded')->name('store.owner.added');
	 Route::get('store/owner/edit/{store_id}','StoreOwnerController@storeOwnerEdit')->name('store.owner.edit');
	 Route::post('store/owner/update','StoreOwnerController@storeOwnerUpdate')->name('store.owner.update');
	 Route::get('store-owner/store/list/{owner_id}','StoreOwnerController@storeOwnerStoreList')->name('store.owner.store.list');
	 Route::get('admin/owner/store/add/{owner_id}','StoreController@store')->name('owner.store');

	  // for store
	 Route::get('admin/store/list','StoreController@storeclist')->name('storeclist');
	 Route::get('admin/store/add','StoreController@store')->name('store');
	 Route::post('admin/store/added','StoreController@storeadd')->name('storeadd');
	 Route::get('admin/store/edit/{store_id}','StoreController@storedit')->name('storedit');
	 Route::post('admin/store/update/{store_id}','StoreController@storeupdate')->name('storeupdate');
	 Route::get('admin/store/delete/{store_id}','StoreController@storedelete')->name('storedelete');
	 //store orders//
	 
	 Route::get('admin/store/orders/{id}','AdminorderController@admin_store_orders')->name('admin_store_orders');
	 
	 Route::get('admin/store/cancelledorders','AdminorderController@store_cancelled')->name('store_cancelled');
	 
    Route::get('admin/store/orderslist','AdminorderController@AllOrdersList')->name('AllOrdersList');
    Route::post('admin/store/orderslist','AdminorderController@AllOrdersList')->name('PostAllOrdersList');

     //assign store//
      Route::post('admin/store/assign/{id}','AdminorderController@assignstore')->name('store_assign');
      
      Route::get('finance','FinanceController@finance')->name('finance');
      Route::post('store_pay/{store_id}','FinanceController@store_pay')->name('store_pay');
      
      
      /////pages////////
      
       Route::get('about_us','PagesController@about_us')->name('about_us');
       Route::post('about_us/update','PagesController@updateabout_us')->name('updateabout_us');
       
       Route::get('terms','PagesController@terms')->name('terms');
       Route::post('terms/update','PagesController@updateterms')->name('updateterms');
       Route::get('faqs','PagesController@faqs')->name('faqs');
       Route::post('faqs/update','PagesController@updatefaqs')->name('updatefaqs');
       
      Route::get('prv','SettingsController@prv')->name('prv');
      Route::post('prv/update','SettingsController@updateprv')->name('updateprv');
      
      // for reward
	 Route::get('RewardList','RewardController@RewardList')->name('RewardList');
	 Route::get('reward','RewardController@reward')->name('reward');
	 Route::post('rewardadd','RewardController@rewardadd')->name('rewardadd');
	 Route::get('rewardedit/{reward_id}','RewardController@rewardedit')->name('rewardedit');
	 Route::post('rewardupate','RewardController@rewardupate')->name('rewardupate');
	 Route::get('rewarddelete/{reward_id}','RewardController@rewarddelete')->name('rewarddelete');
	 
	 // for reedem
	  Route::get('reedem','ReedemController@reedem')->name('reedem');
	  Route::post('reedemupdate','ReedemController@reedemupdate')->name('reedemupdate');
	  
	  ////store payout////
	  Route::get('payout_req','PayoutController@pay_req')->name('pay_req');
      Route::post('payout_req/{req_id}','PayoutController@store_pay')->name('com_payout');
      
      // for  Secondary banner
	 Route::get('secbannerlist','SecondaryBannerController@secbannerlist')->name('secbannerlist');
	 Route::get('secbanner','SecondaryBannerController@secbanner')->name('secbanner');
	 Route::post('secbanneradd','SecondaryBannerController@secbanneradd')->name('secbanneradd');
	 Route::get('secbanneredit/{sec_banner_id}','SecondaryBannerController@secbanneredit')->name('secbanneredit');
	 Route::post('secbannerupdate/{sec_banner_id}','SecondaryBannerController@secbannerupdate')->name('secbannerupdate');
	 Route::get('secbannerdelete/{sec_banner_id}','SecondaryBannerController@secbannerdelete')->name('secbannerdelete');
	 
	  Route::get('admin/d_boy/orders/{id}','AdminorderController@admin_dboy_orders')->name('admin_dboy_orders');
     //assign delivery boy//
      Route::post('admin/d_boy/assign/{id}','AdminorderController@assigndboy')->name('dboy_assign');
      ////completed orders/////
      Route::get('admin/completed_orders','AdminorderController@admin_com_orders')->name('admin_com_orders');
       ////Pending orders/////
      Route::get('admin/pending_orders','AdminorderController@admin_pen_orders')->name('admin_pen_orders');
      Route::get('secretlogin/{id}','SecretloginController@secretlogin')->name('secret-login');
      Route::post('admin/reject/order/{id}','AdminorderController@rejectorder')->name('admin_reject_order');
        Route::get('admin/cancelled_orders','AdminorderController@admin_can_orders')->name('admin_can_orders');
      Route::get('payment_gateway','PayController@payment_gateway')->name('gateway');
      Route::post('payment_gateway/update','PayController@updatepymntvia')->name('updategateway');
      
      
      ////approval waiting list////
      Route::get('waiting_for_approval/stores/list','ApprovalController@storeclist')->name('storeapprove');
      Route::get('approved/stores/{id}','ApprovalController@storeapproved')->name('storeapproved');
      
      
 	
 		/////////////////////for Top Cat///////////////////////
	    Route::get('top-cat', 'TopAppController@adminTopCat')->name('adminTopCat');
	    Route::get('top-cat/add', 'TopAppController@adminAddTopCat')->name('adminAddTopCat');
	    Route::post('top-cat/add/new', 'TopAppController@adminAddNewTopCat')->name('adminAddNewTopCat');
	    Route::get('top-cat/edit/{id}', 'TopAppController@adminEditTopCat')->name('adminEditTopCat');
	    Route::post('top-cat/update/{id}', 'TopAppController@adminUpdateTopCat')->name('adminUpdateTopCat');
	    Route::get('top-cat/delete/{id}','TopAppController@adminTopCatDelete')->name('adminTopCatDelete');
	    
	   Route::get('user/delete/{id}', 'UserController@del_user')->name('del_userfromlist'); 
	   
	   Route::get('changeStatus', 'HideController@hideproduct')->name('hideprod');
	   Route::get('app_notice','NoticeController@adminnotice')->name('app_notice');
       Route::post('app_notice/update','NoticeController@adminupdatenotice')->name('app_noticeupdate');
       Route::get('updatefirebase', 'HideController@updatefirebase')->name('updatefirebase');
       /// for bulk upload
       
        Route::get('bulk/upload', 'ImportExcelController@bulkup')->name('bulkup');   
        Route::post('bulk_upload', 'ImportExcelController@import')->name('bulk_upload');
        Route::post('bulk_v_upload', 'ImportExcelController@import_varients')->name('bulk_v_upload');
    
           

        
     Route::get('cancelling_reasons/list','ReasonController@can_res_list')->name('can_res_list');
	 Route::get('cancelling_reasons/add','ReasonController@can_res_add')->name('can_res_add');
	 Route::post('cancelling_reasons/added','ReasonController@can_res_added')->name('can_res_added');
	 Route::get('cancelling_reasons/edit/{res_id}','ReasonController@can_res_edit')->name('can_res_edit');
	 Route::post('cancelling_reasons/updated/','ReasonController@can_res_edited')->name('can_res_edited');
	 Route::get('cancelling_reasons/delete/{res_id}','ReasonController@can_res_del')->name('can_res_del');
     
     Route::get('app_design','SettingsController@app_design')->name('get_app_design');
     Route::post('app_design','SettingsController@app_design')->name('post_app_design');
     
	});
	
});

Route::group(['prefix'=>'api','namespace'=>'Protocol\Api'],function(){
  Route::post('forgot_password1/{id}','forgotpasswordController@forgot_password1')->name('forgot_password1');
     Route::get('change_pass/{id}','forgotpasswordController@change_pass')->name('change_pass');
});



Route::group(['prefix'=>'store', ['middleware' => ['XSS']], 'namespace'=>'Protocol\Store'], function(){

	// for login
	Route::get('/', 'LoginController@storeLogin')->name('storeLogin');
	Route::get('store_register/', 'StoreregController@register_store')->name('store_register');
	Route::post('store_registered/', 'StoreregController@store_registered')->name('store_registered');
	Route::post('loginCheck','LoginController@storeLoginCheck')->name('storeLoginCheck');

	Route::get('add/timeslot/{id?}','TimeSlotController@add_timeslot')->name('stor_add_timeslot');
	 Route::post('add/timeslot/{id?}','TimeSlotController@add_timeslot')->name('stor_add_timeslot_post');
	Route::get('delete/timeslot/{id}','TimeSlotController@delete_timeslot')->name('stor_delete_timeslot');

	// Store All Categories
	Route::get('all/categories/list','AllCategoriesController@list')->name('store.all.categories');
    Route::get('add/categories/section','AllCategoriesController@addCategoriesSection')->name('add.categories.section');
    Route::post('submit/categories/section','AllCategoriesController@submitCategoriesSection')->name('submit.categories.section');

    Route::post('submit/categories/newsection','AllCategoriesController@submitCategoriesSectionNew')->name('submit.categories.newsection');

    Route::post('fetch/discounted/categories','AllCategoriesController@fetchDiscountedCategories')->name('fetch.discounted.categories');
    Route::any('edit/categories/section/{section_id}','AllCategoriesController@editCategoriesSection')->name('edit.categories.section');
    Route::any('update/categories/section','AllCategoriesController@updateCategoriesSection')->name('update.categories.section');


	// Store Home Design
	Route::get('home/design','HomeDesignController@homeDesign')->name('store.homeDesign');
	Route::post('delete/home/design','HomeDesignController@deletehomeDesign')->name('store.deletehomeDesign');
	Route::any('create/section','HomeDesignController@createSection')->name('store.create.section');
	Route::post('update/section','HomeDesignController@updateSection')->name('store.update.section');
	Route::get('edit/section/{id}','HomeDesignController@editSection')->name('store.edit.section');
	Route::post('get/category','HomeDesignController@getCategory')->name('store.get.category');
	Route::post('get/category/product','HomeDesignController@getCategoryProduct')->name('store.get.category.product');
	Route::post('get/sub/category','HomeDesignController@getSubCategory')->name('store.get.sub.category');
	Route::post('get/sub/categories','HomeDesignController@getSubCategories')->name('store.get.sub.categories');
	Route::post('save/content/to/section','HomeDesignController@saveContentToSection')->name('store.save.content.to.section');
	Route::post('save/subcategory/content','HomeDesignController@saveSubcategoryContent')->name('store.save.subcategory.content');
	Route::post('save/category/content','HomeDesignController@saveCategoryContent')->name('store.save.category.content');
	Route::get('toggle/section/status/{id}','HomeDesignController@toggleSectionStatus')->name('store.toggle.section.status');

	Route::post('save/allcategory/content','AllCategoriesController@saveAllcategoryContent')->name('store.save.allcategory.content');

 
	/////layout/////
	Route::get('home-layout/form/view/category/{section_id}','HomeLayoutController@homeLayoutFormView')->name('home.layout.form.view.category');
	Route::post('home-layout/form/submit/category','HomeLayoutController@homeLayoutFormAddCategory')->name('home.layout.form.add.category');

	Route::get('home-layout/form/view/sub-category/{section_id}','HomeLayoutController@homeLayoutFormView')->name('home.layout.form.view.sub.category');
	Route::get('home-layout/form/view/product/{section_id}','HomeLayoutController@homeLayoutFormViewProduct')->name('home.layout.form.view.product');

	Route::group(['middleware'=>'bamaStore'], function(){
	Route::get('home', 'HomeController@storeHome')->name('storeHome');
	Route::get('product/add', 'ProductController@sel_product')->name('sel_product');
	Route::post('product/added', 'ProductController@added_product')->name('added_product');
	Route::get('product/delete/{id}','ProductController@delete_product')->name('delete_product');
	Route::post('product/stock/{id}','ProductController@stock_update')->name('stock_update');
	Route::get('logout', 'LoginController@logout')->name('storelogout');
	Route::get('orders/next_day', 'AssignorderController@orders')->name('storeOrders');
	Route::get('orders/today', 'AssignorderController@assignedorders')->name('storeassignedorders');
	Route::post('orders/confirm/{cart_id}','AssignorderController@confirm_order')->name('store_confirm_order');
	Route::get('orders/reject/{cart_id}','OrderController@reject_order')->name('store_reject_order');
	Route::get('orders/products/cancel/{store_order_id}','OrderController@cancel_products')->name('store_cancel_product');
	
	Route::get('update/stock', 'ProductController@st_product')->name('st_product');
	Route::get('payout/request', 'PayoutController@payout_req')->name('payout_req');
	Route::post('payout/request/sent', 'PayoutController@req_sent')->name('payout_req_sent');
	
		/////////invoice
	 Route::get('store/invoice/{cart_id}','InvoiceController@invoice')->name('invoice');
	 
	 /////////invoice
	 Route::get('store/pdf/invoice/{cart_id}','InvoiceController@pdfinvoice')->name('pdfinvoice');
	 
	 
	 Route::get('products/price', 'PriceController@stt_product')->name('stt_product');
	 Route::post('product/price/update/{id}','PriceController@price_update')->name('price_update');
	 Route::post('product/discount/update/{id}','PriceController@storeProductDiscountUpdate')->name('store_discount_update');
	 
	 Route::post('product/update/{id}','PriceController@ProductUpdate')->name('ProductUpdate');

	 Route::get('bulk/upload', 'ImpexcelController@bulkup')->name('bulkuprice');   
     Route::post('bulk_upload/price', 'ImpexcelController@import')->name('bulk_uploadprice');
     Route::post('bulk_upload/stock', 'ImpexcelController@importstock')->name('bulk_uploadstock');
             
     Route::get('req_stock/today', 'RequiredController@reqfortoday')->name('reqfortoday');
     Route::get('req_stock/tommorow', 'RequiredController@reqfornextday')->name('reqfornextday');
	});
	
});