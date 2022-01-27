	<div class="">
            <div class="page-title">
              <div class="title_left">
                <h3><small>Home / Machines</small></h3>
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
					<h2><a class='blue' style='cursor:pointer;' data-toggle="modal" data-target=".bs-example-modal-lg"><i class="fa fa-plus"></i> New Machine</a><small></small></h2>
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
                          <th style='text-align:center;'>No</th>
                          <th>Machine Code</th>
                          <th>Machine Name</th>
                          <th>Pin Reset Counter</th>
                          <th>location</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                            <?php
                              $i = 1;
                              foreach ($data as $isi) {
                                echo "<tr class='gradeX'>";
                                echo "<td width='5%' style='text-align:center;'>$i</td>";
                                echo "<td>$isi->MACHINE_CODE</td>";
                                echo "<td>$isi->MACHINE_NAME</td>";
                                echo "<td>$isi->PASSWORD</td>";
                                echo "<td>$isi->LOCATION</td>";
                            ?>
                                <td>
									<a class="btn btn-warning" href="#" data-toggle="modal" data-target=".<?php echo $isi->ID ?>" title="Edit"><span class="fa fa-pencil"></span></a>
									<a class="btn btn-danger" href="<?php echo base_url('index.php/machine_c/delete_machine') . "/" . $isi->ID ?>" data-placement="right" data-toggle="tooltip" title="Delete" onclick="return confirm('Are you sure want to delete this machine?');"><span class="fa fa-times"></span></a>
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
									<h4 class="modal-title" id="myModalLabel">Edit Machine</h4>
								</div>
								<div class="modal-body">
								
								
								<?php echo form_open('machine_c/update_machine', 'class="form-horizontal form-label-left"'); ?>

										<div class="item form-group">
											</label>
											<div class="col-md-6 col-sm-6 col-xs-12">
												<input id="id" class="form-control col-md-7 col-xs-12" name="id" required="required" type="hidden" value="<?php echo $isi->ID ?>">
											</div>
										</div>
										<div class="item form-group">
											<label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Machine Code <span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 col-xs-12">
												<input id="machine_code" readonly class="form-control col-md-7 col-xs-12" name="machine_code" required="required" type="text" value="<?php echo $isi->MACHINE_CODE ?>">
											</div>
										</div>
										<div class="item form-group">
											<label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Machine Name <span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 col-xs-12">
												<input id="machine_name" class="form-control col-md-7 col-xs-12" name="machine_name" required="required" type="text" value="<?php echo $isi->MACHINE_NAME ?>">
											</div>
										</div>
										<div class="item form-group">
											<label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Pin Reset Counter <span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 col-xs-12">
												<input type="password" id="password" name="password" required="required" maxlength="4" class="form-control col-md-7 col-xs-12" value="<?php echo $isi->PASSWORD ?>">
											</div>
										</div>
										<div class="item form-group">
											<label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Location <span class="required">*</span>
											</label>
											<div class="col-md-6 col-sm-6 col-xs-12">
												<input type="text" id="location" name="location" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $isi->LOCATION ?>">
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
								<h4 class="modal-title" id="myModalLabel">New Machine</h4>
							</div>
							<div class="modal-body">

							<?php echo form_open('machine_c/save_machine', 'class="form-horizontal form-label-left"'); ?>

									<div class="item form-group">
										<label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Machine Code <span class="required">*</span>
										</label>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<input id="machine_code" class="form-control col-md-7 col-xs-12" data-validate-length-range="12" name="machine_code" required="required" type="text">
										</div>
									</div>
									<div class="item form-group">
										<label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Machine Name <span class="required">*</span>
										</label>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<input id="machine_name" class="form-control col-md-7 col-xs-12" data-validate-length-range="60" name="machine_name" required="required" type="text">
										</div>
									</div>
									<div class="item form-group">
										<label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Pin Reset Counter <span class="required">*</span>
										</label>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<input type="password" id="password" name="password" maxlength="4" required="required" class="form-control col-md-7 col-xs-12">
										</div>
									</div>
									<div class="item form-group">
										<label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Location <span class="required">*</span>
										</label>
										<div class="col-md-6 col-sm-6 col-xs-12">
											<input type="text" id="location" name="location" required="required" class="form-control col-md-7 col-xs-12">
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


<!-- <script>

setInputFilter(document.getElementById("password"), function(value) {
  return /^\d*\.?\d*$/.test(value); // Allow digits and '.' only, using a RegExp
});

// Restricts input for the given textbox to the given inputFilter function.
function setInputFilter(textbox, inputFilter) {
  ["input", "keydown", "keyup", "mousedown", "mouseup", "select", "contextmenu", "drop"].forEach(function(event) {
    textbox.addEventListener(event, function() {
      if (inputFilter(this.value)) {
        this.oldValue = this.value;
        this.oldSelectionStart = this.selectionStart;
        this.oldSelectionEnd = this.selectionEnd;
      } else if (this.hasOwnProperty("oldValue")) {
        this.value = this.oldValue;
        this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
      } else {
        this.value = "";
      }
    });
  });
}

</script> -->
