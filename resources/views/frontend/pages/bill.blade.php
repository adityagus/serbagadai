@extends('frontend.layouts.template')

{{-- @section('pageTitle','Article') --}}

@push('customCss')
<style>
  .carousel-control-next,
  .carousel-control-prev {
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
  
  .card-details {
  padding: 30px;
  border-radius: 11 px;
}

.card-details h1 {
  font-size: 26px;
}

.card-details h2 {
  font-size: 20px;
}

.card-details p {
  font-size: 18px;
  color: #b1b1b1;
}
.text-right {
  text-align: right;
}

</style>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>

@endpush

@section('content')
<!-- Article Section -->
<main>
  <section class="section-details-header"></section>
  <section class="section-details-content">
    <div class="container">
      <div class="row">
        <div class="col pl-0 my-4">
          <nav>
            <ol class="breadcrumb">
              <li class="breadcrumb-item">
                Home
              </li>
              <li class="breadcrumb-item">
                View Bill
              </li>
            </ol>
          </nav>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-8 pl-lg-0">
          <div class="card card-details mb-4">
            <h1 class="text-warning text-bold">Cek Tagihan</h1>
            <p>
              Support for  200+ transaction
            </p>
            <form action="" class="">
              <div class="d-flex gap-4 flex-column flex-sm-row">
                
                <label for="nosbg" class="sr-only">No. Sbg</label>
                <div class="input-group">
                  <span class="input-group-text" id="basic-addon1">
                    <img src="{{ url('frontend/assets/img/sbgicon.png') }}" alt="" >
                  </span>
                  <input type="text" class="form-control" placeholder="No. Sbg" aria-label="nosbg" id="idCard" aria-describedby="basic-addon1">
                </div>
                
                <label for="idCard" class="sr-only">KTP</label>
                {{-- <div class="input-group">
                  <input type="text" class="form-control datepicker" id="doePassport" placeholder="DOE Passport">
                </div> --}}
                <div class="input-group">
                  <span class="input-group-text" id="basic-addon1">
                    <img src="{{ url('frontend/assets/img/ktpicon.png') }}" alt="" >
                  </span>
                  <input type="text" class="form-control" placeholder="KTP" aria-label="ktp" id="idCard" aria-describedby="basic-addon1">
                </div>
              </div>
              <div class="g-recaptcha my-3" data-sitekey="6LdgK2YrAAAAAEjSgvsOuXi6zkIkZX0IKxCFxEyb"></div>

              <button type="submit" class="btn text-white bg-primary px-5 ">
                Cek Tagihan
              </button>
            </form>
            <div class="fs-sm mt-3">
              <h6 class="mt-2 mb-0">Note :</h6>
              <p class="disclaimer mb-0" style="font-size: 16px">
                You are only able to invite member that has registered in KIVIA.
              </p>
            </div>
          </div>
        </div>
        <div class="col-lg-4">
          <div class="card card-details card-right mb-4">
            <h2>Checkout Informations</h2>
            <table class="trip-informations">
              <tr>
                <th width="50%">Name</th>
                <td width="50%" class="text-right">
                  Dedek
                </td>
              </tr>
              <tr>
                <th width="50%">Transaction Item</th>
                <td width="50%" class="text-right">
                  Total Price
                </td>
              </tr>
              <tr>
                <th width="50%">Transaction Price</th>
                <td width="50%" class="text-right">
                  Rp 25.000.000
                </td>
              </tr>
              <tr>
                <th width="50%">Tax</th>
                <td width="50%" class="text-right">
                  Rp 25.000
                </td>
              </tr>
              <tr>
                <th width="50%">Total</th>
                <td width="50%" class="text-right text-total">
                  Rp 25.025.000
                  {{-- <span class="text-blue">$279,</span>
                  <span class="text-orange">33</span> --}}
                </td>
              </tr>
            </table>
            <div class="join-container">
              <a href="success.html" class="btn bg-warning form-control btn-join-now mt-3 py-2 text-center">Pay Now</a>
            </div>
            {{-- <div class="text-center mt-3">
              <a href="#" class="text-muted">Reset</a>
            </div> --}}
          </div>
        </div>
      </div>
    </div>
  </section>
</main>
<!-- End Article Section -->
@endsection
@push('customJs')
       <script>
      function onClick(e) {
        e.preventDefault();
        grecaptcha.ready(function() {
          grecaptcha.execute('6Lf6dmUrAAAAACRe9bMYKuJ3lieC3T4AeB37FXfq', {action: 'submit'}).then(function(token) {
            console.log(token);
              // Add your logic to submit to your backend server here.
          });
        });
      }
  </script>
  <script>
   function onSubmit(token) {
     document.getElementById("demo-form").submit();
   }
 </script>
@endpush

{{-- @push('customJs')
    <script type="text/javascript">

        const count_article = {{ $count_article }};
let current_article = {{ count($articles) }};

function checkArticle() {
if(count_article > current_article){
$('.btn-load').show();
}else{
$('.btn-load').hide();
}
}

checkArticle();

$('.article-sample').hide();

function loadMore(){
$.ajax({
url: "{{ route('article.get',['offset'=>'']) }}"+"/"+(current_article+1),
type: "GET",
dataType: "JSON",
success: function(response) {
response.map(data=>{
const article_card = $('.article-sample').clone();
article_card.show();
article_card.removeClass('article-sample');
article_card.find('.image_article').attr('src','{{ url('storage/') }}/'+data.featured_image);
article_card.find('.article_title').html(data.title);
article_card.find('.article_date').html(data.date);
article_card.find('.article_link').attr('href','{{ route('article.detail',['slug'=>'']) }}/'+data.slug);

$('.article_list').append(article_card);
current_article++;
});
checkArticle();
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


</script>
@endpush --}}
