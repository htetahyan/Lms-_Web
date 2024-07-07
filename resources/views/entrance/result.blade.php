@extends('parent.master.layouts')
@section('title', 'Exam Result')
@section('content')
<style>
    .result-card {
        max-width: 600px;
        margin: 50px auto;
        padding: 20px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        border-radius: 10px;
        background-color: #ffffff;
    }
    .result-card h2 {
        margin-bottom: 20px;
    }
    .result-card .score {
        font-size: 2em;
        color: #28a745;
    }
</style>
<div class="container">
    <div class="result-card">
        <h2 class="text-center">{{ $result->entranceTest->exam_name }} Result</h2>
        <div class="text-center">
            <p><strong>Reference Number:</strong> {{ $result->reference_number }}</p>
            <p><strong>Entrance Test Id:</strong> {{ $result->entranceTest->exam_code  }}</p>
            <p><strong>Participant ID:</strong> {{ $result->participant_id ? $result->participant_id : 'Guest User' }}</p>
            <p class="score"><strong>Total Score:</strong> {{ $result->total_score }}</p>
        </div>
        <div class="text-center mt-4">
            <a href="" class="btn btn-primary">Back to Test List</a>
        </div>
    </div>
</div>
@endsection
