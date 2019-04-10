<div class="image-preview">
	@foreach($images as $image)
		<img id="preview" src="/upload/{{ $image['img'] }}" alt="">
	@endforeach
</div>

<div class="form-group">
	<label for="exampleTextarea">Сообщение</label>
	{{ $message }}
</div>
<div class="form-group row">
	<label for="example-text-input" class="col-xs-2 col-form-label">lat</label>
	<div class="col-xs-10">
		{{ $lat }}
	</div>
</div>
<div class="form-group row">
	<label for="example-text-input" class="col-xs-2 col-form-label">lng</label>
	<div class="col-xs-10">
		{{ $lon }}
	</div>
</div>

<div id="mapMini"></div>
