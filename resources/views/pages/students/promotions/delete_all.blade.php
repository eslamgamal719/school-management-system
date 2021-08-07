<!-- Deleted inFormation Student -->
<div class="modal fade" id="delete_all" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">تراجع الكل</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('promotions.destroy', 'test')}}" method="post">
                    @csrf
                    @method('DELETE')

                    <!-- there is no need to send id because it's return to all not to one element -->
                    <input type="hidden" name="page_id" value="1">
                    <h5 style="font-family: 'Cairo', sans-serif;">هل انت متاكد من عملية تراجع كافة الطلاب ؟</h5>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{trans('site.close')}}</button>
                        <button  class="btn btn-danger">{{trans('site.delete')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>