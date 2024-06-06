<!doctype html>
<html lang="en">

	<head>
			<?php require_once("header.php"); ?>
	</head>
		<body>

			<div class='offcanvas offcanvas-end overflow-auto' tabindex='-1' id='offcanvasEnd' aria-labelledby='offcanvasEndLabel' aria-modal='true' role='dialog'></div>

			<?php require_once("menu.php"); ?>

			<div class="page-wrapper">
				<?php echo $content; ?>
			</div>

			<div class='main-footer py-5 text-white mb-5 d-print-none'>
				<div class='container-xl mb-4 py-5 px-4 fs-14'>
					<div class='row'>
						<div class='col-lg-3 col-md-4 col-sm-12'>
							<div class='mb-4'>
								<h3>Main</h3>
								<ul class='list-group list-group-flush m-0 p-0'>
									<li class='list-group-item px-0 py-0 border-0'><a href='<?=url("ListingsController@buy");?>' class='text-decoration-none'><i class='ti ti-chevron-right me-1'></i> Buy Property</a></li>
									<li class='list-group-item px-0 py-0 border-0'><a href='<?=url("ListingsController@rent");?>' class='text-decoration-none'><i class='ti ti-chevron-right me-1'></i> Rent Property</a></li>
									<li class='list-group-item px-0 py-0 border-0'><a href='<?=url("ArticlesController@index");?>' class='text-decoration-none'><i class='ti ti-chevron-right me-1'></i> Articles</a></li>
									<li class='list-group-item px-0 py-0 border-0'><a href='<?=url("PagesController@about");?>' class='text-decoration-none'><i class='ti ti-chevron-right me-1'></i> About</a></li>
									<li class='list-group-item px-0 py-0 border-0'><a href='<?=url("PagesController@contact");?>' class='text-decoration-none'><i class='ti ti-chevron-right me-1'></i> Contact</a></li>
									<li class='list-group-item px-0 py-0 border-0'><a href='<?=url("PagesController@terms");?>' class='text-decoration-none'><i class='ti ti-chevron-right me-1'></i> Terms</a></li>
									<li class='list-group-item px-0 py-0 border-0'><a href='<?=url("PagesController@privacy");?>' class='text-decoration-none'><i class='ti ti-chevron-right me-1'></i> Data Privacy</a></li>
								</ul>
							</div>
						</div>

						<div class='col-lg-5 col-md-4 col-sm-12'>
							<div class='mb-4'>
								<h3>Leading the Real Estate Landscape in the Philippines</h3>
								<p>The Philippine Association of Real Estate Boards Inc. (PAREB) is the foremost and largest national real estate service organization in the Philippines, encompassing 68 local member boards with a combined membership of 5,000 real estate practitioners.</p>
								<p><i class='ti ti-map-pin'></i> Our Headquarters is located at The PAREB Centre, P.E. Antonio Brgy. Ugong, Pasig City</p>
							</div>
						</div>
						
						<div class='col-lg-4 col-md-4 col-sm-12'>
							<div class='mb-4'>
								<h3>Useful Links</h3>
								<ul class='list-group list-group-flush m-0 p-0'>
									<li class='list-group-item px-0 py-0 border-0'><a href='https://www.bir.gov.ph/index.php/zonal-values.html' class='text-decoration-none' target="_blank"><i class='ti ti-chevron-right me-1'></i> BIR Zonal Values</a></li>
									<li class='list-group-item px-0 py-0 border-0'><a href='https://www.phivolcs.dost.gov.ph/index.php/information-tool/the-phivolcs-faultfinder' class='text-decoration-none' target="_blank"><i class='ti ti-chevron-right me-1'></i> PHIVOLCS FaultFinder </a></li>
								</ul>
							</div>
						</div>
					</div>

					<p class='text-center'>&copy; <?php echo date("Y"); ?> <?=WEBDOMAIN;?> All Rights reserved.</p>
				</div>
			</div>

		</body>
</html>