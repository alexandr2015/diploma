<?php

namespace App\Models;

class CalculatedResponse extends BaseModel
{
    protected $visible = [
        'user_id',
        'now_a',
        'now_b',
        'now_c',
        'now_d',
        'future_a',
        'future_b',
        'future_c',
        'future_d',
        'question_id',
        'duration',
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
        'question_id',
        'duration',
    ];
}
