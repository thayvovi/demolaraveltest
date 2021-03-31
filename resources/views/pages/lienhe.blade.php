@extends('layout.index')

@section('content')
<!-- Page Content -->
<div class="container">

    {{-- <!-- slider -->
    <div class="row carousel-holder">
        <div class="col-md-12">
            <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                    <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                    <li data-target="#carousel-example-generic" data-slide-to="2"></li>
                </ol>
                <div class="carousel-inner">
                    <div class="item active">
                        <img class="slide-image" src="image/800x300.png" alt="">
                    </div>
                    <div class="item">
                        <img class="slide-image" src="image/800x300.png" alt="">
                    </div>
                    <div class="item">
                        <img class="slide-image" src="image/800x300.png" alt="">
                    </div>
                </div>
                <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                    <span class="glyphicon glyphicon-chevron-left"></span>
                </a>
                <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right"></span>
                </a>
            </div>
        </div>
    </div>
    <!-- end slide --> --}}

    <div class="space20"></div>


    <div class="row main-left">
        @include('layout.menu')

        <div class="col-md-9">
            <div class="panel panel-default">            
                <div class="panel-heading" style="background-color:#337AB7; color:white;" >
                    <h2 style="margin-top:0px; margin-bottom:0px;">Liên hệ</h2>
                </div>

                <div class="panel-body">
                    <!-- item -->
                    <h3><span class="glyphicon glyphicon-align-left"></span> Thông tin liên hệ</h3>

                    <div class="break"></div>
                    <h4><span class= "glyphicon glyphicon-home "></span> Địa chỉ : </h4>
                    <p>298 Cầu Diễn, Từ Liêm, Cầu Giấy, HN </p>

                    <h4><span class="glyphicon glyphicon-envelope"></span> Email : </h4>
                    <p>298 Cầu Diễn, Từ Liêm, Cầu Giấy, HN </p>

                    <h4><span class="glyphicon glyphicon-phone-alt"></span> Điện thoại : </h4>
                    <p>298 Cầu Diễn, Từ Liêm, Cầu Giấy, HN </p>



                    <br><br>
                    <h3><span class="glyphicon glyphicon-globe"></span> Bản đồ</h3>
                    <div class="break"></div><br>
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1861.7368940271629!2d105.73400977587019!3d21.053730996479022!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31345457e292d5bf%3A0x20ac91c94d74439a!2zVHLGsOG7nW5nIMSQ4bqhaSBo4buNYyBDw7RuZyBuZ2hp4buHcCBIw6AgTuG7mWk!5e0!3m2!1svi!2s!4v1616952919986!5m2!1svi!2s" width="600" height="450" style="border:0;width: 100%;" allowfullscreen="" loading="lazy"></iframe>

                </div>
            </div>
        </div>
    </div>
    <!-- /.row -->
</div>
<!-- end Page Content -->
@endsection