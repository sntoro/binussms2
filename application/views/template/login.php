<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="icon" href="<?php echo base_url('assets/images/favicon.ico'); ?>" type="image/ico" />

    <title>Login</title>

    <!-- Bootstrap -->
    <link href="<?php echo base_url('assets/vendors/bootstrap/dist/css/bootstrap.min.css'); ?>" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?php echo base_url('assets/vendors/font-awesome/css/font-awesome.min.css'); ?>" rel="stylesheet">
    <!-- NProgress -->
    <link href="<?php echo base_url('assets/vendors/nprogress/nprogress.css'); ?>" rel="stylesheet">
    <!-- iCheck -->
    <link href="<?php echo base_url('assets/vendors/iCheck/skins/flat/green.css'); ?>" rel="stylesheet">
		<!-- Animate.css -->
		<link href="<?php echo base_url('assets/vendors/animate.css/animate.min.css'); ?>" rel="stylesheet">

		<!-- Custom Theme Style -->
    <link href="<?php echo base_url('assets/build/css/custom.min.css'); ?>" rel="stylesheet">
  </head>

  <body class="login">
		
		<div>
      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>

      <div class="login_wrapper">
        <div class="animate form login_form">
				<?php
				if (!is_null($msg)) {
						echo $msg;
				}
				?>
          <section class="login_content">
						<?php echo form_open('login_c/login', 'class="form-horizontal form-label-left"'); ?>
              <h1>Login Form</h1>
              <div>
                <input type="text" name='user_code' class="form-control" placeholder="NPK" required="" autofocus/>
              </div>
              <div>
                <input type="password" name='password' class="form-control" placeholder="Password" required="" />
              </div>
              <div>
                <button type='submit' class="btn btn-default submit" style='width:200px;' >Log in</button>
                <!-- <a class="reset_pass" href="#">Lost your password?</a> -->
              </div>

              <div class="clearfix"></div>

              <div class="separator">

                <div class="clearfix"></div>
                <br />

                <div>
                  <h1><i class=""></i> Production Result</h1>
                  <!-- <p>©2016 All Rights Reserved. Your company is a Bootstrap 3 template. Privacy and Terms</p> -->
                </div>
              </div>
							<?php echo form_close(); ?>
          </section>
        </div>

   
			</div>
			
		</div>
		
  </body>
</html>
