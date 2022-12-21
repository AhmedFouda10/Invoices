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
                <h4 class="content-title mb-0 my-auto">{{ trans('main_trans.الفواتير') }}</h4><span
                    class="text-muted mt-1 tx-13 mr-2 mb-0">/ {{ trans('main_trans.أضافة فاتورة') }}</span>
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
            <div class="card pd-20">
                <div class="stepwizard">
                    <div class="stepwizard-row setup-panel" style="display: flex;justify-content: space-around;">
                        <div class="stepwizard-step" style="display: flex;flex-direction: column;justify-content: center;">
                            <a href="#step-1"
                                style="width: 50px;height: 50px;line-height: 30px;margin: auto;font-size: 1rem;font-weight: bold;border-radius: 50%;background-color:green;color: #fff;"
                                type="button" class="btn btn-circle box_color_1">1</a>
                            <p style="font-weight: bold;font-size: 1.2rem;margin-top: 10px;">معلومات الفاتورة</p>
                        </div>
                        <div class="stepwizard-step" style="display: flex;flex-direction: column;justify-content: center;">
                            <a href="#step-2"
                                style="width: 50px;height: 50px;line-height: 30px;margin: auto;font-size: 1rem;font-weight: bold;border-radius: 50%;background-color:#00113a;color: #fff;"
                                type="button" class="btn btn-circle box_color_2">2</a>
                            <p style="font-weight: bold;font-size: 1.2rem;margin-top: 10px;">مبلغ الفاتورة</p>
                        </div>
                        <div class="stepwizard-step" style="display: flex;flex-direction: column;justify-content: center;">
                            <a href="#step-2"
                                style="width: 50px;height: 50px;line-height: 30px;margin: auto;font-size: 1rem;font-weight: bold;border-radius: 50%;background-color:#00113a;color: #fff;"
                                type="button" class="btn btn-circle box_color_3">3</a>
                            <p style="font-weight: bold;font-size: 1.2rem;margin-top: 10px;">مرفقات الفاتورة</p>
                        </div>
                        <div class="stepwizard-step" style="display: flex;flex-direction: column;justify-content: center;">
                            <a href="#step-3"
                                style="width: 50px;height: 50px;line-height: 30px;margin: auto;font-size: 1rem;font-weight: bold;border-radius: 50%;background-color:#00113a;color: #fff;"
                                type="button" class="btn btn-circle box_color_4" disabled="disabled">4</a>
                            <p style="font-weight: bold;font-size: 1.2rem;margin-top: 10px;">تأكيد المعلومات</p>
                        </div>
                    </div>
                </div>
                <form action="{{ url('invoices/store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body box_1">
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="exampleInputEmail1"
                                    class="form-label">{{ trans('main_trans.رقم الفاتورة') }}</label>
                                <input type="text" class="form-control invoice_number" id="inputName"
                                    name="invoice_number" title="يرجي ادخال رقم الفاتورة">
                                {{-- @error('invoice_number')
                                        <div class="alert alert-danger">{{$message}}</div>
                                    @enderror --}}
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="exampleInputEmail1" class="form-label">تاريخ الفاتوره</label>
                                {{-- <input type="date" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"> --}}
                                <input class="form-control fc-datepicker invoice_Date" name="invoice_Date"
                                    placeholder="YYYY-MM-DD" type="text" value="{{ date('Y-m-d') }}" required>

                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="exampleInputEmail1" class="form-label"> تاريخ الاستحقاق</label>
                                {{-- <input type="date" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"> --}}
                                <input class="form-control fc-datepicker Due_date" name="Due_date" placeholder="YYYY-MM-DD"
                                    type="text" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="exampleInputEmail1" class="form-label"> {{ trans('main_trans.القسم') }}</label>
                                <select name="Section" id="Section" class="custom-select my-1 mr-sm-2 Section"
                                    onclick="console.log($(this).val())" onchange="console.log('change is firing')"
                                    required>
                                    <option selected>{{ trans('main_trans.حدد القسم') }}</option>

                                    @foreach ($sections as $section)
                                        <option value="{{ $section->id }}">
                                            {{ $section->getTranslation('section_name', App::getLocale()) }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="exampleInputEmail1" class="form-label">
                                    {{ trans('main_trans.المنتج') }}</label>
                                <select name="product" id="product" class="custom-select my-1 mr-sm-2 product" required>
                                    <option selected>{{ trans('main_trans.حدد المنتج') }}</option>

                                </select>
                            </div>
                        </div>



                        <button type="button" class="btn btn-primary firstStepSubmit"
                            onclick="firstStepSubmit()">{{ trans('main_trans.التالي') }}</button>
                    </div>
                    {{--  --}}
                    <div class="card-body box_2" style="display: none">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="exampleInputEmail1" class="form-label">
                                    {{ trans('main_trans.مبلغ التحصيل') }}</label>
                                <input type="text" class="form-control Amount_collection" id="inputName" name="Amount_collection"
                                    oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="exampleInputEmail1" class="form-label">
                                    {{ trans('main_trans.مبلغ العمولة') }}
                                </label>
                                <input type="text" class="form-control form-control-lg Amount_Commission" id="Amount_Commission"
                                    oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                    name="Amount_Commission" title="يرجي ادخال مبلغ العمولة " required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="exampleInputEmail1" class="form-label">
                                    {{ trans('main_trans.الخصم') }}</label>
                                <input type="text" class="form-control form-control-lg Discount" id="Discount"
                                    name="Discount" title="يرجي ادخال مبلغ الخصم "
                                    oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                    value=0 required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="exampleInputEmail1" class="form-label">
                                    {{ trans('main_trans.النسبة') }}</label>
                                <select name="Rate_VAT" id="Rate_VAT" class="form-control Rate_VAT" onchange="myFunction()">
                                    <!--placeholder-->
                                    <option value="" selected>{{ trans('main_trans.حدد نسبة الضريبة') }}</option>
                                    <option value="5%">5%</option>
                                    <option value="10%">10%</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="exampleInputEmail1" class="form-label">
                                    {{ trans('main_trans.قيمة الضريبة القيمة المضافة') }}</label>
                                <input type="text" class="form-control Value_VAT" id="Value_VAT" name="Value_VAT" readonly>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="exampleInputEmail1" class="form-label">
                                    {{ trans('main_trans.الأجمالي شامل الضريبة') }}</label>
                                <input type="text" class="form-control Total" id="Total" name="Total" readonly>
                            </div>
                            <button type="button" class="btn btn-danger"
                                onclick="back_1()">{{ trans('main_trans.السابق') }}</button>
                            <button type="button" class="btn btn-primary"
                                onclick="secondStepSubmit()">{{ trans('main_trans.التالي') }}</button>

                        </div>
                    </div>
                    {{--  --}}
                    <div class="card-body box_3" style="display: none">
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label for="exampleFormControlTextarea1">notes</label>
                                <textarea class="form-control" name="note_en" id="note" rows="3"></textarea>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="exampleFormControlTextarea1">ملاحظات</label>
                                <textarea class="form-control" name="note_ar" id="note" rows="3"></textarea>
                            </div>
                            <p class="text-danger w-100 fa-1x">* صيغة المرفق pdf, jpeg ,.jpg , png </p>
                            <p class="card-title fa-2x">{{ trans('main_trans.المرفقات') }}</p>

                            <div class="col-sm-12 col-md-12">
                                <input type="file" name="pic" class="dropify form-control"
                                    accept=".pdf,.jpg, .png, image/jpeg, image/png" data-height="70" />
                            </div><br>
                        </div>
                        <button type="button" class="btn btn-danger "
                            onclick="back_2()">{{ trans('main_trans.السابق') }}</button>
                        <button type="button" class="btn btn-primary "
                            onclick="threeStepSubmit()">{{ trans('main_trans.التالي') }}</button>
                    </div>


                    {{--  --}}
                    <div class="card-body box_4" style="display: none">
                        <div class="col-xs-12">
                            <div class="col-md-12">
                                <h3 style="font-family:'cairo',sans-serif;">هل أنت متأكد من حفظ البيانات</h3><br>
                                <button class="btn btn-danger btn-md nextBtn pull-right" type="button"
                                    onclick="back_3()">back</button>
                                <input class="btn btn-primary btn-md nextBtn pull-right" type="submit" value="finish">
                            </div>
                        </div>
                    </div>
                </form>
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
        function firstStepSubmit() {
            var invoice_number = $(".invoice_number").val();
            var invoice_Date = $(".invoice_Date").val();
            var Due_date = $(".Due_date").val();
            var Section = $(".Section").val();
            var product = $(".product").val();
            // alert (invoice_number.length)
            if (invoice_number.length != 0 && invoice_Date.length != 0 && Due_date.length != 0 && Section.length != 0 &&
                product.length != 0) {

                $(".box_1").hide();
                $(".box_2").show();

                $(".box_color_2").attr("style",
                    "background-color:green;width: 50px;height: 50px;line-height: 30px;margin: auto;font-size: 1rem;font-weight: bold;border-radius: 50%;color: #fff;"
                )
                $(".box_color_1").attr("style",
                    "background-color:#00113a;width: 50px;height: 50px;line-height: 30px;margin: auto;font-size: 1rem;font-weight: bold;border-radius: 50%;color: #fff;"
                );

            }


        }

        function back_1() {
            $(".box_1").show();
            $(".box_2").hide();
            $(".box_color_2").attr("style",
                "background-color:#00113a;width: 50px;height: 50px;line-height: 30px;margin: auto;font-size: 1rem;font-weight: bold;border-radius: 50%;color: #fff;"
            )
            $(".box_color_1").attr("style",
                "background-color:green;width: 50px;height: 50px;line-height: 30px;margin: auto;font-size: 1rem;font-weight: bold;border-radius: 50%;color: #fff;"
            );
        }

        function secondStepSubmit() {
            var Amount_collection = $(".Amount_collection").val();
            var Amount_Commission = $(".Amount_Commission").val();
            var Discount = $(".Discount").val();
            var Rate_VAT = $(".Rate_VAT").val();
            var Value_VAT = $(".Value_VAT").val();
            var Total = $(".Total").val();
            
            if (Amount_collection.length != 0 && Amount_Commission.length != 0 && Discount.length != 0 && Rate_VAT.length != 0 &&
            Value_VAT.length != 0 && Total.length !=0) {
                $(".box_2").hide();
                $(".box_3").show();
                $(".box_color_2").attr("style",
                    "background-color:#00113a;width: 50px;height: 50px;line-height: 30px;margin: auto;font-size: 1rem;font-weight: bold;border-radius: 50%;color: #fff;"
                )
                $(".box_color_3").attr("style",
                    "background-color:green;width: 50px;height: 50px;line-height: 30px;margin: auto;font-size: 1rem;font-weight: bold;border-radius: 50%;color: #fff;"
                )
            }
        }

        function back_2() {
            $(".box_2").show();
            $(".box_3").hide();
            $(".box_color_3").attr("style",
                "background-color:#00113a;width: 50px;height: 50px;line-height: 30px;margin: auto;font-size: 1rem;font-weight: bold;border-radius: 50%;color: #fff;"
            )
            $(".box_color_2").attr("style",
                "background-color:green;width: 50px;height: 50px;line-height: 30px;margin: auto;font-size: 1rem;font-weight: bold;border-radius: 50%;color: #fff;"
            )
        }

        function threeStepSubmit() {
            $(".box_4").show();
            $(".box_3").hide();
            $(".box_color_3").attr("style",
                "background-color:#00113a;width: 50px;height: 50px;line-height: 30px;margin: auto;font-size: 1rem;font-weight: bold;border-radius: 50%;color: #fff;"
            )
            $(".box_color_4").attr("style",
                "background-color:green;width: 50px;height: 50px;line-height: 30px;margin: auto;font-size: 1rem;font-weight: bold;border-radius: 50%;color: #fff;"
            )
        }

        function back_3() {
            $(".box_3").show();
            $(".box_4").hide();
            $(".box_color_4").attr("style",
                "background-color:#00113a;width: 50px;height: 50px;line-height: 30px;margin: auto;font-size: 1rem;font-weight: bold;border-radius: 50%;color: #fff;"
            )
            $(".box_color_3").attr("style",
                "background-color:green;width: 50px;height: 50px;line-height: 30px;margin: auto;font-size: 1rem;font-weight: bold;border-radius: 50%;color: #fff;"
            )
        }

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
