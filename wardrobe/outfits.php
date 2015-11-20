<?php
// Preparations
session_start();
if(!isset($_SESSION['username'])) header("Location: login.php");
else $username = $_SESSION['username'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<?php include "meta-css.php"; ?>
	<title>Outfits | Wardrobe </title>
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
							<h3><i class="fa fa-folder-open"></i> Outfits</h3> 
						</div>

						<div class="title_right">
							<div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
								<div class="input-group">
									<input type="text" class="form-control" placeholder="Search for...">
									<span class="input-group-btn">
										<button class="btn btn-default" type="button">Go!</button>
									</span>
								</div>
							</div>
						</div>
					</div>
					<div class="clearfix"></div>

					<div class="row">

						<div class="col-md-12 col-sm-12 col-xs-12">
							<div class="x_panel">
								<div class="x_title">
									<h2><i class="fa fa-photo"></i> Gallery</h2>
									<div class="clearfix"></div>
								</div>
								<div class="x_content">
									<div class="clothes_gallery">
										<!-- Clothes gallery here -->
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

	<?php include "script.php"; ?>
	<script>
	$(document).ready(function () {
		getOutfits();
	});
	</script>
</body>

</html>