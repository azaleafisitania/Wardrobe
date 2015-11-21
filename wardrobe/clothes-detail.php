<?php
session_start(); // Session
if(!isset($_SESSION['username'])) {
    header("Location: login.php");
}
if(isset($_GET['id'])) {
	$id = $_GET['id'];
} else {
	header('Location: clothes.php');
} 
if(isset($_GET['success'])) $success = $_GET['success'];
else $success = 0;
?>


<!DOCTYPE html>
<html lang="en">
<head>
	<?php include "meta-css.php"; ?>
	<title>Clothes Item <?php echo $id; ?> | Wardrobe </title>
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
						<div class="title_left clothes_title">
							<!-- Title Here -->
						</div>

						<div class="title_right">
							<div class="col-md-5 col-sm-5 col-xs-5 form-group pull-right top_search">
								<div class="form-group">
									<div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
										<a class="btn btn-danger" href=<?php echo "api/delete-clothes.php?id=".$id; ?>><i class="fa fa-trash"></i> Delete Clothes</a>
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
									<div class="clearfix"></div>
								</div>
								<div class="x_content clothes_photo">
									<!-- Photo here -->
								</div>
								<div class="x_content">
									
									<form class="form-horizontal form-label-left input_mask" action=<?php echo "api/edit-clothes.php?id=".$id; ?> method="post" enctype="multipart/form-data">
										<h2 class="page-header">Basic Details</h2>
										<div class="form-group">
												<label class="control-label col-md-3 col-sm-3 col-xs-12">Photo</label>
												<div class="col-md-9 col-sm-9 col-xs-12">
													<input type="file" name="file" id="file" accept="application/jpg">
												</div>
											</div>
										<div class="form-group">
											<label class="control-label col-md-3 col-sm-3 col-xs-12">Fav</label>
											<div class="col-md-9 col-sm-9 col-xs-12 clothes_fav">
												<!-- Fav here -->
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-md-3 col-sm-3 col-xs-12">Category</label>
											<div class="col-md-9 col-sm-9 col-xs-12 clothes_category">
												<!-- Category here -->
											</div>
										</div>
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
										<div class="form-group">
											<label class="control-label col-md-3 col-sm-3 col-xs-12">Owner</label>
											<div class="col-md-9 col-sm-9 col-xs-12 clothes_owner">
												<!-- Owner here -->
											</div>
										</div>
										<h2 class="page-header">Spesific Details</h2>
										<div class="ln_solid"></div>
										<div class="form-group">
											<div class="col-md-12 col-sm-12 col-xs-12">
												<a class="btn btn-default" href=<?php echo "clothes-detail.php?id=".$id; ?>><i class="fa fa-remove"></i> Reset</a>
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
									<div class="clearfix"></div>
								</div>

								<div class="x_content" id="matches">
									<div class="form-group pull-right">
										<div class="col-md-12 col-sm-12 col-xs-12">
											<a class="btn btn-primary" onclick="editMatches()"><i class="fa fa-pencil-square-o"></i> Edit Matches</a>
										</div>
									</div>
									<div class="clothes_gallery">
										<!-- Clothes here -->
									</div>
								</div>
								<div class="x_content" id="done" style="display:none">
									<div class="form-group pull-right">
										<div class="col-md-12 col-sm-12 col-xs-12">
											<a class="btn btn-success" onclick="doneMatches()"><i class="fa fa-check"></i> Done</a>
										</div>
									</div>
									<div class="clothes_gallery">
										<!-- Clothes to match here -->
									</div>
								</div>
							</div>
						</div>

						<div class="col-md-8 col-sm-8 col-xs-12">
							<div class="x_panel">
								<div class="x_title">
									<h2><i class="fa fa-history"></i> History</h2>
									<div class="clearfix"></div>
								</div>
								<div class="x_content clothes_history">
									<!-- Clothes history here -->
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
	// On ready function
	$(document).ready(function () {
		getClothesDetail( <?php echo '"'.$id.'"'; ?> );
		getCategory();
		getMatches( <?php echo '"'.$id.'"'; ?> );
	});
	// Show-hide button done matches
	function doneMatches() {
		document.getElementById("matches").style="display:block";
		document.getElementById("done").style="display:none";
		location.reload();
	}
	// Show-hide button edit matches
	function editMatches() {
		document.getElementById("matches").style="display:none";
		document.getElementById("done").style="display:block";
		getClothesToMatch( <?php echo '"'.$id.'"'; ?> );
	}

	// Notification
	if(<?php echo $success ?>) {
		new PNotify({
			title: 'Wonderful!',
			text: 'You have successfully add this clothes',
			type: 'success'
		});
	}
	</script>
</body>

</html>