@extends('parent.master.layouts')
@section('title', 'Entrance Exams')
@section('content')
    <link rel="stylesheet" href="{{ asset('component-css/exam-card.css') }}">
    <div class="container">
        <div class="row p-5">
            @foreach ($exams as $exam)
                <div class="col-lg-4">
                    <div class="card card-margin">
                        <div class="card-header no-border">
                            <h5 class="card-title"> {{ $exam->exam_type }}</h5>
                        </div>
                        <div class="card-body pt-0">
                            <div class="widget-49">
                                <div class="widget-49-title-wrapper">
                                    <div class="widget-49-date-primary">
                                        <span class="widget-49-date-day">{{ $loop->iteration }}</span>
                                        {{-- <span class="widget-49-date-month"></span> --}}
                                    </div>
                                    <div class="widget-49-meeting-info">
                                        <span class="widget-49-pro-title"><a
                                                href="{{ route('questions.list', $exam->id) }}">{{ $exam->exam_code }}</a></span>
                                        <span class="widget-49-pro-title"></span>
                                        <span class="text-muted">{{ $exam->allowed_time }} minutes /
                                            {{ $exam->total_questions_count }} Questions</span>
                                    </div>
                                </div>
                                <ol class="widget-49-meeting-points">
                                    <li class="widget-49-meeting-item"><span>{{ $exam->description }}</span></li>

                                </ol>
                                <div class="widget-49-meeting-action">
                                    <a href="{{ route('exam.start', $exam->id) }}" class="btn btn-sm btn-primary">
                                       Start The Test</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

@endsection
