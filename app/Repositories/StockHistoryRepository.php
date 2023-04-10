<?php

namespace App\Repositories;

use App\Models\StockHistory;
use App\Repositories\BaseRepository;

/**
 * Class StockHistoryRepository
 * @package App\Repositories
 * @version April 10, 2023, 8:25 am PST
*/

class StockHistoryRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'StockId',
        'Quantity',
        'UserId',
        'DateStocked',
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
        return StockHistory::class;
    }
}
