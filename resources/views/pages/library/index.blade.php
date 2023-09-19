@extends('layouts.master')
@section('css')

@section('title')
{{ trans('attendance.librarys') }}
@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
{{ trans('attendance.librarys') }}

@stop
<!-- breadcrumb -->
@endsection
@section('content')
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
    <!-- row -->
    <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <div class="col-xl-12 mb-30">
                        <div class="card card-statistics h-100">
                            <div class="card-body">
                                <a href="{{route('library.create')}}" class="btn btn-success btn-sm" role="button"
                                   aria-pressed="true">  {{ trans('attendance.lib_add') }}</a><br><br>
                                <div class="table-responsive">
                                    <table id="datatable" class="table  table-hover table-sm table-bordered p-0"
                                           data-page-length="50"
                                           style="text-align: center">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>{{ trans('attendance.lib_name') }}</th>
                                            <th>{{ trans('Teacher_trans.Name_Teacher') }} </th>
                                            <th> {{ trans('grade_trans.Name') }}</th>
                                            <th> {{ trans('Sections_trans.Name_Class') }}</th>
                                            <th>{{ trans('Sections_trans.Name_Section') }}</th>
                                            <th>{{ trans('grade_trans.Processes') }}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($libraries as $book)
                                            <tr>
                                                <td>{{ $loop->iteration}}</td>
                                                <td>{{$book->title}}</td>
                                                <td>{{$book->teachers->Name}}</td>
                                                <td>{{$book->grade->name}}</td>
                                                <td>{{$book->classroom->calss_name}}</td>
                                                <td>{{$book->section->Name_Section}}</td>
                                                <td>
                                                    <a href="{{ route('download_file',$book->file_name) }}" title="تحميل الكتاب" class="btn btn-warning btn-sm" role="button" aria-pressed="true"><i class="fas fa-download"></i></a>
                                                    <a href="{{route('library.edit',$book->id)}}" class="btn btn-info btn-sm" role="button" aria-pressed="true"><i class="fa fa-edit"></i></a>
                                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete_book{{ $book->id }}" title="حذف"><i class="fa fa-trash"></i></button>
                                                </td>
                                            </tr>

                                        @include('pages.library.destroy')
                                        @endforeach
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- row closed -->
@endsection
@section('js')

@endsection
