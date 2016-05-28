<?php

namespace App\Http\Controllers;

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
        if ($request->has('search')) {
            $students = $this->studentRepository
                ->pushCriteria(new StudentSearchCriteria($request->get('search')));
        } else {
            $students = $this->studentRepository;
        }
        $students = $students->paginate();

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
//            'responses' => $student->avg(),
        ]);
    }

    public function getDataForChart($userId, $questionId)
    {
        $student = $this->studentRepository->find($userId);

        return response()->json($student->avg($questionId));
    }
}
