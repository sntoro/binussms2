	<div class="">
            <div class="page-title">
              <div class="title_left">
                <h3><small>Home / Parts</small></h3>
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
					<h2><a class='blue' style='cursor:pointer;' data-toggle="modal" data-target=".bs-example-modal-lg"><i class="fa fa-plus"></i> New Part</a><small></small></h2>
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
                          <th>Part No</th>
                          <th>Part Name</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                            <?php
                              $i = 1;
                              foreach ($data as $isi) {
                                echo "<tr class='gradeX'>";
                                echo "<td width='5%' style='text-align:center;'>$i</td>";
                                echo "<td>$isi->PART_NO</td>";
                                echo "<td>$isi->PART_NAME</td>";
                            ?>
                                <td>
									<a class="btn btn-warning" href="#" data-toggle="modal" data-target=".<?php echo $isi->ID ?>" title="Edit"><span class="fa fa-pencil"></span></a>
									<a class="btn btn-danger" href="<?php echo base_url('index.php/part_c/delete_part') . "/" . $isi->ID ?>" data-placement="right" data-toggle="tooltip" title="Delete" onclick="return confirm('Are you sure want to delete this part?');"><span class="fa fa-times"></span></a>
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
									<h4 class="modal-title" id="myModalLabel">Edit Part</h4>
								</div>
								<div class="modal-body">
								
								
								<?php echo form_open('part_c/update_part', 'class="form-horizontal form-label-left"'); ?>

										<div class="item form-group">
											<div class="col-md-6 col-sm-6 col-xs-12">
												<input id="id" class="form-control col-md-7 col-xs-12" name="id" required="required" type="hidden" value="<?php echo $isi->ID ?>">
											</div>
										</div>
										<div class="item form-group">
											<label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Part No <span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 col-xs-12">
												<input id="part_no" class="form-control col-md-7 col-xs-12" readonly name="part_no" required="required" type="text" value="<?php echo $isi->PART_NO ?>">
											</div>
										</div>
										<div class="item form-group">
											<label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Part Name <span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 col-xs-12">
												<input id="part_name" class="form-control col-md-7 col-xs-12" name="part_name" required="required" type="text" value="<?php echo $isi->PART_NAME ?>">
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
								<h4 class="modal-title" id="myModalLabel">New Part</h4>
							</div>
							<div class="modal-body">

							<?php echo form_open('part_c/save_part', 'class="form-horizontal form-label-left"'); ?>

									<div class="item form-group">
										<label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Part No <span class="required">*</span>
										</label>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<input id="part_no" class="form-control col-md-7 col-xs-12" data-validate-length-range="12" name="part_no" required="required" type="text">
										</div>
									</div>
									<div class="item form-group">
										<label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Part Name <span class="required">*</span>
										</label>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<input id="part_name" class="form-control col-md-7 col-xs-12" data-validate-length-range="60" name="part_name" required="required" type="text">
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
