    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <button aria-label="Close" class="close" data-dismiss="alert" type="button">
                <span aria-hidden="true">&times;</span>
            </button>
            <strong>خطا</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    @if (session()->has('add'))
        <script>
            window.onload = function() {
                notif({
                    msg: "تم اضافة الفاتورة بنجاح",
                    type: "success"
                });
            }

        </script>
    @endif

    @if (session()->has('restore_invoice'))
        <script>
            window.onload = function() {
                notif({
                    msg: "تم استعادة الفاتورة بنجاح",
                    type: "success"
                })
            }

        </script>
    @endif


    @if (session()->has('delete_invoice'))
        <script>
            window.onload = function() {
                notif({
                    msg: "تم حذف الفاتورة بنجاح",
                    type: "success"
                })
            }

        </script>
    @endif


    @if (session()->has('Status_Update'))
        <script>
            window.onload = function() {
                notif({
                    msg: "تم تحديث حالة الدفع بنجاح",
                    type: "success"
                })
            }

        </script>
    @endif

    @if (session()->has('restore_invoice'))
        <script>
            window.onload = function() {
                notif({
                    msg: "تم استعادة الفاتورة بنجاح",
                    type: "success"
                })
            }

        </script>
    @endif

    @if (session()->has('archive_invoice'))
        <script>
            window.onload = function() {
                notif({
                    msg: "تم ارشفه الفتوره بنجاح",
                    type: "success"
                })
            }

        </script>
    @endif
    @if (session()->has('add_attachment'))
        <script>
            window.onload = function() {
                notif({
                    msg: "تم اضافة المرفق بنجاح",
                    type: "success"
                })
            }

        </script>
    @endif


    @if (session()->has('edit'))
        <script>
            window.onload = function() {
                notif({
                    msg: "تم تعديل الفاتورة بنجاح",
                    type: "success"
                });
            }
        </script>
    @endif

    @if (session()->has('delete'))
        <script>
            window.onload = function() {
                notif({
                    msg: "تم الحذف بنجاح",
                    type: "success"
                });
            }

        </script>
    @endif
