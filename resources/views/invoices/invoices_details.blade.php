@extends('layouts.master')
@section('title')
    {{ trans('main_trans.الفواتير') }}
@endsection
@section('css')
    <!-- Internal Data table css -->
    <link href="{{ URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
    <!---Internal Owl Carousel css-->
    <link href="{{ URL::asset('assets/plugins/owl-carousel/owl.carousel.css') }}" rel="stylesheet">
    <!---Internal  Multislider css-->
    <link href="{{ URL::asset('assets/plugins/multislider/multislider.css') }}" rel="stylesheet">
    <!--- Select2 css -->
    <link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">{{ trans('main_trans.الفواتير') }} </h4><span
                    class="text-muted mt-1 tx-13 mr-2 mb-0">/ {{ trans('main_trans.تفاصيل الفواتير ومرفقاتها') }} </span>
            </div>
        </div>

    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row">
        <!--div-->
        <div class="col-xl-12">
            <div class="card mg-b-20">
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between">

                    </div>
                </div>

                <div class="card-body">
                    <div class="panel panel-primary tabs-style-2">
                        <div class=" tab-menu-heading">
                            <div class="tabs-menu1">
                                <!-- Tabs -->
                                <ul class="nav panel-tabs main-nav-line">
                                    <li><a href="#tab4" class="nav-link active" data-toggle="tab">{{ trans('main_trans.معلومات الفاتورة') }}</a></li>
                                    <li><a href="#tab5" class="nav-link" data-toggle="tab">{{ trans('main_trans.تفاصيل الفاتورة') }}</a></li>
                                    <li><a href="#tab6" class="nav-link" data-toggle="tab">{{ trans('main_trans.مرفقات الفاتورة') }}</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="panel-body tabs-menu-body main-content-body-right border">
                            <div class="tab-content">
                                <div class="tab-pane active" id="tab4">
                                    <div class="table-responsive">
                                        <table class="table table-striped mg-b-0 text-md-nowrap">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th class="border-bottom-0">{{ trans('main_trans.رقم الفاتورة') }}</th>
                                                    <th class="border-bottom-0">{{ trans('main_trans.تاريخ الفاتورة') }}
                                                    </th>
                                                   
                                                    </th>
                                                    <th class="border-bottom-0">{{ trans('main_trans.المنتج') }}</th>
                                                    <th class="border-bottom-0">{{ trans('main_trans.القسم') }}</th>
                                                    <th class="border-bottom-0">{{ trans('main_trans.الخصم') }}</th>
                                                    <th class="border-bottom-0">{{ trans('main_trans.مبلغ التحصيل') }}</th>
                                                    <th class="border-bottom-0">{{ trans('main_trans.مبلغ العمولة') }}</th>
                                                    <th class="border-bottom-0">{{ trans('main_trans.نسبه الضريبة') }}</th>
                                                    <th class="border-bottom-0">{{ trans('main_trans.قيمه الضريبة') }}</th>
                                                    <th class="border-bottom-0">{{ trans('main_trans.الإجمالي') }}</th>
                                                    <th class="border-bottom-0">{{ trans('main_trans.الحالة') }}</th>
                                                    <th class="border-bottom-0">{{ trans('main_trans.ملاحظات') }}</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>{{ $invoices->invoice_number }}</td>
                                                    <td>{{ $invoices->invoice_Date }}</td>
                                                    <td>{{ $invoices->Due_date }}</td>
                                                    <td>{{ $invoices->product->Product_name }}</td>
                                                    <td>{{ $invoices->section->section_name }}</td>
                                                    <td>{{ $invoices->Discount }}</td>
                                                    <td>{{ $invoices->Amount_collection }}</td>
                                                    <td>{{ $invoices->Amount_Commission }}</td>
                                                    <td>{{ $invoices->Rate_VAT }}</td>
                                                    <td>{{ $invoices->Value_VAT }}</td>
                                                    <td>{{ $invoices->Total }}</td>
                                                    <td>
                                                        @if ($invoices->Value_Status == 1)
                                                            <span class="text-success">{{ $invoices->Status }}</span>
                                                        @elseif($invoices->Value_Status == 2)
                                                            <span class="text-danger">{{ $invoices->Status }}</span>
                                                        @else
                                                            <span class="text-warning">{{ $invoices->Status }}</span>
                                                        @endif
                                                    </td>
                                                    <td>{{ $invoices->note }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div><!-- bd -->
                                </div>
                                <div class="tab-pane" id="tab5">
                                    <div class="table-responsive">
                                        <table class="table table-striped mg-b-0 text-md-nowrap">
                                            <thead>
                                                <tr>
                                                    <th class="border-bottom-0">#</th>
                                                    <th class="border-bottom-0">{{ trans('main_trans.رقم الفاتورة') }}</th>
                                                    <th class="border-bottom-0">{{ trans('main_trans.المنتج') }}</th>
                                                    <th class="border-bottom-0">{{ trans('main_trans.القسم') }}</th>
                                                    <th class="border-bottom-0">{{ trans('main_trans.الحالة') }}</th>
                                                    <th class="border-bottom-0">{{ trans('main_trans.تاريخ الدفع') }}</th>
                                                    <th class="border-bottom-0">{{ trans('main_trans.ملاحظات') }}</th>
                                                    <th class="border-bottom-0">{{ trans('main_trans.تاريخ الأضافة') }}</th>
                                                    <th class="border-bottom-0">{{ trans('main_trans.مسجل الفاتورة') }}</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                    $x = 1;
                                                @endphp
                                                @foreach ($invoices_details as $detail)
                                                    <tr>
                                                        <td>{{ $x++ }}</td>
                                                        <td>{{ $detail->invoice_number }}</td>
                                                        <td>{{ $detail->product->Product_name }}</td>
                                                        <td>{{ $detail->section->section_name }}</td>
                                                        <td>
                                                            @if ($detail->Value_Status == 1)
                                                                <span class="text-success">{{ $detail->Status }}</span>
                                                            @elseif($detail->Value_Status == 2)
                                                                <span class="text-danger">{{ $detail->Status }}</span>
                                                            @else
                                                                <span class="text-warning">{{ $detail->Status }}</span>
                                                            @endif
                                                            {{-- {{$detail->Status}}</td>                                                   --}}
                                                        <td>{{ $detail->Payment_Date }}</td>
                                                        <td>{{ $detail->note }}</td>
                                                        <td>{{ $detail->created_at }}</td>
                                                        <td>{{ $detail->user }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div><!-- bd -->
                                </div>
                                <div class="tab-pane" id="tab6">
                                    <div class="card card-statistics">
                                        <div class="card-body">
                                            @can('اضافة مرفق')
                                                <form action="{{ url('InvoicesAttachments') }}" method="post"
                                                    enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input" id="customFile"
                                                            name="file_name" required>
                                                        <input type="hidden" id="customFile" name="invoice_number"
                                                            value="{{ $invoices->invoice_number }}">
                                                        <input type="hidden" id="invoice_id" name="invoice_id"
                                                            value="{{ $invoices->id }}">
                                                        <label class="custom-file-label" for="customFile">{{ trans('main_trans.حدد المرفق') }}
                                                            </label>
                                                    </div><br><br>
                                                    <button type="submit" class="btn btn-primary"
                                                        name="uploadedFile">{{ trans('main_trans.أضافة') }}</button>
                                                </form>
                                            @endcan

                                        </div>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table table-striped mg-b-0 text-md-nowrap">
                                            <thead>
                                                <tr>
                                                    <th class="border-bottom-0">#</th>
                                                    <th class="border-bottom-0">{{ trans('main_trans.أسم الملف') }}</th>
                                                    <th class="border-bottom-0">{{ trans('main_trans.مسجل الفاتورة') }}</th>
                                                    <th class="border-bottom-0">{{ trans('main_trans.تاريخ الفاتورة') }}</th>
                                                    <th class="border-bottom-0">{{ trans('main_trans.العمليات') }}</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                    $x = 1;
                                                @endphp
                                                @foreach ($invoices_attachments as $attachment)
                                                    <tr>
                                                        <td>{{ $x++ }}</td>
                                                        <td>
                                                            <img style="height: 100px;width:100px"
                                                                src="{{ asset('attachments') }}/{{ $attachment->invoice_number }}/{{ $attachment->file_name }}"
                                                                alt="">
                                                        </td>
                                                        <td>{{ $attachment->Created_by }}</td>
                                                        <td>{{ $attachment->created_at }}</td>
                                                        <td>
                                                            <a href="{{ url('view_file') }}/{{ $attachment->invoice_number }}/{{ $attachment->file_name }}"
                                                                class="btn btn-primary">{{ trans('main_trans.عرض الملف') }}</a>
                                                            <a href="{{ url('download_file') }}/{{ $attachment->invoice_number }}/{{ $attachment->file_name }}"
                                                                class="btn btn-success">{{ trans('main_trans.تحميل الملف') }}</a>
                                                            @can('حذف المرفق')
                                                                <a class="modal-effect btn  btn-danger"
                                                                    data-effect="effect-scale"
                                                                    data-file_name="{{ $attachment->file_name }}"
                                                                    data-invoice_number="{{ $attachment->invoice_number }}"
                                                                    data-id_file="{{ $attachment->id }}" data-toggle="modal"
                                                                    href="#modaldemo9" title="حذف"><i
                                                                        class="las la-trash"></i>{{ trans('main_trans.حذف') }}</a>
                                                            @endcan

                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div><!-- bd -->
                                </div>
                                <a href="{{ url('invoices') }}" class="btn btn-primary"
                                    style="font-weight: bold;font-size: 1rem;padding: 0.7rem 2rem;margin-top: 20px;">
                                    {{ trans('main_trans.عودة الي الفواتير') }}</a>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
            <!-- delete -->
        <div class="modal" id="modaldemo9">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content modal-content-demo">
                    <div class="modal-header">
                        <h6 class="modal-title">حذف القسم</h6><button aria-label="Close" class="close"
                            data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <form action="{{ url('delete_file') }}" method="post">
                        @csrf
                        <div class="modal-body">
                            <p>هل انت متاكد من عملية الحذف ؟</p><br>
                            <input type="hidden" name="id_file" id="id_file" value="">
                            
                            <input name="file_name" id="file_name" type="hidden" value="">
                            <input name="invoice_number" id="invoice_number" type="hidden" value="">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">الغاء</button>
                            <button type="submit" class="btn btn-danger">تاكيد</button>
                        </div>
                </div>
                </form>
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
    <!-- Internal Data tables -->
    <script src="{{ URL::asset('assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/responsive.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/jquery.dataTables.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.bootstrap4.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/jszip.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/pdfmake.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/vfs_fonts.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.html5.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.print.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/buttons.colVis.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js') }}"></script>
    <!--Internal  Datatable js -->
    <script src="{{ URL::asset('assets/js/table-data.js') }}"></script>
    <!--Internal  Datepicker js -->
    <script src="{{ URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js') }}"></script>
    <!-- Internal Select2 js-->
    <script src="{{ URL::asset('assets/plugins/select2/js/select2.min.js') }}"></script>
    <!-- Internal Modal js-->
    <script src="{{ URL::asset('assets/js/modal.js') }}"></script>
    <script>
        $('#modaldemo9').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var modal = $(this)


            var file_name = button.data('file_name')
            modal.find('.modal-body #file_name').val(file_name);

            var invoice_number = button.data('invoice_number')
            modal.find('.modal-body #invoice_number').val(invoice_number);
            var id_file = button.data('id_file')
            modal.find('.modal-body #id_file').val(id_file);
        })
    </script>
@endsection
