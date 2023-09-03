<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Barangays
 * @package App\Models
 * @version April 3, 2023, 8:53 am PST
 *
 * @property string $TownId
 * @property string $Barangay
 */
class Barangays extends Model
{
    // use SoftDeletes;

    use HasFactory;

    public $table = 'Barangays';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];

    protected $primaryKey = 'id';

    public $incrementing = false;

    public $fillable = [
        'id',
        'TownId',
        'Barangay'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'string',
        'TownId' => 'string',
        'Barangay' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'TownId' => 'nullable|string|max:255',
        'Barangay' => 'nullable|string|max:255',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];

    
}
