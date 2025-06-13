<?=$this->extend("admin/_layout/master") ?>
<?=$this->section("content") ?>
<div class="container-fluid" id="container-wrapper">
  <div class="d-sm-flex align-items-center justify-content-between mb-1">
    <h1 class="h3 mb-0 text-gray-800">Users</h1>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="<?=base_url('admin'); ?>">Admin</a></li>
      <li class="breadcrumb-item active" aria-current="page">users_profile</li>
      <!--<li class="breadcrumb-item active" aria-current="page">Blank Page</li>-->
    </ol>
  </div>
  <div class="row">
    <div class="col-lg-12">
      <!-- Form Basic -->
      <div class="card mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
          <h6 class="m-0 font-weight-bold text-primary"><?=$user->name ?> Profile</h6>
        </div>
        <div class="card-body">
            <div class="form-group row">
              <label for="name" class="col-md-2">User Name</label>
              <div class="col-md-4">
                <span><?=$user->name ?></span>
              </div>
              <div class="col-md-2">
                <img src="<?=base_url('public/assets/upload/users/'.$user->image) ?>" alt="image" width="65" height="75">
              </div>
            </div>
            <div class="form-group row">
              <label for="email" class="col-md-2">Email address</label>
              <div class="col-md-10">
                <span><?=$user->email ?></span>
              </div>
            </div>
            <div class="form-group row">
              <label for="phone" class="col-md-2">Ip Address</label>
              <div class="col-md-10">
                <span><?=$user->ip_address ?></span>
              </div>
            </div>
            <div class="form-group row">
              <label for="phone" class="col-md-2">Phone</label>
              <div class="col-md-10">
                <span><?=$user->phone ?></span>
              </div>
            </div>
            <div class="form-group row">
              <label for="address" class="col-md-2">Address</label>
              <div class="col-md-10">
                <span><?=$user->address ?></span>
              </div>
            </div>
            
            <div class="form-group row">
              <label for="status" class="col-md-2">Status</label>
              <div class="col-sm-10">
                <?php if($user->status == 1)
                  echo '<span class="badge badge-success">Active</span>';
                else
                  echo '<span class="badge badge-warning">Inactive</span>';
                ?>
              </div>
            </div>
            <div class="form-group row">
              <label for="status" class="col-md-2">Privilege</label>
              <div class="col-sm-10">
                <span class="badge badge-primary"><?=$user->post_name?></span>
              </div>
            </div>
            <div class="form-group row">
              <label for="address" class="col-md-2">Created Date</label>
              <div class="col-md-10">
                <span><?=date('M d, Y', strtotime($user->created)) ?></span>
              </div>
            </div>
            <div class="form-group row">
              <label for="address" class="col-md-2">Updated Date</label>
              <div class="col-md-10">
                <?php if($user->updated != '0000-00-00 00:00:00')
                  echo '<span>'.date('M d, Y', strtotime($user->updated)).'</span>';
                else
                  echo '<span class="text-danger">Not Update</span>';
                ?>
              </div>
            </div>
            <a href="<?=base_url('/admin/users') ?>" class="btn btn-primary">Back</a>
        </div>
      </div><!-- end card -->
    </div><!-- end column -->
  </div><!-- end row -->
<?=$this->endSection()?>