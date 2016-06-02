<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = [
        'question',
    ];

    protected $visible = [
        'id',
        'question',
        //relations
        'options',
    ];

    public function options()
    {
        return $this->hasMany(QuestionOption::class);
    }
}
