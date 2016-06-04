<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuestionOption extends Model
{
    protected $fillable = [
        'question_id',
        'question_a',
        'question_b',
        'question_c',
        'question_d',
        'question_main',
    ];

    protected $visible = [
        'id',
        'question_id',
        'question_a',
        'question_b',
        'question_c',
        'question_d',
        'question_main',
        //relations
        'responses',
        'responseByUser',
    ];

    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    public function responses()
    {
        return $this->hasMany(Response::class);
    }

    public function responseByUser()
    {
        return $this->responses()->where('user_id', \Auth::user()->id);
    }

}
