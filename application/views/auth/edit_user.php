<?php $this->view('components/header_start'); ?>

<?php $this->view('components/header_end'); ?>



                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Edit User</h1>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3"> </div>
                        <div class="card-body">

<div id="infoMessage"><?php echo $message;?></div>

<?php echo form_open(uri_string());?>

      <p>
            <?php echo lang('edit_user_fname_label', 'first_name');?> <br />
            <?php echo form_input($first_name);?>
      </p>

      <p>
            <?php echo lang('edit_user_lname_label', 'last_name');?> <br />
            <?php echo form_input($last_name);?>
      </p>

      <p>
            <?php echo lang('edit_user_company_label', 'company');?> <br />
            <?php echo form_input($company);?>
      </p>

      <p>
            <?php echo lang('edit_user_phone_label', 'phone');?> <br />
            <?php echo form_input($phone);?>
      </p>

      <p>
            <?php echo lang('edit_user_password_label', 'password');?> <br />
            <?php echo form_input($password);?>
      </p>

      <p>
            <?php echo lang('edit_user_password_confirm_label', 'password_confirm');?><br />
            <?php echo form_input($password_confirm);?>
      </p>

      <?php if ($this->ion_auth->is_admin()): ?>

				  <h3>Access:</h3>
				  <?php foreach ($groups as $group):?>
					<div class="radio radio-primary">

      				  <input type="radio" name="groups[]" id="<?php echo $group['id'];?>" value="<?php echo $group['id'];?>" <?php echo (in_array($group, $currentGroups)) ? 'checked="checked"' : null; ?>>
					  <label class="radio" for="<?php echo $group['id'];?>">
					  <?php echo htmlspecialchars($group['description'],ENT_QUOTES,'UTF-8');?>
					  </label>



				</div>
				  <?php endforeach?>

      <?php endif ?>



      <?php echo form_hidden('id', $user->id);?>
      <?php echo form_hidden($csrf); ?>

      <p><?php echo form_submit('submit', lang('edit_user_submit_btn'), 'class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"');?></p>

<?php echo form_close();?>


	</div>
	</div>
</div>

<?php $this->view('components/footer_start'); ?>

<?php $this->view('components/footer_end'); ?>