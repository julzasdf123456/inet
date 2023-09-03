<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class TicketLogs
 * @package App\Models
 * @version April 11, 2023, 2:10 pm PST
 *
 * @property string $TicketId
 * @property string $UserId
 * @property string $LogDetails
 * @property string $Notes
 */
class TicketLogs extends Model
{
    // use SoftDeletes;

    use HasFactory;

    public $table = 'TicketLogs';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];

    protected $primaryKey = 'id';

    public $incrementing = false;

    public $fillable = [
        'id',
        'TicketId',
        'UserId',
        'LogDetails',
        'Notes'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'string',
        'TicketId' => 'string',
        'UserId' => 'string',
        'LogDetails' => 'string',
        'Notes' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'TicketId' => 'nullable|string|max:255',
        'UserId' => 'nullable|string|max:255',
        'LogDetails' => 'nullable|string|max:1000',
        'Notes' => 'nullable|string|max:1000',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];

    
}
