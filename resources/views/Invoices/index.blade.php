@extends('layouts.master')
@section('title')
    قائمه الفواتير
@stop
@section('css')

@stop
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">الفواتير</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ قائمه الفواتير</span>
						</div>
					</div>
				</div>
				<!-- breadcrumb -->
@stop
@section('content')

    @include('Messages.alert')
    <!-- row opened -->
    <div class="row row-sm">

        <!--div-->
        <div class="col-xl-12">
            <div class="card mg-b-20">
                <div class="card-header pb-0">
                    @can('اضافة فاتورة')
                        <a href="invoices/create" class="modal-effect btn btn-group-lg btn-primary" style="color:white">
                            <i class="fas fa-plus"></i>&nbsp; اضافة فاتورة</a>
                    @endcan
                    @can('تصدير EXCEL')
                        <a class="modal-effect btn btn-group-lg btn-success" href="{{ route('invoice.export') }}"
                           style="color:white"><i class="fas fa-file-download"></i>&nbsp;تصدير اكسيل</a>
                    @endcan

                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example1" class="table key-buttons text-md-nowrap" data-page-length='50'>
                            <thead>
                            <tr>
                                <th class="border-bottom-0">#</th>
                                <th class="border-bottom-0">رقم الفاتورة</th>
                                <th class="border-bottom-0">تاريخ القاتورة</th>
                                <th class="border-bottom-0">تاريخ الاستحقاق</th>
                                <th class="border-bottom-0">المنتج</th>
                                <th class="border-bottom-0">القسم</th>
                                <th class="border-bottom-0">الخصم</th>
                                <th class="border-bottom-0">نسبة الضريبة</th>
                                <th class="border-bottom-0">قيمة الضريبة</th>
                                <th class="border-bottom-0">الاجمالي</th>
                                <th class="border-bottom-0">الحالة</th>
                                <th class="border-bottom-0">ملاحظات</th>
                                <th class="border-bottom-0">العمليات</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $i = 0;?>
                            @foreach($invoices as $invoice)
                                <?php $i++;?>
                                <tr>

                                    <td>{{ $i }}</td>
                                    <td>{{ $invoice->invoice_number }} </td>
                                    <td>{{ $invoice->invoice_Date }}</td>
                                    <td>{{ $invoice->Due_date }}</td>
                                    <td>{{ $invoice->product }}</td>
                                    <td>
                                        <a href="{{ url('InvoicesDetails') }}/{{ $invoice->id }}">{{ $invoice->section->section_name }}</a>
                                    </td>
                                    <td>{{ $invoice->Discount }}</td>
                                    <td>{{ $invoice->Rate_VAT }}</td>
                                    <td>{{ $invoice->Value_VAT }}</td>
                                    <td>{{ $invoice->Total }}</td>
                                    <td>
                                        @if ($invoice->Value_Status == 1)
                                            <span class="text-success">{{ $invoice->Status }}</span>
                                        @elseif($invoice->Value_Status == 2)
                                            <span class="text-danger">{{ $invoice->Status }}</span>
                                        @else
                                            <span class="text-warning">{{ $invoice->Status }}</span>
                                        @endif
                                    </td>
                                    <td>{{ $invoice->note }}</td>
                                    <td>
                                        <div class="dropdown">
                                            <button aria-expanded="false" aria-haspopup="true"
                                                    class="btn ripple btn-primary btn-sm" data-toggle="dropdown"
                                                    type="button"> العمليات<i class="fas fa-caret-down ml-1"></i>
                                            </button>
                                            <div class="dropdown-menu tx-13">
                                                @can('تعديل الفاتورة')
                                                    <a class="dropdown-item"
                                                       href="{{route('invoices.edit',$invoice->id)}}">تعديل الفاتورة</a>
                                                @endcan
                                                @can('حذف الفاتورة')
                                                        <a class=" modal-effect dropdown-item"
                                                           href="#delete{{$invoice->id}}"
                                                           data-toggle="modal" data-effect="effect-scale">
                                                            <i class="text-danger fas fa-trash-alt"></i>&nbsp;&nbsp;حذف
                                                            الفاتورة</a>
                                                @endcan
                                                @can('تغير حالة الدفع')
                                                            <a class="dropdown-item"
                                                               href="{{route('Status_Show',$invoice->id)}}">
                                                                <i class=" text-success fas fa-money-bill"></i>&nbsp;&nbsp;تغير
                                                                حالة الدفع</a>
                                                @endcan
                                                @can('ارشفة الفاتورة')
                                                                <a class="modal-effect dropdown-item"
                                                                   href="#archive{{ $invoice->id}}"
                                                                   data-toggle="modal" data-effect="effect-scale">
                                                                    <i class="text-warning fas fa-exchange-alt"></i>&nbsp;&nbsp;نقل
                                                                    الي الارشيف</a>
                                                @endcan
                                                @can('طباعةالفاتورة')
                                                                    <a class=" dropdown-item"
                                                                       href="{{route('Invoice_Print',$invoice->id)}}"><i
                                                                            class="text-success fas fa-print"></i>&nbsp;&nbsp;طباعة
                                                                        الفاتورة
                                                                    </a>
                                                    @endcan
                                            </div>
                                        </div>

                                    </td>
                                </tr>
                                <!-- Delete Invoice -->
                                @include('Invoices.delete-Invoices')
                                <!-- Archive Invoice -->
                                @include('Invoices.Archive.modalArchive')
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!--/div-->
    </div>
    <!-- row closed -->
    </div>
    <!-- Container closed -->
    </div>
    <!-- main-content closed -->
@endsection
@section('js')

@endsection
