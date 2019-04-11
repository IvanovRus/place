<script src="{{ asset('js/poster.js') }}"></script>
<div class="modal fade" id="basicModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="myModalLabel">{{ $title }}</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close" id="modalClose">
					<span aria-hidden="true">×</span>
				</button>
			</div>
			<div class="modal-body">
				<div id="image-preview" class="image-preview">
					@foreach($images as $image)
						<a href="/upload/original/{{ $image['img'] }}">
							<img id="preview" src="/upload/preview/{{ $image['img'] }}" alt="">
						</a>
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

			</div>
			<div class="modal-footer">
			</div>
		</div>
	</div>
</div>
