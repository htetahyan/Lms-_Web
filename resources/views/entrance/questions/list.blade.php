@extends('parent.master.layouts')

@section('title', 'Entrance Exams')

@section('content')
    <div class="container">
        <?php
        $startTime = time();
        auth()->user() ? $userId = auth()->user()->id : $userId = 0;

        $referenceNumber = $startTime . '-' . $userId;
        ?>
        <div class="row p-3">
            <div id="alertContainer"></div>

            <div class="col-lg-9">
                <form id="examForm" action="{{ route('exam.submit') }}" method="post">
                    @csrf
                    @foreach ($questions as $question)
                        <div class="card mb-3">
                            <div class="card-body">
                                <h5 class="card-title">{{ $loop->iteration }}. {{ $question->question_text }}</h5>

                                @foreach (json_decode($question->answer_list) as $key => $answer)
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="answers[{{ $question->id }}]"
                                            id="{{ $key }}" value="{{ $key }}">
                                        <label class="form-check-label" for="{{ $key }}">
                                            {{ $key }}. {{ $answer }}
                                        </label>
                                    </div>
                                @endforeach

                            </div>
                        </div>
                    @endforeach
                    <input type="hidden" name="referenceNumber" value="{{ $referenceNumber }}">
                    <input type="hidden" name="entranceTestId" value="{{ $exam->id }}">
                    
                    <button type="submit" class="btn btn-primary">Submit Answers</button>
                </form>
            </div>

            <div class="col-lg-3">
                <div id="countdown" class="card shadow p-4">
                    Time Left: <span id="countdownTimer"></span>


                    <span>Reference Number : <span class="text-muted">{{ $referenceNumber }}</span></span>
                </div>

            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const countdownTime = {{ $exam->allowed_time }};
            const oneFifthTime = countdownTime / 5;

            const endTime = new Date().getTime() + countdownTime * 60 * 1000;

            const countdownTimer = setInterval(function() {
                const currentTime = new Date().getTime();

                const remainingTime = endTime - currentTime;

                const minutes = Math.floor((remainingTime % (1000 * 60 * 60)) / (1000 * 60));
                const seconds = Math.floor((remainingTime % (1000 * 60)) / 1000);

                document.getElementById('countdownTimer').textContent = `${minutes}m ${seconds}s`;

                if (remainingTime <= oneFifthTime * 60 * 1000) {
                    displayAlert('Time is running low!'); // Display alert
                }

                if (remainingTime <= 0) {
                    clearInterval(countdownTimer);
                    document.getElementById('countdownTimer').textContent = 'Time\'s up!';
                    document.getElementById('examForm').submit(); // Submit the exam form
                }
            }, 1000);

            function displayAlert(message) {
                const alertHtml = `
                <div class="alert alert-warning alert-dismissible fade show mt-3" role="alert">
                    ${message}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            `;
                document.getElementById('alertContainer').innerHTML = alertHtml;
            }
        });
    </script>
@endsection
