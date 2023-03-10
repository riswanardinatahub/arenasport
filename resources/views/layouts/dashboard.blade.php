<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="description" content="" />
  <meta name="author" content="" />

  <title>@yield('title')</title>
  @stack('prepend-style')
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" />
  <link href="https://cdn.datatables.net/1.13.3/css/dataTables.bootstrap5.min.css" rel="stylesheet" />
  <link href="/style/main.css" rel="stylesheet" />
   <script src="https://kit.fontawesome.com/069e062e69.js" crossorigin="anonymous"></script>
  @stack('addon-style')
</head>

<body>

  <div class="page-dashboard">
    <div class="d-flex" id="wrapper" data-aos="fade-right">
      <!-- Sidebar -->
      <div class="border-right" id="sidebar-wrapper">
        <div class="sidebar-heading text-center">
          <img src="/images/dashboard-store-logo.svg" alt="" height="150" class="my-4">
        </div>
        <div class="list-group list-group-flush">
          <a href="{{ route('dashboard') }}" 
             class="list-group-item list-group-item-action {{ Request::is('dashboard') ? 'active' : '' }}">Dashboard</a>
         @if (Auth::user()->roles == 'ADMINSTORE')
                    <a href="{{ route('admin-store-dashboard') }}" 
             class="list-group-item list-group-item-action {{ Request::is('admin-store-dashboard') ? 'active' : '' }}">Dashboard Utama</a>
                        
                    @endif
          <a href="{{ route('dashboard-product') }}" 
             class="list-group-item list-group-item-action {{ Request::is('dashboard/products') ? 'active' : '' }} ">Lapangan</a>
          <a href="{{ route('dashboard-transaction') }}" 
             class="list-group-item list-group-item-action {{ Request::is('dashboard/transactions') ? 'active' : '' }}">Transaksi</a>
          <a href="{{ route('transactionsreport') }}" 
             class="list-group-item list-group-item-action {{ Request::is('dashboard/transactionsreport') ? 'active' : '' }}">Laporan Transaksi</a>
          {{-- <a href="{{ route('dashboard-settings-store') }}" 
             class="list-group-item list-group-item-action {{ Request::is('dashboard/settings') ? 'active' : '' }}">Toko Setting</a> --}}
          <a href="{{ route('dashboard-settings-account') }}" 
             class="list-group-item list-group-item-action {{ Request::is('dashboard/account') ? 'active' : '' }}">Arena Setting</a>
          <a href="{{ route('logout') }}" onclick="event.preventDefault();
                document.getElementById('logout-form').submit();" 
             class="list-group-item list-group-item-action">Keluar</a>
        </div>
      </div>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
          </form>

      <!-- Page Content -->
      <div id="page-content-wrapper">
        <nav class="navbar navbar-expand-lg navbar-light navbar-store fixed-top" data-aos="fade-down">
          <div class="container-fluid">

            <button class="btn btn-secondary d-md-none mr-auto mr-2" id="menu-toggle">
              &laquo; Menu
            </button>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent">
              <span class="navbar-toggler-icon">
              </span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">

              <!-- Desktop Menu -->
              <ul class="navbar-nav d-none d-lg-flex ml-auto">
                <li class="nav-item dropdown">
                  <a href="" class="nav-link" id="navbarDropdown" role="button" data-toggle="dropdown">
                     @if (Auth::user()->images)
                    <img src="{{ Storage::url(Auth::user()->images) }}" alt="" class="rounded-circle mr-2 profile-picture">
                    @else
                    <img src="/images/icon-store.svg" alt="" class="rounded-circle mr-2 profile-picture">
                    @endif
                    {{ Auth::user()->name }}
                  </a>
                <div class="dropdown-menu">
                    <a href="{{ route('dashboard') }}" class="dropdown-item">Dashborad</a>
                    
                    <a href="{{ route('dashboard-settings-account') }}" class="dropdown-item">Settings</a>
                    <div class="dropdown-divider"></div>
                    <a href="{{ route('logout') }}" onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();" class="dropdown-item">Logout</a>
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
                    Cart
                  </a>
                </li>
              </ul>
            </div>
          </div>
        </nav>


        
     {{-- Content --}}
     @yield('content')
    

      </div>
    </div>
  </div>



  <!-- Bootstrap core JavaScript -->
  @stack('prepend-script')
  <script src=" /vendor/jquery/jquery.slim.min.js">
  </script>
  <script src="/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
  <script src="https://cdn.datatables.net/1.13.3/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.3/js/dataTables.bootstrap5.min.js"></script>


  <script>
    AOS.init();
  </script>
  <script>
    $('#menu-toggle').click(function (e) {
      e.preventDefault();
      $('#wrapper').toggleClass('toggled');
    });
  </script>

  <script>
  $(document).ready(function () {
    $('#exampless').DataTable();
  });
</script>

  @stack('addon-script')
</body>

</html>