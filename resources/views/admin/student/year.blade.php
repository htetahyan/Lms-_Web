@extends('admin.layouts.master')
@section('title', 'Years')

@section('content')
    <div class="content container-fluid">

        <div class="page-header">
            <div class="row align-items-center">
                <div class="col-sm-12">
                    <div class="page-sub-header">
                        <h3 class="page-title">Year</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="students.html">Year</a></li>
                            <li class="breadcrumb-item active">Add Year</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>




        <div class="row p-5">
            <div class="col-lg-4">
                <div class="card shadow p-3">
                    <form action="{{ route('admin#addgrade') }}" method="post">
                        @csrf
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="form-group">

                            <input type="number" class="form-control @error('grade') is-invalid  @enderror" name="grade"
                                placeholder="Add a year" id="">
                        </div>
                        <button type="submit" class="btn btn-primary w-100">
                            Add
                        </button>
                    </form>
                </div>
            </div>
            <div class="col">
                <div class="card shadow p-lg-4 ">
                    <div class="tableresponsive">
                        <table class="table border-0 star-student table-hover table-center mb-0 datatable table-striped">
                            <tr>
                                <th>Year</th>
                                <th class="text-end">Action</th>
                            </tr>
                            @foreach ($years as $year)
                                <tr>
                                    <td>
                                        Year - {{ $year->year }}
                                    </td>
                                    <td class="text-start">
                                        <div class="actions ">
                                            <a href="{{ route('admin#removeYear', $year->id) }}"
                                                class="btn btn-sm bg-success-light me-2 shadow-sm">
                                                <i class="fa-solid fa-trash"></i> </a>

                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection
