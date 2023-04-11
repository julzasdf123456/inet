<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Tickets
 * @package App\Models
 * @version April 11, 2023, 2:12 pm PST
 *
 * @property string $CustomerId
 * @property string $CustomerName
 * @property string $Town
 * @property string $Barangay
 * @property string $Ticket
 * @property string $Details
 * @property string $Notes
 * @property string $Status
 * @property string $Latitude
 * @property string $Longitude
 * @property string $ExecutedBy
 * @property string $UserId
 */
class Tickets extends Model
{
    // use SoftDeletes;

    use HasFactory;

    public $table = 'Tickets';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];

    protected $primaryKey = 'id';

    public $incrementing = false;

    public $fillable = [
        'id',
        'CustomerId',
        'CustomerName',
        'Town',
        'Barangay',
        'Ticket',
        'Details',
        'Notes',
        'Status',
        'Latitude',
        'Longitude',
        'ExecutedBy',
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
        'Town' => 'string',
        'Barangay' => 'string',
        'Ticket' => 'string',
        'Details' => 'string',
        'Notes' => 'string',
        'Status' => 'string',
        'Latitude' => 'string',
        'Longitude' => 'string',
        'ExecutedBy' => 'string',
        'UserId' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'CustomerId' => 'nullable|string|max:255',
        'CustomerName' => 'nullable|string|max:600',
        'Town' => 'nullable|string|max:255',
        'Barangay' => 'nullable|string|max:255',
        'Ticket' => 'nullable|string|max:255',
        'Details' => 'nullable|string|max:600',
        'Notes' => 'nullable|string|max:1000',
        'Status' => 'nullable|string|max:255',
        'Latitude' => 'nullable|string|max:255',
        'Longitude' => 'nullable|string|max:255',
        'ExecutedBy' => 'nullable|string|max:255',
        'UserId' => 'nullable|string|max:255',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];

    
}
