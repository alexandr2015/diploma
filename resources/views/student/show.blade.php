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
    <canvas id="graph" width="400" height="400" style="border:1px solid"></canvas>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/1.0.2/Chart.min.js"></script>
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
                        labels: ["A", "B", "C", "D"],
                        datasets: [
                            {
                                fillColor : "rgba(100,220,100, 0.7",
                                strokeColor : "rgba(220,220,220, 0.1",
                                pointColor : "rgba(220,220,220, 1",
                                pointStrokeColor : "#fff",
                                pointHighlightFill : "#fff",
                                pointHighlightStroke : "rgba(220,220,220,1)",
                                data: [res.now_a, res.now_b, res.now_c, res.now_d]
                            },
                            {
                                fillColor : "rgba(0,220,220, 0.2",
                                strokeColor : "rgba(220,220,220, 0.1",
                                pointColor : "rgba(220,220,220, 1",
                                pointStrokeColor : "#fff",
                                pointHighlightFill : "#fff",
                                pointHighlightStroke : "rgba(220,220,220,1)",
                                data: [res.future_a, res.future_b, res.future_c, res.future_d]
                            }
                        ]
                    };
                    new Chart(canvas).Radar(data);
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