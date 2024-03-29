$(document).ready(function () { 
	storageData = JSON.parse(localStorage.getItem('items'));

	if(storageData != undefined) {
		html = "";
		for(i=0; i<storageData.length; i++) {
			html += createElements(storageData);
		}

		$('.upload-container').prepend(html);

	}

});

$(document).on('submit', '#imageUploadForm, #pdfUploadForm', (function (e) {
	
	e.preventDefault();
	var formData = new FormData(this);
	$('.btn-browse').hide();

	$.ajax({
		type:'POST',
		url: $(this).attr('action'),
		data:formData,
		cache:false,
		contentType: false,
		processData: false,
		beforeSubmit: function (e) { 
			console.log(e);
		},
		error: function (data) {

			console.log(data);

			$('.upload-loader').html('');
			$('.btn-browse').show();
			$('#ImageBrowse').val('');
			$('#PdfBrowse').val('');
			$('.btn-send').addClass('btn-send-message');
			$('.upload-response').append();

		}
	}).done(function(data) {
		let response = JSON.parse(data);

		let itemsArray = localStorage.getItem('items') ? JSON.parse(localStorage.getItem('items')) : [];
		localStorage.setItem('items', JSON.stringify(itemsArray));
		
		let html = "";
		let err = 0;

		for (i = 0; i < response.length; i++) {
			
			if (response[i].status == 2) {
				$('.upload-response').append(response[i].message);
			}

			if(response[i].status == 2) {
				err++;
			} else {
				
				items = { id: response[i].id, temp_url: response[i].temp_url, url: response[i].url, filename: response[i].filename };
				itemsArray.push(items);
				localStorage.setItem('items', JSON.stringify(itemsArray));
				html += createElements(response);
				
			}
			
		}

		$('.upload-loader').html('');
		$('.btn-browse').show();
		$('.upload-container').prepend(html);
		$('#ImageBrowse').val('');
		$('#PdfBrowse').val('');

		if (response.length > 1 || (err == 0 && response.length == 1)) {
			if ($('#type').val() == "pdf") {
				$('#message').val('sent a pdf file');
			} else {
				$('#message').val('sent an image');
			}

			$('.btn-send').addClass('btn-send-message');
			$('.btn-send-message').trigger('click');
		}
		
		$('#type').val('text');
		$('.file-container').remove();
		localStorage.clear();

	});
}));

$(document).on("change", "#PdfBrowse", function () {

	$('.undefined').remove();
	$('.upload-response').html('');
	$('.btn-send').removeClass('btn-send-message');
	$('#type').val('pdf');

	$('.upload-loader').html('<img src="' + CDN + 'images/loader.gif" /> Uploading please wait...');
	$("#pdfUploadForm").submit();
});

$(document).on("change", "#ImageBrowse", function () {

	$('.undefined').remove();
	$('.upload-response').html('');
	$('.btn-send').removeClass('btn-send-message');
	$('#type').val('image');
	
	$('.upload-loader').html('<img src="' + CDN + 'images/loader.gif" /> Uploading please wait...');
	$("#imageUploadForm").submit();
});

$(document).on('click', '.btn-browse-image', function () {
	$('#ImageBrowse').click();
});

$(document).on('click', '.btn-browse-pdf', function () {
	$('#PdfBrowse').click();
});

function removeImage(id,filename) {
	
	console.log(filename);
	if(localStorage.getItem('items') !== null) {
		storageData = JSON.parse(localStorage.getItem('items'));
		index = storageData.map(function (e) { return e.storageData; }).indexOf(id);
		storageData.splice(index, 1);
		localStorage.setItem('items', JSON.stringify(storageData));
	}

	$(id).remove();

	$.get("/messages/upload/" + filename + "/removeAttachment", function (data, status) {
		response = JSON.parse(data);
		console.log(data);
		$('.upload-response').html(response.message);
	});

}

function createElements(response) {
	html = "<div class='file-container " + response[i].id + "'>";
	html += "<input type='hidden' name='info[links][]' value='" + response[i].url + "' />";
		/* html += "<div class='avatar avatar-xl' style=\"position:relative; background-image:url('" + response[i].temp_url + "'); \">"; 
			html += "<span style='position:absolute; top:0; right:0;' class='cursor-pointer bg-red text-white rounded btn-remove-image' title='Remove image' onclick=\"removeImage('." + response[i].id + "','" + response[i].filename + "')\"><i class='ti ti-trash'></i></span>";
		html += "</div>"; */
	html += "</div>";
	return html;
}
