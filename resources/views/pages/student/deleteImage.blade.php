<!-- Modal -->
<div class="modal fade" id="Delete_img{{$attachment->id  }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="Delete_img">{{ trans('Students_trans.delete') }}</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
           <form action="{{ route('DeleteAttachment','test') }}" method="post">
            @csrf
            @method('DELETE')
            <input type="hidden" name="student_id" value="{{ $attachment->imageable_id }}">
            <input type="hidden" name="img_name" value="{{  $attachment->filename }}">
            <h5 style="font-family: 'Cairo', sans-serif;">{{trans('Students_trans.Deleted_Student_tilte')}}</h5>
            <input type="hidden"  name="img_id" value="{{$attachment->id }}" class="form-control">

            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">{{trans('Students_trans.Close')}}</button>
            <button class="btn btn-primary">{{trans('Students_trans.submit')}}</button>
            </div>


        </form>

          </div>
    </div>
  </div>
