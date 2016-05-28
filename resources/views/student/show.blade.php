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
    <canvas id="graph"x></canvas>

    {{--<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/1.0.2/Chart.min.js"></script>--}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.1.4/Chart.min.js"></script>
    <script>
        $('button#question').click(function () {
            var question_id = $(this).data('number'), user_id = {!! $student->id !!};
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
//                    new Chart(canvas).Radar(data);
                    myRadarChart = new Chart(canvas, {
                        type: 'radar',
                        data: data,
                        options: options
                    });
//                    debugger
                }
            });
        });
    </script>
    {{--<script>--}}

        {{--var context = document.querySelector('#graph').getContext('2d');--}}

        {{--var dataPolar = {--}}
            {{--datasets: [{--}}
                {{--data: [--}}
                    {{--11,--}}
                    {{--16,--}}
                    {{--7,--}}
                    {{--3,--}}
                    {{--14--}}
                {{--],--}}
                {{--backgroundColor: [--}}
                    {{--"#FF6384",--}}
                    {{--"#4BC0C0",--}}
                    {{--"#FFCE56",--}}
                    {{--"#E7E9ED",--}}
                    {{--"#36A2EB"--}}
                {{--],--}}
                {{--label: 'My dataset' // for legend--}}
            {{--}],--}}
            {{--labels: [--}}
                {{--"Red",--}}
                {{--"Green",--}}
                {{--"Yellow",--}}
                {{--"Grey",--}}
                {{--"Blue"--}}
            {{--]--}}
        {{--};--}}
        {{--new Chart(context).Radar(data);--}}
    {{--</script>--}}
@stop