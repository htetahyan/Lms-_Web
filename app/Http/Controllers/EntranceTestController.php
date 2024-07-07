<?php

namespace App\Http\Controllers;

use App\Models\EntranceTest;
use App\Models\Question;
use Illuminate\Http\Request;
use Spatie\FlareClient\View;

class EntranceTestController extends Controller
{
    public function list()
    {
        $exams = EntranceTest::all();
        return view('admin.entrance-test.list',compact('exams'));
    }

    public function add()
    {
        return view('admin.entrance-test.add-entry-exam');
    }

    public function create(Request $request)
    {
        $request->validate([
            'examType'=> 'required',
            'examName' => 'required',
            'examCode' => 'required',
            'allowedTime' => 'required',
            'totalQuestionCount' => 'required',
            'description' => 'required'
        ]);

        $data = [
            'exam_type' => $request->examType,
            'exam_code' => $request->examCode,
            'allowed_time' => $request->allowedTime,
            'total_questions_count' => $request->totalQuestionCount,
            'description' => $request->description,
            'exam_name' => $request->examName
        ];

        EntranceTest::create($data);
        toastr()->success('A test is created.');
        return redirect()->route('entrance-tests.list');
    }

    public function addQuestion($id)
    {
        $exam = EntranceTest::where('id',$id)->first();
        return view('admin.entrance-test.question.add',compact('exam'));
    }

    public function createQuestion(Request $request)
    {
        $request->validate([
            'question' => 'required',
            'answers' => 'required|array|size:4',
            'answers.A' => 'required',
            'answers.B' => 'required',
            'answers.C' => 'required',
            'answers.D' => 'required',
            'correctAnswer' => 'required|string|in:A,B,C,D',
        ]);

        $data = [
            'question_text' => $request->question,
            'answer_list' => json_encode($request->answers),
            'correct_answer' => $request->correctAnswer,
            'entrance_test_id' => $request->entranceTestId
        ];

        Question::create($data);
        toastr()->success('A new question has been created');
        return back();

    }

    public function questionList($id)
    {
        $exam = EntranceTest::where('id',$id)->first();
        $questions = Question::where('entrance_test_id',$id)->get();
        // dd($questions->toArray());
        return view('admin.entrance-test.question.list',compact('questions','exam'));
    }
}
