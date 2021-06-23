<!DOCTYPE html>
<html lang="en">

<head>
  <title>Danh Mục Sản Phẩm</title>
  <meta name="csrf-token" content="{{ csrf_token() }}">
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
        <h2 class="mt-4 text-center text-uppercase">Danh Sách Danh Mục</h2>
        
        {{-- <a href="{{ url('admin/category/add') }}" class="btn btn-primary m-3 float-right">Thêm Danh Mục</a> --}}
        <button id="btn-add-category" class="btn btn-primary m-3 float-right"  data-toggle="modal" data-target="#formModal">
          Thêm Danh Mục
        </button>
        <table class="table table-bordered table-sm">
          <thead class="thead-dark">
            <tr>
              <th scope="col">Số TT</th>
              <th scope="col">Tên Danh Mục</th>
              <th scope="col">Hình Ảnh</th>
              <th scope="col">Loại Danh Mục</th>
              <th scope="col" style="width: 10%">Thao Tác</th>
              
            </tr>
          </thead>
          <tbody>
            @php
                if (empty($_GET['page']) || $_GET['page'] ==1 ) $stt = 1;
                else $stt = ($_GET['page'] -1 ) *10 +1;
            @endphp
            @foreach ($categories as $category)
            <tr>
              <th scope="row">{{ $stt++ }}</th>
              <td><input type="text" value="{{ $category->name }}" class="form-control name-category" name="name"/></td>
              <td><img src="{{ url('public/images/category/') }}/{{ $category -> image }}" style="width: 100px"></td>
              <td class="form-group">
                <select class="form-control level-category" name="level">
                  @if (($category ->level == "1"))
                    <option selected value="1">Điện thoại</option>
                    <option value="2">Phụ kiện</option>
                  @else
                    <option value="1">Điện thoại</option>
                    <option selected value="2">Phụ kiện</option>
                  @endif
                </select>
              </td>
              <td>
                <form method="post" action="{{ url('admin/category') }}/{{ $category->id }}" class="d-inline">
                  @csrf
                  @method('delete')
                  <button type="submit" class="btn btn-danger mb-md-0 mb-2">Xóa</button>
                </form>
                <form method="post" action="{{ url('admin/category') }}/{{ $category->id }}" class="d-inline">
                  @csrf
                  @method('put')
                  <button type="submit" class="btn btn-success mb-md-0 mb-2">Sửa</button>
                </form>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
        <div class="pagination pagination-sm">
          {{ $categories->links() }}
        </div>
    </div>
    <!-- /#page-content-wrapper -->
    {{-- form-modal --}}
    <div class="modal fade" id="formModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Thêm danh mục</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form action="{{ url('admin/category') }}" class="p-md-1 p-3" enctype="multipart/form-data" method="post">
            @csrf
            <div class="form-group">
              <label>Tên Danh Mục</label>
              <input type="text" class="form-control" name="name">
            </div>
            <div class="form-group">
              <label>Hình Ảnh</label>
              <input type="file" class="form-control" name="image">
            </div>
            <div class="form-group">
              <label for="inputAddress">Loại Danh Mục</label>
              <select class="form-control" name="level">
                <option value="1">Điện Thoại</option>
                <option value="2">Phụ Kiện</option>
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
    <input type="hidden" id="url-edit" value="{{ url('admin/category') }}">
    <input type="hidden" id="csrftoken" value="{{ csrf_token() }}">
    @if (session('status'))
      <div id="snackbar">{{ session('status') }}</div>
    @endif
  </div>
  <!-- /#wrapper -->
</div>
</body>
</html>