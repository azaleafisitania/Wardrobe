<?php
// Preparations
session_start(); // Session
if(!isset($_SESSION['username'])) header("Location: login.php");
if(!isset($_GET['id']))	header('Location: outfits.php');
else $id = $_GET['id'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<?php include "meta-css.php"; ?>
	<title>Outfits No <?php echo $id; ?> | Wardrobe </title>
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
							<!-- clothes_title here -->
						</div>

						<div class="title_right">
							<div class="col-md-5 col-sm-5 col-xs-5 form-group pull-right top_search">
								<div class="form-group">
									<div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
										<a class="btn btn-danger" href=<?php echo "api/delete-outfit.php?id=".$id; ?>><i class="fa fa-trash"></i> Delete Outfit</a>
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
									<h2><i class="fa fa-tag"></i> Clothes Content</h2>
									<div class="clearfix"></div>
								</div>
								<div class="x_content" id="content">
									<div class="form-group pull-right">
										<div class="col-md-12 col-sm-12 col-xs-12">
											<a class="btn btn-primary" onclick="editContent()"><i class="fa fa-pencil-square-o"></i> Edit Content</a>
										</div>
									</div>
									<div class="clearfix"></div>
									<div class="clothes_content">
										<!-- Clothes here -->
									</div>
								</div>
								<div class="x_content" id="done" style="display:none">
									<form class="form-horizontal form-label-left input_mask" action=<?php echo "api/edit-outfit.php?id=".$id; ?> method="post" enctype="multipart/form-data">
										<div class="form-group pull-right">
											<div class="col-md-12 col-sm-12 col-xs-12">
												<a class="btn btn-success" onclick="doneEdit()"><i class="fa fa-check"></i> Done</a>
											</div>
										</div>
										<div class="clearfix"></div>
										<div class="clothes_gallery">
											<!-- Clothes edit here -->
										</div>
									</form>
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
	limit = 10;
	$(document).ready(function () {
		getOutfitDetail( <?php echo $id; ?> );
	});

		// Show-hide button cancel
	function doneEdit(){
		document.getElementById("content").style="display:block";
		document.getElementById("done").style="display:none";
		location.reload();
	}

	// Show-hide button edit matches
	function editContent(){
		document.getElementById("content").style="display:none";
		document.getElementById("done").style="display:block";
		getCategory();
		getClothesToEditOutfit(<?php echo $id; ?>,start,limit);	
	}

	// Load next batches when hit bottom, endless scroll
	$(window).scroll(function() {
		if($(window).scrollTop() == $(document).height() - $(window).height()) {
			document.getElementById("ajax_load").style="display:block";
			setTimeout(function(){
				start = start+limit;
				getClothesToEditOutfit(<?php echo $id; ?>,start,limit);
				document.getElementById("ajax_load").style="display:none";
			},100);
		}
	});
	</script>
</body>

</html>