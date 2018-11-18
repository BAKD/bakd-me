<?php

namespace BAKD;

use Illuminate\Database\Eloquent\SoftDeletes;

class Campaign extends Alpha
{
    use Traits\Uuids,
        SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'campaign';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id', 'organization_id', 'currency_id', 'goal_min', 'goal_max', 'title', 'subtitle', 'description', 'verified', 'start_date', 'end_date'];

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
    protected $dates = ['created_at', 'updated_at', 'deleted_at'];
}
