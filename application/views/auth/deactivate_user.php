<?php $this->view('components/header_start'); ?>

<?php $this->view('components/header_end'); ?>



                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800"><?php echo lang('deactivate_heading');?></h1>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3"> </div>
                        <div class="card-body">

<p><?php echo sprintf(lang('deactivate_subheading'), $user->{$identity}); ?></p>

<?php echo form_open("auth/deactivate/".$user->id);?>

  <p>
  	
    <div class="radio radio-primary">
      <input type="radio" name="confirm" id="confirm_yes" value="yes" checked="checked" />
      <label class="radio" for="confirm_yes"><?php echo lang('deactivate_confirm_y_label', 'confirm');?></label>
    </div>
    
    <div class="radio radio-primary">
      <input type="radio" name="confirm" id="confirm_no" value="no" />
      <label class="radio" for="confirm_no"><?php echo lang('deactivate_confirm_n_label', 'confirm');?></label>
    </div>
  </p>

  <?php echo form_hidden($csrf); ?>
  <?php echo form_hidden(['id' => $user->id]); ?>

  <p><?php echo form_submit('submit', lang('deactivate_submit_btn'), 'class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"');?></p>

<?php echo form_close();?>


    </div>
	</div>
</div>

<?php $this->view('components/footer_start'); ?>

<?php $this->view('components/footer_end'); ?>  