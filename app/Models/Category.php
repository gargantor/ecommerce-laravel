<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'slug', 'description', 'parent_id', 'featured', 'menu', 'image'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $cast = [
        'parent_id' => 'integer',
        'featured'  => 'boolean',
        'menu'      => 'boolean'

    ];

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = $value;
        $this->attributes['slug'] = str_slug($value);
    }

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }
}