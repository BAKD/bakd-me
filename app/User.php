<?php

namespace BAKD;

use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use BAKD\Notifications\ResetPassword as ResetPasswordNotification;
use \Spatie\Permission\Traits\HasRoles;
use \Spatie\Permission\Traits\HasPermissions;

class User extends Authenticatable implements JWTSubject
{
    // use HasRoles;
    use Notifiable;

    protected $table = 'user';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'verified', 'private', 'following_count', 'follower_count', 'reddit', 'bitcoin_talk', 'github', 'google', 'twitter', 'linkedin', 'facebook', 'website', 'wallet', 'bio', 'title', 'currency_id', 'balance'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'photo_url',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['created_at', 'updated_at'];

    /**
     * Get the profile photo URL attribute.
     *
     * @return string
     */
    public function getPhotoUrlAttribute()
    {
        return 'https://www.gravatar.com/avatar/'.md5(strtolower($this->email)).'.jpg?s=200&d=https://bakd.me/images/branding/social-avatar.jpg';
    }

    /**
     * Get the oauth providers.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function oauthProviders()
    {
        return $this->hasMany(OAuthProvider::class);
    }

    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }

    /**
     * @return int
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    // Eloquent Relationships

    // TODO: Rename me
    public function bountyClaims()
    {
        return $this->hasMany(\BAKD\BountyClaim::class);
    }

    public function bounties()
    {
        return $this->belongsTo(\BAKD\Bounty::class);
    }

    public function posts()
    {
        return $this->hasMany(\BAKD\Post::class);
    }

    public function social()
    {
        return $this->hasOne(\BAKD\Social::class, 'owner_id', 'id');
    }

    // Getters/setters/helpers

    public function getGravatar($size = '125')
    {
        $email = md5(strtolower(trim($this->email)));
        return "//www.gravatar.com/avatar/{$email}?s={$size}";
    }



    // ------------------------
    // BOUNTY METHODS
    // ------------------------

    // TODO: Refactor into single query
    public function totalCoinsEarned()
    {
        $coins = 0;
        $query = \BAKD\BountyClaim::with('bounty')->where('user_id', $this->id)->where('confirmed', 1)->get();
        if (!$query->isEmpty()) {
            foreach ($query as $claim) {
                if (!$claim->bounty->isStakeRewardBounty()) {
                    $coins += $claim->bounty->reward;
                }
            }
        }
        return number_format($coins);
    }

    // TODO: Refactor into single query
    public function totalStakesEarned()
    {
        $stakes = 0;
        $query = \BAKD\BountyClaim::with('bounty')->where('user_id', $this->id)->where('confirmed', 1)->get();
        if (!$query->isEmpty()) {
            foreach ($query as $claim) {
                if ($claim->bounty->isStakeRewardBounty()) {
                    $stakes += $claim->stakes_received;
                }
            }
        }
        return number_format($stakes);
    }

    // TODO: Refactor claim status' into enum
    public function totalClaimsApproved()
    {
        $claims = 0;
        $claims = \BAKD\BountyClaim::with('bounty')->where('user_id', $this->id)->where('confirmed', 1)->count();
        return number_format($claims);
    }

    // TODO: Refactor claim status' into enum
    public function totalClaimsPending()
    {
        $claims = 0;
        $claims = \BAKD\BountyClaim::with('bounty')->where('user_id', $this->id)->where('confirmed', 0)->count();
        return number_format($claims);
    }

    // TODO: Refactor claim status' into enum
    public function totalClaimsRejected()
    {
        $claims = 0;
        $claims = \BAKD\BountyClaim::with('bounty')->where('user_id', $this->id)->where('confirmed', 2)->count();
        return number_format($claims);
    }

    // Get all user entries into a specific bounty
    public function getClaimsByBountyId($bountyId)
    {
        return $this->with('bountyClaims', function($query) {
            $query->where('bounty_id', $bountyId);
        })->get();
    }




    // ------------------------
    // FOLLOW/UNFOLLOW METHODS
    // ------------------------


    /**
     * Get formatted user "following" count
     *
     * @return bool
     */
    public function getFollowingCount()
    {
        return number_format($this->following_count);
    }

    /**
     * Get formatted user "follower" count
     *
     * @return bool
     */
    public function getFollowerCount()
    {
        return number_format($this->follower_count);
    }

    /**
     * Check if the user in context is following the other user id
     *
     * @return bool
     */
    public function isFollowing($userId)
    {
        return \BAKD\UserFollower::where('follower_user_id', $this->id)
            ->where('user_id', $userId)
            ->exists();
    }

    /**
     * Check if the user in context is followed by the other user id
     *
     * @return bool
     */
    public function isFollowedBy($userId)
    {
        return \BAKD\UserFollower::where('follower_user_id', $userId)
            ->where('user_id', $this->id)
            ->exists();
    }

    /**
     * Follow another user
     *
     * @return 
     */
    public function follow($userId)
    {
        if ($this->isFollowing($userId)) {
            throw new \Exception('Already following user.');
        }

        // Create new row
        $userFollower = new \BAKD\UserFollower;
        $userFollower->user_id = $userId;
        $userFollower->follower_user_id = $this->id;
        $userFollower->save();
    }

    /**
     * Follower count helper
     *
     * @return 
     */
    public function increaseFollowerCount()
    {
        $this->follower_count == $this->follower_count++;
        $this->save();
    }

    /**
     * Follower count helper
     *
     * @return 
     */
    public function decreaseFollowerCount()
    {
        $this->follower_count == $this->follower_count--;
        $this->save();
    }

    /**
     * Following count helper
     *
     * @return 
     */
    public function increaseFollowingCount()
    {
        $this->following_count == $this->following_count++;
        $this->save();
    }

    /**
     * Following count helper
     *
     * @return 
     */
    public function decreaseFollowingCount()
    {
        $this->following_count == $this->following_count--;
        $this->save();
    }

    /**
     * Unfollow another user
     *
     * @return 
     */
    public function unfollow($userId)
    {
        if (! $this->isFollowing($userId)) {
            throw new \Exception('Not following user.');
        }

        // Find and delete row
        $userFollower = \BAKD\UserFollower::where('follower_user_id', $this->id)
            ->where('user_id', $userId)
            ->delete();
    }
    
    /**
     * Get users followers
     *
     * @return 
     */
    public function getFollowers($paginate = false, $limit = 10, $offset = 0)
    {
        $query = \BAKD\UserFollower::where('user_id', $this->id)->join('user', function ($join) {
            $join->on('user.id', '=', 'user_follower.follower_user_id');
        })->skip($offset);

        if ($paginate) {
            return $query->paginate($limit);
        }

        return $query->limit($limit)->get();
    }

    
    /**
     * Get users follows
     *
     * @return 
     */
    public function getFollowing($paginate = false, $limit = 10, $offset = 0)
    {
        $query = \BAKD\UserFollower::where('follower_user_id', $this->id)->join('user', function ($join) {
            $join->on('user.id', '=', 'user_follower.user_id');
        })->skip($offset);

        if ($paginate) {
            return $query->paginate($limit);
        }

        return $query->limit($limit)->get();
    }
}