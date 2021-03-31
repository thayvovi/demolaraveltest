@extends('layout.index')

@section('content')
<div class="container">
    <div class="row">

        <!-- Blog Post Content Column -->
        <div class="col-lg-9">

            <!-- Blog Post -->

            <!-- Title -->
            <h1>{{$tintuc->TieuDe}}</h1>

            <!-- Author -->
            <p class="lead">
                by <a href="#">admin</a>
            </p>

            <!-- Preview Image -->
            <img class="img-responsive" src="upload/tintuc/{{$tintuc->Hinh}}" alt="{{$tintuc->TieuDe}}">

            <!-- Date/Time -->
            <p><span class="glyphicon glyphicon-time"></span> Posted on :{{$tintuc->created_at}}</p>
            <hr>

            <!-- Post Content -->
            <p class="lead">{!!$tintuc->NoiDung!!}</p>

            <hr>

            <!-- Blog Comments -->
            @if(Auth::user() != null)
                <!-- Comments Form -->
                <div class="well">
                    <h4>Viết bình luận ...<span class="glyphicon glyphicon-pencil"></span></h4>
                    <form action="comment/{{$tintuc->id}}" method="post" role="form">
                        <input type="hidden" name="_token" value="{{csrf_token()}}" />
                        <div class="form-group">
                            <textarea class="form-control" name="NoiDung" rows="3"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Gửi</button>
                    </form>
                </div>
            @endif
            <hr>

            <!-- Posted Comments -->

            <!-- Comment -->
            @foreach($tintuc->comment as $cm)
            <div class="media">
                {{-- <a class="pull-left" href="#">
                    <img class="media-object" src="http://placehold.it/64x64" alt="">
                </a> --}}
                <div class="media-body">
                    <h4 class="media-heading">{{$cm->user->name}}
                        <small>{{$cm->created_at}}</small>
                    </h4>
                    {{$cm->NoiDung}}
                </div>
            </div>
            @endforeach
        </div>

        <!-- Blog Sidebar Widgets Column -->
        <div class="col-md-3">

            <div class="panel panel-default">
                <div class="panel-heading"><b>Tin liên quan</b></div>
                <div class="panel-body">
                    @foreach($tinlienquan as $tt)
                        @if($tt->TieuDe != $tintuc->TieuDe)
                        <!-- item -->
                        <div class="row" style="margin-top: 10px;">
                            <div class="col-md-5">
                                <a href="tintuc/{{$tt->id}}/{{$tt->TieuDeKhongDau}}.html">
                                    <img class="img-responsive" src="upload/tintuc/{{$tt->Hinh}}" alt="">
                                </a>
                            </div>
                            <div class="col-md-7">
                                <a href="tintuc/{{$tt->id}}/{{$tt->TieuDeKhongDau}}.html"><b>{{$tt->TieuDe}}</b></a>
                            </div>
                            <p>{!!$tt->TomTat!!}</p>
                            <div class="break"></div>
                        </div>
                        @endif
                        <!-- end item -->
                    @endforeach
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading"><b>Tin nổi bật</b></div>
                <div class="panel-body">
                    @foreach($tinnb as $nb)
                    @if($nb->TieuDe != $tintuc->TieuDe)
                    <!-- item -->
                    <div class="row" style="margin-top: 10px;">
                        <div class="col-md-5">
                            <a href="tintuc/{{$nb->id}}/{{$nb->TieuDeKhongDau}}.html">
                                <img class="img-responsive" src="upload/tintuc/{{$nb->Hinh}}" alt="">
                            </a>
                        </div>
                        <div class="col-md-7">
                            <a href="tintuc/{{$nb->id}}/{{$nb->TieuDeKhongDau}}.html"><b>{!!$nb->TieuDe!!}</b></a>
                        </div>
                        <p>L{!!$nb->TomTat!!}</p>
                        <div class="break"></div>
                    </div>
                    @endif
                    <!-- end item -->
                    @endforeach
                </div>
            </div>

        </div>

    </div>
    <!-- /.row -->
</div>
@endsection