<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Http\Requests\EditProfileRequest;

class ProfileController extends Controller
{
    public function index($id)
    {
        $user = User::findOrFail($id);
        if (!$user) {
            abort(404);
        } else {
            $statuses = $user->statuses()->notReply()->get();
            $isFriend = Auth::user()->isFriendWith($user);
            $hasFriendRequestPending = Auth::user()->hasFriendRequestPending($user);
            $user->name = $user->getFirstNameOrUsername();
            $friends = $user->friends();
            foreach ($statuses as &$status) {
                if (Auth::user()->hasLikeStatus($status)) {
                    $status->liked = true;
                } else {
                    $status->liked = false;
                }
                $replies = $status->replies()->get();
                foreach ($replies as &$reply) {

                    if (Auth::user()->hasLikeStatus($reply)) {
                        $reply->liked = true;
                    } else {
                        $reply->liked = false;
                    }
                }
                $status->replies = $replies;
            }
        }

        return view('user.profile', array('user' => $user, 'friends' => $friends,
            'hasFriendRequestPending' => $hasFriendRequestPending,
            'isFriend' => $isFriend, 'statuses' => $statuses,
            'authUserIsFriend' => Auth::user()->isFriendWith($user)));
    }


    public function editProfile()
    {
        return view('user.editProfile', array('user' => Auth::user()));
    }

    public function updateProfile(EditProfileRequest $request)
    {
        Auth::user()->update(array(
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'location' => $request->input('location'),
        ));

        return redirect()->route('profile.editProfile')->withInfo('Your profile has been updated');
    }

}