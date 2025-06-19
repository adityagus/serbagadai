@extends('frontend.layouts.template')

@section('pageTitle','Pembayaran')

@push('customCss')

@endpush

@section('content')

    <!-- breadcrumb -->
    <div class="container">
        <div class="bread-crumb flex-w p-l-25 p-r-15 p-t-30 p-lr-0-lg">
            <a href="{{route('home')}}" class="stext-109 cl8 hov-cl1 trans-04">
                Beranda
                <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
            </a>

            <span class="stext-109 cl4">
				Konfirmasi Pesanan {{strtoupper(@$order->code)}}
			</span>
        </div>
    </div>


    <!-- Shoping Cart -->
    <form action="javascript:;" id="formConfirm" method="post" enctype="multipart/form-data" class="bg0 p-t-75 p-b-85">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 col-xl-7 m-lr-auto m-b-50">
                    <div class="m-l-25 m-r--38 m-lr-0-xl">
                        <div class="bor10 p-lr-40 p-t-30 p-b-40 m-l-63 m-r-40 m-lr-0-xl p-lr-15-sm">
                            <h4 class="mtext-109 cl2 p-b-30">
                                Konfirmasi Pesanan
                            </h4>

                            {{csrf_field()}}

                            <input type="hidden" name="orderId" value="{{@$order->id}}">

                            <div class="bor8 bg0 m-b-12">
                                <input class="stext-111 cl8 plh3 size-111 p-lr-15" type="number" name="amount" placeholder="Jumlah Pembayaran">
                            </div>
                            <div class="bor8 bg0 m-b-12">
                                <input class="stext-111 cl8 plh3 size-111 p-lr-15" type="text" required name="name" placeholder="Nama Rekening">
                            </div>
                            <div class="bor8 bg0 m-b-12">
                                <input class="stext-111 cl8 plh3 size-111 p-lr-15" type="number" name="accountNumber" placeholder="Nomor Rekening">
                            </div>
                            <div class="bor8 bg0 m-b-12">
                                <input class="stext-111 cl8 plh3 size-111 p-lr-15" type="text" name="bankName" placeholder="Nama Bank">
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="rs1-select2 rs2-select2 bor8 bg0 m-b-12 m-t-9">
                                        <select class="js-select2" name="day" required>
                                            <option value="">Pilih Tanggal</option>
                                            @for($i=1;$i<=31;$i++)
                                            <option value="{{$i}}">{{$i}}</option>
                                            @endfor
                                        </select>
                                        <div class="dropDownSelect2"></div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="rs1-select2 rs2-select2 bor8 bg0 m-b-12 m-t-9">
                                        <select class="js-select2" name="month">
                                            <option value="{{date('m')}}">{{date('F')}}</option>
                                            <option value="{{(date('m')-1)}}">{{date('F',strtotime('2018-'.(date('m')-1).'-01'))}}</option>
                                        </select>
                                        <div class="dropDownSelect2"></div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="rs1-select2 rs2-select2 bor8 bg0 m-b-12 m-t-9">
                                        <select class="js-select2" name="year">
                                            <option value="{{date('Y')}}">{{date('Y')}}</option>
                                        </select>
                                        <div class="dropDownSelect2"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="bor8 bg0 m-b-12">
                                <input class="stext-111 cl8 plh3 size-111 p-lr-15" type="file" name="file" placeholder="Bukti Bayar">
                            </div>
                        </div>

                        <div class="flex-w flex-sb-m p-t-18 p-b-15 p-lr-40 p-lr-15-sm" style="float: right">
                            <div class="flex-c-m stext-101 cl2 size-119 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer m-tb-10" onclick="validate()">
                                Konfirmasi
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-10 col-lg-7 col-xl-5 m-lr-auto m-b-50">
                    <div class="bor10 p-lr-40 p-t-30 p-b-40 m-l-63 m-r-40 m-lr-0-xl p-lr-15-sm">
                        <h4 class="mtext-109 cl2 p-b-30">
                            Total Transaksi
                        </h4>

                        <div class="flex-w flex-t bor12 p-b-13">
                            <div class="size-208">
								<span class="stext-110 cl2">
									Subtotal:
								</span>
                            </div>

                            <div class="size-209">
								<span class="mtext-110 cl2">
									Rp. {{number_format(@$order->amount)}}
								</span>
                            </div>
                        </div>

                        <div class="flex-w flex-t bor12 p-b-13">
                            <div class="size-208">
								<span class="stext-110 cl2">
									Pengiriman:
								</span>
                            </div>

                            <div class="size-209">
								<span class="mtext-110 cl2">
									Rp. {{number_format(@$order->shippingFee)}}
								</span>
                            </div>
                        </div>

                        <div class="flex-w flex-t bor12 p-b-13">
                            <div class="size-208">
								<span class="stext-110 cl2">
									Kode Unik:
								</span>
                            </div>

                            <div class="size-209">
								<span class="mtext-110 cl2">
									Rp. {{number_format(@$order->uniquePrice)}}
								</span>
                            </div>
                        </div>

                        <div class="flex-w flex-t p-t-27 p-b-33">
                            <div class="size-208">
								<span class="mtext-101 cl2">
									Total:
								</span>
                            </div>

                            <div class="size-209 p-t-1">
								<span class="mtext-110 cl2">
									Rp. {{number_format(@$order->totalPrice)}}
								</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

@endsection

@push('customJs')
    <script type="text/javascript">

        @if(session('error'))
        swal({
            title: 'System Error!',
            text: '{!! session('error') !!}',
            icon: "error",
        });
        @endif

        @if(session('success'))
        swal({
            title: 'Pesanan Berhasil!',
            text: '{!! session('success') !!}',
            icon: "success",
        });
        @endif

        function getCity(){
            $('.modal-loading').addClass('modal-loading-show');
            var prov = $("[name=provinceId]").val();
            $.ajax({
                url : '{{ url("getCity") }}/'+prov,
                type: "GET",
                dataType: "JSON",
                success: function(response)
                {
                    $('[name=cityId]').empty();

                    $('[name=cityId]').append(
                        $("<option></option>")
                            .attr("value","")
                            .text('Pilih Kota')
                    );

                    $.each(response, function(cityKey,cityValue) {
                        var currentCity = $("<option></option>")
                            .attr("value",cityValue.city_id)
                            .text(cityValue.type+' '+cityValue.city_name);

                        $('[name=cityId]').append(currentCity);
                    });

                    $('[name=cityId]').removeAttr('disabled');

                    $('.modal-loading').removeClass('modal-loading-show');
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    swal({
                        title: 'system error!',
                        text: errorThrown,
                        icon: "error",
                    });
                    $('.modal-loading').removeClass('modal-loading-show');
                }
            });
        }

        function validate(){
            $('.modal-loading').addClass('modal-loading-show');
            if($('[name=orderId]').val() == '' || $('[name=orderId]').val() == ' ' || $('[name=orderId]').val() == null){
                $('.modal-loading').removeClass('modal-loading-show');

                return swal({
                    title: 'Kode Pesanan Tidak ditemukan',
                    text : 'Periksa kembali email anda!',
                    icon: "error",
                });
            }

            var fillable = ['name','amount','accountNumber','bankName','day','month','year','file'];
            var errors = [];
            fillable.forEach(function(fill){
                if($('[name='+fill+']').val() == '' || $('[name='+fill+']').val() == ' '){
                    errors.push(fill);
                }
            });

            if(errors.length >0 ){
                var message = '';

                errors.forEach(function(error) {
                    message += error+' must be filled '+'<br/>';
                });

                $('.modal-loading').removeClass('modal-loading-show');

                return swal({
                    title: 'Data Tidak Benar',
                    text : errors.join(', ')+' must be filled!',
                    icon: "error",
                });
            }else{
                swal({
                    title: "Yakin Konfirmasi Pembayaran?",
                    text : "Data pembayaran akan disimpan, dan mengirim email",
                    icon: "warning",
                    buttons: {
                        cancel:true,
                        confirm: {
                            text:'Konfirmasi!',
                            closeModal: false,
                        },
                    },
                })
                .then((process) => {
                    if(process){
                        $.ajax({
                            url : '{{ route("saveConfirm") }}',
                            type: "POST",
                            data: new FormData($('#formConfirm')[0]),
                            dataType: "JSON",
                            processData: false,
                            contentType: false,
                            async:false,
                            success: function(response)
                            {
                                if(response.status){
                                    swal({
                                        title: 'KOnfirmasi Berhasil',
                                        text : response.message,
                                        icon: "success",
                                    });

                                    $('.modal-loading').removeClass('modal-loading-show');

                                    setTimeout(function(){
                                        location.href = '{{route('home')}}';
                                    }, 3000);
                                }else{
                                    var message = [];

                                    var error_arr = ['name','accountNumber','amount','bankName','file'];

                                    for(var i=0;i < error_arr.length;i++){
                                        if(error_arr[i] in response.error){
                                            message.push(response.error[error_arr[i]]);
                                        }
                                    }

                                    swal({
                                        title: 'Data Tidak Benar',
                                        text : message.join(' '),
                                        icon: "error",
                                    });

                                    $('.modal-loading').removeClass('modal-loading-show');
                                }
                            },
                            error: function (jqXHR, textStatus, errorThrown)
                            {
                                swal({
                                    title: 'system error!',
                                    text: errorThrown,
                                    icon: "error",
                                });
                                $('.modal-loading').removeClass('modal-loading-show');
                            }
                        });
                    }else{
                        $('.modal-loading').removeClass('modal-loading-show');
                        swal('Mohon periksa kembali');
                    }
                });
            }
        }
    </script>
@endpush