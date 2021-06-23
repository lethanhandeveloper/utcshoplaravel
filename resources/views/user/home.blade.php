<!DOCTYPE html>
<html>
<head>
	<title>Trang chủ</title>
</head>
<body>

	<div class="wrap-content container border shadow">
		@include('user/header')
		<div class="content">
			<div class="row mx-1 my-2 border p-2">
				<img src="{{ url('img/banner/blackfriday.gif') }}" alt="" class="img-fluid">
			</div>
			<div class="newproduct-title alert alert-danger w-100 text-center font-weight-bold" role="alert">
				<img src="{{ asset('public/images/new.gif') }}">
				SẢN PHẨM MỚI NHẤT
				<img src="{{ asset('public/images/new.gif') }}">
			</div>

			<div class="topsell-content mb-3">
				<div class="row">
					@foreach ($new_products as $new_product)
						<div class="col-md-3 col-6">
							<div class="product-item border m-2 p-2">
								<div class="product-thumb">
									<img src="{{ asset('public/images/product') }}/{{$new_product ->image}}" alt="" class="img-fluid">
								</div>
								<div class="product-info text-center mt-2">
									<a href="">{{ $new_product ->name }}</a>
									<div class="price-box">
										@if($new_product ->discount == 0)
											<span class="text-danger">{{ number_format($new_product ->price) }}<sup>đ</sup></span>
										@else 
											<span class="text-danger">
												{{ number_format($new_product ->price*((100 - $new_product ->discount)) /100) }}<sup>đ</sup>
											</span>
											<strike>
											<span class="text-muted">{{ number_format($new_product ->price) }}<sup>đ</sup></span>
											</strike>
											
										@endif
									</div>
									<a href="" class="btn btn-outline-danger btn-reponsive  text-center"><i class="fas fa-shopping-cart d-sm-none"></i> <span class="btn-text-reponsive">Thêm vào giỏ hàng</span></a>
								</div>
							</div>
						</div> 
					@endforeach
				</div>
			</div>
		</div>
		<div class="modal fade" id="modalAccount" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
			<div class="modal-dialog">
			  <div class="modal-content">
				<div class="modal-header">
				  <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
				  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
				  ...
				</div>
				<div class="modal-footer">
				  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
				  <button type="button" class="btn btn-primary">Understood</button>
				</div>
			  </div>
			</div>
		  </div>
		  <script>
			  $(document).ready(function () {
				  
			  });
		  </script>
		@include('user/footer')
	</div>	
	
</body>
</html>