<?php

Route::get('/','PagesController@index')->name('root');
Auth::routes();
/* PRODUCT ROUTES */
Route::prefix('product')->middleware('auth')->group(function() {
	Route::post('create','ProductsController@create'); 					/*CREATE PRODUCT*/
	Route::post('update/id={id}','ProductsController@update');	/* UPDATE PRODUCT */
	Route::delete('delete/{id}','ProductsController@delete');		/* DELETE PRODUCT */
	Route::get('/find/id={id}','ProductsController@find');				/* FIND PRODUCT */
});
/* product-store */
Route::prefix('store')->group(function() {
	Route::post('create', 'StoresController@create');
	Route::post('update/{id}', 'StoresController@update');
	Route::get('find/id={id}', 'StoresController@find');
	Route::post('/delete/{sid}','StoresController@delete')->name('deleteStore');
	Route::get('/showmore','StoresController@showMore');
	Route::get('/searchmore','StoresController@searchMore');
	Route::get('/search/{data}','StoresController@searchStore');
});
/* product-tags */
Route::prefix('product-tags')->group(function() {
	Route::post('create', 'ProductTagsController@create');
});
/* product-category */
Route::prefix('product-category')->group(function() {
	Route::post('create', 'ProductCategoryController@create');
	Route::get('/categories/json', 'ProductCategoryController@categoryJSON');
});
/* product-image */
Route::prefix('product-image')->group(function() {
	Route::post('create','ProductImagesController@create');
});
/* product-reviews */
Route::prefix('product-reviews')->middleware('auth')->group(function() {
	Route::post('/create','ProductReviewsController@create');
});
// FAVORITES
Route::prefix('favorite')->middleware('auth')->group(function() {
	Route::post('/create','FavoritesController@create');
	Route::delete('/delete/{id}','FavoritesController@destroy');
});

/* cart */
Route::prefix('cart')->middleware('auth')->group(function() {
	Route::post('create', 'CartsController@create');
	Route::delete('/destroy/{id}', 'CartsController@destroy');
	Route::get('/mycart/json','CartsController@myCartJSON');
});
// Account
Route::prefix('profile')->group(function() {
	Route::get('/', 'PagesController@profile')->middleware('auth')->name('profile');
	Route::get('/json','UsersController@findAccount');
	Route::post('/update','UsersController@updateAccount');
});
// ShopNow
Route::get('/shopnow','PagesController@shopnow')->name('shop');
Route::get('/mycart', 'PagesController@mycart')->middleware('auth')->name('mycart');
Route::get('/favorites','PagesController@favorites')->middleware('auth')->name('favorites');
Route::get('/products', 'PagesController@products')->name('products');
Route::get('/shopnow/product/sid={id}','PagesController@viewProduct')->name('viewproduct');
Route::get('/shopnow/product/tag={tag}','ProductsController@findTag')->name('view_tag');			/* FIND TAG */
Route::get('/store-list','PagesController@stores')->name('storelist');
Route::get('/category','PagesController@category')->name('category');
Route::get('/my-orders','PagesController@myorders')->name('myorders');
Route::get('/store/orders','PagesController@orders')->name('orders');
Route::get('/orders/json','PagesController@ordersJSON');

// Store
Route::prefix('store')->middleware('auth')->group(function() {
	Route::get('/mystore', 'PagesController@mystore')->name('mystore');
	Route::get('/storeproducts', 'PagesController@storeproducts')->name('storeproducts');
	Route::get('/addproducts', 'PagesController@addproducts')->name('addproducts');
});

Route::prefix('checkout')->middleware('auth')->group(function() {
	Route::post('/validate_checkout','CheckoutsController@validateCheckout');
});

Route::prefix('admin')->middleware('auth')->group(function() {
	Route::get('/','AdminPageController@index')->name('admin');
	Route::get('/shop-owners','AdminPageController@shopOwners')->name('shop-owners');
	Route::get('/user-list','AdminPageController@userList')->name('user-list');

	// Store routes
	Route::put('/close-store','StoresController@closeStore');
	Route::put('/refuse-store','StoresController@refuseStore');
	Route::put('/accept-store','StoresController@acceptStore');
	Route::get('/store-list','AdminPageController@storeList')->name('store-list');
	Route::get('/store-requests','AdminPageController@storeRequests')->name('store-requests');
	// Product Routes
	Route::put('/product/remove/{id}','ProductsController@removeProduct');
	Route::get('/product-list/json','ProductsController@productList');
	Route::get('/product-list','AdminPageController@productList')->name('product-list');
	Route::get('/product-list/search={data}','ProductsController@searchProductList');
	Route::get('/product-request','AdminPageController@productRequest')->name('product-request');
	Route::get('/product-request/json','ProductsController@productRequest');
	Route::put('/product-request/accept/{id}','ProductsController@acceptProduct');
	Route::put('/product-request/refuse/{id}','ProductsController@refuseProduct');
});