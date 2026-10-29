@extends('frontend.layouts.template')

@section('pageTitle','Keranjang Belanja')

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
				Keranjang Belanja
			</span>
        </div>
    </div>


    <!-- Shoping Cart -->
    <form action="{{route('saveCart')}}" id="formCheckout" method="post" class="bg0 p-t-75 p-b-85">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 col-xl-7 m-lr-auto m-b-50">
                    <div class="m-l-25 m-r--38 m-lr-0-xl">
                        <div class="wrap-table-shopping-cart">
                            <table class="table-shopping-cart">
                                <tr class="table_head">
                                    <th class="column-1">Produk</th>
                                    <th class="column-2"></th>
                                    <th class="column-3">Harga</th>
                                    <th class="column-4">Jumlah</th>
                                    <th class="column-5">Total</th>
                                </tr>
                            @php
                                $carts = Session::get('carts');
                                $countCart = count($carts);
                            @endphp
                            @if($countCart>0)
                                @foreach($carts as $key => $cart)
                                <tr class="table_row cartItem{{$cart['product']}}" id="cartItem{{$cart['product']}}">
                                    <input type="hidden" id="price{{$cart['product']}}" value="{{$cart['price']}}">
                                    <td class="column-1">
                                        <a href="javascript:;" onclick="removeCart({{$cart['product']}})" title="Hapus Item" alt="Hapus Item">
                                            <div class="how-itemcart1">
                                                <img src="{{$cart['image']}}" alt="{{ucwords($cart['name'])}}">
                                            </div>
                                        </a>
                                    </td>
                                    <td class="column-2">{{ucwords($cart['name'])}}</td>
                                    <td class="column-3">
                                        Rp. {{number_format($cart['price'])}}
                                    </td>
                                    <td class="column-4">
                                        <div class="wrap-num-product flex-w m-l-auto m-r-0">
                                            <div class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m" onclick="changeQty()">
                                                <i class="fs-16 zmdi zmdi-minus"></i>
                                            </div>

                                            <input class="mtext-104 cl3 txt-center num-product" type="number" name="num-product{{$cart['product']}}" value="{{$cart['qty']}}" max="{{$cart['stock']}}" min="1">

                                            <div class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m" onclick="changeQty()">
                                                <i class="fs-16 zmdi zmdi-plus"></i>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="column-5" id="total{{$cart['product']}}">Rp. {{number_format($cart['price']*$cart['qty'])}}</td>
                                </tr>
                                @endforeach
                            @else
                                <tr class="table_row" id="itemCart">
                                    <td class="column-1" colspan="4">
                                        <h5>Keranjang Kosong :(</h5>
                                    </td>
                                    <td class="column-5">
                                        <a href="{{route('product')}}">
                                        <div class="flex-c-m stext-101 cl2 size-119 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer m-tb-10">
                                            Belanja
                                        </div>
                                        </a>
                                    </td>
                                </tr>
                            @endif
                            </table>
                        </div>

                        <div class="flex-w flex-sb-m bor15 p-t-18 p-b-15 p-lr-40 p-lr-15-sm">
                            {{--<div class="flex-w flex-m m-r-20 m-tb-5">
                                <input class="stext-104 cl2 plh4 size-117 bor13 p-lr-20 m-r-10 m-tb-5" type="text" name="coupon" placeholder="Coupon Code">

                                <div class="flex-c-m stext-101 cl2 size-118 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer m-tb-5">
                                    Apply coupon
                                </div>
                            </div>--}}

                            <div class="flex-c-m stext-101 cl2 size-119 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer m-tb-10" id="updateCart" onclick="calculate()">
                                Update Keranjang
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
                                <input type="hidden" name="cartTotal" value="{{Session::get('totalCart')}}">
								<span class="mtext-110 cl2 cartTotal" id="cartTotal">
									Rp. {{number_format(Session::get('totalCart'))}}
								</span>
                            </div>
                        </div>

                        <div class="flex-w flex-t bor12 p-t-15 p-b-30">
                            <div class="size-208 w-full-ssm">
								<span class="stext-110 cl2">
									Pengiriman:
								</span>
                            </div>

                            <div class="size-209 p-r-18 p-r-0-sm w-full-ssm">
                                <input type="hidden" name="methodShipping">
                                <p class="stext-111 cl6 p-t-2" id="totalShipping">
                                    Pilih Metode Pengiriman
                                </p>

                                <div class="p-t-15">
									<span class="stext-112 cl8">
										Menghitung Pengiriman
									</span>

                                    <div class="rs1-select2 rs2-select2 bor8 bg0 m-b-12 m-t-9">
                                        <select class="js-select2" name="province" onchange="getCity()">
                                            <option value="">Pilih Provinsi</option>
                                            @foreach($province as $prov)
                                            <option value="{{$prov['province_id']}}">{{$prov['province']}}</option>
                                            @endforeach
                                        </select>
                                        <div class="dropDownSelect2"></div>
                                    </div>

                                    <div class="rs1-select2 rs2-select2 bor8 bg0 m-b-12 m-t-9">
                                        <select class="js-select2" name="city" disabled onchange="setCourier()">
                                            <option value="">Pilih Kota</option>
                                        </select>
                                        <div class="dropDownSelect2"></div>
                                    </div>

                                    <div class="rs1-select2 rs2-select2 bor8 bg0 m-b-12 m-t-9">
                                        <select class="js-select2" onchange="getShipping()" name="courier" disabled>
                                            <option value="">Pilih Kurir</option>
                                            @foreach(App\Util\Constant::COURIER as $key => $label)
                                            <option value="{{$key}}">{{$label}}</option>
                                            @endforeach
                                        </select>
                                        <div class="dropDownSelect2"></div>
                                    </div>

                                    <div class="rs1-select2 rs2-select2 bor8 bg0 m-b-12 m-t-9">
                                        <select class="js-select2" name="shipping" onchange="setShipping()" disabled>
                                            <option value="0">Pilih Pengiriman</option>
                                        </select>
                                        <div class="dropDownSelect2"></div>
                                    </div>

                                    {{csrf_field()}}

                                </div>
                            </div>
                        </div>

                        <div class="flex-w flex-t p-t-27 p-b-33">
                            <div class="size-208">
								<span class="mtext-101 cl2">
									Total:
								</span>
                            </div>

                            <div class="size-209 p-t-1">
								<span class="mtext-110 cl2" id="grandTotal">
									Rp. 0
								</span>
                            </div>
                        </div>

                        <button class="flex-c-m stext-101 cl0 size-116 bg3 bor14 hov-btn3 p-lr-15 trans-04" type="button" onclick="validate()">
                            PEMBAYARAN
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>

@endsection

@push('customJs')
    <script type="text/javascript">
        var updated = false;

        function getCity(){
            $('.modal-loading').addClass('modal-loading-show');
            var prov = $("[name=province]").val();
            $.ajax({
                url : '{{ url("getCity") }}/'+prov,
                type: "GET",
                dataType: "JSON",
                success: function(response)
                {
                    $('[name=city]').empty();

                    $('[name=city]').append(
                        $("<option></option>")
                            .attr("value","")
                            .text('Pilih Kota')
                    );

                    $.each(response, function(cityKey,cityValue) {
                        var currentCity = $("<option></option>")
                            .attr("value",cityValue.city_id)
                            .text(cityValue.type+' '+cityValue.city_name);

                        $('[name=city]').append(currentCity);
                    });

                    $('[name=city]').removeAttr('disabled');

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

        function getShipping(){
            if(updated){
                $('[name=courier]').val('');$('[name=courier] option:selected').text('Pilih Kurir');
                return swal({
                    title: 'Keranjang Belum Update!',
                    text: 'Mohon update keranjang anda',
                    icon: "error",
                });
            }

            $('.modal-loading').addClass('modal-loading-show');
            var city = $("[name=city]").val();var courier = $("[name=courier]").val();
            $.ajax({
                url : '{{ url("getCost") }}/'+city+'/'+courier,
                type: "GET",
                dataType: "JSON",
                success: function(response)
                {
                    $('[name=shipping]').empty();

                    $('[name=shipping]').append(
                        $("<option></option>")
                            .attr("value",0)
                            .text('Pilih Pengiriman')
                    );

                    $.each(response.costs, function(shippingKey,shipping) {
                        var shippingValue = shipping.cost;
                        var currentShipping = $("<option></option>")
                            .attr("value",shippingValue[0].value)
                            .text(shipping.description+' Rp. '+shippingValue[0].value+' ( '+shippingValue[0].etd+' ) Hari');

                        $('[name=shipping]').append(currentShipping);
                    });

                    $('[name=shipping]').removeAttr('disabled');

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

        function setShipping(){
            var method = $('[name=shipping] option:selected').text();
            $('#totalShipping').html(method);
            $('[name=methodShipping]').val(method);
            var grandTotal = parseFloat($('[name=shipping]').val()) + parseFloat($('[name=cartTotal]').val());
            $('#grandTotal').html('Rp. '+ parseFloat(grandTotal).toLocaleString());
        }

        function calculate(){
            $('.modal-loading').addClass('modal-loading-show');
            var subTotal = 0;
            var changed = [];
            for(i=0;i < countCart ;i++){
                var total = $('#price'+productList[i]).val() * $('[name=num-product'+productList[i]+']').val();
                $('#total'+productList[i]).html('Rp. ' +total.toLocaleString());
                subTotal = (parseFloat(subTotal ) + parseFloat(total));
                changed.push($('[name=num-product'+productList[i]+']').val());
            }

            $('.cartTotal').html('Rp. '+subTotal.toLocaleString());$('[name=cartTotal]').val(subTotal);

            $.ajax({
                url : '{{ url("updateCart") }}',
                type: "POST",
                data: {
                    changed :changed,
                    _token: '{{ csrf_token() }}'
                },
                dataType: "JSON",
                success: function(response)
                {
                    $('[name=shipping]').empty();

                    $('[name=courier]').val('');$('[name=courier] option:selected').text('Pilih Kurir');

                    $('#totalShipping').html('Pilih Metode Pengiriman');

                    $('[name=shipping]').append(
                        $("<option></option>")
                            .attr("value",0)
                            .text('Pilih Pengiriman')
                    );

                    $('[name=shipping]').attr('disabled');

                    updated = false;

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

        function setCourier(){
            $('[name=courier]').removeAttr('disabled');
        }

        function changeQty(){
            updated = true;

            $('#updateCart').removeAttr('disabled');
            $('[name=shipping]').empty();
            $('[name=shipping]').append(
                $("<option></option>")
                    .attr("value",0)
                    .text('Pilih Pengiriman')
            ).attr('disabled');

            $('[name=courier]').val('');$('[name=courier] option:selected').text('Pilih Kurir');
            $('#totalShipping').html('Pilih Metode Pengiriman');
        }

        function validate(){
            if($('[name=shipping]').val()>0){
                $('#formCheckout').submit();
            }else{
                swal({
                    title: 'Gagal Lanjut Pembayaran!',
                    text: 'Metode Pengiriman Belum Dipilih!',
                    icon: "error",
                });
            }
        }

        function check() {
            var data = [];
            console.log(data);
            console.log(countCart);
        }
    </script>
@endpush