<?php
session_start(); // Session
if(!isset($_SESSION['username'])) {
    header("Location: login.php");
} else {
    $username = $_SESSION['username'];  
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include "meta-css.php"; ?>
    <title>Generate Outfit | Wardrobe </title>
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
                            <h3><i class="fa fa-gears"></i> Generate Outfit</h3>
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
                                    <h2><i class="fa fa-wrench"></i> Options</h2>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">
                                    <form class="form-horizontal form-label-left input_mask" action="api/generate-outfit.php" method="post" enctype="multipart/form-data">
                                        <h2 class="page-header">General</h2>
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Quantity</label>
                                            <div class="col-md-9 col-sm-9 col-xs-12">
                                                <input type="text" name="quantity" class="form-control" placeholder="Enter number">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 col-sm-3 col-xs-12 control-label">Categories
                                            </label>
                                            <div class="col-md-9 col-sm-9 col-xs-12 category_options">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 col-sm-3 col-xs-12 control-label">Occasion</label>
                                            <div class="col-md-9 col-sm-9 col-xs-12 occasion_options">
                                                <div class="checkbox">
                                                    <input class="flat" type="checkbox" id="formal" name="occasion[]" value="formal" unchecked> Formal
                                                </div>
                                                <div class="checkbox">
                                                    <input class="flat" type="checkbox" id="casual" name="occasion[]" value="casual" checked> Casual
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 col-sm-3 col-xs-12 control-label">Wheather</label>
                                            <div class="col-md-9 col-sm-9 col-xs-12 wheather_options">
                                                <div class="checkbox">
                                                    <input class="flat" type="checkbox" id="sunny" name="wheather[]" value="sunny" checked> Sunny
                                                </div>
                                                <div class="checkbox">
                                                    <input class="flat" type="checkbox" id="rainy" name="wheather[]" value="rainy" checked> Rainy
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Outfit Score</label>
                                            <div class="grid_slider">
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <input type="text" id="range" value="" name="range" />
                                                </div>
                                            </div>
                                        </div>
                                        <h2 class="page-header">Advanced</h2>
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Rule</label>
                                            <div class="col-md-9 col-sm-9 col-xs-12">
                                                <div class="checkbox">
                                                	<input type="checkbox" class="checkbox" id="rule_1" name="rule[]" value="1" checked /> Checked
                                                </div>
                                            </div>
                                        </div>
                                        <div class="ln_solid"></div>
                                        <div class="form-group">
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <a class="btn btn-default" href="generate-outfit.php"><i class="fa fa-remove"></i> Reset</a>
                                                <button type="submit" class="btn btn-success"><i class="fa fa-check"></i> Generate!</button>
                                            </div>
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
    $(document).ready(function () {
        getCategoryOption();
    });
    $("#range").ionRangeSlider({
                hide_min_max: true,
                keyboard: true,
                min: 0,
                max: 100,
                from: 60,
                to: 80,
                type: 'double',
                step: 1,
                prefix: "",
                grid: true
            });
    </script>

</body>

</html>