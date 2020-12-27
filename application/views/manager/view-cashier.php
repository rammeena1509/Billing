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
				        <li class="active">Cashier</li>
				    </ol>
				</div>
                <div class="blank-page widget-shadow scroll" id="style-2 div1">
                    <h3 class="title1">View Cashier</h3>
					<?php if($feedback=$this->session->flashdata("feedback")): ?>
                        <div class="row">
                            <div class="col-lg-6 col-lg-offset-2">
                                <?php $feedback_class=$this->session->flashdata("feedback_class"); ?>
                                <div class="alert alert-dismissable <?php echo $feedback_class; ?>">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close" style="margin-right:5%;">×</a>
                                    <?= $feedback ?>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
				    <div class="elements  row">
                        <?php if(isset($data)){ ?>
                        <?php $i=1; ?>
                        <?php foreach($data as $row) {?>
                        <?php if($i%3==2){ ?>
                        <div class="col-md-4 profile widget-shadow chat-mdl-grid">
                        <?php }else{ ?>
                        <div class="col-md-4 profile widget-shadow">
                        <?php } ?>
                            <div class="profile-top">
                                <img src="<?= base_url('assets/images/'.$row->cashier_image) ?>" alt="">
                                <h4><?= $row->cashier_name ?></h4>
                                <h5><?= $row->cashier_id ?></h5>
                            </div>
                            <div class="profile-text">
                                <div class="profile-row">
                                    <div class="profile-left">
                                        <i class="fa fa-envelope profile-icon"></i>
                                    </div>
                                    <div class="profile-right">
                                        <h4><?= $row->cashier_email ?> </h4>
                                        <p>Email</p>
                                    </div> 
                                    <div class="clearfix"> </div>	
                                </div>
                                <div class="profile-row row-middle">
                                    <div class="profile-left">
                                        <i class="fa fa-mobile profile-icon"></i>
                                    </div>
                                    <div class="profile-right">
                                        <h4><?= $row->cashier_mobile ?></h4>
                                        <p>Mobile Number</p>
                                    </div> 
                                    <div class="clearfix"> </div>	
                                </div>
                                <div class="row">
                                    <center><a href="<?= base_url('manager/update_cashier/'.$row->cashier_id) ?>"><button class="btn btn-success">Update Detail</button></a></center>
                                </div>
                            </div>
                        </div>
                        <?php if($i%3==0){ ?>
                    </div>
                    <div class="elements  row">
                        <?php } ?>
                        <?php $i++; ?>
                        <?php } ?>
                        <?php } ?>
                    </div>
				</div>
				<div class="row calender widget-shadow" style="display:none;">
					<h4 class="title">Calender</h4>
					<div class="cal1" >
						
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
	<!--//scrolling js-->
	<!-- Bootstrap Core JavaScript -->
   <script src="<?= base_url('assets/js/bootstrap.js') ?>"> </script>
   <script src="<?= base_url('assets/js/functions.js') ?>"> </script>
</body>
</html>