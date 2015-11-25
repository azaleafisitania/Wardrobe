<?php
// Session
session_start();
if (session_status() == PHP_SESSION_NONE) session_start();
if(!isset($_SESSION['username'])) header("Location: login.php");
if(!isset($_SESSION['img_mode'])) $_SESSION['img_mode'] = "URL";

// Parameters
if(!isset($_GET['category'])) $category = "";
else $category = $_GET['category'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include "meta-css.php"; ?>
    <title>Clothes | Wardrobe </title>
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
                            <!-- Clothes title here -->
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
                                <div class="x_content clothes_gallery">
                                    <!-- Clothes gallery here -->
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
    $(document).ready(function () {
    	getCategory("<?php echo $category; ?>");
        getClothes("<?php echo $category; ?>","<?php echo $_SESSION['img_mode']; ?>");
    });
    </script>
</body>

</html>