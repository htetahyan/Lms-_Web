@extends('admin.layouts.master')
@section('title', 'Add Student')
@section('content')
    <div class="content container-fluid">

        <div class="page-header">
            <div class="row align-items-center">
                <div class="col-sm-12">
                    <div class="page-sub-header">
                        <h3 class="page-title">Add Students</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="students.html">Student</a></li>
                            <li class="breadcrumb-item active">Add Students</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>


        <div class="row ">
            <div class="col-sm-12">
                <div class="card comman-shadow  ">
                    <div class="card-body">
                        <form action="{{ route('admin#addStudent') }}" method="post" enctype="multipart/form-data">
                            @csrf

                            <div class="row">
                                <div class="col-12">
                                    <h5 class="form-title student-info">Student Information <span><a href="javascript:;"><i
                                                    class="feather-more-vertical"></i></a></span>
                                    </h5>
                                </div>
                                <div class="col-12 col-sm-4">
                                    <div class="form-group local-forms">
                                        <label>First Name <span class="login-danger">*</span>
                                            @error('firstName')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </label>
                                        <input class="form-control" value="{{ old('firstName') }}" name="firstName"
                                            type="text" placeholder="Enter Student's Name">
                                    </div>
                                </div>
                                <div class="col-12 col-sm-4">
                                    <div class="form-group local-forms">
                                        <label>Last Name <span class="login-danger">*</span>
                                            @error('lastName')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </label>
                                        <input class="form-control" value="{{ old('lastName') }}" name="firstName"
                                            type="text" placeholder="Enter Student's Name">
                                    </div>
                                </div>

                                <div class="col-12 col-sm-4">
                                    <div class="form-group local-forms">
                                        <label>Father Name <span class="login-danger">*</span>
                                            @error('fatherName')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </label>
                                        <input class="form-control" name="fatherName" type="text"
                                            value="{{ old('fatherName') }}" placeholder="Enter Father's Name">
                                    </div>
                                </div>

                                <div class="col-12 col-sm-4">
                                    <div class="form-group local-forms">
                                        <label>Mother Name <span class="login-danger">*</span>
                                            @error('motherName')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </label>
                                        <input class="form-control" value="{{ old('motherName') }}" name="motherName"
                                            type="text" placeholder="Enter Mother's Name">
                                    </div>
                                </div>

                                <div class="col-12 col-sm-4">
                                    <div class="form-group local-forms">
                                        <label>Student Code <span class="login-danger">*</span>
                                            @error('studentCode')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </label>
                                        <input class="form-control" value="{{ old('studentCode') }}" name="studentCode"
                                            type="number" placeholder="Enter Parent Code">
                                    </div>
                                </div>

                                <div class="col-12 col-sm-4">
                                    <div class="form-group local-forms">
                                        <label>Gender <span class="login-danger">*</span>
                                            @error('gender')
                                                <span class="text-danger">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </label>
                                        <select class="form-control select" name="gender">
                                            <option value="">Select Gender</option>
                                            <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male
                                            </option>
                                            <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female
                                            </option>
                                            <option value="unidentified" {{ old('gender') == 'unidentified' ? 'selected' : '' }}>Unidentified
                                            </option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-12 col-sm-4">
                                    <div class="form-group local-forms">
                                        <label>Student Code <span class="login-danger">*</span>
                                            @error('studentCode')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </label>
                                        <input class="form-control" name="studentCode" value="{{ old('studentCode') }}"
                                            type="text" placeholder="Enter NRC ">
                                    </div>
                                </div>

                                <div class="col-12 col-sm-4">
                                    <div class="form-group local-forms">
                                        <label>Email<span class="login-danger">*</span>
                                            @error('email')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </label>
                                        <input class="form-control" name="email" value="{{ old('email') }}"
                                            type="text" placeholder="Enter NRC ">
                                    </div>
                                </div>

                                <div class="col-12 col-sm-4">
                                    <div class="form-group local-forms">
                                        <label>Date Of Birth <span class="login-danger">*</span>
                                            @error('dateOfBirth')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </label>
                                        <input placehodler="dd-mm-yyyy" value="{{ old('dateOfBirth') }}" type="date"
                                            class="form-control" name="dateOfBirth">
                                    </div>
                                </div>

                                <div class="col-12 col-sm-4">
                                    <div class="form-group local-forms">
                                        <label>Class Id<span class="login-danger">*</span>
                                            @error('classId')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </label>
                                        <select class="form-control select" name="classId" value="{{ old('classId') }}">
                                            <option value="">Select Class Id</option>
                                            @foreach ($grades as $grade)
                                                <option value="{{ $grade->grade }}">
                                                    @if ($grade->grade == 0)
                                                        KG
                                                    @else
                                                        Grade-{{ $grade->grade }}
                                                    @endif
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>



                                <div class="col-12 col-sm-4">
                                    <div class="form-group local-forms">
                                        <label>Address
                                            @error('address')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </label>
                                        <textarea name="address" id="" cols="30" rows="10" class="form-control"
                                            placeholder="Enter Address">{{ old('address') }}</textarea>
                                    </div>
                                </div>

                                <div class="col-12 col-sm-4">
                                    <div class="form-group local-forms">
                                       <label>Contactable Phone Number <span class="login-danger">*</span>
                                            @error('phone')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </label>
                                        <input class="form-control" name="phone" value="{{ old('phone') }}"
                                            type="text" placeholder="Enter Phone Number">
                                    </div>
                                </div>

                                <div class="col-12 col-sm-4">
                                    <div class="form-group form-control">
                                        @error('image')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror

                                        <input type="file" name="image">
                                    </div>
                                </div>

                                <div class="col-12 col-sm-4">
                                    <div class="form-group local-forms">
                                        <label>Year<span class="login-danger">*</span>
                                            @error('year')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </label>
                                        <input class="form-control" name="year" value="{{ old('year') }}"
                                            type="text" placeholder="Enter NRC ">
                                    </div>
                                </div>

                                <div class="col-12 col-sm-4">
                                    <div class="form-group local-forms">
                                        <label>Month<span class="login-danger">*</span>
                                            @error('month')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </label>
                                        <input class="form-control" name="month" value="{{ old('month') }}"
                                            type="text" placeholder="Enter NRC ">
                                    </div>
                                </div>

                                <div class="col-12 col-sm-4">
                                    <div class="form-group local-forms">
                                        <label>Time<span class="login-danger">*</span>
                                            @error('time')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </label>
                                        <input class="form-control" name="time" value="{{ old('time') }}"
                                            type="text" placeholder="Enter NRC ">
                                    </div>
                                </div>


                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
