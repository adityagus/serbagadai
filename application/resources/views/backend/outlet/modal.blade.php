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
          <form id="form-invoice" class="form-horizontal" action="#" method="post" enctype="multipart/form-data">
            {{csrf_field()}}
            <input type="hidden" name="id" id="id" value="0">
            <input type="hidden" name="method" id="method">
            <div class="form-group" id="name">
              <label class="control-label col-sm-2" for="name">Nama</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="name" placeholder="Masukan Nama" required = "true">
                <div id="name_error" class="help-block help-block-error"> </div>
              </div>
            </div>
            <div class="form-group" id="province_id">
              <label class="control-label col-sm-2" for="province_id">Provinsi</label>
              <div class="col-sm-10">
                <select class="form-control" name="province_id">
                  <option value="">Pilih Provinsi</option>
                  @foreach($provinces as $item)
                    <option value="{{$item->id}}">{{$item->name}}</option>
                  @endforeach
                </select>
                <div id="province_id_error" class="help-block help-block-error"> </div>
              </div>
            </div>
            <div class="form-group" id="address">
              <label class="control-label col-sm-2" for="address">Alamat</label>
              <div class="col-sm-10">
                <textarea class="form-control" name="address" placeholder="Alamat"></textarea>
                <div id="address_error" class="help-block help-block-error"> </div>
              </div>
            </div>
            <div class="form-group" id="lat_lng">
              <label class="control-label col-sm-2" for="lat_lng">Lat/Lng</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="lat_lng" placeholder="Masukan Lat/Lng" required = "true">
                <div id="lat_lng_error" class="help-block help-block-error"> </div>
              </div>
            </div>
            <div class="form-group" id="status">
              <label class="control-label col-sm-2" for="status">Status</label>
              <div class="col-sm-10">
                <select class="form-control" name="status">
                  <option value="">Pilih status</option>
                  @foreach(\App\Util\Constant::COMMON_STATUS_LIST as $key => $value)
                    <option value="{{$key}}">{{$value}}</option>
                  @endforeach
                </select>
                <div id="status_error" class="help-block help-block-error"> </div>
              </div>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button id="submit" type="submit" class="btn btn-primary">Simpan</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
        </div>
      </div>

    </div>
  </div>
<!-- End Modal -->
