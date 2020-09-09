<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    /**
     * @var string
     */
    protected $table = 'attributes';

    /**
     * @var array
     */
    protected $fillable = [
        'code', 'name', 'frontend_type', 'is_filterable', 'is_required'
    ];

    /**
     * @var array
     */
    protected $cast = [
        'is_filterable' => 'boolean',
        'is_required'   => 'boolean',
    ];

    /**
     * set relashionship one to many  this table with attribute_values table
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function values()
    {
        return $this->hasMany(AttributeValue::class);
    }

}
