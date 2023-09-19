@extends('layouts.master')
@section('css')
@section('title')
    {{ trans('My_Classes_trans.title_page') }}
@stop
@endsection
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

    <div class="row">
        <div class="col-sm-6">

        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#" class="default-color">home</a></li>
                <li class="breadcrumb-item active">{{ trans('My_Classes_trans.List_classes') }}</li>
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
                {{ trans('My_Classes_trans.add_class') }}
            </button>

{{-- cheak all delete --}}
            <button type="button" class="button x-small" id="btn_delete_all">
                {{ trans('My_Classes_trans.delete_checkbox') }}
            </button>
            <br><br>
               <form action="{{ route('Filter_Classes') }}" method="post">
                @csrf
                <select class="selectpicker btn btn-primary p-3" name="grade_id" data-style="btn-info"  required onchange="this.form.submit()" id="">
                 <option value="" selected disabled>{{ trans('My_Classes_trans.Search_By_Grade') }}</option>
                  @foreach ($grades as $grade )
                      <option value="{{ $grade->id }}">{{ $grade->name }}</option>
                  @endforeach
                </select>
               </form>

                <div class="table-responsive">
                    <table id="datatable" class="table table-striped table-bordered p-0">
                      <thead>
                          <tr>
                            <th><input name="select_all" id="example-select-all" type="checkbox" onclick="CheckAll('box1', this)" /></th>
                              <th>#</th>
                              <th>{{ trans('My_Classes_trans.Name_class') }}</th>
                              <th>{{ trans('My_Classes_trans.Name_Grade') }}</th>

                              <th>{{ trans('My_Classes_trans.Processes') }}</th>

                          </tr>
                      </thead>
                      <tbody>
                        @if(isset($details))
                            <?php $classes=$details ?>
                            @else
                            <?php $classes=$classes?>


                        @endif
                      @foreach ( $classes as $class )
                      <tr>
                        <td><input type="checkbox"  value="{{ $class->id }}" class="box1" ></td>
                          <td>{{ $loop->index+1 }}</td>
                          <td>{{ $class->calss_name }}</td>
                          <td>{{ $class->grades->name }}</td>
                          <td>       <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                              data-target="#edit{{ $class->id }}"
                              title="{{ trans('grade_trans.Edit') }}"><i class="fa fa-edit"></i></button>
                          <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                              data-target="#delete{{ $class->id }}"
                              title="{{ trans('grade_trans.Delete') }}"><i
                                  class="fa fa-trash"></i></button></td>

                      </tr>
                      {{-- delete model --}}
      <div class="modal fade" id="delete{{ $class->id }}" tabindex="-1" role="dialog"
          aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
              <div class="modal-content">
                  <div class="modal-header">
                      <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                          id="exampleModalLabel">
                          {{ trans('My_Classes_trans.Delete') }}
                      </h5>
                      <button type="button" class="close" data-dismiss="modal"
                          aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                  </div>
                  <div class="modal-body">
                      <form action="{{ route('Classrooms.destroy', $class->id) }}" method="post">
                          {{ method_field('Delete') }}
                          @csrf
                          {{ trans('My_Classes_trans.Warning_Grade') }}
                          <input id="id" type="hidden" name="id" class="form-control"
                              value="{{ $class->id }}">
                          <div class="modal-footer">
                              <button type="button" class="btn btn-secondary"
                                  data-dismiss="modal">{{ trans('My_Classes_trans.Close') }}</button>
                              <button type="submit"
                                  class="btn btn-danger">{{ trans('My_Classes_trans.delete_class') }}</button>
                          </div>
                      </form>
                  </div>
              </div>
          </div>
      </div>
      {{-- edit grade --}}
          <div class="modal fade" id="edit{{ $class->id }}" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
           <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                        id="exampleModalLabel">
                        {{ trans('My_Classes_trans.edit_class') }}
                    </h5>
                    <button type="button" class="close" data-dismiss="modal"
                            aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- edit_form -->
                    <form action="{{ route('Classrooms.update', 'test') }}" method="post">
                        {{ method_field('patch') }}
                        @csrf
                        <div class="">
                            <div class="col ">
                                <label for="Name"
                                        class="mr-sm-2">{{ trans('My_Classes_trans.Name_class') }}
                                    :</label>
                                    <input type="hidden" name="class_id" value="{{ $class->id }}">

                                <input class="form-control m-9" type="text" value="{{ $class->getTranslation('calss_name','ar')}}" name="Name" />
                            </div>
                            <div class="col ">
                                <label for="Name_en"
                                        class="mr-sm-2">{{ trans('My_Classes_trans.Name_class_en') }}
                                    :</label>
                                    <input class="form-control " required type="text" value="{{ $class->getTranslation('calss_name','en')}}" name="Name_class_en" />

                        </div>
                        <br>
                        <div class="form-group ">
                            <label
                                for="exampleFormControlTextarea1">{{ trans('My_Classes_trans.Name_Grade') }}
                                :</label>
                            <select class="form-control form-control-lg"
                                    id="exampleFormControlSelect1" name="Grade_id">
                                <option value="{{ $class->Grades->id }}">
                                    {{ $class->Grades->name }}
                                </option>
                                @foreach ($grades as $grade)
                                    <option value="{{ $grade->id }}">
                                        {{ $grade->name }}
                                    </option>
                                @endforeach
                            </select>

                        </div>
                            <br><br>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary"
                                    data-dismiss="modal">{{ trans('grade_trans.Close') }}</button>
                            <button type="submit"
                                    class="btn btn-success">{{ trans('grade_trans.submit') }}</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>

          </div>
                  <!-- add_form -->

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
    <!-- add_modal_class -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
aria-hidden="true">
<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                {{ trans('My_Classes_trans.add_class') }}
            </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">

            <form class=" row mb-30" action="{{ route('Classrooms.store') }}" method="POST">
                @csrf
                <div class="card-body">
                    <div class="repeater">
                        <div data-repeater-list="List_Classes">
                            <div data-repeater-item>
                                <div class="row">

                                    <div class="col">
                                        <label for="Name"
                                            class="mr-sm-2">{{ trans('My_Classes_trans.Name_class') }}
                                            :</label>
                                        <input class="form-control" type="text" name="Name" />
                                    </div>


                                    <div class="col">
                                        <label for="Name"
                                            class="mr-sm-2">{{ trans('My_Classes_trans.Name_class_en') }}
                                            :</label>
                                        <input class="form-control" type="text" name="Name_class_en" />
                                    </div>


                                    <div class="col">
                                        <label for="Name_en"
                                            class="mr-sm-2">{{ trans('My_Classes_trans.Name_Grade') }}
                                            :</label>

                                        <div class="box">
                                            <select class="fancyselect" name="grade_id">
                                              @foreach ($grades as $grade )
                                                  <option value="{{ $grade->id }}">{{ $grade->name }}</option>
                                              @endforeach
                                            </select>
                                        </div>

                                    </div>

                                    <div class="col">
                                        <label for="Name_en"
                                            class="mr-sm-2">{{ trans('My_Classes_trans.Processes') }}
                                            :</label>
                                        <input class="btn btn-danger btn-block" data-repeater-delete
                                            type="button" value="{{ trans('My_Classes_trans.delete_row') }}" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-20">
                            <div class="col-12">
                                <input class="button" data-repeater-create type="button" value="{{ trans('My_Classes_trans.add_row') }}"/>
                            </div>

                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary"
                                data-dismiss="modal">{{ trans('grade_trans.Close') }}</button>
                            <button type="submit"
                                class="btn btn-success">{{ trans('grade_trans.submit') }}</button>
                        </div>


                    </div>
                </div>
            </form>
        </div>


    </div>

</div>
</div>
</div>
<!-- حذف مجموعة صفوف -->

<div class="modal fade" id="delete_all" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
aria-hidden="true">
<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                {{ trans('My_Classes_trans.delete_class') }}
            </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form action="{{ route('delete_all') }}" method="POST">
            {{ csrf_field() }}
            <div class="modal-body">
                {{ trans('My_Classes_trans.Warning_Grade') }}
                <input class="text" type="hidden" id="delete_all_id" name="delete_all_id" value=''>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary"
                        data-dismiss="modal">{{ trans('My_Classes_trans.Close') }}</button>
                <button type="submit" class="btn btn-danger">{{ trans('My_Classes_trans.submit') }}</button>
            </div>
        </form>
    </div>
</div>
</div>
</div>
<!-- row closed -->
@endsection
@section('js')
<script type="text/javascript">
    $(function() {
        $("#btn_delete_all").click(function() {
            var selected = new Array();
            $("#datatable input[type=checkbox]:checked").each(function() {
                selected.push(this.value);
            });

            if (selected.length > 0) {
                $('#delete_all').modal('show')
                $('input[id="delete_all_id"]').val(selected);
            }
        });
    });

</script>

@endsection
