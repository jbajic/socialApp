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

Route::get('/', array('uses' => 'HomeController@index', 'as' => 'home'));

Route::get('/alert', function(){
	return redirect()->route('home')->with('info', 'you have signed up');
});

/**

* ****	GUESTS

*/

Route::group(['middleware' => 'guest'], function(){
	//also possible to do it like this: Route::get('/signup', array('uses' => 'AuthController@getSignUp', 'as' => 'auth.signup', 'middleware' => 'guest' ));

	Route::get('/signup', array('uses' => 'AuthController@getSignUp', 'as' => 'auth.signup' ));

	Route::post('/signup', array('uses' => 'AuthController@postSignUp', 'as' => 'auth.signup.post'));

	Route::get('/signin', array('uses' => 'AuthController@getSignIn', 'as' => 'auth.signin'));

	Route::post('/signin', array('uses' => 'AuthController@postSignIn', 'as' => 'auth.signin.post'));

});

Route::get('/signout', array('uses' => 'AuthController@getSignOut', 'as' => 'auth.signout'));


/**

*	******* AUTHENICATED USER

*/

Route::group(['middleware' => 'auth'], function(){

	Route::get('/search', array('uses' => 'SearchController@getResults', 'as' => 'search.results'));

	Route::post('/search', array('uses' => 'SearchController@getResultsAjax'));


/**

*	*******		PROFILE

*/

	Route::group(['prefix' => 'profile'], function(){

		Route::get('/edit', array('uses' => 'ProfileController@editProfile', 'as' => 'profile.editProfile'));

		Route::post('/edit', array('uses' => 'ProfileController@updateProfile', 'as' => 'profile.updateProfile'));

	});
	
	Route::get('/profile/{id}', array('uses' => 'ProfileController@index', 'as' => 'profile'));

/**

*	****	FRIENDS

*/

	Route::group(['prefix' => 'friends'], function(){

		Route::get('/add/{id}', array('uses' => 'FriendController@addFriend', 'as' => 'friends.add'));

		Route::get('/accept/{id}', array('uses' => 'FriendController@acceptFriend', 'as' => 'friends.accept'));

		Route::post('/delete/{id}',array('uses' => 'FriendController@deleteFriend', 'as' => 'friends.delete'));
	});

	Route::get('/friends', array('uses' => 'FriendController@index', 'as' => 'friend.index'));

/**

* ****** STATUSES

*/

	Route::post('/status', array('uses' => 'StatusController@postStatus', 'as' => 'status.post'));

	Route::post('/status/{id}/reply', array('uses' => 'StatusController@postReply', 'as' => 'status.reply.post'));

//	Route::get('status/{id}/like', array('uses' => 'StatusController@getLike', 'as' => 'status.like'));

	Route::post('status/like', array('uses' => 'StatusController@likeComment'));

	Route::post('status/unlike', array('uses' => 'StatusController@unlikeComment'));

});

Route::get('/test', array('uses' => 'HomeController@test'));
