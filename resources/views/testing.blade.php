@extends('layouts.master')

@section('title', 'ტესტირება')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                {{ Form::open(['url' => 'testing/save', 'method' => 'post', 'class' => 'form-horizontal']) }}
                    {{ Form::hidden('question_id', $question->id) }}
                    <dl>
                        <dt>{{ $question->question }}</dt>
                        @foreach ($question->answers as $key => $answer)
                            <dd>{{ $answer->answer }} - {{ Form::radio('answer_id', $answer->id, ($key == 0) ? true : false) }}</dd>
                        @endforeach
                    </dl>
                    <p>{{ Form::submit('შემდეგი', ['class' => 'btn btn-primary']) }}</p>
                {{ Form::close() }}
            </div>
        </div>
    </div>
@endsection