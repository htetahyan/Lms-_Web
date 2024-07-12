<?php

namespace App\Http\Controllers\admin\parent;

use App\Models\User;
use App\Models\Student;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ParentController extends Controller
{
    // parent list page
    public function parentsList()
    {
        $parents = User::where('role', 'parent')
            ->with('students')
            ->when(request('name'), function($searchQuery) {
                $searchQuery->where('users.username', 'like', '%' . request('name') . '%');
            })
            ->when(request('nrc'), function($name) {
                $name->where('users.nrc', 'like', '%' . request('nrc') . '%');
            })
            ->when(request('studentCode'), function($studentCode) {
                $studentCode->where('users.student_code', 'like', '%' . request('studentCode') . '%');
            })
            ->when(request('status') !== null, function($status) {
                $status->where('users.status', 'like', '%' . request('status') . '%');
            })
            ->whereHas('students')
            ->paginate();

        return view('admin.parent.parents-list', compact('parents'));
    }

      // parents without student
    public function parentsWithoutStudent()
    {
        $parentWithoutStudentCode = User::where('role', 'parent')
        ->with('students')
        ->when(request('name'), function($searchQuery) {
            $searchQuery->where('users.username', 'like', '%' . request('name') . '%');
        })
        ->when(request('nrc'), function($name) {
            $name->where('users.nrc', 'like', '%' . request('nrc') . '%');
        })
        ->when(request('studentCode'), function($studentCode) {
            $studentCode->where('users.student_code', 'like', '%' . request('studentCode') . '%');
        })
        ->when(request('status') !== null, function($status) {
            $status->where('users.status', 'like', '%' . request('status') . '%');
        })
        ->doesntHave('students')  // This will filter users who do not have related students
        ->paginate(10);
        return view('admin.parent.nostudentparent',compact('parentWithoutStudentCode'));
    }

      // add parent page
    public function addParentPage()
    {
        return view('admin.parent.add-parent');
    }

      // active status
    public function activeStatus($id,$role)
    {
        $parent = User::where('role',$role)->find($id);
        return response()->json(['status' => $parent->status]);
    }

      // add parent
    public function addParent(Request $request)
    {
        $this->addParentValidation($request,'create');
        $data = $this->getParentData($request,'create');
        if($request->hasFile('image')){
            $imageName = uniqid().$request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public',$imageName);
            $data['image'] = $imageName;
        }
        User::create($data);
        toastr('A parent has been added');
        return redirect()->route('admin#parentsList');
    }

      // parent deatails
    public function parentDetails($id)
    {
        // $parent = User::select('users.*','students.student_code as s_parentCode')
        // ->leftJoin('students', 'users.student_code', 'students.student_code')
        // ->where('users.id',$id)->first();
        $parent = User::where('id',$id)->with('students')->first();
        // $students = Student::where('student_code',$parent->student_code)->orderBy('created_at')->get();
        return view('admin.parent.parent-details',compact('parent'));
    }

      // edit parent data
    public function editParent($id)
    {
        $parent = User::where('id',$id)->first();
        return view('admin.parent.edit-parent',compact('parent'));
    }

    //   delete parent
    public function deleteParent($id)
    {
        User::where('id',$id)->delete();
        toastr('A parent has been removed');
        return redirect()->route('admin#parentsList');
    }

    // update parent data
    public function updateParent(Request $request)
    {
        $this->addParentValidation($request,'update');
        $data = $this->getParentData($request,'update');
        if($request->hasFile('image')){
            $imageName = uniqid().$request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public',$imageName);
            $data['image'] = $imageName;
        }
        if($request->password){
            $data['password'] = Hash::make($request->password);
        }
        User::where('id',$request->id)->update($data);
        toastr()->info('A parent detail has been updated');
        return back();
    }

    private function getParentData($request,$action)
    {
        return [
            'username'=>$request->username,
            'email'=>$request->email,
            'student_code'=>$request->studentCode,
            'nrc'=>$request->nrc,
            'phone'=>$request->phone,
            'gender'=>$request->gender,
            'password'=>Hash::make($request->password),
            'address'=>$request->address,
            'role'=>'parent'
        ];
    }

    private function addParentValidation($request,$action)
    {
        $validationRule = [
            'username'=> 'required',
            'email'=>'required',
            'studentCode'=>'required',
            'nrc'=>'required',
            'phone'=>'required',
            'address'=>'required',
            'gender'=>'required',
            'image'=>'mimes:jpg,png,webp'
        ];
        $validationRule['password'] = $action == 'create' ? 'required' : '';

        Validator::make($request->all(),$validationRule)->validate();
    }
}
