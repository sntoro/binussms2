	<div class="">
            <div class="page-title">
              <div class="title_left">
                <h3><small>Home / Users</small></h3>
              </div>

              <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                  <div class="input-group">
                   
                  </div>
                </div>
              </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">

              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2><a class='blue' style='cursor:pointer;' data-toggle="modal" data-target=".bs-example-modal-lg"><i class="fa fa-plus"></i> New Users</a><small></small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <ul class="dropdown-menu" role="menu">
                          <li><a href="#">Settings 1</a>
                          </li>
                          <li><a href="#">Settings 2</a>
                          </li>
                        </ul>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <p class="text-muted font-13 m-b-30">
					<?php
						if ($msg != NULL) {
							echo $msg;
						}
						if (validation_errors()) {
							echo '<div class = "alert alert-danger"><strong>WARNING !</strong>' . validation_errors() . '</div >';
						}
					?>
                    </p>
                    <table id="datatable-buttons" class="table table-striped jambo_table">
						<thead>
                        <tr>
                          <th>No</th>
                          <th>NPK</th>
                          <th>Username</th>
                          <th>Role</th>
                          <th>Registration</th>
                          <th>Expired</th>
                          <!-- <th>Log</th> -->
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                            <?php
                              $i = 1;
                              foreach ($data as $isi) {
                                echo "<tr class='gradeX'>";
                                echo "<td>$i</td>";
                                echo "<td>$isi->USER_CODE</td>";
                                echo "<td>$isi->USERNAME</td>";
                                echo "<td>$isi->STRING_ROLE</td>";
                                echo "<td>".date("d/m/Y", strtotime($isi->REGIS_DATE))."</td>";
                                echo "<td>".date("d/m/Y", strtotime($isi->EXP_DATE))."</td>";
                                // echo "<td>$isi->FLG_LOG</td>";
                            ?>
                                <td>
									<a class="btn btn-warning" href="#" data-toggle="modal" data-target=".<?php echo $isi->ID ?>" title="Edit"><span class="fa fa-pencil"></span></a>
									<a class="btn btn-danger" href="<?php echo base_url('index.php/user_c/delete_user') . "/" . $isi->ID ?>" data-placement="right" data-toggle="tooltip" title="Delete" onclick="return confirm('Are you sure want to delete this user?');"><span class="fa fa-times"></span></a>
                                </td>
                                </tr>
                                <?php
                                $i++;
                            }
                            ?>
                      </tbody>
                    </table>
				</div>
									
					<!-- Modal Edit -->
					<?php foreach($data as $isi){ ?>
						<div class="modal fade <?php echo $isi->ID ?>" tabindex="-1" role="dialog" aria-hidden="true">
							<div class="modal-dialog modal-lg">
								<div class="modal-content">

									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span>
										</button>
										<h4 class="modal-title" id="myModalLabel">Edit User</h4>
									</div>
									<div class="modal-body">
									
									
									<?php echo form_open('user_c/update_user', 'class="form-horizontal form-label-left"'); ?>

											<div class="item form-group">
												<div class="col-md-6 col-sm-6 col-xs-12">
													<input id="id" class="form-control col-md-7 col-xs-12"   name="id" required="required" type="hidden" value="<?php echo $isi->ID ?>">
												</div>
											</div>
											<div class="item form-group">
												<label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">NPK <span class="required">*</span>
												</label>
												<div class="col-md-6 col-sm-6 col-xs-12">
													<input readonly id="user_code" class="form-control col-md-7 col-xs-12"   name="user_code" required="required" type="text" value="<?php echo $isi->USER_CODE ?>">
												</div>
											</div>
											<div class="item form-group">
												<label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Username <span class="required">*</span>
												</label>
												<div class="col-md-6 col-sm-6 col-xs-12">
													<input id="username" autocomplete="off" class="form-control col-md-7 col-xs-12"   name="username" required="required" type="text" value="<?php echo $isi->USERNAME ?>">
												</div>
											</div>
											<div class="item form-group">
												<label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Role <span class="required">*</span>
												</label>
												<div class="col-md-6 col-sm-6 col-xs-12">
												<select name='role' class="form-control">
													<option <?php if($isi->ID_ROLE == 1) echo 'selected'; ?> value='1'>Administrator</option>
													<option <?php if($isi->ID_ROLE == 2) echo 'selected'; ?> value='2'>Manager</option>
													<option <?php if($isi->ID_ROLE == 3) echo 'selected'; ?> value='3'>Supervisor</option>
												</select>
												</div>
											</div>
											
											<div class="item form-group">
												<label class="control-label col-md-3 col-sm-3 col-xs-12" for="password">Password <span class="required">*</span>
												</label>
												<div class="col-md-6 col-sm-6 col-xs-12">
													<input type="password" id="password" autocomplete="off" name="password" required="required" data-validate-minmax="1" class="form-control col-md-7 col-xs-12" value="<?php echo $isi->PASSWORD ?>">
												</div>
											</div>

									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
										<button type="submit" class="btn btn-primary">Update</button>
									</div>

									<?php echo form_close(); ?>

								</div>
							</div>
						</div>
					<?php } ?>
					<!-- Modal Edit -->

					<!-- Modal Create -->										
					<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
						<div class="modal-dialog modal-lg">
							<div class="modal-content">

								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span>
									</button>
									<h4 class="modal-title" id="myModalLabel">New User</h4>
								</div>
								<div class="modal-body">

								<?php echo form_open('user_c/save_user', 'class="form-horizontal form-label-left"'); ?>

										<div class="item form-group">
											<label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">NPK <span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 col-xs-12">
												<input id="user_code" autocomplete="off" class="form-control col-md-7 col-xs-12"  data-validate-length-range="12" name="user_code" required="required" type="text">
											</div>
										</div>
										<div class="item form-group">
											<label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Username <span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 col-xs-12">
												<input id="username" autocomplete="off" class="form-control col-md-7 col-xs-12" data-validate-length-range="60" name="username" required="required" type="text">
											</div>
										</div>
										<div class="item form-group">
											<label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Role <span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 col-xs-12">
											<select name='role' class="form-control">
												<option value='1'>Administrator</option>
												<option value='2'>Supervisor</option>
												<option value='3'>Leader</option>
											</select>
											</div>
										</div>
										<div class="item form-group">
											<label class="control-label col-md-3 col-sm-3 col-xs-12" autocomplete="off" for="password">Password <span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 col-xs-12">
												<input type="password" id="password" name="password" required="required" data-validate-minmax="1" class="form-control col-md-7 col-xs-12">
											</div>
										</div>
										<div class="item form-group">
											<label class="control-label col-md-3 col-sm-3 col-xs-12" for="repeat_password">Repeat Password <span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 col-xs-12">
												<input type="password" id="repeat_password" autocomplete="off" name="repeat_password" required="required" data-validate-minmax="1" class="form-control col-md-7 col-xs-12">
											</div>
										</div>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
									<button type="submit" class="btn btn-primary">Save</button>
								</div>

								<?php echo form_close(); ?>

							</div>
						</div>
					</div>
					<!-- Modal Create -->

                </div>
            
			</div>

        </div>
    </div>
