@extends('parent.master.layouts')
@section('title', 'Exam Result')
@section('content')

    <div class="container">
        <div class="result-card" id="result-card">
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
                integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
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
            <h2 class="text-center">{{ $result->entranceTest->exam_name }} Result</h2>
            <div class="container text-center">
                <div class="row">
                    <a href="" id="container">{!! $simple !!}</a><br />
                </div>
            </div>
            <div class="text-center mt-2">
                <p><strong>Reference Number:</strong> {{ $result->reference_number }}</p>
                <p><strong>Entrance Test Id:</strong> {{ $result->entranceTest->exam_code }}</p>
                <p><strong>Participant ID:</strong> {{ $result->participant_id ? $result->participant_id : 'Guest User' }}
                </p>
                <p class="score"><strong>Total Score:</strong> {{ $result->total_score }}</p>
            </div>
        </div>
        <div class="text-center mt-4">
            <a href="" class="btn btn-primary">Back to Test List</a>
            <button id="download" class="mt-2 btn btn-info text-light" onclick="downloadSVG()">Download Result QR</button>
        </div>
    </div>
    <script>
        function downloadSVG() {
            const svgElement = document.getElementById('result-card');
            const serializer = new XMLSerializer();
            const svgString = serializer.serializeToString(svgElement);

            const blob = new Blob([svgString], {
                type: 'image/svg+xml;charset=utf-8'
            });
            const url = URL.createObjectURL(blob);

            const element = document.createElement('a');
            element.setAttribute('href', url);
            element.setAttribute('download', '{{ $result->entranceTest->exam_code }}.svg');
            document.body.appendChild(element);
            element.click();
            document.body.removeChild(element);
        }
    </script>
@endsection
