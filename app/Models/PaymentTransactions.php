<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class PaymentTransactions
 * @package App\Models
 * @version April 6, 2023, 3:55 pm PST
 *
 * @property string $CustomerId
 * @property string $CustomerName
 * @property string $PaymentFor
 * @property string $BillingMonth
 * @property string $ORNumber
 * @property string|\Carbon\Carbon $PaymentDate
 * @property number $AmountPaid
 * @property string $PaymentType
 * @property string $Trash
 */
class PaymentTransactions extends Model
{
    // use SoftDeletes;

    use HasFactory;

    public $table = 'PaymentTransactions';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];

    protected $primaryKey = 'id';

    public $incrementing = false;

    public $fillable = [
        'id',
        'CustomerId',
        'CustomerName',
        'PaymentFor',
        'BillingMonth',
        'ORNumber',
        'PaymentDate',
        'AmountPaid',
        'PaymentType',
        'Trash',
        'UserId'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'string',
        'CustomerId' => 'string',
        'CustomerName' => 'string',
        'PaymentFor' => 'string',
        'BillingMonth' => 'date',
        'ORNumber' => 'string',
        'PaymentDate' => 'datetime',
        'AmountPaid' => 'decimal:2',
        'PaymentType' => 'string',
        'Trash' => 'string',
        'UserId' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'CustomerId' => 'nullable|string|max:255',
        'CustomerName' => 'nullable|string|max:500',
        'PaymentFor' => 'nullable|string|max:1500',
        'BillingMonth' => 'nullable',
        'ORNumber' => 'nullable|string|max:255',
        'PaymentDate' => 'nullable',
        'AmountPaid' => 'nullable|numeric',
        'PaymentType' => 'nullable|string|max:255',
        'Trash' => 'nullable|string|max:255',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'UserId' => 'nullable|string|max:255',
    ];

    
}
