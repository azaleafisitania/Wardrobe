<!DOCTYPE html>
<html lang="en">
<head>
	<?php include "meta-css.php"; ?>
	<title>Outfits | Wardrobe </title>
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
									<ul class="nav navbar-right panel_toolbox">
										<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
										<li><a class="close"><i class="fa fa-close"></i></a></li>
									</ul>
									<div class="clearfix"></div>
								</div>
								<div class="x_content">
									<div class="clothes_gallery">
										<!-- Clothes gallery here -->
									</div>
								</div>
								<div id="ajax_load" style="display:none">
									<center><img src="images/ajax-loader.gif" /></center>
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
	// Load first batch of data
	start = 0; 
	limit = 5;
	$(document).ready(function () {
		getOutfits(start,limit);
	});

	// Load next batches when hit bottom, endless scroll
	$(window).scroll(function() {
		if($(window).scrollTop() == $(document).height() - $(window).height()) {
			document.getElementById("ajax_load").style="display:block";
			setTimeout(function(){
				start = start+limit;
				getOutfits(start,limit);
				document.getElementById("ajax_load").style="display:none";
			},100);
		}
	});
	</script>
</body>

</html>