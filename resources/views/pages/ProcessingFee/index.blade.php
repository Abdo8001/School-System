@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    معالجات الرسوم الدراسية
@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
  معالجات الرسوم الدراسية
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
{{-- promotion msg --}}
 @if (session()->has('promotion'))
 <div class="alert alert-success alert-dismissible fade show" role="alert">
     <strong>{{ session()->get('promotion') }}</strong>
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
                                <div class="table-responsive">
                                    <table id="datatable" class="table  table-hover table-sm table-bordered p-0"
                                           data-page-length="50"
                                           style="text-align: center">
                                        <thead>
                                        <tr class="alert-success">
                                            <th>#</th>
                                            <th>{{ trans('fees.Name') }}</th>
                                            <th>{{ trans('fees.amount') }}</th>
                                            <th>{{ trans('fees.minfisto') }}</th>
                                            <th>{{ trans('grade_trans.Processes') }}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($fee_process as $ProcessingFee)
                                            <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{$ProcessingFee->student->name}}</td>
                                            <td>{{ number_format($ProcessingFee->amount, 2) }}</td>
                                            <td>{{$ProcessingFee->description}}</td>
                                                <td>
                                                    <a href="{{route('processing_fees.edit',$ProcessingFee->id)}}" class="btn btn-info btn-sm" role="button" aria-pressed="true"><i class="fa fa-edit"></i></a>
                                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#Delete_receipt{{$ProcessingFee->id}}" ><i class="fa fa-trash"></i></button>
                                                </td>
                                            </tr>
                                        @include('pages.ProcessingFee.Delete')
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
