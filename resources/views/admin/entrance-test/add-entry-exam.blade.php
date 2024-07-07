@extends('admin.layouts.master')
@section('title', 'Add Post')
@section('content')

    <div class="content container-fluid">
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col-sm-12">
                    <div class="page-sub-header">
                        <h3 class="page-title">Entry Exam</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="students.html">Entry Exam</a></li>
                            <li class="breadcrumb-item active">Add</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="row pb-5">

                <div class="row">
                    <div class="">
                        <form action="{{ route('entrance-tests.create') }}" method="post" onsubmit="submitForm()">
                            @csrf
                            <div class="card">
                                <div class="card-body">
                                    <div class="bank-inner-details">
                                        <div class="row">
                                            @if ($errors->any())
                                                <div class="alert alert-danger">
                                                    <ul>
                                                        @foreach ($errors->all() as $error)
                                                            <li>{{ $error }}</li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            @endif
                                            <div class="col-lg-12 col-md-12 mb-1">
                                                <div class="form-group">
                                                    <label>Type<span class="text-danger">*</span></label>
                                                    <select name="examType" id="" class="form-control">
                                                        <option value="" selected disabled>Select Exam Subject</option>
                                                        <option vaue="english">ENGLISH</option>
                                                        <option value="maths">MATHS</option>
                                                        <option value="social">Social</option>

                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-12 col-md-12">
                                                <div class="form-group">
                                                    <label>Exam Code<span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" placeholder="EDUSN - 0001" name="examCode">
                                                </div>
                                            </div>

                                            <div class="col-lg-12 col-md-12">
                                                <div class="form-group">
                                                    <label>Allowed Time (minutes)<span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" name="allowedTime">
                                                </div>
                                            </div>

                                            <div class="col-lg-12 col-md-12">
                                                <div class="form-group">
                                                    <label>Exam Name<span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" name="examName">
                                                </div>
                                            </div>

                                            <div class="col-lg-12 col-md-12">
                                                <div class="form-group">
                                                    <label>Total Question Count<span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" name="totalQuestionCount">
                                                </div>
                                            </div>

                                            <input type="hidden" name="authorName" value="{{ Auth::user()->username }}">

                                            <div class="col-lg-12 col-md-12">
                                                <div class="form-group">
                                                    <div class="mb-3">
                                                        <label for="" class="form-label">Description</label>
                                                        <textarea class="form-control" name="description" id="" rows="3"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class=" blog-categories-btn pt-0">
                                    <div class="bank-details-btn ">
                                        <button type="submit " class="btn bank-cancel-btn me-2">Create</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

        </div>
    </div>
@endsection
