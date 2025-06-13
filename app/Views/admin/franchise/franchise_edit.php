<?=$this->extend("admin/_layout/master") ?>
<?=$this->section("content") ?>
<div class="container-fluid" id="container-wrapper">
  <div class="d-sm-flex align-items-center justify-content-between mb-1">
    <h1 class="h3 mb-0 text-gray-800">Franchise</h1>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="<?=base_url('admin'); ?>">Admin</a></li>
      <li class="breadcrumb-item" aria-current="page">franchise_CU</li>
      <!--<li class="breadcrumb-item active" aria-current="page">Blank Page</li>-->
    </ol>
  </div>
  <div class="row">
    <div class="col-lg-12">
      <!-- Form Basic -->
      <div class="card mb-4">
        <div class="card-header py-1 d-flex flex-row align-items-center justify-content-between">
          <h6 class="m-0 font-weight-bold text-primary">Edit Franchise</h6>
        </div>
        <div class="card-body">
       
          <form autocomplete="off" action="<?=current_url(); ?>" method="post" enctype="multipart/form-data">
            <?= csrf_field(); ?>
            <div class="form-group row">
              <label for="m_full_name" class="col-md-2">Name<span class="text-danger">*</span></label>
              <div class="col-md-8">
                <input type="text" class="form-control" id="m_full_name" name="m_full_name" value="<?=set_value('m_full_name', $memberDtls->m_full_name); ?>">
               <span class="text-danger"><?= isset($validation) ? display_error($validation, 'm_full_name') : '' ?></span>  
              </div>
            </div>
            <div class="form-group row">
              <label for="email" class="col-md-2">Email<span class="text-danger">*</span> </label>
              <div class="col-md-8">
                <input type="email" class="form-control" id="email" name="email" value="<?=set_value('email', $memberDtls->email); ?>">
                <span class="text-danger"><?= isset($validation) ? display_error($validation, 'email') : '' ?></span>  
              </div>
            </div>
            <?php /* <div class="form-group row">
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
            </div>*/ ?>
            <div class="form-group row">
              <label for="phone" class="col-md-2">Phone<span class="text-danger">*</span></label>
              <div class="col-md-8">
                <input type="tel" class="form-control" id="phone" name="phone" value="<?=set_value('phone', $memberDtls->phone); ?>">
                <span class="text-danger"><?= isset($validation) ? display_error($validation, 'phone') : '' ?></span>  
              </div>
            </div>
            <div class="form-group row">
              <label for="address" class="col-md-2">Address<span class="text-danger">*</span></label>
              <div class="col-md-8">
                <input type="text" class="form-control" id="address" name="address" value="<?=set_value('address', $memberDtls->address); ?>">
                <span class="text-danger"><?= isset($validation) ? display_error($validation, 'address') : '' ?></span>  
              </div>
            </div>
            <div class="form-group row">
              <label for="center_name" class="col-md-2">Center Name</label>
              <div class="col-md-8">
                <input type="text" class="form-control" id="center_name" name="center_name" value="<?=set_value('center_name', $memberDtls->center_name); ?>">
                <span class="text-danger"><?= isset($validation) ? display_error($validation, 'center_name') : '' ?></span>  
              </div>
            </div>
            <div class="form-group row">
              <label for="center_address" class="col-md-2">Center Address</label>
              <div class="col-md-8">
                <input type="text" class="form-control" id="center_address" name="center_address" value="<?=set_value('center_address', $memberDtls->center_address); ?>">
                <span class="text-danger"><?= isset($validation) ? display_error($validation, 'center_address') : '' ?></span>  
              </div>
            </div>
            <div class="form-group row">
              <label for="reg_fee" class="col-md-2">Reg. Fee/Student</label>
              <div class="col-md-8">
                <input type="number" class="form-control" id="reg_fee" name="reg_fee" value="<?=set_value('reg_fee', $memberDtls->reg_fee); ?>">
                <span class="text-danger"><?= isset($validation) ? display_error($validation, 'reg_fee') : '' ?></span>  
              </div>
            </div>
            <?php /* <div class="form-group row">
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
            </div>*/ ?>

            <div class="form-group row">
              <label for="status" class="col-md-2">Status<span class="text-danger">*</span></label>
              <div class="col-sm-10">
                <div class="custom-control custom-radio">
                  <input type="radio" id="status" name="status" value="1" class="custom-control-input" <?=set_radio('status', 1, ($memberDtls->status == 1)?TRUE:'')?>>
                  <label class="custom-control-label" for="status">Active</label>
                </div>
                <div class="custom-control custom-radio">
                  <input type="radio" id="status2" name="status" value="0" class="custom-control-input" <?=set_radio('status', 0, ($memberDtls->status < 1)?TRUE:'')?>>
                  <label class="custom-control-label" for="status2">Inactive</label>
                </div>
                <span class="text-danger"><?= isset($validation) ? display_error($validation, 'status') : '' ?></span>  
              </div>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
            <button type="reset" class="btn btn-info">Reset</button>
            <a href="<?=base_url('admin/franchise')?>" class="btn btn-warning">Cancel</a>
          </form>
        </div>
      </div><!-- end card -->
    </div><!-- end column -->
  </div><!-- end row -->

    
<?=$this->endSection()?>