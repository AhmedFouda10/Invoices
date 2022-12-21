@extends('layouts.master')
@section('css')
    <!--- Internal Select2 css-->
    <link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
    <!---Internal Fileupload css-->
    <link href="{{ URL::asset('assets/plugins/fileuploads/css/fileupload.css') }}" rel="stylesheet" type="text/css" />
    <!---Internal Fancy uploader css-->
    <link href="{{ URL::asset('assets/plugins/fancyuploder/fancy_fileupload.css') }}" rel="stylesheet" />
    <!--Internal Sumoselect css-->
    <link rel="stylesheet" href="{{ URL::asset('assets/plugins/sumoselect/sumoselect-rtl.css') }}">
    <!--Internal  TelephoneInput css-->
    <link rel="stylesheet" href="{{ URL::asset('assets/plugins/telephoneinput/telephoneinput-rtl.css') }}">
@endsection
@section('title')
    اضافة فاتورة
@stop
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">الفواتير</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ اضافه فاتوره </span>
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
								<form action="{{url('invoices/status_update/'.$status_show->id)}}" method="post" enctype="multipart/form-data">
									@csrf
									<div class="row">
										<div class="col-md-4 mb-3">
											<label for="exampleInputEmail1" class="form-label">رقم الفاتوره</label>
											<input type="text" class="form-control" id="inputName" name="invoice_number"
                                    			title="يرجي ادخال رقم الفاتورة" value="{{$status_show->invoice_number}}" readonly>
										</div>
										<div class="col-md-4 mb-3">
											<label for="exampleInputEmail1" class="form-label">تاريخ الفاتوره</label>
											<input class="form-control fc-datepicker" name="invoice_Date" placeholder="YYYY-MM-DD"
                                    			type="text" value="{{$status_show->invoice_Date}}"  readonly>
										</div>
										<div class="col-md-4 mb-3">
											<label for="exampleInputEmail1" class="form-label"> تاريخ الاستحقاق</label>
											<input class="form-control fc-datepicker" name="Due_date" placeholder="YYYY-MM-DD"
                                   				 type="text" value="{{$status_show->Due_date}}" readonly>
										</div>
										<div class="col-md-4 mb-3">
											<label for="exampleInputEmail1" class="form-label">  القسم</label>
											<select name="Section" id="Section" class="custom-select my-1 mr-sm-2" readonly>										
												<option value="{{$status_show->section_id}}">{{ $status_show->section->section_name }}</option>		
											</select>
										</div>
										<div class="col-md-4 mb-3">
											<label for="exampleInputEmail1" class="form-label">  المنتج</label>
											<select name="product" id="product" class="custom-select my-1 mr-sm-2" readonly>
												<option value="{{$status_show->product->id}}">{{ $status_show->product->Product_name }}</option>
												{{-- <option value="{{ $invoices->product->id }}">{{ $invoices->product->Product_name}}</option> --}}
											</select>
										</div>
										<div class="col-md-4 mb-3">
											<label for="exampleInputEmail1" class="form-label">  مبلغ التحصيل</label>
											<input type="text" class="form-control" id="inputName" name="Amount_collection"
                                    			readonly value="{{$status_show->Amount_collection}}">
										</div>
										<div class="col-md-4 mb-3">
											<label for="exampleInputEmail1" class="form-label"> مبلغ العموله </label>
											<input type="text" class="form-control form-control-lg" id="Amount_Commission"
												name="Amount_Commission" title="يرجي ادخال مبلغ العمولة "
                                    			readonly value="{{$status_show->Amount_Commission}}">
										</div>
										<div class="col-md-4 mb-3">
											<label for="exampleInputEmail1" class="form-label">  الخصم</label>
											<input type="text" class="form-control form-control-lg" id="Discount" name="Discount"
                                    			title="يرجي ادخال مبلغ الخصم "
                                    			readonly value="{{$status_show->Discount}}">
										</div>
										<div class="col-md-4 mb-3">
											<label for="exampleInputEmail1" class="form-label">  النسبه</label>
											<select name="Rate_VAT" id="Rate_VAT" class="form-control" readonly>
												<!--placeholder-->
												<option value="{{$status_show->Rate_VAT}}"  >{{$status_show->Rate_VAT}}</option>
												
											</select>										
										</div>
										<div class="col-md-6 mb-3">
											<label for="exampleInputEmail1" class="form-label">  قيمه الضريبه القيمه المضافه</label>
											<input type="text" class="form-control" id="Value_VAT" name="Value_VAT" readonly>										
										</div>
										<div class="col-md-6 mb-3">
											<label for="exampleInputEmail1" class="form-label">  الاجمالي شامل الضريبه</label>
											<input type="text" class="form-control" id="Total" name="Total" value="{{$status_show->Total}}" readonly>										
										</div>
										<div class="col-md-6 mb-3">
											<label for="exampleFormControlTextarea1">notes</label>
											<textarea class="form-control" name="note_en" id="note" rows="3">{{$status_show->getTranslation('note','en')}}</textarea>
										</div>
										<div class="col-md-6 mb-3">
											<label for="exampleFormControlTextarea1">ملاحظات</label>
											<textarea class="form-control" name="note_ar" id="note" rows="3">{{$status_show->getTranslation('note','ar')}}</textarea>
										</div>
									</div>
									<div class="row">
                                        <div class="col">
                                            <label for="exampleTextarea">حالة الدفع</label>
                                            <select class="form-control" id="Status" name="Status" required>
                                                <option selected="true" disabled="disabled">-- حدد حالة الدفع --</option>
                                                <option value="مدفوعة">مدفوعة</option>
                                                <option value="مدفوعة جزئيا">مدفوعة جزئيا</option>
                                            </select>
                                        </div>
            
                                        <div class="col">
                                            <label>تاريخ الدفع</label>
                                            <input class="form-control fc-datepicker" name="Payment_Date" placeholder="YYYY-MM-DD"
                                                type="text" required>
                                        </div>
            
            
                                    </div><br>
									
									
									<div class="d-flex justify-content-center">
                                        <button type="submit" class="btn btn-primary">تحديث حالة الدفع</button>
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
    <!-- Internal Select2 js-->
    <script src="{{ URL::asset('assets/plugins/select2/js/select2.min.js') }}"></script>
    <!--Internal Fileuploads js-->
    <script src="{{ URL::asset('assets/plugins/fileuploads/js/fileupload.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fileuploads/js/file-upload.js') }}"></script>
    <!--Internal Fancy uploader js-->
    <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.ui.widget.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.fileupload.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.iframe-transport.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.fancy-fileupload.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fancyuploder/fancy-uploader.js') }}"></script>
    <!--Internal  Form-elements js-->
    <script src="{{ URL::asset('assets/js/advanced-form-elements.js') }}"></script>
    <script src="{{ URL::asset('assets/js/select2.js') }}"></script>
    <!--Internal Sumoselect js-->
    <script src="{{ URL::asset('assets/plugins/sumoselect/jquery.sumoselect.js') }}"></script>
    <!--Internal  Datepicker js -->
    <script src="{{ URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js') }}"></script>
    <!--Internal  jquery.maskedinput js -->
    <script src="{{ URL::asset('assets/plugins/jquery.maskedinput/jquery.maskedinput.js') }}"></script>
    <!--Internal  spectrum-colorpicker js -->
    <script src="{{ URL::asset('assets/plugins/spectrum-colorpicker/spectrum.js') }}"></script>
    <!-- Internal form-elements js -->
    <script src="{{ URL::asset('assets/js/form-elements.js') }}"></script>
    <script>
        var date = $('.fc-datepicker').datepicker({
            dateFormat: 'yy-mm-dd'
        }).val();
    </script>

    <script>
        $(document).ready(function() {
            $('select[name="Section"]').on('change', function() {
			console.log('ok')

                var SectionId = $(this).val();
                if (SectionId) {
                    $.ajax({
                        url: "{{ url('section') }}/" + SectionId,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            $('select[name="product"]').empty();
                            $.each(data, function(key, value) {
                                $('select[name="product"]').append('<option value="' +
                                    value + '">' + value + '</option>');
                            });
                        },
                    });
                } else {
                    console.log('AJAX load did not work');
                }
            });
        });
    </script>


    <script>
        function myFunction() {
            var Amount_Commission = parseFloat(document.getElementById("Amount_Commission").value);
            var Discount = parseFloat(document.getElementById("Discount").value);
            var Rate_VAT = parseFloat(document.getElementById("Rate_VAT").value);
            var Value_VAT = parseFloat(document.getElementById("Value_VAT").value);
            var Amount_Commission2 = Amount_Commission - Discount;
            if (typeof Amount_Commission === 'undefined' || !Amount_Commission) {
                alert('يرجي ادخال مبلغ العمولة ');
            } else {
                var intResults = Amount_Commission2 * Rate_VAT / 100;
                var intResults2 = parseFloat(intResults + Amount_Commission2);
                sumq = parseFloat(intResults).toFixed(2);
                sumt = parseFloat(intResults2).toFixed(2);
                document.getElementById("Value_VAT").value = sumq;
                document.getElementById("Total").value = sumt;
            }
        }
    </script>



@endsection
