@extends('layouts.app')

@section('title')
Detail Page
@endsection

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
            <h1>{{ $product->name }}</h1>
            <div class="price">Rp. {{ number_format($product->price) }}</div>
              <div>
                    @if ($product->stock >= 1)
                      <span style="font-size:17px; color:#29a867; ">
                         Arena Tersedia

                      </span>
                      @else
                      <span style="font-size:17px; color:red; ">
                          Arena Tidak Tersedia

                      </span>
                    @endif
              </div>
            <div class="owner mt-3">
              <a href="{{ route('store-page-detail', $product->user->id) }}" class="card-list d-block">
                <div class="card-body py-0">
                  <div class="row">
                    @if ($product->user->images)
                    <img src="{{ Storage::url($product->user->images) }}" alt="" class="mr-2">
                    @else
                    <img src="/images/icon-store.svg" alt="" class="mr-2">
                    @endif
                    <p class="text-muted">{{ $product->user->store_name }}</p>
                   
                  </div>
                </div>
              </a>
            </div>
             <a href="" class="btn btn-info" data-toggle="modal" data-target="#exampleModalCenter"> Share</a>


            <!-- Modal -->
           
          </div>


          {{-- <div class="col-lg-2" data-aos="zoom-in">
            @auth
            <form action="{{ route('detail-add', $product->id) }}" method="POST" enctype="multipart/form-data">
              @csrf
              @auth
                @if($product->users_id == Auth::user()->id)
                   <button type="submit" disabled class="btn btn-warning px-4 text-white btn-block mb-3">Your Product</button>
                @else
                   <button type="submit" class="btn btn-success px-4 text-white btn-block mb-3"> Masukkan Ke Keranjang</button>
                @endif
              @endauth
            </form>

            @else
            <a href="{{ route('login') }}" class="btn btn-warning px-4 text-white btn-block mb-3"> Sign In To Add</a>
            @endauth

          </div> --}}
        </div>
      </div>
    </section>

    <section class="store-description">
      <div class="container">
        <div class="row">
          <div class="col-12 col-lg-8">
            {!! $product->description !!}
          </div>
        </div>
      </div>
    </section>

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