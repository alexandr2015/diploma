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
    protected $studentRepository;
    
    public function __construct(QuestionRepository $questionRepository, StudentRepository $studentRepository)
    {
        $this->questionRepository = $questionRepository;
        $this->studentRepository = $studentRepository;
    }

    public function index(Requests\BaseRequest $request)
    {
        if ($request->has('search')) {
            $questions = $this->questionRepository->pushCriteria(new QuestiontSearchCriteria($request->get('search')))->paginate();
        } else {
            $questions = $this->questionRepository->paginate();
        }

        return view('question.index', [
            'questions' => $questions,
            'search' => $request->get('search'),
        ]);
    }

    public function show(Requests\BaseRequest $request, $id)
    {
        $question = $this->questionRepository->find($id);

        if ($request->has('search')) {
            $students = $this->studentRepository
                ->pushCriteria(new StudentSearchCriteria($request->get('search')));
        } else {
            $students = $this->studentRepository;
        }
        $students = $students->paginate();

        return view('question.show', [
            'question' => $question,
            'students' => $students,
            'search' => $request->get('search'),
        ]);
    }

    public function getAvgAllResponses($id)
    {
        $question = $this->questionRepository->find($id);
        $response = $question->getAvgResponses()->toArray();

        $response['now_a_b'] = MathHelper::bisector($response['now_a'], $response['now_b']);
        $response['now_b_c'] = MathHelper::bisector($response['now_b'], $response['now_c']);
        $response['now_c_d'] = MathHelper::bisector($response['now_c'], $response['now_d']);
        $response['now_d_a'] = MathHelper::bisector($response['now_d'], $response['now_a']);

        $response['future_a_b'] = MathHelper::bisector($response['future_a'], $response['future_b']);
        $response['future_b_c'] = MathHelper::bisector($response['future_b'], $response['future_c']);
        $response['future_c_d'] = MathHelper::bisector($response['future_c'], $response['future_d']);
        $response['future_d_a'] = MathHelper::bisector($response['future_d'], $response['future_a']);

        return response()->json($response);
    }
}
