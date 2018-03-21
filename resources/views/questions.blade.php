@extends('layouts.master')

@section('title', 'შეკითხვები')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-5 form-group">
                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                {{ Form::open(['url' => 'questions/save', 'method' => 'post', 'class' => 'form-horizontal']) }}
                    {{ Form::hidden('id', isset($model->id) ? $model->id : null) }}
                    <div class="form-group">
                        {{ Form::label('question', 'შეკითხვა', ['class' => 'col-md-3 control-label']) }}
                        <div class="col-md-9">
                            {{ Form::text('question', isset($model->question) ? $model->question : null, ['class' => 'form-control', 'id' => 'question']) }}
                        </div>
                    </div>
                    <div class="form-group">
                        {{ Form::label('answer1', 'პასუხი 1', ['class' => 'col-md-3 control-label']) }}
                        <div class="col-md-8">
                            {{ Form::text('answers1', isset($model->answers[0]->answer) ? $model->answers[0]->answer : null, ['class' => 'form-control', 'id' => 'answer1']) }}
                        </div>
                        <div class="col-md-1">
                            {{ Form::radio('correct', 0, isset($model->answers[0]->correct) && $model->answers[0]->correct == 1 ? true : false) }}
                        </div>
                    </div>
                    <div class="form-group">
                        {{ Form::label('answer2', 'პასუხი 2', ['class' => 'col-md-3 control-label']) }}
                        <div class="col-md-8">
                            {{ Form::text('answers2', isset($model->answers[1]->answer) ? $model->answers[1]->answer : null, ['class' => 'form-control', 'id' => 'answer2']) }}
                        </div>
                        <div class="col-md-1">
                            {{ Form::radio('correct', 1, isset($model->answers[1]->correct) && $model->answers[1]->correct == 1 ? true : false) }}
                        </div>
                    </div>
                    <div class="form-group">
                        {{ Form::label('answer3', 'პასუხი 3', ['class' => 'col-md-3 control-label']) }}
                        <div class="col-md-8">
                            {{ Form::text('answers3', isset($model->answers[2]->answer) ? $model->answers[2]->answer : null, ['class' => 'form-control', 'id' => 'answer3']) }}
                        </div>
                        <div class="col-md-1">
                            {{ Form::radio('correct', 2, isset($model->answers[2]->correct) && $model->answers[2]->correct == 1 ? true : false) }}
                        </div>
                    </div>
                    <div class="form-group">
                        {{ Form::label('answer4', 'პასუხი 3', ['class' => 'col-md-3 control-label']) }}
                        <div class="col-md-8">
                            {{ Form::text('answers4', isset($model->answers[3]->answer) ? $model->answers[3]->answer : null, ['class' => 'form-control', 'id' => 'answer4']) }}
                        </div>
                        <div class="col-md-1">
                            {{ Form::radio('correct', 3, isset($model->answers[3]->correct) && $model->answers[3]->correct == 1 ? true : false) }}
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-offset-3 col-md-10">
                            {{ Form::submit('შენახვა', ['class' => 'btn btn-primary']) }}
                        </div>
                    </div>
                {{ Form::close() }}
            </div>
            <div class="col-md-7 form-group">
                @if (count($questions) > 0)
                    <table class="table table-striped">
                        <tr>
                            <th>#</th>
                            <th>შეკითხვა</th>
                            <th>რედ.</th>
                            <th>წაშ.</th>
                        </tr>
                        @foreach ($questions as $key => $questions)
                            <tr>
                                <td>{{ ++$key }}</td>
                                <td>{{ $questions->question }}</td>
                                <td>
                                    <a href="{{ url('questions/'.$questions->id) }}" class="btn btn-primary">
                                        <i class="glyphicon glyphicon-pencil"></i>
                                    </a>
                                </td>
                                <td>
                                    <form action="{{ url('question/'.$questions->id) }}" method="post" style="margin-bottom: 5px;">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                        <button type="submit" class="btn btn-danger">
                                            <i class="glyphicon glyphicon-remove"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                @else
                    <p class="text-danger text-center">შეკითხვები არ არის!</p>
                @endif
            </div>
        </div>
    </div>
@endsection