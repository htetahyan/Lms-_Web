@extends('admin.layouts.master')
@section('title', 'Add Question')
@section('content')

    <div class="content container-fluid">
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col-sm-12">
                    <div class="page-sub-header">
                        <h3 class="page-title"><a href="{{ route('questions.list',$exam->id) }}">{{ $exam->exam_code }}</a></h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="students.html">{{ $exam->name }}</a></li>
                            <li class="breadcrumb-item active">Add Question</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="row pb-5">
            <div class="row">
                <div class="">
                    <form action="{{ route('question.create') }}" method="post">
                        @csrf
                        <div class="card">
                            <div class="card-body">
                                <div class="bank-inner-details">
                                    <div class="row">
                                        @if ($errors->any())
                                            <div class="alert alert-danger">
                                                <ul>
                                                    @foreach ($errors->all() as $error)
                                                        <li>{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif
                                        <div class="col-lg-12 col-md-12">
                                            <div class="form-group">
                                                <div class="mb-3">
                                                    <label for="question" class="form-label">Question</label>
                                                    <textarea class="form-control" name="question" id="question" rows="3"></textarea>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-3">
                                                <label for="answerA">A. <input class="form-check-input chooseAnswerButtons"
                                                        type="radio" name="correctAnswer" value="A"></label>
                                                <input class="form-control" type="text" name="answers[A]" id="answerA"
                                                >
                                            </div>
                                            <div class="col-lg-3">
                                                <label for="answerB">B. <input class="form-check-input chooseAnswerButtons"
                                                        type="radio" name="correctAnswer" value="B"></label>
                                                <input class="form-control" type="text" name="answers[B]" id="answerB"
                                                >
                                            </div>
                                            <div class="col-lg-3">
                                                <label for="answerC">C. <input class="form-check-input chooseAnswerButtons"
                                                        type="radio" name="correctAnswer" value="C"></label>
                                                <input class="form-control" type="text" name="answers[C]" id="answerC"
                                                >
                                            </div>
                                            <div class="col-lg-3">
                                                <label for="answerD">D. <input class="form-check-input chooseAnswerButtons"
                                                        type="radio" name="correctAnswer" value="D"></label>
                                                <input class="form-control" type="text" name="answers[D]" id="answerD"
                                                >
                                                <input type="hidden" name="entranceTestId" value="{{ $exam->id }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="blog-categories-btn pt-0">
                                <div class="bank-details-btn">
                                    <button type="submit" class="btn bank-cancel-btn me-2">Create</button>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection
