@extends('frontend.layouts.template')

@section('pageTitle','Career Detail')

@push('customCss')
    <style>
        .carousel-control-next, .carousel-control-prev {
            width: 10%
        }
        .carousel-indicators [data-bs-target] {
            background-color: #4D73CB;
        }
        .btn-circle {
            width: 40px;
            height: 40px;
            padding: 12px 0px;
            border-radius: 35px;
            text-align: center;
            font-size: 12px;
            line-height: 1.42857;
            background-color: #111831;
        }
        .help-block-error{
            color: #ff7f7f;
        }
    </style>
@endpush

@section('content')

    <main id="main">
        <section class="section bg-grayscale-50">
            <div class="container" data-aos="fade-up">
                <p class="heading-36 weight-bold">{{ $career->title }}</p>
            </div>
        </section>

        <!-- Promo Section -->
        <section class="section">
            <div class="container" data-aos="fade-up">
                <div class="row g-4">
                    <div class="col-md-6">
                        <div class="bg-primary-50 p-4 border-radius-24 mb-4">
                            <p class="body-18 grayscale-950 mb-0">Level<span class="body-18 grayscale-800 ms-4">{{ \App\Util\Constant::CAREER_CATEGORY_LIST[$career->category] }}</span></p>
                            <p class="body-18 grayscale-950 mb-0">Tipe Pekerjaan<span class="body-18 grayscale-800 ms-4">{{ \App\Util\Constant::CAREER_TYPES_LIST[$career->types] }}</span></p>
                            <p class="body-18 grayscale-950 mb-0">Lokasi Pekerjaan<span class="body-18 grayscale-800 ms-4">{{ $location }}</span></p>
                        </div>
                        <p class="subheading-24 weight-bold">Kualifikasi</p>
                        {!! $career->qualification !!}
                        <p class="subheading-24 weight-bold">Rincian Tugas</p>
                        {!! $career->job_desk !!}
                    </div>
                </div>
            </div>
        </section>
        <!-- End Promo Section -->
        
        <section class="section">
            <div class="container" data-aos="fade-up">
                <p class="subheading-24 weight-bold mb-4" style="color: #5D5A88;">Apply for this position</p>
                <div class="border-radius-24 bg-grayscale-100 p-4">
                    <form id="form-submission" method="post" enctype="multipart/form-data" action="javascript:;">
                        {{ csrf_field() }}
                        <input type="hidden" name="career_id" value="{{ $career->id }}">
                        <div class="mb-3" id="name">
                            <label for="recipient-name" class="col-form-label weight-bold">Nama Lengkap</label>
                            <input type="text" name="name" class="form-control" id="recipient-name" style="border-radius: 16px; height: 60px;" placeholder="Tulis Nama Lengkap">
                            <div id="name_error" class="help-block help-block-error"> </div>
                        </div>
                        <div class="mb-3" id="email">
                            <label for="recipient-name" class="col-form-label weight-bold">Email</label>
                            <input type="email" name="email"class="form-control" id="recipient-name" style="border-radius: 16px; height: 60px;" placeholder="Tulis Email">
                            <div id="email_error" class="help-block help-block-error"> </div>
                        </div>
                        <div class="mb-3" id="phone">
                            <label for="recipient-name" class="col-form-label weight-bold">No Handphone</label>
                            <input type="text" name="phone" class="form-control" id="recipient-name" style="border-radius: 16px; height: 60px;" placeholder="Tulis No Handphone">
                            <div id="phone_error" class="help-block help-block-error"> </div>
                        </div>
                        <div class="mb-3" id="cover_letter">
                            <label for="message-text" class="col-form-label weight-bold">Cover Letter</label>
                            <textarea name="cover_letter" class="form-control" id="message-text" placeholder="Tulis cover letter" style="border-radius: 16px; height: 178px;"></textarea>
                            <div id="cover_letter_error" class="help-block help-block-error"> </div>
                        </div>
                        <div class="mb-3" id="cv">
                            <label for="message-text" class="col-form-label weight-bold">Upload CV/Resume</label>
                            <input class="form-control" name="cv" type="file" />
                            <div class="help-block"><small>Maksimal 2MB, format file png,jpeg,pdf</small></div>
                            <div id="cv_error" class="help-block help-block-error"> </div>
                        </div>
                        <div class="form-check mt-4 mb-4">
                            <input class="form-check-input" type="checkbox" name="agreement"  value="true" id="flexCheckDefault">
                            <label class="form-check-label" for="flexCheckDefault">
                                By using this form you agree with the storage and handling of your data by this website. 
                            </label>
                        </div>
                        <div class="d-grid">
                            <button type="button" class="btn btn-primary" onclick="save()">Kirim</button>
                        </div>
                    </form>
                </div>
            </div>
        </section>

    </main>
    <!-- End #main -->

@endsection

@push('customJs')
    <script type="text/javascript">
        function save(){
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

                        if(!$('[name=agreement]').is(':checked')){
                            swal({
                                title: 'Persetujuan Belum Di Checklist',
                                text: 'Mohon lengkapi data anda',
                                icon: 'error',
                                timer: '1500'
                            });
                            return;
                        }

                        $('.form-group').removeClass('has-error');
                        $('.help-block-error').html('');

                        $.ajax({
                            url: "{{ route('career.save') }}",
                            type: "POST",
                            data: new FormData($("#form-submission")[0]),
                            processData: false,
                            contentType: false,
                            async:false,
                            success: function(response) {
                                if(response.status){
                                    swal({
                                        title: 'Berhasil Simpan Data',
                                        text: response.message,
                                        icon: 'success',
                                        timer: '1500'
                                    }).then(()=>{
                                        location.reload();
                                    });
                                }else{
                                    swal({
                                        title: 'Gagal Simpan Data',
                                        text: response.message,
                                        icon: 'error',
                                        timer: '1500'
                                    });

                                    var error_arr = [];
                                    @foreach(\App\Models\CareerSubmission::FORM_VALIDATION as $key => $value)
                                    error_arr.push('{{ $key }}');
                                            @endforeach

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
                                    timer: '1500'
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
