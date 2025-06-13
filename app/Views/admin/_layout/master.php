<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link href="" rel="icon">
  <title>Career-Boss | Admin</title>
  <link href="<?php echo base_url('public/assets/Admin/vendor/fontawesome-free/css/all.min.css'); ?>" rel="stylesheet" type="text/css">
  <link href="<?php echo base_url('public/assets/Admin/vendor/bootstrap/css/bootstrap.min.css'); ?>" rel="stylesheet" type="text/css">
  <link href="<?php echo base_url('public/assets/Admin/css/ruang-admin.min.css'); ?>" rel="stylesheet">
  <link href="<?php echo base_url('public/assets/Admin/css/bootstrap-multiselect.css'); ?>" rel="stylesheet">
  <!-- srtles for datepicker -->
  <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  
  <script src="<?php echo base_url('public/assets/Admin/vendor/jquery/jquery.min.js') ?>"></script>
  <!-- for datepicker always below jqueryminjs -->
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script> 
  <script src="<?php echo base_url('public/assets/Admin/js/bootstrap-multiselect.js') ?>"></script>
</head>
<body id="page-top">
    <div id="wrapper">
        <!--Area for dynamic content -->
        <?=$this->include("admin/_layout/sidebar")?>
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <?=$this->include("admin/_layout/topbar")?>
                <?= $this->renderSection("content"); ?>
            </div>
            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                <div class="copyright text-center my-auto">
                    <span>copyright &copy; <script> document.write(new Date().getFullYear()); </script> - developed by
                    <b><a href="https://webpanelsolutions.com/" target="_blank">webpanelsolutions</a></b>
                    </span>
                </div>
                </div>
            </footer>
            <!-- Footer -->
        </div>
    </div>
    <!-- Modal Logout -->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelLogout"
      aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabelLogout">Ohh No!</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <p>Are you sure you want to logout?</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Cancel</button>
            <a href="<?=base_url('/logout'); ?>" class="btn btn-primary">Logout</a>
          </div>
        </div>
      </div>
    </div>
<!-- Scroll to top -->
<a class="scroll-to-top rounded" href="#page-top">
  <i class="fas fa-angle-up"></i>
</a>
<script src="<?php echo base_url('public/assets/Admin/vendor/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
<script src="<?php echo base_url('public/assets/Admin/vendor/jquery-easing/jquery.easing.min.js') ?>"></script>
<script src="<?php echo base_url('public/assets/Admin/js/ruang-admin.min.js') ?>"></script>
<script src="<?php echo base_url('public/assets/Admin/vendor/chart.js/Chart.min.js') ?>"></script>
<?php /* <script src="<?php echo base_url('public/assets/Admin/js/demo/chart-area-demo.js') ?>"></script>  */ ?>
</body>
</html>