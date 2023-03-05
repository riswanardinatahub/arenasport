@extends('layouts.app')

@section('title')
Detail Page
@endsection

<style> 
input[type="text"]{
background-color:white !important;
border: 3px solid #358F66;
}

input[type="date"]{
background-color:white !important;
border: 3px solid #358F66;
}


.tabs-size{
  font-size:12px;

}

.nav-tabs {
  border-bottom: 0px solid transparent !important;
}
.nav-tabs .nav-link {
  border: 0px solid transparent !important;
}


.nav-tabs .tina .nav-link {
  color: black;
}


.nav-tabs .tina .nav-link.active {
  background-color: #358F66; !important;
  color: white;
}

.tina > a:hover {
  color: green;
 
}


i{
    color: #358F66;
}

input[type=text]:focus {
  border: 3px solid #358F66;
}
.input-group-prepend span{
    background-color:white !important;
border: 3px solid #358F66;
line-height: 1;
}

.input-group select.form-control {
  background-color:white !important;
  border: 3px solid #358F66;
  
}
.tab-pane{
  font-size:12px;
}

.nav-tabs {
    padding-left: 15px;
    margin-bottom: 0;
    border: none;
}
.tab-content {
    border: 2px solid #358F66;
    border-radius: 4px;
    padding: 15px;
}


</style>

@section('content')
<div class="page-content page-details">
 <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Copy Link Di bawah Ini</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    {{-- {{ url()->current() }} --}}
                    @php
                      $link = url()->current();
                    @endphp
                    {{ $link }}
                     <input hidden type="text" value="{{ $link }}" id="myInput">
                  </div>

                  <div class="row justify-content-center text-center">
                    <div class="col-12 p-3 text-center">
                      
                      <a href="#" class="mr-2" target="_blank" id="facebook-btn"><i class="fab fa-facebook-square fa-3x" style="color: #3b5998; font-size: 3rem"></i></a>
                      <a href="#" class="mr-2" target="_blank" id="twitter-btn"><i class="fab fa-twitter-square fa-3x" style="color: #1da1f2; font-size: 3rem"></i></a>
                      <a href="#" class="mr-2" target="_blank" id="linkedin-btn"><i class="fab fa-linkedin fa-3x" style="color: #0077b5; font-size: 3rem"></i></a>
                      <a href="#" class="mr-2" target="_blank" id="whatsapp-btn"><i class="fab fa-whatsapp-square fa-3x" style="color: #25d366; font-size: 3rem"></i></a>
                      <a href="#" class="mr-2" target="_blank" id="gmail-btn"><i class="fas fa-envelope fa-3x" style="color: #cf3e39; font-size: 3rem"></i></a>
                     
                    </div>
                  </div>
                  <div class="modal-footer text-center">
                  

                 
                  <br>
                  <div>
                  <button type="button"  class="btn btn-secondary" data-dismiss="modal">Close</button>
                    
                    <button class="btn btn-info" onclick="myFunction()">Copy Link</button>
                  </div>
                    
                  </div>
                </div>
              </div>
            </div>

  <section class="store-breadcrumbs" data-aos="fade-down" data-aos-delay="100">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <nav>
            <ol class="breadcrumb">
              <li class="breadcrumb-item">
                <a href="{{ route('home') }}">Home</a>
              </li>
              <li class="breadcrumb-item active">
                Detail Arena
              </li>
            </ol>
          </nav>
        </div>
      </div>
    </div>
  </section>

  <section class="store-gallery mb-3" id="gallery">
    <div class="container">
      <div class="row">
        <div class="col-lg-8" data-aos="zoom-in">
          <transition name="slide-fade" mode="out-in">
            <img :key="photos[activePhoto].id" :src="photos[activePhoto].url" class="w-100 main-image" alt="">
          </transition>
        </div>
        <div class="col-lg-2">
          <div class="row">
            <div class="col-3 col-lg-12 mt-2 mt-lg-0" v-for="(photo, index) in photos" :key="photo.id"
              data-aos="zoom-in" data-aos-delay="100">
              <a href="#" @click="changeActive(index)">
                <img :src="photo.url" class="w-100 thumbnail-image" :class="{ active: index == activePhoto }" alt="" />
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <div class="store-details-container" data-aos="fade-up">
    <section class="store-heading">
      <div class="container">
        <div class="row">
          <div class="col-lg-8">
            <h1 style="font-weight: 900;">{{ $product->name }}</h1>
            <h1 style="font-size: 16px; font-weight: 400;">{{ $product->user->regencies->name }}</h1>

            <div class="price">Rp. {{ number_format($product->price) }}</div>
              {{-- <div>
                    @if ($product->stock >= 1)
                      <span style="font-size:17px; color:#29a867; ">
                         Arena Tersedia

                      </span>
                      @else
                      <span style="font-size:17px; color:red; ">
                          Arena Tidak Tersedia

                      </span>
                    @endif
              </div> --}}
            <div class="row">
              <div class="col-12 col-lg-12">
              <p class="store-description text-muted">  {!! $product->description !!}  </p>
              </div>

              <div class="col-12 col-lg-12">
              <p class="" style="font-size: small;">{{ $product->user->address_one }}</p>
              </div>

            </div>

            <div class="owner mt-3">
              <a href="{{ route('store-page-detail', $product->user->id) }}" class="card-list d-block">
                <div class="card-body py-0">
                  <div class="row">
                    @if ($product->user->images)
                    <img src="{{ Storage::url($product->user->images) }}" alt="" class="mr-2 rounded-circle profile-picture">
                    @else
                    <img src="/images/icon-store.svg" alt="" class="rounded-circle mr-3 profile-picture">
                    @endif
                    <p class="" style="font-weight: bolder;">{{ $product->user->store_name }}</p>
                   
                  </div>
                </div>
              </a>
            </div>
             <a href="" class="btn btn-success btn-sm px-3" data-toggle="modal" data-target="#exampleModalCenter"> Bagikan</a>
              <div class="row">
                <div class="col">
                <h1 class="mt-3" style="font-weight: 900; font-size: 21px;
                  line-height: 32px;">Pilih Jadwal</h1>

                </div>


              </div>
              {{-- <form action="{{ route('filterdata') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div  class="row mt-2">

                    <div class="col-12 col-md-4 col-lg-4">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-calendar-days"></i></span>

                            </div>
                            <input type="date" class="form-control" name="book_date" placeholder="Pilih Tanggal" aria-label="Pilih Tanggal" aria-describedby="basic-addon1">
                        </div>
                    </div>
                    <div class="col-12 col-md-4 col-lg-4">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-clock"></i></span>
                                </div>
                                
                                <select name="book_time" id="" class="form-control">
                                    <option value="" selected> Pilih Waktu</option>
                                    <option value="10.00 - 11.00" > 10.00 - 11.00</option>
                                    <option value="10.00 - 11.00" > 10.00 - 11.00</option>
                                </select>
                            </div>
                    </div>

                    
                    <div class="col-12 col-md-4 col-lg-4">
                        <button type="submit" class="btn btn-success btn-md px-3 mb-2 btn-block">Masukkan Keranjang</button>
                    </div>
                </div>
            </form> --}}


            
            @auth
            <form action="{{ route('detail-add', $product->id) }}" method="POST" enctype="multipart/form-data">
              @csrf
              <div  class="row mt-2">

                    <div class="col-12 col-md-4 col-lg-4">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-calendar-days"></i></span>

                            </div>
                            <input type="date" class="form-control" name="book_date" placeholder="Pilih Tanggal" aria-label="Pilih Tanggal" aria-describedby="basic-addon1">
                        </div>
                    </div>
                    <div class="col-12 col-md-4 col-lg-4">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i class="fa-solid fa-clock"></i></span>
                                </div>
                                
                              
                                   
                                    
                                <select name="book_time" id="" class="form-control">
                                    <option value="" selected> Pilih Jadwal</option>
                                    @foreach ($schedule as $schedule)
                                    <option value="{{ $schedule->time }}">{{ $schedule->time }}</option>
                                    @endforeach
                                </select>
                                   
                                
                            </div>
                    </div>

                    
                    <div class="col-12 col-md-4 col-lg-4">
                    @auth
                      @if($product->users_id == Auth::user()->id)
                        <button type="submit" disabled class="btn btn-warning btn-md px-3 mb-2 btn-block">Your Product</button>
                      @else
                        <button type="submit" class="btn btn-success btn-md px-3 mb-2 btn-block">Masukkan Keranjang</button>

                      @endif
                    @endauth
                    </div>
                </div>
              
            </form>

            @else
            <a href="{{ route('login') }}" class="btn btn-warning px-4 text-white btn-block mb-3"> Sign In To Add</a>
            @endauth

            

       
          <h1 class="mt-3" style="font-weight: 900; font-size: 21px;
                  line-height: 32px;">Jadwal Terbooking</h1>

                  @php
                    $now = \Carbon\Carbon::now();
                    $monday = $now->startOfWeek();
                    $tuesday = $monday->copy()->addDay();
                    $wednesday = $tuesday->copy()->addDay();
                    $thursday = $wednesday->copy()->addDay();
                    $friday = $thursday->copy()->addDay();
                    $saturday = $friday->copy()->addDay();
                    $sunday = $saturday->copy()->addDay();
                  @endphp
            <ul class="nav nav-tabs bordered text-center mt-3" id="myTab" role="tablist">
              <li class="nav-item tina">
                <a class="nav-link tabs-size active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Senin <br> {{ $monday->format('Y-m-d') }}</a>
              </li>
              <li class="nav-item tina">
                <a class="nav-link tabs-size" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Selasa <br> {{ $tuesday->format('Y-m-d') }}</a>
              </li>
              <li class="nav-item tina">
                <a class="nav-link tabs-size" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Rabu <br> {{ $wednesday->format('Y-m-d') }}</a>
              </li>
              <li class="nav-item tina">
                <a class="nav-link tabs-size" id="contact-tab1" data-toggle="tab" href="#contact1" role="tab" aria-controls="contact1" aria-selected="false">Kamis <br> {{ $thursday->format('Y-m-d') }}</a>
              </li>
              <li class="nav-item tina">
                <a class="nav-link tabs-size" id="contact-tab2" data-toggle="tab" href="#contact2" role="tab" aria-controls="contact2" aria-selected="false">Jumat <br> {{ $friday->format('Y-m-d') }}</a>
              </li>
              <li class="nav-item tina">
                <a class="nav-link tabs-size" id="contact-tab3" data-toggle="tab" href="#contact3" role="tab" aria-controls="contact3" aria-selected="false">Sabtu <br> {{ $saturday->format('Y-m-d') }}</a>
              </li>
              <li class="nav-item tina">
                <a class="nav-link tabs-size" id="contact-tab4" data-toggle="tab" href="#contact4" role="tab" aria-controls="contact4" aria-selected="false">Minggu <br> {{ $sunday->format('Y-m-d') }}</a>
              </li>
            </ul>
            
            
       @php
                    $now = \Carbon\Carbon::now();
                    $monday = $now->startOfWeek();
                    $tuesday = $monday->copy()->addDay();
                    $wednesday = $tuesday->copy()->addDay();
                    $thursday = $wednesday->copy()->addDay();
                    $friday = $thursday->copy()->addDay();
                    $saturday = $friday->copy()->addDay();
                    $sunday = $saturday->copy()->addDay();
                  @endphp

            <div class="tab-content mt-3 pl-3 pr-4" id="myTabContent">
              <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                <div class="row">

                @foreach ($transactiondetailmonday as $datamonday)
                <div class="col-2 pb-2">
                    {{ $datamonday->book_time }}
                  </div>
                @endforeach
                  
                </div>
              </div>
              <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                <div class="row">

                  @foreach ($transactiondetailtuesday as $datatuesday)
                  <div class="col-2 pb-2">
                      {{ $datatuesday->book_time }}
                    </div>
                  @endforeach
                    
                  </div>
              </div>
              <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                <div class="row">

                @foreach ($transactiondetailwednesday as $datawednesday)
                <div class="col-2 pb-2">
                    {{ $datawednesday->book_time }}
                  </div>
                @endforeach
                  
                </div>
              </div>
              <div class="tab-pane fade" id="contact1" role="tabpanel" aria-labelledby="contact-tab1">
                <div class="row">

                @foreach ($transactiondetailthursday as $datathursday)
                <div class="col-2 pb-2">
                    {{ $datathursday->book_time }}
                  </div>
                @endforeach
                  
                </div>
              </div>
              <div class="tab-pane fade" id="contact2" role="tabpanel" aria-labelledby="contact-tab2">
                <div class="row">

                @foreach ($transactiondetailfriday as $datafriday)
                <div class="col-2 pb-2">
                    {{ $datafriday->book_time }}
                  </div>
                @endforeach
                  
                </div>
              </div>
              <div class="tab-pane fade" id="contact3" role="tabpanel" aria-labelledby="contact-tab3">
                <div class="row">

                @foreach ($transactiondetailsaturday as $datasaturday)
                <div class="col-2 pb-2">
                    {{ $datasaturday->book_time }}
                  </div>
                @endforeach
                  
                </div>
              </div>
              <div class="tab-pane fade" id="contact4" role="tabpanel" aria-labelledby="contact-tab4">
                <div class="row">

                @foreach ($transactiondetailsunday as $datasunday)
                <div class="col-2 pb-2">
                    {{ $datasunday->book_time }}
                  </div>
                @endforeach
                  
                </div>
              </div>
            </div>

        

         

              <div  class="row mt-5">

                    <div class="col-12">
                    @if ($product->user->address_two)
                    <div class="embed-responsive embed-responsive-21by9">
                    <iframe src="https://maps.google.com/maps?q={{ $product->user->address_two }}&z=15&output=embed" width="360" height="270" frameborder="0" style="border:0"></iframe>  
                    @else
                    </div>
                    <img class="img-fluid" src="/images/locationnotfound.jpg" alt="">
                    @endif
                    </div>
                    
                </div>


              


            <!-- Modal -->
           
          </div>


          
        </div>
      </div>
    </section>

    {{-- <section class="store-description">
      <div class="container">
        <div class="row">
          <div class="col-12 col-lg-8">
            {!! $product->description !!}
          </div>
        </div>
      </div>
    </section> --}}

    {{-- <section class="store-review">
      <div class="container">
        <div class="row">
          <div class="col-12 col-lg-8 mt-3 mb-3">
            <h5>Customers Review (3)</h5>
          </div>
        </div>
        <div class="row">
          <div class="col-12 col-lg-8">
            <ul class="list-unstyled">
              <li class="media">
                <img src="/images/icon-testimonial-1.png" class="mr-3 rounded-circle" alt="">
                <div class="media-body">
                  <h5 class="mt-2 mb-1">Riswan Apoy</h5>
                  I thought it was not good for living room. I really happy
                  to decided buy this product last week now feels like homey.
                </div>
              </li>
              <li class="media">
                <img src="/images/icon-testimonial-2.png" class="mr-3 rounded-circle" alt="">
                <div class="media-body">
                  <h5 class="mt-2 mb-1">Riswan Apoy</h5>
                  I thought it was not good for living room. I really happy
                  to decided buy this product last week now feels like homey.
                </div>
              </li>
              <li class="media">
                <img src="/images/icon-testimonial-3.png" class="mr-3 rounded-circle" alt="">
                <div class="media-body">
                  <h5 class="mt-2 mb-1">Riswan Apoy</h5>
                  I thought it was not good for living room. I really happy
                  to decided buy this product last week now feels like homey.
                </div>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </section> --}}
  </div>
</div>
@endsection

@push('addon-script')

<script src="/vendor/vue/vue.js"></script>
<script>
  var gallery = new Vue({
    el: "#gallery",
    mounted() {
      AOS.init();
    },
    data: {
      activePhoto: 0,
      photos: [
        @foreach ($product->galleries as $gallery)
           {
          id: {{ $gallery->id }},
          url: "{{ Storage::url($gallery->photos) }}",
        },
        @endforeach
      ],
    },
    methods: {
      changeActive(id) {
        this.activePhoto = id;
      },
    },
  });

</script>

<script>
function myFunction() {
  var copyText = document.getElementById("myInput");
  copyText.select();
  copyText.setSelectionRange(0, 99999)
  document.execCommand("copy");
  alert("Copy link Arena: " + copyText.value);
}
</script>
 <script type="text/javascript">
    
    // Social Share links.
    const gmailBtn = document.getElementById('gmail-btn');
    const facebookBtn = document.getElementById('facebook-btn');
    const gplusBtn = document.getElementById('gplus-btn');
    const linkedinBtn = document.getElementById('linkedin-btn');
    const twitterBtn = document.getElementById('twitter-btn');
    const whatsappBtn = document.getElementById('whatsapp-btn');
    const socialLinks = document.getElementById('social-links');
    // posturl posttitle
    let postUrl = encodeURI(document.location.href);
    let postTitle = encodeURI('{{$product->name}}');
    facebookBtn.setAttribute("href",`https://www.facebook.com/sharer.php?u=${postUrl}`);
    twitterBtn.setAttribute("href", `https://twitter.com/share?url=${postUrl}&text=${postTitle}`);
    linkedinBtn.setAttribute("href", `https://www.linkedin.com/shareArticle?url=${postUrl}&title=${postTitle}`);
    whatsappBtn.setAttribute("href",`https://wa.me/?text=${postTitle} ${postUrl}`);
    gmailBtn.setAttribute("href",`https://mail.google.com/mail/?view=cm&su=${postTitle}&body=${postUrl}`);
    gplusBtn.setAttribute("href",`https://plus.google.com/share?url=${postUrl}`);
    
    // Button
    const shareBtn = document.getElementById('shareBtn');
    if(navigator.share){
      shareBtn.style.display = 'block';
      socialLinks.style.display = 'block';
      shareBtn.addEventListener('click', ()=>{
        navigator.share({
          title: postTitle,
          url:postUrl
        }).then((result) => {
          alert('Thank You for Sharing.')
        }).catch((err) => {
          console.log(err);
        });;
      });
    }else{
    }
 </script>
@endpush