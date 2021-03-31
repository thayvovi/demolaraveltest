@extends('admin.layout.index') <!-- kế thừa giao từ trang index -->

@section('content')
<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Tin tức
                    <small>{{$tintuc->TieuDe}}</small>
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
                <form action="admin/tintuc/sua/{{$tintuc->id}}" method="POST" enctype="multipart/form-data">
                    {{-- enctype="multipart/form-data" dùng để thêm ảnh không thì không upload được --}}
                    <input type="hidden" name="_token" value="{{csrf_token()}}" />
                    <div class="form-group">
                        <label>Thể loại</label>
                        <select class="form-control" name="TheLoai" id="TheLoai">
                            @foreach($theloai as $tl)
                            <option 
                            @if($tintuc->loaitin->theloai->id == $tl->id)
                            {{"selected"}}
                            @endif
                            value="{{$tl->id}}">{{$tl->Ten}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Loại Tin</label>
                        <select class="form-control"  name="LoaiTin" id="LoaiTin">
                            @foreach($loaitin as $lt)
                            <option 
                            @if($tintuc->loaitin->id == $lt->id)
                            {{"selected"}}
                            @endif
                            value="{{$lt->idLoaiTin}}">{{$lt->Ten}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Tiêu đề</label>
                        <input class="form-control" name="TieuDe" value="{{$tintuc->TieuDe}}" placeholder="Hãy nhập tiêu đề" />
                    </div>
                    <div class="form-group">
                        <label>Tóm tắt</label>
                        <textarea id="demo" class="ckeditor" name="TomTat" rows="3">{{$tintuc->TomTat}}</textarea> {{-- Trình soạn thảo cảu nội dung --}}
                    </div>
                    <div class="form-group">
                        <label>Nội dung</label>
                        <textarea id="demo" class="ckeditor" name="NoiDung"  rows="5">{{$tintuc->NoiDung}}</textarea> {{-- Trình soạn thảo cảu nội dung --}}
                    </div>
                    <div class="form-group">
                        <label>Chọn hình ảnh</label>
                        <p><img src="upload/tintuc/{{$tintuc->Hinh}}"  width="400px" alt=""><p>
                            <input type="file" name="Hinh" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Nổi bật</label>
                            <label class="radio-inline">
                                <input type="radio" value="0" 
                                @if($tintuc->NoiBat == 0)
                                {{"checked"}}
                                @endif
                                name="NoiBat">Không Có</input>
                            </label>
                            <label class="radio-inline">
                                <input type="radio" value="1"
                                @if($tintuc->NoiBat == 1)
                                {{"checked"}}
                                @endif
                                name="NoiBat">Có</input>
                            </label>
                        </div>
                        <button type="submit" class="btn btn-default">Sửa</button>
                        <button type="reset" class="btn btn-default">Reset</button>
                        <form>
                        </div>
                    </div>

                    {{-- Comment --}}
                    <!-- /.row -->
                    <div class="row">
                        <div class="col-lg-12">
                            <h1 class="page-header">Bình Luận
                                <small>Danh sách</small>
                            </h1>
                        </div>
                        @if(session('thongbao')) {{-- xem tồn tại thông báo ở session không --}}
                        <div class="alert alert-success">
                            {{session('thongbao')}}
                        </div>
                        @endif
                        <!-- /.col-lg-12 -->
                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                                <tr align="center">
                                    <th>ID</th>
                                    <th>TNgười dùng</th>
                                    <th>Nội dung</th>
                                    <th>Ngày đăng</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($tintuc->comment as $cm)
                                <tr class="odd gradeX" align="center">
                                    <td>{{$cm->id}}</td>
                                    <td>{{$cm->user->name}}</td>
                                    <td>{{$cm->NoiDung}}</td>
                                    <td>{{$cm->created_at}}</td>
                                    <td class="center"><i class="fa fa-trash-o fa-fw"></i><a href="admin/comment/xoa/{{$cm->id}}/{{$tintuc->id}}"> Delete</a></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.endrow -->
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