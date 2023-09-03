<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Expenses
 * @package App\Models
 * @version April 7, 2023, 9:22 am PST
 *
 * @property string $ExpenseDate
 * @property string $ExpenseFor
 * @property number $Amount
 * @property string $UserId
 */
class Expenses extends Model
{
    // use SoftDeletes;

    use HasFactory;

    public $table = 'Expenses';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];

    protected $primaryKey = 'id';

    public $incrementing = false;

    public $fillable = [
        'id',
        'ExpenseDate',
        'ExpenseFor',
        'Amount',
        'UserId'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'string',
        'ExpenseDate' => 'date',
        'ExpenseFor' => 'string',
        'Amount' => 'decimal:2',
        'UserId' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'ExpenseDate' => 'required',
        'ExpenseFor' => 'nullable|string|max:1500',
        'Amount' => 'nullable|numeric',
        'UserId' => 'nullable|string|max:255',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];

    
}
