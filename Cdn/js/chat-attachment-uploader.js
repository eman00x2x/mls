$(document).ready(function () { 
	storageData = JSON.parse(localStorage.getItem('items'));

	if(storageData != undefined) {
		html = "";
		for(i=0; i<storageData.length; i++) {
			html += "<div class='file-container " + storageData[i].id + "'>";
			html += createElements(storageData);
			html += "</div>";
		}

		$('.upload-container').prepend(html);

	}
});

$(document).on('submit', '#imageUploadForm', (function (e) {
	
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
		beforeSubmit:function(e){},
		error: function (data) {
			console.log(data);
		}
	}).done(function(data) {
		console.log(data);
		var response = JSON.parse(data);
		console.log(response);

		let itemsArray = localStorage.getItem('items') ? JSON.parse(localStorage.getItem('items')) : [];
		localStorage.setItem('items', JSON.stringify(itemsArray));
		
		html = "";
		for (i = 0; i < response.length; i++) {
			
			if (response[i].status == 2) {
				$('.upload-response').append(response[i].message);
			}

			html += "<div class='file-container "+response[i].id+"'>";
				if(response[i].status == 2) {
					html += "<div class='avatar avatar-xl' style=\"background-image:url('" + CDN + "images/warning_48.png'); \"> Error Uploading</div>";
				} else {
					
					items = { id: "file_" + response[i].id, url: response[i].temp_url, filename: response[i].filename };
					itemsArray.push(items);
					localStorage.setItem('items', JSON.stringify(itemsArray));
					html += createElements(response);
				}
			html += "</div>";
		}

		$('.upload-loader').html('');
		$('.btn-browse').show();
		$('.upload-container').prepend(html);
		
		$('#ImageBrowse').val('');
	});
}));

$(document).on("change", "#ImageBrowse", function () {

	$('.undefined').remove();
	$('.upload-response').html('');
	
	var $fileUpload = $("input[type='file']");
	if (parseInt($fileUpload.get(0).files.length) >= 5) {
		$('.upload-response').append("Select 5 or less images per upload!");
		$('#ImageBrowse').val('');
		return false;
	}

	$('.upload-loader').html('<img src="' + CDN + 'images/loader.gif" /> Uploading please wait...');
	$("#imageUploadForm").submit();
});

$(document).on('click', '.btn-file-browse, .btn-browse', function () {
	$('#ImageBrowse').click();
});

function removeImage(container,id,filename,application) {
	
	console.log(localStorage.getItem('items'));
	if(localStorage.getItem('items') !== null) {
		storageData = JSON.parse(localStorage.getItem('items'));
		index = storageData.map(function (e) { return e.storageData; }).indexOf(id);
		storageData.splice(index, 1);
		localStorage.setItem('items', JSON.stringify(storageData));
	}

	$(container).remove();

	$.get("attachment" + id + "/delete?filename=" + filename, function (data, status) {
		response = JSON.parse(data);
		console.log(data);
		$('.upload-response').html(response.message);
		
	});

}

function createElements(response) {
	html = "<input type='hidden' name='info[links][]' value='" + response[i].filename + "' />";
	html += "<div class='avatar avatar-xl' style=\"position:relative; background-image:url('" + CDN + "public/temporary/" + response[i].filename + "'); \">"; 
		html += "<span style='position:absolute; top:-10px; right:-10px;' class='cursor-pointer bg-red text-white rounded btn-remove-image' title='Remove image' onclick=\"removeImage('." + response[i].id + "','file_" + response[i].id + "','" + response[i].filename + "'')\"><i class='ti ti-trash'></i></span>";
	html += "</div>";
	return html;
}