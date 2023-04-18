<?php $this->view('components/header_start'); ?>


<?php $this->view('components/header_end'); ?>


	<!-- Begin Page Content -->
	<div class="container-fluid">

		<!-- Page Heading -->
		<h1 class="h3 mb-2 text-gray-800">Settings</h1>

		<!-- Content Row -->
		<div class="row">
			<div class="card shadow mb-4">
				<div class="card-header py-3">
					<h6 class="m-0 font-weight-bold text-primary">Notifications</h6>
				</div>
				<div class="card-body">
					<div class="form-group">
						<div class="custom-control custom-checkbox">
							<input type="checkbox" class="custom-control-input" id="service_order_notifications" <?php echo ($service_order_notifications == 1 ? "checked" : ""); ?>>
							<label class="custom-control-label" for="service_order_notifications">I want to receive Service Order Notifications</label>
						</div><br>

						<h6 class="m-0 font-weight-bold text-primary">Please select the programs that you would like to get notifications for.</h6>

						<?php
							for($i = 0; $i < count($programs); $i++)
							{
								echo '<div class="custom-control custom-checkbox"><input type="checkbox" class="custom-control-input" id="program_notifications'.$programs[$i]["id"].'" name="program_notifications[]" value="'.$programs[$i]["id"].'" '.($programs[$i]["program_id"] != null ? "checked" : "").'><label class="custom-control-label" for="program_notifications'.$programs[$i]["id"].'">'.$programs[$i]["description"].'</label></div>';
							}
						?>

					</div>
					<button type="submit" class="btn btn-primary" onclick="update_notifications();">Update</button>
				</div>
			</div>

		</div>

	</div>
<!-- /.container-fluid -->

			
				
<?php $this->view('components/footer_start'); ?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/notify/0.4.2/notify.min.js"></script>

<script type="text/javascript">
			var GlobalVariables = {
				'csrfToken'               	: <?php echo json_encode($this->security->get_csrf_hash()); ?>,
				'baseurl'					: '<?php echo base_url(); ?>'
			};
			

		$(document).ready(function() {


				
        });   

        function update_notifications(){
            //add confirm dialog here
			var postUrl = '<?php echo base_url('/settings/update_notifications') ?>';
			var programs = [];
			


			$("input[name='program_notifications[]']:checked").each(function(i){
				programs[i] = $(this).val();
			});
    
            var postData = {
                'csrfToken': GlobalVariables.csrfToken,
				'service_order_notifications': ($("#service_order_notifications").is(':checked') ? 1 : 0),
				'programs': programs
            };		
    
            $.ajax({
                url: postUrl,
                type: 'POST',
                data: postData,
                datatype: 'json',
                success: function(response, textStatus, jqXHR) {
					$.notify("Saved Successfully", "success");

				}
            });
        }
	</script>

<?php $this->view('components/footer_end'); ?>