<?php

namespace Website\Application\Controller;

use Library\Helper;

class OpenHouseAnnouncementsController extends \Admin\Application\Controller\OpenHouseAnnouncementsController {

    function __construct() {
        parent::__construct();
        $this->setTempalteBasePath(ROOT."/Website");
    }

    function index($account_id = null) {

        $data['title'] = "Open Houses - " . CONFIG['site_name'];
		$data['description'] = $data['title'];
		$data['image'] = CDN."images/real-estate.jpg";
		
		$this->doc->setTitle($data['title']);
		$this->doc->setDescription($data['description']);
		$this->doc->setMetaData("Keywords", $data['description']);

		$this->doc->setFacebookMetaData("og:url", DOMAIN . url("OpenHouseAnnouncementsController@index"));
		$this->doc->setFacebookMetaData("og:title", $data['title']);
		$this->doc->setFacebookMetaData("og:type", "website");
		$this->doc->setFacebookMetaData("og:image", $data['image']);
		$this->doc->setFacebookMetaData("og:description", $data['description']);
		$this->doc->setFacebookMetaData("og:updated_time", DATE_NOW);

        $filters[] = " ended_at > ".DATE_NOW." ";

		$open_house = $this->getModel("OpenHouseAnnouncement");
		
		$open_house->page['limit'] = 20;
		$open_house->page['current'] = isset($_GET['page']) ? $_GET['page'] : 1;
		$open_house->page['target'] = url("OpenHouseAnnouncementsController@index");
		$open_house->page['uri'] = (isset($uri) ? $uri : []);

		$open_house->where((isset($filters) ? implode(" AND ",$filters) : null))->orderBy(" DATE(JSON_EXTRACT(content, '$.date')) DESC ");
		$data = $open_house->getList();

		$this->doc->addScriptDeclaration(str_replace([PHP_EOL,"\t"], ["",""], "
			$(document).ready(function() {
				$.post('".url("SessionController@saveTraffic")."', {
					'type': 'page',
					'name': 'Open House',
					'id': 0,
					'url': '".url()."',
					'source': 'Website',
					'client_info': {
						'userAgent': userClient.userAgent,
						'geo': userClient.geo,
						'browser': userClient.browser
					},
					'csrf_token': '".csrf_token()."'
				});
			});
		"));

		$this->setTemplate("openHouse/index.php");
		return $this->getTemplate($data, $open_house);

    }

    function view($id = null) {

		$filters[] = " ended_at > ".DATE_NOW." ";

		$open_house = $this->getModel("OpenHouseAnnouncement");
        $open_house->column['announcement_id'] = $id;
		$open_house->where((isset($filters) ? implode(" AND ",$filters) : null));
		$data = $open_house->getById();

		if($data) {

			$account = $this->getModel("Account");
			$account->column['account_id'] = $data['account_id'];
			$data['account'] = $account->getById();

			$listing = $this->getModel("Listing");
			$listing->column['listing_id'] = $data['listing_id'];
			$data['listing'] = $listing->getById();

			$images = $this->getModel("ListingImage");
			$images->column['listing_id'] = $data['listing_id'];
			$images->where(" url != '".$data['attachment']."' ");
			$data['images'] = $images->getByListingId();

			$title = $data['subject']." ".CONFIG['site_name'];
			$description = $data['content']['details'];

			$this->doc->setTitle($title);
			$this->doc->setDescription($description);
			$this->doc->setMetaData("keywords", $description);

			$data['url'] = WEBDOMAIN . trim(url(), WEB_ALIAS);

			$this->doc->setFacebookMetaData("og:url", $data['url']);
			$this->doc->setFacebookMetaData("og:title", $title);
			$this->doc->setFacebookMetaData("og:type", "website");
			$this->doc->setFacebookMetaData("og:image", $data['attachment']);
			$this->doc->setFacebookMetaData("og:description", $description);
			$this->doc->setFacebookMetaData("og:updated_time", DATE_NOW);

			$data['share_buttons'] = Helper::socialMediadShareButtons([
				"url" => DOMAIN . $data['url'],
				"title" => $title,
				"description" => $description,
				"img" => $data['attachment'],
			]);

			$this->doc->addStyleDeclaration("
				.social-media-share-buttons .share-label {
					display:none;
				}
			");

			$this->doc->addScript(CDN."js/encryption.js");
			$this->doc->addScript(CDN."js/script.js");
			$this->doc->addScript(CDN."tabler/dist/libs/plyr/dist/plyr.min.js");
			$this->doc->addStylesheet(CDN."tabler/dist/libs/plyr/dist/plyr.css");

			$this->doc->addScriptDeclaration(str_replace([PHP_EOL,"\t"], ["",""], "
				let privateKey;
				let publicKey;

				document.addEventListener('DOMContentLoaded', function () {
					window.Plyr && (new Plyr('#player-youtube'));
				});

				$(document).on('focus', '#name, #email, #mobile_no, #message', function() {
					$('.hidden-fields').removeClass('d-none');
					$('#inquiry-form .btn-close').trigger('click');
				});

				$(document).on('click', '.btn-send-message', function() {

					let form = $('#inquiry-form');
					let url = form.attr('action');
					let formData = new FormData(document.querySelector('#inquiry-form'));
					let code = $('#security_code').val();

					formData.append('security_code', code);

					$('.loader-container').removeClass('d-none');
					$('#inquiry-form').hide();

					fetch('".url("ListingsController@validateMessageInput")."', {
						method: 'POST',
						body: new URLSearchParams(formData).toString()
					}).then( response => response.json() )
					.then( response => {

						if(response.status == 1) {

							setKeys()
								.then( () => {
									encrypt(JSON.stringify({
										'name': formData.get('name'),
										'message': formData.get('message'),
										'mobile_no': formData.get('mobile_no'),
										'email': formData.get('email')
									}), publicKey, privateKey)
										.then( data => {
											formData.append('content', data.encrypted);
											formData.append('iv', data.iv);

											fetch(url, { 
												method: 'POST', 
												body: new URLSearchParams(formData).toString()
											}).then(response => response.json())
												.then(response => {

													form.trigger('reset');
													$('.response').html(response.message);

													$('.loader-container').addClass('d-none');
													$('.hidden-fields').addClass('d-none');
													$('#inquiry-form').show();

													rng = random(1000, 9999);
													$('#security_code').val( rng );
													$('.valid-security-code').text( rng );
												});

											
										});
								});

						}else {
							$('.loader-container').addClass('d-none');
							$('#inquiry-form').show();
							$('.response').html(response.message);
						}

					});
				});

				async function setKeys() {
					privateKey = ".json_encode($data['account']['message_keys']['privateKey']).";
					publicKey = ".json_encode($data['account']['message_keys']['publicKey']).";
				}

				$(document).on('show.bs.offcanvas', '#offcanvasEnd', function() {
					let form = $('.inquiry-form-container');
					$(this).addClass('px-4 pt-4 pb-1');
					
					$(this).append(\"<div class='d-flex justify-content-end'><span class='btn-close text-reset' data-bs-dismiss='offcanvas' aria-label='Close'></span></div>\");
					$(this).append(form.clone());
					form.remove();

					agent = $('.property-agent-container');
					$('.send-message-agent-container').html(agent.clone());
					$('.send-message-agent-container .property-agent-container').addClass('mb-3 pb-3 border-bottom');
				});

				$(document).on('hide.bs.offcanvas', '#offcanvasEnd', function() {
					let form = $('#offcanvasEnd .inquiry-form-container');
					$(this).removeClass('px-4 pt-4');
					$('.sidebar .agent-form').html(form.clone());
					$(this).html('');

					$('.send-message-agent-container .property-agent-container').remove();
				});

			"));

			$this->doc->addScriptDeclaration(str_replace([PHP_EOL,"\t"], ["",""], "
				$(document).ready(function() {
					$.post('".url("SessionController@saveTraffic")."', {
						'type': 'open_house',
						'name': '".$title."',
						'id': ".$data['announcement_id'].",
						'url': '".url()."',
						'source': 'Website',
						'client_info': {
							'userAgent': userClient.userAgent,
							'geo': userClient.geo,
							'browser': userClient.browser
						},
						'csrf_token': '".csrf_token()."'
					});
				});
			"));

			$this->setTemplate("openHouse/view.php");
			return $this->getTemplate($data, $open_house);
		}

		$this->response(404);

    }

}