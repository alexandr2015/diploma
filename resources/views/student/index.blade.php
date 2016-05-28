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
    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($students as $student)
                <tr>
                    <td>
                        <a href="{!! route('student.show', [$student->id]) !!}">
                            {!! $student->getFullName() !!}
                        </a>
                    </td>
                    <td></td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {!! $students->render() !!}
@stop