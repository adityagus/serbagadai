<div class="portlet blue-madison box">
    <div class="portlet-title">
        <div class="caption">
            <span class="caption-subject bold uppercase">Informasi Harga</span>
        </div>
    </div>

    <div class="portlet-body">
        <div class="row">
            <div id="add">
                <div class="row">
                    <div class="col-sm-6" style="margin-bottom: 20px;padding-left: 31px;">
                        <button class="btn btn-sm btn-success" type="button" onclick="addPrice(0)">Tambah Harga</button>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <table class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th style="text-align: center">Harga</th>
                            <th style="text-align: center">Modal</th>
                            <th style="text-align: center">Tipe</th>
                            <th style="text-align: center">Keterangan</th>
                            <th style="text-align: center">Aksi</th>
                        </tr>
                        </thead>
                        <tbody id="listPrice"></tbody>
                        <input type="hidden" name="prices" value="{{ json_encode(@$model->variants) }}">
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body">
                <div id="add">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label class="control-label col-sm-12" for="price">Harga</label>
                            <div class="col-sm-12" id="price0">
                                <input type="number text" class="form-control autonumeric" name="price0" placeholder="Harga">
                                <div id="price0_error" class="help-block help-block-error"> </div>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="control-label col-sm-12" for="hpp">HPP</label>
                            <div class="col-sm-12" id="hpp0">
                                <input type="text" class="form-control autonumeric" name="hpp0" placeholder="Hpp">
                                <div id="hpp0_error" class="help-block help-block-error"> </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label class="control-label col-sm-12" for="types">Tipe</label>
                            <div class="col-sm-12" id="types0">
                                <select name="types0" class="form-control">
                                    <option value="">Pilih</option>
                                    @foreach($types as $type => $val)
                                        <option value="{{ $type }}">{{ $val }}</option>
                                    @endforeach
                                </select>
                                <div id="types0_error" class="help-block help-block-error"> </div>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="control-label col-sm-12" for="remark">Keterangan</label>
                            <div class="col-sm-12" id="remark0">
                                <input type="text" class="form-control" name="remark0" placeholder="Keterangan">
                                <div id="remark0_error" class="help-block help-block-error"> </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" onclick="savePrice(0)" class="btn btn-primary">Simpan</button>
                <button type="button" class="btn btn-default" onclick="resetPrice(0)" data-dismiss="modal">Batal</button>
            </div>
        </div>

    </div>
</div>
<!-- End Modal -->


@push('customJs')
    <script type="text/javascript">
        var dataPrice = {!! !empty(@$model->variants) ? json_encode(@$model->variants) : '[]' !!};
        var currentIndex = dataPrice.length > 0 ? dataPrice.length : 1;
        var priceTypes = {!! json_encode(\App\Util\Constant::PRODUCT_TYPE_PRICE_LIST) !!};

        dataPrice.forEach(function (data,index) {
            var no = (index+1);
            currentIndex++;
            var row = '<tr id="ds_'+no+'">\n' +
                '                    <td style="text-align: center">'+parseInt(data.price,0).toLocaleString('de-De')+'</td>\n' +
                '                    <td style="text-align: center">\n' +
                '                      '+parseInt(data.hpp,0).toLocaleString('de-De')+'\n' +
                '                    </td>\n' +
                '                    <td style="text-align: center">\n' + priceTypes[data.types] +'</td>\n' +
                '                    <td style="text-align: center">\n' +
                '                      '+data.remark+'\n' +
                '                    </td>\n' +
                '                    <td style="text-align: center">\n' +
                '                      <button class="btn btn-sm btn-warning" onclick="deletePrice('+no+')" type="button"><i class="fa fa-trash"></i></button>\n' +
                '                    </td>\n' +
                '                  </tr>';
            $('#listPrice').append(row);
        });

        function addPrice(id) {
            $('#myModal').modal('show');
            $('.modal-title').text('Tambah Harga');
        }

        function savePrice() {
            if($('[name=price0]').val() == '' || $('[name=hpp0]').val() == '' || $('[name=types0]').val() == ''){
                $('#myModal').modal('hide');
                return swal({
                    title: 'Gagal Simpan Data',
                    text: 'Harga, tipe dan hpp tidak boleh kosong!',
                    icon: 'error',
                    timer: '3000'
                });
            }
            var row = '<tr id="ds_'+currentIndex+'">\n' +
                '                    <td style="text-align: center">'+$('[name=price0]').val().toLocaleString('de-De')+'</td>\n' +
                '                    <td style="text-align: center">\n' +
                '                      '+$('[name=hpp0]').val().toLocaleString('de-De')+'\n' +
                '                    </td>\n' +
                '                    <td style="text-align: center">\n' + priceTypes[$('[name=types0]').val()] +'</td>\n' +
                '                    <td style="text-align: center">\n' +
                '                      '+$('[name=remark0]').val()+'\n' +
                '                    </td>\n' +
                '                    <td style="text-align: center">\n' +
                '                      <button class="btn btn-sm btn-warning" onclick="deletePrice('+currentIndex+')" type="button"><i class="fa fa-trash"></i></button>\n' +
                '                    </td>\n' +
                '                  </tr>';
            $('#listPrice').append(row);

            dataPrice.push({
                price: $('[name=price0]').val(),
                hpp: $('[name=hpp0]').val(),
                types: $('[name=types0]').val(),
                remark: $('[name=remark0]').val(),
            });

            currentIndex++;

            $('[name=price0]').val('');
            $('[name=hpp0]').val('');
            $('[name=types0]').val('');
            $('[name=remark0]').val('');

            $('[name=prices]').val(JSON.stringify(dataPrice));

            $('#myModal').modal('hide');
        }

        function resetPrice(id) {
            $('[name=price'+id+']').val('');
            $('[name=hpp'+id+']').val('');
            $('[name=types'+id+']').val('');
            $('[name=remark'+id+']').val('');
        }

        function deletePrice(id) {
            $('#ds_'+id).remove();
            dataPrice.splice(id-1,1);
            $('[name=prices]').val(JSON.stringify(dataPrice));
        }
    </script>
@endpush
