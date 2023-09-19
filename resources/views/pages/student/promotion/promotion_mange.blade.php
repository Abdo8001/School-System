@extends('layouts.master')
@section('css')

@section('title')
{{trans('main_trans.list_Promotions')}}
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
                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal">
                  {{ trans('main_trans.role_back') }}
                </button><br><br>
                <div class="table-responsive">
                    <table id="datatable" class="table  table-hover table-sm table-bordered p-0"
                           data-page-length="50"
                           style="text-align: center">
                        <thead>
                        <tr>
                            <th class="alert-danger">#</th>
                            <th class="alert-info">{{trans('Students_trans.name')}}</th>
                            <th class="alert-danger">{{trans('main_trans.previouse_year')}}</th>
                            <th class="alert-danger">{{trans('main_trans.current year')}}</th>
                            <th class="alert-danger">{{trans('main_trans.previouse_grade')}}</th>
                            <th class="alert-danger">{{trans('main_trans.previouse_section')}}</th>
                            <th class="alert-success">{{trans('main_trans.current_class')}}</th>
                            <th  class="alert-success">{{trans('main_trans.curent_acdmic_year')}}</th>
                            <th  class="alert-success">{{trans('main_trans.current_class')}}</th>
                            <th  class="alert-success">{{trans('main_trans.current_section')}}</th>
                            <th  class="alert-success">{{trans('Sections_trans.Processes')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($promotions as $promotion)
                            <tr>
                            <td>{{ $loop->index+1 }}</td>
                            <td>{{$promotion->student->name}}</td>
                            <td>{{$promotion->gradeFrom->name}}</td>
                            <td>{{$promotion->student->academic_year}}</td>
                            <td>{{$promotion->FromClassroom->calss_name}}</td>
                            <td>{{$promotion->FromSection->Name_Section}}</td>
                            <td>{{$promotion->gradeTo->name}}</td>
                            <td>{{$promotion->academic_year_new}}</td>
                            <td>{{$promotion->ToClassroom->calss_name}}</td>
                            <td>{{$promotion->ToSection->Name_Section}}</td>
                                <td>
                                    <button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#">{{ trans('main_trans.student_gradute') }}</button>
                                    <button type="button" class="btn btn-outline-danger" data-toggle="modal" data-target="#delet_one{{ $promotion->id }}" title="{{ trans('main_trans.student_back') }}">{{ trans('main_trans.student_back') }}</button>
                                </td>
                            </tr>
                        @include('pages.student.promotion.Delete_All')
                        @include('pages.student.promotion.Delete_one')
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
