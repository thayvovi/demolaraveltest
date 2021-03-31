@extends('layout.index')

@section('content')
<div class="container">

	<!-- slider -->
	@include('layout.slide')
	<!-- end slide -->

	<div class="space20"></div>

	{{-- menu --}}
	@include('layout.menu')
		<div class="col-md-9">
		<div class="panel panel-default">            
			<div class="panel-heading" style="background-color:#337AB7; color:white;" >
				<h2 style="margin-top:0px; margin-bottom:0px;">Tin Tức</h2>
			</div>

			<div class="panel-body">
				@foreach($theloai as $tl)
					@if(count($tl->loaitin) > 0) {{-- kiểm tra xem thể loại nào có loại tin --}}
					<!-- item -->
					<div class="row-item row">
						<h3>
							{{$tl->Ten}} | 	
							@foreach($tl->loaitin as $lt)
								<small><a href="loaitin/{{$lt->id}}/{{$lt->TenKhongDau}}.html"><i>{{$lt->Ten}}</i></a>/</small>
							@endforeach
						</h3>
						{{-- Lấy ra tin nổi bật của các loại tin --}}
						<?php 
							$data = $tl->tintuc->where('NoiBat',1)->sortByDesc('created_at')->take(5);
							//select * from theloai 
							//JOIN loaitin ON theloai.id = loaitin.id 
							//JOIN tintuc ON  loaitin.id = tintuc.id
							//where NoiBat ='1' ORDER BY created_at DESC LIMIT 0,5;
							
							//Lấy ra 1 tin trong 5 tin
							$tin1 = $data->shift();//shift lấy ra 1 tin và trong data lúc này in ra 4 tin vì 1 tin đã được shift lấy
						?>
						<div class="col-md-8 border-right">
							@if(isset($tin1))
								<div class="col-md-5">
									<a href="tintuc/{{$tin1['id']}}/{{$tin1['TieuDeKhongDau']}}.html">
										<img class="img-responsive" src="upload/tintuc/{{$tin1['Hinh']}}" alt="">
									</a>
								</div>
							@endif
							<div class="col-md-7">
								<h3><a href="tintuc/{{$tin1['id']}}/{{$tin1['TieuDeKhongDau']}}.html">{!!$tin1['TieuDe']!!}</a></h3>
								<p>{!!$tin1['TomTat']!!}</p>
								<a class="btn btn-primary" href="tintuc/{{$tin1['id']}}/{{$tin1['TieuDeKhongDau']}}.html">Chi tiết <span class="glyphicon glyphicon-chevron-right"></span></a>
							</div>

						</div>


						<div class="col-md-4">
							@foreach($data->all() as $tintuc)
							<a href="tintuc/{{$tintuc->id}}/{{$tintuc->TieuDeKhongDau}}.html">
								<h4>
									<span class="glyphicon glyphicon-list-alt"></span>
									{!!$tintuc['TieuDe']!!}
								</h4>
							</a>
							@endforeach
						</div>

						<div class="break"></div>
					</div>
					<!-- end item -->
					@endif
				@endforeach()
			</div>
		</div>
	</div>
	{{-- /.menu --}}
	<!-- /.row -->
</div>
@endsection