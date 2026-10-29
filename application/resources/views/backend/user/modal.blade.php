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
            <div class="form-group" id="username">
              <label class="control-label col-sm-2" for="username">Username</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="username" placeholder="Masukan Username" required = "true">
                <div id="username_error" class="help-block help-block-error"> </div>
              </div>
            </div>
            <div class="form-group" id="name">
              <label class="control-label col-sm-2" for="name">Nama</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="name" placeholder="Masukan Nama Lengkap" required = "true">
                <div id="name_error" class="help-block help-block-error"> </div>
              </div>
            </div>
            <div class="form-group" id="email">
              <label class="control-label col-sm-2" for="email">Email</label>
              <div class="col-sm-10">
                <input type="email" class="form-control" name="email" placeholder="Masukan Email" required = "true">
                <div id="email_error" class="help-block help-block-error"> </div>
              </div>
            </div>
            <div class="form-group" id="phone">
              <label class="control-label col-sm-2" for="phone">Telepon</label>
              <div class="col-sm-10">
                <input type="phone" class="form-control" name="phone" placeholder="Masukan Telepon" required = "true">
                <div id="phone_error" class="help-block help-block-error"> </div>
              </div>
            </div>
            <div class="form-group" id="password">
              <label class="control-label col-sm-2" for="password">Password</label>
              <div class="col-sm-10">
                <input type="password" class="form-control" name="password" placeholder="Masukan Password (kosongkan jika tidak ingin ganti password)" required = "true">
                <div id="password_error" class="help-block help-block-error"> </div>
              </div>
            </div>
            <div class="form-group" id="role">
              <label class="control-label col-sm-2" for="role">Role</label>
              <div class="col-sm-10">
                <select class="form-control" name="role">
                  <option value="">Pilih role</option>
                  @foreach(\App\Util\Constant::USER_ROLES as $role => $value)
                  <option value="{{$role}}">{{$role}}</option>
                  @endforeach
                </select>
                <div id="role_error" class="help-block help-block-error"> </div>
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
