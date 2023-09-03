<?php

namespace App\Repositories;

use App\Models\Stocks;
use App\Repositories\BaseRepository;

/**
 * Class StocksRepository
 * @package App\Repositories
 * @version April 10, 2023, 8:19 am PST
*/

class StocksRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'StockName',
        'Description',
        'Type',
        'CanBeChargedToCustomer',
        'RetailPrice',
        'Unit',
        'StockQuantity'
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
        return Stocks::class;
    }
}
