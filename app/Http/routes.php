<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


/*
 * Registration
 */
    Route::group(['namespace' => 'Auth'], function(){
        /*Make pages*/
        Route::get('/', ['as' => 'welcome', 'uses' => 'PagesController@welcome']);
        Route::get('/home', ['as' => 'home', 'uses' => 'PagesController@home']);
        Route::post('theme', 'PagesController@theme');
        
        /*Register*/
        Route::get('register', array('as' => 'register_path', 'uses' => 'RegistrationController@create'));
        Route::post('register', array('as' => 'register_path','uses' => 'RegistrationController@store'));
        Route::get('register/verify/{confirmationCode}', array('as' => 'confirmation_path', 'uses' => 'RegistrationController@confirm'));
        Route::get('register/verify/{confirmationCode}', array('as' => 'confirmation_path', 'uses' => 'RegistrationController@confirm'));
        
        /*
         * Sessions
         */
        Route::get('auth/login', array('as' => 'login_path', 'uses' => 'SessionsController@create'));
        Route::post('auth/login', array('as' => 'login_path', 'uses' => 'SessionsController@store'));
        Route::get('logout', array('as' => 'logout_path', 'uses' => 'SessionsController@destroy'));

	/*Social Login*/
	Route::get('facebook', 'SocialController@facebook');
	Route::get('facebook/login', 'SocialController@facebookCallback');
	Route::post('social/save', 'SocialController@socialSave');
	Route::get('google', 'SocialController@google');
	Route::get('google/login', 'SocialController@googleCallback');
        Route::get('register/activation/{confirmationCode}', array('as' => 'confirmation_path', 'uses' => 'SocialController@confirm'));
        
       // Route API Register
        //*Users*/
Route::group(['prefix' => 'api'], function(){
	Route::post('register', 'ApiRegistrationController@store');
        Route::get('confirmation', 'ApiRegistrationController@confirm');
	
});
        /*
        Route::resource('api/apiRegister', 'ApiRegistrationController',
                ['only' => ['index', 'store', 'update', 'destroy', 'show', 'confirmation']]); */   
    });

 /*Password Recovery Reminder*/
  Route::controllers([ 'password' => 'Auth\PasswordController',]);     
  
  Route::post('city', 'AccountController@autocompleteCity'); 
  Route::get('city?input=', 'AccountController@getCity'); 
//*Users*/
Route::group(['prefix' => 'users'], function(){
	Route::get('/', 'UsersController@index');
	Route::get('create', 'UsersController@create');
	Route::post('store', 'UsersController@store');
	Route::get('edit/{id}', 'UsersController@edit');
	Route::post('store/{id}', 'UsersController@store');
	Route::get('destroy/{id}', 'UsersController@destroy');
});
/*Membership*/
Route::group(['prefix' => 'admin/membership'], function(){
    	Route::get('/', 'MembershipController@index');
	Route::get('create', 'MembershipController@create');
	Route::post('store', 'MembershipController@store');
	Route::get('edit/{id}', 'MembershipController@edit');
	Route::get('update/{id}', 'MembershipController@update');
	Route::get('destroy/{id}', 'MembershipController@destroy');
        Route::get('show/{id}', 'MembershipController@show');
});
/*Account*/
Route::group(['prefix' => 'users/account'], function(){
    	Route::get('/', 'AccountController@index');
	Route::get('create', 'AccountController@create');
	Route::post('store', 'AccountController@store');
	Route::get('edit/{id}', 'AccountController@edit');
	Route::get('update/{id}', 'AccountController@update');
	Route::get('destroy/{id}', 'AccountController@destroy');
        Route::get('show/{id}', 'AccountController@show');
});

/*Contacts*/
Route::group(['prefix' => 'users/contacts'], function(){
    	Route::get('/', 'ContactsController@index');
	Route::get('create', 'ContactsController@create');
	Route::post('store', 'ContactsController@store');
	Route::get('edit/{id}', 'ContactsController@edit');
	Route::get('update/{id}', 'ContactsController@update');
	Route::get('destroy/{id}', 'ContactsController@destroy');
        Route::get('show/{id}', 'ContactsController@show');
});


/*Did*/
Route::group(['prefix' => 'admin/did'], function(){
    	Route::get('/', 'DidController@index');
	Route::get('create', 'DidController@create');
	Route::post('store', 'DidController@store');
	Route::get('edit/{id}', 'DidController@edit');
	Route::get('update/{id}', 'DidController@update');
	Route::get('destroy/{id}', 'DidController@destroy');
        Route::get('show/{id}', 'DidController@show');
        Route::get('upload', 'DidController@upload');
        Route::post('save', 'DidController@save');
});

/*Extension*/
Route::group(['prefix' => 'admin/extension'], function(){
    	Route::get('/', 'ExtensionController@index');
	Route::get('create', 'ExtensionController@create');
	Route::post('store', 'ExtensionController@store');
	Route::get('edit/{id}', 'ExtensionController@edit');
	Route::get('update/{id}', 'ExtensionController@update');
	Route::get('destroy/{id}', 'ExtensionController@destroy');
        Route::get('show/{id}', 'ExtensionController@show');
});


/*Roles*/
Route::group(['prefix' => 'admin/roles'], function(){
    	Route::get('/', 'RolesController@index');
	Route::get('create', 'RolesController@create');
	Route::post('store', 'RolesController@store');
	Route::get('edit/{id}', 'RolesController@edit');
	Route::get('update/{id}', 'RolesController@update');
	Route::get('destroy/{id}', 'RolesController@destroy');
        Route::get('show/{id}', 'RolesController@show');
});

Route::get('city',  'AccountController@getCity');

// Route group for API login
Route::group(array('prefix' => 'api'), function()
{
    Route::post('login', 'ApiController@login');
});
// Route group for API Contacts
Route::group(array('prefix' => 'api',  'before' => 'auth.basic'), function()
{
    //Route::resource('contactsByUser', 'ApiController');
    //Route::post('contactsByUser/store', 'ApiController@store');
    Route::get('contactsByUser/store/all/{id}', 'ApiController@storeAll');
    Route::get('recordedAudiosByUser/audio/{id}', 'ApiSendController@getAudioAll');
});

Route::get('contactsByUser', ['uses' => 'ApiController@index','middleware'=>'simpleauth']);
//Route::post('contactsByUser/store', ['uses' => 'ApiController@store','before'=>'auth.basic']);


// Route group for wordpress
Route::group(array('prefix' => 'wordpress'), function()
{
    Route::resource('/', '');
});
