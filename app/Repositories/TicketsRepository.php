<?php

namespace App\Repositories;

use App\Models\Tickets;
use App\Repositories\BaseRepository;

/**
 * Class TicketsRepository
 * @package App\Repositories
 * @version April 11, 2023, 2:12 pm PST
*/

class TicketsRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'CustomerId',
        'CustomerName',
        'Town',
        'Barangay',
        'Ticket',
        'Details',
        'Notes',
        'Status',
        'Latitude',
        'Longitude',
        'ExecutedBy',
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
        return Tickets::class;
    }
}
