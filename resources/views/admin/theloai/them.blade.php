@extends('admin.layout.index') <!-- kế thừa từ trang index -->

@section('content')
<!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Category
                            <small>Add</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <div class="col-lg-7" style="padding-bottom:120px">
                        @if(count($errors) > 0) {{-- đếm errors xem có lỗi ko --}}
                            <div class="alert alert-danger">
                                @foreach($errors->all() as $err) {{-- có lỗi thì in ra --}}
                                    {{$err}}<br>
                                @endforeach
                            </div>
                        @endif

                        @if(session('thongbao')) {{-- xem tồn tại thông báo ở session không --}}
                            <div class="alert alert-success">
                                {{session('thongbao')}}
                            </div>
                        @endif
                        <a href="admin/theloai/danhsach"><button type="button" class="btn btn-default">Trang danh sách</button></a><br><br>
                        <form action="admin/theloai/them" method="POST">
                            {{-- phỉa có token để truyền dữ liệu ko có ko truyền được(kỹ thuật chống tấn công giả mạo) --}}
                            <input type="hidden" name="_token" value="{{csrf_token()}}" />
                            <div class="form-group">
                                <label>Category Name</label>
                                <input class="form-control" name="Ten" placeholder="Please Enter Category Name" />
                            </div>
                            <button type="submit" class="btn btn-default">Category Add</button>
                            <button type="reset" class="btn btn-default">Reset</button>
                        </form>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->
@endsection