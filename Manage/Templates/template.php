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
			<div class='p-5'>
				<div class='d-flex align-items-center gap-3'>
					<div class='loader'></div>
					<p class='mb-0'>Please wait while retrieving content...</p>
				</div>
			</div>
		</div>

		<div class='page'>

			<header class="navbar navbar-expand-md navbar-overlap d-print-none"  data-bs-theme="dark">
				
				<div class="container-xl">
					<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu" aria-controls="navbar-menu" aria-expanded="false" aria-label="Toggle navigation">
						<span class="navbar-toggler-icon"></span>
					</button>

					<h1 class="navbar-brand navbar-brand-autodark d-none-navbar-horizontal pe-0 pe-md-3"><a href="<?php echo MANAGE; ?>" class="text-decoration-none"><img src='<?php echo CDN."images/favicon/favicon-32x32.png"; ?>' /> <?php echo CONFIG['site_name']; ?></a></h1>

					<div class="collapse navbar-collapse" id="navbar-menu">
						<div class="d-flex flex-column flex-md-row flex-fill align-items-stretch align-items-md-center">
							<ul class="navbar-nav">
								<li class="nav-item">
									<a class="nav-link" href="<?php echo url("DashboardController@index"); ?>">
										<span class="nav-link-icon d-md-none d-lg-inline-block"><i class='ti ti-layout-dashboard'></i></span>
										<span class="nav-link-title">Dashboard</span>
									</a>
                				</li>
								<li class="nav-item <?php echo (url()->contains("/listings")) ? "active" : ""; ?>">
									<a class="nav-link" href="<?php echo url("ListingsController@index"); ?>">
										<span class="nav-link-icon d-md-none d-lg-inline-block"><i class='ti ti-building-estate'></i></span>
										<span class="nav-link-title">Listings</span>
									</a>
                				</li>

								<li class="nav-item <?php echo (url()->contains("/mls")) ? "active" : ""; ?> dropdown">
									<a class="nav-link dropdown-toggle" href="#extra-link" data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button" aria-expanded="false">
										<span class="nav-link-icon d-md-none d-lg-inline-block"><i class='ti ti-building-estate'></i></span>
										<span class="nav-link-title">MLS</span>
									</a>
									<div class='dropdown-menu'>
										<a href='<?php echo url("MlsController@MLSLocalBoard", [ "local_board" => str_replace(" ","_", $_SESSION['user_logged']['local_board_name']) ]); ?>' class='dropdown-item'>Local Board MLS (<?php echo $_SESSION['user_logged']['local_board_name']; ?>)</a>
										<a href='<?php echo url("MlsController@MLSRegional", [ "region" => str_replace(" ","_", $_SESSION['user_logged']['board_region']['region']) ]); ?>' class='dropdown-item'>Regional MLS (<?php echo $_SESSION['user_logged']['board_region']['region']; ?>)</a>
										<a href='<?php echo url("MlsController@MLSIndex"); ?>' class='dropdown-item'>PAREB National MLS</a>
										<?php if((isset($this->session['privileges']['comparative_analysis_access']) && $this->session['privileges']['comparative_analysis_access'] == 1)) { ?>
											<a href='<?php echo url("MlsController@marketComparisonForm"); ?>' class='dropdown-item'>Comparative Market Analysis</a>
										<?php } ?>
									</div>
                				</li>

								<li class="nav-item <?php echo (url()->contains("/leads")) ? "active" : ""; ?>">
									<a class="nav-link" href="<?php echo url("LeadsController@index"); ?>">
										<span class="nav-link-icon d-md-none d-lg-inline-block"><i class='ti ti-users'></i></span>
										<span class="nav-link-title">Leads</span>
									</a>
                				</li>

								<li class="nav-item <?php echo (url()->contains("/threads")) ? "active" : ""; ?>">
									<a class="nav-link" href="<?php echo url("MessagesController@index"); ?>">
										<span class="nav-link-icon d-md-none d-lg-inline-block"><i class='ti ti-message'></i></span>
										<span class="nav-link-title">Messages</span>
									</a>
                				</li>

								<?php if(PREMIUM) { ?>
									<?php if(isset($_SESSION['user_logged']['permissions']['premiums']['process_subscription'])) { ?>
										<li class="nav-item <?php echo (url()->contains("/premiums")) ? "active" : ""; ?>">
											<a class="nav-link" href="<?php echo url("PremiumsController@index"); ?>">
												<span class="nav-link-icon d-md-none d-lg-inline-block"><i class='ti ti-layers-union'></i></span>
												<span class="nav-link-title">Get Premium</span>
											</a>
										</li>
									<?php } ?>
								<?php } ?>

							</ul>
						</div>
					</div>

					<div class="navbar-nav flex-row order-md-last">
						<div class="mt-2 d-md-flex">

							<div class="nav-item dropdown d-none d-md-flex me-3 notifications-container">
								
							</div>

							<div class="nav-item dropdown">
								<a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown" aria-label="Open user menu">
									<span class="avatar avatar-sm" style="background-image: url(<?php echo $_SESSION['user_logged']['logo']; ?>)"></span>
									<div class="d-none d-xl-block ps-2">
										<div><?php echo $_SESSION['user_logged']['name']; ?></div>
										<div class="mt-1 small text-muted"><?php echo $_SESSION['user_logged']['account_type']; ?></div>
									</div>
								</a>
								<div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
									<?php if(isset($_SESSION['user_logged']['permissions']['accounts']['access'])) { ?>
										<a href="<?php echo url("AccountsController@index",["id" => $_SESSION['user_logged']['account_id']]); ?>" class="dropdown-item"><i class='ti ti-user-circle me-2'></i> My Account</a>
									<?php } ?>
									<?php if(isset($_SESSION['user_logged']['permissions']['users']['access'])) { ?>
										<a href="<?php echo url("UsersController@index"); ?>" class="dropdown-item"><i class='ti ti-users me-2'></i> Manage Users</a>
									<?php } ?>

									<a href="<?php echo url("UsersController@changePassword", ["id" => $_SESSION['user_logged']['user_id']]); ?>" class="dropdown-item"><i class='ti ti-key me-2'></i> Change Password</a>
									<a href="<?php echo url("TestimonialsController@index"); ?>" class="dropdown-item"><i class='ti ti-speakerphone me-2'></i> My Testimonials</a>
									
									<?php if(PREMIUM) { ?>
										<a href="<?php echo url("AccountSubscriptionController@index"); ?>" class="dropdown-item"><i class='ti ti-layers-union me-2'></i> My Subscriptions</a>
										<?php if(isset($_SESSION['user_logged']['permissions']['transactions']['access'])) { ?>
											<a href="<?php echo url("TransactionsController@transactions"); ?>" class="dropdown-item"><i class='ti ti-file-invoice me-2'></i> My Transactions</a>
										<?php } ?>
									<?php } ?>

									<?php if(KYC) { ?>
										<a href="<?php echo url("KYCController@kycVerificationForm"); ?>" class="dropdown-item"><i class='ti ti-user-circle me-2'></i> KYC Verification</a>
									<?php } ?>

									<a href="<?php echo MANAGE; ?>?logout" class="dropdown-item"><i class='ti ti-logout-2 me-2'></i> Logout</a>
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