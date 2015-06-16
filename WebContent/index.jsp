<!DOCTYPE html>
<html>

	<head>
		<meta charset="UTF-8">
		<title>Wardrobe</title>
		<%@include file="meta-and-css.jsp" %>
	</head>
	
	<body class="skin-white sidebar-mini">
		<div class="wrapper">		
			<!-- Header -->
			<%@include file="header.jsp" %>

			<!-- Left side column. contains the logo and sidebar -->
			<%@include file="main-sidebar.jsp" %>

			<!-- Content Wrapper. Contains page content -->
			<div class="content-wrapper">
				<!-- Content Header (Page header) -->
				<section class="content-header">
					<h1>
						Home
						<small>Wardrobe</small>
					</h1>
					<ol class="breadcrumb">
						<li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
					</ol>
				</section>

				<!-- Main content -->
				<section class="content">
					<!-- Summary boxes -->
					<div class="row">

						<!-- Left col (Items) -->
						<section class="col-lg-6 connectedSortable">
							<!-- Custom tabs (Charts with tabs)-->
							<div class="nav-tabs-custom">
								<!-- Tabs within a box -->
								<ul class="nav nav-tabs pull-right">
									<li class="active"><a href="#revenue-chart" data-toggle="tab">This Week</a></li>
									<li><a href="#sales-chart" data-toggle="tab">This Month</a></li>
								  <li class="pull-left header"><i class="fa fa-inbox"></i> Scheduled Outfit</li>
								</ul>
								<div class="tab-content no-padding">
									<div class="chart tab-pane active" id="revenue-chart" style="position: relative; height: 300px;"></div>
									<div class="chart tab-pane" id="sales-chart" style="position: relative; height: 300px;"></div>
								</div>
							</div><!-- /.nav-tabs-custom -->
							<!-- Carousel -->
							<div class="box box-primary">
								<div class="box-header with-border">
									<i class="fa fa-picture-o"></i>
									<h3 class="box-title">Sneak Peek</h3>
								</div><!-- /.box-header -->
								<div class="box-body">
									<div id="carousel-example-generic1" class="carousel slide" data-ride="carousel">
										<?php  
											$query = "select * from top as t1 join 
											(select ceil(rand() * (select max(id) from top)) as id)
											as t2
											where t1.id >= t2.id
											order by t1.id asc limit 5";
											$result = mysql_query($query,$db);
											$total = mysql_num_rows($result);
										?>
										<ol class="carousel-indicators">
											<?php
												for($i=0; $i<$total; $i++) {
													if($i==0) echo '<li data-target="#carousel-example-generic1" data-slide-to="'.$i.'" class="active"></li>';
													else echo '<li data-target="#carousel-example-generic1" data-slide-to="'.$i.'" class=""></li>';		
												}
											?>
										</ol>
										<div class="carousel-inner">
											<?php
												$i=0;
												while($row = mysql_fetch_array($result)){
													if($i==0) echo '<div class="item active">';
													else echo '<div class="item">';
													echo '<img style="border-radius: 2px;" src="'.$row["photo"].'" alt="'.$row["id"].'">';
													echo '<div class="carousel-caption"><strong>'.$row["brand"].'</strong> '.$row["type"].'</div>';
													echo '</div>';
													$i++;
												}
											?>
										</div>
										<a class="left carousel-control" href="#carousel-example-generic1" data-slide="prev">
											<span class="fa fa-angle-left"></span>
										</a>
											<a class="right carousel-control" href="#carousel-example-generic1" data-slide="next">
											<span class="fa fa-angle-right"></span>
										</a>
									</div>
								</div><!-- /.box-body -->
							</div><!-- /.box -->
						</section>
							
						<!-- Right col (Outfits) -->
						<section class="col-lg-6 connectedSortable">
							<!-- Total Items -->
							<div class="info-box">
								<span class="info-box-icon bg-aqua"><i class="fa fa-tag"></i></span>
								<div class="info-box-content">
									<span class="info-box-text">Total Items</span>
									<?php 
										$query_total_items = "select * from top";
										$result_total_items = mysql_query($query_total_items,$db);
										$total_items = mysql_num_rows($result_total_items);
										echo '<span class="info-box-number">'.$total_items.'</span>';
									?>
									<a href="items.php">See all <i class="fa fa-arrow-circle-right"></i></a>
								</div><!-- /.info-box-content -->
							</div><!-- /.info-box -->
							<!-- Total Outfits -->
							<div class="info-box">
								<span class="info-box-icon bg-maroon"><i class="fa fa-tags"></i></span>
								<div class="info-box-content">
									<span class="info-box-text">Total Outfits</span>
									<?php 
										$query_total_items = "select * from top";
										$result_total_items = mysql_query($query_total_items,$db);
										$total_items = mysql_num_rows($result_total_items);
										echo '<span class="info-box-number">'.$total_items.'</span>';
									?>
									<a href="outfits.php">See all <i class="fa fa-arrow-circle-right"></i></a>
								</div><!-- /.info-box-content -->
							</div><!-- /.info-box -->
						</section>

					</div><!-- /.row -->
					<!-- END SUMMARY -->
					
					<!-- Main row -->
					<div class="row">
						<!-- Left col -->
						<section class="col-lg-6 connectedSortable">
							<!-- TO DO List -->
							<div class="box box-primary">
								<div class="box-header">
									<i class="ion ion-clipboard"></i>
									<h3 class="box-title">To Do List</h3>
									<div class="box-tools pull-right">
										<ul class="pagination pagination-sm inline">
											<li><a href="#">&laquo;</a></li>
											<li><a href="#">1</a></li>
											<li><a href="#">2</a></li>
											<li><a href="#">3</a></li>
											<li><a href="#">&raquo;</a></li>
										</ul>
									</div>
								</div><!-- /.box-header -->
								<div class="box-body">
									<ul class="todo-list">
										<li>
											<!-- drag handle -->
											<span class="handle">
												<i class="fa fa-ellipsis-v"></i>
												<i class="fa fa-ellipsis-v"></i>
											</span>
											<!-- checkbox -->
											<input type="checkbox" value="" name=""/>
											<!-- todo text -->
											<span class="text">Plan an outfit for a date</span>
											<!-- Emphasis label -->
											<small class="label label-danger"><i class="fa fa-clock-o"></i> 2 mins</small>
											<!-- General tools such as edit or delete-->
											<div class="tools">
												<i class="fa fa-edit"></i>
												<i class="fa fa-trash-o"></i>
											</div>
										</li>
										<li>
											<span class="handle">
												<i class="fa fa-ellipsis-v"></i>
												<i class="fa fa-ellipsis-v"></i>
											</span>
											<input type="checkbox" value="" name=""/>
											<span class="text">Plan an outfit for Final Presentation</span>
											<small class="label label-info"><i class="fa fa-clock-o"></i> 4 hours</small>
											<div class="tools">
												<i class="fa fa-edit"></i>
												<i class="fa fa-trash-o"></i>
											</div>
										</li>
										<li>
											<span class="handle">
												<i class="fa fa-ellipsis-v"></i>
												<i class="fa fa-ellipsis-v"></i>
											</span>
											<input type="checkbox" value="" name=""/>
											<span class="text">Insert new tops from Matahari Midnight Sale</span>
											<small class="label label-success"><i class="fa fa-clock-o"></i> 3 days</small>
											<div class="tools">
												<i class="fa fa-edit"></i>
												<i class="fa fa-trash-o"></i>
											</div>
										</li>
									</ul>
								</div><!-- /.box-body -->
								<div class="box-footer clearfix no-border">
									<button class="btn btn-default pull-right"><i class="fa fa-plus"></i> Add item</button>
								</div>
							</div><!-- /.box -->

						</section><!-- /.Left col -->

						<!-- right col (We are only adding the ID to make the widgets sortable)-->
						<section class="col-lg-6 connectedSortable">

							<!-- Calendar -->
							<div class="box box-solid bg-green-gradient">
								<div class="box-header">
									<i class="fa fa-calendar"></i>
									<h3 class="box-title">Calendar</h3>
									<!-- tools box -->
									<div class="pull-right box-tools">
										<!-- button with a dropdown -->
										<div class="btn-group">
											<button class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bars"></i></button>
											<ul class="dropdown-menu pull-right" role="menu">
												<li><a href="#">Add new event</a></li>
												<li><a href="#">Clear events</a></li>
												<li class="divider"></li>
												<li><a href="#">View calendar</a></li>
											</ul>
										</div>
										<button class="btn btn-success btn-sm" data-widget="collapse"><i class="fa fa-minus"></i></button>
										<button class="btn btn-success btn-sm" data-widget="remove"><i class="fa fa-times"></i></button>
									</div><!-- /. tools -->
								</div><!-- /.box-header -->
								<div class="box-body no-padding">
									<!--The calendar -->
									<div id="calendar" style="width: 100%"></div>
								</div><!-- /.box-body -->
								<div class="box-footer text-black">
									<div class="row">
										<div class="col-sm-6">
											<!-- Progress bars -->
											<div class="clearfix">
												<span class="pull-left">Task #1</span>
												<small class="pull-right">90%</small>
											</div>
											<div class="progress xs">
												<div class="progress-bar progress-bar-green" style="width: 90%;"></div>
											</div>

											<div class="clearfix">
												<span class="pull-left">Task #2</span>
												<small class="pull-right">70%</small>
											</div>
											<div class="progress xs">
												<div class="progress-bar progress-bar-green" style="width: 70%;"></div>
											</div>
										</div><!-- /.col -->
										<div class="col-sm-6">
											<div class="clearfix">
												<span class="pull-left">Task #3</span>
												<small class="pull-right">60%</small>
											</div>
											<div class="progress xs">
												<div class="progress-bar progress-bar-green" style="width: 60%;"></div>
											</div>

											<div class="clearfix">
												<span class="pull-left">Task #4</span>
												<small class="pull-right">40%</small>
											</div>
											<div class="progress xs">
												<div class="progress-bar progress-bar-green" style="width: 40%;"></div>
											</div>
										</div><!-- /.col -->
									</div><!-- /.row -->
								</div>
							</div><!-- /.box -->

						</section><!-- right col -->
					</div><!-- /.row (main row) -->

				</section><!-- /.content -->
			</div><!-- /.content-wrapper -->
			<!-- Main Footer -->
			<%@include file="footer.jsp" %>
			
			<!-- Control Sidebar -->      
			<%@include file="control-sidebar.jsp" %>

		</div><!-- ./wrapper -->

		<!-- Scripts Needed -->
		<%@include file="script-needed.jsp" %>
		
	</body>
</html>