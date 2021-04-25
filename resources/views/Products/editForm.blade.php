<!-- edit -->
<div class="modal fade" id="edit{{$product->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">تعديل القسم</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form action="{{ route('Products.update', 'test') }}" method="post" autocomplete="off">
                    {{ method_field('patch') }}
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="exampleInputEmail1">اسم المنتج</label>
                        <input type="hidden" name="productId"  value="{{$product->id }}">
                        <input type="text" value="{{$product->Product_name}}" class="form-control"  name="Product_name" required>
                    </div>

                    <label class="my-1 mr-2" for="inlineFormCustomSelectPref">القسم</label>
                    <select name="section_id"  class="mb-3 form-control" required>
                        @foreach ($sections as $section)
                        <option value="{{$section -> id }}"
                            @if($section -> id == $product -> section_id) selected @endif >
                       {{ $section->section_name }}</option>
                        @endforeach

                    </select>

                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">الوصف</label>
                        <textarea class="form-control"  name="description" rows="3">{{$product->description}}</textarea>
                    </div>


                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">تاكيد</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

