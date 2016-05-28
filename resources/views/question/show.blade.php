@extends('layouts.main')

@section('title')
    questions
@stop
@section('breadcrumb')
    <li>
        <a href="{!! route('question.index') !!}">
            Questions
        </a>
    </li>
    <li class="active">{!! $question->id !!}</li>
@stop

@section('content')
    @include('blocks.search_user', ['route' => ['question.show', $question->id]])

    @foreach($students as $student)
        <button  class="btn btn-sm btn-primary" id="question" data-id="{!! $student->id !!}">
            {!! $student->getFullName() !!}
        </button>
    @endforeach
    {!! $students->render() !!}

    @include('blocks.chart')
    <script>
        $('button#question').click(function () {
            var user_id = $(this).data('id'), question_id = {!! $question->id !!};
            var url = 'http://diploma.loc/student/ajax/' + user_id + '/' + question_id;
            printChart(url);
        });
    </script>

@stop