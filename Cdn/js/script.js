let account;

$(document).on('click', '.data-open-notification', function () {
	url = $(this).data('url');
	$.get(url, function (data, status) {
		response = JSON.parse(data);
		window.location = response.url;
	});
});

$(document).on('click', '.btn-view-account', function () {
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

	$('.btn-save').css({
		'cursor': 'wait',
		'pointer-events': 'none'
	});

	$("#form :input").attr('readonly', true);
	
	$('.btn-save').hide();

	$('.response').html("<div class='bg-white p-3 mt-3 rounded'><div class='d-flex gap-3 align-items-center'><div class='loader'></div><p class='mb-0'>Processing, Please wait...</p></div></div>");
	$('html, body').animate({ scrollTop: 0 }, 'slow');
	
	$.post($('#save_url').val(), $('#form').serialize(), function (data, status) {
		
		let response;

		if (typeof data == 'object') {
			response = data;
		} else { response = JSON.parse(data); }

		$('.btn-save').css({
			'cursor': 'pointer',
			'pointer-events': 'auto'
		});

		console.log(response);

		$('.btn-save').show();
		$('.response').html(response.message);
		$("#form :input").removeAttr('readonly');

		if (response.status == 1) {
			if ($('#reference_url').val() !== undefined) {

				let message = " <div class='bg-white p-3 mt-3 rounded'><div class='d-flex gap-3 align-items-center'><div class='loader'></div><p class='mb-0'>Please wait while you are redirecting...</p></div></div>";

				$('.response').html(message);

				setTimeout(function () {
					window.location = $('#reference_url').val();
				}, 10);
			}
		}

	});

	if (localStorage.getItem('items') !== null) {
		localStorage.clear();
	}
	
	return false;
});

$(document).on('click','.btn-delete, .btn-sold, .btn-requestHandshake, .btn-compare-table, .btn-set-featured, .btn-view-profile', function(e) {
	url = $(this).data('url');
	$.get(url, function (data, status) { 
		$('.offcanvas').html(data);
	});
});

$(document).on('click', '.btn-handshake-confirm', function (e) { 
	url = $(this).data('url');
	row = $(this).data('row');

	$('.request-response').html("<div class='bg-white p-3 mt-3 rounded'><div class='d-flex gap-3 align-items-center'><div class='loader'></div><p class='mb-0'>request in progress...</p></div></div>");
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
	
	$('.response').html("<div class='bg-white p-3 mt-3 rounded'><div class='d-flex gap-3 align-items-center'><div class='loader'></div><p class='mb-0'>request in progress...</p></div></div>");
	
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

	$('#viewModal .entries-content').html("<div class='bg-white p-3 mt-3 rounded'><div class='d-flex gap-3 align-items-center'><div class='loader'></div><p class='mb-0'>request in progress...</p></div></div>");

	$.get(url, function (data, status) {
		response = JSON.parse(data);
		$('.response').html(response.message);
		$('.' + row).remove();
		$('.btn-accept-handshake').remove();
		$('.btn-denied-handshake').remove();
		$('.handshake-container').remove();
	});
});


$(document).on('click','.btn-view', function(e) {
	url = $(this).data('url');
	id = $(this).data('id');
	
	$('#viewModal .entries-content').html("<div class='bg-white p-3 mt-3 rounded'><div class='d-flex gap-3 align-items-center'><div class='loader'></div><p class='mb-0'>Retrieving data please wait...</p></div></div>");
	
	$.get(url,function(data,status) {
		$('#viewModal .entries-content').html(data);
	});
	
});

$(document).on('click', '.btn-continue-featured', function (e) {
	url = $(this).data('url');
	row = $(this).data('row');
	proceed_url = $(this).data('url-proceed');

	$('.featured-response').html("<div class='bg-white p-3 mt-3 rounded'><div class='d-flex gap-3 align-items-center'><div class='loader'></div><p class='mb-0'>Processing, Please wait...</p></div></div>");
	$('.response-body').hide();
	$('.btn-featured-controls').hide();

	$.get(url, function (data, status) {
		response = JSON.parse(data);

		if (response.status == 1) {
			$('.btn-featured-controls').hide();
		} else {
			$('.response-body').show();
		}

		if (response.status == 1 && response.featured == 1) {
			html = "<svg  xmlns='http://www.w3.org/2000/svg'  width='24'  height='24'  viewBox='0 0 22 22'  fill='Orange'  class='icon icon-tabler icons-tabler-filled icon-tabler-star'><path stroke='none' d='M0 0h24v24H0z' fill='none'/><path d='M8.243 7.34l-6.38 .925l-.113 .023a1 1 0 0 0 -.44 1.684l4.622 4.499l-1.09 6.355l-.013 .11a1 1 0 0 0 1.464 .944l5.706 -3l5.693 3l.1 .046a1 1 0 0 0 1.352 -1.1l-1.091 -6.355l4.624 -4.5l.078 -.085a1 1 0 0 0 -.633 -1.62l-6.38 -.926l-2.852 -5.78a1 1 0 0 0 -1.794 0l-2.853 5.78z' /></svg>";
		} else {
			html = "<i class='ti ti-star text-muted'></i>";
		}

		$('.' + row + ' .featured-indicator-container').html( html );

		$('.featured-response').html(response.message);

	});

});

$(document).on('click','.btn-continue-delete, .btn-sold', function(e) {
	url = $(this).data('url');
	row = $(this).data('row');
	proceed_url = $(this).data('url-proceed');
	
	$('.deletion-response').html("<div class='bg-white p-3 mt-3 rounded'><div class='d-flex gap-3 align-items-center'><div class='loader'></div><p class='mb-0'>Processing, Please wait...</p></div></div>");
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

$(document).on('focusout', '#search', function (e) {
	
	val = $(this).val();

	if (val != '') {
		url = $(this).data('url') + '?search=' + val;
		title = 'Search: ' + val;

		$('.request-container').css('opacity', .3);

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
	csrf = $(this).data('csrf');

	$('.btn-add-to-compare_' + id).html("<div class='bg-white rounded'><div class='d-flex gap-3 align-items-center'><div class='loader'></div><p class='mb-0'>Processing, Please wait...</p></div></div>");

	$.post(url, { "listing_id": id, "csrf_token": csrf }, function (data,status) {
		response = JSON.parse(data);
		$('.response').html(response.message);
		$('.btn-add-to-compare_' + id).remove();	
	});
});

$(document).on('click', '.btn-remove-from-compare', function () {
	id = $(this).data('id');
	url = $(this).data('url');
	csrf = $(this).data('csrf');

	$('.btn-remove-from-compare_' + id).html("<div class='bg-white rounded'><div class='d-flex gap-3 align-items-center'><div class='loader'></div><p class='mb-0'>Processing, Please wait...</p></div></div>");
	
	$.post(url, { "listing_id": id, "csrf_token": csrf }, function (data, status) {
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

$(document).on('click', '.btn-update_subscription_status', function (e) {
	
	url = $(this).data('url');
	id = $(this).data('id');

	$.get(url, function (data) {
		response = JSON.parse(data);
		$('.response').html(response.message);
		$('.row_subscription_' + id + ' .btn-update_subscription_status .text-label').text(response.label);
	});

});

function timeSince(epoch) {
	let date = new Date(0);
	date.setUTCSeconds(epoch);
	return date.toLocaleDateString('en-US', { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric', hour: '2-digit', minute: '2-digit' });
}

function getAmortization() {

	let selling_price = parseInt($('#selling_price').val());
	let dp_percent = parseInt($('#mortgage-downpayment-selection').val());
	let dp = selling_price * (dp_percent / 100);

	let loan_amount = selling_price - dp;
	let interest_rate = parseFloat($('#mortgage-interest-selection').val());
	let years = parseInt($('#mortgage-years-selection').val()) + 1;
	let payments_per_year = 12;

	let monthly_payment = pmt((interest_rate / 100) / payments_per_year, payments_per_year * years, -loan_amount);
	let monthly_payment_formated = parseFloat(monthly_payment.toFixed(2)).toLocaleString();

	let schedule = computeSchedule(loan_amount, interest_rate, payments_per_year, years, monthly_payment);

	return {
		'monthly_payment': monthly_payment,
		'monthly_payment_formated': monthly_payment_formated,
		'schedule': schedule
	};

}

function uuidv4() {
	return "0000000000000000-8000000000000000".replace(/[018]/g, c =>
		(c ^ crypto.getRandomValues(new Uint8Array(1))[0] & 15 >> c / 4).toString(16)
	);
}

function rcg(text = "000000") {
	return text.replace(/[018]/g, c =>
		(c ^ crypto.getRandomValues(new Uint8Array(1))[0] & 15 >> c / 4).toString(16)
	);
}

function random(start, end) {
	return Math.floor(Math.random() * (end - start + 1)) + start;
}