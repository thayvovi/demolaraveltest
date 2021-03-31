@extends('admin.layout.index') <!-- kế thừa giao từ trang index -->

@section('content')
<!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">User
                            <small>thêm</small>
                        </h1>
                    </div>
                    <a href="admin/user/danhsach"><button type="button" class="btn btn-default">Trang danh sách</button></a><br><br>
                    <!-- /.col-lg-12 -->
                    <div class="col-lg-7" style="padding-bottom:120px">
                        @if(count($errors) > 0) {{-- đếm errors xem có lỗi ko --}}
                            <div class="alert alert-danger">
                                @foreach($errors->all() as $err) {{-- có lỗi thì in ra --}}
                                    {{$err}}<br>
                                @endforeach
                            </div>
                        @endif
                        @if(session('loi')) {{-- xem tồn tại thông báo ở session không --}}
                            <div class="alert alert-danger">
                                {{session('loi')}}
                            </div>
                        @endif
                        @if(session('thongbao')) {{-- xem tồn tại thông báo ở session không --}}
                            <div class="alert alert-success">
                                {{session('thongbao')}}
                            </div>
                        @endif
                        <form action="admin/user/them" method="POST">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <div class="form-group">
                                <label>Họ tên</label>
                                <input class="form-control" name="name" placeholder="Nhập tên người dùng" />
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input class="form-control" name="email" placeholder="Nhập dịa chỉ email" />
                            </div>
                            <div class="form-group">
                                <label>Mật khẩu</label>
                                <input type="password" class="form-control" name="password" placeholder="Nhập mật khẩu" />
                            </div>
                            <div class="form-group">
                                <label>Nhập lại mật khẩu</label>
                                <input type="password" class="form-control" name="passwordAgain" placeholder="Nhập lại mật khẩu" />
                            </div>
                            <div class="form-group">
                                <label>Quyền</label>
                                <label class="radio-inline">
                                    <input name="quyen" value="0" checked="" type="radio">Thường
                                </label>
                                <label class="radio-inline">
                                    <input name="quyen" value="1" type="radio">Admin
                                </label>
                            </div>
                            <button type="submit" class="btn btn-default">Thêm</button>
                            <button type="reset" class="btn btn-default">Reset</button>
                        <form>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->
@endsection