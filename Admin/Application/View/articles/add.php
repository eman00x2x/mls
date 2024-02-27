<?php

$html[] = "<input type='hidden' id='photo_uploader' value='article' />";
$html[] = "<form action='".url("ArticlesController@uploadPhoto")."' id='imageUploadForm' method='POST' enctype='multipart/form-data'>";
	$html[] = "<center>";
		$html[] = "<input type='file' name='ImageBrowse' id='ImageBrowse' />";
	$html[] = "</center>";
$html[] = "</form>";

$html[] = "<div class='container-xl'>";
	$html[] = "<div class='response'>";
		$html[] = getMsg();
	$html[] = "</div>";
$html[] = "</div>";

$html[] = "<input type='hidden' id='save_url' value='".url("ArticlesController@saveNew")."' />";

$html[] = "<div class='row justify-content-center mb-5 pb-5'>";
	$html[] = "<div class='col-md-6 col-12'>";

		$html[] = "<div class='page-header d-print-none text-white'>";
			$html[] = "<div class='container-xl'>";

				$html[] = "<div class='row g-2 '>";
					$html[] = "<div class='col'>";
						$html[] = "<div class='page-pretitle'>Articles from website</div>";
						$html[] = "<h1 class='page-title'><i class='ti ti-edit me-2'></i> Articles</h1>";
					$html[] = "</div>";

					$html[] = "<div class='col-auto ms-auto d-print-none'>";
						$html[] = "<div class='d-none d-sm-inline'>";
							$html[] = "<div class='btn-list'>";
								
							$html[] = "</div>";
						$html[] = "</div>";
					$html[] = "</div>";
				$html[] = "</div>";

			$html[] = "</div>";
		$html[] = "</div>";

		$html[] = "<div class='page-body'>";
			$html[] = "<div class='container-xl'>";

				$html[] = "<form id='form' action='' method='POST'>";
					$html[] = "<input name='_method' id='_method' type='hidden' value='post' />";
					
					$html[] = "<div class='card mb-3'>";
						$html[] = "<div class='card-header'>";
							$html[] = "<h3 class='card-title text-blue mb-0'>Update Article</h3>";
						$html[] = "</div>";

						$html[] = "<div class='card-body'>";

							$html[] = "<div class='text-center bg-white mb-5'>";
								$html[] = "<input type='hidden' name='banner' class='banner' id='banner' class='form-control' value='' />";
								$html[] = "<span class='avatar photo-preview mb-1 w-100 mb-3' style='background-image: url(".CDN."images/blank-profile.png)'></span>";
								$html[] = "<small>Click to Upload Banner</small>";
								$html[] = "<span class='photo-upload-loader d-block'></span>";
							$html[] = "</div>";

							$html[] = "<div class='row mb-3'>";
								$html[] = "<label class='text-muted col-sm-3 col-form-label text-end'>Title</label>";
								$html[] = "<div class='col-sm-9'>";
									$html[] = "<input type='text' name='title' id='title' value='' class='form-control' />";
								$html[] = "</div>";
							$html[] = "</div>";

							$html[] = "<div class='row mb-3'>";
								$html[] = "<label class='text-muted col-sm-3 col-form-label text-end'>Category</label>";
								$html[] = "<div class='col-sm-9'>";
									$html[] = "<select class='form-select' name='category' id='category'>";
										foreach (["News", "Promo", "Tips", "Event"] as $category) {
											$html[] = "<option value='$category'>".$category."</option>";
										}
									$html[] = "</select>";
								$html[] = "</div>";
							$html[] = "</div>";

							$html[] = "<div class='row mb-3'>";
								$html[] = "<label class='text-muted col-sm-3 col-form-label text-end'>Status</label>";
								$html[] = "<div class='col-sm-9'>";
									$html[] = "<select class='form-select' name='publish' id='publish'>";
										foreach ([0 => "Unpublish", 1 => "Publish"] as $key => $status) {
											$html[] = "<option value='$key' >".$status."</option>";
										}
									$html[] = "</select>";
								$html[] = "</div>";
							$html[] = "</div>";

							$html[] = "<div class='row mb-3'>";
								$html[] = "<label class='text-muted col-sm-3 col-form-label text-end'>Content</label>";
								$html[] = "<div class='col-sm-9'>";
									$html[] = "<textarea class='form-control' name='content' id='snow-container'></textarea>";
								$html[] = "</div>";
							$html[] = "</div>";

						$html[] = "</div>";
					$html[] = "</div>";

				$html[] = "</form>";

			$html[] = "</div>";

		$html[] = "</div>";

	$html[] = "</div>";
$html[] = "</div>";

$html[] = "<div class='btn-save-container fixed-bottom bg-white py-3 border-top'>";
	$html[] = "<div class='row g-0 justify-content-center'>";
		$html[] = "<div class='col-lg-8 col-md-8 col-sm-12 col-12'>";

			$html[] = "<div class='container-xl'>";
				$html[] = "<div class='text-end'>";
					$html[] = "<span class='btn btn-outline-primary btn-save'><i class='ti ti-device-floppy me-2'></i> Save Article</span>";
				$html[] = "</div>";
			$html[] = "</div>";

		$html[] = "</div>";
	$html[] = "</div>";
$html[] = "</div>";

$html[] = "<script type='text/javascript'>";
	$html[] = "
	$(document).ready(function() {
		tinymce.remove();
				
		tinymce.init({
			selector: 'textarea#snow-container',
			height: 500,
			width: 'auto',
			resize: false,
			menubar: false,
			plugins: [
				'advlist autolink lists link charmap print preview anchor',
				'searchreplace visualblocks code fullscreen',
				'insertdatetime media table paste code wordcount image '
			],
			toolbar: 'table image link formatting | fontsizeselect | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | code ',
			toolbar_groups: {
				formatting: {
					icon: 'bold',
					tooltip: 'Formatting',
					items: 'bold italic underline | superscript subscript'
				},
				alignment: {
					icon: 'alignjustify',
					tooltip: 'alignment',
					items: ''
				}
			},
			content_css: [
				'//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
				'".WEBDOMAIN."/css/style.css'
			]
		});
	});
	";
$html[] = "</script>";