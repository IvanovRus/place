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
				<form id="posterform" method="POST" enctype="multipart/form-data">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<input type="hidden" name="_method" value="POST">
					<div class="form-group">
						<label for="exampleTextarea">Сообщение</label>
						<textarea class="form-control" name="msg" id="postersMsg" rows="3"></textarea>
					</div>
					<div class="form-group row">
					  <label for="example-text-input" class="col-xs-2 col-form-label">lat</label>
					  <div class="col-xs-10">
						<input class="form-control" name="lat" type="text" value="" id="postersLat">
					  </div>
					</div>
					<div class="form-group row">
					  <label for="example-text-input" class="col-xs-2 col-form-label">lng</label>
					  <div class="col-xs-10">
						<input class="form-control" name="lon" type="text" value="" id="postersLon">
					  </div>
					</div>
					<div class="form-group">
						<label for="img">Выберите файл</label>
						<input id="img" type="file" name="file[]" multiple>
					</div>
					<div class="image-preview">
						<img id="preview" src="" alt="">
					</div>
					<div id="mapMini"></div>
					<button type="submit" class="btn btn-primary" id="posterSet">Добавить</button>
				</form>
			</div>
			<div class="modal-footer">
			</div>
		</div>
	</div>
</div>

