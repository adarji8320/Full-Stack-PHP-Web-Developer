jQuery.ajax({
	
	url: 'js/landscapes.json',
	
	data: {
		format: 'json'
	},
	
	error: function(xhr, status, error){
		var errorMessage = xhr.status + ': ' + xhr.statusText
		alert('Error - Please open through live server or localhost to work');
	},
	
	dataType: 'json',

	success: function(data) {
		
		jQuery('.profile .img-profile').attr('src', data.profile_picture);
		jQuery('.profile .heading').text(data.name);
		jQuery('.profile .bio').text(data.bio);
		jQuery('.profile .phone').attr('href', 'tel:'+data.phone);
		jQuery('.profile .email').attr('href', 'mailto:'+data.email);
		jQuery('.profile .phone span').text(data.phone);
		jQuery('.profile .email span').text(data.email);

		var albums = data.album;

		albums.forEach(getLandscapesData);
		
		function getLandscapesData(item, index) {
			
			var featured = '';
			
			if(item.featured == true){
				var featured = '<span>#Featured</span>';
			}
			
			var temp = '<div class="col-md-4 gallery album-'+ item.id +'"> '+
						
							'<div class="card mb-4 shadow-sm"> '+
								'<img src="'+ item.img +'" width="100%" height="225" text="landscape" class="image" /> <div class="middle"></div>'+
								
								'<title>'+ item.title +'</title> '+
								
								'<div class="card-body"> '+
									'<p class="card-text">'+ item.description +'</p> '+
									'<div class="d-flex justify-content-between align-items-center"> '+
										'<div class="text-featured">'+
											featured +
										'</div> '+
										'<small class="text-muted">'+ item.date +'</small> '+
									'</div> '+
								'</div> '+
							'</div> '+
						'</div>';
			
			jQuery('.albums .row').append(temp);
		}
		
	},

	type: 'POST'

});
