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
								<li class="nav-item <?php echo (url()->contains("/accounts")) ? "active" : ""; ?>">
									<a class="nav-link" href="<?php echo url("AccountsController@index"); ?>">
										<span class="nav-link-icon d-md-none d-lg-inline-block"><i class='ti ti-user-circle'></i></span>
										<span class="nav-link-title">Accounts</span>
									</a>
                				</li>
								<?php if(PREMIUM) { ?>
									<li class="nav-item <?php echo (url()->contains("/premiums")) ? "active" : ""; ?>">
										<a class="nav-link" href="<?php echo url("PremiumsController@index"); ?>">
											<span class="nav-link-icon d-md-none d-lg-inline-block"><i class='ti ti-layers-union'></i></span>
											<span class="nav-link-title">Premiums</span>
										</a>
									</li>
								<?php } ?>
							</ul>
						</div>
					</div>

					<div class="navbar-nav flex-row order-md-last">
						<div class="d-none d-md-flex">

							<div class="nav-item dropdown d-none d-md-flex me-3">
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
															<!-- Download SVG icon from http://tabler-icons.io/i/star -->
															<svg xmlns="http://www.w3.org/2000/svg" class="icon text-muted" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 17.75l-6.172 3.245l1.179 -6.873l-5 -4.867l6.9 -1l3.086 -6.253l3.086 6.253l6.9 1l-5 4.867l1.179 6.873z" /></svg>
															</a>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>

							<div class="nav-item dropdown">
								<a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown" aria-label="Open user menu">
									<span class="avatar avatar-sm" style="background-image: url(<?php echo $_SESSION['logo']; ?>)"></span>
									<div class="d-none d-xl-block ps-2">
										<div><?php echo $_SESSION['name']; ?></div>
										<div class="mt-1 small text-muted"><?php echo $_SESSION['account_type']; ?></div>
									</div>
								</a>
								<div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
									<a href="<?php echo url("UsersController@userEdit",["id" => $_SESSION['user_id']]); ?>" class="dropdown-item">Update Account</a>
									<a href="?logout" class="dropdown-item">Logout</a>
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