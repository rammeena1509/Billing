<div class=" sidebar" role="navigation">
            <div class="navbar-collapse">
				<nav class="cbp-spmenu cbp-spmenu-vertical cbp-spmenu-left" id="cbp-spmenu-s1">
					<ul class="nav" id="side-menu">
						<li>
							<a href="<?= base_url('cashier/') ?>" class="active"><i class="fa fa-home nav_icon"></i>Dashboard</a>
						</li>
                        <li>
							<a href="javascript::"><i class="fa fa-table  nav_icon"></i>Bills<span class="fa arrow"></span></a>
							<ul class="nav nav-second-level collapse">
								<li>
									<a href="<?= base_url('cashier/viewbill/') ?>">View Bills</a>
								</li>
								<li>
									<a href="<?= base_url('cashier/generatebill/') ?>">Generate Bill</a>
								</li>
                                <li>
									<a href="<?= base_url('cashier/updatebill/') ?>">Update Bill</a>
								</li>
							</ul>
							<!-- //nav-second-level -->
						</li>
						<li>
							<a href="javascript::"><i class="fa fa-user  nav_icon"></i>Customer<span class="fa arrow"></span></a>
							<ul class="nav nav-second-level collapse">
								<li>
									<a href="<?= base_url('cashier/viewcustomer/') ?>">View Customer</a>
								</li>
								<li>
									<a href="<?= base_url('cashier/addcustomer/') ?>">Add Customer</a>
								</li>
                            </ul>
							<!-- //nav-second-level -->
						</li>
                        
                        <li>
							<a href="<?= base_url('cashier/viewcoupon/') ?>"><i class="fa fa-info nav_icon"></i>Coupons</a>
							
						</li>
						
<!--
                        <li>
							<a href="<?= base_url('admin/statistics/') ?>" class="chart-nav"><i class="fa fa-bar-chart nav_icon"></i>Statistics<span class="nav-badge-btm pull-right">new</span></a>
						</li>
-->
					</ul>
					<!-- //sidebar-collapse -->
				</nav>
			</div>
		</div>