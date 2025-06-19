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
          <form id="form-category" class="form-horizontal" action="#" method="post" enctype="multipart/form-data">
            {{csrf_field()}}
            <input type="hidden" name="id" id="id" value="0">
            <input type="hidden" name="method" id="method">
            <div class="form-group" id="name">
              <label class="control-label col-sm-2" for="title">Judul</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="title" placeholder="Judul Kegiatan" required = "true">
                <div id="title_error" class="help-block help-block-error"> </div>
              </div>
            </div>
            <div class="form-group" id="description">
              <label class="control-label col-sm-2" for="description">Deskripsi</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="description" placeholder="Deskripsi iklan " required = "true">
                <div id="description_error" class="help-block help-block-error"> </div>
              </div>
            </div>
            <div class="form-group" id="image">
              <label class="control-label col-sm-2" for="image">Foto</label>
              <div class="col-sm-10">
                <input type="file" class="form-control" name="image" placeholder="Foto" required = "true">
                <div class="help-block help-block">Ukuran Foto (370 x 221)</div>
                <div id="image_error" class="help-block help-block-error"> </div>
              </div>
              <div class="col-md-12">
                <img src="" width="200" height="150" id="previewImage">
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
