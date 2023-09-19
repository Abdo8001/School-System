
@extends('layouts.master')
@section('css')
    @toastr_css
    @section('title')
        قائمة الاختبارات
    @stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
    @section('PageTitle')
        قائمة الاختبارات
    @stop
    <!-- breadcrumb -->
@endsection
@section('content')
{{-- massages --}}
{{-- cheats msg --}}
@if (session()->has('cheats'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>{{ session()->get('cheats') }}</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
{{-- done msg --}}
@if (session()->has('done'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>{{ session()->get('done') }}</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
{{-- delete msg --}}

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
                                        <tr>
                                            <th>#</th>
                                            <th> {{ trans('main_trans.subjects') }}</th>
                                            <th>{{ trans('main_trans.Subjects_name') }} </th>
                                            <th>دخول / درجة الاختبار</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($quizzes as $quizze)
                                            <tr>
                                                <td>{{ $loop->iteration}}</td>
                                                <td>{{$quizze->subject->name}}</td>
                                                <td>{{$quizze->name}}</td>
                                                {{-- <td><a href="{{route('student_exam.show',$quizze->id)}}"
                                                    class="btn btn-outline-success btn-sm" role="button"
                                                    aria-pressed="true" >
                                                     <i class="fas fa-person-booth"></i></a></td> --}}
                                                <td>

                                                    @if($quizze->degrees->count()>0&&$quizze->id==$quizze->degrees[0]->quizze_id)
                                                        {{$quizze->degrees[0]->score}}
                                                    @else

                                                        <a href="{{route('student_exam.show',$quizze->id)}}"
                                                           class="btn btn-outline-success btn-sm" role="button"
                                                           aria-pressed="true" onclick="alertAbuse()">
                                                            <i class="fas fa-person-booth"></i></a>
                                                    @endif
                                                </td>
                                            </tr>
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


        <script>
            function alertAbuse() {
                alert("{{ trans('attendance.alert_enter') }}");
            }
        </script>

@endsection
