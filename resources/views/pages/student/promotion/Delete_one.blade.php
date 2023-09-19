
<!-- Modal -->
<div class="modal fade" id="delet_one{{ $promotion->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">{{ trans('My_Classes_trans.Delete') }}</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="{{ route('promotion.destroy','test') }}" method="post">
            @method('DELETE')
            @csrf

            <input type="hidden" value="2" name="page_id">
            <input type="hidden" value="{{ $promotion->id }}" name="promtion_id">
            <h3>{{ trans('My_Classes_trans.Warning_class') }}</h3>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ trans('My_Classes_trans.Close') }}</button>
                <button  class="btn btn-primary">{{ trans('Sections_trans.submit') }}</button>
              </div>
          </form>
        </div>

      </div>
    </div>
  </div>
