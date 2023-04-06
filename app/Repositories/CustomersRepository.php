<?php

namespace App\Repositories;

use App\Models\Customers;
use App\Repositories\BaseRepository;

/**
 * Class CustomersRepository
 * @package App\Repositories
 * @version April 3, 2023, 8:49 am PST
*/

class CustomersRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'FullName',
        'Town',
        'Barangay',
        'Purok',
        'ContactNumber',
        'Email',
        'CustomerTechnicalId'
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
        return Customers::class;
    }
}
