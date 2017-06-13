<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PostSignUpRequest;
use App\Models\User;
use Auth;

class AuthController extends Controller
{
	public function getSignUp()
	{
		return view('auth.signup');
	}

	public function postSignUp(PostSignUpRequest $request)
	{
		//validation is in PostSignUpRequest
		
		User::create([
			'email' => $request->input('email'),
			'username' => $request->input('username'),
			'password' => bcrypt($request->input('password')),
		]);

		return redirect()->route('home')->withInfo('Your account has been created and you can sign in!');
	}

	public function getSignIn()
	{
		return view('auth.signin');
	}

	public function postSignIn(Request $request)
	{

		$this->validate($request, [
			'email' => 'required|email',
			'password' => 'required',
		]);

		/*NOTE!
		Note: In these examples, email is not a required option, it is merely used as an example.
		You should use whatever column name corresponds to a "username" in your database.


		If you would like to provide "remember me" functionality in your application, 
		you may pass a boolean value as the second argument to the attempt method, 
		which will keep the user authenticated indefinitely, or until they manually logout. 
		Of course, your users table must include the string remember_token column, 
		which will be used to store the "remember me" token.

		*/

		if( !Auth::attempt($request->only(['email', 'password']), $request->has('remember_me')) )
		{
			return redirect()->back()->with('info', 'Could not sign you in with those credentials.');
		}
		else
		{
			return redirect()->route('home')->with('info', 'You have been signed in.');
		}
	}

	public function getSignOut()
	{
		Auth::logout();

		return redirect()->route('home')->with('info', 'You have been logged out.');
	}
}