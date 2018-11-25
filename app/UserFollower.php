<?php

namespace BAKD;

class UserFollower extends Alpha
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'user_follower';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id', 'follower_user_id'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['created_at', 'updated_at'];

    /**
     * Get the "follower" user data for the pivot row in context
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function follower()
    {
        return $this->hasOne(User::class, 'id', 'follower_user_id');
    }

    /**
     * Get the "following" user data for the pivot row in context
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function following()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
