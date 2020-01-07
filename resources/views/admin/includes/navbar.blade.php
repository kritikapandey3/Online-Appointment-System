<header class="header">
    <nav class="navbar">
      <div class="container-fluid">
        <div class="navbar-holder d-flex align-items-center justify-content-between">
          <div class="navbar-header"><a id="toggle-btn" href="#" class="menu-btn"><i class="icon-bars"> </i></a><a href="{{ route('admin.dashboard') }}" class="navbar-brand">
              <div class="brand-text d-none d-md-inline-block"><span>Hospital </span><strong class="text-primary">System</strong></div></a></div>
          <ul class="nav-menu list-unstyled d-flex flex-md-row align-items-md-center">
            <!-- Languages dropdown    -->
            <li class="nav-item"><a id="languages" rel="nofollow" data-target="#" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link language dropdown-toggle"><img src="{{asset('foryou/img/flags/16/GB.png')}}" alt="English"><span class="d-none d-sm-inline-block">English</span></a>
            <!-- Log out-->
            <li class="nav-item"><a href="" onclick="logoutt()" class="nav-link logout"> <span class="d-none d-sm-inline-block">Logout</span><i class="fa fa-sign-out"></i></a></li>
            <form action="{{route('logout')}}" id="logout-form" method="POST">
              @csrf
            </form>
          </ul>
        </div>
      </div>
    </nav>
  </header>
  @push('js')
    <script>
       function logoutt() {
         if(confirm('Are you sure you want to logout?')){
            document.getElementById('logout-form').submit();
         }
       }
  </script>
  @endpush