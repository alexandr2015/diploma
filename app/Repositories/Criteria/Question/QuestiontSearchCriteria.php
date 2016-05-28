<?php

namespace App\Repositories\Criteria\Question;

use Bosnadev\Repositories\Criteria\Criteria;
use Bosnadev\Repositories\Contracts\RepositoryInterface as Repository;

class QuestiontSearchCriteria extends Criteria
{
    protected $search;

    public function __construct($search)
    {
        $this->search = '%' . $search . '%';
    }

    public function apply($model, Repository $repository)
    {
        $model = $model->where('question_id', 'like', $this->search)
            ->orWhere('id', 'like', $this->search)
            ->orWhere('question', 'like', $this->search);

        return $model;
    }
}