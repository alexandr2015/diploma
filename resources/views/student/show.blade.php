@extends('layouts.main')

@section('title')
    students
@stop
@section('breadcrumb')
    <li>
        <a href="{!! route('student.index') !!}">
            Students
        </a>
    </li>
    <li class="active">{!! $student->getFullName() !!}</li>
@stop

@section('content')

    @foreach($student->responses as $response)
        <button class="btn btn-sm btn-primary" id="question" data-number="{!! $response->question_id !!}">
            {!! $response->question_id !!}
        </button>
    @endforeach

    @include('blocks.chart')
    <script>
        $('button#question').click(function () {
            var question_id = $(this).data('number'), user_id = {!! $student->id !!};
            var url = 'http://diploma.loc/student/ajax/' + user_id + '/' + question_id;
            printChart(url);
        });
    </script>
@stop