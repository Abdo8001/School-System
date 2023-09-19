@extends('layouts.master')
@section('css')
{{-- @toastr_css --}}
@endsection
@section('title')
    {{ trans('main_trans.Grades') }}
@stop

@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    {{-- add msg --}}
    @if (session()->has('add'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>{{ session()->get('add') }}</strong>
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
{{-- edit msg --}}
    @if (session()->has('edit'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>{{ session()->get('edit') }}</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
{{-- warn msg --}}
    @if (session()->has('warn'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>{{ session()->get('warn') }}</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
    <div class="row">

        <div class="col-sm-6">
            <h4 class="mb-0"> {{ trans('grade_trans.List_Grade') }}</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#" class="default-color">Home</a></li>
                <li class="breadcrumb-item active">{{ trans('main_trans.Grades') }}</li>
            </ol>
        </div>
    </div>
</div>
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


            <button type="button" class="button x-small" data-toggle="modal" data-target="#exampleModal">
                {{ trans('grade_trans.add_Grade') }}
            </button>
            <br><br>
              <div class="table-responsive">
              <table id="datatable" class="table table-striped table-bordered p-0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>{{ trans('grade_trans.grade_name') }}</th>
                        <th>{{ trans('grade_trans.Notes') }}</th>

                        <th>{{ trans('grade_trans.Processes') }}</th>
                        <
                    </tr>
                </thead>
                <tbody>
                @foreach ( $grades as $grade )
                <tr>
                    <td>{{ $loop->index+1 }}</td>
                    <td>{{ $grade->name }}</td>
                    <td>{{ $grade->notes }}</td>
                    <td>       <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                        data-target="#edit{{ $grade->id }}"
                        title="{{ trans('grade_trans.Edit') }}"><i class="fa fa-edit"></i></button>
                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                        data-target="#delete{{ $grade->id }}"
                        title="{{ trans('grade_trans.Delete') }}"><i
                            class="fa fa-trash"></i></button></td>

                </tr>
                {{-- delete model --}}
<div class="modal fade" id="delete{{ $grade->id }}" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                    id="exampleModalLabel">
                    {{ trans('grade_trans.delete_Grade') }}
                </h5>
                <button type="button" class="close" data-dismiss="modal"
                    aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('grades.destroy', $grade->id) }}" method="post">
                    {{ method_field('Delete') }}
                    @csrf
                    {{ trans('grade_trans.Warning_Grade') }}
                    <input id="id" type="hidden" name="id" class="form-control"
                        value="{{ $grade->id }}">
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                            data-dismiss="modal">{{ trans('grade_trans.Close') }}</button>
                        <button type="submit"
                            class="btn btn-danger">{{ trans('grade_trans.delete_Grade') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
{{-- edit grade --}}
<div class="modal fade" id="edit{{ $grade->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
aria-hidden="true">
<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                {{ trans('grade_trans.add_Grade') }}
            </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <!-- add_form -->
            <form action="{{ route('grades.update','test') }}" method="POST">
                @csrf
                @method('patch')
                <div class="row">
                    <div class="col">
                        <input  type="hidden" name="id" value="{{ $grade->id }}" class="form-control">

                        <label for="Name" class="mr-sm-2">{{ trans('grade_trans.stage_name_ar') }}
                            :</label>
                        <input id="Name" type="text" name="name" value="{{ $grade->getTranslation('name','ar') }}" class="form-control">
                    </div>
                    <div class="col">
                        <label for="Name_en" class="mr-sm-2">{{ trans('grade_trans.stage_name_en') }}
                            :</label>
                        <input type="text" class="form-control" value="{{ $grade->getTranslation('name','en') }}" name="name_en">
                    </div>
                </div>
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">{{ trans('grade_trans.Notes') }}
                        :</label>
                    <textarea class="form-control" name="notes" value="" id="exampleFormControlTextarea1"
                        rows="3">{{ $grade->notes }}</textarea>
                </div>
                <br><br>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary"
                data-dismiss="modal">{{ trans('grade_trans.Close') }}</button>
            <button type="submit" class="btn btn-success">{{ trans('grade_trans.submit') }}</button>
        </div>
        </form>

    </div>
</div>
                @endforeach


                </tbody>
                <tfoot>
                    <tr>
                        <th>Name</th>
                        <th>Position</th>
                        <th>Office</th>
                        <th>Age</th>

                    </tr>
                </tfoot>

             </table>
            </div>
            </div>
          </div>

        </div>

<!-- add_modal_Grade -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
aria-hidden="true">
<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                {{ trans('grade_trans.add_Grade') }}
            </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <!-- add_form -->
            <form action="{{ route('grades.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col">
                        <label for="Name" class="mr-sm-2">{{ trans('grade_trans.stage_name_ar') }}
                            :</label>
                        <input id="Name" type="text" name="name" class="form-control">
                    </div>
                    <div class="col">
                        <label for="Name_en" class="mr-sm-2">{{ trans('grade_trans.stage_name_en') }}
                            :</label>
                        <input type="text" class="form-control" name="name_en">
                    </div>
                </div>
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">{{ trans('grade_trans.Notes') }}
                        :</label>
                    <textarea class="form-control" name="notes" id="exampleFormControlTextarea1"
                        rows="3"></textarea>
                </div>
                <br><br>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary"
                data-dismiss="modal">{{ trans('grade_trans.Close') }}</button>
            <button type="submit" class="btn btn-success">{{ trans('grade_trans.submit') }}</button>
        </div>
        </form>

    </div>
</div>


</div>




</div>
<!-- row closed -->
@endsection
@section('js')
@toastr_js
@toastr_render
@endsection
