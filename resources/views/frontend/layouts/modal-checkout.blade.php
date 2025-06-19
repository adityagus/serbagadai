<!-- Modal1 -->
<div class="wrap-modal1 js-modal3 p-t-60 p-b-20">
    <div class="overlay-modal1 js-hide-modal3"></div>

    <div class="container" style="max-width: 471px;">
        <div class="bg0 p-t-60 p-b-30 p-lr-15-lg how-pos3-parent">
            <button class="how-pos3 hov3 trans-04 js-hide-modal3">
                <img src="{{url('frontend/images/icons/icon-close.png')}}" alt="CLOSE">
            </button>

            <div class="row">
                <div class="bor10 p-lr-40 p-t-30 p-b-40 m-l-95 m-r-40 m-lr-0-xl p-lr-15-sm">
                    <h4 class="mtext-109 cl2 p-b-30">
                        Data Pemesan
                    </h4>

                    <div class="bor8 bg0 m-b-12">
                        <input class="stext-111 cl8 plh3 size-111 p-lr-15" type="text" name="name" placeholder="Nama Lengkap">
                    </div>

                    <div class="bor8 bg0 m-b-12">
                        <input class="stext-111 cl8 plh3 size-111 p-lr-15" type="email" name="email" value="" placeholder="Alamat Email">
                    </div>

                    <div class="bor8 bg0 m-b-12">
                        <input class="stext-111 cl8 plh3 size-111 p-lr-15" type="text" name="phone" value="" placeholder="Nomor Telepon">
                    </div>

                    <div class="bor8 bg0 m-b-12">
                        <textarea class="stext-111 cl8 plh3 size-111 p-lr-15" name="address" placeholder="Alamat Pengiriman" style="height: 100px;"></textarea>
                    </div>
                    <div class="flex-c-m respon6" style="margin-right: 15px;">
                        <button class="stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04 js-addcart-detail" id="previewAddCart" onclick="setCheckOut()">
                            Pesan
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
