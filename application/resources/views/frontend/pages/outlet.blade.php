@extends('frontend.layouts.template')

@section('pageTitle','Jaringan Kami')

@push('customCss')
	<style>
		.help-block-error{
			color: #ff7f7f;
		}

		.dataTables_paginate li{
			padding:0px 10px;
			border: 0.5px solid #dee2e6 !important;
			border-collapse: separate !important;
			border-spacing: 0 !important;
			margin: 0px 3px;
			border-radius: 5px;
		}
	</style>
	<link href="{{url('backend/assets/global/datatables/datatables.min.css')}}" rel="stylesheet" type="text/css" />
@endpush

@section('content')

	<main id="main">
		<!-- Promo Section -->
		<section class="section">
			<div class="container" data-aos="fade-up">
				<p class="heading-36 weight-bold mb-5">Kunjungi kami di Outlet terdekat lokasi anda</p>
				<div id="maps" style="max-width:1224px;height: 496px;" class="mb-5"></div>
				<div class="d-flex justify-content-between">
					<select class="form-select" name="s_province" onclick="filter()" aria-label="Default select example" style="max-width: 200px; height: 56px; border-radius: 30px;">
						<option value="">Pilih Provinsi</option>
						@foreach($provinces as $province)
						<option value="{{ $province->id }}">{{ $province->name }}</option>
						@endforeach
					</select>
					<div class="input-group" style="max-width: 446px; height: 56px;">
						<input type="text" class="form-control" name="s_search" onchange="filter()" id="autoSizingInputGroup" placeholder="Cari Lokasi" style="border-right: 0px; border-top-left-radius: 30px !important; border-bottom-left-radius: 30px !important;">
						<div class="input-group-text bg-white" style="border-top-right-radius: 30px !important; border-bottom-right-radius: 30px !important;">
							<i class="bi bi-search"></i>
						</div>
					</div>
				</div>
				<table id="pricing-table" class="table table-bordered mt-5 my-table">
					<thead>
					<tr>
						<th class="bg-primary-100 caption-14 weight-bold p-4 text-center">Nama Cabang</th>
						<th class="bg-primary-100 caption-14 weight-bold p-4 text-center">Wilayah</th>
						<th class="bg-primary-100 caption-14 weight-bold p-4 text-center">Alamat</th>
					</tr>
					</thead>
					<tbody>
					</tbody>
				</table>
			</div>
		</section>
		<!-- End Promo Section -->

	</main>
	<!-- End #main -->

@endsection

@push('customJs')

	<script src="{{url('backend/assets/global/datatable.js')}}"
			type="text/javascript"></script>
	<script
			src="{{url('backend/assets/global/datatables/datatables.min.js')}}"
			type="text/javascript"></script>
	<script
			src="{{url('backend/assets/global/datatables/plugins/bootstrap/datatables.bootstrap.js')}}"
			type="text/javascript"></script>
	<script
			src="{{url('backend/assets/global/table-datatables-responsive.min.js')}}"
			type="text/javascript"></script>

	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBt32jcY7LXJauBie0Hx6dEuJpvBqjMGKQ"></script>

	<script type="text/javascript">

		var table = $('.my-table').DataTable({
			'processing'  : true,
			'serverSide'  : true,
			'ajax'        : {
				url: "{{ route('outlet.data') }}",
				data: function (d) {
					d['search'] = $('[name=s_search]').val();
					d['outlets.province_id']= $('[name=s_province]').val();
				}
			},
			'dataType'    : 'json',
			'searching'   : false,
			'paging'      : true,
			'lengthChange': false,
			'columns'     : [
				{data:'name', name: 'name'},
				{data:'province_id', name: 'province_id'},
				{data:'address', name: 'address'},
			],
			'info'        : false,
			'order'       : ['1','asc'],
			'autoWidth'   : false
		});

		function filter() {
			table.draw();
		}

		const properties = [];

		@foreach($outlets as $outlet)
			properties.push({
				address: `{{ $outlet->address }}`,
				description: `{{ $outlet->name }}`,
				size: 300,
				location: `{{ $outlet->lat_lng }}`,
				position: {
					lat: {{ (float) explode(',',$outlet->lat_lng)[0]  }},
					lng: {{ (float) explode(',',$outlet->lat_lng)[1]  }},
				}
			})
		@endforeach

		function toggleHighlight(markerView) {
			if (markerView.content.classList.contains("highlight")) {
				markerView.content.classList.remove("highlight");
				markerView.zIndex = null;
			} else {
				markerView.content.classList.add("highlight");
				markerView.zIndex = 1;
			}
		}

		function buildContent(property) {
			const content = document.createElement("div");
			return content;
		}

		function myMap() {
			var mapProp= {
				zoom: 5,
				center:new google.maps.LatLng(-0.789275, 113.921327),
			};
			var map = new google.maps.Map(document.getElementById("maps"),mapProp);

			for (const property of properties) {

				var marker = new google.maps.Marker({
					content: buildContent(property),
					position: property.position,
					title: property.description,
					icon:'{{ url('frontend/assets/img/map-point.png') }}'
				});

				marker.addListener("click", () => {
					window.open('http://maps.google.com?q='+property.location);
					toggleHighlight(marker, property);
				});

				marker.setMap(map);
			}
		}
		myMap();
	</script>
@endpush