<!DOCTYPE html>
<html lang="en">

<head>
  <title>Các Sản Phẩm</title>
</head>

<body>
  <div class="d-flex" id="wrapper">

    <!-- Sidebar -->
    @include('admin/sidebar')

    <!-- /#sidebar-wrapper -->

    <!-- Page Content -->
    <div id="page-content-wrapper">
    @include('admin/navigation')
      <div class="container-fluid">
        <h2 class="mt-4 text-center text-uppercase">Danh Sách Sản Phẩm</h2>
        <button  class="btn btn-primary m-3 float-right" data-toggle="modal" data-target="#formModal">Thêm Sản Phẩm</button>
        <table class="table table-bordered table-sm">
          <thead class="thead-dark">
            <tr>
            <th scope="col">Số TT</th>
              <th scope="col">Tên Sản Phẩm</th>
              <th scope="col">Hình Ảnh</th>
              <th scope="col">Số lượng</th>
              <th scope="col">Đã bán</th>
              <th scope="col">Giá</th>
              <th scope="col">Thuộc danh mục</th>
              <th scope="col" style="width: 10%" class="text-center">Thao Tác</th>
            </tr>
          </thead>
          <tbody>
            @php
              if (empty($_GET['page']) || $_GET['page'] ==1 ) $stt = 1;
              else $stt = ($_GET['page'] -1 ) *10 +1;
            @endphp
            @foreach ($products as $product)
            <tr>
              <th scope="row">{{ $stt++ }}</th>
              <td>{{ $product->name }}</td>
              <td><img src="{{ url('public/images/product/') }}/{{ $product -> image }}" style="width: 100px"></td>
              <td>{{ $product ->quantity }}</td>
              <td>{{ $product ->sold }}</td>
              <td>{{ $product ->price }}</td>
              <td>{{ $product ->category_id }}</td>
              <td>
                <a href="" class="btn btn-danger mb-md-0 mb-2">Xóa</a>
                <a href="" class="btn btn-success">Sửa</a>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
        <div class="pagination pagination-sm">
          {{ $products->links() }}
        </div>
    </div>
    <!-- /#page-content-wrapper -->
    {{-- add-product-modal --}} 
    <div class="modal fade" id="formModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Thêm sản phẩm</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            
            <form action="{{ url('admin/product') }}" class="" enctype="multipart/form-data" method="post">
              @csrf
              <div class="form-group">
                <label>Tên Sản Phẩm</label>
                <input type="text" class="form-control" name="name">
              </div>
              <div class="form-group">
                <label>Hình Ảnh</label>
                <input type="file" class="form-control" name="image">
              </div>
              <div class="form-group">
                <label>Mô tả</label>
                <textarea class="form-control" name="description"></textarea>
              </div>
               <div class="form-group">
                <label>Số lượng</label>
                <input type="number" name="quantity" class="form-control" value="1">
              </div>
              <div class="form-group">
                <label>Đã bán</label>
                <input type="number" name="sold" class="form-control" value="1">
              </div>
              <div class="form-group">
                <label>Giá</label>
                <input type="number" name="price" class="form-control" value="1">
              </div>
              <div class="form-group">
                <label>Giảm giá (%)</label>
                <input type="number" name="discount" class="form-control" value="1">
              </div>
              <div class="form-group">
                <label>Khuyến mãi</label>
                <input type="text" name="promotion" class="form-control" value="1">
              </div>
              <div class="form-group">
                <label>Thuộc danh mục</label>
                <select class="form-control" name="category_id">
                  {{-- <?php foreach ($categories as $value): ?>
                    <option value=""></option>
                  <?php endforeach ?> --}}
                </select>
              </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-primary">Lưu lại</button>
            </div>
          </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- /#wrapper -->
</div>
</body>
</html>