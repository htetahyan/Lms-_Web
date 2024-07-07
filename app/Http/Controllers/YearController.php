<?php

namespace App\Http\Controllers;

use App\Models\Year;
use Illuminate\Http\Request;

class YearController extends Controller
{
    public function list()
    {
        $years = Year::orderBy('year','asc')->get();
        return view('admin.student.year',compact('years'));
    }
    public function delete($id)
    {
        Year::where('id',$id)->delete();
        toastr()->error('A year has been removed admin.');
        return back();
    }
}
