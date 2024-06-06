<header class="navbar navbar-expand-md d-print-none px-3 fs-16">
	<div class="container-xl">
	
		<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu" aria-controls="navbar-menu" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<h1 class="navbar-brand d-none-navbar-horizontal pe-0 pe-md-3">
			<a href="<?php echo WEBDOMAIN; ?>" class='text-decoration-none'>
				<img src="<?php echo CDN."images/logo.png"; ?>" width="50" class="navbar-brand-image"> PAREB MLS
			</a>
		</h1>

		<div class="navbar-nav flex-row order-md-last">
			<div class="nav-item">
				<div class="btn-list">
					<a href="<?=MANAGE;?>" class="btn p-0 border-0" target="_blank" rel="noreferrer"><i class='ti ti-lock me-1'></i> Login</a>
				</div>
            </div>
		</div>
		
		<div class="collapse navbar-collapse" id="navbar-menu">
			<div class="d-flex flex-column flex-md-row flex-fill align-items-stretch align-items-md-center">
				<ul class="navbar-nav">
					<?php
						$html[] = "<li class='nav-item'>";

							$html[] = "<div class='dropdown'>";
								$html[] = "<span class='nav-link dropdown-toggle cursor-pointer' id='menuForBuyProperty' data-bs-toggle='dropdown' aria-expanded='false'><span class='nav-link-title'>Buy Property</span></span>";
								$html[] = "<div class='dropdown-menu' aria-labelledby='menuForBuyProperty'>";
									foreach([
										"House and Lot", "Towhouse", "Condominium", "Residential Lot", "Commercial Lot"
									] as $category) {
										$html[] = "<a class='dropdown-item' href='".url('ListingsController@buy', null, [ "category" => $category ])."' >Buy $category</a>";
									}
								$html[] = "</div>";
							$html[] = "</div>";

						$html[] = "</li>";
						$html[] = "<li class='nav-item'>";

							$html[] = "<div class='dropdown'>";
								$html[] = "<span class='nav-link dropdown-toggle cursor-pointer' id='menuForRentProperty' data-bs-toggle='dropdown' aria-expanded='false'><span class='nav-link-title'>Rent Property</span></span>";
								$html[] = "<div class='dropdown-menu' aria-labelledby='menuForRentProperty'>";
									foreach([
										"House and Lot", "Towhouse", "Condominium", "Residential Lot", "Commercial Lot"
									] as $category) {
										$html[] = "<a class='dropdown-item' href='".url('ListingsController@rent', null, [ "category" => $category ])."' >Rent $category</a>";
									}
								$html[] = "</div>";
							$html[] = "</div>";

						$html[] = "</li>";

						$html[] = "<li class='nav-item'>";

							$html[] = "<div class='dropdown'>";
								$html[] = "<span class='nav-link dropdown-toggle cursor-pointer' id='menuForPopularLocation' data-bs-toggle='dropdown' aria-expanded='false'><span class='nav-link-title'>Popular Locations</span></span>";
								$html[] = "<div class='dropdown-menu locationContainer' aria-labelledby='menuForPopularLocation'>";
								$html[] = "</div>";
							$html[] = "</div>";

						$html[] = "</li>";

						$html[] = "<li class='nav-item'>";
							$html[] = "<a class='nav-link' href='".url("AccountsController@memberDirectory")."'>Find a Real Estate Broker</a>";
						$html[] = "</li>";

						echo implode("", $html);
					?>
				</ul>
			</div>
		</div>
	
	</div>
</header>