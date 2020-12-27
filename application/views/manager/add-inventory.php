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
				        <li class="active">Inventory</li>
				    </ol>
				</div>
                <h3 class="title1">Add Inventory</h3>
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
				<form method="post" action="" id="product-form">
                        <div class="row">
                            <div class="col-lg-3"><button type="button"class="btn btn-success" id="batch">Add Batch</button> </div>
                        </div>
						<div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="name" class="cols-sm-2 control-label">Product Id</label>
                                    <div class="cols-sm-10">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-info fa" aria-hidden="true"></i></span>
                                            <input type="text" class="form-control" name="pid" id="pid"  placeholder="Product Id" required/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="name" class="cols-sm-2 control-label">Product Name</label>
                                    <div class="cols-sm-10">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-info fa" aria-hidden="true"></i></span>
                                            <input type="text" class="form-control" name="pname" id="pname"  placeholder="Product Name" required/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="email" class="cols-sm-2 control-label">Product Category</label>
                                    <div class="cols-sm-10">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-info fa" aria-hidden="true"></i></span>
                                            <input type="text" class="form-control" name="category" id="category" placeholder="Product Category" required/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="email" class="cols-sm-2 control-label">Product Sub-Category</label>
                                    <div class="cols-sm-10">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-info fa" aria-hidden="true"></i></span>
                                            <input type="text" class="form-control" name="subcat" id="subcat" placeholder="Product Sub-Category" required/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="email" class="cols-sm-2 control-label">Product Price</label>
                                    <div class="cols-sm-10">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-money fa" aria-hidden="true"></i></span>
                                            <input type="text" class="form-control" name="price" id="price"  placeholder="Product Price" required/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="email" class="cols-sm-2 control-label">Discount</label>
                                    <div class="cols-sm-10">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-money fa" aria-hidden="true"></i></span>
                                            <input type="text" class="form-control" name="discount" id="discount" placeholder="Discount On Product" required/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="email" class="cols-sm-2 control-label">Discount Type</label>
                                    <div class="cols-sm-10">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-money fa" aria-hidden="true"></i></span>
                                            <select type="text" class="form-control" name="dtype" id="dtype" required>
                                                <option value="0">Percentage</option>
                                                <option value="1">Flat Off</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="email" class="cols-sm-2 control-label">Max Discount</label>
                                    <div class="cols-sm-10">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-money fa" aria-hidden="true"></i></span>
                                            <input type="text" class="form-control" name="mdiscount" id="mdiscount" placeholder="Max Discount On Product" required/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="email" class="cols-sm-2 control-label">Product Discription</label>
                                    <div class="cols-sm-10">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-info fa" aria-hidden="true"></i></span>
                                            <input type="text" class="form-control" name="discription" id="discription" placeholder="Product Discription" required/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group ">
                            <button type="submit" id="button" name="submit" value="product" class="btn btn-primary btn-lg btn-block login-button">Add</button>
                        </div>
					</form>
                    <form method="post" action="" id="batch-form" style="display:none;">
                        <div class="row">
                            <div class="col-lg-3"><button type="button"class="btn btn-success" id="product">Add Product</button> </div>
                        </div>
						<div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="name" class="cols-sm-2 control-label">Product Id</label>
                                    <div class="cols-sm-10">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-info fa" aria-hidden="true"></i></span>
                                            <select type="text" class="form-control" name="pid" id="pid"  placeholder="Product Id" required>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="name" class="cols-sm-2 control-label">Batch Id</label>
                                    <div class="cols-sm-10">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-info fa" aria-hidden="true"></i></span>
                                            <input type="text" class="form-control" name="bid" id="bid"  placeholder="Batch Id" required/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="email" class="cols-sm-2 control-label">Manufacturing Date</label>
                                    <div class="cols-sm-10">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-info fa" aria-hidden="true"></i></span>
                                            <input type="date" class="form-control" name="mdate" id="mdate" placeholder="Manufacturing Date" required/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="email" class="cols-sm-2 control-label">Expiry Date</label>
                                    <div class="cols-sm-10">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-info fa" aria-hidden="true"></i></span>
                                            <input type="date" class="form-control" name="edate" id="edate" placeholder="Expiry Date" required/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="email" class="cols-sm-2 control-label">Product Quantity</label>
                                    <div class="cols-sm-10">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-info fa" aria-hidden="true"></i></span>
                                            <input type="text" class="form-control" name="quantity" id="quantity"  placeholder="Product Quantity" required/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="email" class="cols-sm-2 control-label">Remark</label>
                                    <div class="cols-sm-10">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-info fa" aria-hidden="true"></i></span>
                                            <input type="text" class="form-control" name="remark" id="remark" placeholder="Batch Remark" required/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group ">
                            <button type="submit" id="button" name="submit" value="batch" class="btn btn-primary btn-lg btn-block login-button">Add</button>
                        </div>
					</form>
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