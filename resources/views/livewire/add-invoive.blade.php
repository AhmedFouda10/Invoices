<div>
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
    {{-- @livewire('form_invoice') --}}
    <form action="{{url('invoices/store')}}" method="post">
    @include('livewire.info_invoice')
    @include('livewire.amount_invoice')
    @include('livewire.attachements_invoice')


    <div class="card-body box_4" style="display: none">
        <div class="col-xs-12">
            <div class="col-md-12">
                <h3 style="font-family:'cairo',sans-serif;">هل أنت متأكد من حفظ البيانات</h3><br>
                <button class="btn btn-danger btn-md nextBtn pull-right" type="button" onclick="back_3()">back</button>
                <button class="btn btn-primary btn-md nextBtn pull-right" type="submit">finish</button>
            </div>
        </div>
    </div>
</form>
</div>
<script>
    // $(document).ready(function() {
    //     $(".box_color_1").css("background-color", "green");
    // })
    function firstStepSubmit() {
        $(".box_1").hide();
        $(".box_2").show();

        $(".box_color_2").attr("style",
            "background-color:green;width: 50px;height: 50px;line-height: 30px;margin: auto;font-size: 1rem;font-weight: bold;border-radius: 50%;color: #fff;"
            )
        $(".box_color_1").attr("style",
            "background-color:#00113a;width: 50px;height: 50px;line-height: 30px;margin: auto;font-size: 1rem;font-weight: bold;border-radius: 50%;color: #fff;"
            );
    }
    function back_1(){
        $(".box_1").show();
        $(".box_2").hide();
        $(".box_color_2").attr("style",
            "background-color:#00113a;width: 50px;height: 50px;line-height: 30px;margin: auto;font-size: 1rem;font-weight: bold;border-radius: 50%;color: #fff;"
            )
        $(".box_color_1").attr("style",
            "background-color:green;width: 50px;height: 50px;line-height: 30px;margin: auto;font-size: 1rem;font-weight: bold;border-radius: 50%;color: #fff;"
            );
    }
    function secondStepSubmit(){
        $(".box_2").hide();
        $(".box_3").show();
        $(".box_color_2").attr("style",
            "background-color:#00113a;width: 50px;height: 50px;line-height: 30px;margin: auto;font-size: 1rem;font-weight: bold;border-radius: 50%;color: #fff;"
            )
            $(".box_color_3").attr("style",
            "background-color:green;width: 50px;height: 50px;line-height: 30px;margin: auto;font-size: 1rem;font-weight: bold;border-radius: 50%;color: #fff;"
            )
    }
    function back_2(){
        $(".box_2").show();
        $(".box_3").hide();
        $(".box_color_3").attr("style",
            "background-color:#00113a;width: 50px;height: 50px;line-height: 30px;margin: auto;font-size: 1rem;font-weight: bold;border-radius: 50%;color: #fff;"
            )
            $(".box_color_2").attr("style",
            "background-color:green;width: 50px;height: 50px;line-height: 30px;margin: auto;font-size: 1rem;font-weight: bold;border-radius: 50%;color: #fff;"
            )
    }
    function threeStepSubmit(){
        $(".box_4").show();
        $(".box_3").hide();
        $(".box_color_3").attr("style",
            "background-color:#00113a;width: 50px;height: 50px;line-height: 30px;margin: auto;font-size: 1rem;font-weight: bold;border-radius: 50%;color: #fff;"
            )
            $(".box_color_4").attr("style",
            "background-color:green;width: 50px;height: 50px;line-height: 30px;margin: auto;font-size: 1rem;font-weight: bold;border-radius: 50%;color: #fff;"
            )
    }
    function back_3(){
        $(".box_3").show();
        $(".box_4").hide();
        $(".box_color_4").attr("style",
            "background-color:#00113a;width: 50px;height: 50px;line-height: 30px;margin: auto;font-size: 1rem;font-weight: bold;border-radius: 50%;color: #fff;"
            )
            $(".box_color_3").attr("style",
            "background-color:green;width: 50px;height: 50px;line-height: 30px;margin: auto;font-size: 1rem;font-weight: bold;border-radius: 50%;color: #fff;"
            )
    }
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