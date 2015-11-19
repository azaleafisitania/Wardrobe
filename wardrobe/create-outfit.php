<?php
session_start();

// Check session user
if(!isset($_SESSION['username'])) {
    header("Location: login.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include "meta-css.php"; ?>
    <title>Create Outfit | Wardrobe </title>
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
                            <h3><i class="fa fa-magic"></i> Create Outfit</h3>
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
                                    <h2><i class="fa fa-thumb-tack"></i> Choose Clothes</h2>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">
                                    <form class="form-horizontal form-label-left input_mask" action="api/create-outfit.php" method="post" enctype="multipart/form-data">
                                        <div class="form-group pull-right">
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <a class="btn btn-default" href="create-outfit.php"><i class="fa fa-remove"></i> Reset</a>
                                                <button type="submit" class="btn btn-success"><i class="fa fa-check"></i> Create Outfit</button>
                                            </div>
                                        </div>
                                        <div class="clearfix"></div>
                                        <div class="clothes_gallery">
                                            <!-- Clothes here -->
                                        </div>
                                        <div id="ajax_load" style="display:none">
                                            <center><img src="images/ajax-loader.gif" /></center>
                                        </div>
                                    </form>
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
    // Load first batch of data
    start = 0; 
    limit = 10;
    $(document).ready(function () {
        // Ajax loading gif
        $(document).ajaxStart(function () {
            $("#ajax_load").show();
        }).ajaxStop(function () {
            $("#ajax_load").hide();
        });
        getCategory();
        getClothesForOutfit(start,limit);
    });
    // Load next batches when hit bottom, endless scroll
    $(window).scroll(function() {
        if($(window).scrollTop() == $(document).height() - $(window).height()) {
            start = start+limit;
            getClothesForOutfit(start,limit);
        }
    });
    </script>
</body>

</html>