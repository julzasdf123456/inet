<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class SMSNotifications
 * @package App\Models
 * @version April 16, 2023, 2:02 pm PST
 *
 * @property string $ContactNumber
 * @property string $Message
 * @property string $CustomerId
 * @property string $Billing Month
 * @property string $Type
 * @property string $Status
 */
class SMSNotifications extends Model
{
    // use SoftDeletes;

    use HasFactory;

    public $table = 'SMSNotifications';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];

    protected $primaryKey = 'id';
    
    public $incrementing = false;

    public $fillable = [
        'id',
        'ContactNumber',
        'Message',
        'CustomerId',
        'BillingMonth',
        'Type',
        'Status'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'string',
        'ContactNumber' => 'string',
        'Message' => 'string',
        'CustomerId' => 'string',
        'BillingMonth' => 'date',
        'Type' => 'string',
        'Status' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'ContactNumber' => 'required|string|max:255',
        'Message' => 'nullable|string|max:500',
        'CustomerId' => 'nullable|string|max:255',
        'BillingMonth' => 'nullable',
        'Type' => 'nullable|string|max:255',
        'Status' => 'nullable|string|max:255',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];

    
}
