<!doctype html>
<html lang="en">

    <head>
        <?php require_once("header.php"); ?>
    </head>
    <body>

		<?php require_once("menu.php"); ?>

		<div class='hero-image'>
			<div class='bg-big' style='background-image: url(<?php echo CDN."images/website/Colliers_Viewpoint_hero_image_v1.jpg"; ?>)'>
				
				<div class='search-filter'>
					<div class='container-xl'>
						<div class='py-5'>
							<div class=''>
								<div class='btn-group'>
									<input type="radio" class="btn-check" name="btn-radio-basic" id="btn-radio-basic-1" autocomplete="off" checked >
									<label for="btn-radio-basic-1" type="button" class="btn border-0 rounded-0" style='width:150px;'>Buy</label>

									<input type="radio" class="btn-check" name="btn-radio-basic" id="btn-radio-basic-2" autocomplete="off"  >
									<label for="btn-radio-basic-2" type="button" class="btn border-0 rounded-0" style='width:150px;'>Rent</label>
								</div>
							</div>
							<div class='bg-white'>


								<div class="input-group ">
									<div class='form-floating w-50'>
										<select name='' id='category' class='form-select border-0'>
											<option value=''>Residential Land</option>
											<option value=''>House and Lot</option>
										</select>
										<label for='category'>Category</label>
									</div>

									<div class='form-floating w-70'>
										<input type='text' name='address' id='location' value='' placeholder='Select desired location' class='form-control border-0' />
										<label for='category'>Select Location</label>
									</div>

									<span class="btn btn-primary border-0" type="button"><i class='ti ti-search me-2'></i> Search</span>
								</div>

							</div>
						</div>
					</div>
				</div>

			</div>
		</div>

		<div class="page-wrapper">
			<?php echo $content; ?>
		</div>

    </body>
</html>