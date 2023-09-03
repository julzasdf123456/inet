<?php

namespace App\Repositories;

use App\Models\CustomerTechnical;
use App\Repositories\BaseRepository;

/**
 * Class CustomerTechnicalRepository
 * @package App\Repositories
 * @version April 3, 2023, 8:51 am PST
*/

class CustomerTechnicalRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'CustomerId',
        'SpeedSubscribed',
        'MonthlyPayment',
        'MacAddress',
        'ModemId',
        'ModemBrand',
        'ModemNumber'
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
        return CustomerTechnical::class;
    }
}
