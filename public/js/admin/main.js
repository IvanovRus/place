$(document).ready(function() {

	$('.js-poster-accept').on('click',(function(e)
	{
		var poster_id = getIdPoster($(this));

		setPosterStatus(poster_id, 2);

	}));

	$('.js-poster-deny').on('click',(function(e)
	{
		var poster_id = getIdPoster($(this))

		setPosterStatus(poster_id, 3);

	}));

	$('.js-poster-delete').on('click',(function(e)
	{
		var poster_id = getIdPoster($(this))

		setPosterStatus(poster_id, 4);

	}));

	function getIdPoster(line)
	{
		var poster_line = line.closest('.posters__line');
		var poster_id = poster_line.data("poster");

		return poster_id;
	}

	function setPosterStatus(id, status)
	{
		$.ajax({
			type: 'POST',
			url: 'admin/poster/status/'+id+'/'+status,
			headers: {
				'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
			},

			success: function(data){
				$("tr[data-poster='"+id+"']").attr("data-status", status);
			},
			error: function(XMLHttpRequest, textStatus, errorThrown) {
				console.log(XMLHttpRequest.responseText);
			}
		});
	}

})