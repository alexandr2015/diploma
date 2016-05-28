@extends('layouts.main')

@section('title')
    questions
@stop
@section('breadcrumb')
    <li class="active">Questions</li>
@stop

@section('content')
    <table class="table">
        <thead>
            <tr>
                <th>Question</th>
                <th>Moodle id</th>
            </tr>
        </thead>
        <tbody>
            @foreach($questions as $question)
                <tr>
                    <td>
                        <a href="{!! route('question.show', [$question->id]) !!}">
                            {!! $question->getFullName() !!}
                        </a>
                    </td>
                    <td>
                        {!! $question->question_id !!}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {!! $questions->render() !!}
@stop