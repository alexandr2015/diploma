@extends('layouts.main')

@section('title')
    students
@stop
@section('breadcrumb')
    <li class="active">Students</li>
@stop

@section('content')
    <div class="row">
        {!! Form::open([
            'method' => 'get',
            'route' => 'student.index'
        ]) !!}
            <div class="col-md-6">
                <div class="page-header">
                    <h1>
                        Students
                    </h1>
                </div>
            </div>
            <div class="col-md-6">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Search for..." value="{!! $search !!}">
                    <span class="input-group-btn">
                        <button class="btn btn-success" type="button"><span class="glyphicon glyphicon-search"></span></button>
                    </span>
                </div>
            </div>

        {!! Form::close() !!}
    </div>

    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Last name</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($students as $student)
                <tr>
                    <td>
                        <a href="{!! route('student.show', [$student->id]) !!}">
                            {!! $student->first_name !!}
                        </a>
                    </td>
                    <td>{!! $student->last_name !!}</td>
                    <td></td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {!! $students->render() !!}
@stop