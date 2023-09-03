<?php

namespace App\Repositories;

use App\Models\Barangays;
use App\Repositories\BaseRepository;

/**
 * Class BarangaysRepository
 * @package App\Repositories
 * @version April 3, 2023, 8:53 am PST
*/

class BarangaysRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'TownId',
        'Barangay'
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Barangays::class;
    }
}
