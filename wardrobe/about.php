<!DOCTYPE html>
<html lang="en">
<head>
	<?php include "meta-css.php"; ?>
	<title>About | Wardrobe </title>
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
							<h3><i class="fa fa-question-circle"></i> About</h3>
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
									<h2><i class="fa fa-bullhorn"></i> Greetings</h2>
									<ul class="nav navbar-right panel_toolbox">
										<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
										<li><a class="close-link"><i class="fa fa-close"></i></a></li>
									</ul>
									<div class="clearfix"></div>
									<div class="x_content">
										</br>
										<div class="bs-example" data-example-id="simple-jumbotron">
		                                    <div class="jumbotron">
		                                        <h1>Welcome to Wardrobe!</h1>
		                                        <p>A clothes management application</p>
		                                    </div>
		                                </div>
		                                Made with Bootstrap Gentellella Adella! PHP CSS JS Bootstrap
		                                Social Link
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