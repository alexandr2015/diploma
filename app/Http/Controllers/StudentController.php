<?php

namespace App\Http\Controllers;

use App\Helpers\MathHelper;
use App\Repositories\Criteria\Student\StudentSearchCriteria;
use App\Repositories\StudentRepository;

use App\Http\Requests;

class StudentController extends Controller
{
    protected $studentRepository;

    public function __construct(StudentRepository $studentRepository)
    {
        $this->studentRepository = $studentRepository;
    }

    public function index(Requests\BaseRequest $request)
    {
        \DB::enableQueryLog();
        if ($request->has('search')) {
            $students = $this->studentRepository->pushCriteria(new StudentSearchCriteria($request->get('search')));
        } else {
            $students = $this->studentRepository;
        }
        $students = $students->paginate();
dd(\DB::getQueryLog());
        return view('student.index', [
            'students' => $students,
            'search' => $request->get('search', null),
        ]);
    }

    public function show($id)
    {
        $student = $this->studentRepository->with(['responses' => function ($query) {
            $query->groupBy('question_id');
        }])->find($id);

        return view('student.show', [
            'student' => $student,
        ]);
    }

    public function getDataForChart($userId, $questionId)
    {
        $student = $this->studentRepository->find($userId);

        $response = $student->avg($questionId)->toArray();

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
