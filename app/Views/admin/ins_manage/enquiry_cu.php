<?=$this->extend("admin/_layout/master") ?>
<?=$this->section("content") ?>
<script language="Javascript" src="<?php echo base_url('editor/scripts/innovaeditor.js'); ?>"></script>
<div class="container-fluid" id="container-wrapper">
  <div class="d-sm-flex align-items-center justify-content-between mb-1">
    <h1 class="h3 mb-0 text-gray-800">Enquiry</h1>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="<?=base_url('admin'); ?>">Admin</a></li>
      <li class="breadcrumb-item" aria-current="page">add_edit_enquiry</li>
      <!--<li class="breadcrumb-item active" aria-current="page">Blank Page</li>-->
    </ol>
  </div>
  <div class="row">
    <div class="col-lg-8">
      <!-- Form Basic -->
      <div class="card mb-4">
        <div class="card-header py-1 d-flex flex-row align-items-center justify-content-between">
          <h6 class="m-0 font-weight-bold text-primary"><?php echo (isset($cms))?'Edit Enquiry':'Add Enquiry'; ?></h6>
        </div>
        <div class="card-body">
            <form class="forms-sample" autocomplete="off" action="<?=current_url(); ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field(); ?>
                <div class="form-group">
                    <label for="c_name">Candidate Name</label>
                    <input type="text" class="form-control" id="c_name" name="c_name" value="<?=set_value('c_name', (isset($cms->c_name))?$cms->c_name:''); ?>">
                    <span class="text-danger"><?= isset($validation) ? display_error($validation, 'c_name') : '' ?></span>
                </div>
                <div class="form-group">
                    <label for="phone1">Mobile No</label>
                    <input class="form-control" type="text" id="phone1" name="phone1" value="<?=(isset($cms->phone1))?$cms->phone1:set_value('phone1'); ?>">
                    <span class="text-danger"><?= isset($validation) ? display_error($validation, 'phone1') : '' ?></span>
                </div>
                <div class="form-group">
                    <label for="address">Address</label>
                    <input class="form-control" type="text" id="address" name="address" value="<?=(isset($cms->address))?$cms->address:set_value('address'); ?>">
                    <span class="text-danger"><?= isset($validation) ? display_error($validation, 'address') : '' ?></span>
                </div>
                <div class="form-group">
                    <label for="course_for">Course For</label>
                    <select name="course_for" id="course_for" class="form-control">
                        <option value="">Select One</option>
                        <?php if(!empty($courses)){
                        foreach($courses as $list){ 
                            $selected = '';
                            if(isset($cms) && $cms->course_for == $list->course_id){
                                $selected = 'selected';
                            } ?>
                            <option value="<?=$list->course_id?>" <?=set_select('course_for', $list->course_id).' '.$selected?> ><?=$list->course_full_name?></option>
                        <?php } } ?>
                        
                    </select>
                    <span class="text-danger"><?= isset($validation) ? display_error($validation, 'course_for') : '' ?></span>
                </div>
                <div class="form-group">
                    <label for="ref_by">Refrence By</label>
                    <select name="ref_by" id="ref_by" class="form-control">
                        <option value="">Select One</option>
                        <option value="Social Media" <?=(isset($cms) && $cms->ref_by == 'Social Media')?'selected':set_select('ref_by', 'Social Media')?>>Social Media</option>
                        <option value="Postar Banner" <?=(isset($cms) && $cms->ref_by == 'Postar Banner')?'selected':set_select('ref_by', 'Postar Banner')?>>Postar Banner</option>
                        <option value="other" <?=(isset($cms) && $cms->ref_by == 'other')?'selected':set_select('ref_by', 'other')?>>Other</option>
                        
                    </select>
                    <span class="text-danger"><?= isset($validation) ? display_error($validation, 'ref_by') : '' ?></span>
                </div>
                <div class="form-group">
                    <label for="refree_name">Refree Name (<span class="text-danger">if other</span>)</label>
                    <input class="form-control" type="text" id="refree_name" name="refree_name" value="<?=(isset($cms->refree_name))?$cms->refree_name:set_value('refree_name'); ?>">
                    <span class="text-danger"><?= isset($validation) ? display_error($validation, 'refree_name') : '' ?></span>
                </div>
                <div class="form-group">
                    <label for="comment">Comment</label>
                    <textarea name="comment" id="comment" rows="4" class="form-control"><?=(isset($cms->comment))?$cms->comment:set_value('comment'); ?></textarea>
                </div>
                <input type="hidden" name="status" value="<?=(isset($cms))?$cms->status:1?>">
                <?php /* 
                <div class="form-group">
                    <label for="status">Status</label>
                    <div class="form-check">
                        <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="status" id="status" value="1" <?=set_radio('status', 1, (isset($cms->status) && $cms->status == '1')?true:'')?>> Active </label>
                    </div>
                    <div class="form-check">
                        <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="status" id="status2" value="0" <?=set_radio('status', 0, (isset($cms->status) && $cms->status == '0')?true:'')?>> Inactive </label>
                    </div>
                    <span class="text-danger"><?= isset($validation) ? display_error($validation, 'status') : '' ?></span>
                </div>
                */ ?>
                <button type="submit" class="btn btn-primary me-2">Submit</button>
                <button type="reset" class="btn btn-info">Reset</button>
                <a href="<?=base_url('admin/enquiry')?>" class="btn btn-warning">Cancel</a>
            </form>
        </div>
      </div><!-- end card -->
    </div><!-- end column -->
  </div><!-- end row -->
<?=$this->endSection()?>