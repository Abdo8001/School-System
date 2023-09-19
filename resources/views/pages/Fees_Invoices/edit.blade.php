@extends('layouts.master')
@section('css')

@section('title')
{{ trans('fees.fees_invioce.edit') }}
@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
{{ trans('fees.fees_invioce.edit') }}
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

                    <form action="{{route('Fees_Invoices.update','test')}}" method="post" autocomplete="off">
                        @method('PUT')
                        @csrf
                        <div class="form-row">
                            <div class="form-group col">
                                <label for="inputEmail4">{{ trans('Students_trans.name_ar') }}</label>
                                <input type="text" value="{{$Fee_invoice->student->name}}" readonly name="title_ar" class="form-control">
                                <input type="hidden" value="{{$Fee_invoice->id}}" name="id" class="form-control">
                            </div>


                            <div class="form-group col">
                                <label for="inputEmail4">{{ trans('fees.amount') }}</label>
                                <input type="number" value="{{$Fee_invoice->amount}}" name="amount" class="form-control">
                            </div>

                        </div>


                        <div class="form-row">

                            <div class="form-group col">
                                <label for="inputZip">{{ trans('fees.fees_kind') }}</label>
                                <select class="custom-select mr-sm-2" name="fee_id">
                                    @foreach($fees as $fee)
                                        <option value="{{$fee->id}}" {{$fee->id == $Fee_invoice->fee_id ? 'selected':"" }}>{{$fee->title}}</option>
                                    @endforeach
                                </select>
                            </div>

                        </div>

                        <div class="form-group">
                            <label for="inputAddress">{{ trans('grade_trans.Notes') }}</label>
                            <textarea class="form-control" name="description" id="exampleFormControlTextarea1" rows="4">{{$Fee_invoice->description}}</textarea>
                        </div>
                        <br>

                        <button type="submit" class="btn btn-primary">{{ trans('grade_trans.submit') }}</button>

                    </form>

                </div>
            </div>
        </div>
    </div>
    <!-- row closed -->
@endsection
@section('js')

@endsection
