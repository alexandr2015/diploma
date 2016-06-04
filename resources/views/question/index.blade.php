@extends('layouts.app')

@section('content')
    <table class="table">
        <thead>
            <tr>
                <th>Question</th>
            </tr>
        </thead>
        <tbody>
            @foreach($questions as $question)
                <tr>
                    <td>
                        <a href="{!! route('question.show', [$question->id]) !!}">
                            {!! $question->question !!}
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {!! $questions->render() !!}
@stop