@extends('backend.layouts.template')

@section('pageTitle','Detail Order')

@push('customCss')
    <style>
        .required-form:after { content:" *"; color:#ff3358 }
    </style>
@endpush

@section('content')
    <!-- BEGIN CONTENT -->
    <div class="page-content-wrapper">
        <!-- BEGIN CONTENT BODY -->
        <div class="page-content">
            <!-- BEGIN PAGE HEADER-->
            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li><a href="{{route('admin.dashboard')}}">Dashboard</a> <i class="fa fa-circle"></i></li>
                    <li><a href="{{route('admin.orders')}}">Pesanan</a> <i class="fa fa-circle"></i></li>
                    <li><span>Detail Pesanan</span></li>
                </ul>
            </div>
            <!-- END PAGE HEADER-->
            <div class="row">
                <form href="#" id="formData" method="POST" >

                    {{ csrf_field() }}

                    <input name="id" type="hidden" value="{{ @$model->id }}">

                    <div class="col-md-12">
                        <div class="portlet blue box margin-top-20">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="icon-share "></i>
                                    <span class="caption-subject bold uppercase">Data Pesanan</span>
                                </div>
                                <div class="actions">
                                    @if( empty(@$model->status) || (@$model->status == \App\Util\Constant::ORDER_STATUS_NEW || @$model->status == \App\Util\Constant::ORDER_STATUS_PAYMENT_COMPLETE))
                                    <button type="button" class="btn btn-primary" onclick="save()">Simpan</button>
                                    @endif
                                    <a href="{{route('admin.orders')}}" class="btn default" >Kembali</a>
                                </div>

                            </div>
                            <div class="portlet-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        @include('backend.order.detail-part.customer')
                                    </div>
                                    <div class="col-md-6">
                                        @include('backend.order.detail-part.fee')
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-8">
                                        @include('backend.order.detail-part.item')
                                    </div>
                                    <div class="col-md-4">
                                        @include('backend.order.detail-part.payment')
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </form>
            </div>
            <!-- page content -->
        </div>
        <!-- END CONTENT BODY -->
    </div>
    <!-- END CONTENT -->

@endsection

@push('customJs')
    <link href="http://code.jquery.com/ui/1.10.2/themes/smoothness/jquery-ui.css" rel="Stylesheet"></link>

    <script>

        var grand_total = 0;
        var total_item = 0;

        @if(!empty(@$model->id))
        AutoNumeric.set('[name=design_fee]','{{ @$model->design_fee }}');
        AutoNumeric.set('[name=finishing_fee]','{{ @$model->design_fee }}');
        AutoNumeric.set('[name=down_payment]','{{ @$model->down_payment }}');
        AutoNumeric.set('[name=total_payment]','{{ @$model->total_payment }}');
        @endif

        function calculate(){
            var design_fee = parseInt($('[name=design_fee]').val().replace(/[^\d,-]/g,''),0);
            var finishing_fee = parseInt($('[name=finishing_fee]').val().replace(/[^\d,-]/g,''),0);

            grand_total = (design_fee ? design_fee : 0) + (finishing_fee ? finishing_fee : 0) + total_item;

            $('[name=grand_total]').val(grand_total);
            $('#grand_total').html('Rp. '+parseInt(grand_total,0).toLocaleString('de-DE'));

            @if(\Auth::user()->role == \App\Util\Constant::USER_ROLE_CASHIER || \Auth::user()->role == \App\Util\Constant::USER_ROLE_ADMIN)
            var down_payment = parseInt($('[name=down_payment]').val().replace(/[^\d,-]/g,''),0);
            var total_payment = grand_total - down_payment;
            AutoNumeric.set('[name=total_payment]',total_payment);
            @endif
        }

        function save(){
            $('.form-group').removeClass('has-error');
            $('.help-block-error').html('');

            if($('[name=items]').val() == "null" || $('[name=items]').val() == "[]" || $('[name=items]').val() == ""){
                swal({
                    title: 'Periksa Data Kembali',
                    text: 'Minimal masukan satu item',
                    icon: 'error',
                    timer: '3000'
                });
                return;
            }

            swal({
                title: "Yakin Simpan Data?",
                text : "Data akan disimpan",
                icon: "warning",
                buttons: {
                    cancel:true,
                    confirm: {
                        text:'Simpan!',
                        closeModal: false,
                    },
                },
            })
                .then((process) => {
                    if(process){
                        $('.form-group').removeClass('has-error');
                        $('.help-block-error').html('');

                        $.ajax({
                            url: "{{ route('admin.order.save') }}",
                            type: "POST",
                            data: new FormData($("#formData")[0]),
                            processData: false,
                            contentType: false,
                            async:false,
                            success: function(response) {
                                if(response.status){
                                    swal({
                                        title: 'Berhasil Simpan Data',
                                        text: response.message,
                                        icon: 'success',
                                        timer: '3000'
                                    }).then((done)=>{
                                        location.href = '{{route("admin.orders")}}';
                                    });
                                }else{
                                    swal({
                                        title: 'Gagal Simpan Data',
                                        text: response.message,
                                        icon: 'error',
                                        timer: '3000'
                                    });
                                    var error_arr = [];

                                    @foreach($model::FORM_VALIDATION as $validationKey => $validationVal)
                                    error_arr.push('{{ $validationKey }}');
                                    @endforeach

                                    for(var i=0;i < error_arr.length;i++){
                                        if(error_arr[i] in response.error){
                                            $('#'+error_arr[i]).addClass('has-error');
                                            $('#'+error_arr[i]+'_error').html(response.error[error_arr[i]]);
                                        }
                                    }
                                }
                            },
                            error: function(jqXHR, textStatus, errorThrown){
                                swal({
                                    title: 'System Error',
                                    text: errorThrown,
                                    icon: 'error',
                                    timer: '3000'
                                });
                            }
                        });
                    }else{
                        swal('Data tidak jadi disimpan');
                    }
                });
        }
    </script>

    <script type="text/javascript">
        var dataItem = {!! !empty(@$model->items) ? json_encode(@$model->items) : '[]' !!};
        var currentIndex = dataItem.length > 0 ? dataItem.length : 1;
        var priceTypes = {!! json_encode(\App\Util\Constant::PRODUCT_TYPE_PRICE_LIST) !!};

        dataItem.forEach(function (data,index) {
            var no = (index+1);
            currentIndex++;
            var row = '<tr id="ds_'+no+'">\n' +
                '                    <td style="text-align: center">'+data.product.name + ' - ' + (data.remark ? data.remark : '') + ' ('+priceTypes[data.product_type]+')' + '</td>\n' +
                '                    <td style="text-align: center">\n' +
                '                      '+parseFloat(data.qty,0).toLocaleString('de-DE')+'\n' +
                '                    </td>\n' +
                '                    <td style="text-align: center">\n' +
                '                      '+parseInt(data.price,0).toLocaleString('de-DE')+'\n' +
                '                    </td>\n' +
                '                    <td style="text-align: center">\n' +
                '                      '+parseInt(data.total_price,0).toLocaleString('de-DE')+'\n' +
                '                    </td>\n' +
                '                    <td style="text-align: center">\n' +
                '                      <button class="btn btn-sm btn-warning" onclick="deleteItem('+no+')" type="button"><i class="fa fa-trash"></i></button>\n' +
                '                    </td>\n' +
                '                  </tr>';

            calculateTotalItem(parseInt(data.price,0) * parseFloat(data.qty,0));

            $('#listItem').append(row);
        });

        function addItem(id) {
            $('#myModal').modal('show');
            $('.modal-title').text('Tambah Item');
        }

        function saveItem() {
            if($('[name=product0]').val() == '' || $('[name=price0]').val() == '' || $('[name=qty0]').val() == ''){
                $('#myModal').modal('hide');
                return swal({
                    title: 'Gagal Simpan Data',
                    text: 'Produk, Harga dan Qty tidak boleh kosong!',
                    icon: 'error',
                    timer: '3000'
                });
            }
            var product = JSON.parse($('[name=product0]').val());
            var price = JSON.parse($('[name=price0]').val());
            var qty = $('[name=qty0]').val();
            var total = parseInt(price.price,0) * parseFloat(qty,0);
            var total_hpp = parseInt(price.hpp,0) * parseFloat(qty,0);

            calculateTotalItem(total);

            var row = '<tr id="ds_'+currentIndex+'">\n' +
                '                    <td style="text-align: center">'+product.name+ ' - ' + ( price.remark ? price.remark : '') + ' ('+priceTypes[price.types]+')' +'</td>\n' +
                '                    <td style="text-align: center">\n' +
                '                      '+parseFloat(qty).toLocaleString('de-De')+'\n' +
                '                    </td>\n' +
                '                    <td style="text-align: center">\n' +
                '                      '+parseInt(price.price).toLocaleString('de-De')+'\n' +
                '                    </td>\n' +
                '                    <td style="text-align: center">\n' +
                '                      '+total.toLocaleString('de-De')+'\n' +
                '                    </td>\n' +
                '                    <td style="text-align: center">\n' +
                '                      <button class="btn btn-sm btn-warning" onclick="deleteItem('+currentIndex+')" type="button"><i class="fa fa-trash"></i></button>\n' +
                '                    </td>\n' +
                '                  </tr>';
            $('#listItem').append(row);

            dataItem.push({
                product_id: product.id,
                remark: price.remark,
                product_type: price.types,
                qty: qty,
                price: price.price,
                hpp: price.hpp,
                total_price: total,
                total_hpp: total_hpp,
            });

            currentIndex++;

            resetItem(0)

            $('[name=items]').val(JSON.stringify(dataItem));

            $('#myModal').modal('hide');
        }

        function resetItem(id) {
            $('[name=category'+id+']').val('');
            $('[name=product'+id+']').val('');
            $('[name=qty'+id+']').val(0);
            $('[name=price'+id+']').val('');
            $('[name=product0]').empty();
            $('[name=price0]').empty();
        }

        function deleteItem(id) {
            $('#ds_'+id).remove();
            var total = parseInt(dataItem[id-1].total_price,0);
            calculateTotalItem(-total);
            dataItem.splice(id-1,1);
            $('[name=items]').val(JSON.stringify(dataItem));
        }

        function setProduct() {
            if($('[name=category0]').val() =='') return $('[name=product0]').empty().append('<option value="">Pilih Produk</option>');
            $('[name=product0]').empty().append('<option value="">Pilih Produk</option>');
            $('[name=category0] option:selected').data('object').products.forEach(function(product){
                $('[name=product0]').append("<option value='"+JSON.stringify(product)+"' data-object='"+JSON.stringify(product)+"'>"+product.name+"</option>");
            });
        }

        function setPrice() {
            if($('[name=product0]').val() =='') return $('[name=price0]').empty().append('<option value="">Pilih Harga</option>');
            $('[name=price0]').empty().append('<option value="">Pilih Harga</option>');
            $('[name=product0] option:selected').data('object').variants.forEach(function(price){
                $('[name=price0]').append("<option value='"+JSON.stringify(price)+"'>Rp. "+parseInt(price.price,0).toLocaleString('de-DE') + " - " + price.remark + " ("+priceTypes[price.types]+")" + "</option>");
            });
        }

        function calculateTotalItem(amount){
            total_item = parseInt(total_item,0) + parseInt(amount,0);
            calculate();
        }

        function calculateQty(){
            var width = parseFloat($('[name=width0]').val());
            var height = parseFloat($('[name=height0]').val());
            $('[name=qty0]').val(width*height);
        }

        $('#search_phone').on('change', function () {
           $('[name=phone]').val($('#search_phone').val());
        });

        $("#search_phone").autocomplete({
            source: function(request, response) {

                // Suggest URL
                var suggestURL = "{{ url('admin/memberSearch/%QUERY') }}";
                suggestURL = suggestURL.replace('%QUERY', request.term);

                // JSONP Request
                $.ajax({
                    method: 'GET',
                    dataType: 'JSON',
                    // jsonpCallback: 'jsonCallback',
                    url: suggestURL,
                    success:function (data) {
                        response($.map(data, function (item) {
                            return {
                                label: item.phone + ' (' + item.name + ')',
                                name: item.name,
                                email: item.email,
                                address: item.address,
                                uid: item.phone
                            }
                        }));
                    },
                });
            }
        });

        $( "#search_phone" ).on( "autocompleteselect", function( event, ui ) {
            $("[name=phone]").val(ui.item.uid);
            $("[name=name]").val(ui.item.name);
            $("[name=email]").val(ui.item.email);
            $("[name=address]").val(ui.item.address);
            $("#search_phone").val(ui.item.label);
            event.preventDefault();
        } );
    </script>
@endpush
