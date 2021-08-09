<!-- Deleted inFormation Student -->
<div class="modal fade" id="delete_student{{$graduate->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">{{trans('site.deleted_student')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('graduates.destroy', $graduate->id)}}" method="post">
                    @csrf
                    @method('DELETE')

                    <input type="hidden" name="id" value="{{ $graduate->id }}">

                    <h5 style="font-family: 'Cairo', sans-serif;">{{trans('site.deleted_student_title')}}</h5>
                    <input type="text" readonly value="{{ $graduate->name }}" class="form-control">

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{trans('site.close')}}</button>
                        <button  class="btn btn-danger">{{trans('site.submit')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>