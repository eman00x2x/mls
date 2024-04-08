<!doctype html>
<html lang="en">

	<head>
			<?php require_once("header.php"); ?>
	</head>
		<body>

			<div class='offcanvas offcanvas-end overflow-auto' tabindex='-1' id='offcanvasEnd' aria-labelledby='offcanvasEndLabel' aria-modal='true' role='dialog'></div>

			<div class="page-wrapper">
				<?php echo $content; ?>
			</div>

			<div class='main-footer py-5 text-white mb-5 d-print-none'>
				<div class='container-xl mb-4 py-5 fs-16'>
					
					<p class='text-center'>&copy; <?=WEBDOMAIN;?> All Rights reserved.</p>
				</div>
			</div>

		</body>
</html>