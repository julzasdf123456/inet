<?php

namespace App\Repositories;

use App\Models\SMSNotifications;
use App\Repositories\BaseRepository;

/**
 * Class SMSNotificationsRepository
 * @package App\Repositories
 * @version April 16, 2023, 2:02 pm PST
*/

class SMSNotificationsRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'ContactNumber',
        'Message',
        'CustomerId',
        'Billing Month',
        'Type',
        'Status'
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
        return SMSNotifications::class;
    }
}
