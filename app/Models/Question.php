<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = [
        'question',
        'question_id',
    ];

    public function getFullName()
    {
        return $this->id . ' ' . $this->question;
    }

    public function responses()
    {
        return $this->hasMany(Response::class);
    }

    public function getAvgResponses()
    {
        return $this->responses()
            ->select(\DB::raw('avg(now_a) as now_a, avg(now_b) as now_b, avg(now_c) as now_c, avg(now_d) as now_d, ' .
                'avg(future_a) as future_a, avg(future_b) as future_b, avg(future_c) as future_c, avg(future_d) as future_d, question_id'))->first();
    }
}
