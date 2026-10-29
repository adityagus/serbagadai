<!-- Cart -->
<div class="wrap-header-cart js-panel-cart">
	<div class="s-full js-hide-cart"></div>

	<div class="header-cart flex-col-l p-l-65 p-r-25">
		<div class="header-cart-title flex-w flex-sb-m p-b-8">
			<span class="mtext-103 cl2">
				Keranjang Belanja
			</span>

			<div class="fs-35 lh-10 cl2 p-lr-5 pointer hov-cl1 trans-04 js-hide-cart">
				<i class="zmdi zmdi-close"></i>
			</div>
		</div>
		
		<div class="header-cart-content flex-w js-pscroll">
			<ul class="header-cart-wrapitem w-full" id="cartItems">
			@if(!empty(Session::get('carts')))
				@foreach(Session::get('carts') as $cart)
				<li class="header-cart-item flex-w flex-t m-b-12 cartItem{{$cart['product']}}" id="cartItem{{$cart['product']}}">
					<a href="javascript:;" onclick="removeCart({{$cart['product']}})" title="Hapus Item" alt="Hapus Item">
						<div class="header-cart-item-img">
							<img src="{{$cart['image']}}" alt="{{$cart['name']}}">
						</div>
					</a>

					<div class="header-cart-item-txt p-t-8">
						<a href="{{route('productDetail',['id'=>$cart['product']])}}" class="header-cart-item-name m-b-18 hov-cl1 trans-04">
							{{ucwords($cart['name'])}}
						</a>

						<span class="header-cart-item-info">
							{{number_format($cart['qty'])}} x Rp. {{number_format($cart['price'])}}
						</span>
					</div>
				</li>
				@endforeach
			@else
				<li class="header-cart-item flex-w flex-t m-b-12">
					<h5>Keranjang Kosong :(</h5>
				</li>
			@endif	
			</ul>
			
			<div class="w-full">
				<div class="header-cart-total w-full p-tb-40 cartTotal">
					Total: Rp. {{number_format(Session::get('totalCart'))}}
				</div>

				<div class="header-cart-buttons flex-w w-full">
					<a href="#" onclick="checkOut()" class="flex-c-m stext-101 cl0 size-107 bg3 bor2 hov-btn3 p-lr-15 trans-04 m-r-8 m-b-10">
						Pesan
					</a>

					<a href="{{route('emptyCart')}}" class="flex-c-m stext-101 cl0 size-107 bg3 bor2 hov-btn3 p-lr-15 trans-04 m-b-10">
						Kosongkan
					</a>
				</div>
			</div>
		</div>
	</div>
</div>
