<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Category extends Model
{
    use Sluggable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'cat_avatar',
        'cat_parent_id',
        'cat_name',
        'cat_name_slug',
        'cat_description',
    ];
    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'cat_name_slug' => [
                'source' => 'cat_name'
            ]
        ];
    }
}
