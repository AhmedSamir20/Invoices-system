<!-- ارشيف الفاتورة -->
<div class="modal fade" id="archive{{ $invoice->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">ارشفة الفاتورة</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <form action="{{ route('invoices.destroy', 'test') }}" method="post">
                {{ method_field('delete') }}
                {{ csrf_field() }}
            </div>
            <div class="modal-body">
                هل انت متاكد من عملية الارشفة ؟

                <input type="hidden" name="id"  value="{{$invoice->id }}">

                <input type="hidden" name="id_page" id="id_page" value="2">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">الغاء</button>
                <button type="submit" class="btn btn-success">تاكيد</button>
            </div>
            </form>
        </div>
    </div>
</div>
