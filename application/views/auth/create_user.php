<?php $this->view('components/header_start'); ?>

<?php $this->view('components/header_end'); ?>

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Add User</h1>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3"> </div>
                        <div class="card-body">
				<div id="infoMessage"><?php echo $message;?></div>
		 
				<?php echo form_open("auth/create_user");?>
		 
					  <div class="form-group">
							<?php echo lang('create_user_fname_label', 'first_name');?> <br />
							<?php echo form_input($first_name);?>
					  </div>
		 
					  <div class="form-group">
							<?php echo lang('create_user_lname_label', 'last_name');?> <br />
							<?php echo form_input($last_name);?>
					  </div>
					   
					  <?php
					  if($identity_column!=='email') {
						  echo '<p>';
						  echo lang('create_user_identity_label', 'identity');
						  echo '<br />';
						  echo form_error('identity');
						  echo form_input($identity);
						  echo '</p>';
					  }
					  ?>
		 
					  <div class="form-group">
							<?php echo lang('create_user_company_label', 'company');?> <br />
							<?php echo form_input($company);?>
					  </div>
		 
					 <div class="form-group">
							<?php echo lang('create_user_email_label', 'email');?> <br />
							<?php echo form_input($email);?>
					  </div>
		 
					  <div class="form-group">
							<?php echo lang('create_user_phone_label', 'phone');?> <br />
							<?php echo form_input($phone);?>
					  </div>
		 
					  <div class="form-group">
							<?php echo lang('create_user_password_label', 'password');?> <br />
							<?php echo form_input($password);?>
					  </div>
		 
					  <div class="form-group">
							<?php echo lang('create_user_password_confirm_label', 'password_confirm');?> <br />
							<?php echo form_input($password_confirm);?>
					  </div> 
		 
					  <p><?php echo form_submit('submit', lang('create_user_submit_btn'), 'class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"');?></p>
		 
				<?php echo form_close();?>

      </div>
    </div>
</div>

<?php $this->view('components/footer_start'); ?>

<?php $this->view('components/footer_end'); ?>