<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
use App\Models\Status;

class StatusController extends Controller
{
   
    public function postStatus(Request $request)
    {
        $this->validate($request, array(
            'status' => 'required|max:1000'
        ));
        
        Auth::user()->statuses()->create([
            'body' => $request->input('status'),
        ]);

        return redirect()->back()->withInfo('Status posted');
    }

    public function postReply(Request $request, $statusId)
    {
        $this->validate($request, array(
            'reply-' . $statusId => 'required|max:1000',
        ), array(
            'required' => 'The reply body is required.',
        ));

       $status = Status::notReply()->findOrFail($statusId);

       if( !$status )
       {
            return redirect()->route('home');
       }
       else if( !Auth::user()->isFriendWith($status->user) && Auth::user()->id !== $status->user->id )
       {
            return redirect()->route('home');
       }

       $reply = new Status;
       $reply->body = $request->input('reply-' . $status->id);
       $reply->parent_id = $status->id;
       $reply->user_id = Auth::user()->id;
       $reply->save();
       /*
            Status::create(array(
                'body' => $request->input('reply-' . $status->id),
            ))->user()->associate(Auth::user());
            //user()->associate(Auth::user())  sets foreign key user_id in status table with associated user

            $status->replies()->save($reply);
       */

        return redirect()->route('home');
    }

    public function getLike($statusId)
    {
        $status = Status::findOrFail($statusId);

        if( !$status )
        {
          return redirect()->route('home');
        }
        else if( !Auth::user()->isFriendWith($status->user) )
        {
          return redirect()->route('home');
        }
        else if( Auth::user()->hasLikeStatus($status) )
        {
          return redirect()->back();
        }
   
        $like = $status->likes()->create([]);
        Auth::user()->likes()->save($like);
        
        return redirect()->back();
    }
}

