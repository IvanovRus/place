$(document).ready(function() {
	//var map = L.map('map').setView([53.528883, 49.295955], 14);
	map = new L.Map('map', {center: new L.LatLng(53.528883, 49.295955), zoom: 12, zoomAnimation: false });
	var osm = new L.TileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {maptype: 'osm'});
	var yndx = new L.Yandex();
	yndx.options['maptype'] = 'yandex';
	map.addLayer(osm);
	// управление слоями карт
	map.addControl(new L.Control.Layers({'OSM':osm, 'Yandex':yndx}));
	map.zoomControl.setPosition('topright');
	
	map.on('click', modalMsgShow);
	var popup = L.popup();
	getPosters();

	var map2;
	var options = {
		'backdrop' : 'true'
	}
});

function modalMsgShow(e)
{
	getFormPosters(e);
}

function modalClose(elem)
{
	$('#basicModal').modal('hide');
	console.log(12);
	$('.fade').remove();
}

function getPosters()
{
	$.ajax({
		type: 'GET',
		url: '/posters/2',

		success: function(data){
			var markers = new L.MarkerClusterGroup();
			$.each(data,function(i, e) {
				var marker = new L.Marker(new L.LatLng(e.lat, e.lon), {customId: e.id}).bindTooltip(e.message,
					{
						permanent: true,
						direction: 'right'
					});
				marker.on('click', function (e) {
					var id = this.options.customId;
					getPosterById(id);
				})
				markers.addLayer(marker);
				createBlockPosterContext(e);
			});
			map.addLayer(markers);
		},
		error: function(XMLHttpRequest, textStatus, errorThrown) {
			console.log(XMLHttpRequest.responseText);
		}
	});
}

function getPosterById(id)
{
	$.ajax({
		type: 'GET',
		url: '/poster/'+id ,
		success: function(data){
			$('body').append(data);
			var lat = $('#postersLat').val();
			var lng = $('#postersLon').val();
			$('#basicModal').modal('show');
			loadFormPosters(lat,lng);
		},
		error: function(XMLHttpRequest, textStatus, errorThrown) {
			console.log(XMLHttpRequest.responseText);
		}
	});
}

function createBlockPosterContext(data)
{
	$('<div>', {
		class: 'ctx-post js-ctx-post',
		append: $('<img/>',
			{
				class: 'ctx-img',
				src: '/upload/preview/'+(data['images'].length>0 ? data['images'][0]['img']:'b11d597fc2df00c9551e484cc64f4748.png'),
				click: function () {
					getPosterById(data['id'])
				}
			})
			.add($('<span>', {
				text: data['message'],
				class: 'ctx-message',
			}))
			.add($('<span>', {
				class: 'ctx-find',
				click: function () {
					var lat = data['lat'];
					var lng = data['lon'];
					map.setView(new L.LatLng(lat, lng), 15);
					return false;
				},
			}))
	})
		.appendTo('#sidebar-container');
}

function getFormPosters(e)
{
	$.ajax({
		type: 'GET',
		url: '/posters/add',
		headers: {
			'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
		},
		success: function(data){
			$('body').append(data);
			var lat = e.latlng.lat;
			var lng = e.latlng.lng;
			loadFormPosters(lat,lng);
			$('#basicModal').modal('show');
		},
		error: function(XMLHttpRequest, textStatus, errorThrown) {
			console.log(XMLHttpRequest.responseText);
		}
	});
}

function loadFormPosters(lat,lng)
{
	$('#modalClose').on('click', modalClose);

	$('#postersLat').val(lat);
	$('#postersLon').val(lng);

	$('#mapMini').html('<div class="modal-map" id="mapMini2"></div>');
	setTimeout(function () {
		map2 = new L.Map('mapMini2', {zoom: 17, zoomAnimation: false });
		var osm = new L.TileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {maptype: 'osm'});
		map2.addLayer(osm);

		map2.panTo(new L.LatLng(lat, lng));
		var marker = new L.Marker(new L.LatLng(lat, lng), {draggable: true});
		map2.addLayer(marker);
		marker.on("dragend", function(e){
			lat = e.target._latlng.lat;
			lng = e.target._latlng.lng;
			$('#postersLat').val(lat);
			$('#postersLon').val(lng);
		});

		$('#postersLat').on("focusout", function(e){
			var lat = $('#postersLat').val();
			var lng = $('#postersLon').val()
			marker.setLatLng([lat,lng]);
			map2.panTo(new L.LatLng(lat, lng));
		});

		$('#postersLon').on("focusout", function(e){
			var lat = $('#postersLat').val();
			var lng = $('#postersLon').val()
			marker.setLatLng([lat,lng]);
			map2.panTo(new L.LatLng(lat, lng));
		});

	}, 300);
}
