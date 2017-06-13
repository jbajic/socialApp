<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class FriendController extends Controller
{
   
   public function index()
   {
        $friends = Auth::user()->friends();
//        $isFriend = Auth::user()->isFriendWith($user);
        $name = Auth::user()->getFirstNameOrUsername();
        $requests = Auth::user()->friendRequests();
//        $hasRequestPending = Auth::user()->hasFriendRequestsPending($user);

        return view('friends.index', array('friends' => $friends, 'name' => $name, 'requests' => $requests));
   }

   public function addFriend($id)
   {
      $user = User::findOrFail($id);

      if( !$user )
      {
          return redirect()->route('home', array('info' => 'User not found!'));
      }
      else if( Auth::user()->id === $user->id )
      {
        return redirect()->back();
      }
      else if( Auth::user()->hasFriendRequestPending($user) || $user->hasFriendRequestPending(Auth::user()) )
      {
          return redirect()->route('profile', array('id' => $user->id, 'info' => 'Friend request already pending.')); 
      }
      else if( Auth::user()->isFriendWith($user) )
      {
          return redirect()->route('profile.index', ['id' => $user->id, 'info' => 'You are already friends!']);
      }
      else
      {
          Auth::user()->addFriend($user);
          return redirect()->route('profile', array('id' => $id, 'info' => 'Friend request sent!'));
      }
   }

   public function acceptFriend($id)
   {
      $user = User::findOrFail($id);

      if( !$user )
      {
          return redirect()->route('home', array('info' => 'User not found!'));
      }
      else if( !Auth::user()->hasFriendRequestReceveid($user) )
      {
        return redirect()->route('home');
      }
      else
      {
        Auth::user()->acceptFriendRequest($user);
        return redirect()->route('profile', $id)->withInfo('Friend request accepted!');
      }
   }

   public function deleteFriend($id)
   {
      $user = User::findOrFail($id);

      if( !Auth::user()->isFriendWith($user) )
      {
          return redirect()->back();
      }

      Auth::user()->deleteFriend($user);

      return redirect()->back();
   }

}
