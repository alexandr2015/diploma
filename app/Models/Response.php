<?php

namespace App\Models;

class Response extends BaseModel
{
    protected $visible = [
        'id',
        'user_id',
        'now_a',
        'now_b',
        'now_c',
        'now_d',
        'future_a',
        'future_b',
        'future_c',
        'future_d',
        'question_option_id',
    ];

    protected $fillable = [
        'user_id',
        'now_a',
        'now_b',
        'now_c',
        'now_d',
        'future_a',
        'future_b',
        'future_c',
        'future_d',
        'question_option_id',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
