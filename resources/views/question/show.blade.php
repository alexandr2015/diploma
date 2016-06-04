@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="/css/jquery-ui.min.css">
    <h1>{!! $question['question'] !!}</h1>

    @if ($needUpdate)
        {!! Form::open([
           'method' => 'put',
           'route' => ['question.update_response', $question['id']],
       ]) !!}
    @else
        {!! Form::open([
            'method' => 'post',
            'route' => ['question.save_response', $question['id']],
        ]) !!}
    @endif


    {!! Form::hidden('startTime', $startTime) !!}
        <table class="table table-hover">
            <tbody>
                @foreach($question['options'] as $key => $option)
                    <?php
                    if ($option['response_by_user']) {
                        $id = $option['response_by_user'][0]['id'];
                        $nowA = $option['response_by_user'][0]['now_a'];
                        $futureA = $option['response_by_user'][0]['future_a'];
                        $nowB = $option['response_by_user'][0]['now_b'];
                        $futureB = $option['response_by_user'][0]['future_b'];
                    } else {
                        $nowA = $nowB = $futureB = $futureA = $id = null;
                    }
                    ?>
                    <tr class="active">
                        <td><b>{!! $key + 1 !!}</b></td>
                        <td colspan="2">{!! $option['question_main'] !!}:</td>
                        <td>Now</td>
                        <td>Future</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><b>A</b></td>
                        <td>{!! $option['question_a'] !!}</td>
                        <td rowspan="2">
                            {!! Form::hidden('range[' . $option['id'] . '][id]' , $id) !!}
                            <input type="range" name="range[{!! $option['id'] !!}][now][a]" min="0" max="100" step="1"
                                   value={!! $nowA !!}>
                        </td>
                        <td rowspan="2">
                            <input type="range" name="range[{!! $option['id'] !!}][future][a]" min="0" max="100" step="1"
                                   value="{!! $futureA !!}">
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><b>C</b></td>
                        <td>{!! $option['question_c'] !!}</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><b>B</b></td>
                        <td>{!! $option['question_b'] !!}</td>
                        <td rowspan="2">
                            <input type="range" name="range[{!! $option['id'] !!}][now][b]" min="0" max="100" step="1"
                                   value="{!! $nowB !!}">
                        </td>
                        <td rowspan="2">
                            <input type="range" name="range[{!! $option['id'] !!}][future][b]" min="0" max="100" step="1"
                                   value="{!! $futureB !!}">
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><b>D</b></td>
                        <td>{!! $option['question_d'] !!}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="form-group">
            <div class="col-md-6">
                <button type="submit" class="btn btn-primary form-control">
                    <span class="glyphicon glyphicon-floppy-save"> Save</span>
                </button>
            </div>
            <div class="col-md-6">
                <button type="reset" class="btn btn-link form-control">
                    <span class="glyphicon glyphicon-remove"> Reset</span>
                </button>
            </div>
        </div>
    {!! Form::close() !!}

    <br>
    <br>
    <br>
@stop