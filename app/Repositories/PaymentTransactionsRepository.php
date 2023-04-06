<?php

namespace App\Repositories;

use App\Models\PaymentTransactions;
use App\Repositories\BaseRepository;

/**
 * Class PaymentTransactionsRepository
 * @package App\Repositories
 * @version April 6, 2023, 3:55 pm PST
*/

class PaymentTransactionsRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'CustomerId',
        'CustomerName',
        'PaymentFor',
        'BillingMonth',
        'ORNumber',
        'PaymentDate',
        'AmountPaid',
        'PaymentType',
        'Trash'
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
        return PaymentTransactions::class;
    }
}
