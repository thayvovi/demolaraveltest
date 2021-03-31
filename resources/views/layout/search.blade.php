<form action="{{ route('page_search') }}" method="post" class="navbar-form navbar-left" role="search">
	<input type="hidden" name="_token" value="{{csrf_token()}}">
	<div class="form-group">
		<input type="text" name="tukhoa" class="form-control" placeholder="Search">
	</div>
	<button type="submit" class="btn btn-default">Tìm Kiếm</button>
</form>
{{-- //composer require laravel/collective --}}