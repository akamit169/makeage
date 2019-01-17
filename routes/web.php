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


Route::group(['middleware' => 'App\Http\Middleware\Clickjacking'], function() {
    


    Route::get('/', function () {
        return redirect('auth/login');
    });

  

   
    Route::post('auth/login', 'Auth\AuthController@postLogin')->middleware('guest');
    Route::get('auth/login', 'Auth\AuthController@getLogin')->middleware('guest');
    
    Route::group(['prefix' => 'admin'], function () {
        
        Route::post('user/email', 'Admin\AdminController@postTemporaryPassword');
        Route::get('user/forget-password', 'Admin\AdminController@getTemporaryPassword');
        
        Route::group(['middleware' => ['auth']], function () {
            
            
            Route::get('logout', 'Admin\AdminController@getlogout');
            Route::group(['prefix' => 'user'], function () {
             
                Route::get('change-password-by-dasboard', 'Admin\AdminController@getChangePasswordByDasboard');
                Route::post('change-password-by-dasboard', 'Admin\AdminController@postChangePasswordByDasboard');
                Route::get('user-list', 'Admin\UserController@getUserList');
                Route::get('user-list-ajax', 'Admin\UserController@getUserListAjax');
                Route::get('user-details/{id}', 'Admin\UserController@getUserDetails');
                
                Route::get('user-report', 'Admin\UserController@getReportList');
                Route::get('user-report-ajax', 'Admin\UserController@getReportListAjax');
                Route::get('report-details/{id}', 'Admin\UserController@getReportDetails');
                Route::get('delete-reported-user/{id}', 'Admin\UserController@getDeleteReportedUser');
                Route::post('delete-reported-user-reason', 'Admin\UserController@postDeleteReportedUser');
            });
            Route::resource('user', 'Admin\UserController');
            Route::group(['prefix' => 'customer'], function () {
                Route::get('get-customer-list', 'Admin\CustomerController@getCustomerList');
                Route::get('customer-list-ajax', 'Admin\CustomerController@getCustomerListAjax');
                Route::get('view-customer/{id}', 'Admin\CustomerController@getViewCustomer');
            });
            
        });
    });

});

