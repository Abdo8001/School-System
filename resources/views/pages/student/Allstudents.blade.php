@extends('layouts.master')
@section('css')

@section('title')
    {{ trans('main_trans.list_students') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">

    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0"> {{ trans('main_trans.list_students') }}</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#" class="default-color">{{ trans('main_trans.Home') }}</a></li>
                <li class="breadcrumb-item active">{{ trans('main_trans.list_students') }}</li>
            </ol>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
{{-- add msg --}}
@if (session()->has('add'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>{{ session()->get('add') }}</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
{{-- edit msg --}}
@if (session()->has('edit'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>{{ session()->get('edit') }}</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
{{-- delete msg --}}
@if (session()->has('delete'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>{{ session()->get('delete') }}</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
{{-- promotion msg --}}
@if (session()->has('promotion'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>{{ session()->get('promotion') }}</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
<div class="row">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">
                <a href="{{ route('students.create') }}" class="btn btn-success btn-sm" role="button"
                    aria-pressed="true">{{ trans('main_trans.add_student') }}</a><br><br>
                <div class="table-responsive">
                    <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
                        style="text-align: center">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>{{ trans('Students_trans.name') }}</th>
                                <th>{{ trans('Students_trans.email') }}</th>
                                <th>{{ trans('Students_trans.gender') }}</th>
                                <th>{{ trans('Students_trans.Grade') }}</th>
                                <th>{{ trans('Students_trans.classrooms') }}</th>
                                <th>{{ trans('Students_trans.section') }}</th>
                                <th>{{ trans('Students_trans.Processes') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($students as $student)
                                <tr>
                                    <td>{{ $loop->index + 1 }}</td>
                                    <td>{{ $student->name }}</td>
                                    <td>{{ $student->email }}</td>
                                    <td>{{ $student->gender->Name }}</td>
                                    <td>{{ $student->grade->name }}</td>
                                    <td>{{ $student->classroom->calss_name }}</td>
                                    <td>{{ $student->section->Name_Section }}</td>
                                    <td>
                                        <div class="dropdown show">
                                            <a class="btn btn-success btn-sm dropdown-toggle" href="#"
                                                role="button" id="dropdownMenuLink" data-toggle="dropdown"
                                                aria-haspopup="true" aria-expanded="false">
                                                {{ trans('Students_trans.Processes') }}
                                            </a>

                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">

                                                <a class="dropdown-item"
                                                    href="{{ route('students.show', $student->id) }}"><i
                                                        style="color: #ffc107" class="far fa-eye "></i>&nbsp;
                                                    {{ trans('Students_trans.Student_information') }}</a>
                                                <a class="dropdown-item"
                                                    href="{{ route('students.edit', $student->id) }}"><i
                                                        style="color:green" class="fa fa-edit"></i>&nbsp;
                                                    {{ trans('Students_trans.Student_Edit') }}</a>
                                                <a class="dropdown-item"
                                                    href="{{ route('processing_fees.show', $student->id) }}"><i
                                                        style="color:rgb(0, 128, 38)" class="fa fa-edit"></i>&nbsp;
                                                    {{ trans('fees.fees_piad') }}</a>
                                                <a class="dropdown-item"
                                                    href="{{ route('receipts.show', $student->id) }}"><i
                                                        style="color: #3615c7"
                                                        class="fas fa-money-bill-alt"></i>&nbsp;{{ trans('fees.fees_salary') }}</a>
                                                <a class="dropdown-item"
                                                    data-target="#Delete_Student{{ $student->id }}"
                                                    data-toggle="modal" href="##Delete_Student{{ $student->id }}"><i
                                                        style="color: red"title="{{ trans('Grades_trans.Delete') }}"
                                                        class="fa fa-trash"></i>&nbsp;
                                                    {{ trans('grade_trans.Delete') }}</a>
                                                <a class="dropdown-item"
                                                    href="{{ route('Fees_Invoices.show', $student->id) }}"><i
                                                        style="color: #0000cc"
                                                        class="fa fa-edit"></i>&nbsp;{{ trans('fees.add_fees') }}
                                                    &nbsp;</a>
                                                <a class="dropdown-item"
                                                    href="{{ route('payments.show', $student->id) }}"><i
                                                        style="color: #0000cc"
                                                        class="fa fa-edit"></i>&nbsp;{{ trans('fees.fees_out') }}
                                                    &nbsp;</a>


                                            </div>
                                    </td>
                                </tr>
                                @include('pages.student.DeleteModal')
                            @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- row closed -->
@endsection
@section('js')

@endsection
