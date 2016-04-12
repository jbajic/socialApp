<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Status;

class HomeController extends Controller
{

	public function index()
	{
		if( Auth::check() )
		{
			$statuses = Status::notReply()->where(function($query){
							return $query->where('user_id', Auth::user()->id)
										->orWhereIn('user_id', Auth::user()->friends()->lists('id'));
						})->orderBy('created_at', 'desc')
						->paginate(20);


			return view('timeline.index', array('statuses' => $statuses));
		}
		else
		{
			return view('home');
		}
	}

	public function test()
	{
		dd(Auth::user()->id);
	}

}