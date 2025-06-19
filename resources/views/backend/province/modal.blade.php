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
            <input type="hidden" name="method" id="method">
            <div class="form-group" id="id">
              <label class="control-label col-sm-2" for="id">ID</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="id" placeholder="Masukan ID" required = "true">
                <div id="id_error" class="help-block help-block-error"> </div>
              </div>
            </div>
            <div class="form-group" id="name">
              <label class="control-label col-sm-2" for="name">Nama</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="name" placeholder="Masukan Nama" required = "true">
                <div id="name_error" class="help-block help-block-error"> </div>
              </div>
            </div>
            <div class="form-group" id="image">
              <label class="control-label col-sm-2" for="image">Gambar</label>
              <div class="col-sm-10">
                <input type="file" name="image" class="form-control">
                <br>
                <a href="#" target="_blank" title="preview" class="preview-image d-none"><img style="background-color: #e1e1e1" src="" width="100" height="100"></a>
                <div class="help-block"><small>Gambar Format JPG/PNG, Max Image (500kb), Ukuran 466 x 584 px</small></div>
                <div id="image_error" class="help-block help-block-error"> </div>
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
