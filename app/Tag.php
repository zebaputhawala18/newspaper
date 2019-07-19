<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'tag_parent_id',
        'tag_name',
        'tag_name_slug',
        'tag_description',
    ];
}
