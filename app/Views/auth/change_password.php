<?=$this->extend("admin/_layout/master") ?>
<?=$this->section("content") ?>
  <!-- Container Fluid-->
  <?php $li = session()->get("loginitem"); ?>
  <div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">Change Password</h1>
      <!--<ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?=base_url('admin'); ?>">Admin</a></li>
        <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
      </ol>-->
    </div>
    <!-- add content here -->
    <div class="card mb-4">
      <div class="card-body">
        <?php if(session()->has('message')){
          echo session()->get('message');
        }?>
        <form autocomplete="off" action="<?=base_url('/change-password'); ?>" method="post" enctype="multipart/form-data">
          <?= csrf_field(); ?>
          
          <div class="form-group row">
            <label for="pwd" class="col-md-2">Password</label>
            <div class="col-md-4">
              <input type="password" class="form-control" name="pwd" id="pwd" value="<?=set_value('pwd'); ?>" placeholder="Enter Password">
              <span class="text-danger"><?=isset($validation)?$validation->showError('pwd'):''; ?></span>
            </div>
          </div>
          <div class="form-group row">
            <label for="cpwd" class="col-md-2">Confirm Password</label>
            <div class="col-md-4">
              <input type="password" class="form-control" name="cpwd" id="cpwd" value="<?=set_value('cpwd'); ?>" placeholder="Enter Confirm Password">
              <span class="text-danger"><?=isset($validation)?$validation->showError('cpwd'):''; ?></span>
            </div>
          </div>
          
          <button type="submit" class="btn btn-primary">Submit</button>
        </form>
      </div>
    </div>
  </div> <!-- end container fluid -->
  <!---Container Fluid-->
<?=$this->endSection()?>
  