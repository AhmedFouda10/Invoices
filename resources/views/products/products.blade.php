@extends('layouts.master')
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
                <h4 class="content-title mb-0 my-auto">الاعدادات</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                    المنتجات</span>
            </div>
        </div>

    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <!-- row -->
    <div class="row">
        @if (session()->has('Add'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>{{ session()->get('Add') }}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        @if (session()->has('Error'))
            <div class="alert alert-fanger alert-dismissible fade show" role="alert">
                <strong>{{ session()->get('Error') }}</strong>
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
        @if (session()->has('delete'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>{{ session()->get('delete') }}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        <!--div-->
        <div class="col-xl-12">
            <div class="card mg-b-20">
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between">
                        @can('اضافة منتج')
                            <a class="modal-effect btn btn-outline-primary" data-effect="effect-scale" data-toggle="modal"
                                href="#modaldemo8">اضافه منتج</a>
                        @endcan

                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example" class="table key-buttons text-md-nowrap">
                            <thead>
                                <tr>
                                    <th class="border-bottom-0">#</th>
                                    <th class="border-bottom-0">اسم المنتج</th>
                                    <th class="border-bottom-0">اسم القسم</th>
                                    <th class="border-bottom-0">ملاحظات</th>
                                    <th class="border-bottom-0">العمليات</th>
                                </tr>
                            </thead>
                            <tbody>

                                @php
                                    $x = 1;
                                @endphp
                                @foreach ($products as $item)
                                    <tr>
                                        <td>{{ $x++ }}</td>
                                        <td>{{ $item->Product_name }}</td>
                                        <td>{{ $item->section->section_name }}</td>
                                        <td>{{ $item->description }}</td>
                                        <td>
                                            @can('تعديل منتج')
                                                <button class="btn btn-outline-success btn-sm" data-toggle="modal"
                                                    data-target="#edit_Product{{ $item->id }}">تعديل</button>
                                            @endcan

                                            @can('حذف منتج')
                                                <button class="btn btn-outline-danger btn-sm "
                                                    data-pro_id="{{ $item->id }}"
                                                    data-product_name="{{ $item->Product_name }}" data-toggle="modal"
                                                    data-target="#modaldemo9">حذف</button>
                                            @endcan

                                        </td>
                                    </tr>
									<!-- edit -->
        <div class="modal fade" id="edit_Product{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
		aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">تعديل منتج</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<form action="{{ url('products/update') }}" method="post">
					{{-- {{ method_field('patch') }} --}}
					{{-- {{ csrf_field() }} --}}
					@csrf
					<div class="modal-body">
						<div class="button" style="display: flex;justify-content: flex-end;">
							<div class="btn btn-primary mr-1 btn-en">en</div>
							<div class="btn btn-primary btn-ar mr-1">ar</div>
						</div>
						<div class="products_ar">
							<div class="form-group">
								<label for="title">اسم المنتج :</label>
	
								<input type="hidden" class="form-control" name="pro_id" id="pro_id"
									value="{{$item->id}}">
	
								<input type="text" class="form-control" name="Product_name_ar" id="Product_name" value="{{$item->getTranslation('Product_name','ar')}}">
							</div>
	
							<label class="my-1 mr-2" for="inlineFormCustomSelectPref">القسم</label>
							<select name="section_name" id="section_name" class="custom-select my-1 mr-sm-2" required>
								{{-- @foreach ($sections as $section)
									<option>{{ $section->getTranslation('section_name','ar') }}</option>
								@endforeach --}}
								@foreach ($sections as $section)
									@php
										$section_id=$section->id;
										$prodcut_section_id=$item->section_id;	
									@endphp
                                    <option value="{{ $section->id }}" {{ $section_id==$prodcut_section_id ? "selected" : '' }}>{{ $section->getTranslation('section_name','ar') }}</option>
                                @endforeach
							</select>
	
							<div class="form-group">
								<label for="des">ملاحظات :</label>
								<textarea name="description_ar" cols="20" rows="5" id='description' class="form-control">{{$item->getTranslation('description','ar')}}</textarea>
							</div>
						</div>
						<div class="products_en">
							<div class="form-group">
								<label for="title">product name :</label>
								<input type="text" class="form-control" name="Product_name_en" id="Product_name" value="{{$item->getTranslation('Product_name','en')}}">
							</div>
	
							<label class="my-1 mr-2" for="inlineFormCustomSelectPref">section</label>
							<select  class="custom-select my-1 mr-sm-2" required>
								@foreach ($sections as $section)
								@php
										$section_id=$section->id;
										$prodcut_section_id=$item->section_id;	
									@endphp
                                    <option value="{{ $section->id }}" {{ $section_id==$prodcut_section_id ? "selected" : '' }}>{{ $section->getTranslation('section_name','en') }}</option>
                                @endforeach
							</select>
	
							<div class="form-group">
								<label for="des">notes :</label>
								<textarea name="description_en" cols="20" rows="5" id='description' class="form-control">{{$item->getTranslation('description','en')}}</textarea>
							</div>
						</div>

					</div>
					<div class="modal-footer">
						<button type="submit" class="btn btn-primary">تعديل البيانات</button>
						<button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
					</div>
				</form>
			</div>
		</div>
	</div>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!--/div-->
        <!-- Modal effects -->
        <div class="modal" id="modaldemo8">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content modal-content-demo">
                    <div class="modal-header">
                        <h6 class="modal-title">اضافه منتج</h6><button aria-label="Close" class="close" data-dismiss="modal"
                            type="button"><span aria-hidden="true">&times;</span></button>

                    </div>

                    <div class="modal-body">
                        <form action="{{ url('products/store') }}" method="post">
                            @csrf
                            <div class="button" style="display: flex;justify-content: flex-end;">
                                <div class="btn btn-primary mr-1 btn-en">en</div>
                                <div class="btn btn-primary btn-ar mr-1">ar</div>
                            </div>
                            <div class="products_ar">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">اسم المنتج</label>
                                    <input type="text" class="form-control" id="Product_name"
                                        aria-describedby="emailHelp" name="Product_name_ar">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">اسم القسم</label>
                                    <select class="form-control form-select-sm" aria-label=".form-select-sm example"
                                        name="section_id" id="section_id">
                                        <option selected>Open this select menu</option>
                                        @foreach ($sections as $item)
                                            <option value="{{ $item->id }}">{{ $item->getTranslation('section_name','ar') }}</option>
                                        @endforeach

                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlTextarea1">ملاحظات</label>
                                    <textarea class="form-control" name="description_ar" id="description" rows="3"></textarea>
                                </div>
                            </div>
                            <div class="products_en">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">product name</label>
                                    <input type="text" class="form-control" id="Product_name"
                                        aria-describedby="emailHelp" name="Product_name_en">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">section name</label>
                                    <select class="form-control form-select-sm" aria-label=".form-select-sm example"
                                         id="section_id">
                                        <option selected>Open this select menu</option>
                                        @foreach ($sections as $item)
                                            <option value="{{ $item->id }}">{{ $item->getTranslation('section_name','en') }}</option>
                                        @endforeach

                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlTextarea1">notes</label>
                                    <textarea class="form-control" name="description_en" id="description" rows="3"></textarea>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button class="btn ripple btn-primary" type="submit">تاكيد</button>
                                {{-- <input type="submit" value="تاكيد" class="btn ripple btn-primary"> --}}
                                <button class="btn ripple btn-secondary" data-dismiss="modal"
                                    type="button">اغلاق</button>
                            </div>
                        </form>

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
                    <form action="{{ url('products/destroy') }}" method="post">
                        @csrf
                        <div class="modal-body">
                            <p>هل انت متاكد من عملية الحذف ؟</p><br>
                            <input type="hidden" name="pro_id" id="pro_id" value="">
                            <input class="form-control" name="Product_name" id="Product_name" type="text" readonly>
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


            var pro_id = button.data('pro_id')
            modal.find('.modal-body #pro_id').val(pro_id);

            var product_name = button.data('product_name')
            modal.find('.modal-body #Product_name').val(product_name);
        })
    </script>
    <script>
        // $('#edit_Product').on('show.bs.modal', function(event) {
        //     var button = $(event.relatedTarget)
        //     var modal = $(this)

        //     var Product_name = button.data('name')
        //     modal.find('.modal-body #Product_name').val(Product_name);

        //     var section_name = button.data('section_name')
        //     modal.find('.modal-body #section_name').val(section_name);

        //     var pro_id = button.data('pro_id')
        //     modal.find('.modal-body #pro_id').val(pro_id);

        //     var description = button.data('description')
        //     modal.find('.modal-body #description').val(description);

        // })
    </script>
    <script>
        $(document).ready(function() {
            $(".products_ar").hide();
            $(".btn-ar").click(function() {
                $(".products_en").hide(500);
                $(".products_ar").show(500);
            })
            $(".btn-en").click(function() {
                $(".products_ar").hide(500);
                $(".products_en").show(500);
            })
        })
    </script>
@endsection
