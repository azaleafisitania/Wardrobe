<?php
if(!isset($_SESSION['db_mode'])) {
    $_SESSION['db_mode'] = "MySQL";
    error_log('[Wardrobe] '.__FILE__.' line '.__LINE__.' : "database mode not defined. MySQL by default"');
}
?>
			
			<!-- sidebar -->
			<div class="col-md-3 left_col">
				<div class="left_col scroll-view">

					<div class="navbar nav_title" style="border: 0;">
						<a href="index.php" class="site_title"><i class="fa fa-asterisk"></i> <span>Wardrobe</span></a>
					</div>
					<div class="clearfix"></div>

					<!-- menu prile quick info -->
					<div class="profile">
						<div class="profile_pic">
							<img src=<?php echo "images/".$_SESSION['profpic'] ?> alt="..." class="img-circle profile_img">
						</div>
						<div class="profile_info">
							<span>Welcome,</span>
							<h2><?php echo $_SESSION['name'] ?></h2>
                            <br />
						</div>
					</div>
					<!-- /menu prile quick info -->

					<br />

					<!-- sidebar menu -->
					<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">

						<div class="menu_section">
							<h3>Menu</h3>
							<ul class="nav side-menu">
								<li><a href="index.php"><i class="fa fa-home"></i> Home</a>
								</li>
                                <li><a href="add-clothes.php"><i class="fa fa-plus"></i> Add Clothes</a>
                                </li>
								<li><a><i class="fa fa-tag"></i> View Clothes <span class="fa fa-chevron-down"></span></a>
									<ul class="nav child_menu clothes-categories" style="display: none">
                                        <!-- list all clothes categories using javascript -->
									</ul>
								</li>
								<li><a href="create-outfit.php"><i class="fa fa-sitemap"></i> Create Outfit</a></li>
								<li><a href="generate-outfit.php"><i class="fa fa-gears"></i> Generate Outfit</a></li>
                                <li><a><i class="fa fa-tags"></i> View Outfits <span class="fa fa-chevron-down"></span></a>
									<ul class="nav child_menu" style="display: none">
										<li><a href="outfits.php">All</a>
										</li>
										<!-- list all clothes categories (!) -->
									</ul>
								</li>
								<li><a><i class="fa fa-book"></i> Clothes Dictionary <span class="fa fa-chevron-down"></span></a>
									<ul class="nav child_menu" style="display: none">
										<li><a href="dictionary.php">All</a>
										</li>
										<!-- list all clothes categories (!) -->
									</ul>
								</li>
							</ul>
						</div>

					</div>
					<!-- /sidebar menu -->
				</div>
			</div>
			<!-- /sidebar -->

			<!-- top navigation -->
			<div class="top_nav">

                <div class="nav_menu">
                    <nav class="" role="navigation">
                        <div class="nav toggle">
                            <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                        </div>

                        <ul class="nav navbar-nav navbar-right">
                            <li class="">
                                <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                    <img src=<?php echo "images/".$_SESSION['profpic'] ?> alt=""><?php echo $_SESSION['name'] ?>
                                    <span class=" fa fa-angle-down"></span>
                                </a>
                                <ul class="dropdown-menu dropdown-usermenu animated fadeInDown pull-right">
                                    <li><a href="profile.php"> Profile</a></li>
                                    <li><a href="api/logout.php"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                                </ul>
                            </li>

                            <li role="presentation" class="dropdown">
                                <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
                                    <i class="fa fa-envelope-o"></i>
                                    <span class="badge bg-green">6</span>
                                </a>
                                <ul id="menu1" class="dropdown-menu list-unstyled msg_list animated fadeInDown" role="menu">
                                    <li>
                                        <a>
                                            <span class="image">
                                        <img src="images/img.jpg" alt="Profile Image" />
                                    </span>
                                            <span>
                                        <span>John Smith</span>
                                            <span class="time">3 mins ago</span>
                                            </span>
                                            <span class="message">
                                        Film festivals used to be do-or-die moments for movie makers. They were where... 
                                    </span>
                                        </a>
                                    </li>
                                    <li>
                                        <div class="text-center">
                                            <a>
                                                <strong>See All Alerts</strong>
                                                <i class="fa fa-angle-right"></i>
                                            </a>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                            <li role="presentation">
                                <a href="javascript:;" aria-expanded="false">
                                    <div id="neo4j" <?php if($_SESSION['db_mode']=="MySQL") echo 'style="display:none"'; ?>><i onclick="toMySQL()" class="fa fa-toggle-on" data-toggle="tooltip" data-placement="bottom" title="Neo4j"></i></div>
                                    <div id="mysql" <?php if($_SESSION['db_mode']=="Neo4j") echo 'style="display:none"'; ?>><i onclick="toNeo4j()" class="fa fa-toggle-off" data-toggle="tooltip" data-placement="bottom" title="MySQL"></i></div>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
            <!-- /top navigation -->

            <script>
            function toNeo4j() {
                setDBMode("Neo4j");
                document.getElementById("mysql").style="display:none";
                document.getElementById("neo4j").style="display:block";
            }
            function toMySQL() {
                setDBMode("MySQL");
                document.getElementById("neo4j").style="display:none";
                document.getElementById("mysql").style="display:block";
            }
            </script>