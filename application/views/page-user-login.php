<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title><?php echo $title;?> Bonjour Management Pvt. Ltd</title>

  <!-- Custom fonts for this template-->
  <link href="<?php echo site_url();?>vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="<?php echo site_url();?>css/sb-admin-2.css" rel="stylesheet">

</head>

<body class="theme-color">
  <div class="container d-flex align-items-center" style="height:100vh;">

    <!-- Outer Row -->
    <div class="row col-12 justify-content-center">

      <div class="col-xl-10 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-lg-6 d-flex justify-content-center align-items-center">
                <img src="<?php echo site_url();?>img/download.jpg" width="300" height="150">
              </div>
              <div class="col-lg-6">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">User Login</h1>
                  </div>

                  <?php if($this->session->flashdata('error')) { ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo $this->session->flashdata('error');?>
                    </div>
                  <?php } ?>


                  <form class="user" method="post" action="<?php echo base_url();?>user/login">
                    <div class="form-group">
                      <input type="email" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Enter Email Address..." name="email_address" autocomplete="off" required>
                    </div>
                    <div class="form-group">
                      <input type="password" class="form-control form-control-user" id="exampleInputPassword" placeholder="Password" name="password" autocomplete="off" required>
                    </div>
                    <input type="submit" class="btn btn-primary btn-user btn-block" value="Login" name="user_login">
                  </form>
                  <hr>
                  <div class="text-center">
                    <a class="small" href="#">Forgot Password?</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>

  <!-- Bootstrap core JavaScript-->

</body>

</html>
