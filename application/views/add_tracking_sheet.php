<?php $this->view('components/header_start'); ?>

	<link href="<?php echo base_url('assets/vendor/datatables/dataTables.bootstrap4.min.css') ?>" rel="stylesheet">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap-datepicker@1.9.0/dist/css/bootstrap-datepicker.min.css" rel="stylesheet">
    <link href="<?php echo base_url('/assets/vendor/notifications/notification.css') ?>" rel="stylesheet">

<?php $this->view('components/header_end'); ?>


	<!-- Begin Page Content -->
	<div class="container-fluid">

		<!-- Page Heading -->
		<div class="row mb-4">
			<div class="col-6">
				<h1 class="h3 mb-0 text-gray-800">Travel Reimbursment Form</h1>
			</div>
			<div class="col-6">
				<a href="<?php echo base_url('tracking_sheet') ?>" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm float-right" ><i class="fas fa-xmark fa-sm text-white-50"></i> Save and Exit</a>
				<button class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm float-right mr-2" onclick="submit_for_approval();"><i class="fas fa-angle-double-right fa-sm text-white-50"></i> Submit for Approval</button>
			</div>
		</div>

		<!-- Content Row 
		<div class="mb-3 card">
			<div class="card-body">
				<div class="row">
					<div class="col-12">                  
						<select class="form-control" id="program_id" required>
							<option value="">Please choose a program</option>
							<?php
							for($i = 0; $i < count($programs); $i++)
							{
								echo '<option value="'.$programs[$i]["id"].'">'.$programs[$i]["description"].'</option>';
							}
							?>
						</select>
					</div>
				</div>
			</div>
		</div>-->

		<div class="mb-3 card">
			<div class="card-body">
				<div class="mb-3 row">
					<div class="col-4"><input class="form-control" type="text" id="travel_date" name="daterange" placeholder="Date"></div>
					<div class="col-4"><input class="form-control" type="text" id="origin" placeholder="Origin"></div>
					<div class="col-4"><input class="form-control" type="text" id="destination" placeholder="Destination"></div>
				</div>
				<div class="mb-3 row">
					<div class="col-4"><input class="form-control" type="text" id="purpose" placeholder="Purpose or Reason"></div>
					<div class="col-4">                  
						<select class="form-control" id="program_id" required>
							<option value="">Please choose a program</option>
							<?php
							for($i = 0; $i < count($programs); $i++)
							{
								echo '<option value="'.$programs[$i]["id"].'">'.$programs[$i]["description"].'</option>';
							}
							?>
						</select>
					</div>
					<div class="col-4"><input class="form-control" type="text" id="meals" placeholder="Meals"></div>
				</div>		
				<div class="mb-3 row">
					<div class="col-3"><input class="form-control" type="text" id="lodging" placeholder="Lodging"></div>
					<div class="col-3"><input class="form-control" type="text" id="mileage" placeholder="Personal Mileage"></div>
					<div class="col-3"><input class="form-control" type="text" id="other_trans_amount" placeholder="Other Trans Amount"></div>
					<div class="col-3"><input class="form-control" type="text" id="incidental_type" placeholder="Incidental Type"></div>
				</div>	
				<div class="row">
					<div class="col-12" id="add_modify_form_buttons">
						<button class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm float-right" onclick="clear_details();"><i class="fas fa-plus fa-sm text-white-50"></i> Clear</button>
						<button class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm float-right mr-2" onclick="submit_details();"><i class="fas fa-plus fa-sm text-white-50"></i> Add</button>
					</div>					
				</div>					
			</div>
		</div>		

		<div class="mb-3 card">
			<div class="card-body">
			<div class="table-responsive">
				<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
					<thead>
						<tr>
							<th>Date</th>
							<th>Origin</th>
							<th>Destination</th>
							<th>Purpose or Reason</th>
							<th>Program</th>
							<th>Meals</th>
							<th>Lodging</th>
							<th>Personal Mileage</th>
							<th>Other Trans Amount</th>
							<th>Incidental Types</th>
							<th style="width:80px;"></th>
						</tr>
					</thead>
					<tbody>

					</tbody>
				</table>
			</div>		
			</div>
		</div>	

		<div class="mb-3 card">
			<div class="card-body">
				<div class="row">
					<div class="col-3"><strong>Total Meals: <span id="total_meals">$0.00</span></strong></div>
					<div class="col-3"><strong>Total Lodging: <span id="total_lodging">$0.00</span></strong></div>
					<div class="col-3"><strong>Mileage: <span id="total_mileage">$0.00</span></strong></div>
					<div class="col-3"><strong>Other Trans: <span id="total_other">$0.00</span></strong></div>
				</div>
			</div>
		</div>		

		<div class="mb-3 card">
			<div class="card-body">
				<div class="row">
					<div class="col-12 text-center"><strong>Total: <span id="grand_total">$0.00</span></strong></div>
				</div>
			</div>
		</div>		

		<?php
			for($i = 0; $i < count($audit); $i++)
			{
				echo '<small>' . $audit[$i]['created_on'] . ' - ' . $audit[$i]['action'] . ' by ' . $audit[$i]['employee_name'] . ' - ' . $audit[$i]['comments'] . '</small><br>';                        
			}
			echo '<br>';
		?>
		<!-- Content Row -->

			
				
<?php $this->view('components/footer_start'); ?>

	<script src="<?php echo base_url('assets/vendor/datatables/jquery.dataTables.min.js') ?>"></script>
    <script src="<?php echo base_url('assets/vendor/datatables/dataTables.bootstrap4.min.js') ?>"></script>
	<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
	<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/bootstrap-datepicker@1.9.0/dist/js/bootstrap-datepicker.min.js"></script>
	<script src="<?php echo base_url('/assets/vendor/notifications/notify.min.js') ?>"></script>
	<script src="<?php echo base_url('/assets/vendor/notifications/notify-metro.js') ?>"></script>
	

    <script type="text/javascript">
			var GlobalVariables = {
				'csrfToken'               	: <?php echo json_encode($this->security->get_csrf_hash()); ?>,
				'baseurl'					: '<?php echo base_url(); ?>',
                'dataTable' 				: '',
                'tracking_sheet_id'         : <?php echo number_format ( $tracking_sheet_id  ); ?>
			};
			

		$(document).ready(function() {

            $('input[name="daterange"]').datepicker({

            });

			//if(GlobalVariables.program_id != null)
			//	$('#program_id').val(GlobalVariables.program_id);

            get_details();

			/*$(document).on('change', '#program_id', function(){
				if(GlobalVariables.tracking_sheet_id == 0){
					add_tracking_sheet();
				}

				var postUrl = '<?php echo base_url('/tracking_sheet/update_tracking_sheet') ?>';
				var postData = {
					'csrfToken': GlobalVariables.csrfToken,
					'tracking_sheet_id': GlobalVariables.tracking_sheet_id,
					'program_id': $('#program_id option:selected').val()
                };

				$.ajax({
					url: postUrl,
					type: 'POST',
					data: postData,
					datatype: 'json',
					success: function(response, textStatus, jqXHR) {
						//////////////////////////////////////////////////////
						console.log('Ajax Remove Card Response:', response);
						//////////////////////////////////////////////////////
                        
					},
				});	
			});		*/	
            
				
        });    

        function get_details(){

            if(GlobalVariables.dataTable != ''){
                GlobalVariables.dataTable.destroy();
            }

			GlobalVariables.dataTable = $('#dataTable').DataTable({		
                "bProcessing": true,
				 "serverSide": true,
				 "stateSave": true,
				 "responsive": true,
				 "searching": false,
				 "paging": false,
				 "ordering": false,
				 "info": false,
				 "language": {
				   "emptyTable": "You have no travel logs."
				 },
				 "ajax":{
					url : "<?php echo base_url('/tracking_sheet/get_details') ?>", // json datasource
					type: "post",  // type of method  ,GET/POST/DELETE
					data: {
                        'tracking_sheet_id': GlobalVariables.tracking_sheet_id
                    },
					complete: function () {
						get_totals();
						
					},
					error: function(){
					  $("#employee_grid_processing").css("display","none");
					}
				  }
            });
        }

		function submit_details() {
			if(GlobalVariables.tracking_sheet_id == 0){
                add_tracking_sheet();
            } else {
				add_details();
			}
		}

		function add_details(){

			if(isNotInTheFuture($('#travel_date').val())){

				//add confirm dialog here
				var postUrl = '<?php echo base_url('/tracking_sheet/add_details') ?>';
	
				var postData = {
					'csrfToken': GlobalVariables.csrfToken,
					'tracking_sheet_id': GlobalVariables.tracking_sheet_id,
					'travel_date': $('#travel_date').val().replace(/(\d\d)\/(\d\d)\/(\d{4})/, "$3-$1-$2"),
					'origin': $('#origin').val(),
					'destination': $('#destination').val(),
					'purpose': $('#purpose').val(),
					'program_id': $('#program_id option:selected').val(),
					'meals': $('#meals').val(),
					'lodging': $('#lodging').val(),
					'mileage': $('#mileage').val(),
					'other_trans_amount': $('#other_trans_amount').val(),
					'incidental_type': $('#incidental_type').val()
				};		
		
				$.ajax({
					url: postUrl,
					type: 'POST',
					data: postData,
					datatype: 'json',
					success: function(response, textStatus, jqXHR) {
						//////////////////////////////////////////////////////
						console.log('Ajax Remove Card Response:', response);
						//////////////////////////////////////////////////////
						
						$('#travel_date').val("");
						$('#origin').val("");
						$('#destination').val("");
						$('#purpose').val("");
						$('#program_id').val("");
						$('#meals').val("");
						$('#lodging').val("");
						$('#mileage').val("");
						$('#other_trans_amount').val("");
						$('#incidental_type').val("");

						//$.Notification.autoHideNotify('success', 'top right', 'Successfully!', 'Your tenant has been added. An evite has also been sent to you tenant inviting them to be a part of your rewards program.');
						
						//GlobalVariables.dataTable.draw();
						get_details();
					},
		
				});
			} else {
				$.notify("Date cannot be in the future", "danger");
				$('#travel_date').addClass("is-invalid");
			}
		}

		function update_details(id){

			//add confirm dialog here
			var postUrl = '<?php echo base_url('/tracking_sheet/update_details') ?>';
	
			var postData = {
				'csrfToken': GlobalVariables.csrfToken,
				'id': id,
				'tracking_sheet_id': GlobalVariables.tracking_sheet_id,
				'travel_date': $('#travel_date').val().replace(/(\d\d)\/(\d\d)\/(\d{4})/, "$3-$1-$2"),
				'origin': $('#origin').val(),
				'destination': $('#destination').val(),
				'purpose': $('#purpose').val(),
				'program_id': $('#program_id option:selected').val(),
				'meals': $('#meals').val(),
				'lodging': $('#lodging').val(),
				'mileage': $('#mileage').val(),
				'other_trans_amount': $('#other_trans_amount').val(),
				'incidental_type': $('#incidental_type').val()
			};		
	
			$.ajax({
				url: postUrl,
				type: 'POST',
				data: postData,
				datatype: 'json',
				success: function(response, textStatus, jqXHR) {
					//////////////////////////////////////////////////////
					console.log('Ajax Remove Card Response:', response);
					//////////////////////////////////////////////////////
					
					clear_details();

					//$.Notification.autoHideNotify('success', 'top right', 'Successfully!', 'Your tenant has been added. An evite has also been sent to you tenant inviting them to be a part of your rewards program.');
					
					//GlobalVariables.dataTable.draw();
					get_details();
				},
	
			});
		}

		function edit_details(id, travel_date, origin, destination, purpose, program_id, meals, lodging, mileage, other_trans_amount, incidental_type){
			$('#travel_date').val(travel_date);
			$('#origin').val(origin);
			$('#destination').val(destination);
			$('#purpose').val(purpose);
			$('#program_id').val(program_id);
			$('#meals').val(meals);
			$('#lodging').val(lodging);
			$('#mileage').val(mileage);
			$('#other_trans_amount').val(other_trans_amount);
			$('#incidental_type').val(incidental_type);

			
			html = '<button class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm float-right" onclick="clear_details();"><i class="fas fa-plus fa-sm text-white-50"></i> Clear</button>';
			html += '<button class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm float-right mr-3" onclick="update_details('+id+');"><i class="fas fa-plus fa-sm text-white-50"></i> Modify</button>';
			$('#add_modify_form_buttons').html(html);
		}

		function delete_detail(id){

			//add confirm dialog here
			var postUrl = '<?php echo base_url('/tracking_sheet/delete_detail') ?>';

			var postData = {
				'csrfToken': GlobalVariables.csrfToken,
				'id': id,
			};		

			$.ajax({
				url: postUrl,
				type: 'POST',
				data: postData,
				datatype: 'json',
				success: function(response, textStatus, jqXHR) {
					//////////////////////////////////////////////////////
					console.log('Ajax Remove Card Response:', response);
					//////////////////////////////////////////////////////
					
					get_details();
				},

			});
		}	

		function add_tracking_sheet(){
		 
		 //add confirm dialog here
		 var postUrl = '<?php echo base_url('/tracking_sheet/add_tracking_sheet') ?>';
 
		 var postData = {
			 'csrfToken': GlobalVariables.csrfToken
		 };		
 
		 $.ajax({
			 url: postUrl,
			 type: 'POST',
			 data: postData,
			 datatype: 'json',
			 success: function(response, textStatus, jqXHR) {
				 //////////////////////////////////////////////////////
				 console.log('Ajax Remove Card Response:', response);
				 //////////////////////////////////////////////////////
				 
				 var data = JSON.parse(response);

				 GlobalVariables.tracking_sheet_id = data;
				 //$.Notification.autoHideNotify('success', 'top right', 'Successfully!', 'Your tenant has been added. An evite has also been sent to you tenant inviting them to be a part of your rewards program.');
				 
				 //GlobalVariables.dataTable.draw();
				 add_details();
			 },
 
		 });
	 	}

		function get_totals(){
		 
		 //add confirm dialog here
		 var postUrl = '<?php echo base_url('/tracking_sheet/get_totals') ?>';
 
		 var postData = {
			 'csrfToken': GlobalVariables.csrfToken,
			 'tracking_sheet_id': GlobalVariables.tracking_sheet_id
		 };		
 
		 $.ajax({
			 url: postUrl,
			 type: 'POST',
			 data: postData,
			 datatype: 'json',
			 success: function(response, textStatus, jqXHR) {
				 //////////////////////////////////////////////////////
				 console.log('Ajax Remove Card Response:', response);
				 //////////////////////////////////////////////////////
				 
				 var data = JSON.parse(response);
				 // Create our number formatter.
				 var formatter = new Intl.NumberFormat('en-US', {
				 style: 'currency',
				 currency: 'USD',

				 // These options are needed to round to whole numbers if that's what you want.
				 //minimumFractionDigits: 0, // (this suffices for whole numbers, but will print 2500.10 as $2,500.1)
				 //maximumFractionDigits: 0, // (causes 2500.99 to be printed as $2,501)
				 });

				 for (i = 0; i < data.length; i++){
					$('#total_meals').html(formatter.format(data[i].meals_total));
					$('#total_lodging').html(formatter.format(data[i].lodging_total));
					$('#total_mileage').html(formatter.format(data[i].mileage_total));
					$('#total_other').html(formatter.format(data[i].other_total));
					$('#grand_total').html(formatter.format(data[i].grand_total));

					

				 }
			 },
 
		 });
	 	}

	 	function clear_details() {
			$('#travel_date').val("");
			$('#origin').val("");
			$('#destination').val("");
			$('#purpose').val("");
			$('#meals').val("");
			$('#lodging').val("");
			$('#mileage').val("");
			$('#other_trans_amount').val("");
			$('#incidental_type').val("");

			html = '<button class="d-none d-sm-inline-block btn btn-sm btn-danger shadow-sm float-right" onclick="clear_details();"><i class="fas fa-plus fa-sm text-white-50"></i> Clear</button>';
			html += '<button class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm float-right mr-3" onclick="submit_details();"><i class="fas fa-plus fa-sm text-white-50"></i> Add</button>';
			$('#add_modify_form_buttons').html(html);
		}

		function submit_for_approval(){

		 /*if($.trim($('#program_id option:selected').val()) == "" )
         {
            ret = false;
            //ADD ERROR MESSAGE TO FORCE TEXT
			$('#program_id').addClass("is-invalid");

           return;
         } */
		 
		 
		 //add confirm dialog here
		 var postUrl = '<?php echo base_url('/tracking_sheet/submit_for_approval') ?>';
 
		 var postData = {
			 'csrfToken': GlobalVariables.csrfToken,
			 'id': GlobalVariables.tracking_sheet_id
		 };		
 
		 $.ajax({
			 url: postUrl,
			 type: 'POST',
			 data: postData,
			 datatype: 'json',
			 success: function(response, textStatus, jqXHR) {
				 //////////////////////////////////////////////////////
				 console.log('Ajax Remove Card Response:', response);
				 //////////////////////////////////////////////////////
				 
				 window.location.href = '<?php echo base_url('/tracking_sheet') ?>';
			 },
 
		 });
		 }
		 

		 function isNotInTheFuture(date) {
			today = "<?php echo date('m/d/Y'); ?>";

			// 👇️ OPTIONAL!
			// This line sets the time of the current date to the
			// last millisecond, so the comparison returns `true` only if
			// date is at least tomorrow
			//today.setHours(23, 59, 59, 998);

			return date <= today;
		}

    </script>

<?php $this->view('components/footer_end'); ?>