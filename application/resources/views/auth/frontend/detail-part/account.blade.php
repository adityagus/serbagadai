<div class="portlet light bordered margin-top-20">
    <h5 class="kt-portlet__head-title">
        Informasi Akun
    </h5>

    <hr>

    <div class="portlet-body form">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group" id="username">
                    <label class="label-control">Username</label>
                    <input type="text" name="username" class="form-control" placeholder="Masukkan username" value="">
                    <div id="username_error" class="help-block help-block-error"></div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group" id="email">
                    <label class="label-control">Email Akun</label>
                    <input type="email" name="email" class="form-control" placeholder="Masukkan email aktif" value="">
                    <div id="email_error" class="help-block help-block-error"> </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group" id="name">
                    <label class="label-control">Nama Akun</label>
                    <input type="text" name="name" class="form-control" placeholder="Masukkan nama lengkap" value="">
                    <div id="name_error" class="help-block help-block-error"></div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group" id="phone">
                    <label class="label-control">Phone Akun</label>
                    <input type="text" name="phone" class="form-control" placeholder="Contoh: 081234567890" value="">
                    <div id="phone_error" class="help-block help-block-error"> </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group" id="password">
                    <label class="label-control">Password</label>
                    <input type="password" name="password" class="form-control" placeholder="Minimal 6 karakter" value="">
                    <div id="password_error" class="help-block help-block-error"></div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group" id="password_confirmation">
                    <label class="label-control">Konfirmasi Password</label>
                    <input type="password" name="password_confirmation" class="form-control" placeholder="Ulangi password" value="">
                    <div id="password_confirmation_error" class="help-block help-block-error"> </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group" id="role">
                    <label class="label-control">Role Akun</label>
                    <select name="role" class="form-control">
                        @foreach(\App\Util\Constant::USER_ROLES as $roleKey => $roleLabel)
                            <option value="{{ $roleKey }}" {{ $roleKey === \App\Util\Constant::USER_ROLE_ADMIN ? 'selected' : '' }}>{{ $roleLabel }} ({{ $roleKey }})</option>
                        @endforeach
                    </select>
                    <div id="role_error" class="help-block help-block-error"> </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group" id="birthDay">
                    <label class="label-control">Tanggal Lahir (Opsional)</label>
                    <input type="date" name="birthDay" class="datepickerinput form-control" value="">
                    <div id="birthDay_error" class="help-block help-block-error"> </div>
                </div>
            </div>
        </div>
    </div>
</div>
