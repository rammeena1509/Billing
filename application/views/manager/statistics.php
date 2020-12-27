<!DOCTYPE HTML>
<html>
<head>
<title>Bill Management Software</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- Bootstrap Core CSS -->
<link href="<?= base_url('assets/css/bootstrap.css') ?>" rel='stylesheet' type='text/css' />
<!-- Custom CSS -->
<link href="<?= base_url('assets/css/style.css') ?>" rel='stylesheet' type='text/css' />
<!-- font CSS -->
<!-- font-awesome icons -->
<link href="<?= base_url('assets/css/font-awesome.css') ?>" rel="stylesheet"> 
<!-- //font-awesome icons -->
 <!-- js-->
<script src="<?= base_url('assets/js/jquery-1.11.1.min.js') ?>"></script>
<script src="<?= base_url('assets/js/modernizr.custom.js') ?>"></script>
<script>
var link="<?= base_url() ?>";
</script>
<!--webfonts-->
<link href='//fonts.googleapis.com/css?family=Roboto+Condensed:400,300,300italic,400italic,700,700italic' rel='stylesheet' type='text/css'>
<!--//webfonts--> 
<!--animate-->
<link href="<?= base_url('assets/css/animate.css') ?>" rel="stylesheet" type="text/css" media="all">
<script src="<?= base_url('assets/js/wow.min.js') ?>"></script>
	<script>
		 new WOW().init();
	</script>
<!--//end-animate-->
<!-- chart -->
<script src="<?= base_url('assets/js/Chart.js') ?>"></script>
<script src="<?= base_url('assets/js/easyNotify.js') ?>"></script>
<script src="<?= base_url('assets/js/notification.js') ?>"></script>
<!-- //chart -->
<!--Calender-->
<link rel="stylesheet" href="<?= base_url('assets/css/clndr.css') ?>" type="text/css" />
<script src="<?= base_url('assets/js/underscore-min.js') ?>" type="text/javascript"></script>
<script src= "<?= base_url('assets/js/moment-2.2.1.js') ?>" type="text/javascript"></script>
<script src="<?= base_url('assets/js/clndr.js') ?>" type="text/javascript"></script>
<script src="<?= base_url('assets/js/site.js') ?>" type="text/javascript"></script>
<!--End Calender-->
<!-- Metis Menu -->
<script src="<?= base_url('assets/js/metisMenu.min.js') ?>"></script>
<script src="<?= base_url('assets/js/custom.js') ?>"></script>
<link href="<?= base_url('assets/css/custom.css') ?>" rel="stylesheet">
<!--//Metis Menu -->
</head> 
<body class="cbp-spmenu-push">
<audio id="soundFX">
<source src="<?= base_url('assets/notification.mp3') ?>" type="audio/mpeg">
</audio>
	<div class="main-content">
		<!--left-fixed -navigation-->
		<?php include('navigation.php') ?>
		<!--left-fixed -navigation-->
		<?php include('header.php') ?>
		<!-- main content start-->
		<div id="page-wrapper">
			<div class="main-page">
                <div class="but_list">
				    <ol class="breadcrumb">
				        <li><a href="<?= base_url('manager') ?>">Dashboard</a></li>
				        <li class="active">Statistics</li>
				    </ol>
				</div>
                <div class="blank-page widget-shadow scroll" id="style-2 div1" style="min-height:400px;">
					<div class="row">
                        <div class="col-md-5">
                            <label>From</label>
                            <input class="form-control" type="date" id="start-date"/>
                        </div>
                        <div class="col-md-5">
                            <label>To</label>
                            <input class="form-control" type="date" id="end-date"/>
                        </div>
                        <div class="col-md-2"><br/>
                            <button class="btn btn-info" id="get-stats">Get Stats</button>
                        </div>
                    </div>
                    <div class="container-fluid" id="stats-div" style="display:none;">
                        <br/>
                        <div class="row-one">
                            <div class="col-md-4 widget states-last">
                                <div class="stats-left">
                                    <h5>Bill</h5>
                                    <h4>Generated</h4>
                                </div>
                                <div class="stats-right">
                                    <label id="bill-generated">0</label>
                                </div>
                                <div class="clearfix"> </div>	
                            </div>
                            <div class="col-md-4 widget states-mdl">
                                <div class="stats-left">
                                    <h5>Bill</h5>
                                    <h4>Amount</h4>
                                </div>
                                <div class="stats-right">
                                    <label id="bill-amount">0</label>
                                </div>
                                <div class="clearfix"> </div>	
                            </div>
                            <div class="col-md-4 widget">
                                <div class="stats-left">
                                    <h5>Discount</h5>
                                    <h4>Given</h4>
                                </div>
                                <div class="stats-right">
                                    <label id="discount-given">0</label>
                                </div>
                                <div class="clearfix"> </div>	
                            </div>
                            <div class="clearfix"> </div>	
                    </div>
                        <br/>
                    <div class="row-one">
                        <div class="col-md-4 widget">
                            <div class="stats-left ">
                                <h5>Tax</h5>
                                <h4>Received</h4>
                            </div>
                            <div class="stats-right">
                                <label id="tax-received">0</label>
                            </div>
                            <div class="clearfix"> </div>	
                        </div>
                        <div class="col-md-4 widget states-mdl">
                            <div class="stats-left">
                                <h5>Total</h5>
                                <h4>Income</h4>
                            </div>
                            <div class="stats-right">
                                <label id="total-income">0</label>
                            </div>
                            <div class="clearfix"> </div>	
                        </div>
                        <div class="col-md-4 widget states-last">
                            <div class="stats-left">
                                <h5>Quantity</h5>
                                <h4>Sell</h4>
                            </div>
                            <div class="stats-right">
                                <label id="quantity-sell">0</label>
                            </div>
                            <div class="clearfix"> </div>	
                        </div>
                        <div class="clearfix"> </div>	
                    </div><br/>
                    <div class="row-one">
                            <div class="col-md-4 widget states-last">
                                <div class="stats-left">
                                    <h5>Distinct</h5>
                                    <h4>Products</h4>
                                </div>
                                <div class="stats-right">
                                    <label id="distinct-product">0</label>
                                </div>
                                <div class="clearfix"> </div>	
                            </div>
                            <div class="col-md-4 widget states-mdl">
                                <div class="stats-left">
                                    <h5>Distinct</h5>
                                    <h4>User</h4>
                                </div>
                                <div class="stats-right">
                                    <label id="distinct-user">0</label>
                                </div>
                                <div class="clearfix"> </div>	
                            </div>
                            <div class="col-md-4 widget">
                                <div class="stats-left">
                                    <h5>Distict</h5>
                                    <h4>Cashier</h4>
                                </div>
                                <div class="stats-right">
                                    <label id="distinct-cashier">0</label>
                                </div>
                                <div class="clearfix"> </div>	
                            </div>
                            <div class="clearfix"> </div>	
                    </div>
                </div>
				</div>
                <div class="charts" id="chart-div" style="display:none;">
<!--
					<div class="col-md-4 charts-grids widget">
						<h4 class="title">Bar Charts</h4>
						<canvas id="bar" height="300" width="400"> </canvas>
					</div>
					<div class="col-md-4 charts-grids widget states-mdl">
						<h4 class="title">Line Charts</h4>
						<canvas id="line" height="300" width="400"> </canvas>
					</div>
-->
					<div class="col-md-4 col-md-offset-4 charts-grids widget">
						<h4 class="title">Product Sell</h4>
						<canvas id="pie" height="300" width="400"> </canvas>
					</div>
					<div class="clearfix"> </div>
							 
							
				</div>
				<div class="row calender widget-shadow" style="display:none;">
					<h4 class="title">Calender</h4>
					<div class="cal1">
						
					</div>
				</div>
				<div class="clearfix"> </div>
			</div>
		</div>
		<!--footer-->
		<!--footer-->
        <?php include('footer.php') ?>
        <!--//footer-->
        <!--//footer-->
	</div>
	<!-- Classie -->
		<script src="<?= base_url('assets/js/classie.js') ?>"></script>
		<script>
			var menuLeft = document.getElementById( 'cbp-spmenu-s1' ),
				showLeftPush = document.getElementById( 'showLeftPush' ),
				body = document.body;
				
			showLeftPush.onclick = function() {
				classie.toggle( this, 'active' );
				classie.toggle( body, 'cbp-spmenu-push-toright' );
				classie.toggle( menuLeft, 'cbp-spmenu-open' );
				disableOther( 'showLeftPush' );
			};
			

			function disableOther( button ) {
				if( button !== 'showLeftPush' ) {
					classie.toggle( showLeftPush, 'disabled' );
				}
			}
		</script>
	<!--scrolling js-->
	<script src="<?= base_url('assets/js/jquery.nicescroll.js') ?>"></script>
	<script src="<?= base_url('assets/js/scripts.js') ?>"></script>
	<script src="<?= base_url('assets/js/functions.js') ?>"></script>
	<!--//scrolling js-->
	<!-- Bootstrap Core JavaScript -->
   <script src="<?= base_url('assets/js/bootstrap.js') ?>"> </script>
</body>
</html>