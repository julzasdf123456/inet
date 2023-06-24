<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class CustomerTechnical
 * @package App\Models
 * @version April 3, 2023, 8:51 am PST
 *
 * @property string $CustomerId
 * @property string $SpeedSubscribed
 * @property number $MonthlyPayment
 * @property string $MacAddress
 * @property string $ModemId
 * @property string $ModemBrand
 * @property string $ModemNumber
 */
class CustomerTechnical extends Model
{
    // use SoftDeletes;

    use HasFactory;

    public $table = 'CustomerTechnical';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];

    protected $primaryKey = 'id';

    public $incrementing = false;

    public $fillable = [
        'id',
        'CustomerId',
        'SpeedSubscribed',
        'MonthlyPayment',
        'MacAddress',
        'ModemId',
        'ModemBrand',
        'ModemNumber',
        'UserId',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'string',
        'CustomerId' => 'string',
        'SpeedSubscribed' => 'string',
        'MonthlyPayment' => 'decimal:2',
        'MacAddress' => 'string',
        'ModemId' => 'string',
        'ModemBrand' => 'string',
        'ModemNumber' => 'string',
        'UserId' => 'string',
        'created_at' => 'string',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'CustomerId' => 'nullable|string|max:255',
        'SpeedSubscribed' => 'nullable|string|max:255',
        'MonthlyPayment' => 'nullable|numeric',
        'MacAddress' => 'nullable|string|max:255',
        'ModemId' => 'nullable|string|max:255',
        'ModemBrand' => 'nullable|string|max:255',
        'ModemNumber' => 'nullable|string|max:255',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'UserId' => 'nullable|string|max:255',
    ];

    
}
