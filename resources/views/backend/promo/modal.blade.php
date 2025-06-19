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
            <div class="form-group" id="title">
              <label class="control-label col-sm-2" for="title">Judul</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="title" placeholder="Masukan Judul" required = "true">
                <div id="title_error" class="help-block help-block-error"> </div>
              </div>
            </div>
            <div class="form-group" id="valid_date">
              <label class="control-label col-sm-2" for="name">Tanggal Valid</label>
              <div class="col-sm-10">
                <input type="text" class="form-control datepickerinput" name="valid_date" placeholder="Masukan Tanggal Valid" required = "true">
                <div id="valid_date" class="help-block help-block-error"> </div>
              </div>
            </div>
            <div class="form-group" id="action_link">
              <label class="control-label col-sm-2" for="action_link">Action Link</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="action_link" placeholder="Action Link" required = "true">
                <div id="action_link_error" class="help-block help-block-error"> </div>
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
            <div class="form-group" id="image">
              <label class="control-label col-sm-2" for="image">Gambar</label>
              <div class="col-sm-10">
                <input type="file" name="image" class="form-control">
                <br>
                <a href="#" target="_blank" title="preview" class="preview-image d-none"><img style="background-color: #e1e1e1" src="" width="100" height="100"></a>
                <div id="image_error" class="help-block help-block-error"> </div>
                <div class="help-block"><small>Gambar Format JPG/PNG, Max Image (500kb), Ukuran 392 x 220 px</small></div>
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
