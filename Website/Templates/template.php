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

			<div class='main-footer p-4 pb-2 bg-blue text-white'>
				<div class='container-xl'>
					<div class='row'>
						<div class='col-md-4 col-12'>
							<h3>Main</h3>
							<ul class='list-style-none'>
								<li><a href='<?=url("/");?>' class='text-white text-decoration-none'>Home</a></li>
								<li><a href='<?=url("/buy");?>' class='text-white text-decoration-none'>Buy Property</a></li>
								<li><a href='<?=url("/rent");?>' class='text-white text-decoration-none'>Rent Property</a></li>
								<li><a href='<?=url("/articles");?>' class='text-white text-decoration-none'>Articles</a></li>
								<li><a href='<?=url("/about");?>' class='text-white text-decoration-none'>About</a></li>
								<li><a href='<?=url("/contact");?>' class='text-white text-decoration-none'>Contact</a></li>
								<li><a href='<?=url("/terms");?>' class='text-white text-decoration-none'>Terms</a></li>
								<li><a href='<?=url("/data-privacy");?>' class='text-white text-decoration-none'>Data Privacy</a></li>
							</ul>
						</div>
						<div class='col-md-4 col-12'>
							
						</div>
						<div class='col-md-4 col-12'>

						</div>
					</div>

					<p>&copy; <?=WEBDOMAIN;?> All Rights reserved.</p>
				</div>
			</div>

		</body>
</html>