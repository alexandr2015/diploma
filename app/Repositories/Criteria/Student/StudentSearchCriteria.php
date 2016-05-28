<?php

namespace App\Repositories\Criteria\Student;

use Bosnadev\Repositories\Criteria\Criteria;
use Bosnadev\Repositories\Contracts\RepositoryInterface as Repository;

class StudentSearchCriteria extends Criteria
{
    protected $search;

    public function __construct($search)
    {
        $this->search = '%' . $search . '%';
    }

    public function apply($model, Repository $repository)
    {
        $model = $model->where('last_name', 'like', $this->search)
            ->orWhere('first_name', 'like', $this->search);

        return $model;
    }
}