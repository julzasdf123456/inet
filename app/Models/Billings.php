<?php

namespace App\Models;

use Eloquent as Model;
use \DateInterval;
use \DatePeriod;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Billings
 * @package App\Models
 * @version April 6, 2023, 2:03 pm PST
 *
 * @property string $BillNumber
 * @property string $CustomerId
 * @property string $BillingMonth
 * @property string $BillingDate
 * @property string $DueDate
 * @property number $BillAmountDue
 * @property number $AdditionalPayments
 * @property number $Deductions
 * @property number $TotalAmountDue
 * @property number $PaidAmount
 * @property number $Balance
 * @property string $Notes
 */
class Billings extends Model
{
    // use SoftDeletes;

    use HasFactory;

    public $table = 'Billings';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];

    protected $primaryKey = 'id';

    public $incrementing = false;

    public $fillable = [
        'id',
        'BillNumber',
        'CustomerId',
        'BillingMonth',
        'BillingDate',
        'DueDate',
        'BillAmountDue',
        'AdditionalPayments',
        'Deductions',
        'TotalAmountDue',
        'PaidAmount',
        'Balance',
        'Notes',
        'SMSSent',
        'EmailSent',
        'Trash',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'string',
        'BillNumber' => 'string',
        'CustomerId' => 'string',
        'BillingMonth' => 'string',
        'BillingDate' => 'string',
        'DueDate' => 'string',
        'BillAmountDue' => 'decimal:2',
        'AdditionalPayments' => 'decimal:2',
        'Deductions' => 'decimal:2',
        'TotalAmountDue' => 'decimal:2',
        'PaidAmount' => 'decimal:2',
        'Balance' => 'decimal:2',
        'Notes' => 'string',
        'SMSSent' => 'string',
        'EmailSent' => 'string',
        'Trash' => 'string',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'BillNumber' => 'nullable|string|max:255',
        'CustomerId' => 'nullable|string|max:255',
        'BillingMonth' => 'nullable',
        'BillingDate' => 'nullable',
        'DueDate' => 'nullable',
        'BillAmountDue' => 'nullable|numeric',
        'AdditionalPayments' => 'nullable|numeric',
        'Deductions' => 'nullable|numeric',
        'TotalAmountDue' => 'nullable|numeric',
        'PaidAmount' => 'nullable|numeric',
        'Balance' => 'nullable|numeric',
        'Notes' => 'nullable|string|max:1500',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'SMSSent' => 'nullable|string|max:255',
        'EmailSent' => 'nullable|string|max:255',
        'Trash' => 'nullable|string|max:255',
    ];

    public static function getMonthsFromDateConnected($start, $end) {
        $interval = DateInterval::createFromDateString('1 month');
        $period = new DatePeriod($start, $interval, $end);

        $arr = [];

        foreach ($period as $dt) {
            $arr[] = $dt->format("Y-m-01");
        }

        return array_reverse($arr);
    }
}
