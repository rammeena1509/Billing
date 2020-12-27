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
				        <li><a href="<?= base_url('manager/bills') ?>">Bills</a></li>
				        <li class="active">Detail</li>
				    </ol>
				</div>
                <h3 class="title1">Detail Bill</h3>
				<div class="blank-page widget-shadow scroll" id="style-2 div1">
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
                    <?php if($data){ ?>
				        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="name" class="cols-sm-2 control-label">Bill Id</label>
                                    <div class="cols-sm-10">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-info fa" aria-hidden="true"></i></span>
                                            <input type="text" class="form-control" value="<?= $data[0][0]->order_id ?>" readonly/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="name" class="cols-sm-2 control-label">Customer Id</label>
                                    <div class="cols-sm-10">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                                            <input type="text" class="form-control" value="<?= $data[0][0]->customer_id ?>"readonly/>
                                        </div>
                                    </div>
<!--
                                    <div class="cols-sm-2">
                                        <a href="<?= base_url('cashier/viewcustomer/'.$data[0][0]->customer_id) ?>"><button class="btn btn-success"></button></a>
                                    </div>
-->
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="email" class="cols-sm-2 control-label">Order Amount</label>
                                    <div class="cols-sm-10">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-money fa" aria-hidden="true"></i></span>
                                            <input type="text" class="form-control" value="<?= $data[0][0]->total_price ?>"readonly/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="email" class="cols-sm-2 control-label">Payment Mode</label>
                                    <div class="cols-sm-10">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-info fa" aria-hidden="true"></i></span>
                                            <input type="text" class="form-control" value="<?= $data[0][0]->payment_mode ?>"readonly/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="email" class="cols-sm-2 control-label">Billing Date</label>
                                    <div class="cols-sm-10">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-info fa" aria-hidden="true"></i></span>
                                            <input type="text" class="form-control" value="<?= $data[0][0]->order_date ?>"readonly/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="email" class="cols-sm-2 control-label">Billing Time</label>
                                    <div class="cols-sm-10">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-info fa" aria-hidden="true"></i></span>
                                            <input type="text" class="form-control" value="<?= $data[0][0]->order_time ?>"readonly/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php if($data[0][0]->discount){ ?>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="email" class="cols-sm-2 control-label">Discount</label>
                                    <div class="cols-sm-10">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-money fa" aria-hidden="true"></i></span>
                                            <input type="text" class="form-control" value="<?= $data[0][0]->discount ?>"readonly/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="email" class="cols-sm-2 control-label">Discount Type</label>
                                    <div class="cols-sm-10">
                                        <div class="input-group">
                                            <?php 
                                            if($data[0][0]->discount_type==0){
                                                $discount="Percentage";
                                            }
                                            else{
                                                $discount="Flat Off";
                                            }
                                            ?>
                                            <span class="input-group-addon"><i class="fa fa-money fa" aria-hidden="true"></i></span>
                                            <input type="text" class="form-control" value="<?= $discount ?>"readonly/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                        
                        <div class="row">
                            <?php if($data[0][0]->coupon) {?>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="email" class="cols-sm-2 control-label">Coupon</label>
                                    <div class="cols-sm-10">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-money fa" aria-hidden="true"></i></span>
                                            <input type="text" class="form-control" value="<?= $data[0][0]->coupon ?>"readonly/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php } ?>
                        </div>
                        <?php if(count($data[1])){ ?>
                        <div class="bs-example widget-shadow" data-example-id="contextual-table"> 
                            <table class="table"> 
                                <thead> 
                                    <tr> 
                                        <th>S.No.</th>
                                        <th>Product Name</th> 
                                        <th>Unit Price</th> 
                                        <th>Quantity</th> 
                                        <th>Total</th> 
                                    </tr> 
                                </thead> 
                                <tbody id="orderdata">
                                    <?php 
                                        $i=1;
                                        foreach($data[1] as $row) {
                                            if($i%2==0){
                                                $cls="danger";
                                            }
                                            else{
                                                $cls="success";
                                            }
                                    ?>   
                                    <tr class="<?= $cls ?>">
                                        <td><?= $i ?></td>
                                        <td><?= $row->product_name ?></td>
                                        <td><?= $row->product_price ?></td>
                                        <td><?= $row->quantity ?></td>
                                        <td><?= $row->quantity*$row->product_price ?></td>
                                    </tr>
                                    <?php
                                            $i++;
                                        }
                                    ?>
                                </tbody> 
                        </table> 
                    </div>
                    <?php } ?>
                        <div class="row">
                            <div class="col-lg-3">
                                <a href="<?= $data[0][0]->invoice ?>" target="_blank"><button class="btn btn-success">View Bill</button></a>
                            </div>
                            
                        </div>
                        <?php } ?>
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