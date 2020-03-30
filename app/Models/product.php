<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Model;

/**
 * Class product
 * @package App\Models
 * @version March 30, 2020, 11:01 am UTC
 *
 * @property \Illuminate\Database\Eloquent\Collection orderdetails
 * @property string name
 * @property string description
 * @property string colour
 * @property number price
 * @property string image
 */
class product extends Model
{

    public $table = 'product';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';




    public $fillable = [
        'name',
        'description',
        'colour',
        'price',
        'image'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'description' => 'string',
        'colour' => 'string',
        'price' => 'float',
        'image' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function orderdetails()
    {
        return $this->hasMany(\App\Models\Orderdetail::class, 'productid');
    }
}
