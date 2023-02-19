<style type="text/css">
.navbar .megamenu{ padding: 1rem; }
/* ============ desktop view ============ */
@media all and (min-width: 992px) {
	
	.navbar .has-megamenu{position:static!important;}
	.navbar .megamenu{margin-left: 150px; width:50%; margin-top:0;  }
	
}	
/* ============ desktop view .end// ============ */


/* ============ mobile view ============ */
@media(max-width: 991px){
	.navbar.fixed-top .navbar-collapse, .navbar.sticky-top .navbar-collapse{
		overflow-y: auto;
	    max-height: 90vh;
	    margin-top:10px;
	}
}

@media all and (min-width: 992px) {
	.navbar .dropdown-menu-end{ right:0; left: auto;  }
	.navbar .nav-item .dropdown-menu{  display:block; opacity: 0;  visibility: hidden; transition:.3s; margin-top:0;  }
	.navbar .nav-item:hover .nav-link{ color: black;  }
	.navbar .dropdown-menu.fade-down{ top:80%; transform: rotateX(-75deg); transform-origin: 0% 0%; }
	.navbar .dropdown-menu.fade-up{ top:180%;  }
	.navbar .nav-item:hover .dropdown-menu{ transition: .3s; opacity:1; visibility:visible; top:100%; transform: rotateX(0deg); }
}
/* ============ mobile view .end// ============ */
</style>

<script type="text/javascript">
	document.addEventListener("DOMContentLoaded", function(){
        /////// Prevent closing from click inside dropdown
        document.querySelectorAll('.dropdown-menu').forEach(function(element){
        	element.addEventListener('click', function (e) {
        		e.stopPropagation();
        	});
        })
    }); 
	// DOMContentLoaded  end
</script>


<nav class="navbar navbar-custom navbar-expand-lg navbar-light navbar-store fixed-top navbar-fixed-top" data-aos="fade-down">
  <div class="container-fluid">
    <a href="{{ route('home') }}" class="navbar-brand">
      <img src="/images/newlogo.png" alt="Logo">
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive">
      <span class="navbar-toggler-icon">
      </span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
    <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
                            <li class="nav-item dropdown has-megamenu">
                                <a class="nav-link underhoper-caang font-16" href="#" data-bs-toggle="dropdown">
                                    <i class="bi bi-app-indicator"></i>&nbsp;Produk Desaku</a>
                                <div class="dropdown-menu fade-down megamenu ms-auto me-auto" role="menu">
                                    @auth
                                      <div class="row g-3">
                                        <div class="col-lg-4 col-6">
                                            <div class="col-megamenu">
                                                <a class="dropdown-item teman-desaku"
                                                    href="http://desaku-desanews.masuk.id/">
                                                    <img class="zoom-logo mt-1" src="{{ asset('img/desanews.png') }}">
                                                    <br>
                                                    <small style="white-space: normal!important;">Berita dan kegiatan
                                                        desa
                                                        terkini dan terupdate di DesaNews!</small>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-6">
                                            <div class="col-megamenu">
                                                <a class="dropdown-item teman-desaku" onclick="event.preventDefault();
                                                      document.getElementById('login-form-desafeed').submit();"
                                                    href="https://desaku-desafeed.masuk.id/autoLogin">
                                                    <img class="zoom-logo" src="{{ asset('img/desafeed.png') }}">
                                                    <br>
                                                    <small style="white-space: normal!important;">Berbagi pengalaman
                                                        pribadi,
                                                        foto dan video berbagai warga desa di DesaFeed!</small>
                                                </a>

                                                <form id="login-form-desafeed" action="https://desaku-desafeed.masuk.id/autoLogin" method="POST" class="d-none">
                                                    <input type="hidden" name="email" value="{{ Auth::user()->email }}">
                                                    <input type="hidden" name="id_desa" value="{{ Auth::user()->villages_id }}">
                                                  </form>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-6">
                                            <div class="col-megamenu">
                                                <a class="dropdown-item teman-desaku"
                                                    href="http://desaku-desatour.masuk.id/">
                                                    <img class="zoom-logo" src="{{ asset('img/desatour.png') }}">
                                                    <br>
                                                    <small style="white-space: normal!important;">Jelajahi wisata,
                                                        kuliner,
                                                        penginapan, dan infrastruktur desa di DesaTour!</small>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-6">
                                            <div class="col-megamenu">
                                                <a class="dropdown-item teman-desaku" onclick="event.preventDefault();
                                                      document.getElementById('login-form-desatube').submit();"
                                                    href="http://desatubenew.test/autoLogin">
                                                    <img class="zoom-logo" src="{{ asset('img/desatube.png') }}">
                                                    <br>
                                                    <small style="white-space: normal!important;">Publish video tentang
                                                        desa,
                                                        kegiatan desa dan cerita desa di DesaTube!</small>
                                                </a>

                                                  <form id="login-form-desatube" action="http://desatubenew.test/autoLogin" method="POST" class="d-none">
                                                    <input type="hidden" name="email" value="{{ Auth::user()->email }}">
                                                    <input type="hidden" name="id_desa" value="{{ Auth::user()->villages_id }}">
                                                  </form>
                                            </div>
                                        </div>
                                       

                                        <div class="col-lg-4 col-6">
                                            <div class="col-megamenu">
                                                <a class="dropdown-item teman-desaku" onclick="event.preventDefault();
                                                      document.getElementById('login-form').submit();"
                                                    href="http://desaku-desacuss.masuk.id/autoLogin">
                                                    <img class="zoom-logo" src="{{ asset('img/desacuss.png') }}">
                                                    <br>
                                                    <small style="white-space: normal!important;">Berbagai produk desa
                                                        yang
                                                        dapat di Jual dan di Beli di DesaStore!</small>
                                                </a>
                                                <form id="login-form" action="http://desaku-desacuss.masuk.id/autoLogin" method="POST" class="d-none">
                                                      
                                                        <input type="hidden" name="email" value="{{ Auth::user()->email }}">
                                                        <input type="hidden" name="id_desa" value="{{ Auth::user()->villages_id }}">
                                                      </form>

                                              
                                            </div>
                                        </div>
                                    </div>
                                    @else
                                    <div class="row g-3">
                                        <div class="col-lg-4 col-6">
                                            <div class="col-megamenu">
                                                <a class="dropdown-item teman-desaku"
                                                    href="http://desaku-desanews.masuk.id/">
                                                    <img class="zoom-logo mt-1" src="{{ asset('img/desanews.png') }}">
                                                    <br>
                                                    <small style="white-space: normal!important;">Berita dan kegiatan
                                                        desa
                                                        terkini dan terupdate di DesaNews!</small>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-6">
                                            <div class="col-megamenu">
                                                <a class="dropdown-item teman-desaku"
                                                    href="http://desaku-desafeed.masuk.id/">
                                                    <img class="zoom-logo" src="{{ asset('img/desafeed.png') }}">
                                                    <br>
                                                    <small style="white-space: normal!important;">Berbagi pengalaman
                                                        pribadi,
                                                        foto dan video berbagai warga desa di DesaFeed!</small>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-6">
                                            <div class="col-megamenu">
                                                <a class="dropdown-item teman-desaku"
                                                    href="http://desaku-desatour.masuk.id/">
                                                    <img class="zoom-logo" src="{{ asset('img/desatour.png') }}">
                                                    <br>
                                                    <small style="white-space: normal!important;">Jelajahi wisata,
                                                        kuliner,
                                                        penginapan, dan infrastruktur desa di DesaTour!</small>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-6">
                                            <div class="col-megamenu">
                                                <a class="dropdown-item teman-desaku"
                                                    href="http://desaku-desafeed.masuk.id/social-media">
                                                    <img class="zoom-logo" src="{{ asset('img/desatube.png') }}">
                                                    <br>
                                                    <small style="white-space: normal!important;">Publish video tentang
                                                        desa,
                                                        kegiatan desa dan cerita desa di DesaTube!</small>
                                                </a>
                                            </div>
                                        </div>
                                       

                                        <div class="col-lg-4 col-6">
                                            <div class="col-megamenu">
                                                <a class="dropdown-item teman-desaku"
                                                    href="http://desaku-desacuss.masuk.id" target="_blank">
                                                    <img class="zoom-logo" src="{{ asset('img/desacuss.png') }}">
                                                    <br>
                                                    <small style="white-space: normal!important;">Berbagai produk desa
                                                        yang
                                                        dapat di Jual dan di Beli di DesaStore!</small>
                                                </a>
                                                

                                              
                                            </div>
                                        </div>
                                    </div>
                                    @endauth
                                </div>
                            </li>
                        </ul>
      <ul class="navbar-nav ml-auto text-center">
       
        <li class="nav-item active">
          <a href="{{ route('home') }}" class="nav-link">Halaman Utama</a>
        </li>

       
        <li class="nav-item">
          <a href="{{ route('categories') }}" class="nav-link">Kategori</a>
        </li>
        <li class="nav-item">
          <a href="{{ route('store-page-search') }}" class="nav-link">TokoKK</a>
        </li>
       
        @guest
        <li class="nav-item">
          <a href="{{ route('register') }}" class="nav-link">Daftar</a>
        </li>
        <li class="nav-item">
          <a href="{{ route('login') }}" class="btn btn-success nav-link px-4 text-white">Masuk</a>
        </li>
        @endguest

      </ul>

      @auth
      <!-- Desktop Menu -->
       {{-- <li class="nav-item active">
            <a href="http://desaku-desacuss.masuk.id/autoLogin/{{ Auth::user()->email }}/12345678" class="nav-link">Tembak Akun Login Muqny  </a>
             <a href="https://marketpalcedesaku.masuk.web.id/autoLogin" onclick="event.preventDefault();
                document.getElementById('login-form').submit();" class="dropdown-item">Auto Login</a>
                 <form id="login-form" action="https://marketpalcedesaku.masuk.web.id/autoLogin" method="POST" class="d-none">
                 
                  <input type="hidden" name="email" value="{{ Auth::user()->email }}">
                  <input type="hidden" name="id_desa" value="{{ Auth::user()->villages_id }}">
                </form>

                
        </li> --}}
      <ul class="navbar-nav d-none d-lg-flex">
        <li class="nav-item dropdown">
          <a href="" class="nav-link" id="navbarDropdown" role="button" data-toggle="dropdown">
            <img src="/images/icon-store.svg" alt="" class="rounded-circle mr-2 profile-picture">
            Hi, {{ Auth::user()->name }}
          </a>
          <div class="dropdown-menu">
            <a href="{{ route('dashboard') }}" class="dropdown-item">Dashborad</a>
            <a href="{{ route('dashboard-settings-account') }}" class="dropdown-item">Settings</a>
            <div class="dropdown-divider"></div>
            <a href="{{ route('logout') }}" onclick="event.preventDefault();
                document.getElementById('logout-form').submit();" class="dropdown-item">Keluar</a>
                 <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                  @csrf
                </form>
          </div>
        </li>
        <li class="nav-item">
          <a href="{{ route('cart') }}" class="nav-link d-inline-block mt-2 pl-0">
            @php
            $cart = \App\Cart::where('users_id', Auth::user()->id)->count();
            @endphp

            @if ($cart > 0)
            <img src="/images/icon-cart-filled.svg"  style="width: 30px;" alt="">
            <div class="card-badge">{{ $cart }}</div>
            @else
            <img src="/images/icon-cart-empty.svg" alt="">
            @endif

          </a>
         
        </li>
      </ul>
      <!-- Mobile Menu -->
      <ul class="navbar-nav d-block d-lg-none">
        <li class="nav-item">
          <a href="" class="nav-link">
            {{ Auth::user()->name }}
          </a>
        </li>
        <li class="nav-item">
          <a href="" class="nav-link d-inline-block">
            Keranjang
          </a>
        </li>
      </ul>
      @endauth

    </div>
  </div>
</nav>