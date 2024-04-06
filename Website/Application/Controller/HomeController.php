<?php

namespace Website\Application\Controller;

class HomeController extends \Main\Controller {

	private $doc;
	
	function __construct() {
		$this->setTempalteBasePath(ROOT."Website");
		$this->doc = $this->getLibrary("Factory")->getDocument();
	}

	function index() {

		$title = CONFIG['site_name'];
		$description = $title;
		$image = "";

		$this->doc->addScript(CDN."philippines-addresses/table_combine_address.js");

		$this->doc->setTitle($title);
		$this->doc->setDescription($description);
		$this->doc->setMetaData("keywords", $description);

		$this->doc->setFacebookMetaData("og:url", url());
		$this->doc->setFacebookMetaData("og:title", "");
		$this->doc->setFacebookMetaData("og:type", "website");
		$this->doc->setFacebookMetaData("og:image", "");
		$this->doc->setFacebookMetaData("og:description", "");
		$this->doc->setFacebookMetaData("og:updated_time", DATE_NOW);

		$this->doc->addScriptDeclaration(str_replace([PHP_EOL,"\t"], ["",""], "

			let timer;

			$(document).ready(function() {
				$('.navbar').hide();
				$('.navbar-home').show();
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
							text += \"<option 
								data-barangay='\" + result[key].barangay + \"'
								data-municipality='\" + result[key].municipality + \"'
								data-province='\" + result[key].province + \"'
								data-region='\" + result[key].region + \"'
								value='\" + result[key].barangay + \" \" + result[key].municipality + \" \" + result[key].province + \"'> \";
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

			const popularLocations = async () => {
				const response = await fetch('".url("HomeController@popularLocations")."');
				return response.json();
			};

			const featuredPost = async () => {
				const response = await fetch('".url("HomeController@featuredPost")."');
				return response.json();
			};

			const latestArticles = async () => {
				const response = await fetch('".url("HomeController@latestArticles")."');
				return response.json();
			};

			popularLocations().then( response => {
				$('.popular-location-container').html(response.content);
			});

			featuredPost().then( response => {
				$('.featured-post-container').html(response.content);
			});

			latestArticles().then( response => {
				$('.latest-articles-container').html(response.content);
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
			
		
		"));

		$listings = $this->getModel("listing");

		$model = [
			"listings" => $listings
		];

		$this->saveTraffic([
			"name" => "Homepage",
			"url" => rtrim(WEBDOMAIN, '/') . url("HomeController@index")
		]);

		$this->setTemplate("home/index.php");
		return $this->getTemplate(null, $model);
	}

	function popularLocations() {
	
		$listings = $this->getModel("Listing");
		$listings->page['limit'] = 10;
		$listings->select(" COUNT(JSON_EXTRACT(address, '$.municipality')) as total, JSON_EXTRACT(address, '$.municipality') as city, JSON_EXTRACT(address, '$.region') as region, JSON_EXTRACT(address, '$.province') as province ");
		/* $listings->where(" is_website = 1 "); */
		$listings->groupBy(" city ");
		$data = $listings->getList();

		$this->setTemplate("home/popularLocations.php");
		$data = $this->getTemplate($data, $listings);

		echo json_encode([
			"status" => "success",
			"content" => $data
		]);

		exit();

	}

	function featuredPost() {

		$listings = $this->getModel("Listing");
		$listings->page['limit'] = 5;
		$listings
			->join(" l JOIN #__accounts a ON a.account_id = l.account_id")
				->where(" is_website = 1 ")
					->and(" featured = 1 ")
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

			$this->setTemplate("home/featuredPost.php");
			$data = $this->getTemplate($data, $listings);

			echo json_encode([
				"status" => "success",
				"content" => $data
			]);

			exit();

		}

	}

	function latestArticles() {

		$articles = $this->getModel("Article");
		$articles->page['limit'] = 6;
		$data['articles'] = $articles->getList();

		$this->setTemplate("home/latestArticles.php");
		$data = $this->getTemplate($data, $articles);

		echo json_encode([
			"status" => "success",
			"content" => $data
		]);

		exit();

	}

	private function saveTraffic($data) {

		$traffic = $this->getModel("Traffic");
		$traffic->select(" session_id, JSON_EXTRACT(traffic, '$.name') as name ");
		$traffic->column['session_id'] = $this->getLibrary("SessionHandler")->get("id");
		
		$response = $traffic->getBySessionId();

		if($response) {
			for($i=0; $i<count($response); $i++) {
				$arr[$response[$i]['session_id']][] = $response[$i]['name'];
			}
		}

		if(!isset($arr[ $traffic->column['session_id'] ]) || !in_array($data['name'], $arr[ $traffic->column['session_id'] ]) || !$response) {
			$traffic->select("");
			$traffic->saveNew(array(
				"traffic" => json_encode([
					"type" => "page",
					"name" => $data['name'],
					"id" => 0,
					"url" => $data['url'],
					"source" => "Website"
				]),
				"account_id" => 0,
				"session_id" => $this->getLibrary("SessionHandler")->get("id"),
				"created_at" => DATE_NOW,
				"user_agent" => json_encode($this->getLibrary("SessionHandler")->get("user_agent"))
			));
		}

	}

}