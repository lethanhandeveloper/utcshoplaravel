@include('library')
{{-- css --}}
<link rel="stylesheet" href="{{ asset('css/user.css') }}">
{{-- javascript --}}    
<script src="{{ asset('javascript/user.js') }}"></script>
<div id="top" class="border-bottom mt-2">
	<span class="d-md-inline d-none"><i class="fa fa-phone"> Hotline:033.756.5921</i></span>
	<div id="top-right">
		<input type="hidden" id="username" value="">
		<input type="hidden" id="userid" value="">
		@auth
			<span>
				<span class="dropdown">
					<a href="" class="dropdown-toggle font-weight-bold" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						<i class="fas fa-user"></i> {{ Auth::user() ->name }}
					</a>
					<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
						<a class="dropdown-item" href=""><i class="fas fa-receipt"></i> </i> Thông tin đơn hàng</a>
						<div class="dropdown-divider"></div>	
						<a class="dropdown-item" href="{{ url('logout') }}"><i class="fas fa-sign-out-alt"></i> Đăng xuất</a>
					</div>
				</span>
			</span>
		@endauth	
		@guest
			<span class="text-primary" style="cursor: pointer"><i class="fas fa-user" data-toggle="modal" data-target="#loginModal"> Đăng nhập/Đăng ký</i></span>
		@endguest
		<span class="border-left"><a href=""><i class="fas fa-shopping-cart"> Giỏ hàng</i></a></span>
	</div>
</div>
<div class="top-header row pt-3 mb-3">
	<div class="logo col-md-3 col-12">
		<a href="">
			<img src="{{ asset('public/images/logo.png ')}}" alt="" class="img-fluid" >
		</a>
	</div>
	<div class="col-md-4">

	</div>
	<div class="col-md-5 mt-md-0 mt-sm-3 mt-3">
		<form action="" method="get">
			<input id="search-box" type="text" name="content" placeholder="Nhập sản phẩm để tìm kiếm..." value="">
			<button id="btn-search" type="submit"><i class="fa fa-search"></i></button>
		</form>
	</div>
</div>
<div class="topnav mb-3" id="myTopnav">
	<a href="{{url('')}}" class="active m-md-0"><i class="home-icon fa fa-home d-md-none d-block"></i><span class="search-icon d-md-block d-none">TRANG CHỦ</span></a>
	<a href="{{url('product/1')}}">ĐIỆN THOẠI</a>
	<a href="{{url('product/2')}}">PHỤ KIỆN</a>
	<a href="#about">KHUYẾN MÃI</a>
	<a href="news">TIN TỨC</a>
	<a href="support">HỖ TRỢ</a>
	<a href="about">GIỚI THIỆU</a>
	<a href="javascript:void(0);" class="icon" onclick="myFunction()">
		<i class="fa fa-bars"></i>
	</a>
</div>
<div id="carouselExampleIndicators" class="carousel slide mb-3" data-ride="carousel">
	<ol class="carousel-indicators">
		<li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
		<li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
		<li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
		<li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
		<li data-target="#carouselExampleIndicators" data-slide-to="4"></li>
		<li data-target="#carouselExampleIndicators" data-slide-to="5"></li>
	</ol>
	<div class="carousel-inner">
		<div class="carousel-item active">
			<img  src="{{ asset('public/images/slide/slide1.png') }}"  style="width: 100%">
		</div>
		<div class="carousel-item">
			<img class="d-block w-100" src="{{ asset('public/images/slide/slide2.png') }}" style="width: 100%">
		</div>
		<div class="carousel-item">
			<img class="d-block w-100" src="{{ asset('public/images/slide/slide3.png') }}" style="width: 100%">
		</div>
		<div class="carousel-item">
			<img class="d-block w-100" src="{{ asset('public/images/slide/slide5.png') }}" style="width: 100%">
		</div>
		<div class="carousel-item">
			<img class="d-block w-100" src="{{ asset('public/images/slide/slide6.png') }}" style="width: 100%">
		</div>
	</div>
	<a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
		<span class="carousel-control-prev-icon" aria-hidden="true"></span>
		<span class="sr-only">Previous</span>
	</a>
	<a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
		<span class="carousel-control-next-icon" aria-hidden="true"></span>
		<span class="sr-only">Next</span>
	</a>
</div>
{{-- login-modal --}}
<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
	  <div class="modal-content">
		<div class="modal-header">
			ĐĂNG NHẬP
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			  </button>
		</div>
		<div class="modal-body">
			<form method="post" action="{{ url('login') }}">
				@csrf
				<div class="form-group">
				  <input type="text" class="form-control" aria-describedby="emailHelp" placeholder="Email hoặc số di động" name="username">
				</div>
				<div class="form-group">
				  <input type="password" class="form-control"  placeholder="Mật khẩu" name="password"/>
				</div>
				{{-- <div class="form-check">
				  <input type="checkbox" class="form-check-input" id="exampleCheck1">
				  <label class="form-check-label" for="exampleCheck1">Check me out</label>
				</div> --}}
				<button type="submit" class="btn btn-primary float-right">Đăng nhập</button>
			  </form>
		</div>
	  </div>
	</div>
  </div>
