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
}
