<!DOCTYPE HTML>
<html>
<head>
<title>Bill Management Software | Login Page :: Final Year Project</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="" />
<!-- Bootstrap Core CSS -->
<link href="<?= base_url('assets/css/bootstrap.css') ?>"  rel='stylesheet' type='text/css' />
<!-- Custom CSS -->
<link href="<?= base_url('assets/css/style.css') ?>"  rel='stylesheet' type='text/css' />
<!-- font CSS -->
<!-- font-awesome icons -->
<link href="<?= base_url('assets/css/font-awesome.css') ?>"  rel="stylesheet"> 
<!-- //font-awesome icons -->
 <!-- js-->
<script src="<?= base_url('assets/js/jquery-1.11.1.min.js' ) ?>"></script>
<link href='//fonts.googleapis.com/css?family=Roboto+Condensed:400,300,300italic,400italic,700,700italic' rel='stylesheet' type='text/css'>
<!--//webfonts--> 
<!--animate-->
<!--//Metis Menu -->
</head> 
<body>
	<div >
		<!-- main content start-->
		<div>
			<div class="main-page login-page ">
				<h3 class="title1">Manager Login</h3>
				<div class="widget-shadow">
					<div class="login-top">
						<h4>Welcome Back To Bill Management Software ! <br/>
                            <center><a href="<?= base_url('cashier') ?>">Switch to Cashier Login</a></center>
                        </h4>
					</div>
					<div class="login-body">
                        <?php if($feedback=$this->session->flashdata("feedback_message")): ?>
                            <div class="row">
                                <div class="col-lg-12">
                                    <?php $feedback_class=$this->session->flashdata("feedback_class"); ?>
                                    <div class="alert <?= $feedback_class ?>">
                                        <a href="#" class="close" data-dismiss="alert">&times;</a>
                                        <strong></strong><?= $feedback ?> 
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
						<form action="" method="post">
							<input type="text" name="email" value="" id="email" placeholder="Enter your email" class="user" required="required"  />
                            <input type="password" name="password" value="" id="password" placeholder="Enter Password" class="lock" required="required"  />
							<div class="forgot-grid">
								<label class="checkbox"><input type="checkbox" name="checkbox" checked=""><i></i>Remember me</label>
								<div class="forgot">
									<a href="#">forgot password?</a>
								</div>
								<div class="clearfix"> </div>
							</div>
							<input type="submit" name="SignIn" value="Sign In">
						</form>
					</div>
				</div>
				
				<!--<div class="login-page-bottom">
					<h5> - OR -</h5>
					<div class="social-btn"><a href="#"><i class="fa fa-facebook"></i><i>Sign In with Facebook</i></a></div>
					<div class="social-btn sb-two"><a href="#"><i class="fa fa-twitter"></i><i>Sign In with Twitter</i></a></div>
				</div>-->
			</div>
		</div>
		<!--footer-->
        <br/><br/><br/>
		<?php include('footer.php') ?>
        <!--//footer-->
	</div>
	<script src="<?= base_url('assets/js/scripts.js' ) ?>"></script>
	<!--//scrolling js-->
	<!-- Bootstrap Core JavaScript -->
   <script src="<?= base_url('assets/js/bootstrap.js' ) ?>"> </script>
</body>
</html>