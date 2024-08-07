<?php

namespace Website\Application\Controller;

class HomeController extends \Main\Controller {

	private $doc;
	
	function __construct() {
		$this->setTempalteBasePath(ROOT."/Website");
		$this->doc = $this->getLibrary("Factory")->getDocument();
	}

	function index() {

		$title = CONFIG['site_name'];
		$description = "PAREB Network proudly spearheads the Philippine real estate arena, commanding a robust presence through its 68 Local Member Boards. With a collective force of 5,000 skilled practitioners, PAREB Network stands as a cornerstone of excellence and integrity in the industry, driving forward innovation and shaping the future landscape of real estate across the nation";
		$image = CDN."images/real-estate.jpg";

		$this->doc->addScript(CDN."philippines-addresses/table_combine_address.js");

		$this->doc->setTitle($title);
		$this->doc->setDescription($description);
		$this->doc->setMetaData("keywords", $description);

		$this->doc->setFacebookMetaData("og:url", url());
		$this->doc->setFacebookMetaData("og:title", "");
		$this->doc->setFacebookMetaData("og:type", "website");
		$this->doc->setFacebookMetaData("og:image", $image);
		$this->doc->setFacebookMetaData("og:description", "");
		$this->doc->setFacebookMetaData("og:updated_time", DATE_NOW);

		$this->doc->addScriptDeclaration(str_replace([PHP_EOL,"\t"], ["",""], "

			let timer;

			$(document).ready(function() {
				$('.navbar').hide();
				$('.navbar-home').show();

				$.post('".url("SessionController@saveTraffic")."', {
					'type': 'page',
					'name': 'Homepage',
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

			$(document).on('change', '#address', function() {
				let val = $('#address').val();
				let selected_option = $('#address_result option').filter(function() {
					return this.value == val;
				});

				$('#barangay').val( selected_option.data('barangay') );
				$('#municipality').val( selected_option.data('municipality') );
				$('#province').val( selected_option.data('province') );
				$('#region').val( selected_option.data('region') );

			});

			$(document).on('keyup', '#address', function() {
				let result, text;
				let search = $('#address').val();
				if(search != '' && search.length >= 5) {
					clearInterval(timer);
					timer = setTimeout(function() {
						result = searchFor(search).reverse();
						for(key in result) {
							text += \"<option data-barangay='\" + result[key].barangay + 
								\"'data-municipality='\" + result[key].municipality + 
								\"'data-province='\" + result[key].province + 
								\"'data-region='\" + result[key].region +
								\"'value='\" + result[key].barangay + \" \" + result[key].municipality + \" \" + result[key].province + \"'> \";
						}
						$('#address_result').html(text);
					},200);
				}else { clearInterval(timer); }
			});

			$(document).on('submit', '#filter-form', function(e) {
				e.preventDefault();
			});

			$(document).on('click', '.btn-filter', function() {

				if($('#offer-1').prop('checked') === true) {
					page = 'buy';
				}

				if($('#offer-2').prop('checked') === true) {
					page = 'rent';
				}

				formData = $('#filter-form').serialize();
				window.location = page + '?' + formData;
			});

			$(document).on('keypress', '#address', function(e) {
				if(e.which == 13 || e.keyCode  == 13) {
					$('.btn-filter').trigger('click');
				}
			});

			$(document).on('click', '.btn-toggle-filter-box' ,function() {
				$('.filter-container').removeClass('d-none');
				$('.full-link').removeClass('stretched-link');
				$('.inner-filter').addClass('d-block');
				$('.outer-filter').addClass('d-none');
			});

			$(document).on('click', '.filter-container .btn-close' ,function() {
				$('.filter-container').addClass('d-none');
				$('.full-link').addClass('stretched-link');
				$('.inner-filter').removeClass('d-block');
				$('.outer-filter').removeClass('d-none');
			});

			const featuredPost = async () => {
				const response = await fetch('".url("HomeController@featuredPost")."');
				return response.json();
			};

			const latestPost = async () => {
				const response = await fetch('".url("HomeController@latestPost")."');
				return response.json();
			};

			const latestArticles = async () => {
				const response = await fetch('".url("HomeController@latestArticles")."');
				return response.json();
			};

			const openHouses = async () => {
				const response = await fetch('".url("HomeController@openHouses")."');
				return response.json();
			};

			featuredPost().then( response => {
				$('.featured-post-container').html(response.content);
				requestThumbImage();
			});

			latestPost().then( response => {
				$('.latest-post-container').html(response.content);
				requestThumbImage();
			});

			latestArticles().then( response => {
				$('.latest-articles-container').html(response.content);
			});

			openHouses().then( response => {
				$('.open-houses-container').html(response.content);
			});

			function trimString(s) {
				let l=0, r=s.length -1;
				while(l < s.length && s[l] == ' ') l++;
				while(r > l && s[r] == ' ') r-=1;
				return s.substring(l, r+1);
			}

			function compareObjects(o1, o2) {
				let k = '';
				for(k in o1) if(o1[k] != o2[k]) return false;
				for(k in o2) if(o1[k] != o2[k]) return false;
				return true;
			}

			function itemExists(haystack, needle) {
				for(let i=0; i<haystack.length; i++) if(compareObjects(haystack[i], needle)) return true;
				return false;
			}

			function searchFor(toSearch) {
				let results = [];
				toSearch = trimString(toSearch);
				for(let i=0; i<address.length; i++) {
					for(let key in address[i]) {
						if(address[i][key].toLowerCase().includes(toSearch)) {
							if(!itemExists(results, address[i])) results.push(address[i]);
						}
					}
				}
				return results.slice(-20);
			}


				function requestThumbImage() {
					$('.p-featured .p-image').each(function() {
						thumb_image = $(this).attr('data-thumb-image');
						$(this).css('background-image', 'url(".CDN."images/item_default.jpg)');
						getImage(thumb_image, $(this));
					});
				}

				async function getImage(thumb_image, element) {

					listing_id = element.attr('data-id');

					await fetch('".url("ListingsController@getThumbnail")."?url=' + thumb_image + '&id=' + listing_id)
						.then( response => response.json() )
						.then(  (data) => {
							element.css('background-image', 'url('+data.url+')');
						});
					
				}
			
		
		"));

		$listings = $this->getModel("Listing");

		$model = [
			"listings" => $listings
		];

		$this->setTemplate("home/index.php");
		return $this->getTemplate(null, $model);
	}

	function popularLocations() {

		$data = null;
		$html = null;
	
		$listings = $this->getModel("Listing");
		$listings->page['limit'] = 10;
		$listings
			->select(" COUNT(JSON_EXTRACT(address, '$.municipality')) as total, JSON_EXTRACT(address, '$.municipality') as city, JSON_EXTRACT(address, '$.region') as region, JSON_EXTRACT(address, '$.province') as province ")
				->where(" is_website = 1 AND status = 1 AND display = 1 ")
					->groupBy(" city ")
						->orderBy(" total DESC");
						
		$data = $listings->getList();

		$this->setTemplate("home/popularLocations.php");
		$html = $this->getTemplate($data, $listings);
		
		echo json_encode([
			"status" => "success",
			"content" => $html,
			"data" => $data
		]);

		exit();

	}

	function featuredPost() {

		$data = null;

		$listings = $this->getModel("Listing");
		$listings->page['limit'] = 8;
		$listings
			->join(" l JOIN #__accounts a ON a.account_id = l.account_id")
				->where(" is_website = 1 AND l.status = 1 AND display = 1 ")
					->and(" featured = 1 ")
						->orderBy(" post_score DESC, modified_at DESC ");
		$data['listings'] = $listings->getList();

		if($data['listings']) {
			$total_listing = count($data['listings']);

			for($i=0; $i<$total_listing; $i++) {

				$images = $this->getModel("ListingImage");
				$images->page['limit'] = 50;

				$images->column['listing_id'] = $data['listings'][$i]['listing_id'];
				$total_image = $images->getByListingId();
				
				$data['listings'][$i]['total_images'] = 0;

				if($total_image) {
					$data['listings'][$i]['total_images'] = count($total_image);
				}
			}

			$this->setTemplate("home/featuredPost.php");
			$data = $this->getTemplate($data, $listings);

			echo json_encode([
				"status" => "success",
				"content" => $data
			]);
		}else {
			echo json_encode([
				"status" => "success",
				"content" => " "
			]);
		}

		exit();

	}

	function latestPost() {

		$data = null;

		$listings = $this->getModel("Listing");
		$listings->page['limit'] = 8;
		$listings
			->join(" l JOIN #__accounts a ON a.account_id = l.account_id")
				->where(" is_website = 1 AND l.status = 1 AND display = 1 ")
						->orderBy(" modified_at DESC ");
		$data['listings'] = $listings->getList();

		if($data['listings']) {
			$total_listing = count($data['listings']);

			for($i=0; $i<$total_listing; $i++) {

				$images = $this->getModel("ListingImage");
				$images->page['limit'] = 50;

				$images->column['listing_id'] = $data['listings'][$i]['listing_id'];
				$total_image = $images->getByListingId();
				
				$data['listings'][$i]['total_images'] = 0;

				if($total_image) {
					$data['listings'][$i]['total_images'] = count($total_image);
				}
			}

			$this->setTemplate("home/latestPost.php");
			$data = $this->getTemplate($data, $listings);

			echo json_encode([
				"status" => "success",
				"content" => $data
			]);
		}else {
			echo json_encode([
				"status" => "success",
				"content" => " "
			]);
		}

		exit();

	}

	function openHouses() {
		
		$open_house = $this->getModel("OpenHouseAnnouncement");
		$open_house->orderby(" DATE(JSON_EXTRACT(content, '$.date')) DESC ");

		$filters[] = " ended_at > ".DATE_NOW." ";
		
		$open_house->where((isset($filters) ? implode(" AND ",$filters) : null));
		$data = $open_house->getList();

		if($data) {
			$this->setTemplate("home/openHouse.php");
			$response = $this->getTemplate($data, $open_house);

			echo json_encode([
				"status" => "success",
				"content" => $response
			]);
		}else {
			echo json_encode([
				"status" => "success",
				"content" => " "
			]);
		}

		exit();

	}

	function latestArticles() {

		$data = null;

		$articles = $this->getModel("Article");
		$articles->page['limit'] = 4;
		$data['articles'] = $articles->getList();

		$this->setTemplate("home/latestArticles.php");
		$html = $this->getTemplate($data, $articles);

		if($data['articles']) {
			
			echo json_encode([
				"status" => "success",
				"content" => $html
			]);

		}else {
			echo json_encode([
				"status" => "success",
				"content" => " "
			]);
		}

		exit();

	}

}