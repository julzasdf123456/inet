<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Customers
 * @package App\Models
 * @version April 3, 2023, 8:49 am PST
 *
 * @property string $FullName
 * @property string $Town
 * @property string $Barangay
 * @property string $Purok
 * @property string $ContactNumber
 * @property string $Email
 * @property string $CustomerTechnicalId
 */
class Customers extends Model
{
    // use SoftDeletes;

    use HasFactory;

    public $table = 'Customers';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];

    protected $primaryKey = 'id';

    public $incrementing = false;

    public $fillable = [
        'id',
        'FullName',
        'Town',
        'Barangay',
        'Purok',
        'ContactNumber',
        'Email',
        'CustomerTechnicalId',
        'DateConnected',
        'UserId',
        'Trash',
        'Status',
        'Latitude',
        'Longitude'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'string',
        'FullName' => 'string',
        'Town' => 'string',
        'Barangay' => 'string',
        'Purok' => 'string',
        'ContactNumber' => 'string',
        'Email' => 'string',
        'CustomerTechnicalId' => 'string',
        'DateConnected' => 'string',
        'UserId' => 'string',
        'Trash' => 'string',
        'Status' => 'string',
        'Latitude' => 'string',
        'Longitude' => 'string',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'FullName' => 'nullable|string|max:500',
        'Town' => 'nullable|string|max:255',
        'Barangay' => 'nullable|string|max:255',
        'Purok' => 'nullable|string|max:500',
        'ContactNumber' => 'nullable|string|max:255',
        'Email' => 'nullable|string|max:255',
        'CustomerTechnicalId' => 'nullable|string|max:255',
        'created_at' => 'nullable',
        'updated_at' => 'nullable',
        'DateConnected' => 'nullable',
        'UserId' => 'nullable|string|max:255',
        'Trash' => 'nullable|string|max:255',
        'Status' => 'nullable|string|max:255',
        'Latitude' => 'nullable|string',
        'Longitude' => 'nullable|string',
    ];

    public static function getAddress($customer) {
        if ($customer->Purok != null) {
            return $customer->Purok . ', ' . $customer->Barangay . ', ' . $customer->Town;
        } else {
            return $customer->Barangay . ', ' . $customer->Town;
        }
    }
}
