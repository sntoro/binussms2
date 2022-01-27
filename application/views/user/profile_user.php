<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.1.min.js"></script>

				<div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>My Profiles</h3>
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
                    <h2>My Profile<small>My profiles</small></h2>
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
                    <br />
                    <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for='usercode'>Usercode</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" class="form-control" name='usercode' id='usercode' readonly="readonly" placeholder="Read-Only Input" value='<?php echo $data_user->USER_CODE ?>'>
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Username <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="first-name" required="required" class="form-control col-md-7 col-xs-12" value='<?php echo $data_user->USERNAME ?>'>
                        </div>
											</div>
											<div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="img">Image profile <span class="required">*</span></label>
                            <div class="col-md-2 col-sm-2 col-xs-12">
                                <img src="<?php echo base_url('assets/images/user/'.$data_user->USER_CODE.'.jpg'); ?>" id="img-profile" width="150px" />
														</div>
														<input class="col-md-3 col-sm-3 col-xs-12" name="img" id="upload" type="file" required> 
											</div>
                      <div class="form-group">
                        <label for='password' class="control-label col-md-3 col-sm-3 col-xs-12">Password</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="password" name='password' id='password' class="form-control" value="passwordonetwo">
                        </div>
                      </div>
											<div class="form-group">
                        <label for="regis_date" class="control-label col-md-3 col-sm-3 col-xs-12">Registration Date <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="regis_date" class="form-control col-md-7 col-xs-12" type="text" name="regis_date" value='<?php echo $data_user->REGIS_DATE ?>'>
                        </div>
                      </div>
											<div class="form-group">
                        <label for="exp_date" class="control-label col-md-3 col-sm-3 col-xs-12">Exp Date <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="exp_date" class="date-picker form-control col-md-7 col-xs-12" required="required" type="text" name="exp_date" value='<?php echo $data_user->EXP_DATE ?>'>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="role">Role <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="role" readonly required="required" class="form-control col-md-7 col-xs-12" value='<?php echo $data_user->ROLE ?>'>
                        </div>
											</div>

                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                          <button type="submit" class="btn btn-success">Update</button>
                        </div>
                      </div>

                    </form>
                  </div>
                </div>
              </div>

            </div>

          </div>
					

