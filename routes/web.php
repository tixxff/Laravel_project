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
Route::get('/products', "ProductController@index");
Route::get('/products/category/{id}','ProductController@findCategory');
Route::get('/products/details/{id}', 'ProductController@details');

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/',function(){
    return redirect('/products');
});
Auth::routes();


//auts is 'do have accout?'
Route::middleware(['auth', 'verifyIsAdmin'])->group(function() {

//Category
Route::get('admin/createCategory', 'Admin\CategoryController@index');
Route::post('admin/createCategory', 'Admin\CategoryController@store');
Route::get('admin/editCategory/{id}', 'Admin\CategoryController@edit');
Route::post('admin/updateCategory/{id}', 'Admin\CategoryController@update');
Route::get('admin/deleteCategory/{id}', 'Admin\CategoryController@delete');

//Product
Route::get('admin/createProduct', 'Admin\ProductController@create');
Route::get('admin/dashboard','Admin\ProductController@index');
Route::get('admin/editProduct/{id}','Admin\ProductController@edit');
Route::get('admin/editProductImage/{id}','Admin\ProductController@editImage');
Route::post('admin/createProduct','Admin\ProductController@store');
Route::post('admin/updateProduct/{id}','Admin\ProductController@update');
Route::post('admin/updateProductImage/{id}','Admin\ProductController@updateImage');
Route::get('admin/deleteProduct/{id}', 'Admin\ProductController@delete');

});

//FrontEnd
Route::middleware(['auth'])->group(function() {
    //add to cart
    Route::get('/products/addToCart/{id}', 'ProductController@addProductToCart');
    Route::get('/products/cart', 'ProductController@showCart');
    
});
