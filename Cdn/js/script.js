$(document).on('click','.btn-view-account',function() {
	url = $(this).data('url');
	window.location = url;
});

$(document).on('click','.btn-save', function(e) {
	
	e.preventDefault();
	
	if ($('#save_url').val() === undefined) {
		alert("Save Url not define");
		return false;
	}

	if ($('#snow-container').length) {
		$('#snow-container').val(tinymce.get('snow-container').getContent());
	}

	/* $(this).css({
		'cursor': 'wait',
		'pointer-events': 'none'
	});
	
	$('.btn-save').hide(); */

	$('.response').html("<img src='" + CDN + "images/loader.gif' /> Processing... ");
	$('html, body').animate({ scrollTop: 0 }, 'slow');
	
	$.post($('#save_url').val(), $('#form').serialize(), function (data, status) {
		console.log(data);

		if (typeof data == 'object') {
			response = data;
		} else { response = JSON.parse(data); }

		$('.response').html(response.message);
		$(this).css({
			'cursor': 'pointer',
			'pointer-events': 'auto'
		});

		$(this).show();
	});

	if (localStorage.getItem('items') !== null) {
		localStorage.clear();
	}
	
	return false;
});

$(document).on('click','.btn-delete, .btn-requestHandshake, .btn-compare-table', function(e) {
	url = $(this).data('url');
	$.get(url, function (data, status) { 
		$('.offcanvas').html(data);
	});
});

$(document).on('click', '.btn-handshake-confirm', function (e) { 
	url = $(this).data('url');
	row = $(this).data('row');

	$('.request-response').html("<img src='" + CDN + "images/loader.gif' /> request in progress... ");
	$('.response-body').hide();

	$.get(url, function (data, status) {
		response = JSON.parse(data);

		if (response.status == 1) {
			$('.' + row).remove();
			bootstrap.Offcanvas.getInstance($('.offcanvas')).hide();
		}

		$('.request-response, .response').html(response.message);
	});
});

$(document).on('click', '.btn-accept-handshake', function (e) {
	url = $(this).data('url');
	
	$('.response').html("<img src='" + CDN + "images/loader.gif' /> request in progress... ");
	
	$.get(url, function (data, status) {
		response = JSON.parse(data);
		$('.response').html(response.message);
		$('.btn-accept-handshake').remove();
		$('.btn-denied-handshake').remove();
	});
});

$(document).on('click', '.btn-denied-handshake, .btn-done-handshake, .btn-cancel-handshake', function (e) {
	url = $(this).data('url');
	row = $(this).data('row');

	$('.response').html("<img src='" + CDN + "images/loader.gif' /> request in progress... ");

	$.get(url, function (data, status) {
		response = JSON.parse(data);
		$('.response').html(response.message);
		$('.' + row).remove();
	});
});


$(document).on('click','.btn-view', function(e) {
	url = $(this).data('url');
	id = $(this).data('id');
	
	$('#viewModal .entries-content').html("<img src='" + CDN + "images/loader.gif' /> Retrieving data please wait... ");
	
	$.get(url,function(data,status) {
		$('#viewModal .entries-content').html(data);
	});
	
});

$(document).on('click','.btn-continue-delete', function(e) {
	url = $(this).data('url');
	row = $(this).data('row');
	proceed_url = $(this).data('url-proceed');
	
	$('.deletion-response').html("<img src='" + CDN + "images/loader.gif' /> deletion in progress... ");
	$('.response-body').hide();
	
	$.get(url,function(data,status) {
		response = JSON.parse(data);
		
		if (response.status == 1) {
			if (proceed_url != undefined) {
				window.location = proceed_url;
			} else { 
				$('.' + row).remove();
				bootstrap.Offcanvas.getInstance($('.offcanvas')).hide();
			}
			
			$('.btn-delete-controls').hide();
		} else {
			$('.response-body').show();
		}

		$('.deletion-response').html(response.message);

	});
	
});

$(document).on('submit','#form', function(e) {
	e.preventDefault();
});

$(document).on('keypress','#search', function(e) {
	if(e.which == 13) {
	
		val = $(this).val();
		url = $(this).data('url')+'?search='+val;
		title = 'Search: '+val;
		
		$('.request-container').css('opacity',.3);
		
		window.location = url;
		
	}
});

$(document).on('change', '#select_option', function () { 
	if ($(this).prop('checked') == true) {
		$('.selection').prop('checked', true);
	} else { 
		$('.selection').prop('checked', false);
	}
});

$(document).on('click', '.avatar', function () { 
	id = $(this).data('id');
	if ($('.' + id).prop('checked') == true) {
		$('.' + id).prop('checked', false);
	} else { 
		$('.' + id).prop('checked', true);
	}
});

$(document).on('click', '.btn-add-to-compare', function () {
	id = $(this).data('id');
	url = $(this).data('url');

	$('.btn-add-to-compare_' + id).html("<img src='" + CDN + "images/loader.gif' /> Modifying compare table... ");

	$.post(url, {"listing_id" : id}, function (data,status) {
		response = JSON.parse(data);
		$('.response').html(response.message);
		$('.btn-add-to-compare_' + id).remove();	
	});
});

$(document).on('click', '.btn-remove-from-compare', function () {
	id = $(this).data('id');
	url = $(this).data('url');

	$('.btn-remove-from-compare_' + id).html("<img src='" + CDN + "images/loader.gif' /> Modifying compare table... ");

	$.post(url, { "listing_id": id }, function (data, status) {
		response = JSON.parse(data);
		$('.response').html(response.message);
		$('.btn-remove-from-compare_' + id).remove();
		$('.compare_row_'+id).remove();
	});
});

$(document).on('click', '.col-filter', function (e) {
	var element = $(this);
	var id = element.attr('id');
	
	if (element.prop('checked') == true) {
		$('table tr .' + id).show();
	} else { 
		$('table tr .' + id).hide();
	}
});