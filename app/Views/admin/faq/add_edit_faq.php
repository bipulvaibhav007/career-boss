<?=$this->extend("admin/_layout/master") ?>
<?=$this->section("content") ?>
<div class="container-fluid" id="container-wrapper">
  <div class="d-sm-flex align-items-center justify-content-between mb-1">
    <h1 class="h3 mb-0 text-gray-800">FAQ</h1>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="<?=base_url('admin'); ?>">Admin</a></li>
      <li class="breadcrumb-item" aria-current="page">add_edit_faq</li>
      <!--<li class="breadcrumb-item active" aria-current="page">Blank Page</li>-->
    </ol>
  </div>
  <div class="row">
    <div class="col-lg-8">
      <!-- Form Basic -->
      <div class="card mb-4">
        <div class="card-header py-1 d-flex flex-row align-items-center justify-content-between">
          <h6 class="m-0 font-weight-bold text-primary"><?php echo (isset($faq))?'Edit Faq':'Add Faq'; ?></h6>
        </div>
        <div class="card-body">
            <form class="forms-sample" autocomplete="off" action="<?=current_url(); ?>" method="post" enctype="multipart/form-data">
            <?= csrf_field(); ?>
                <div class="form-group">
                  <label for="faq_for">Faq For</label>
                  <select name="faq_for" id="faq_for" class="form-control">
                    <option value="">Select One</option>
                    <?php if(!empty($pages)){
                      foreach($pages as $list){
                        $true = '';
                        if(isset($faq->faq_for) && $faq->faq_for == $list->id){
                          $true = true;
                        }
                        echo '<option value="'.$list->id.'" '.set_select('faq_for', $list->id, $true).'>'.$list->page_name.'</option>';
                      }
                    } ?>
                  </select>
                  <span class="text-danger"><?= isset($validation) ? display_error($validation, 'faq_for') : '' ?></span>

                </div>

                <div class="form-group">
                    <label for="faq_title">Faq Title</label>
                    <input type="text" class="form-control" id="faq_title" name="faq_title" value="<?=(isset($faq->faq_title))?$faq->faq_title:set_value('faq_title'); ?>">
                    <span class="text-danger"><?= isset($validation) ? display_error($validation, 'faq_title') : '' ?></span>
                </div>
                <div class="form-group">
                    <label for="faq_description">Faq Description</label>
                    <textarea class="form-control" id="faq_description" name="faq_description" rows="7" cols="50"><?=(isset($faq->faq_description))?$faq->faq_description:set_value('faq_description'); ?></textarea>
                    <span class="text-danger"><?= isset($validation) ? display_error($validation, 'faq_description') : '' ?></span>
                </div>
                
                <div class="form-group">
                    <label for="faq_status">Status</label>
                    <div class="form-check">
                        <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="faq_status" id="faq_status" value="1" <?=set_radio('faq_status', 1, (isset($faq->faq_status) && $faq->faq_status == '1')?true:'')?>> Active </label>
                    </div>
                    <div class="form-check">
                        <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="faq_status" id="faq_status2" value="0" <?=set_radio('faq_status', 0, (isset($faq->faq_status) && $faq->faq_status == '0')?true:'')?>> Inactive </label>
                    </div>
                    <span class="text-danger"><?= isset($validation) ? display_error($validation, 'faq_status') : '' ?></span>
                </div>
                <button type="submit" class="btn btn-primary me-2">Submit</button>
                <button type="reset" class="btn btn-info">Reset</button>
                <a href="<?=base_url('admin/faq')?>" class="btn btn-warning">Cancel</a>
            </form>
        </div>
      </div><!-- end card -->
    </div><!-- end column -->
  </div><!-- end row -->
<?=$this->endSection()?>