<?php

namespace App\Http\Controllers\parent;

use App\Models\Post;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Question;
use App\Models\PublicPost;
use App\Models\EntranceTest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\TestResult;
use Illuminate\Support\Facades\Auth;

class UserParentController extends Controller
{
    public function home()
    {
        // $students = Student::where('parent_code',Auth::user()->parent_code)->get();
        $posts = PublicPost::where('viewer_type','!=','admin')->get();
        return view('parent.parent');
    }

    public function showStudent()
    {
        $students = Student::where('parent_code',Auth::user()->parent_code)->get();
        return view('parent.about-student',compact('students'));
    }

    public function showPosts()
    {
        $posts = PublicPost::where('viewer_type','!=','admin')
        ->orwhere('post_type','posts')
        ->get();
        return view('parent.parent',compact('posts'));
    }

    public function showStudentDetails(Request $request)
    {
        $student = Student::where('id',$request->studentId)
        ->first();
        $reportMarks = Subject::where('student_id',$request->studentId)->get();
        $comments = Post::where('student_id',$request->studentId)->get();
       return view('parent.student-details',compact('student','reportMarks','comments'));
    }

    public function exams()
    {
        $exams =  EntranceTest::all();
        return view('entrance.exams.list',compact('exams'));
    }

    public function submit(Request $request)
    {
        $answers = $request->input('answers');

        $totalScore = 0;

        foreach ($answers as $questionId => $selectedAnswer) {
            $question = Question::find($questionId);

            if ($question && $question->correct_answer === $selectedAnswer) {
                $totalScore++;
            }
        }

        TestResult::create([
            'total_score'=> $totalScore,
            'reference_number' => $request->referenceNumber,
            'entrance_test_id' => $request->entranceTestId,
            'participant_id' => auth()->user() ? auth()->user()->id : 0
        ]);
        $encodedReferenceNumber = base64_encode($request->referenceNumber);
        return redirect()->route('test.result',$encodedReferenceNumber);
    }


    public function startExam($id)
    {
        $exam = EntranceTest::where('id',$id)->first();
        $questions = Question::where('entrance_test_id',$id)->get();
        return view('entrance.questions.list',compact('questions','exam'));
    }

    public function result($referenceNumber)
    {
        $key = base64_decode($referenceNumber);
        $result = TestResult::where('reference_number',$key)->with('entranceTest')->first();
        return view('entrance.result',compact('result'));
    }
}
