<div class="portlet blue-madison box">
    <div class="portlet-title">
        <div class="caption">
            <span class="caption-subject bold uppercase">Pembayaran</span>
        </div>
    </div>

    <div class="portlet-body">
        <div class="row">
            <div class="col-md-12">
                <div class="col-md-12">
                    <div class="form-group" id="total_payment">
                        <label class="control-label">Total Harga</label><br>
                        <span class="text-danger bold" style="font-size: 26px" id="grand_total">Rp. 0</span>
                        <input type="hidden" name="grand_total" class="form-control" value="{{ @$model->grand_total }}">
                    </div>
                </div>
                @if(\Auth::user()->role == \App\Util\Constant::USER_ROLE_CASHIER || \Auth::user()->role == \App\Util\Constant::USER_ROLE_ADMIN)
                <div class="col-md-12">
                    <div class="form-group" id="down_payment">
                        <label class="control-label">Jumlah Bayar</label>
                        <input type="text" name="down_payment" class="form-control autonumeric" onchange="calculate()" value="{{ @$model->down_payment }}">
                        <div class="help-block"></div>
                        <div id="down_payment_error" class="help-block help-block-error"> </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group" id="total_payment">
                        <label class="control-label">Sisa Bayar</label>
                        <input type="text" name="total_payment" readonly class="form-control autonumeric" value="{{ @$model->total_payment }}">
                        <div class="help-block"></div>
                        <div id="total_payment_error" class="help-block help-block-error"> </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group" id="payment_method">
                        <label class="control-label">Metode Pembayaran</label>
                        <select name="payment_method" class="form-control">
                            <option value="">Pilih Status</option>
                            @foreach(\App\Util\Constant::PAYMENT_METHOD_LIST as $key => $val)
                                <option value="{{ $key }}" {{ @$model->payment_method == $key ? 'selected' : '' }}>{{ $val }}</option>
                            @endforeach
                        </select>
                        <div class="help-block"></div>
                        <div id="payment_method_error" class="help-block help-block-error"> </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group" id="payment_status">
                        <label class="control-label">Status Pembayaran</label>
                        <select name="payment_status" class="form-control">
                            <option value="">Pilih Status</option>
                            @foreach(\App\Util\Constant::STATUS_PAYMENT_LIST as $key => $val)
                                <option value="{{ $key }}" {{ @$model->payment_status == $key ? 'selected' : '' }}>{{ $val }}</option>
                            @endforeach
                        </select>
                        <div class="help-block"></div>
                        <div id="payment_status_error" class="help-block help-block-error"> </div>
                    </div>
                </div>
                @endif
                <div class="col-md-12">
                    <div class="form-group" id="remark">
                        <label class="control-label">Catatan</label>
                        <textarea name="remark" class="form-control" placeholder="Catatan">{{ @$model->remark }}</textarea>
                        <div class="help-block"></div>
                        <div id="remark_error" class="help-block help-block-error"> </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
