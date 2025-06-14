<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link href="" rel="icon">
  <title>Career-Boss | Login</title>
  <link href="<?=base_url('public/assets/Admin/vendor/fontawesome-free/css/all.min.css'); ?>" rel="stylesheet" type="text/css">
  <link href="<?=base_url('public/assets/Admin/vendor/bootstrap/css/bootstrap.min.css'); ?>" rel="stylesheet" type="text/css">
  <link href="<?=base_url('public/assets/Admin/css/ruang-admin.min.css'); ?>" rel="stylesheet">

</head>

<body class="bg-gradient-login" >
<!-- style="background-image: url('<?=base_url('public/assets/images/login_bg.jpg');?>" -->
  <!-- Login Content -->
  <div class="container-login">
    <div class="row justify-content-center">
      <div class="col-xl-6 col-lg-12 col-md-9">
        <div class="card shadow-sm my-5">
          <div class="card-body p-0">
            <div class="row">
              <div class="col-lg-12">
                <div class="login-form">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Career-Boss Institute Login</h1>
                    <?php echo session()->getFlashdata('message'); ?>
                  </div>
                  <!-- <form class="user" action="<?=base_url('/auth/login')?>" method="post"> -->
                  <?=form_open(base_url('/pineapple')) ?>
                  <!-- <?=csrf_field(); ?> -->
                    <div class="form-group">
                      <input type="email" class="form-control" name="email" id="email" aria-describedby="emailHelp" placeholder="Enter Email Address" value="<?=set_value('email') ?>">
                      <small class="text-danger"><?php echo isset($validation) ? $validation->showError('email') : ''; ?> </small>
                    </div>
                    <div class="form-group">
                      <input type="password" class="form-control" name="password" id="password" placeholder="Password" value="<?=set_value('password') ?>">
                      <small class="text-danger"><?php echo isset($validation) ? $validation->showError('password') : ''; ?> </small>
                    </div>
                    <div class="form-group">
                      <div class="custom-control custom-checkbox small" style="line-height: 1.5rem;">
                        <input type="checkbox" class="custom-control-input" id="customCheck" name="rememberme" value="1" <?=set_checkbox('rememberme', '1'); ?>>
                        <label class="custom-control-label" for="customCheck">Remember Me</label>
                      </div>
                    </div>
                    <div class="form-group">
                      <button type="submit" class="btn btn-primary btn-block">Login</a>
                    </div>
                  <?=form_close(); ?>
                  <div class="text-center">
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Login Content -->
  <script src="<?=base_url('public/assets/Admin/vendor/jquery/jquery.min.js'); ?>"></script>
  <script src="<?=base_url('public/assets/Admin/vendor/bootstrap/js/bootstrap.bundle.min.js'); ?>"></script>
  <script src="<?=base_url('public/assets/Admin/vendor/jquery-easing/jquery.easing.min.js'); ?>"></script>
  <script src="<?=base_url('public/assets/Admin/js/ruang-admin.min.js'); ?>"></script>
</body>

</html>