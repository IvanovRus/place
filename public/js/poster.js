$(document).ready(function() {
	$('input[type=file]').change(function(){
	    readImage(this);
	});

	lightGallery(document.getElementById('image-preview'));
	
	$('#posterform').on('submit',(function(e) 
	{
		e.preventDefault();
		var formData = new FormData(this);
		
		$.ajax({
			type: 'POST',
			url: '/posters',
			headers: {
				'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
			},
			data		: formData,
			cache		: false,
			processData : false,
			contentType : false,

			success: function(data){
				alert('После одобрением модератора, ваш пост появится на сайте!');
			},
			error: function(XMLHttpRequest, textStatus, errorThrown) {
				console.log(XMLHttpRequest.responseText);
			} 
		});

		modalClose();	
	}));
	
	function readImage ( input ) {
	    if (input.files && input.files[0]) {
	      var reader = new FileReader();
	 
	      reader.onload = function (e) {
	        $('#preview').attr('src', e.target.result);
	      }
	 
	      reader.readAsDataURL(input.files[0]);
	    }
	  }
})