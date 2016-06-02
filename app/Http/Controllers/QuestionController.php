<?php

namespace App\Http\Controllers;

use App\Helpers\MathHelper;
use App\Http\Requests;
use App\Repositories\Criteria\Question\QuestiontSearchCriteria;
use App\Repositories\Criteria\Student\StudentSearchCriteria;
use App\Repositories\QuestionRepository;
use App\Repositories\StudentRepository;

class QuestionController extends Controller
{
    protected $questionRepository;

    public function __construct(QuestionRepository $questionRepository)
    {
        $this->questionRepository = $questionRepository;
    }

    public function show($id)
    {
        $question = $this->questionRepository->with(['options'])->find($id);

        return view('question.show', [
            'question' => $question->toArray(),
        ]);
    }

    public function saveQuestionResponse(Requests\BaseRequest $request, $questionId)
    {
        dd($request->all(), $questionId);
    }
}
