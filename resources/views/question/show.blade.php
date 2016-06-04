@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="/css/jquery-ui.min.css">
    <style>
        #price,#price2 {
            border:1px solid #074776;
            padding:5px;
            width:80px;
        }
          #options {
              width:300px;
              padding:10px;
              border:1px solid #074776;
          }
          #slider_price {
              margin-top:10px;
              }
    </style>
    <h1>{!! $question['question'] !!}</h1>

    {!! Form::open([
        'method' => 'post',
        'route' => ['question.save_response', $question['id']],
    ]) !!}
        <table class="table table-hover">
            <tbody>
                @foreach($question['options'] as $key => $option)
                    <tr class="active">
                        <td><b>{!! $key + 1 !!}</b></td>
                        <td colspan="3">{!! $option['question_main'] !!}:</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><b>A</b></td>
                        <td>{!! $option['question_a'] !!}</td>
                        <td rowspan="2">
                            <input type="range" name="range[{!! $option['id'] !!}][a]" min="0" max="100" step="1">
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
                            <input type="range" name="range[{!! $option['id'] !!}][b]" min="0" max="100" step="1">
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