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
    {!! Form::open([
            'method' => 'get',
            'route' => ['question.show', $question->id]
        ]) !!}
        <div class="col-md-6">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Search for..." value="{!! $search !!}">
                    <span class="input-group-btn">
                        <button class="btn btn-success" type="submit"><span class="glyphicon glyphicon-search"></span></button>
                    </span>
            </div>
        </div>

    {!! Form::close() !!}
    @foreach($students as $student)
        <button  class="btn btn-sm btn-primary" id="question" data-id="{!! $student->id !!}">
            {!! $student->getFullName() !!}
        </button>
    @endforeach
    {!! $students->render() !!}

    <div class="raw">
        <canvas id="graph"></canvas>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.1.4/Chart.min.js"></script>
    <script>
        $('button#question').click(function () {
            var user_id = $(this).data('id'), question_id = {!! $question->id !!};
        debugger
            var url = 'http://diploma.loc/student/ajax/' + user_id + '/' + question_id;
            $.ajax({
                method: "POST",
                url: url,
                success: function (res) {
                    var canvas = document.querySelector('#graph').getContext('2d');
                    var data = {
                        labels: ["A", "Гнучкисть", "B", "Зовнишний", "C", "Контроль", "D", "Внутришний"],
                        datasets: [
                            {
                                label: 'Now',
                                backgroundColor: "rgba(179,181,198,0.2)",
                                borderColor: "rgba(179,181,198,1)",
                                pointBackgroundColor: "rgba(179,181,198,1)",
                                pointBorderColor: "#fff",
                                pointHoverBackgroundColor: "#fff",
                                pointHoverBorderColor: "rgba(179,181,198,1)",
                                data: [res.now_a, res.now_a_b ,res.now_b, res.now_b_c, res.now_c, res.now_c_d, res.now_d, res.now_d_a]
                            },
                            {
                                label: 'Future',
                                backgroundColor: "rgba(255,99,132,0.2)",
                                borderColor: "rgba(255,99,132,1)",
                                pointBackgroundColor: "rgba(255,99,132,1)",
                                pointBorderColor: "#fff",
                                pointHoverBackgroundColor: "#fff",
                                pointHoverBorderColor: "rgba(255,99,132,1)",
                                data: [res.future_a, res.future_a_b, res.future_b, res.future_b_c,  res.future_c, res.future_c_d,  res.future_d, res.future_d_a]
                            }
                        ]
                    };
                    var options = {
                        scale: {
                            ticks: {
                                beginAtZero: true,
                                scaleOverride:true,
                                scaleSteps : 10,
                                scaleStepWidth : 50,
                                scaleStartValue : 0,
                                max: 100
                            }
                        }
                    };
                    myRadarChart = new Chart(canvas, {
                        type: 'radar',
                        data: data,
                        options: options
                    });
                }
            });
        });
    </script>

@stop