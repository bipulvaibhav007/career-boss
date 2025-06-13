<?=$this->extend("admin/_layout/master") ?>
<?=$this->section("content") ?>
  <!-- Container Fluid-->
  <div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800"><?=session('name')?>'s Profile</h1>
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
        <form autocomplete="off" action="<?=base_url('/profile'); ?>" method="post" enctype="multipart/form-data">
          <?= csrf_field(); ?>
          <div class="form-group row">
            <label for="name" class="col-md-2">Profile Image</label>
            <div class="col-md-2">
              <img src="<?=base_url('public/assets/upload/users/'.$profile->image); ?>" alt="profile image" height="50px" length="50px">
            </div>
            <label for="name" class="col-md-3">Change Profile Image</label>
            <div class="col-md-5">
              <input type="file" class="form-control" name="image" id="image">
            </div>
          </div>
          <div class="form-group row">
            <label for="name" class="col-md-2">Name</label>
            <div class="col-md-10">
              <input type="text" class="form-control" name="name" id="name" value="<?=set_value('name', isset($profile)?$profile->name:''); ?>" placeholder="Enter Name">
              <small class="text-danger"><?php echo isset($validation) ? $validation->showError('name') : ''; ?></small>
            </div>
          </div>
          <div class="form-group row">
            <label for="email" class="col-md-2">Email</label>
            <div class="col-md-10">
              <input type="email" class="form-control" name="email" id="email" value="<?=set_value('email', $profile->email); ?>" placeholder="Enter Email">
              <small class="text-danger"><?php echo isset($validation) ? $validation->showError('email') : ''; ?></small>
            </div>
          </div>
          <div class="form-group row">
            <label for="phone" class="col-md-2">Phone</label>
            <div class="col-md-10">
              <input type="number" class="form-control" name="phone" id="phone" value="<?=$profile->phone; ?>" placeholder="Enter Phone">
            </div>
          </div>
          <div class="form-group row">
            <label for="address" class="col-md-2">Address</label>
            <div class="col-md-10">
              <input type="text" class="form-control" name="address" id="address" value="<?=$profile->address; ?>" placeholder="Enter Address">
            </div>
          </div>
          <button type="submit" class="btn btn-primary">Submit</button>
        </form>
      </div>
    </div>
  </div> <!-- end container fluid -->
  <!---Container Fluid-->
<?=$this->endSection()?>
  