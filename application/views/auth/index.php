<?php $this->view('components/header_start'); ?>

<?php $this->view('components/header_end'); ?>




                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
					<h1 class="h3 mb-2 text-gray-800"><?php echo lang('index_heading');?></h1>
					
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary"><?php echo lang('index_subheading');?></h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
											<th><?php echo lang('index_fname_th');?></th>
											<th><?php echo lang('index_lname_th');?></th>
											<th><?php echo lang('index_email_th');?></th>
											<th><?php echo lang('index_groups_th');?></th>
											<th><?php echo lang('index_status_th');?></th>
											<th><?php echo lang('index_action_th');?></th>
                                        </tr>
                                    </thead>
                                    <tfoot>
										<tr>
											<th><?php echo lang('index_fname_th');?></th>
											<th><?php echo lang('index_lname_th');?></th>
											<th><?php echo lang('index_email_th');?></th>
											<th><?php echo lang('index_groups_th');?></th>
											<th><?php echo lang('index_status_th');?></th>
											<th><?php echo lang('index_action_th');?></th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
									<?php foreach ($users as $user):?>
										<tr>
											<td><?php echo htmlspecialchars($user->first_name,ENT_QUOTES,'UTF-8');?></td>
											<td><?php echo htmlspecialchars($user->last_name,ENT_QUOTES,'UTF-8');?></td>
											<td><?php echo htmlspecialchars($user->email,ENT_QUOTES,'UTF-8');?></td>
											<td>
												<div class="badge badge-primary badge-pill">
													<?php foreach ($user->groups as $group):?>
														<?php echo htmlspecialchars($group->description,ENT_QUOTES,'UTF-8');?><br />
													<?php endforeach?>
												</div>
											</td>
											<td><?php echo ($user->active) ? anchor("auth/deactivate/".$user->id, lang('index_active_link')) : anchor("auth/activate/". $user->id, lang('index_inactive_link'));?></td>
											<td><?php echo anchor("auth/edit_user/".$user->id, 'Edit') ;?></td>
										</tr>
									<?php endforeach;?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>					



<p><?php echo anchor('auth/create_user', lang('index_create_user_link'), 'class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"')?></p>


</div>
                <!-- /.container-fluid -->


			
				
<?php $this->view('components/footer_start'); ?>

<?php $this->view('components/footer_end'); ?>