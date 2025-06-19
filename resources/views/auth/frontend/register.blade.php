@extends('frontend.layouts.template')

@section('pageTitle','Profil')

@push('customCss')

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
    <div class="kt-content kt-grid__item kt-grid__item--fluid">

        <!--Begin::Dashboard 5-->

        <!--Begin::Section-->
        <div class="row">
            <div class="col-md-12">
                <div class="kt-portlet">
                    <div class="kt-portlet__head">
                        <div class="kt-portlet__head-label">
                            <h3 class="kt-portlet__head-title kt-font-primary">
                                Pendaftaran Akun baru
                            </h3>
                        </div>
                        <div class="kt-portlet__head-toolbar">
                            <div class="kt-portlet__head-actions">
                                <button type="button" class="btn btn-outline-brand btn-bold btn-sm" onclick="save()">Simpan</button>
                            </div>
                        </div>
                    </div>
                    <div class="kt-portlet__body">
                        <form href="#" id="formData" method="POST">

                            {{ csrf_field() }}

                            @include('auth.frontend.detail-part.account')

                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!--End::Section-->

        <!--End::Dashboard 5-->
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
                                    location.href = '{{route("admin.pics")}}';
                                });
                            }else{
                                swal({
                                    title: 'Gagal Simpan Data',
                                    text: response.message,
                                    icon: 'error',
                                    timer: '3000'
                                });
                                var error_arr = [];
                                error_arr.push('email');
                                error_arr.push('phone');
                                error_arr.push('name');
                                error_arr.push('username');
                                error_arr.push('password');
                                error_arr.push('birthDay');

                                for(var i=0;i < error_arr.length;i++){
                                    if(error_arr[i] in response.error){
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
