<div class="portlet blue-madison box">
    <div class="portlet-title">
        <div class="caption">
            <span class="caption-subject bold uppercase">Pelanggan</span>
        </div>
    </div>

    <div class="portlet-body">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group" id="phone">
                            <label class="control-label">Telepon</label>
                            <input type="text" id="search_phone" name="search_phone" placeholder="Ketik Nomor telepon atau nama" class="form-control" value="{{ !empty(@$model->member) ? @$model->member->phone.' ('.@$model->member->name.')' : '' }}"/>
                            <input type="hidden" name="phone" value="{{ @$model->member->phone }}" class="form-control" />
                            <div class="help-block"></div>
                            <div id="phone_error" class="help-block help-block-error"> </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group" id="name">
                            <label class="control-label required-form">Nama</label>
                            <input type="text" name="name" class="form-control" value="{{ !empty(@$model->member->name) ? @$model->member->name : @$model->tmp_name }}" placeholder="Nama">
                            <div class="help-block"></div>
                            <div id="name_error" class="help-block help-block-error"> </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group" id="email">
                            <label class="control-label">Email</label>
                            <input type="email" name="email" class="form-control" value="{{ @$model->member->email }}" placeholder="Email">
                            <div class="help-block"></div>
                            <div id="email_error" class="help-block help-block-error"> </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group" id="address">
                            <label class="control-label">Alamat</label>
                            <textarea name="address" class="form-control" placeholder="Alamat">{{ @$model->member->address }}</textarea>
                            <div class="help-block"></div>
                            <div id="address_error" class="help-block help-block-error"> </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
