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
				<div class='container-xl mb-4 py-5 px-4 fs-16'>
					<div class='row'>
						<div class='col-lg-3 col-md-4 col-sm-12'>
							<div class='mb-4'>
								<h3>Main</h3>
								<ul class='list-group list-group-flush m-0 p-0'>
									<li class='list-group-item px-0 py-0 border-0'><a href='<?=url(WEB_ALIAS . "/buy");?>' class='text-white text-decoration-none'>Buy Property</a></li>
									<li class='list-group-item px-0 py-0 border-0'><a href='<?=url(WEB_ALIAS . "/rent");?>' class='text-white text-decoration-none'>Rent Property</a></li>
									<li class='list-group-item px-0 py-0 border-0'><a href='<?=url(WEB_ALIAS . "/articles");?>' class='text-white text-decoration-none'>Articles</a></li>
									<li class='list-group-item px-0 py-0 border-0'><a href='<?=url(WEB_ALIAS . "/about");?>' class='text-white text-decoration-none'>About</a></li>
									<li class='list-group-item px-0 py-0 border-0'><a href='<?=url(WEB_ALIAS . "/contact");?>' class='text-white text-decoration-none'>Contact</a></li>
									<li class='list-group-item px-0 py-0 border-0'><a href='<?=url(WEB_ALIAS . "/terms");?>' class='text-white text-decoration-none'>Terms</a></li>
									<li class='list-group-item px-0 py-0 border-0'><a href='<?=url(WEB_ALIAS . "/data-privacy");?>' class='text-white text-decoration-none'>Data Privacy</a></li>
								</ul>
							</div>
						</div>

						<div class='col-lg-5 col-md-4 col-sm-12'>
							<div class='mb-4'>
								<h3>Leading the Real Estate Landscape in the Philippines</h3>
								<p>The Philippine Association of Real Estate Boards Inc. (PAREB) is the premier and largest national real estate service organization in the Philippines. It comprises 68 local member boards with a collective membership of 5,000 real estate practitioners.</p>
								<p><i class='ti ti-map-pin'></i> Our Headquarters is lcoated at The PAREB Centre, P.E. Antonio Brgy. Ugong, Pasig City</p>
							</div>
						</div>
						
						<div class='col-lg-4 col-md-4 col-sm-12'>
							<div class='mb-4'>
								<h3>Social</h3>
							</div>
						</div>
					</div>

					<p class='text-center'>&copy; <?=WEBDOMAIN;?> All Rights reserved.</p>
				</div>
			</div>

		</body>
</html>