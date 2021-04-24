@extends('layouts.master')
@section('title')
    ألاقسام
@stop
@section('css')
@stop
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto"> الاعدادت</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ الاقسام</span>
            </div>
        </div>

    </div>
    <!-- breadcrumb -->
@endsection
@section('content')

    @include('Messages.alert')
    <div class="row row-sm">

        <!--div-->
        <div class="col-xl-12">
            <div class="card mg-b-20">
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between">
                        <a style="width: 200px" class="  modal-effect btn ripple btn-primary btn-block"
                           data-effect="effect-scale"
                           data-toggle="modal" href="#modaldemo8">اضافة قسم</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example1" class="table key-buttons text-md-nowrap">
                            <thead>
                            <tr>
                                <th class="border-bottom-0">#</th>
                                <th class="border-bottom-0">اسم القسم</th>
                                <th class="border-bottom-0">الوصف</th>
                                <th class="border-bottom-0">العمليات</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $i = 0; ?>
                            @foreach($sections as $section)
                                <?php $i++;?>
                                <tr>
                                    <td>{{$i}}</td>
                                    <td>{{$section->section_name}}</td>
                                    <td>{{$section->description }}</td>
                                    <td>
                                        <a class="modal-effect btn btn-sm btn-info" data-effect="effect-scale"
                                           title="تعديل" data-toggle="modal" href="#edit{{$section->id}}"><i
                                                class="las la-pen"></i></a>
                                        <a class="modal-effect btn btn-sm btn-danger" data-effect="effect-scale"
                                           title="حذف" data-toggle="modal" href="#delete{{$section->id}}"><i
                                                class="las la-trash"></i></a>
                                    </td>
                                </tr>
                                @include('sections.editForm')
                                @include('sections.deleteForm')
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        @include('sections.addForm')

    </div>
    <!-- row closed -->
    </div>
    <!-- Container closed -->
    </div>
    <!-- main-content closed -->

@endsection
@section('js')
    <script src="{{ URL::asset('assets/js/modal.js') }}"></script>
@endsection
