<header class="navbar navbar-expand-md d-print-none">
	<div class="container-xl">
		<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu" aria-controls="navbar-menu" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<h1 class="navbar-brand d-none-navbar-horizontal pe-0 pe-md-3">
			<a href="<?php echo WEBDOMAIN; ?>">
				<!-- <img src="./static/logo.svg" width="110" height="32" alt="Tabler" class="navbar-brand-image"> -->
				MLS
			</a>
		</h1>

		<div class="navbar-nav flex-row order-md-last">
			<div class="nav-item">
				<div class="btn-list">
					<a href="<?=WEBDOMAIN;?>" class="btn btn-md" target="_blank" rel="noreferrer"><i class='ti ti-lock me-1'></i> Login</a>
				</div>
            </div>
		</div>
		
		<div class="collapse navbar-collapse" id="navbar-menu">
			<div class="d-flex flex-column flex-md-row flex-fill align-items-stretch align-items-md-center">
				<ul class="navbar-nav">
					<li class="nav-item">
						<a class="nav-link" href="<?=WEBDOMAIN;?>" >
							<span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/home -->
								<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 12l-2 0l9 -9l9 9l-2 0" /><path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" /><path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" /></svg>
							</span>
							<span class="nav-link-title">
								Home
							</span>
						</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="<?=url("ListingsController@buy");?>" >
							<span class="nav-link-title">
								Buy
							</span>
						</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="<?=url("ListingsController@rent");?>" >
							<span class="nav-link-title">
								Rent
							</span>
						</a>
					</li>
				</ul>
			</div>
		</div>
	</div>
</header>