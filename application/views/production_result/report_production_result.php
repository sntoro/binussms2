	<div class="">
            <div class="page-title">
              <div class="title_left">
                <h3><small>Home / Production Result</small></h3>
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
                    <h2>Report Production Result<small></small></h2>
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
                          <th>Machine Name</th>
                          <th>Part Name</th>
                          <th>Location</th>
                          <th>Qty</th>
                        </tr>
                      </thead>
                      <tbody>
                            <?php
                              $i = 1;
                              foreach ($data as $isi) {
                                echo "<tr class='gradeX'>";
                                echo "<td width='5%' style='text-align:center;'>$i</td>";
                                echo "<td>$isi->MACHINE_NAME</td>";
                                echo "<td>$isi->PART_NAME</td>";
                                echo "<td>$isi->LOCATION</td>";
                                echo "<td>$isi->QTY</td>";
                            ?>
                                </tr>
                                <?php
                                $i++;
                            }
                            ?>
                      </tbody>
                    </table>
				</div>
									
                </div>
            
			</div>

        </div>
    </div>
