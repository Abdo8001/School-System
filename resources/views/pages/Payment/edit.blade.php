@extends('layouts.master')
@section('css')
@section('title')
{{ trans('fees.fees_out') }}
@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
{{ trans('fees.fees_out') }}: <label style="color: red">{{$payment->student->name}}</label>
@stop
<!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                            <form action="{{route('payments.update','test')}}" method="post" autocomplete="off">
                                @method('PUT')
                                @csrf
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>{{ trans('fees.amount') }} : <span class="text-danger">*</span></label>
                                        <input  class="form-control" name="Debit" value="{{$payment->amount}}" type="number" >
                                        <input  type="hidden" name="student_id" value="{{$payment->student->id}}" class="form-control">
                                        <input  type="hidden" name="id"  value="{{$payment->id}}" class="form-control">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>{{ trans('fees.minfisto') }} : <span class="text-danger">*</span></label>
                                        <textarea class="form-control" name="description" id="exampleFormControlTextarea1" rows="3">{{$payment->description}}</textarea>
                                    </div>
                                </div>

                            </div>

                            <button class="btn btn-success btn-sm nextBtn btn-lg pull-right" type="submit">{{trans('Students_trans.submit')}}</button>
                        </form>

                </div>
            </div>
        </div>
    </div>
    <!-- row closed -->
@endsection
@section('js')


@endsection
