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
								<li class="nav-item">
									<a class="nav-link" href="<?php echo url("DashboardController@index"); ?>">
										<span class="nav-link-icon d-md-none d-lg-inline-block"><i class='ti ti-layout-dashboard'></i></span>
										<span class="nav-link-title">Dashboard</span>
									</a>
                				</li>

								<li class="nav-item <?php echo (url()->contains("/reports")) ? "active" : ""; ?> dropdown">
									<a class="nav-link dropdown-toggle" href="#extra-link" data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button" aria-expanded="false">
										<span class="nav-link-icon d-md-none d-lg-inline-block"><i class='ti ti-report'></i></span>
										<span class="nav-link-title">System Management</span>
									</a>
									<div class='dropdown-menu'>
										<?php if(isset($_SESSION['user_logged']['permissions']['accounts']['access'])) { ?>
											<a href='<?php echo url("AccountsController@index"); ?>' class='dropdown-item'><i class='ti ti-user-circle me-1'></i> Accounts</a>
										<?php } ?>

										<?php if(isset($_SESSION['user_logged']['permissions']['kyc']['access'])) { ?>
											<a href='<?php echo url("KYCController@index"); ?>' class='dropdown-item'><i class='ti ti-id me-1'></i> KYC</a>
										<?php } ?>

										<?php if(PREMIUM) { ?>
											<?php if(isset($_SESSION['user_logged']['permissions']['premiums']['access'])) { ?>
												<a href='<?php echo url("PremiumsController@index"); ?>' class='dropdown-item'><i class='ti ti-layers-union me-1'></i> Premiums</a>
											<?php } ?>
										<?php } ?>

										<?php if(isset($_SESSION['user_logged']['permissions']['page_ads']['access'])) { ?>
											<a href='<?php echo url("PageAdsController@index"); ?>' class='dropdown-item'><i class='ti ti-ad me-1'></i> Page Ads Management</a>
										<?php } ?>

										<?php if(isset($_SESSION['user_logged']['permissions']['articles']['access'])) { ?>
											<a href='<?php echo url("ArticlesController@index"); ?>' class='dropdown-item'><i class='ti ti-edit me-1'></i> Articles</a>
										<?php } ?>

									</div>
								</li>

								<li class="nav-item <?php echo (url()->contains("/reports")) ? "active" : ""; ?> dropdown">
									<a class="nav-link dropdown-toggle" href="#extra-link" data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button" aria-expanded="false">
										<span class="nav-link-icon d-md-none d-lg-inline-block"><i class='ti ti-report'></i></span>
										<span class="nav-link-title">Settings</span>
									</a>
									<div class='dropdown-menu'>
										<?php if(isset($_SESSION['user_logged']['permissions']['settings']['access'])) { ?>
											<a href='<?php echo url("SettingsController@index", ["page" => "system-settings"]); ?>' class='dropdown-item'><i class='ti ti-settings-cog me-1'></i> System Settings</a>
										<?php } ?>
										<?php if(isset($_SESSION['user_logged']['permissions']['web_settings']['access'])) { ?>
											<a href='<?php echo url("SettingsController@webSettings", ["page" => "common-settings"]); ?>' class='dropdown-item'><i class='ti ti-settings-cog me-1'></i> Website Settings</a>
										<?php } ?>
									</div>
								</li>
								
								<?php if(isset($_SESSION['user_logged']['permissions']['reports']['access'])) { ?>
									<li class="nav-item <?php echo (url()->contains("/reports")) ? "active" : ""; ?> dropdown">
										<a class="nav-link dropdown-toggle" href="#extra-link" data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button" aria-expanded="false">
											<span class="nav-link-icon d-md-none d-lg-inline-block"><i class='ti ti-report'></i></span>
											<span class="nav-link-title">Reports</span>
										</a>
										<div class='dropdown-menu'>
											<?php if(isset($_SESSION['user_logged']['permissions']['transactions']['access'])) { ?>
												<a href='<?php echo url("TransactionsController@index"); ?>' class='dropdown-item'><i class='ti ti-file-invoice me-1'></i> All Transactions</a>
											<?php } ?>
											<a href='<?php echo url("ReportsController@subscribersReport"); ?>' class='dropdown-item'><i class='ti ti-report me-1'></i> Subscribers Report</a>
											<a href='<?php echo url("ReportsController@transactionsReport"); ?>' class='dropdown-item'><i class='ti ti-report me-1'></i> Transactions Report</a>
											<a href='<?php echo url("ReportsController@propertiesReport"); ?>' class='dropdown-item'><i class='ti ti-report me-1'></i> Listings Report</a>
										</div>
									</li>
								<?php } ?>

								<?php if($_SESSION['user_logged']['user_level'] == 1 && $_SESSION['user_logged']['account_type'] == "Administrator") { ?>
									<li class="nav-item">
										<a class="nav-link" href="<?php echo url("AdministrationController@index"); ?>">
											<span class="nav-link-icon d-md-none d-lg-inline-block"><i class='ti ti-database'></i></span>
											<span class="nav-link-title">Database Administration</span>
										</a>
									</li>
								<?php } ?>
								
							</ul>
						</div>
					</div>

					<div class="navbar-nav flex-row order-md-last">
						<div class="d-flex">

							<!-- <div class="nav-item dropdown d-none d-md-flex me-3">
								<a href="#" class="nav-link px-0" data-bs-toggle="dropdown" tabindex="-1" aria-label="Show notifications">
									<i class='ti ti-bell'></i> <span class="badge bg-red"></span>
								</a>
								
								<div class="dropdown-menu dropdown-menu-arrow dropdown-menu-end dropdown-menu-card">
									<div class="card">
										<div class="card-header">
											<h3 class="card-title">Last updates</h3>
										</div>
										<div class="list-group list-group-flush list-group-hoverable">
											<div class="list-group-item">
												<div class="row align-items-center">
													<div class="col-auto"><span class="status-dot status-dot-animated bg-red d-block"></span>
														<div class="col text-truncate">
															<a href="#" class="text-body d-block">Example 1</a>
															<div class="d-block text-muted text-truncate mt-n1">
															Change deprecated html tags to text decoration classes (#29604)
															</div>
														</div>
														<div class="col-auto">
															<a href="#" class="list-group-item-actions">
															<svg xmlns="http://www.w3.org/2000/svg" class="icon text-muted" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 17.75l-6.172 3.245l1.179 -6.873l-5 -4.867l6.9 -1l3.086 -6.253l3.086 6.253l6.9 1l-5 4.867l1.179 6.873z" /></svg>
															</a>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div> -->

							<div class="nav-item dropdown">
								<a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown" aria-label="Open user menu">
									<span class="avatar avatar-sm" style="background-image: url(<?php echo $_SESSION['user_logged']['logo']; ?>)"></span>
									<div class="d-none d-xl-block ps-2">
										<div><?php echo $_SESSION['user_logged']['name']; ?></div>
										<div class="mt-1 small text-muted"><?php echo $_SESSION['user_logged']['account_type']; ?></div>
									</div>
								</a>
								<div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
									<a href="<?php echo url("UsersController@userEdit",["id" => $_SESSION['user_logged']['user_id']]); ?>" class="dropdown-item">Update Account</a>
									<a href="<?php echo ADMIN; ?>?logout" class="dropdown-item">Logout</a>
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