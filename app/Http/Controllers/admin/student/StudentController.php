<?php

namespace App\Http\Controllers\admin\student;

use Storage;
use Carbon\Carbon;
use App\Models\Post;
use App\Models\Year;
use App\Models\Grade;
use App\Models\Student;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Validator;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class StudentController extends Controller
{


    // students list
    public function studentsList()
    {
        $grades = Grade::orderBy('grade')->get();
        $years = Year::orderBy('year')->get();
        $students = Student::when(request('key'), function ($searchQuery) {
            $searchQuery->where('admission_id', 'like', '%' . request('key') . '%');
        })
            ->when(request('studentName'), function ($name) {
                $name->where('student_name', 'like', '%' . request('studentName') . '%');
            })
            ->when(request('phone'), function ($phone) {
                $phone->where('parent_code', 'like', '%' . request('phone') . '%');
            })
            ->when(request('grade') || request('grade') == '0', function ($g) {
                $g->where('grade', request('grade'));
            })
            ->with('year')->paginate(10);
        return view('admin.student.students-list', compact('students', 'grades','years'));
    }

    //add student
    public function addStudentPage()
    {
        $grades = Grade::orderBy('grade')->get();
        $years = Year::orderBy('year')->get();

        return view('admin.student.add-student', compact('years'));
    }

    public function addStudent(Request $request)
    {

        $this->addstudentValidationCheck($request);
        $student = $this->requestStudentData($request);
        if ($request->hasFile('image')) {
            $imageName = uniqid() . $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public', $imageName);
            $student['student_image_uri'] = $imageName;
        }
        $student['new_status_expiry'] = Carbon::now()->addYear();
        Student::create($student);
        toastr()->success('A student has been registered admin!');
        return redirect()->route('admin#studentslist');
    }

    // edit student
    public function editStudent($id)
    {
        $grades = Grade::orderBy('grade')->get();
        $student = Student::where('id', $id)->first();
        return view('admin.student.edit-student', compact('student', 'grades'));
    }
    public function updateStudent(Request $request)
    {
        $this->addstudentValidationCheck($request);
        $edittedStudentData = $this->requestStudentData($request);

        if ($request->hasFile('image')) {
            $imageName = uniqid() . $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public', $imageName);
            $edittedStudentData['student_image_uri'] = $imageName;
        }
        Student::where('id', $request->id)->update($edittedStudentData);
        toastr()->info('A student data has been updated admin!');
        return redirect()->route('admin#studentslist');
    }

    // delete students
    public function deleteStudent($id)
    {
        Student::where('id', $id)->delete();
        toastr('A student has been removed');
        return redirect()->route('admin#studentslist');
    }

    //student details
    public function studentDetails($id)
    {
        $student = Student::where('id', $id)->first();
        $comments = Post::where('student_id', $id)->get();
        $reportMarks = Subject::where('student_id', $id)
            ->orderByRaw('DATE(exam_date)')
            ->orderBy('year_id')
            ->get();

        $url =" http://localhost:8000/admin/student/details/" . $id;

        $qrCode = QrCode::size(100)->generate($url);

        // ->groupBy('grade');


        return view('admin.student.studentdetails', compact('student', 'comments', 'reportMarks','qrCode'));
    }


    public function teacher()
    {
        return view('admin.teachers.index');
    }
    private function addstudentValidationCheck($request)
    {
        $validationRule = [
            'firstName' => 'required',
            'lastName' => 'required',
            'fatherName' => 'required',
            'motherName' => 'required',
            'studentCode' => 'required',
            'gender' => 'required',
            'email' => 'required',
            'dateOfBirth' => 'required',
            'year' => 'required',
            'classId' => 'required',
            'address' => 'required',
            'phone' => 'required',
            'image' => 'mimes:jpg,png,webp',
            'yearId' => 'required'
        ];
        Validator::make($request->all(), $validationRule)->validate();
    }

    private function requestStudentData($request)
    {
        return [
            'first_name' => $request->firstName,
            'last_name' => $request->lastName,
            'dob' => $request->dateOfBirth,
            'student_code' => $request->studentCode,
            'father_name' => $request->fatherName,
            'mother_name' => $request->motherName,
            'year' => $request->year,
            'class_id' => $request->classId,
            'address' => $request->address,
            'phone' => $request->phone,
            'email' => $request->email,
            'year_id'=> $request->yearId,
            'gender' => $request->gender,
        ];
    }
}
