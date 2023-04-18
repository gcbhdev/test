<?php $this->view('components/header_start'); ?>


<?php $this->view('components/header_end'); ?>


	<!-- Begin Page Content -->
	<div class="container-fluid">

		<!-- Page Heading 
		<div class="d-sm-flex align-items-center justify-content-between mb-4">
			<h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
			<a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
					class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
		</div>-->

		<!-- Content Row -->
		<div class="row">

			<!-- Number of Van Logs -->
			<a href="<?php echo base_url('logs') ?>" class="col-xl-4 col-md-6 mb-4" style="text-decoration: none;">
				<div class="card border-left-primary shadow h-100 py-2">
					<div class="card-body">
						<div class="row no-gutters align-items-center">
							<div class="col mr-2">
								<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Van Logs</div>
								<div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo number_format ( $total_logs  ); ?></div>
							</div>
							<div class="col-auto">
								<i class="fas fa-shuttle-van fa-2x text-gray-300"></i>
							</div>
						</div>
					</div>
				</div>
			</a>

			<!-- Number of Pre-Trip Inspections -->
			<a href="<?php echo base_url('inspections') ?>" class="col-xl-4 col-md-6 mb-4" style="text-decoration: none;">
				<div class="card border-left-success shadow h-100 py-2">
					<div class="card-body">
						<div class="row no-gutters align-items-center">
							<div class="col mr-2">
								<div class="text-xs font-weight-bold text-success text-uppercase mb-1">Total Pre-Trip Inspection Logs</div>
								<div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo number_format ( $total_pre_inspections  ); ?></div>
							</div>
							<div class="col-auto">
								<i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
							</div>
						</div>
					</div>
				</div>
			</a>

			<!-- Number of Post-Trip Inspections -->
			<a href="<?php echo base_url('inspections') ?>" class="col-xl-4 col-md-6 mb-4" style="text-decoration: none;">
				<div class="card border-left-info shadow h-100 py-2">
					<div class="card-body">
						<div class="row no-gutters align-items-center">
							<div class="col mr-2">
								<div class="text-xs font-weight-bold text-info text-uppercase mb-1">Total Post-Trip Inspection Logs</div>
								<div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?php echo number_format ( $total_pre_inspections  ); ?></div>
							</div>
							<div class="col-auto">
								<i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
							</div>
						</div>
					</div>
				</div>
			</a>

			<!-- Number of Service Tickets -->
			<a href="<?php echo base_url('service_orders') ?>" class="col-xl-4 col-md-6 mb-4" style="text-decoration: none;">
				<div class="card border-left-warning shadow h-100 py-2">
					<div class="card-body">
						<div class="row no-gutters align-items-center">
							<div class="col mr-2">
								<div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Services Tickets</div>
								<div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo number_format ( $total_service_orders  ); ?></div>
							</div>
							<div class="col-auto">
								<i class="fas fa-comments fa-2x text-gray-300"></i>
							</div>
						</div>
					</div>
				</div>
			</a>

			<!-- Number of Emergency Response Plans -->
			<a href="<?php echo base_url('emergency_response') ?>" class="col-xl-4 col-md-6 mb-4" style="text-decoration: none;">
				<div class="card border-left-danger shadow h-100 py-2">
					<div class="card-body">
						<div class="row no-gutters align-items-center">
							<div class="col mr-2">
								<div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Emergency Response Plans</div>
								<div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo number_format ( $total_emergency_responses  ); ?></div>
							</div>
							<div class="col-auto">
								<i class="fas fa-ambulance fa-2x text-gray-300"></i>
							</div>
						</div>
					</div>
				</div>
			</a>

			<!-- Number of Facility Incpections -->
			<a href="<?php echo base_url('facility_inspection') ?>" class="col-xl-4 col-md-6 mb-4" style="text-decoration: none;">
				<div class="card border-left-dark shadow h-100 py-2">
					<div class="card-body">
						<div class="row no-gutters align-items-center">
							<div class="col mr-2">
								<div class="text-xs font-weight-bold text-dark text-uppercase mb-1">Facility Incpections</div>
								<div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo number_format ( $total_facility_inspections  ); ?></div>
							</div>
							<div class="col-auto">
								<i class="fas fa-building fa-2x text-gray-300"></i>
							</div>
						</div>
					</div>
				</div>
			</a>
		</div>
		<!-- Content Row -->

			
				
<?php $this->view('components/footer_start'); ?>


<?php $this->view('components/footer_end'); ?>