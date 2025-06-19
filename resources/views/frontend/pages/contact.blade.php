@extends('frontend.layouts.template')

@section('pageTitle','Kontak Kami')

@push('customCss')
	<style>
		.help-block-error{
			color: #ff7f7f;
		}
	</style>
@endpush

@section('content')

	<main id="main">
		<section class="section-compact">
			<div class="container" data-aos="fade-up">
				<p class="heading-36 weight-bold">Hubungi Kami</p>
			</div>
		</section>
		<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.677273508593!2d106.89158177458897!3d-6.173944260499293!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f5275a5a29bf%3A0x6295678aa123a43e!2sKirana%20Three%20Office%20Tower!5e0!3m2!1sid!2sid!4v1723022720865!5m2!1sid!2sid" width="100%" height="496" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
		<section class="section-compact">
			<div class="container" data-aos="fade-up">
				<div class="row g-4">
					<div class="col-md-5">
						<p class="subheading-24 weight-bold">Kantor Pusat</p>
						<p class="body-18 grayscale-800">{{ $CONF->address }}</p>
						<p class="subheading-24 weight-bold mt-4">Kontak</p>
						<p class="body-18 grayscale-800 mb-0">Email: {{ $CONF->email }}</p>
						<p class="body-18 grayscale-800">Phone: {{ $CONF->phone }}</p>
						<p class="subheading-24 weight-bold mt-4">Media Sosial</p>
						<div class="d-flex gap-3">
							<a href="{{ $CONF->facebook }}"><img src="{{ url('frontend/assets/img/sosmed-fb-white.png') }}" /></a>
							<a href="{{ $CONF->twitter }}"><img src="{{ url('frontend/assets/img/sosmed-twitter-white.png') }}" /></a>
							<a href="{{ $CONF->instagram }}"><img src="{{ url('frontend/assets/img/sosmed-ig-white.png') }}" /></a>
						</div>
					</div>
					<div class="col-md-7 contact">
						<div class="border-radius-24 bg-grayscale-100 p-4">
							<form action="javascript:;" method="post" id="form-contact">
								{{ csrf_field() }}
								<div class="mb-3" id="name">
									<label for="recipient-name" class="col-form-label weight-bold">Nama Lengkap</label>
									<input type="text" name="name" class="form-control" placeholder="Tulis Nama Lengkap" style="border-radius: 16px; height: 60px;">
									<div id="name_error" class="help-block help-block-error"> </div>
								</div>
								<div class="mb-3" id="email">
									<label for="recipient-email" class="col-form-label weight-bold">Email</label>
									<input type="email" class="form-control" name="email" placeholder="Tulis Email" style="border-radius: 16px; height: 60px;">
									<div id="email_error" class="help-block help-block-error"> </div>
								</div>
								<div class="mb-3" id="phone">
									<label for="recipient-phone" class="col-form-label weight-bold">No Whatsapp</label>
									<input type="text" class="form-control" name="phone" placeholder="Tulis No Whatsapp" style="border-radius: 16px; height: 60px;">
									<div id="phone_error" class="help-block help-block-error"> </div>
								</div>
								<div class="mb-3" id="content">
									<label for="message-text" class="col-form-label weight-bold">Pesan</label>
									<textarea class="form-control" name="content" placeholder="Tulis Pesan" style="border-radius: 16px; height: 178px;"></textarea>
									<div id="content_error" class="help-block help-block-error"> </div>
								</div>
								<div class="d-grid">
									<button type="button" class="btn btn-primary" onclick="send()">Kirim</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</section>
		<!-- End Promo Section -->

	</main>
	<!-- End #main -->

@endsection

@push('customJs')
	<script type="text/javascript">
		function send(){
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
						url: "{{ route('contact.send') }}",
						type: "POST",
						data: new FormData($("#form-contact")[0]),
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
								@foreach(\App\Models\Contact::CONTACT_VALIDATION as $key => $value)
								error_arr.push('{{ $key }}');
								@endforeach

								for(var i=0;i < error_arr.length;i++){
									if(error_arr[i] in response.error){
										$('.contact #'+error_arr[i]).addClass('has-error');
										$('.contact #'+error_arr[i]+'_error').html(response.error[error_arr[i]]);
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