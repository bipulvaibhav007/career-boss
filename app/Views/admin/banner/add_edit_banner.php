<?=$this->extend("admin/_layout/master") ?>
<?=$this->section("content") ?>
<div class="container-fluid" id="container-wrapper">
  <div class="d-sm-flex align-items-center justify-content-between mb-1">
    <h1 class="h3 mb-0 text-gray-800">Banners</h1>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="<?=base_url('admin'); ?>">Admin</a></li>
      <li class="breadcrumb-item" aria-current="page">add_edit_banner</li>
      <!--<li class="breadcrumb-item active" aria-current="page">Blank Page</li>-->
    </ol>
  </div>
  <div class="row">
    <div class="col-lg-12">
      <!-- Form Basic -->
      <div class="card mb-4">
        <div class="card-header py-1 d-flex flex-row align-items-center justify-content-between">
          <h6 class="m-0 font-weight-bold text-primary"><?php echo (isset($banner))?'Edit Banner':'Add Banner'; ?></h6>
        </div>
        <div class="card-body">
            <form class="forms-sample" autocomplete="off" action="<?=current_url(); ?>" method="post" enctype="multipart/form-data">
            <?= csrf_field(); ?>
                <div class="form-group">
                    <label for="page">Page For</label>
                    <select class="form-control" name="page" id="page">
                        <option value="">Select Page</option>
                        <?php if($pages){ 
                            foreach($pages as $value) { 
                            $true = (isset($banner->page) && $banner->page == $value->id)?true:''?>
                            <option value="<?=$value->id ?>" <?=set_select('page', $value->id, $true)?>><?=$value->page_name ?></option>
                        <?php  }  } ?>
                    </select>
                    <span class="text-danger"><?= isset($validation) ? display_error($validation, 'page') : '' ?></span>
                </div>
                <div class="form-group">
                    <label for="main_title">Banner Title</label>
                    <input type="text" class="form-control" id="main_title" name="main_title" value="<?=(isset($banner->main_title))?$banner->main_title:set_value('main_title'); ?>">
                    <span class="text-danger"><?= isset($validation) ? display_error($validation, 'main_title') : '' ?></span>
                </div>
                <div class="form-group">
                    <label for="sub_title">Banner Sub Title</label>
                    <input type="text" class="form-control" id="sub_title" name="sub_title" value="<?=(isset($banner->sub_title))?$banner->sub_title:set_value('sub_title'); ?>">
                    <span class="text-danger"><?= isset($validation) ? display_error($validation, 'sub_title') : '' ?></span>
                </div>
                <div class="form-group row">
                    <div class="col-md-6">
                        <label for="banner_url">Banner URL <span class="text-danger">(Enter Full URL otherwise Blank)</span></label>
                        <input type="text" class="form-control" id="banner_url" name="banner_url" value="<?=(isset($banner->url))?$banner->url:set_value('banner_url'); ?>">
                        <span class="text-danger"><?= isset($validation) ? display_error($validation, 'banner_url') : '' ?></span>
                    </div>
                    <div class="col-md-6">
                        <label for="button_title">Button Title </label>
                        <input type="text" class="form-control" id="button_title" name="button_title" value="<?=(isset($banner->button_title))?$banner->button_title:set_value('button_title'); ?>">
                        <span class="text-danger"><?= isset($validation) ? display_error($validation, 'button_title') : '' ?></span>
                    </div>
                </div>
                <div class="row">
                    <?php if(isset($banner->brochure) && $banner->brochure != ''){ ?>
                        <div class="col-md-6">
                            <img src="<?=base_url('public/assets/upload/images/'.$banner->brochure) ?>" width="150px" height="80px" />
                        </div>
                    <?php } ?>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Image</label>
                            <input type="file" class="form-control" id="brochure" name="brochure">
                            <span class="text-danger"><?= isset($validation) ? display_error($validation, 'brochure') : '' ?></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Alt Text for Image</label>
                            <input type="text" name="img_alt" id="img_alt" class="form-control" value="<?=(isset($banner->img_alt))?$banner->img_alt:set_value('img_alt'); ?>">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Title Text for Image</label>
                            <input type="text" name="img_title" id="img_title" class="form-control" value="<?=(isset($banner->img_title))?$banner->img_title:set_value('img_title'); ?>">
                        </div>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="status">Status</label>
                    <div class="form-check">
                        <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="status" id="status" value="1" <?=set_radio('status', 1, (isset($banner->status) && $banner->status == '1')?true:'')?>> Active </label>
                    </div>
                    <div class="form-check">
                        <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="status" id="status2" value="0" <?=set_radio('status', 0, (isset($banner->status) && $banner->status == '0')?true:'')?>> Inactive </label>
                    </div>
                    <span class="text-danger"><?= isset($validation) ? display_error($validation, 'status') : '' ?></span>
                </div>
                <button type="submit" class="btn btn-primary me-2">Submit</button>
                <button type="reset" class="btn btn-info">Reset</button>
                <a href="<?=base_url('admin/banner')?>" class="btn btn-warning">Cancel</a>
            </form>
        </div>
      </div><!-- end card -->
    </div><!-- end column -->
  </div><!-- end row -->
<?=$this->endSection()?>