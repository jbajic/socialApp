<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use App\Models\Status;

class User extends Model implements AuthenticatableContract
{
    use Authenticatable;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'location',
        'username',
        'email',
        'password',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    public function getName()
    {
        if( $this->first_name && $this->last_name )
        {
            return $this->first_name.' '.$this->last_name;
        }
        else if( $this->first_name )
        {
            return $this->first_name;
        }
        else
        {
            return false;
        }
    }

    public function getNameOrUsername()
    {
        return $this->getName() ?: $this->username;
    }

    public function getFirstNameOrUsername()
    {
        return $this->username ? $this->username : $this->firstname . $this->lastname;
    }

    public function getAvatarUrl()
    {
        return "https://www.gravatar.com/avatar/".md5($this->email)."?d=retro&s=50";
    }

    /*
        Relationships
    */

    public function statuses()
    {
        return $this->hasMany('App\Models\Status', 'user_id');
    }


    //get all friends to whom the user has sent the request
    public function myFriends()
    {
        return $this->belongsToMany('\App\Models\User', 'friends', 'user_id', 'friend_id');
    }

    
    //get all friends from whom i have receveid a request
    public function friendsOf()
    {
        return $this->belongsToMany('App\Models\User', 'friends', 'friend_id', 'user_id');
    }

    
    //merges myFriends and friendsOf into friends so there is no need for double data in friends table
    public function friends()
    {
        // get only accepted
        return $this->myFriends()->wherePivot('accepted', true)->get()
                                    ->merge($this->friendsOf()->wherePivot('accepted', true)->get());
    }

    //get all request sent by me that have not been accepted
    public function friendRequests()
    {
        return $this->myFriends()->wherePivot('accepted', false)->get();
    }


    //get friends requests send to me that have not been requested
    public function friendRequestPending()
    {
        return $this->friendsOf()->wherePivot('accepted', false)->get();
    }


    //check if user has a pending request from another user
    public function hasFriendRequestPending( User $user )
    {
        return (bool) $this->friendRequestPending()->where('id', $user->id)->count();
    }


    //check if 
    public function hasFriendRequestReceveid( User $user )
    {
        return (bool) $this->friendRequests()->where('id', $user->id)->count();
    }


    //add a friend
    public function addFriend( User $user )
    {
        $this->friendsOf()->attach($user->id);
    }

    //delete friend
    public function deleteFriend( User $user )
    {
        $this->friendsOf()->detach($user->id);
        $this->myFriends()->detach($user->id);
    }


    //accept friend request
    public function acceptFriendRequest( User $user )
    {
        $this->friendRequests()->where('id', $user->id)->first()->pivot
                                                                ->update(array(
                                                                    'accepted' => true));
    }


    //check if a auth is friend with a particular user
    public function isFriendWith( User $user )
    {
        return (bool) $this->friends()->where('id', $user->id)->count();
    }

    public function hasLikeStatus( Status $status )
    {
        /*return (bool) $status->likes()
                    ->where('likeable_id', $status->id)
                    ->where('likeable_type', get_class($status))
                    ->where('user_id', $this->id)
                    ->count();*/

        return (bool) $status->likes()->where('user_id', $this->id)->count();
    }

    public function likes()
    {
        return $this->hasMany('App\Models\Like', 'user_id');
    }



}
