<?=$this->extend("admin/_layout/master") ?>
<?=$this->section("content") ?>
<div class="container-fluid" id="container-wrapper">
  <div class="d-sm-flex align-items-center justify-content-between mb-1">
    <h1 class="h3 mb-0 text-gray-800">Course</h1>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="<?=base_url('admin'); ?>">Admin</a></li>
      <li class="breadcrumb-item" aria-current="page">add_edit_course</li>
      <!--<li class="breadcrumb-item active" aria-current="page">Blank Page</li>--> 
    </ol>
  </div>
  <div class="row">
    <div class="col-lg-8">
      <!-- Form Basic -->
      <div class="card mb-4">
        <div class="card-header py-1 d-flex flex-row align-items-center justify-content-between">
          <h6 class="m-0 font-weight-bold text-primary"><?php echo (isset($course))?'Edit Course':'Add Course'; ?></h6>
        </div>
        <div class="card-body">
            <form class="forms-sample" autocomplete="off" action="<?=current_url(); ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field(); ?>
                
                <div class="form-group">
                    <label for="course_cat">Course Category</label>
                    <select name="course_cat" id="course_cat" class="form-control">
                      <?php 
                      foreach(course_cat() as $k=>$cat){ 
                        $selected = (isset($course) && $course->course_cat == $k)?'selected':'';
                      ?>
                        <option value="<?=$k?>" <?=$selected?>><?=$cat[0]?></option>
                      <?php } ?>
                    </select>
                    <span class="text-danger"><?= isset($validation) ? display_error($validation, 'course_cat') : '' ?></span>
                </div>
                <div class="form-group">
                    <label for="c_name">Course name<span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="c_name" name="c_name" value="<?=set_value('c_name', (isset($course->c_name))?$course->c_name:''); ?>">
                    <span class="text-danger"><?= isset($validation) ? display_error($validation, 'c_name') : '' ?></span>
                </div>
                <div class="form-group">
                    <label for="c_f_name">Course Full Name<span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="c_f_name" name="c_f_name" value="<?=set_value('c_f_name', (isset($course->c_f_name))?$course->c_f_name:''); ?>">
                    <span class="text-danger"><?= isset($validation) ? display_error($validation, 'c_f_name') : '' ?></span>
                </div>
                <div class="form-group">
                    <label for="course_fee" class="">Course Fee:<span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="course_fee" name="course_fee" value="<?=set_value('course_fee',isset($course)?$course->course_fee:''); ?>">
                    <span class="text-danger"><?= isset($validation) ? display_error($validation, 'course_fee') : '' ?></span>
                </div>
                
                <div class="form-group">
                    <label for="course_duration">Course Duration<span class="text-danger">*</span></label>
                    <select name="course_duration" id="course_duration" class="form-control">
                      <option value="">Select One</option>
                      <?php for($i=1; $i<=12; $i++){
                        $true = (isset($course) && $course->course_duration == $i)?TRUE:'';
                      ?>
                        <option value="<?=$i?>" <?=set_select('course_duration', $i, $true)?>><?=($i==1)?$i.' Month':$i.' Months';?></option>
                      <?php } ?>
                      <?php //for university course
                      for($i=18; $i<=48; $i+=6){
                        $true = (isset($course) && $course->course_duration == $i)?TRUE:'';
                      ?>
                        <option value="<?=$i?>" <?=set_select('course_duration', $i, $true)?>><?=($i==1)?$i.' Month':$i.' Months';?></option>
                      <?php } ?>
                    </select>
                    <?php /* <input type="number" class="form-control" id="course_duration" name="course_duration" value="<?=set_value('course_duration', (isset($course->course_duration))?$course->course_duration:''); ?>"> */ ?>
                    <span class="text-danger"><?= isset($validation) ? display_error($validation, 'course_duration') : '' ?></span>
                </div>
                
                <div class="form-group">
                    <label for="status">Status</label>
                    <div class="form-check">
                        <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="status" id="status" value="1" checked> Active </label>
                    </div>
                    <div class="form-check">
                        <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="status" id="status2" value="0" <?=set_radio('status', 0, (isset($course->status) && $course->status == '0')?true:'')?>> Inactive </label>
                    </div>
                    <span class="text-danger"><?= isset($validation) ? display_error($validation, 'status') : '' ?></span>
                </div>
                <button type="submit" class="btn btn-primary me-2">Submit</button>
                <button type="reset" class="btn btn-info">Reset</button>
                <a href="<?=base_url('admin/course_modules')?>" class="btn btn-warning">Cancel</a>
            </form>
        </div>
      </div><!-- end card -->
    </div><!-- end column -->
  </div><!-- end row -->
<?=$this->endSection()?>