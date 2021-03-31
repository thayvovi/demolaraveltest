@extends('admin.layout.index') <!-- kế thừa giao từ trang index -->

@section('content')
<!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Slide
                            <small>Sửa</small>
                        </h1>
                    </div>
                    <a href="admin/slide/danhsach"><button type="button" class="btn btn-default">Trang danh sách</button></a><br><br>
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
                        <form action="admin/slide/sua/{{$slide->id}}" method="POST" enctype="multipart/form-data">
                            {{-- enctype="multipart/form-data" dùng để thêm ảnh không thì không upload được --}}
                            <input type="hidden" name="_token" value="{{csrf_token()}}" />
                            <div class="form-group">
                                <label>Tên</label>
                                <input class="form-control" name="Ten" value="{{$slide->Ten}}" placeholder="Hãy nhập slide" />
                            </div>
                            <div class="form-group">
                                <label>Nội dung</label>
                                <textarea id="demo" class="ckeditor" name="NoiDung" rows="5">{{$slide->NoiDung}}</textarea> {{-- Trình soạn thảo của nội dung --}}
                            </div>
                            <div class="form-group">
                                <label>Link</label>
                                <input type="text" name="link" value="{{$slide->link}}" placeholder="Nhập link" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Chọn hình ảnh</label>
                                <p><img src="upload/slide/{{$slide->Hinh}}"  width="400px" alt=""><p>
                                <input type="file" name="Hinh" class="form-control">
                            </div>
                            <button type="submit" class="btn btn-default">Sửa</button>
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