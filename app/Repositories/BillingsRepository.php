<?php

namespace App\Repositories;

use App\Models\Billings;
use App\Repositories\BaseRepository;

/**
 * Class BillingsRepository
 * @package App\Repositories
 * @version April 6, 2023, 2:03 pm PST
*/

class BillingsRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
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
        'Notes'
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
        return Billings::class;
    }
}
