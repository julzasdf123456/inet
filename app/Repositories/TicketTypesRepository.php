<?php

namespace App\Repositories;

use App\Models\TicketTypes;
use App\Repositories\BaseRepository;

/**
 * Class TicketTypesRepository
 * @package App\Repositories
 * @version April 11, 2023, 2:11 pm PST
*/

class TicketTypesRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'TicketName',
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
        return TicketTypes::class;
    }
}
