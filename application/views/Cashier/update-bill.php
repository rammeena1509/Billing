<!DOCTYPE HTML>
<html>
<head>
<title>Bill Management Software</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- Bootstrap Core CSS -->
<link href="<?= base_url('assets/css/bootstrap.css') ?>" relz='stylesheet' type='text/css' />
<!-- Custom CSS -->
<link href="<?= base_url('assets/css/style.css') ?>" rel='stylesheet' type='text/css' />
<!-- font CSS -->
<!-- font-awesome icons -->
<link href="<?= base_url('assets/css/font-awesome.css') ?>" rel="stylesheet">
<link href="<?= base_url('assets/css/modal.css') ?>" rel="stylesheet">
<!-- //font-awesome icons -->
 <!-- js-->
<script src="<?= base_url('assets/js/jquery-1.11.1.min.js') ?>"></script>
<script src="<?= base_url('assets/js/modernizr.custom.js') ?>"></script>
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
				        <li><a href="<?= base_url('cashier') ?>">Dashboard</a></li>
				        <li><a href="<?= base_url('cashier/viewbill') ?>">Bill</a></li>
				        <li class="active">Update</li>
				    </ol>
				</div>
                <h3 class="title1">Update Bill</h3>
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
                    <?php if(isset($data)){ ?>
				        <div class="row">
                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                             Bill Id:   
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                             <input type="text" class="form-control" value="<?= $data[0][0]->order_id ?>" id="order_id" readonly/>   
                            </div>
                            
                        </div>
                        
                        <div class="row">
                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                             Customer Id:   
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                             <input type="text" class="form-control" value="<?= $data[0][0]->customer_id ?>" readonly/>   
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                                <a href="<?= base_url('cashier/viewcustomer/'.$data[0][0]->customer_id) ?>"><button type="button" class="btn btn-success update" value="order_id">View</button> </a> 
                            </div>
                        </div>
                    
                        <div class="row">
                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                             Total Price:   
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                             <input type="text" class="form-control" id="total_price" value="<?= $data[0][0]->total_price ?>" readonly/>   
                            </div>
                         </div>
                        
                        <div class="row">
                            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                             Order Date:   
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                             <input type="text" class="form-control" value="<?= $data[0][0]->order_date ?>" readonly/>   
                            </div>
                            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                             Order Time:   
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                             <input type="text" class="form-control" value="<?= $data[0][0]->order_time ?>" readonly/>   
                            </div>
                            
                         </div>
                    
                    <?php if($data[0][0]->coupon){ ?>
                        <div class="row">
                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                             Coupon:   
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                             <input type="text" class="form-control" value="<?= $data[0][0]->coupon ?>" readonly/>   
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                                <a href="<?= base_url('cashier/viewcoupon/'.$data[0][0]->coupon) ?>"><button type="button" class="btn btn-success update" >View</button> </a> 
                            </div>
                         </div>
                    <?php } ?>
                    
                    <?php if($data[0][0]->discount){ ?>
                        <div class="row">
                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                             Discount:   
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                             <input type="text" class="form-control" id="order_discount"value="<?= $data[0][0]->discount ?>" readonly/>   
                            </div>
                         </div>
                    <?php } ?>
                    
                    <?php if($data[0][0]->discount){ ?>
                    <?php 
                        if($data[0][0]->discount_type==0){
                            $discount="Percentage";
                        }
                        else{
                            $discount="Flat Off";
                        }
                    ?>
                        <div class="row">
                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                             Discount Type:   
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                             <input type="text" class="form-control" value="<?= $discount ?>" readonly/>   
                            </div>
                         </div>
                    <?php } ?>
                      <?php if($data[0][0]->payment_mode){ ?>
                        <div class="row">
                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                             Payment Mode:   
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                             <input type="text" class="form-control" value="<?= $data[0][0]->payment_mode ?>" readonly/>   
                            </div>
                         </div>
                    <?php } ?>
                   <?php if(isset($data[1])){ ?>
                   <?php if(count($data[1])){ ?>
                    <div class="bs-example widget-shadow" data-example-id="contextual-table"> 
						<table class="table"> 
                            <thead> 
                                <tr> 
                                    <th>S.No.</th>
                                    <th>Product Id</th>
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
                                    <td><?= $row->product_id.$row->batch_id ?></td>
                                    <td><?= $row->product_name ?></td>
                                    <td><?= $row->product_price ?></td>
                                    <td><?= $row->quantity ?></td>
                                    <td><?= $row->quantity*$row->product_price ?></td>
                                    <td><button class="btn btn-success  update-bill" value="<?= $row->product_id ?>" id="<?= $row->batch_id ?>">Update</button></td>
                                </tr>
                                <?php
                                        $i++;
                                    }
                                ?>
                            </tbody> 
                    </table> 
                </div>
                    <?php } ?>
                    <?php } ?>
                    <?php }else{ ?>
                    <form action="" method="post">
                        <div class="row">
                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                             Bill ID:   
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                <input class="form-control" name="bill" id="bill">
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                                <button class="btn btn-primary" name="submit" type="submit" value="submit">View</button> 
                            </div>
                        </div>
                    </form>
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
    <div id="myModal" class="modal">

      <!-- Modal content -->
      <div class="modal-content">
        <div class="modal-header">
            <center><h3>Product Detail</h3></center>
        </div>
        <div class="modal-body">
          <div class="row">
                    <div class="col-lg-8 col-lg-offset-2">
                        <div class="row">
                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                             Product Name:   
                            </div>
                            <div class="col-lg-8 col-md-6 col-sm-6 col-xs-6">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-info fa" aria-hidden="true"></i></span>
                                        <input type="text" class="form-control" id="product_name" readonly/>
                                    </div>   
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                             Product Price:   
                            </div>
                            <div class="col-lg-8 col-md-6 col-sm-6 col-xs-6">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-money fa" aria-hidden="true"></i></span>
                                        <input type="text" class="form-control" id="product_price" readonly/>
                                    </div>   
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                             Product Quantity:   
                            </div>
                            <div class="col-lg-8 col-md-6 col-sm-6 col-xs-6">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-info fa" aria-hidden="true"></i></span>
                                        <input type="text" class="form-control" id="product_quantity"/>
                                    </div>   
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                             Total:   
                            </div>
                            <div class="col-lg-8 col-md-6 col-sm-6 col-xs-6">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-money fa" aria-hidden="true"></i></span>
                                        <input type="text" class="form-control" id="sub_total" readonly/>
                                    </div>   
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 col-lg-offset-3">
                                <button type="button" class="btn btn-success" id="quantity-update">Update Quantity</button>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                                <button id="remove-product" class="btn btn-danger">Remove Item From Bill</button>
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
    <script>
    var link="<?= base_url() ?>";
    var order = <?php echo json_encode($data[1]); ?>;
    </script>
</body>
</html>