<?php

namespace BAKD;

class Social extends Alpha
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'social';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['owner_id', 'owner_type', 'facebook', 'twitter', 'linkedin', 'google', 'github', 'discord', 'telegram', 'medium', 'steemit', 'bitcoin', 'reddit'];

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

    public function user()
    {
        return $this->belongsTo(\BAKD\User::class, 'owner_id')->where('owner_type', 'USER');
    }
    
    public function organization()
    {
        return $this->belongsTo(\BAKD\User::class, 'owner_id')->where('owner_type', 'ORGANIZATION');
    }

    public function campaign()
    {
        return $this->belongsTo(\BAKD\User::class, 'owner_id')->where('owner_type', 'CAMPAIGN');
    }
}
