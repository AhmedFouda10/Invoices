@extends('layouts.master')
@section('title')
{{ trans('main_trans.أرشيف الفواتير') }}
@endsection
@section('css')
    <!-- Internal Data table css -->
    <link href="{{ URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
    <!--Internal   Notify -->
    <link href="{{ URL::asset('assets/plugins/notify/css/notifIt.css') }}" rel="stylesheet" />
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">{{ trans('main_trans.الفواتير') }}</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ 
                    {{ trans('main_trans.أرشيف الفواتير') }}</span>
            </div>
        </div>

    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->

    @if (session()->has('status_update'))
        <script>
            window.onload = function() {
                notif({
                    msg: "تم تحديث حاله الفاتورة بنجاح",
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
    <div class="row">
        @if (session()->has('Add'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>{{ session()->get('Add') }}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        @if (session()->has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>{{ session()->get('success') }}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        @if (session()->has('edit'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>{{ session()->get('edit') }}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        <!--div-->
        <div class="col-xl-12">
            <div class="card mg-b-20">
                <div class="card-header pb-0">
                    {{-- <div class="d-flex justify-content-between">
                        <a href="{{ url('add_invoices') }}" class="btn btn-primary">&nbsp; اضافه فاتوره</a>
                    </div> --}}
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example" class="table key-buttons text-md-wrap">
                            <thead>
                                <tr>
                                    <th class="border-bottom-0">#</th>
                                    <th class="border-bottom-0">{{ trans('main_trans.رقم الفاتورة') }}</th>
                                    <th class="border-bottom-0">{{ trans('main_trans.تاريخ الفاتورة') }}</th>
                                    <th class="border-bottom-0">{{ trans('main_trans.تاريخ الأستحقاق') }}</th>
                                    <th class="border-bottom-0">{{ trans('main_trans.المنتج') }}</th>
                                    <th class="border-bottom-0">{{ trans('main_trans.القسم') }}</th>
                                    <th class="border-bottom-0">{{ trans('main_trans.الخصم') }}</th>
                                    <th class="border-bottom-0">{{ trans('main_trans.نسبه الضريبة') }}</th>
                                    <th class="border-bottom-0">{{ trans('main_trans.قيمه الضريبة') }}</th>
                                    <th class="border-bottom-0">{{ trans('main_trans.الإجمالي') }}</th>
                                    <th class="border-bottom-0">{{ trans('main_trans.الحالة') }}</th>
                                    <th class="border-bottom-0">{{ trans('main_trans.ملاحظات') }}</th>
                                    <th class="border-bottom-0" style="display: block">{{ trans('main_trans.العمليات') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $x = 1;
                                @endphp
                                @foreach ($invoices as $invoice)
                                    <tr>
                                        <td>{{ $x++ }}</td>
                                        <td>{{ $invoice->invoice_number }}</td>
                                        <td>{{ $invoice->invoice_Date }}</td>
                                        <td>{{ $invoice->Due_date }}</td>
                                        <td>{{ $invoice->product->Product_name }}</td>
                                        <td>
                                            {{ $invoice->section->section_name }}
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
                                                    type="button">
                                                    {{ trans('main_trans.العمليات') }} <i class="fas fa-caret-down ml-1"></i>
                                                </button>
                                                <div class="dropdown-menu tx-13">
                                                    @can('حذف الفاتورة')

                                                    <a class="dropdown-item" href="#"
                                                        data-invoice_id="{{ $invoice->id }}" data-toggle="modal"
                                                        data-target="#delete_invoice"
                                                        style="font-weight: bold;font-size: 1rem;"><i
                                                            class="text-danger fas fa-trash-alt"></i> 
                                                            {{ trans('main_trans.حذف الفاتورة') }}
                                                    </a>
                                                    @endcan

                                                    {{-- @can('نقل الفواتير') --}}

                                                    <a class="dropdown-item" href="#"
                                                        data-invoice_id="{{ $invoice->id }}" data-toggle="modal"
                                                        data-target="#transfer_archeive"
                                                        style="font-weight: bold;font-size: 1rem;">
                                                        <i class="text-danger fas fa-toggle-on"></i>
                                                        {{ trans('main_trans.نقل الي الفواتير') }}
                                                    </a>
                                                    {{-- @endcan --}}

                                                </div>
                                            </div>
                                        </td>

                                    </tr>
                                @endforeach


                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!--/div-->
        <!-- حذف الفاتورة -->
        <div class="modal fade" id="delete_invoice" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">{{ trans('main_trans.حذف الفاتورة') }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <form action="{{ url('invoices/archieve/destroy') }}" method="post">
                            @csrf
                    </div>
                    <div class="modal-body">
                        {{ trans('main_trans.هل أنت متأكد من عملية الحذف؟') }}
                        <input type="hidden" name="invoice_id" id="invoice_id" value="">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ trans('main_trans.الغاء') }}</button>
                        <button type="submit" class="btn btn-danger">{{ trans('main_trans.تأكيد') }}</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- حذف الفاتورة -->
        <div class="modal fade" id="transfer_archeive" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">{{ trans('main_trans.عوده الي قائمه الفواتير') }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <form action="{{ url('invoices/archeive/update') }}" method="post">
                            @csrf
                    </div>
                    <div class="modal-body">
                        {{ trans('main_trans.هل انت متاكد من عملية الغاء عمليه الارشفه؟') }}
                        <input type="hidden" name="invoice_id" id="invoice_id" value="">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ trans('main_trans.الغاء') }}</button>
                        <button type="submit" class="btn btn-danger">{{ trans('main_trans.تأكيد') }}</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>

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
    <!--Internal  Notify js -->
    <script src="{{ URL::asset('assets/plugins/notify/js/notifIt.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/notify/js/notifit-custom.js') }}"></script>
    <script>
        $('#delete_invoice').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var invoice_id = button.data('invoice_id')
            console.log(invoice_id);
            var modal = $(this)
            modal.find('.modal-body #invoice_id').val(invoice_id);
        })
        $('#transfer_archeive').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var invoice_id = button.data('invoice_id')
            console.log(invoice_id);
            var modal = $(this)
            modal.find('.modal-body #invoice_id').val(invoice_id);
        })
    </script>
@endsection