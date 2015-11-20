<?php
session_start();

if(!isset($_SESSION['username'])) header("Location: login.php");
if(isset($_GET['category'])) $category = $_GET['category'];
else $category = "";
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<?php include "meta-css.php"; ?>
	<title>Add Clothes | Wardrobe </title>
</head>


<body class="nav-md">

	<div class="container body">


		<div class="main_container">

			<!-- navigation -->            
            <?php include "navigation.php"; ?>
            <!-- /navigation -->

			<!-- page content -->
			<div class="right_col" role="main">
				<div class="">
					<div class="page-title">
						<div class="title_left">
							<h3><i class="fa fa-plus"></i> Add Clothes</h3>
						</div>
						
						<div class="title_right">
							<div class="col-md-5 col-sm-5 col-xs-5 form-group pull-right top_search">
								<div class="form-group">
									<div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
										<a class="btn btn-primary" href="index.php"><i class="fa fa-home"></i> Back to Home</a>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="clearfix"></div>

					<div class="row">

						<div class="col-md-12 col-sm-12 col-xs-12">
							<div class="x_panel">
								<div class="x_title">
									<h2><i class="fa fa-info-circle"></i> Details</h2>
									<div class="clearfix"></div>
								</div>
								<div class="x_content">
									<div class="col-md-4 col-sm-4 col-xs-12">

										<form class="form-horizontal form-label-left input_mask" action="api/add-clothes.php" method="post" enctype="multipart/form-data">
											<h2 class="page-header">Basic Details</h2>
											<div class="form-group">
												<label class="control-label col-md-3 col-sm-3 col-xs-12">Photo</label>
												<div class="col-md-9 col-sm-9 col-xs-12">
													<input type="file" name="file" id="file" accept="application/jpg" required data-toggle="tooltip" data-placement="right" title="File name must not contain (')">
												</div>
											</div>
											<div class="form-group">
												<label class="control-label col-md-3 col-sm-3 col-xs-12">Fav</label>
												<div class="col-md-9 col-sm-9 col-xs-12">
													<input type="text" class="form-control" name="fav" placeholder="1/0" value="">
												</div>
											</div>
											<div class="form-group">
												<label class="control-label col-md-3 col-sm-3 col-xs-12">Category</label>
												<div class="col-md-9 col-sm-9 col-xs-12">
													<input type="text" class="form-control" name="category" placeholder="Add category" value=<?php echo "$category"?>>
												</div>
											</div>
											<div class="form-group">
												<label class="control-label col-md-3 col-sm-3 col-xs-12">Brand</label>
												<div class="col-md-9 col-sm-9 col-xs-12">
													<input type="text" class="form-control" name="brand" placeholder="Add brand" value="">
												</div>
											</div>
											<div class="form-group">
												<label class="control-label col-md-3 col-sm-3 col-xs-12">Color</label>
												<div class="col-md-9 col-sm-9 col-xs-12">
													<input type="text" class="form-control" name="color" placeholder="Add color(s)" value="">
												</div>
											</div>
											<div class="form-group">
												<label class="control-label col-md-3 col-sm-3 col-xs-12">Pattern</label>
												<div class="col-md-9 col-sm-9 col-xs-12">
													<input type="text" class="form-control" name="pattern" placeholder="Add pattern(s)" value="">
												</div>
											</div>
											<div class="form-group">
												<label class="control-label col-md-3 col-sm-3 col-xs-12">Retailer</label>
												<div class="col-md-9 col-sm-9 col-xs-12">
													<input type="text" class="form-control" name="retailer" placeholder="Add retailer" value="">
												</div>
											</div>
											<div class="form-group">
												<label class="control-label col-md-3 col-sm-3 col-xs-12">Price</label>
												<div class="col-md-9 col-sm-9 col-xs-12">
													<input type="text" class="form-control" name="price" placeholder="Add price" value="">
												</div>
											</div>
											<div class="form-group">
												<label class="control-label col-md-3 col-sm-3 col-xs-12">Occasion</label>
												<div class="col-md-9 col-sm-9 col-xs-12">
													<input type="text" class="form-control" name="occasion" placeholder="Add occasion(s)" value="">
												</div>
											</div>
											<div class="form-group">
												<label class="control-label col-md-3 col-sm-3 col-xs-12">Owner</label>
												<div class="col-md-9 col-sm-9 col-xs-12">
													<input type="text" class="form-control" name="owner" placeholder="Add owner" value=<?php echo $_SESSION['username'] ?> disabled>
												</div>
											</div>
											<h2 class="page-header">Spesific Details</h2>
											<div class="ln_solid"></div>
											<div class="form-group">
												<div class="col-md-12 col-sm-12 col-xs-12">
													<a class="btn btn-default" href="add-clothes.php?"><i class="fa fa-remove"></i> Reset</a>
													<button type="submit" class="btn btn-success"><i class="fa fa-check"></i> Submit Clothes</button>
												</div>
											</div>
										</form>
									</div>
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
</body>

</html>