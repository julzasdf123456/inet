<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Stocks
 * @package App\Models
 * @version April 10, 2023, 8:19 am PST
 *
 * @property string $StockName
 * @property string $Description
 * @property string $Type
 * @property string $CanBeChargedToCustomer
 * @property number $RetailPrice
 * @property string $Unit
 * @property string $StockQuantity
 */
class Stocks extends Model
{
    // use SoftDeletes;

    use HasFactory;

    public $table = 'Stocks';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];

    protected $primaryKey = 'id';

    public $incrementing = false;

    public $fillable = [
        'id',
        'StockName',
        'Description',
        'Type',
        'CanBeChargedToCustomer',
        'RetailPrice',
        'Unit',
        'StockQuantity'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'string',
        'StockName' => 'string',
        'Description' => 'string',
        'Type' => 'string',
        'CanBeChargedToCustomer' => 'string',
        'RetailPrice' => 'decimal:2',
        'Unit' => 'string',
        'StockQuantity' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'StockName' => 'nullable|string|max:255',
        'Description' => 'nullable|string|max:600',
        'Type' => 'nullable|string|max:255',
        'CanBeChargedToCustomer' => 'nullable|string|max:255',
        'RetailPrice' => 'nullable|numeric',
        'Unit' => 'nullable|string|max:255',
        'StockQuantity' => 'nullable|string|max:255',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];

    
}
