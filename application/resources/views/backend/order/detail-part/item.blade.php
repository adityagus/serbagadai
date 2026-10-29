<div class="portlet blue-madison box">
    <div class="portlet-title">
        <div class="caption">
            <span class="caption-subject bold uppercase">Daftar Item</span>
        </div>
    </div>

    <div class="portlet-body">
        <div class="row">
            <div id="add">
                <div class="row">
                    <div class="col-sm-6" style="margin-bottom: 20px;padding-left: 31px;">
                        @if( empty(@$model->status) || (@$model->status == \App\Util\Constant::ORDER_STATUS_NEW || @$model->status == \App\Util\Constant::ORDER_STATUS_PAYMENT_COMPLETE))
                        <button class="btn btn-sm btn-success" type="button" onclick="addItem(0)">Tambah Item</button>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <table class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th style="text-align: center">Produk</th>
                            <th style="text-align: center">Qty</th>
                            <th style="text-align: center">Harga</th>
                            <th style="text-align: center">Total</th>
                            <th style="text-align: center">Aksi</th>
                        </tr>
                        </thead>
                        <tbody id="listItem"></tbody>
                        <input type="hidden" name="items" value="{{ @$model->items }}">
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
                            <label class="control-label col-sm-12" for="category">Kategori</label>
                            <div class="col-sm-12" id="category0">
                                <select name="category0" class="form-control" onchange="setProduct()">
                                    <option value="">Pilih Kategori</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" data-object="{{ $category }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                <div id="category0_error" class="help-block help-block-error"> </div>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="control-label col-sm-12" for="types">Produk</label>
                            <div class="col-sm-12" id="product0">
                                <select name="product0" class="form-control" onchange="setPrice()">
                                    <option value="">Pilih Produk</option>
                                </select>
                                <div id="product0_error" class="help-block help-block-error"> </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label class="control-label col-sm-12" for="price">Harga</label>
                            <div class="col-sm-12" id="price0">
                                <select name="price0" class="form-control">
                                    <option value="">Pilih</option>
                                </select>
                                <div id="price0_error" class="help-block help-block-error"> </div>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="control-label col-sm-12" for="qty">Jumlah</label>
                            <div class="col-sm-12" id="qty0">
                                <input type="text" class="form-control" name="qty0" placeholder="Jumlah">
                                <div id="qty0_error" class="help-block help-block-error"> </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label class="control-label col-sm-12" for="width">Panjang</label>
                            <div class="col-sm-12" id="width0">
                                <input type="text" class="form-control" name="width0" onchange="calculateQty()" placeholder="Panjang">
                                <div id="width0_error" class="help-block help-block-error"> (Optional) untuk menghitung jumlah</div>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="control-label col-sm-12" for="height">Lebar</label>
                            <div class="col-sm-12" id="height0">
                                <input type="text" class="form-control" onchange="calculateQty()" name="height0" placeholder="Lebar">
                                <div id="height0_error" class="help-block help-block-error"> (Optional) untuk menghitung jumlah</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" onclick="saveItem(0)" class="btn btn-primary">Simpan</button>
                <button type="button" class="btn btn-default" onclick="resetItem(0)" data-dismiss="modal">Batal</button>
            </div>
        </div>

    </div>
</div>
<!-- End Modal -->

