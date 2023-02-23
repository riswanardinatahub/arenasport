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
   
      <ul class="navbar-nav ml-auto text-center">
       
        <li class="nav-item active">
          <a href="{{ route('home') }}" class="nav-link">Halaman Utama</a>
        </li>

       
        <li class="nav-item">
          <a href="{{ route('categories') }}" class="nav-link">Kategori</a>
        </li>
        <li class="nav-item">
          <a href="{{ route('store-page-search') }}" class="nav-link">Arena</a>
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
     
      <ul class="navbar-nav d-none d-lg-flex">
        <li class="nav-item dropdown">
          <a href="" class="nav-link" id="navbarDropdown" role="button" data-toggle="dropdown">
                    @if (Auth::user()->images)
                    <img src="{{ Storage::url(Auth::user()->images) }}" alt="" class="rounded-circle mr-2 profile-picture">
                    @else
                    <img src="/images/icon-store.svg" alt="" class="rounded-circle mr-2 profile-picture">
                    @endif
           
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
        {{-- {{ route('cart') }} --}}
          <a href="#" class="nav-link d-inline-block mt-2 pl-0">
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
        <li class="nav-item">
          <a href="{{ route('dashboard') }}" class="nav-link d-inline-block">
            Dashboard
          </a>
          
        </li>
        <li class="nav-item">
          <a href="{{ route('dashboard-settings-account') }}" class="nav-link d-inline-block">
            Setting
          </a>
          
        </li>
        <li class="nav-item">
          <a class="nav-link d-inline-block" href="{{ route('logout') }}" onclick="event.preventDefault(); 
                document.getElementById('logout-form').submit();" class="dropdown-item">Keluar</a>
                 <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                  @csrf
                </form>
          
        </li>
      </ul>
      @endauth

    </div>
  </div>
</nav>