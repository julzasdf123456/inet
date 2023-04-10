<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class StockHistory
 * @package App\Models
 * @version April 10, 2023, 8:25 am PST
 *
 * @property string $StockId
 * @property number $Quantity
 * @property string $UserId
 * @property string $DateStocked
 * @property string $Notes
 */
class StockHistory extends Model
{
    // use SoftDeletes;

    use HasFactory;

    public $table = 'StockHistory';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];

    protected $primaryKey = 'id';

    public $incrementing = false;

    public $fillable = [
        'id',
        'StockId',
        'Quantity',
        'UserId',
        'DateStocked',
        'Notes'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'string',
        'StockId' => 'string',
        'Quantity' => 'decimal:2',
        'UserId' => 'string',
        'DateStocked' => 'date',
        'Notes' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'StockId' => 'required|string|max:255',
        'Quantity' => 'nullable|numeric',
        'UserId' => 'nullable|string|max:255',
        'DateStocked' => 'nullable',
        'Notes' => 'nullable|string|max:500',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];

    
}
