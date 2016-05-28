<?php

namespace App\Models;

class Student extends BaseModel
{
    protected $visible = [
        'id',
        'first_name',
        'last_name',
        'responses'
    ];
    
    protected $fillable = [
        'id',
        'first_name',
        'last_name',
    ];
    
    public function responses()
    {
        return $this->hasMany(Response::class);
    }

    public function getFullName()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    public function avg() {
        $result = $this->hasMany(Response::class)
            ->select(\DB::raw('avg(now_a) as now_a, avg(now_b) as now_b, avg(now_c) as now_c, avg(now_d) as now_d, ' .
            'avg(future_a) as future_a, avg(future_b) as future_b, avg(future_c) as future_c, avg(future_d) as future_d, question_id'))
            ->groupBy('question_id')->get();
        return $result;
    }
}
