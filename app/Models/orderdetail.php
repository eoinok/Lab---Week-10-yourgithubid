<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Model;

/**
 * Class orderdetail
 * @package App\Models
 * @version March 30, 2020, 11:01 am UTC
 *
 * @property \App\Models\Product productid
 * @property \App\Models\Scorder orderid
 * @property integer productid
 * @property integer orderid
 * @property integer quantity
 * @property number subtotal
 */
class orderdetail extends Model
{

    public $table = 'orderdetail';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';




    public $fillable = [
        'productid',
        'orderid',
        'quantity',
        'subtotal'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'productid' => 'integer',
        'orderid' => 'integer',
        'quantity' => 'integer',
        'subtotal' => 'float'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function productid()
    {
        return $this->belongsTo(\App\Models\Product::class, 'productid');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function orderid()
    {
        return $this->belongsTo(\App\Models\Scorder::class, 'orderid');
    }
}
