    <!-- Custom fonts for this template-->
    <link href="<?php echo base_url('assets/vendor/fontawesome-free/css/all.min.css') ?>" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?php echo base_url('assets/css/sb-admin-2.min.css') ?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/css/custom.css') ?>" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?php echo base_url('') ?>">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Cove</div>
			</a>
			
			<?php if($this->ion_auth->is_admin() || $this->ion_auth_model->in_group('managers')): ?>
            <!-- Divider -->
            <hr class="sidebar-divider my-0">

			<!-- Nav Item - Dashboard -->
			
            <li class="nav-item <?php if($this->uri->segment(1)=="" || $this->uri->segment(1)=="dashboard"){echo 'active';}?>">
                <a class="nav-link" href="<?php echo base_url('') ?>"><i class="fas fa-fw fa-tachometer-alt"></i><span>Dashboard</span></a>
            </li>
			<?php endif; ?>	


            <!-- Divider -->
			<hr class="sidebar-divider my-0">
			
			<!-- Nav Item - Dashboard -->
			
            <li class="nav-item <?php if($this->uri->segment(1).$this->uri->segment(2)=="tracking_sheet"){echo 'active';}?>">
				<a class="nav-link" href="<?php echo base_url('tracking_sheet') ?>"><i class="fas fa-fw fa-route"></i><span>Travel Tracking Sheets</span></a>
			</li>


			<?php if($this->ion_auth->is_admin() || $this->ion_auth_model->in_group('managers')): ?>
            <!-- Divider -->
			<hr class="sidebar-divider my-0">
			
			<!-- Nav Item - Dashboard -->
			
            <li class="nav-item <?php if($this->uri->segment(1).$this->uri->segment(2)=="tracking_sheetreport"){echo 'active';}?>">
				<a class="nav-link" href="<?php echo base_url('tracking_sheet/report') ?>"><i class="fas fa-fw fa-map-marked"></i><span>Travel Tracking Report</span></a>
			</li>
			<?php endif; ?>	
			
			<?php if($this->ion_auth->is_admin() || $this->ion_auth_model->in_group('managers')): ?>
            <!-- Divider -->
			<hr class="sidebar-divider my-0">
			
			<!-- Nav Item - Dashboard -->
			
            <li class="nav-item <?php if($this->uri->segment(1)=="logs"){echo 'active';}?>">
				<a class="nav-link" href="<?php echo base_url('logs') ?>"><i class="fas fa-fw fa-shuttle-van"></i><span>Van Logs</span></a>
			</li>
			<?php endif; ?>	
			
			<?php if($this->ion_auth->is_admin() || $this->ion_auth_model->in_group('managers')): ?>
            <!-- Divider -->
			<hr class="sidebar-divider my-0">
			
			<!-- Nav Item - Dashboard -->
			
            <li class="nav-item <?php if($this->uri->segment(1)=="inspections"){echo 'active';}?>">
				<a class="nav-link" href="<?php echo base_url('inspections') ?>"><i class="fas fa-fw fa-search"></i><span>Van Inspections</span></a>
			</li>
			<?php endif; ?>	

            <!-- Divider -->
			<hr class="sidebar-divider my-0">
			
            <!-- Nav Item - Dashboard -->
            <li class="nav-item <?php if($this->uri->segment(1)=="service_orders"){echo 'active';}?>">
				<a class="nav-link" href="<?php echo base_url('service_orders') ?>"><i class="fas fa-fw fa-clipboard-list"></i><span>Service Orders</span></a>
			</li>			
			
			<?php if($this->ion_auth->is_admin() || $this->ion_auth_model->in_group('members')): ?>

            <!-- Divider -->
			<hr class="sidebar-divider my-0">
			
            <!-- Nav Item - Dashboard -->
            <li class="nav-item <?php if($this->uri->segment(1)=="emergency_response"){echo 'active';}?>">
				<a class="nav-link" href="<?php echo base_url('emergency_response') ?>"><i class="fas fa-fw fa-ambulance"></i><span>Emergency Response Plan</span></a>
			</li>

            <!-- Divider -->
			<hr class="sidebar-divider my-0">
			
            <!-- Nav Item - Dashboard -->
            <li class="nav-item <?php if($this->uri->segment(1)=="facility_inspection"){echo 'active';}?>">
				<a class="nav-link" href="<?php echo base_url('facility_inspection') ?>"><i class="fas fa-fw fa-building"></i><span>Facility Inspection</span></a>
			</li>

			<?php endif; ?>

			<?php if ($this->ion_auth->is_admin()): ?>

            <!-- Divider -->
			<hr class="sidebar-divider my-0">
			
            <!-- Nav Item - Dashboard -->
            <li class="nav-item <?php if($this->uri->segment(1)=="users"){echo 'active';}?>">
				<a class="nav-link" href="<?php echo base_url('users') ?>"><i class="fas fa-fw fa-users"></i><span>Users</span></a>
            </li>	
			<?php endif; ?>				

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>	
		</ul>
	
        <!-- End of Sidebar -->    
       <!-- Content Wrapper -->
	   <div id="content-wrapper" class="d-flex flex-column">        


<!-- Main Content -->
<div id="content">

	<!-- Topbar -->
	<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

		<!-- Sidebar Toggle (Topbar) -->
		<button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
			<i class="fa fa-bars"></i>
		</button>

		<!-- Topbar Navbar -->
		<ul class="navbar-nav ml-auto">

			<!-- Nav Item - Search Dropdown (Visible Only XS) -->
			<li class="nav-item dropdown no-arrow d-sm-none">
				<a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
					data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					<i class="fas fa-search fa-fw"></i>
				</a>
				<!-- Dropdown - Messages -->
				<div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
					aria-labelledby="searchDropdown">
					<form class="form-inline mr-auto w-100 navbar-search">
						<div class="input-group">
							<input type="text" class="form-control bg-light border-0 small"
								placeholder="Search for..." aria-label="Search"
								aria-describedby="basic-addon2">
							<div class="input-group-append">
								<button class="btn btn-primary" type="button">
									<i class="fas fa-search fa-sm"></i>
								</button>
							</div>
						</div>
					</form>
				</div>
			</li>


			<div class="topbar-divider d-none d-sm-block"></div>

			<!-- Nav Item - User Information -->
			<li class="nav-item dropdown no-arrow">
				<a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
					data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					<span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $this->session->userdata('first_name') . ' ' . $this->session->userdata('last_name'); ?></span>
					<img class="img-profile rounded-circle" src="<?php echo base_url('assets/img/undraw_profile.svg') ?>">
				</a>
				<!-- Dropdown - User Information -->
				<div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
					aria-labelledby="userDropdown">
					<a class="dropdown-item" href="<?php echo base_url('auth/change_password') ?>">
						<i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
						Change Password
					</a>
					<div class="dropdown-divider"></div>
					<a class="dropdown-item" href="<?php echo base_url('settings') ?>">
						<i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
						Settings
					</a>
					<div class="dropdown-divider"></div>
					<a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
						<i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
						Logout
					</a>
				</div>
			</li>

		</ul>

	</nav>
	<!-- End of Topbar -->       