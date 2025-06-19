<!-- Modal -->
<div class="modal fade" id="machineModal" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body">
                <form id="form-invoice" class="form-horizontal" action="#" method="post" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <input type="hidden" name="id" id="id" value="0">
                    <div class="form-group" id="code">
                        <label class="control-label col-sm-2" for="name">Kode Pesanan</label>
                        <div class="col-sm-10">
                            <input type="text" name="code" class="form-control" readonly>
                            <div id="code_error" class="help-block help-block-error"> </div>
                        </div>
                    </div>
                    <div class="form-group" id="remark">
                        <label class="control-label col-sm-2" for="remark">Keterangan</label>
                        <div class="col-sm-10">
                            <textarea name="remark" class="form-control"></textarea>
                            <div id="remark_error" class="help-block help-block-error"> </div>
                        </div>
                    </div>
                    <div class="form-group" id="machine_id">
                        <label class="control-label col-sm-2" for="machine_id">Mesin</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="machine_id">
                                @foreach(\App\Helpers\SelectHelper::getSelectList('getMachineList') as $key => $val)
                                    <option value="{{ $key }}">{{ $val }}</option>
                                @endforeach
                            </select>
                            <div id="machine_id_error" class="help-block help-block-error"> </div>
                        </div>
                    </div>
                    <input type="hidden" name="status" value="{{ \App\Util\Constant::ORDER_STATUS_PROGRESS }}">
                </form>
            </div>
            <div class="modal-footer">
                <button id="submit" type="button" onclick="setProgress()" class="btn btn-primary">Simpan</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
            </div>
        </div>

    </div>
</div>
<!-- End Modal -->
