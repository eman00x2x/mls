
sessionStorage.clear();
let storageData;

if (sessionStorage.getItem('documents') !== null) {

	storageData = JSON.parse(sessionStorage.getItem('documents'));

	html = "";
	for (i = 0; i < storageData.length; i++) {
		html += createAttachmentElements(storageData);
	}
	$('.document_list ul').append(html);
} else { 
	sessionStorage.setItem('documents', JSON.stringify([]));
	storageData = JSON.parse(sessionStorage.getItem('documents'));
}

const docStorageData = storageData;

	$(document).on('submit','#DocsUploadForm',(function(e) {
		e.preventDefault();
		var formData = new FormData(this);
		
		$('.btn-document-browse').hide();

		$.ajax({
			type:'POST',
			url: $(this).attr('action'),
			data:formData,
			cache:false,
			contentType: false,
			processData: false,
			beforeSubmit:function(e){
				
			},
			error: function(data){
				console.log("error");
				console.log(data);
			}
		}).done(function (data) {
			
			let html = "";
			const response = JSON.parse(data);

			for(i = 0; i < response.length; i++) {
				if(response[i].status == 2) {
					html += response[i].message;
				}else {
					items = {id:response[i].id, url:response[i].url, filename:response[i].filename};
					docStorageData.push(items);
					sessionStorage.setItem('documents', JSON.stringify(docStorageData));
					$('.document_list').append(createAttachmentElements(response));
				}
			}
			
			$('.upload-response').html(html);
			$('.btn-document-browse').show();
			
		});
	}));

	$(document).on("change", "#DocsBrowse",function() {
		$('.upload-response').html('<img src=" ' + CDN + 'images/loader.gif" /> Please wait file is uploading...');
		$("#DocsUploadForm").submit();
	});
	
	$(document).on('click','.btn-document-browse',function() {
		$('#DocsBrowse').click();
	});
	
	function removeAttachment(container,attchment_id,filename) {
		
		if (sessionStorage.getItem('documents') !== null) {
			storageData = JSON.parse(sessionStorage.getItem('documents'));
			index = storageData.map(function(e) { return e.storageData; }).indexOf(attchment_id);
			storageData.splice(index, 1);
			sessionStorage.setItem('documents',JSON.stringify(storageData));
		}
		
		$(container+" * ").css("color","#eee");
		$(container+" * ").css("border-color","#eee");
		
		$.get("?request=mails&task=removeAttachment&filename="+filename,function(data,status) {
			$(container).remove();
		});
		
	}
	
	function createAttachmentElements(response) {
		html = "<li class='list-group-item d-flex gap-3 justify-content-between align-items-center py-1 file_" + response[i].id + "'>";
			html += "<div class='flex-grow-1'>";
				html += "<input type='hidden' name='documents[]' id='document_" + response[i].id + "' value='" + response[i].filename + "' />";
				html += "<span>" + response[i].filename + "</span>";
			html += "</div>";
			html += "<div class='btn-list'>";
				html += "<span class='btn btn-danger' data-number='" + response[i].id + "' data-filename='" + response[i].filename + "'><i class='ti ti-trash me-1'></i> Delete</span>";
			html += "</div>";
		html += "</li>";
		return html;
	}