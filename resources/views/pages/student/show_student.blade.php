@extends('layouts.master')
@section('css')

@section('title')
    {{trans('Students_trans.Student_details')}}
@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
    {{trans('Students_trans.Student_details')}}
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
                    <div class="card-body">
                        <div class="tab nav-border">
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active show" id="home-02-tab" data-toggle="tab" href="#home-02"
                                       role="tab" aria-controls="home-02"
                                       aria-selected="true">{{trans('Students_trans.Student_details')}}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="profile-02-tab" data-toggle="tab" href="#profile-02"
                                       role="tab" aria-controls="profile-02"
                                       aria-selected="false">{{trans('Students_trans.Attachments')}}</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane fade active show" id="home-02" role="tabpanel"
                                     aria-labelledby="home-02-tab">
                                    <table class="table table-striped table-hover" style="text-align:center">
                                        <tbody>
                                        <tr>
                                            <th scope="row">{{trans('Students_trans.name')}}</th>
                                            <td>{{ $Student->name }}</td>
                                            <th scope="row">{{trans('Students_trans.email')}}</th>
                                            <td>{{$Student->email}}</td>
                                            <th scope="row">{{trans('Students_trans.gender')}}</th>
                                            <td>{{$Student->gender->Name}}</td>
                                            <th scope="row">{{trans('Students_trans.Nationality')}}</th>
                                            <td>{{$Student->Nationality->national_name}}</td>
                                        </tr>

                                        <tr>
                                            <th scope="row">{{trans('Students_trans.Grade')}}</th>
                                            <td>{{ $Student->grade->name }}</td>
                                            <th scope="row">{{trans('Students_trans.classrooms')}}</th>
                                            <td>{{$Student->classroom->calss_name}}</td>
                                            <th scope="row">{{trans('Students_trans.section')}}</th>
                                            <td>{{$Student->section->Name_Section}}</td>
                                            <th scope="row">{{trans('Students_trans.Date_of_Birth')}}</th>
                                            <td>{{ $Student->Date_Birth}}</td>
                                        </tr>

                                        <tr>
                                            <th scope="row">{{trans('Students_trans.parent')}}</th>
                                            <td>{{ $Student->myparent->Name_Father}}</td>
                                            <th scope="row">{{trans('Students_trans.academic_year')}}</th>
                                            <td>{{ $Student->academic_year }}</td>
                                            <th scope="row"></th>
                                            <td></td>
                                            <th scope="row"></th>
                                            <td></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <div class="tab-pane fade" id="profile-02" role="tabpanel"
                                     aria-labelledby="profile-02-tab">
                                    <div class="card card-statistics">
                                        <div class="card-body">
                                            <form method="post" action="{{ route('uploadAttachments') }}" enctype="multipart/form-data">
                                                {{ csrf_field() }}
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label
                                                            for="academic_year">{{trans('Students_trans.Attachments')}}
                                                            : <span class="text-danger">*</span></label>
                                                        <input type="file" accept="image/*" name="photos[]" multiple required>
                                                        <input type="hidden" name="student_name" value="{{$Student->name}}">
                                                        <input type="hidden" name="student_id" value="{{$Student->id}}">
                                                    </div>
                                                </div>
                                                <br><br>
                                                <button type="submit" class="button button-border x-small">
                                                       {{trans('Students_trans.submit')}}
                                                </button>
                                            </form>
                                        </div>
                                        <br>
                                        <table class="table center-aligned-table mb-0 table table-hover"
                                               style="text-align:center">
                                            <thead>
                                            <tr class="table-secondary">
                                                <th scope="col">#</th>
                                                <th scope="col">{{trans('Students_trans.filename')}}</th>
                                                <th scope="col">{{trans('Students_trans.created_at')}}</th>
                                                <th scope="col">{{trans('Students_trans.Processes')}}</th>
                                                <th scope="col">{{trans('Students_trans.Processes')}}</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($Student->images as $attachment)
                                                <tr style='text-align:center;vertical-align:middle'>
                                                    <td>{{$loop->iteration}}</td>
                                                    <td>{{$attachment->filename}}</td>
                                                    <td>{{$attachment->created_at->diffForHumans()}}</td>
                                                    <td><img src="{{ asset('attachments/students/'.$Student->id.'/'.$attachment->filename) }}" style=" border: 1px solid #ddd;
                                                        border-radius: 4px;
                                                        padding: 5px; width: 150px;" class="img-rounded img-thumbnail" alt=""></td>
                                                    <td colspan="2">
                                                        <a class="btn btn-outline-info btn-sm"
                                                           href="{{url('download_photo')}}/{{ $attachment->imageable_id }}/{{$attachment->filename}}"
                                                           role="button"><i class="fas fa-download"></i>&nbsp; {{trans('Students_trans.Download')}}</a>

                                                        <button type="button" class="btn btn-outline-danger btn-sm"
                                                                data-toggle="modal"
                                                                data-target="#Delete_img{{$attachment->id}}"
                                                                title="{{ trans('grade_trans.Delete') }}">{{trans('Students_trans.delete')}}
                                                        </button>

                                                    </td>
                                                </tr>
                                                @include('pages.student.deleteImage')
                                            @endforeach
                                            </tbody>
                                        </table>
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
