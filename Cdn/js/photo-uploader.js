$(document).ready(function () { 
	storageData = JSON.parse(localStorage.getItem('items'));

	if(storageData != undefined) {
		html = "";
		for(i=0; i<storageData.length; i++) {
			html += "<div class='me-2 mb-3 " + storageData[i].id + "'>";
			html += createElements(storageData, $('#photo_uploader').val());
			html += "</div>";
		}

		$('.images-container').prepend(html);

	}
});

$(document).on('submit', '#imageUploadForm', (function (e) {
	
	e.preventDefault();
	var formData = new FormData(this);
	$('.btn-photo-browse').hide();
	
	$.ajax({
		type:'POST',
		url: $(this).attr('action'),
		data:formData,
		cache:false,
		contentType: false,
		processData: false,
		beforeSubmit:function(e){},
		error: function (data) {
			console.log(data);
		}
	}).done(function(data) {
		console.log(data);

		var response = JSON.parse(data);
		var folder = "temporary";
		
		if ($('#photo_uploader').val() == "articles" || $('#photo_uploader').val() == "accounts" || $('#photo_uploader').val() == "users") {
			
			$('.photo-preview').css('background-image', "url('" + CDN + "images/blank-profile.png')");
			if(response.status == 1) {
				$('.photo-preview').css("background-image", "url('" + response.temp_url + "')");
				$('#photo, #logo').val(response.filename);
				$('.photo-upload-loader').html('');
			} else {
				$('.upload-response').append("<div class=' alert  alert-danger  alert-dismissible' id=''><div class='d-flex'><div class=''><i class='ti ti-alert-triangle me-2' aria-hidden='true'><\/i><\/div><div class=''><p class='p-0 m-0'>There was a problem uploading your photo please contact the System Administrator.<\/p><\/div><\/div><button type='button' class='btn-close' data-bs-dismiss='alert'><\/button> <\/div>");alert('');
			}
			
		} else {

			let itemsArray = localStorage.getItem('items') ? JSON.parse(localStorage.getItem('items')) : [];
			localStorage.setItem('items', JSON.stringify(itemsArray));
			
			/************** LISTINGS **************/
			html = "";
			for (i = 0; i < response.length; i++) {
				
				if (response[i].status == 2) {
					$('.upload-response').append(response[i].message);
				}

				html += "<div class='col-lg-4 col-md-4 mb-2 "+response[i].id+"'>";
					if(response[i].status == 2) {
						html += "<div class='' style=\"background-image:url('" + CDN + "images/warning_48.png'); background-repeat: no-repeat; background-size: cover; width:150px;height:150px; \"> Error Uploading</div>";
					}else {
						items = { id: "image_" + response[i].id, url: response[i].url, filename: response[i].filename, application: "listings" };
						itemsArray.push(items);
						localStorage.setItem('items', JSON.stringify(itemsArray));
						html += createElements(response,$('#photo_uploader').val());
					}
				html += "</div>";
			}
			$('.photo-upload-loader').html('');
			$('.btn-photo-browse').show();
			$('.images-container').prepend(html);
			if($('#thumb_img').val() == "") {
				setImageThumb(".image_0",response[0].filename);
			}
		}
		$('#ImageBrowse').val('');
	});
}));

$(document).on("change", "#ImageBrowse", function () {

	$('.undefined').remove();
	$('.upload-response').html('');
	
	var $fileUpload = $("input[type='file']");
	if (parseInt($fileUpload.get(0).files.length) >= 5) {
		$('.upload-response').append("<div class=' alert  alert-danger  alert-dismissible' id=''><div class='d-flex'><div class=''><i class='ti ti-alert-triangle me-2' aria-hidden='true'><\/i><\/div><div class=''><p class='p-0 m-0'>Error! Select 5 or less images per upload!<\/p><\/div><\/div><button type='button' class='btn-close' data-bs-dismiss='alert'><\/button> <\/div>");
		$('#ImageBrowse').val('');
		return false;
	}

	$('.photo-upload-loader').html('<img src="' + CDN + 'images/loader.gif" /> Please wait photo is uploading...');
	$("#imageUploadForm").submit();
});

$(document).on('click','.photo-preview, .btn-photo-browse',function() {
	$('#ImageBrowse').click();
});

function setImageThumb(container,filename) {
	$('#thumb_img').val(filename);
	$('.btn-set-thumb-image i').remove();
	$('.btn-set-thumb-image').removeClass('btn-success');
	$('.btn-set-thumb-image').addClass('btn-outline-primary');

	$(container + ' .btn-set-thumb-image').prepend("<i class='ti ti-check me-2'></i>");
	$(container + ' .btn-set-thumb-image').removeClass('btn-outline-primary');
	$(container + ' .btn-set-thumb-image').addClass('btn-success');
}

function removeImage(container,image_id,filename,application) {
	
	console.log(localStorage.getItem('items'));
	if(localStorage.getItem('items') !== null) {
		storageData = JSON.parse(localStorage.getItem('items'));
		index = storageData.map(function (e) { return e.storageData; }).indexOf(image_id);
		storageData.splice(index, 1);
		localStorage.setItem('items', JSON.stringify(storageData));
	}

	$(container).remove();

	switch(application) {
		case 'listings': req = "/listingImages/"; break;
	}

	$.get(req + image_id + "/delete?filename=" + filename, function (data, status) {
		response = JSON.parse(data);
		console.log(data);
		$('.upload-response').html(response.message);
		
	});

}

function createElements(response,application = "listings") {
	html = "<input type='hidden' name='listing_image_filename[]' value='" + response[i].filename + "' />";
	html += "<div class='' style=\"background-image:url('" + CDN + "images/temporary/" + response[i].filename + "'); background-repeat: no-repeat; background-size: cover; width:180px;height:180px; \"></div>";
	html += "<div class='mt-2'>";
		html += "<div class='btn-group'>";
	html += "<span class='btn btn-md btn-outline-secondary btn-remove-image' title='Remove image' onclick=\"removeImage('." + response[i].id + "','image_" + response[i].id + "','" + response[i].filename + "','" + application + "')\"><i class='ti ti-trash'></i></span>";
	html += "<span class='btn btn-md btn-outline-primary btn-set-thumb-image' title='Set image as thumbnail' onclick=\"setImageThumb('." + response[i].id + "','" + response[i].filename + "')\"> <i class='ti ti-click me-2'></i> Thumbnail</span>";
		html += "</div>";
	html += "</div>";
	return html;
}