<?php

namespace App\Repositories;

use App\Models\Expenses;
use App\Repositories\BaseRepository;

/**
 * Class ExpensesRepository
 * @package App\Repositories
 * @version April 7, 2023, 9:22 am PST
*/

class ExpensesRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'ExpenseDate',
        'ExpenseFor',
        'Amount',
        'UserId'
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
        return Expenses::class;
    }
}
