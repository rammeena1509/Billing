<div class=" sidebar" role="navigation">
            <div class="navbar-collapse">
				<nav class="cbp-spmenu cbp-spmenu-vertical cbp-spmenu-left" id="cbp-spmenu-s1">
					<ul class="nav" id="side-menu">
						<li>
							<a href="<?= base_url('manager/') ?>" class="active"><i class="fa fa-home nav_icon"></i>Dashboard</a>
						</li>
						<li>
							<a href="<?= base_url('manager/bills/') ?>"><i class="fa fa-table nav_icon"></i>Bills<span class="nav-badge-btm"></span></a>
							
						</li>
						<li>
							<a href="javascript::"><i class="fa fa-truck  nav_icon"></i>Inventory<span class="fa arrow"></span></a>
							<ul class="nav nav-second-level collapse">
								<li>
									<a href="<?= base_url('manager/viewinventory/') ?>">View Inventory</a>
								</li>
								<li>
									<a href="<?= base_url('manager/addinventory/') ?>">Add Inventory</a>
								</li>
<!--
                                <li>
									<a href="<?= base_url('manager/updateinventory/') ?>">Update Inventory</a>
								</li>
-->
							</ul>
							<!-- //nav-second-level -->
						</li>
                        <li>
							<a href="javascript::"><i class="fa fa-user  nav_icon"></i>Customer<span class="fa arrow"></span></a>
							<ul class="nav nav-second-level collapse">
								<li>
									<a href="<?= base_url('manager/viewcustomer/') ?>">View Customer</a>
								</li>
								<li>
									<a href="<?= base_url('manager/addcustomer/') ?>">Add Customer</a>
								</li>
<!--
                                <li>
									<a href="<?= base_url('manager/updatecustomer/') ?>">Update Customer</a>
								</li>
-->
							</ul>
							<!-- //nav-second-level -->
						</li>
                        <li>
							<a href="javascript::"><i class="fa fa-money  nav_icon"></i>Cashier<span class="fa arrow"></span></a>
							<ul class="nav nav-second-level collapse">
								<li>
									<a href="<?= base_url('manager/viewcashier/') ?>">View Cashier</a>
								</li>
								<li>
									<a href="<?= base_url('manager/addcashier/') ?>">Add Cashier</a>
								</li>
<!--
                                <li>
									<a href="<?= base_url('manager/updatecashier/') ?>">Update Cashier</a>
								</li>
-->
							</ul>
							<!-- //nav-second-level -->
						</li>
<!--
                        <li>
							<a href="<?= base_url('manager/updates/') ?>"><i class="fa fa-info nav_icon"></i>Updates</a>
							
						</li>
-->
						<li>
							<a href="javascript::"><i class="fa fa-file-text-o nav_icon"></i>Coupon<span class="fa arrow"></span></a>
							<ul class="nav nav-second-level collapse">
								<li>
									<a href="<?= base_url('manager/addcoupon/') ?>">Add Coupon</a>
								</li>
								<li>
									<a href="<?= base_url('manager/viewcoupon') ?>">View Coupon</a>
								</li>
							</ul>
							<!-- //nav-second-level -->
						</li>
                        <li>
							<a href="<?= base_url('manager/statistics/') ?>" class="chart-nav"><i class="fa fa-bar-chart nav_icon"></i>Statistics<span class="nav-badge-btm pull-right">new</span></a>
						</li>
					</ul>
					<!-- //sidebar-collapse -->
				</nav>
			</div>
		</div>