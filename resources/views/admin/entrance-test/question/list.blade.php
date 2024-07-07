@extends('admin.layouts.master')
@section('title', 'Add Question')
@section('content')

    <div class="content container-fluid">
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col-sm-12">
                    <div class="page-sub-header">
                        <h3 class="page-title">{{ $exam->exam_code }}</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="students.html">{{ $exam->exam_name }}</a></li>
                            <li class="breadcrumb-item active">Questions and Answers</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <a href="{{ route('questions.add', $exam->id) }}" class="btn btn-warning">+ Add More</a>
        <div class="row p-5">
            @foreach ($questions as $question)
            <div class="col-lg-12">
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title">{{ $loop->iteration }}. {{ $question->question_text }}</h5>
                        <ul>
                            @foreach (json_decode($question->answer_list, true) as $key => $answer)
                            <li>{{ $key }}. {{ $answer }} @if ($question->correct_answer == $key) <strong>(Correct)</strong> @endif</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            @endforeach

        </div>

    </div>
@endsection
