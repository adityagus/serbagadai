<!-- Sidebar -->
<aside class="wrap-sidebar js-sidebar">
	<div class="s-full js-hide-sidebar"></div>

	<div class="sidebar flex-col-l p-t-22 p-b-25">
		<div class="flex-r w-full p-b-30 p-r-27">
			<div class="fs-35 lh-10 cl2 p-lr-5 pointer hov-cl1 trans-04 js-hide-sidebar">
				<i class="zmdi zmdi-close"></i>
			</div>
		</div>

		<div class="sidebar-content flex-w w-full p-lr-65 js-pscroll">
			<div class="sidebar-gallery w-full p-tb-30">
				<span class="mtext-101 cl5">
					@ {{$CONF->title}}
				</span>

				<div class="flex-w flex-sb p-t-36 gallery-lb">
					@foreach($randProducts as $randProduct)
					<!-- item gallery sidebar -->
					<div class="wrap-item-gallery m-b-10">
						<a class="item-gallery bg-img1 js-show-modal1" href="#" product-id="{{$randProduct->id}}"
						style="background-image: url('{{url('storage/'.$randProduct->image)}}');"></a>
					</div>
					@endforeach
				</div>
			</div>

			<div class="sidebar-gallery w-full">
				<span class="mtext-101 cl5">
					About Us
				</span>

				<p class="stext-108 cl6 p-t-27">
					{{$CONF->about}} 
				</p>
			</div>
		</div>
	</div>
</aside>
