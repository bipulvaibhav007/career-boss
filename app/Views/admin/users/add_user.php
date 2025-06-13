<?=$this->extend("admin/_layout/master") ?>
<?=$this->section("content") ?>
<div class="container-fluid" id="container-wrapper">
  <div class="d-sm-flex align-items-center justify-content-between mb-1">
    <h1 class="h3 mb-0 text-gray-800">Users</h1>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="<?=base_url('admin'); ?>">Admin</a></li>
      <li class="breadcrumb-item" aria-current="page">add_user</li>
      <!--<li class="breadcrumb-item active" aria-current="page">Blank Page</li>-->
    </ol>
  </div>
  <div class="row">
    <div class="col-lg-12">
      <!-- Form Basic -->
      <div class="card mb-4">
        <div class="card-header py-1 d-flex flex-row align-items-center justify-content-between">
          <h6 class="m-0 font-weight-bold text-primary">Add User</h6>
        </div>
        <div class="card-body">
          <form autocomplete="off" action="<?=current_url(); ?>" method="post" enctype="multipart/form-data">
            <?= csrf_field(); ?>
            <div class="form-group row">
              <label for="name" class="col-md-2">User Name</label>
              <div class="col-md-10">
                <input type="text" class="form-control" id="name" name="name" value="<?=set_value('name'); ?>" placeholder="Enter Username">
               <span class="text-danger"><?= isset($validation) ? display_error($validation, 'name') : '' ?></span>  
              </div>
            </div>
            <div class="form-group row">
              <label for="email" class="col-md-2">Email address</label>
              <div class="col-md-10">
                <input type="email" class="form-control" id="email" name="email" value="<?=set_value('email'); ?>" placeholder="Enter email">
                <span class="text-danger"><?= isset($validation) ? display_error($validation, 'email') : '' ?></span>  
              </div>
            </div>
            <div class="form-group row">
              <label for="password" class="col-sm-2">Password</label>
              <div class="col-sm-4">
                <input type="password" class="form-control" id="password" name="password" value="<?=set_value('password'); ?>" placeholder="Password">
                <span class="text-danger"><?= isset($validation) ? display_error($validation, 'password') : '' ?></span>  
              </div>
              <label for="cpassword" class="col-sm-2">Confirm Password</label>
              <div class="col-sm-4">
                <input type="password" class="form-control" id="cpassword" name="cpassword" value="<?=set_value('cpassword'); ?>" placeholder="Confirm Password">
                <span class="text-danger"><?= isset($validation) ? display_error($validation, 'cpassword') : '' ?></span>  
              </div>
            </div>
            <div class="form-group row">
              <label for="phone" class="col-md-2">Phone</label>
              <div class="col-md-10">
                <input type="tel" class="form-control" id="phone" name="phone" value="<?=set_value('phone'); ?>" placeholder="Enter Phone Number">
                <span class="text-danger"><?= isset($validation) ? display_error($validation, 'phone') : '' ?></span>  
              </div>
            </div>
            <div class="form-group row">
              <label for="address" class="col-md-2">Address</label>
              <div class="col-md-10">
                <input type="text" class="form-control" id="address" name="address" value="<?=set_value('address'); ?>" placeholder="Enter Address">
                <span class="text-danger"><?= isset($validation) ? display_error($validation, 'address') : '' ?></span>  
              </div>
            </div>
            <div class="form-group row">
              <label for="image" class="col-md-2">Profile Image</label>
              <div class="col-md-10">
                <input type="file" class="form-control" id="image" name="image">
               <span class="text-danger"><?= isset($validation) ? display_error($validation, 'image') : '' ?></span>  
              </div>
            </div>

            <div class="form-group row">
              <label for="image" class="col-md-2">Privilege</label>
              <div class="col-md-10">
                <select name="privilege_id" id="privilege_id" class="form-control">
                    <option value="">Select Privilege</option>
                    <?php if(!empty($rolePrivilege)){
                        foreach($rolePrivilege as $list){ ?>
                        <option value="<?=$list->privilege_id?>" <?=set_select('privilege_id', $list->privilege_id)?>><?=$list->post_name?></option>
                    <?php }
                    } ?>
                </select>
               <span class="text-danger"><?= isset($validation) ? display_error($validation, 'privilege_id') : '' ?></span>  
              </div>
            </div>

            <div class="form-group row">
              <label for="status" class="col-md-2">Status</label>
              <div class="col-sm-10">
                <div class="custom-control custom-radio">
                  <input type="radio" id="status" name="status" value="1" class="custom-control-input" <?=set_radio('status', 1)?>>
                  <label class="custom-control-label" for="status">Active</label>
                </div>
                <div class="custom-control custom-radio">
                  <input type="radio" id="status2" name="status" value="0" class="custom-control-input" <?=set_radio('status', 0)?>>
                  <label class="custom-control-label" for="status2">Inactive</label>
                </div>
                <span class="text-danger"><?= isset($validation) ? display_error($validation, 'status') : '' ?></span>  
              </div>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
            <button type="reset" class="btn btn-info">Reset</button>
            <a href="<?=base_url('admin/users')?>" class="btn btn-warning">Cancel</a>
          </form>
        </div>
      </div><!-- end card -->
    </div><!-- end column -->
  </div><!-- end row -->
<?=$this->endSection()?>