@extends('admin.layout.index') <!-- kế thừa từ trang index -->

@section('content')
<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Loạt
                    <small>Tin</small>
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
                <a href="admin/loaitin/danhsach"><button type="button" class="btn btn-default">Trang danh sách</button></a><br><br>
                <form action="admin/loaitin/them" method="POST">
                    {{-- phải có token để truyền dữ liệu ko có ko truyền được(kỹ thuật chống tấn công giả mạo) --}}
                    <input type="hidden" name="_token" value="{{csrf_token()}}" />
                    <div class="form-group">
                        <label>Thể loại</label>
                        <select class="form-control" name="TheLoai">
                            @foreach($theloai as $tl)
                            <option value="{{$tl->id}}">{{$tl->Ten}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Tên loại tin</label>
                        <input class="form-control" name="Ten" placeholder="Hãy nhập tên loạt tin" />
                    </div>
                    <button type="submit" class="btn btn-default">Thêm</button>
                    <button type="reset" class="btn btn-default">Nhập lại</button>
                </form>
            </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->
@endsection