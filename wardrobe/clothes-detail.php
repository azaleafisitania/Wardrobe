<!-- Validate if parameter is set -->
<?php
	if(!(isset($_GET['id']))) 
		header('Location: clothes.php');
	else
		$id = $_GET['id'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<?php include "meta-css.php"; ?>
	<title>Clothes Item #<?php echo $id; ?> | Wardrobe </title>
</head>


<body class="nav-md">

	<div class="container body">


		<div class="main_container">

			<!-- sidebar -->
			<?php include "sidebar.php"; ?>
			<!-- /sidebar -->

			<!-- top navigation -->
            <?php include "top-navigation.php"; ?>
			<!-- /top navigation -->

			<!-- page content -->
			<div class="right_col" role="main">
				<div class="">
					<div class="page-title">
						<div class="title_left">
							<h3><i class="fa fa-folder-open"></i> <a href="clothes.php">All Clothes</a> <i class="fa fa-angle-right"></i> Clothes Item #<?php echo $id; ?></h3>
						</div>

						<div class="title_right">
							<div class="col-md-5 col-sm-5 col-xs-5 form-group pull-right top_search">
								<div class="form-group">
									<div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
										<button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i> Delete Clothes</button>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="clearfix"></div>

					<div class="row">

						<div class="col-md-4 col-sm-4 col-xs-12">
							<div class="x_panel">
								<div class="x_title">
									<h2><i class="fa fa-info-circle"></i> Details</h2>
									<ul class="nav navbar-right panel_toolbox">
										<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
										</li>
										<li class="dropdown">
											<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
											<ul class="dropdown-menu" role="menu">
												<li><a href="#">Settings 1</a>
												</li>
												<li><a href="#">Settings 2</a>
												</li>
											</ul>
										</li>
										<li><a class="close"><i class="fa fa-close"></i></a>
										</li>
									</ul>
									<div class="clearfix"></div>
								</div>
								<div class="x_content clothes_photo">
									<!-- Photo here -->
								</div>
								<div class="x_content">
									
									<form class="form-horizontal form-label-left input_mask">
										<h2 class="page-header">Basic Details</h2>
										<div class="form-group">
											<label class="control-label col-md-3 col-sm-3 col-xs-12">Brand</label>
											<div class="col-md-9 col-sm-9 col-xs-12 clothes_brand">
												<!-- Brand here -->
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-md-3 col-sm-3 col-xs-12">Color</label>
											<div class="col-md-9 col-sm-9 col-xs-12 clothes_color">
												<!-- Color here -->
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-md-3 col-sm-3 col-xs-12">Pattern</label>
											<div class="col-md-9 col-sm-9 col-xs-12 clothes_pattern">
												<!-- Pattern here -->
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-md-3 col-sm-3 col-xs-12">Retailer</label>
											<div class="col-md-9 col-sm-9 col-xs-12 clothes_retailer">
												<!-- Retailer here -->
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-md-3 col-sm-3 col-xs-12">Price</label>
											<div class="col-md-9 col-sm-9 col-xs-12 clothes_price">
												<!-- Price here -->
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-md-3 col-sm-3 col-xs-12">Occasion</label>
											<div class="col-md-9 col-sm-9 col-xs-12 clothes_occasion">
												<!-- Occasion here -->
											</div>
										</div>
										<h2 class="page-header">Spesific Details</h2>
										<div class="ln_solid"></div>
										<div class="form-group">
											<div class="col-md-12 col-sm-12 col-xs-12">
												<button type="submit" class="btn btn-white"><i class="fa fa-remove"></i> Cancel</button>
												<button type="submit" class="btn btn-success"><i class="fa fa-check"></i> Save Changes</button>
											</div>
										</div>
									</form>
								</div>
							</div>
						</div>

						<div class="col-md-8 col-sm-8 col-xs-12">
							<div class="x_panel">
								<div class="x_title">
									<h2><i class="fa fa-sitemap"></i> Matches</h2>
									<ul class="nav navbar-right panel_toolbox">
										<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
										</li>
										<li class="dropdown">
											<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
											<ul class="dropdown-menu" role="menu">
												<li><a href="#">Settings 1</a>
												</li>
												<li><a href="#">Settings 2</a>
												</li>
											</ul>
										</li>
										<li><a class="close"><i class="fa fa-close"></i></a>
										</li>
									</ul>
									<div class="clearfix"></div>
								</div>
								<div class="x_content clothes_matches">
									<!-- Clothes matches here -->
								</div>
							</div>
						</div>

						<div class="col-md-8 col-sm-8 col-xs-12">
							<div class="x_panel">
								<div class="x_title">
									<h2><i class="fa fa-bars"></i> Layers</h2>
									<ul class="nav navbar-right panel_toolbox">
										<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
										</li>
										<li class="dropdown">
											<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
											<ul class="dropdown-menu" role="menu">
												<li><a href="#">Settings 1</a>
												</li>
												<li><a href="#">Settings 2</a>
												</li>
											</ul>
										</li>
										<li><a class="close"><i class="fa fa-close"></i></a>
										</li>
									</ul>
									<div class="clearfix"></div>
								</div>
								<div class="x_content clothes_layers">
									<!-- Clothes layers here -->
								</div>
							</div>
						</div>

						<div class="col-md-8 col-sm-8 col-xs-12">
							<div class="x_panel">
								<div class="x_title">
									<h2><i class="fa fa-history"></i> History</h2>
									<ul class="nav navbar-right panel_toolbox">
										<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
										</li>
										<li class="dropdown">
											<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
											<ul class="dropdown-menu" role="menu">
												<li><a href="#">Settings 1</a>
												</li>
												<li><a href="#">Settings 2</a>
												</li>
											</ul>
										</li>
										<li><a class="close"><i class="fa fa-close"></i></a>
										</li>
									</ul>
									<div class="clearfix"></div>
								</div>
								<div class="x_content clothes_history">
									<!-- Clothes history here -->
								</div>
							</div>
						</div>

						<div class="col-md-12 col-sm-12 col-xs-12">
							<div class="x_panel">
								<div class="x_title">
									<h2><i class="fa fa-comments"></i> Comments</h2>
									<ul class="nav navbar-right panel_toolbox">
										<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
										</li>
										<li class="dropdown">
											<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
											<ul class="dropdown-menu" role="menu">
												<li><a href="#">Settings 1</a>
												</li>
												<li><a href="#">Settings 2</a>
												</li>
											</ul>
										</li>
										<li><a class="close"><i class="fa fa-close"></i></a>
										</li>
									</ul>
									<div class="clearfix"></div>
								</div>
								<div class="x_content clothes_comments">
									<!-- Clothes detail here -->
									On progress
								</div>
							</div>
						</div>

					</div>
				</div>
				<!-- footer content -->
				<?php include "footer.php"; ?>
				<!-- /footer content -->

			</div>
			<!-- /page content -->
		</div>

	</div>

	<div id="custom_notifications" class="custom-notifications dsp_none">
		<ul class="list-unstyled notifications clearfix" data-tabbed_notifications="notif-group">
		</ul>
		<div class="clearfix"></div>
		<div id="notif-group" class="tabbed_notifications"></div>
	</div>

	<?php include "script.php"; ?>
	<script>
	$(document).ready(function () {
		getClothesDetail( <?php echo $id; ?> );
		getMatches( <?php echo $id; ?> );
		getLayers( <?php echo $id; ?> );
	});
	</script>
</body>

</html>