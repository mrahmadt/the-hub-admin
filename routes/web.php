<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});


/* Auto-generated admin routes */
Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(static function () {
    Route::prefix('admin')->namespace('Admin')->name('admin/')->group(static function() {
        Route::prefix('admin-users')->name('admin-users/')->group(static function() {
            Route::get('/',                                             'AdminUsersController@index')->name('index');
            Route::get('/create',                                       'AdminUsersController@create')->name('create');
            Route::post('/',                                            'AdminUsersController@store')->name('store');
            Route::get('/{adminUser}/impersonal-login',                 'AdminUsersController@impersonalLogin')->name('impersonal-login');
            Route::get('/{adminUser}/edit',                             'AdminUsersController@edit')->name('edit');
            Route::post('/{adminUser}',                                 'AdminUsersController@update')->name('update');
            Route::delete('/{adminUser}',                               'AdminUsersController@destroy')->name('destroy');
            Route::get('/{adminUser}/resend-activation',                'AdminUsersController@resendActivationEmail')->name('resendActivationEmail');
        });
    });
});

/* Auto-generated admin routes */
Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(static function () {
    Route::prefix('admin')->namespace('Admin')->name('admin/')->group(static function() {
        Route::get('/profile',                                      'ProfileController@editProfile')->name('edit-profile');
        Route::post('/profile',                                     'ProfileController@updateProfile')->name('update-profile');
        Route::get('/password',                                     'ProfileController@editPassword')->name('edit-password');
        Route::post('/password',                                    'ProfileController@updatePassword')->name('update-password');
    });
});

/* Auto-generated admin routes */
Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(static function () {
    Route::prefix('admin')->namespace('Admin')->name('admin/')->group(static function() {
        Route::prefix('categories')->name('categories/')->group(static function() {
            Route::get('/',                                             'CategoriesController@index')->name('index');
            Route::get('/create',                                       'CategoriesController@create')->name('create');
            Route::post('/',                                            'CategoriesController@store')->name('store');
            Route::get('/{category}/edit',                              'CategoriesController@edit')->name('edit');
            Route::post('/bulk-destroy',                                'CategoriesController@bulkDestroy')->name('bulk-destroy');
            Route::get('/{category}/itemup',                              'CategoriesController@itemup')->name('itemup');
            Route::get('/{category}/itemdown',                              'CategoriesController@itemdown')->name('itemdown');
            Route::post('/{category}',                                  'CategoriesController@update')->name('update');
            Route::delete('/{category}',                                'CategoriesController@destroy')->name('destroy');
        });
    });
});


/* Auto-generated admin routes */
Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(static function () {
    Route::prefix('admin')->namespace('Admin')->name('admin/')->group(static function() {
        Route::prefix('tabs')->name('tabs/')->group(static function() {
            Route::get('/',                                             'TabsController@index')->name('index');
            Route::get('/create',                                       'TabsController@create')->name('create');
            Route::post('/',                                            'TabsController@store')->name('store');
            Route::get('/{tab}/edit',                                   'TabsController@edit')->name('edit');
            Route::post('/bulk-destroy',                                'TabsController@bulkDestroy')->name('bulk-destroy');
            Route::get('/{tab}/itemup',                              'TabsController@itemup')->name('itemup');
            Route::get('/{tab}/itemdown',                              'TabsController@itemdown')->name('itemdown');
            Route::post('/{tab}',                                       'TabsController@update')->name('update');
            Route::delete('/{tab}',                                     'TabsController@destroy')->name('destroy');
        });
    });
});


/* Auto-generated admin routes */
Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(static function () {
    Route::prefix('admin')->namespace('Admin')->name('admin/')->group(static function() {
        Route::prefix('applications')->name('applications/')->group(static function() {
            Route::get('/',                                             'ApplicationsController@index')->name('index');
            Route::get('/create',                                       'ApplicationsController@create')->name('create');
            Route::post('/',                                            'ApplicationsController@store')->name('store');
            Route::get('/{application}/edit',                           'ApplicationsController@edit')->name('edit');
            Route::post('/bulk-destroy',                                'ApplicationsController@bulkDestroy')->name('bulk-destroy');
            Route::post('/{application}',                               'ApplicationsController@update')->name('update');
            Route::delete('/{application}',                             'ApplicationsController@destroy')->name('destroy');
        });
    });
});

Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(static function () {
    Route::prefix('admin')->namespace('Admin')->name('admin/')->group(static function() {
        Route::prefix('links')->name('links/')->group(static function() {
            //Route::get('/',                                             'ApplicationsController@index')->name('index');
            Route::get('/meta',                                       'LinksController@meta')->name('meta');
        });
    });
});


Route::middleware(['web', 'admin'])->group(function () {
    Route::prefix('admin')->namespace('Admin')->name('admin/')->group(static function() {
        Route::post('/wysiwyg-media','WysiwygMediaUploadController@upload')->name('wysiwyg-upload');
    });
});


/* Auto-generated admin routes */
Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(static function () {
    Route::prefix('admin')->namespace('Admin')->name('admin/')->group(static function() {
        Route::prefix('settings')->name('settings/')->group(static function() {
            Route::get('/',                                             'SettingsController@index')->name('index');
            Route::get('/{setting}/edit',                               'SettingsController@edit')->name('edit');
            Route::post('/{setting}',                                   'SettingsController@update')->name('update');
        });
    });
});


/* Auto-generated admin routes */
Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(static function () {
    Route::prefix('admin')->namespace('Admin')->name('admin/')->group(static function() {
        Route::prefix('pages')->name('pages/')->group(static function() {
            Route::get('/',                                             'PagesController@index')->name('index');
            Route::get('/create',                                       'PagesController@create')->name('create');
            Route::post('/',                                            'PagesController@store')->name('store');
            Route::get('/{page}/edit',                                  'PagesController@edit')->name('edit');
            Route::post('/bulk-destroy',                                'PagesController@bulkDestroy')->name('bulk-destroy');
            Route::post('/{page}',                                      'PagesController@update')->name('update');
            Route::delete('/{page}',                                    'PagesController@destroy')->name('destroy');
        });
    });
});

/* Auto-generated admin routes */
Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(static function () {
    Route::prefix('admin')->namespace('Admin')->name('admin/')->group(static function() {
        Route::prefix('settings')->name('settings/')->group(static function() {
            Route::get('/',                                             'SettingsController@index')->name('index');
            Route::get('/create',                                       'SettingsController@create')->name('create');
            Route::post('/',                                            'SettingsController@store')->name('store');
            Route::get('/{setting}/edit',                               'SettingsController@edit')->name('edit');
            Route::post('/bulk-destroy',                                'SettingsController@bulkDestroy')->name('bulk-destroy');
            Route::post('/{setting}',                                   'SettingsController@update')->name('update');
            Route::delete('/{setting}',                                 'SettingsController@destroy')->name('destroy');
        });
    });
});

/* Auto-generated admin routes */
Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(static function () {
    Route::prefix('admin')->namespace('Admin')->name('admin/')->group(static function() {
        Route::prefix('uploads')->name('uploads/')->group(static function() {
            Route::get('/',                                             'UploadsController@index')->name('index');
            Route::get('/createfolder',                                       'UploadsController@createfolder')->name('createfolder');
            Route::post('/createfolder',                                            'UploadsController@storefolder')->name('storefolder');
            Route::get('/uploadfile',                                       'UploadsController@uploadfile')->name('uploadfile');
            Route::post('/uploadfile',                                            'UploadsController@storeFile')->name('storeFile');
            Route::delete('/delete',                                  'UploadsController@destroy')->name('destroy');
        });
    });
});
