<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PostMeta extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'post_id',
        'meta_key',
        'meta_value',
    ];
}
