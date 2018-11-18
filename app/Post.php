<?php

namespace BAKD;

use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Alpha
{
    use Traits\Uuids,
        SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'post';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['message', 'user_id', 'ip', 'comments', 'interactions', 'views', 'downvotes', 'upvotes', 'dislikes', 'likes', 'views', 'parent_id', 'is_reply'];

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

    public function user()
    {
        return $this->belongsTo(\BAKD\User::class);
    }
}
