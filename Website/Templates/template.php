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

			<div class='main-footer p-4 pb-5 bg-blue text-white mb-5 d-print-none'>
				<div class='container-xl mb-5 pb-5'>
					<div class='row'>
						<div class='col-lg-4 col-md-4 col-sm-12'>
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

						<div class='col-lg-4 col-md-4 col-sm-12'>
							<div class='mb-4'>
								<h3>Address</h3>
								<p class='m-0 p-0'>Maecenas ac diam vel tellus feugiat fringilla</p>
								<p class='m-0 p-0'>Pellentesque eleifend ex neque, sit amet ultrices nunc congue in. Proin finibus mi nec lacus ornare euismod</p>
							</div>
						</div>
						
						<div class='col-lg-4 col-md-4 col-sm-12'>
							<div class='mb-4'>
								<h3>Social</h3>
								<p class='m-0 p-0'>Maecenas ac diam vel tellus feugiat fringilla</p>
								<p class='m-0 p-0'>Pellentesque eleifend ex neque, sit amet ultrices nunc congue in. Proin finibus mi nec lacus ornare euismod</p>
							</div>
						</div>
					</div>

					<p>&copy; <?=WEBDOMAIN;?> All Rights reserved.</p>
				</div>
			</div>

		</body>
</html>