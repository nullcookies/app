(function() {
	$('#imageform').ajaxForm({
		beforeSubmit: function() {
			count = 0;
			val = $.trim( $('#images').val() );

			if( val == '' ){
				count= 1;
				$( "#images" ).next('span').html( "Please select your images" );
			}

			if(count == 0){
				for (var i = 0; i < $('#images').get(0).files.length; ++i) {
			    	img = $('#images').get(0).files[i].name;
			    	var extension = img.split('.').pop().toUpperCase();
			    	if(extension!="PNG" && extension!="JPG" && extension!="JPEG"){
			    		count= count+ 1
			    	}
			    }
				if( count> 0) $( "#images" ).next('span').html( "Please select valid images" );
			}


		    if( count> 0){
		    	return false;
		    } else {
		    	$( "#images" ).next('span').html( "" );
		    }

	    },

		beforeSend:function(){
		   $('#loader').show();
		   $('#image_upload').hide();
		},
	    success: function(msg) {
	    },
		complete: function(xhr) {
			$('#loader').hide();
			$('#image_upload').show();

			$('#images').val('');
			$('#error_div').html('');
			result = xhr.responseText;
			result = $.parseJSON(result);

			if( result.success ){
				original_image = '/../images/'+(result.success).split('_')[1];
				name = '/../images/'+result.success;
				html = '';
				html+= '<div class="image__item"><a class="lightbox" href="#'+result.success+'">' +
					 '<img src="'+ name +'"/>' +
					'</a>' +
					'<button type="button" class="btn btn-danger btn-sm delete-btn" data-id="'+ result.id + '">Delete</button>' +

				'<div class="lightbox-target" id="'+result.success+'">' +
					 '<img src="'+ original_image +'"/>' +
					 '<a class="lightbox-close" href="#"></a>' +
				 '</div></div>';

				$('#uploaded_images #success_div').append( html );
			} else if( result.error ){
				error = result.error
				html = '';
				html+='<p>'+error+'</p>';
				$('#uploaded_images #error_div').append( html );
			}

			$('#error_div').delay(5000).fadeOut('slow');


		}
	});

	$(document).on('click','.delete-btn', function(){
		var deleteId = $(this).data('id');
		if (confirm("Are you sure want to delete this image")) {
			$.ajax({
				url  : "/delete",
				type : "POST",
				cache:false,
				data:{deleteId:deleteId},
				success:function(data){
					fetchData();
				}
			});
		}
	});

	// Fetch Data from Database
	function fetchData(){
		$.ajax({
			url  : "/fetch_data",
			type : "POST",
			cache: false,
			success:function(data){
				result = $.parseJSON(data);
				html = '';
				result.forEach(function(obj) {
					html += '<div class="image__item"><a class="lightbox" href="#'+obj.thumbnail_image+'">' +
						'<img src="/../images/'+ obj.thumbnail_image +'"/>' +
						'</a>' +
						'<button type="button" class="btn btn-danger btn-sm delete-btn" data-id="'+ obj.id + '">Delete</button>' +

						'<div class="lightbox-target" id="'+obj.thumbnail_image+'">' +
						'<img src="/../images/' + obj.original_image +'"/>' +
						'<a class="lightbox-close" href="#"></a>' +
						'</div></div>'
				});
				$('#success_div').html( html );
			}
		});
	}

})();