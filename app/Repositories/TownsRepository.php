<?php

namespace App\Repositories;

use App\Models\Towns;
use App\Repositories\BaseRepository;

/**
 * Class TownsRepository
 * @package App\Repositories
 * @version April 3, 2023, 8:51 am PST
*/

class TownsRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'Town'
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
        return Towns::class;
    }
}
