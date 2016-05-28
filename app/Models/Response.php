<?php

namespace App\Models;

class Response extends BaseModel
{
    protected $visible = [
        'student_id',
        'now_a',
        'now_b',
        'now_c',
        'now_d',
        'future_a',
        'future_b',
        'future_c',
        'future_d',
        'question_id',
        'avg(now_a)'
    ];

    protected $fillable = [
        'student_id',
        'now_a',
        'now_b',
        'now_c',
        'now_d',
        'future_a',
        'future_b',
        'future_c',
        'future_d',
        'question_id',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function getAvg()
    {
        return $this->student()
            ->selectRaw('avg(now_a) as now_a')
            ->groupBy('question_id');
    }
}
