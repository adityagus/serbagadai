@extends('frontend.layouts.template')

@section('pageTitle','Pendaftaran Akun')

@push('customCss')
<style>
    .register-section-wrap {
        padding: 130px 0 80px;
        min-height: calc(100vh - 200px);
    }
    .register-section-wrap .kt-portlet {
        background: var(--bg-secondary);
        border: 1px solid var(--border-color);
        border-radius: var(--radius-lg, 16px);
        box-shadow: var(--shadow-premium);
        max-width: 860px;
        margin: 0 auto;
        overflow: hidden;
    }
    .register-section-wrap .kt-portlet__head {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 24px 32px;
        border-bottom: 1px solid var(--border-color);
        background: rgba(255, 110, 43, 0.05);
    }
    .register-section-wrap .kt-portlet__head-title {
        font-family: var(--font-heading);
        font-size: 22px;
        font-weight: 700;
        color: var(--text-main);
        margin: 0;
    }
    .register-section-wrap .kt-portlet__body {
        padding: 28px 32px 32px;
    }
    .register-section-wrap .portlet > hr {
        border: none;
        border-top: 1px solid var(--border-color);
        margin: 12px 0 24px;
    }
    .register-section-wrap .row {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 20px;
        margin-bottom: 18px;
    }
    @media (max-width: 640px) {
        .register-section-wrap .row {
            grid-template-columns: 1fr;
        }
        .register-section-wrap .kt-portlet__head,
        .register-section-wrap .kt-portlet__body {
            padding: 20px;
        }
    }
    .register-section-wrap .form-group {
        display: flex;
        flex-direction: column;
        gap: 6px;
    }
    .register-section-wrap .label-control {
        font-size: 14px;
        font-weight: 600;
        color: var(--text-main);
    }
    .register-section-wrap .form-control {
        width: 100%;
        padding: 12px 16px;
        border-radius: 10px;
        border: 1px solid var(--border-color);
        background: var(--bg-main);
        color: var(--text-main);
        font-size: 14px;
        outline: none;
        transition: border-color 0.2s ease, box-shadow 0.2s ease;
    }
    .register-section-wrap .form-control:focus {
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(255, 110, 43, 0.15);
    }
    .register-section-wrap .form-group.has-error .form-control {
        border-color: #ef4444;
    }
    .register-section-wrap .btn-outline-brand {
        background: var(--primary);
        color: #ffffff;
        border: none;
        padding: 10px 24px;
        border-radius: 999px;
        font-weight: 600;
        font-size: 14px;
        cursor: pointer;
        transition: transform 0.2s ease, opacity 0.2s ease;
    }
    .register-section-wrap .btn-outline-brand:hover {
        opacity: 0.92;
        transform: translateY(-1px);
    }
</style>
@endpush

@section('breadcrumb')
    <div class="kt-subheader__main">
        <h3 class="kt-subheader__title">
            Pendaftaran </h3>
        <span class="kt-subheader__separator kt-hidden"></span>
        <div class="kt-subheader__breadcrumbs">
            <a href="{{ route('home') }}" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
            <span class="kt-subheader__breadcrumbs-separator"></span>
            <a href="javascript:;" class="kt-subheader__breadcrumbs-link">
                Pendaftaran </a>
        </div>
    </div>
@endsection

@section('content')

    <!-- begin:: Content -->
    <div class="container register-section-wrap">
        <div class="kt-content kt-grid__item kt-grid__item--fluid">

            <!--Begin::Section-->
            <div class="kt-portlet">
                <div class="kt-portlet__head">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title kt-font-primary">
                            Pendaftaran Akun Baru
                        </h3>
                    </div>
                    <div class="kt-portlet__head-toolbar">
                        <div class="kt-portlet__head-actions">
                            <button type="button" class="btn btn-outline-brand btn-bold btn-sm" onclick="save()">Simpan</button>
                        </div>
                    </div>
                </div>
                <div class="kt-portlet__body">
                    <form action="{{ route('register.save') }}" id="formData" method="POST">

                        {{ csrf_field() }}

                        @include('auth.frontend.detail-part.account')

                    </form>
                </div>
            </div>

            <!--End::Section-->
        </div>
    </div>

    <!-- end:: Content -->

@endsection

@push('customJs')
    <script>
        function setPicRole() {
            if($('[name=hrd]').is(':checked')){
                $('.pic-role').show();
            }else{
                $('.pic-role').hide();
            }

            if($('[name=kopnit]').is(':checked')){
                $('.pic-kopnit').show();
            }else{
                $('.pic-kopnit').hide();
            }
        }

        function save(){
            $('.form-group').removeClass('has-error');
            $('.help-block-error').html('');

            swal({
                title: "Yakin Simpan Data?",
                text : "Data akan disimpan",
                icon: "warning",
                buttons: {
                    cancel:true,
                    confirm: {
                        text:'Simpan!',
                        closeModal: false,
                    },
                },
            })
            .then((process) => {
                if(process){
                    $('.form-group').removeClass('has-error');
                    $('.help-block-error').html('');

                    $.ajax({
                        url: "{{ route('register.save') }}",
                        type: "POST",
                        data: new FormData($("#formData")[0]),
                        processData: false,
                        contentType: false,
                        async:false,
                        success: function(response) {
                            if(response.status){
                                swal({
                                    title: 'Berhasil Simpan Data',
                                    text: response.message,
                                    icon: 'success',
                                    timer: '3000'
                                }).then((done)=>{
                                    location.href = '{{ route("admin.login") }}';
                                });
                            }else{
                                swal({
                                    title: 'Gagal Simpan Data',
                                    text: response.message,
                                    icon: 'error',
                                    timer: '3000'
                                });
                                var error_arr = [
                                    'email',
                                    'phone',
                                    'name',
                                    'username',
                                    'password',
                                    'password_confirmation',
                                    'role',
                                    'birthDay'
                                ];

                                for(var i=0;i < error_arr.length;i++){
                                    if(response.error && (error_arr[i] in response.error)){
                                        $('#'+error_arr[i]).addClass('has-error');
                                        $('#'+error_arr[i]+'_error').html(response.error[error_arr[i]]);
                                    }
                                }
                            }
                        },
                        error: function(jqXHR, textStatus, errorThrown){
                            swal({
                                title: 'System Error',
                                text: errorThrown,
                                icon: 'error',
                                timer: '3000'
                            });
                        }
                    });
                }else{
                    swal('Data tidak jadi disimpan');
                }
            });
        }
    </script>
@endpush
