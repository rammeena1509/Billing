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
<link href="<?= base_url('assets/css/modal.css') ?>" rel="stylesheet">
<!--//Metis Menu -->
</head> 
<body class="cbp-spmenu-push">
<audio id="soundFX">
<source src="<?= base_url('assets/notification.mp3') ?>" type="audio/mpeg">
</audio>
	<div class="main-content">
		<!--left-fixed -navigation-->
		<?php include('navigation.php') ?>
		<!--left-fixed -navigation-->zz
		<?php include('header.php') ?>
		<!-- main content start-->
		<div id="page-wrapper">
			<div class="main-page">
                <div class="but_list">
				    <ol class="breadcrumb">
				        <li><a href="<?= base_url('cashier') ?>">Dashboard</a></li>
				        <li class="active">Bill</li>
				    </ol>
				</div>
                <h3 class="title1">Generate Bill</h3>
				<div class="blank-page widget-shadow scroll" id="style-2 div1">
					<?php if($feedback=$this->session->flashdata("feedback_message")): ?>
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
                    <div class="row">
                        <div class="col-lg-6 col-lg-offset-2">
                            <input type="text" class="form-control" id="add-product">
                        </div>
                        <div class="col-lg-3">
                            <button class="btn btn-success" id="add-button">Add Product</button>
                        </div>
                    </div>
                    <div class="bs-example widget-shadow" data-example-id="bordered-table"> 
						<table class="table table-bordered"> 
                            <thead> 
                                <tr> 
                                    <th>S.No.</th> 
                                    <th>Product Id</th> 
                                    <th>Product Name</th> 
                                    <th>Unit Price</th> 
                                    <th>Quantity</th> 
                                    <th>Total</th> 
                                    <th>Discount</th> 
                                    <th>&nbsp;</th> 
                                </tr> 
                            </thead> 
                            <tbody id="product-info">
                            </tbody> 
                        </table>
					</div>
                    <div class="row">
                        <div class="col-lg-3 col-lg-offset-5">
                            <button class="btn btn-success btn-md" disabled="disabled" id="proceed" type="button">Proceed</button>
                        </div>
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
    <div id="myModal" class="modal">

      <!-- Modal content -->
      <div class="modal-content">
        <div class="modal-header">
            <center><h3>Bill Detail</h3></center>
        </div>
        <div class="modal-body">
          <div class="row">
                    <div class="col-lg-4">
                     	<div class="row">
                            <div class="col-md-12">
                                <ul id="myTabs" class="nav nav-tabs" role="tablist"> 
                                    <li role="presentation" class="">
                                        <a href="#home" id="home-tab" role="tab" data-toggle="tab" aria-controls="home" aria-expanded="false">Registered</a>
                                    </li> 
                                    <li role="presentation" class="active">
                                        <a href="#profile" role="tab" id="profile-tab" data-toggle="tab" aria-controls="profile" aria-expanded="true">New</a>
                                    </li> 
                                </ul>
						      <div id="myTabContent" class="tab-content scrollbar1">
                                  <div role="tabpanel" class="tab-pane fade" id="home" aria-labelledby="home-tab"> 
                                      <div class="row">
                                          <div class="col-md-12">
                                                <input type="text" class="form-control1" id="cmobile" name="cmobile" placeholder="Customer Mobile Number"/>
                                          </div>
                                      </div>
                                      <div class="row">
                                          <b id="message"></b>
                                      </div>
                                      <div class="row">
                                          <div class="col-md-4">
                                            <button class="btn btn-success" id="verify-number">Get Info</button>
                                          </div>
                                      </div>
                                  </div> 
                                  <div role="tabpanel" class="tab-pane fade active in" id="profile" aria-labelledby="profile-tab"> 
                                       <div class="row">
                                          <div class="col-md-12">
                                                <input type="text" class="form-control1" id="c-name" name="c-name" placeholder="Customer Name"/>
                                          </div>
                                      </div>
                                      <div class="row">
                                          <div class="col-md-12">
                                                <input type="text" class="form-control1" id="c-mobile" name="c-mobile" placeholder="Customer Mobile Number"/>
                                          </div>
                                      </div>
                                      <div class="row">
                                          <div class="col-md-12">
                                                <input type="text" class="form-control1" id="c-mail" name="c-mail" placeholder="Customer E-Mail Id"/>
                                          </div>
                                      </div>
                                      <div class="row">
                                          <b id="reg-msg"></b>
                                      </div>
                                      <div class="row">
                                          <div class="col-md-4">
                                            <button class="btn btn-success" id="customer-register">Register</button>
                                          </div>
                                      </div>
                                  </div> 
                                </div>
					       </div>
                        </div>
					</div>
                    <div class="col-lg-8">
                        <div class="bs-example widget-shadow" data-example-id="bordered-table"> 
                            <table class="table table-bordered"> 
                                <thead> 
                                    <tr> 
                                        <th>S.No.</th> 
                                        <th>Product Id</th> 
                                        <th>Product Name</th> 
                                        <th>Unit Price</th> 
                                        <th>Quantity</th> 
                                        <th>Total</th> 
                                        <th>Discount</th> 
                                    </tr> 
                                </thead> 
                                <tbody id="bill-info">
                                </tbody> 
                            </table>
                        </div>
                        <div class="row">
                            <div class=" col-lg-offset-6 col-lg-6">
                                <table class="table table-bordered"> 
                                    <tbody id="discount-table">
                                        <tr>
                                            <th>Sub Total:</th>
                                            <td id="stotal"></td>
                                        </tr>
                                        <tr>
                                            <th>Discount:</th>
                                            <td id="bdiscount"></td>
                                        </tr>
                                    </tbody> 
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
        <div class="modal-footer">
                <div class="progress">
                    <div class="progress-bar progress-bar-success myprogress" role="progressbar" style="width:0%;font-size:10px;"><sup id="pp">0%</sup></div>
                </div>
                <div id="msg"></div>
            <center><button id="generate-bill" class="btn btn-info" disabled="disabled">Generate Bill</button></center>
        </div>
      </div>

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