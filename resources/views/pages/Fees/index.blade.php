@extends('layouts.master')
@section('css')


@section('title')
{{ trans('fees.fees') }}
@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
{{ trans('fees.fees') }}

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
                                <a href="{{route('fees.create')}}" class="btn btn-success btn-sm" role="button"
                                   aria-pressed="true">{{ trans('fees.add_fees') }}</a><br><br>
                                <div class="table-responsive">
                                    <table id="datatable" class="table  table-hover table-sm table-bordered p-0"
                                           data-page-length="50"
                                           style="text-align: center">
                                        <thead>
                                        <tr class="alert-success">
                                            <th>#</th>
                                            <th>{{ trans('fees.Name') }}</th>
                                            <th>{{ trans('fees.amount') }}</th>
                                            <th>{{ trans('grade_trans.grade_name') }}</th>
                                            <th> {{ trans('Sections_trans.Name_Class') }}</th>
                                            <th> {{ trans('Students_trans.academic_year') }}</th>
                                            <th>{{ trans('grade_trans.Notes') }}</th>
                                            <th>{{ trans('grade_trans.Processes') }}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($fees as $fee)
                                            <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{$fee->title}}</td>
                                            <td>{{ number_format($fee->amount, 2) }}</td>
                                            <td>{{$fee->grades->name}}</td>
                                            <td>{{$fee->Classrooms->calss_name}}</td>
                                            <td>{{$fee->year}}</td>
                                            <td>{{$fee->description}}</td>
                                                <td>
                                                    <a href="{{route('fees.edit',$fee->id)}}" class="btn btn-info btn-sm" role="button" aria-pressed="true"><i class="fa fa-edit"></i></a>
                                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#Delete_Fee{{ $fee->id }}" title="{{ trans('Grades_trans.Delete') }}"><i class="fa fa-trash"></i></button>
                                                    <a href="#" class="btn btn-warning btn-sm" role="button" aria-pressed="true"><i class="far fa-eye"></i></a>

                                                </td>
                                            </tr>
                                        @include('pages.Fees.Delete')
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
