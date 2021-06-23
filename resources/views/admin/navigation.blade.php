{{-- library --}}
@include('library')
{{-- javascript --}}    
<script src="{{ asset('javascript/admin.js') }}"></script>
{{-- css --}}
<link rel="stylesheet" href="{{ asset('css/admin.css') }}">

<nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom ">
    <div id="menu-toggle" onclick="handleIconMenu(this)" class="change">
      <div class="bar1"></div>
      <div class="bar2"></div>
      <div class="bar3"></div>
    </div>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
  
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Admin {{ Auth::user() ->name }}
          </a>
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
          <!--   <a class="dropdown-item" href="#">Action</a>
            <a class="dropdown-item" href="#">Another action</a>
            <div class="dropdown-divider"></div> -->
            <a class="dropdown-item" href="{{ route('logout') }}"><i class="fas fa-sign-out-alt"></i> Đăng Xuất</a>
          </div>
        </li>
      </ul>
    </div>
  </nav>