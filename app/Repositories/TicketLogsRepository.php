<?php

namespace App\Repositories;

use App\Models\TicketLogs;
use App\Repositories\BaseRepository;

/**
 * Class TicketLogsRepository
 * @package App\Repositories
 * @version April 11, 2023, 2:10 pm PST
*/

class TicketLogsRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'TicketId',
        'UserId',
        'LogDetails',
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
        return TicketLogs::class;
    }
}
