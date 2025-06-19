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

            <a href="{{route('cart')}}" class="stext-109 cl8 hov-cl1 trans-04">
                Keranjang Belanja
                <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
            </a>

            <span class="stext-109 cl4">
				Pembayaran
			</span>
        </div>
    </div>


    <!-- Shoping Cart -->
    <form action="{{route('checkout')}}" id="formCheckout" method="post" class="bg0 p-t-75 p-b-85">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 col-xl-7 m-lr-auto m-b-50">
                    <div class="m-l-25 m-r--38 m-lr-0-xl">
                        <div class="bor10 p-lr-40 p-t-30 p-b-40 m-l-63 m-r-40 m-lr-0-xl p-lr-15-sm">
                            <h4 class="mtext-109 cl2 p-b-30">
                                Informasi Personal
                            </h4>

                            {{csrf_field()}}

                            <div class="bor8 bg0 m-b-12">
                                <input class="stext-111 cl8 plh3 size-111 p-lr-15" type="text" required name="name" value="{{@\Auth::user()->name}}" placeholder="Nama Lengkap">
                            </div>
                            <div class="bor8 bg0 m-b-12">
                                <input class="stext-111 cl8 plh3 size-111 p-lr-15" type="email" name="email" value="{{@\Auth::user()->email}}" placeholder="Email">
                            </div>
                            <div class="bor8 bg0 m-b-12">
                                <input class="stext-111 cl8 plh3 size-111 p-lr-15" name="phone" value="{{@\Auth::user()->phone}}" placeholder="Telepon">
                            </div>
                        </div>

                        <div class="bor10 p-lr-40 p-t-30 p-b-40 m-t-50 m-l-63 m-r-40 m-lr-0-xl p-lr-15-sm">
                            <h4 class="mtext-109 cl2 p-b-30">
                                Alamat Pengiriman
                            </h4>

                            <div class="rs1-select2 rs2-select2 bor8 bg0 m-b-12 m-t-9">
                                <select class="js-select2" name="provinceId" onchange="getKabupaten()">
                                    <option value="">Pilih Provinsi</option>
                                    @foreach($province as $prov)
                                        <option value="{{$prov->id}}" {{@\Auth::user()->provinceId == $prov->id?'selected':''}}>{{$prov->nama}}</option>
                                    @endforeach
                                </select>
                                <div class="dropDownSelect2"></div>
                            </div>
                            <div class="rs1-select2 rs2-select2 bor8 bg0 m-b-12 m-t-9">
                                <select class="js-select2" name="cityId"  onchange="getKecamatan()">
                                    <option value="">Pilih Kota/Kabupaten</option>
                                    @if(!empty(\Auth::user()->provinsi))
                                    @foreach(\Auth::user()->provinsi->kabupaten as $kab)
                                    <option value="{{$kab->id}}" {{$kab->id==\Auth::user()->cityId?'selected':''}}>{{$kab->nama}}</option>
                                    @endforeach
                                    @endif
                                </select>
                                <div class="dropDownSelect2"></div>
                            </div>
                            <div class="rs1-select2 rs2-select2 bor8 bg0 m-b-12 m-t-9">
                                <select class="js-select2" name="districtId">
                                    <option value="">Pilih Kecamatan</option>
                                    @if(!empty(\Auth::user()->kabupaten))
                                    @foreach(\Auth::user()->kabupaten->kecamatan as $kec)
                                    <option value="{{$kec->id}}" {{$kec->id==\Auth::user()->districtId?'selected':''}}>{{$kec->nama}}</option>
                                    @endforeach
                                    @endif
                                </select>
                                <div class="dropDownSelect2"></div>
                            </div>

                            <div class="bor8 bg0 m-b-12">
                                <input class="stext-111 cl8 plh3 size-111 p-lr-15" type="text" name="subdistrict" value="{{@\Auth::user()->subdistrict}}" placeholder="Kelurahan / Desa">
                            </div>

                            <div class="bor8 bg0 m-b-12">
                                <input class="stext-111 cl8 plh3 size-111 p-lr-15" type="number" name="postcode" value="{{@\Auth::user()->postcode}}" placeholder="Kode Pos">
                            </div>

                            <div class="bor8 bg0 m-b-12">
                                <textarea class="stext-111 cl8 plh3 size-111 p-lr-15" name="address" placeholder="Alamat Lengkap" style="height: 100px;">{{@\Auth::user()->address}}</textarea>
                            </div>
                        </div>

                        <div class="bor10 p-lr-40 p-t-30 p-b-40 m-l-63 m-r-40 m-lr-0-xl m-t-15 p-lr-15-sm">
                            <h4 class="mtext-109 cl2 p-b-30">
                                Catatan
                            </h4>

                            <div class="bor8 bg0 m-b-12">
                                <textarea class="stext-111 cl8 plh3 size-111 p-lr-15" name="note" placeholder="Catatan Pesanan. Contoh : Ukuran,Warna,Dan Lainnya" style="height: 100px;"></textarea>
                            </div>
                        </div>

                        <div class="flex-w flex-sb-m p-t-18 p-b-15 p-lr-40 p-lr-15-sm" style="float: right">
                            <a href="{{route('cart')}}">
                                <div class="flex-c-m stext-101 cl2 size-119 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer m-tb-10">
                                    Keranjang Belanja
                                </div>
                            </a>
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
									Rp. {{number_format($totalCart)}}
								</span>
                            </div>
                        </div>

                        <div class="flex-w flex-t bor12 p-b-13">
                            <div class="size-208">
								<span class="stext-110 cl2">
									Shipping:
								</span>
                            </div>

                            <div class="size-209">
								<span class="mtext-110 cl2">
									Rp. {{number_format($shipping['total'])}}
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
									Rp. {{number_format($totalCart+$shipping['total'])}}
								</span>
                            </div>
                        </div>

                        <button class="flex-c-m stext-101 cl0 size-116 bg3 bor14 hov-btn3 p-lr-15 trans-04 pointer" type="button" onclick="validate()">
                            KONFIRMASI
                        </button>
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

        function getKabupaten(){
            $('.modal-loading').addClass('modal-loading-show');
            var prov = $("[name=provinceId]").val();
            $.ajax({
                url : '{{ url("getKabupaten") }}/'+prov,
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
                            .attr("value",cityValue.id)
                            .text(cityValue.nama);

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

        function getKecamatan(){
            $('.modal-loading').addClass('modal-loading-show');
            var kab = $("[name=cityId]").val();
            $.ajax({
                url : '{{ url("getKecamatan") }}/'+kab,
                type: "GET",
                dataType: "JSON",
                success: function(response)
                {
                    $('[name=districtId]').empty();

                    $('[name=districtId]').append(
                        $("<option></option>")
                            .attr("value","")
                            .text('Pilih Kecamatan')
                    );

                    $.each(response, function(districtKey,districtValue) {
                        var currentDistrict = $("<option></option>")
                            .attr("value",districtValue.id)
                            .text(districtValue.nama);

                        $('[name=districtId]').append(currentDistrict);
                    });

                    $('[name=districtId]').removeAttr('disabled');

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
            var fillable = ['name','email','phone','province','city','district','postcode','address'];
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

                return swal({
                    title: 'Data Tidak Benar',
                    text : errors.join(', ')+' must be filled!',
                    icon: "error",
                });
            }else{
                $('#formCheckout').submit();
            }
        }
    </script>
@endpush