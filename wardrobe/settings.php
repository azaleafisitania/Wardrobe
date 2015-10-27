<!DOCTYPE html>
<html lang="en">
<head>
	<?php include "meta-css.php"; ?>
	<title>Settings | Wardrobe </title>
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
							<h3><i class="fa fa-gear"></i> Settings</h3>
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
									<h2><i class="fa fa-database"></i> Database Settings</h2>
									<ul class="nav navbar-right panel_toolbox">
										<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
									</ul>
									<div class="clearfix"></div>
									<div class="x_content">
										<br />
									<form class="form-horizontal form-label-left">
										<div class="form-group">
											<label class="col-md-3 col-sm-3 col-xs-12 control-label">Checkboxes and radios
												<br>
												<small class="text-navy">Normal Bootstrap elements</small>
											</label>

											<div class="col-md-9 col-sm-9 col-xs-12">
												<div class="checkbox">
													<label>
														<input class="flat" type="checkbox" value=""> Option one. select more than one options
													</label>
												</div>
												<div class="radio">
													<label>
														<input class="flat" type="radio" checked="" value="option1" id="optionsRadios1" name="optionsRadios"> Option one. only select one option
													</label>
												</div>
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-3 col-sm-3 col-xs-12 control-label">Database Management System
												<br>
												<small class="text-navy">may have different performance</small>
											</label>
											<div class="col-md-9 col-sm-9 col-xs-12">
												<div class="radio">
													<label>
														<input class="flat" type="radio" id="db_mode" name="db_mode" checked="" value="mysql"> MySQL
													</label>
												</div>
												<div class="radio">
													<label>
														<input class="flat" type="radio" id="db_mode" name="db_mode" value="neo4j"> Neo4j
													</label>
												</div>
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
	<script>
	$(document).ready(function () {
		getQuotes();
	});
	</script>

</body>

</html>