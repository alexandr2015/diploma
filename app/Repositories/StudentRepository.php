<?php

namespace App\Repositories;

use App\Models\Student;

class StudentRepository extends BaseRepository
{
    public function model()
    {
        return Student::class;
    }

    public function orderBy($orderBy)
    {
        $this->model = $this->model->orderBy($orderBy);
        return $this;
    }
}