<!-- Deleted inFormation Student -->
<div class="modal fade" id="graduate_student{{$promotion->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">تخرج الطالب</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('graduate.students', $promotion->student_id)}}" method="post">
                    @csrf
                    <input type="hidden" name="student_id" value="{{ $promotion->student_id }}">
                    <input type="hidden" name="promotion_id" value="{{ $promotion->id }}">
                    <h5 style="font-family: 'Cairo', sans-serif;">هل انت متاكد من عملية تخرج الطالب ؟ {{$promotion->student->name}}</h5>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{trans('site.close')}}</button>
                        <button  class="btn btn-danger">{{trans('site.submit')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>