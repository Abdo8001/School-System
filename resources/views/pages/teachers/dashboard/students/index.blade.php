@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
{{ trans('attendance.attendance') }}
@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
{{ trans('attendance.attendance') }}
@stop
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

    @if (session('status'))
        <div class="alert alert-danger">
            <ul>
                <li>{{ session('status') }}</li>
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
    <h5 style="font-family: 'Cairo', sans-serif;color: red">  {{ trans('attendance.dateToday') }} : {{ date('Y-m-d') }}</h5>
    <form method="post" action="{{ route('attendaning') }}" autocomplete="off">

        @csrf
        <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
               style="text-align: center">
            <thead>
            <tr>
                <th class="alert-success">#</th>
                <th class="alert-success">{{ trans('Students_trans.name') }}</th>
                <th class="alert-success">{{ trans('Students_trans.email') }}</th>
                <th class="alert-success">{{ trans('Students_trans.gender') }}</th>
                <th class="alert-success">{{ trans('Students_trans.Grade') }}</th>
                <th class="alert-success">{{ trans('Students_trans.classrooms') }}</th>
                <th class="alert-success">{{ trans('Students_trans.section') }}</th>
                <th class="alert-success"> {{ trans('attendance.attendance') }}</th>
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

                        <label class="block text-gray-500 font-semibold sm:border-r sm:pr-4">
                            <input name="attendences[{{ $student->id }}]"
                              @foreach ( $student->attendance()->where('attendence_date',date('Y-m-d'))->get() as $present)
                                  {{ $present->attendence_status==1 ?'checked':'' }}
                              @endforeach
                            class="leading-tight" type="radio" value="present">
                            <span class="text-success">{{trans('attendance.attendeing')}}</span>
                        </label>

                        <label class="ml-4 block text-gray-500 font-semibold">
                            <input name="attendences[{{ $student->id }}]"
                            @foreach ($student->attendance()->where('attendence_date',date('Y-m-d'))->get() as $attending )
                               {{ $attending->attendence_status==0 ?'checked':''}}
                            @endforeach
                                   class="leading-tight" type="radio" value="absent">
                            <span class="text-danger">{{ trans('attendance.abcent') }}</span>
                        </label>
                        <input type="hidden" name="student_id[]" value="{{ $student->id }}">
                        <input type="hidden" name="grade_id" value="{{ $student->Grade_id }}">
                        <input type="hidden" name="classroom_id" value="{{ $student->Classroom_id }}">
                        <input type="hidden" name="section_id" value="{{ $student->section_id }}">

                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <P>
            <button class="btn btn-success" type="submit">{{ trans('Students_trans.submit') }}</button>
        </P>
    </form><br>
    <!-- row closed -->
@endsection
@section('js')
    @toastr_js
    @toastr_render
@endsection
