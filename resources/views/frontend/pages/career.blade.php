@extends('frontend.layouts.template')

@section('pageTitle','Career')

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

    <!-- Career Section -->
    <main id="main">
        <img src="{{ url('storage/'.$page->header_image) }}" class="img-fluid" width="100%" />
        <!-- Promo Section -->
        <section class="section pt-md-5">
            <div class="container" data-aos="fade-up">
                <p class="heading-36 weight-bold mb-5">{{ $page->general_title }}</p>
                <div class="d-flex gap-3">
                    <select class="form-select border-radius-24" onchange="loadMore(true)" name="category" aria-label="Default select example" style="max-width: 200px; height: 56px; border-radius: 30px;">
                        <option value="">Pilih Kategori Pekerjaan</option>
                        @foreach(\App\Util\Constant::CAREER_CATEGORY_LIST as $value => $label)
                            <option value="{{$value}}">{{$label}}</option>
                        @endforeach
                    </select>
                    <select class="form-select border-radius-24" onchange="loadMore(true)" name="types" aria-label="Default select example" style="max-width: 200px; height: 56px; border-radius: 30px;">
                        <option value="">Pilih Tipe Pekerjaan</option>
                        @foreach(\App\Util\Constant::CAREER_TYPES_LIST as $value => $label)
                            <option value="{{$value}}">{{$label}}</option>
                        @endforeach
                    </select>
                    <select class="form-select border-radius-24" onchange="loadMore(true)" name="location" aria-label="Default select example" style="max-width: 200px; height: 56px; border-radius: 30px;">
                        <option value="">Pilih Lokasi Pekerjaan</option>
                        @foreach($locations as $location)
                            <option value="{{$location->id}}">{{$location->name}}</option>
                        @endforeach
                    </select>
                </div>
                <!--<div class="d-flex justify-content-center career_empty">
                    <div style="width: 864px;" class="text-center">
                        <img src="{{ url('frontend/assets/img/img-empty.png') }}" />
                        <p class="subheading-20 grayscale-700 weight-bold">Sedang tidak ada posisi yang dibuka</p>
                        <p class="body-16 grayscale-600">Tenang, silakan drop CV melalui tombol di bawah ini dan kami akan mempertimbangkan dan menginformasikan lebih lanjut jika ada posisi yang dibuka</p>
                    </div>
                </div>-->
                <div class="col-md-4 career-sample">
                    <div class="card card-item border-radius-24" style="height: 224px;">
                        <div class="card-body d-grid p-4">
                            <p class="subheading-24 weight-bold career_title"></p>
                            Level<p class="body-16 grayscale-700 career_category"></p>
                            Tipe Pekerjaan<p class="body-16 grayscale-700 career_types"></p>
                            <div class="overlay border-radius-24 bg-primary-400">
                                <div class="d-flex align-items-center justify-content-center" style="height: 100%;">
                                    <a role="button" class="btn btn-outline-secondary-small career_link" href="#">
                                        Lihat Selengkapnya
                                        <i class="bi bi-arrow-right push-right ms-2"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row g-4 mt-3 career_list">
                </div>
            </div>
        </section>
        <!-- End Promo Section -->

        <section id="about" class="section about">
            <div class="container" data-aos="fade-up">
                <div class="card text-bg-dark">
                    <img src="{{ url('frontend/assets/img/call-to-action-simple.png') }}" />
                    <div class="card-img-overlay d-flex align-items-center justify-content-md-between justify-content-end">
                        <p class="subheading-30 text-black weight-bold d-none d-sm-flex" style="max-width: 658px; margin-left: 20%;">{{ $page->general_drop_cv }}</p>
                        <button type="button" class="btn btn-primary-dark" data-bs-toggle="modal" style="margin-right: 5%;" data-bs-target="#exampleModal">
                            Drop your CV
                        </button>
                    </div>
                </div>
            </div>
        </section>

        <section class="section bg-grayscale-50">
            <div class="container" data-aos="fade-up">
                <p class="heading-36 weight-bold mb-5 text-center">{{ $page->general_testimony }}</p>
                <div id="horizontalScroll" class="horizontal-scroll gap-5 mt-3">
                    @foreach($page->testimony_item as $testimony)
                        <div class="d-flex card border-radius-24" style="width: 392px;">
                            <div class="card-body d-grid p-5">
                                <img src="{{ url('storage/'.$testimony->image) }}" class="rounded-circle mb-4" />
                                <p class="subheading-20 grayscale-950 weight-bold mb-2">{{ $testimony->name }}</p>
                                <p class="body-18 grayscale-700">{{ $testimony->role }}</p>
                                <p class="subheading-20 weight-bold mb-2">{{ $testimony->quote }}</p>
                                <p class="body-16 grayscale-950 mb-4">{{ $testimony->description }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
                <button class="carousel-control-prev" type="button" id="slideBack" style="top: 20%;">
                    <div class="btn-circle">
                        <i class="bi bi-chevron-left"></i>
                    </div>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" id="slideNext" style="top: 20%;">
                    <div class="btn-circle">
                        <i class="bi bi-chevron-right"></i>
                    </div>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </section>

    </main>
    <!-- End Career Section -->

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content border-radius-24 p-4">
                <div class="modal-header" style="border: 0px">
                    <h1 class="modal-title fs-5 text-black">Drop CV</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="form-submission" method="post" enctype="multipart/form-data" action="javascript:;">
                        {{ csrf_field() }}
                        <input type="hidden" name="career_id" value="0">
                        <div class="mb-3" id="name">
                            <label for="recipient-name" class="col-form-label weight-bold">Nama Lengkap</label>
                            <input type="text" name="name" class="form-control" id="recipient-name" style="border-radius: 16px; height: 60px;" placeholder="Tulis Nama Lengkap">
                            <div id="name_error" class="help-block help-block-error"> </div>
                        </div>
                        <div class="mb-3" id="email">
                            <label for="recipient-name" class="col-form-label weight-bold">Email</label>
                            <input type="email" name="email" class="form-control" id="recipient-name" style="border-radius: 16px; height: 60px;" placeholder="Tulis Email">
                            <div id="email_error" class="help-block help-block-error"> </div>
                        </div>
                        <div class="mb-3" id="phone">
                            <label for="recipient-name" class="col-form-label weight-bold">No Handphone</label>
                            <input type="text" name="phone" class="form-control" id="recipient-name" style="border-radius: 16px; height: 60px;" placeholder="Tulis No Handphone">
                            <div id="phone_error" class="help-block help-block-error"> </div>
                        </div>
                        <div class="mb-3" id="cover_letter">
                            <label for="message-text" class="col-form-label weight-bold">Cover Letter</label>
                            <textarea class="form-control" name="cover_letter" id="message-text" placeholder="Tulis cover letter" style="border-radius: 16px; height: 178px;"></textarea>
                            <div id="cover_letter_error" class="help-block help-block-error"> </div>
                        </div>
                        <div class="mb-3" id="cv">
                            <label for="message-text" class="col-form-label weight-bold">Upload CV/Resume</label>
                            <input class="form-control" name="cv" type="file" />
                            <div class="help-block"><small>Maksimal 2MB, format file png,jpeg,pdf</small></div>
                            <div id="cv_error" class="help-block help-block-error"> </div>
                        </div>
                        <div class="form-check mt-4">
                            <input class="form-check-input" type="checkbox" name="agreement" value="true" id="flexCheckDefault">
                            <label class="form-check-label" for="flexCheckDefault">
                                By using this form you agree with the storage and handling of your data by this website. 
                            </label>
                        </div>
                    </form>
                </div>
                <div class="modal-footer" style="border: 0px">
                    <button type="button" class="btn btn-primary" onclick="save()" style="flex: 1">Kirim</button>
                </div>
            </div>
        </div>
    </div>
    <!-- End Modal -->

@endsection

@push('customJs')
    <script type="text/javascript">

        let count_data = 0;
        let current_data = 0;

        $('.career-sample').hide();

        function loadMore(status = false){
            if(status){
                current_data = 0;
                $('.career_list').empty();
            }
            $.ajax({
                url: "{{ route('career.get') }}?offset="+(current_data+1)+"&category="+$('[name=category]').val()+'&types='+$('[name=types]').val()+'&location='+$('[name=location]').val(),
                type: "GET",
                dataType: "JSON",
                success: function(response) {
                    count_data = response.total;
                    response.data.map(data =>{
                        const career_card = $('.career-sample').clone();
                        career_card.show();
                        career_card.removeClass('career-sample');
                        career_card.find('.career_title').html(data.title);
                        career_card.find('.career_category').html(data.category);
                        career_card.find('.career_types').html(data.types);
                        career_card.find('.career_link').attr('href','{{ route('career.detail',['slug'=>'']) }}/'+data.slug);

                        $('.career_list').append(career_card);
                        current_data++;
                    });
                    checkData();
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
        }

        loadMore();



        function checkData() {
            $('.career_empty').attr('style', 'display: none !important');
            if(current_data === 0 ) $('.career_empty').removeAttr('style');
            if(count_data > current_data){
                $('.btn-load').show();
            }else{
                $('.btn-load').hide();
            }
        }

        checkData();

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
