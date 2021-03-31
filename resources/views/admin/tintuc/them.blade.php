@extends('admin.layout.index') <!-- kế thừa giao từ trang index -->

@section('content')
<!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Tin tức
                            <small>Thêm</small>
                        </h1>
                    </div>
                    <a href="admin/tintuc/danhsach"><button type="button" class="btn btn-default">Trang danh sách</button></a><br><br>
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
                        <form action="admin/tintuc/them" method="POST" enctype="multipart/form-data">
                            {{-- enctype="multipart/form-data" dùng để thêm ảnh không thì không upload được --}}
                            <input type="hidden" name="_token" value="{{csrf_token()}}" />
                            <div class="form-group">
                                <label>Thể loại</label>
                                <select class="form-control" name="TheLoai" id="TheLoai">
                                    @foreach($theloai as $tl)
                                        <option value="{{$tl->id}}">{{$tl->Ten}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Loại Tin</label>
                                <select class="form-control"  name="LoaiTin" id="LoaiTin">
                                    @foreach($loaitin as $lt)
                                        <option value="{{$lt->id}}">{{$lt->Ten}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Tiêu đề</label>
                                <input class="form-control" name="TieuDe" placeholder="Hãy nhập tiêu đề" />
                            </div>
                            <div class="form-group">
                                <label>Tóm tắt</label>
                                <textarea id="demo" class="ckeditor" name="TomTat" rows="3"></textarea> {{-- Trình soạn thảo cảu nội dung --}}
                            </div>
                            <div class="form-group">
                                <label>Nội dung</label>
                                <textarea id="demo" class="ckeditor" name="NoiDung" rows="5"></textarea> {{-- Trình soạn thảo cảu nội dung --}}
                            </div>
                            <div class="form-group">
                                <label>Chọn hình ảnh</label>
                                <input type="file" name="Hinh" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Nổi bật</label>
                                <label class="radio-inline">
                                    <input type="radio" value="0" checked="checked" name="NoiBat">Không Có</input>
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" value="1" name="NoiBat">Có</input>
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
@section('script')
    <script>
        /*
        đoạn kiểm tra jquery xem sử dụng được chưa
        $(document).ready(function() {
            alert('Đã chèn được');
        })
         */
        //bắt sự kiện thể loại để hiển thị danh sách loạit in thuộc thể loại đó
        $(document).ready(function(){
            $('#TheLoai').change(function() {
                var idTheLoai = $(this).val();
                //alert(idTheLoai);//Kiểm tra xem nhận được id chưa
                //Tạo trang ajax truyền theo phương thức get
                $.get('admin/ajax/loaitin/'+idTheLoai,function(data){//với loaitin get theo idTheLoai
                    //alert(data);//kiểm tra nhậ dữ liệu
                    $('#LoaiTin').html(data)//trả dữ liệu ra màn hình

                });
            });
        });
        ;
    </script>
@endsection