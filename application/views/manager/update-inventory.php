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
				        <li><a href="<?= base_url('manager/viewinventory/') ?>">Inventory</a></li>
				        <li class="active">Update</li>
				    </ol>
				</div>
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
				<div id="product-form">
                        <div class="row">
                            <div class="col-lg-3"><button type="button"class="btn btn-success" id="batch">Update Batch</button> </div>
                            <div class="col-lg-3"><a href="<?= base_url('manager/viewinventory/') ?>"><button type="button"class="btn btn-primary">View Inventory</button></a> </div>
                        </div>
                        <?php if(isset($data)){ ?>
                            <?php if(isset($data->product_id)){ ?>
                                <div class="row">
                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                                     Product Id:   
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                     <input type="text" class="form-control" value="<?= $data->product_id ?>" readonly/>   
                                    </div>
                                </div>
                            <?php } ?>
                            <?php if(isset($data->product_name)){ ?>
                                <div class="row">
                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                                     Product Name:   
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                     <input type="text" class="form-control" value="<?= $data->product_name ?>" id="product_name"/>   
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                                        <button type="button" class="btn btn-success update-product" value="product_name">Update</button>  
                                    </div>
                                </div>
                            <?php } ?>
                             <?php if(isset($data->product_category)){ ?>
                                <div class="row">
                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                                     Product Category:   
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                     <input type="text" class="form-control" value="<?= $data->product_category ?>" id="product_category"/>   
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                                        <button type="button" class="btn btn-success update-product" value="product_category">Update</button>  
                                    </div>
                                </div>
                            <?php } ?>
                            <?php if(isset($data->product_subcat)){ ?>
                                <div class="row">
                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                                     Product Sub-Category:   
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                     <input type="text" class="form-control" value="<?= $data->product_subcat ?>" id="product_subcat"/>   
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                                        <button type="button" class="btn btn-success update-product" value="product_subcat">Update</button>  
                                    </div>
                                </div>
                            <?php } ?>
                            <?php if(isset($data->product_price)){ ?>
                                <div class="row">
                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                                     Product Price:   
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                     <input type="text" class="form-control" value="<?= $data->product_price ?>" id="product_price"/>   
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                                        <button type="button" class="btn btn-success update-product" value="product_price">Update</button>  
                                    </div>
                                </div>
                            <?php } ?>
                            <?php if(isset($data->product_discount)){ ?>
                                <div class="row">
                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                                     Product Discount:   
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                     <input type="text" class="form-control" value="<?= $data->product_discount ?>" id="product_discount"/>   
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                                        <button type="button" class="btn btn-success update-product" value="product_discount">Update</button>  
                                    </div>
                                </div>
                            <?php } ?>
                            <?php if(isset($data->discount_type)){ ?>
                                <div class="row">
                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                                     Discount Type:   
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                     <select class="form-control" id="discount_type">
                                        <option value="0">Percentage Off</option>
                                        <option value="1">Flat Off</option>
                                     </select> 
                                     <?php if(isset($data->discount_type)){ ?>
                                       <script> $('#discount_type').val(<?= $data->discount_type ?>);</script>
                                     <?php } ?>   
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                                        <button type="button" class="btn btn-success update-product" value="discount_type">Update</button>  
                                    </div>
                                </div>
                            <?php } ?>
                            <?php if(isset($data->max_discount)){ ?>
                                <div class="row">
                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                                     Maximum Discount:   
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                     <input type="text" class="form-control" value="<?= $data->max_discount ?>" id="max_discount"/>   
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                                        <button type="button" class="btn btn-success update-product" value="max_discount">Update</button>  
                                    </div>
                                </div>
                            <?php } ?>
                            <?php if(isset($data->product_discription)){ ?>
                                <div class="row">
                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                                     Product Discription:   
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                     <input type="text" class="form-control" value="<?= $data->product_discription ?>" id="product_discription"/>   
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                                        <button type="button" class="btn btn-success update-product" value="product_discription">Update</button>  
                                    </div>
                                </div>
                            <?php } ?>
                         <?php } ?>
					</div>
                    <div id="batch-form" style="display:none;">
                        <div class="row">
                            <div class="col-lg-3"><button type="button"class="btn btn-success" id="product">Update Product</button> </div>
                            <div class="col-lg-3"><a href="<?= base_url('manager/viewinventory/') ?>"><button type="button"class="btn btn-primary">View Inventory</button></a> </div>
                        </div>
                        <?php if(isset($data)){ ?>
                        <?php if(isset($data->product_id)){ ?>
                                <div class="row">
                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                                     Product Id:   
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                     <input type="text" class="form-control" value="<?= $data->product_id ?>" readonly/>   
                                    </div>
                                </div>
                        <?php } ?>
                        <?php if(count($batch)){ ?>
                                <div class="row">
                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                                     Batch Id:   
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                     <select type="text" class="form-control" id="update_batch">
                                         <option value="0">Choose Batch Id</option>
                                         <?php foreach($batch as $row) {?>
                                         <option><?= $row->batch_id ?></option>
                                         <?php } ?>
                                      </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                                     Manufacturing Date:   
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                     <input type="text" class="form-control" value="" id="manufacturing_date" readonly/>   
                                    </div>
                                 </div>
                                <div class="row">
                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                                     Expiry Date:   
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                     <input type="text" class="form-control" value="" id="expiry_date" readonly/>   
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                                     Remark:   
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                     <input type="text" class="form-control" value="" id="remark"/>   
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                                        <button type="button" class="btn btn-success update-batch" value="remark">Update</button>  
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                                     Quantity:   
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                     <input type="text" class="form-control" value="" id="product_quantity"/>   
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                                        <button type="button" class="btn btn-success update-batch" value="product_quantity">Update</button>  
                                    </div>
                                </div>
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
    <script>
        var product_id="<?= $data->product_id ?>";
    </script>
</body>
</html>