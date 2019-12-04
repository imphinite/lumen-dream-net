<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use User;

class Post extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'content', 'user_id'
    ];

   /**
     * A post belongs to a user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}