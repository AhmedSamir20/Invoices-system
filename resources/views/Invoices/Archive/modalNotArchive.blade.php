<!--الغاء الارشفة-->
<div class="modal fade" id="NotArchive{{ $invoice->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">الغاء ارشفة الفاتورة</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <form action="{{ route('Archive.update', 'test') }}" method="post">
                {{ method_field('post') }}
                {{ csrf_field() }}
            </div>
            <div class="modal-body">
                هل انت متاكد من عملية الغاء الارشفة ؟
                <input type="hidden" name="id"  value="{{$invoice->id }}">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">الغاء</button>
                <button type="submit" class="btn btn-success">تاكيد</button>
            </div>
            </form>
        </div>
    </div>
</div>
