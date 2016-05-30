@extends('layouts.main')

@section('title')
    students
@stop
@section('breadcrumb')
    <li class="active">Students</li>
@stop

@section('content')
    <div class="col-md-6">
        <div class="page-header">
            <h1>
                Students
            </h1>
        </div>
    </div>
    @include('blocks.search_user', ['route' => 'student.index'])
    <table class="table table-striped">
        <thead>
            <tr>
                <th colspan="4">Names</th>
            </tr>
        </thead>
        <tbody>
            <?php $count = count($students); ?>
            @for($i = 0; $i < $count; $i=$i+4)
                <tr>
                    <td>
                        <a href="{!! route('student.show', [$students[$i]->id]) !!}">
                            {!! $students[$i]->getFullName() !!}
                        </a>
                    </td>
                    @if (isset($students[$i+1]))
                        <td>
                            <a href="{!! route('student.show', [$students[$i+1]->id]) !!}">
                                {!! $students[$i+1]->getFullName() !!}
                            </a>
                        </td>
                    @endif
                    @if (isset($students[$i+2]))
                        <td>
                            <a href="{!! route('student.show', [$students[$i+2]->id]) !!}">
                                {!! $students[$i+2]->getFullName() !!}
                            </a>
                        </td>
                    @endif
                    @if (isset($students[$i+3]))
                        <td>
                            <a href="{!! route('student.show', [$students[$i+3]->id]) !!}">
                                {!! $students[$i+3]->getFullName() !!}
                            </a>
                        </td>
                    @endif
                </tr>
            @endfor
        </tbody>
    </table>
    {!! $students->render() !!}
@stop