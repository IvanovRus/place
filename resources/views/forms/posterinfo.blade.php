<div class="image-preview">
	@foreach($images as $image)
		<img id="preview" src="/upload/{{ $image['img'] }}" alt="">
	@endforeach
</div>

<div class="form-group">
	<label for="exampleTextarea">Сообщение</label>
	<textarea class="form-control" name="msg" id="postersMsg" rows="3" disabled>{{ $message }}}</textarea>
</div>
<div class="form-group row">
	<label for="example-text-input" class="col-xs-2 col-form-label">lat</label>
	<div class="col-xs-10">
		<input class="form-control" name="lat" type="text" value="{{ $lat }}" id="postersLat" disabled>
	</div>
</div>
<div class="form-group row">
	<label for="example-text-input" class="col-xs-2 col-form-label">lng</label>
	<div class="col-xs-10">
		<input class="form-control" name="lon" type="text" value="{{ $lon }}" id="postersLon" disabled>
	</div>
</div>

<div id="mapMini"></div>
