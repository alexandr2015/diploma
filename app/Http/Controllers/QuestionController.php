<?php

namespace App\Http\Controllers;

use App\Helpers\MathHelper;
use App\Http\Requests;
use App\Repositories\Criteria\Question\QuestiontSearchCriteria;
use App\Repositories\Criteria\Student\StudentSearchCriteria;
use App\Repositories\QuestionRepository;
use App\Repositories\ResponseRepository;
use App\Repositories\StudentRepository;

class QuestionController extends Controller
{
    protected $questionRepository;
    protected $responseRepository;

    public function __construct(QuestionRepository $questionRepository, ResponseRepository $responseRepository)
    {
        $this->questionRepository = $questionRepository;
        $this->responseRepository = $responseRepository;
    }

    public function show($id)
    {
        $question = $this->questionRepository->with(['options.responseByUser'])->find($id);
        $question = $question->toArray();

        return view('question.show', [
            'question' => $question,
            'needUpdate' => (boolean)$question['options'][0]['response_by_user'],
            'startTime' => time(),
        ]);
    }

    public function saveQuestionResponse(Requests\BaseRequest $request, $questionId)
    {
        $this->responseRepository->createResponse($request->only([
            'range',
            'startTime',
        ]), $questionId);


        return redirect()->back();
    }

    public function updateQuestionResponse(Requests\BaseRequest $request, $questionId)
    {
        $this->responseRepository->updateResponse($request->only([
            'range',
            'startTime',
        ]), $questionId);


        return redirect()->back();
    }
}
