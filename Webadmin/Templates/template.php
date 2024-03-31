<!doctype html>
<html lang="en">

    <head>
        <?php require_once("header.php"); ?>
    </head>
    <body>

		<div class='modal' id='accountModal' aria-labelledby='accountModal' aria-hidden='true'>
			<div class='modal-dialog modal-lg'>
				<div class='modal-content'>
					<div class='modal-body'>
						<div class='response-modal'></div>
					</div>
				</div>
			</div>
		</div>

		<div class='offcanvas offcanvas-end' tabindex='-1' id='offcanvasEnd' aria-labelledby='offcanvasEndLabel' aria-modal='true' role='dialog'>
		</div>

		<div class='page'>
			<header class="navbar navbar-expand-md navbar-overlap d-print-none"  data-bs-theme="dark">
				
				<div class="container-xl">
					<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu" aria-controls="navbar-menu" aria-expanded="false" aria-label="Toggle navigation">
						<span class="navbar-toggler-icon"></span>
					</button>

					<h1 class="navbar-brand navbar-brand-autodark d-none-navbar-horizontal pe-0 pe-md-3"><a href="#">Logo</a></h1>

					<div class="collapse navbar-collapse" id="navbar-menu">
						<div class="d-flex flex-column flex-md-row flex-fill align-items-stretch align-items-md-center">
							<ul class="navbar-nav">
								<li class="nav-item <?php echo (url() == "/") ? "active" : ""; ?>">
									<a class="nav-link" href="<?php echo url("DashboardController@index"); ?>">
										<span class="nav-link-icon d-md-none d-lg-inline-block"><svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 12l-2 0l9 -9l9 9l-2 0" /><path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" /><path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" /></svg></span>
										<span class="nav-link-title">Home</span>
									</a>
                				</li>

								<?php if($_SESSION['user_logged']['permissions']['articles']['access']) { ?>
									<li class="nav-item <?php echo (url()->contains("/articles")) ? "active" : ""; ?>">
										<a class="nav-link" href="<?php echo url("ArticlesController@index"); ?>">
											<span class="nav-link-icon d-md-none d-lg-inline-block"><i class='ti ti-edit'></i></span>
											<span class="nav-link-title">Articles</span>
										</a>
									</li>
								<?php } ?>

								<?php if($_SESSION['user_logged']['permissions']['web_settings']['access']) { ?>
									<li class="nav-item <?php echo (url()->contains("/settings")) ? "active" : ""; ?>">
										<a class="nav-link" href="<?php echo url("SettingsController@webSettings",["page" => "common-settings"]); ?>">
											<span class="nav-link-icon d-md-none d-lg-inline-block"><i class='ti ti-settings-cog'></i></span>
											<span class="nav-link-title">Settings</span>
										</a>
									</li>
								<?php } ?>

								
									<li class="nav-item <?php echo (url()->contains("/ads")) ? "active" : ""; ?>">
										<a class="nav-link" href="<?php echo url("PageAdsController@index"); ?>">
											<span class="nav-link-icon d-md-none d-lg-inline-block"><i class='ti ti-ad'></i></span>
											<span class="nav-link-title">Page Ads Management</span>
										</a>
									</li>
								

							</ul>
						</div>
					</div>

					<div class="navbar-nav flex-row order-md-last">
						<div class="d-flex">

							<div class="nav-item dropdown d-none d-md-flex me-3 notifications-container"></div>

							<div class="nav-item dropdown">
								<a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown" aria-label="Open user menu">
									<span class="avatar avatar-sm" style="background-image: url(<?php echo $_SESSION['user_logged']['logo']; ?>)"></span>
									<div class="d-none d-xl-block ps-2">
										<div><?php echo $_SESSION['user_logged']['name']; ?></div>
										<div class="mt-1 small text-muted"><?php echo $_SESSION['user_logged']['account_type']; ?></div>
									</div>
								</a>
								<div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
									<a href="<?php echo url("UsersController@changePassword", ["id" => $_SESSION['user_logged']['user_id']]); ?>" class="dropdown-item"><i class='ti ti-key me-2'></i> Change Password</a>
									<a href="<?php echo WEBADMIN; ?>?logout" class="dropdown-item"><i class='ti ti-logout-2 me-2'></i> Logout</a>
								</div>
							</div>

						</div>
					</div>

				</div>
			</header>
		
			<div class="page-wrapper">
				<?php echo $content; ?>
			</div>

		</div>

    </body>
</html>