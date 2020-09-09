<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class AttributeValue
 * @package App\Models
 */
class AttributeValue extends Model
{
    /**
     * @var string
     */
    protected $table = 'attribute_values';

    /**
     * @var array
     */
    protected $fillable = [
        'attribute_id', 'value', 'price'
    ];

    /**
     * @var array
     */
    protected $cast = [
        'attribute_id' => 'integer',
    ];

    /**
     * set relashionship many to one this table with attributes table
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function attribute()
    {
        return $this->belongsTo(Attribute::class);
    }

}
