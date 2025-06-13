<?=$this->extend("admin/_layout/master") ?>
<?=$this->section("content") ?>
<div class="container-fluid" id="container-wrapper">
  <div class="d-sm-flex align-items-center justify-content-between mb-1">
    <h1 class="h3 mb-0 text-gray-800"><?=$course->c_f_name.' ('.$course->c_name.')'?></h1>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="<?=base_url('admin'); ?>">Admin</a></li>
      <li class="breadcrumb-item" aria-current="page">add_edit_course</li>
      <!--<li class="breadcrumb-item active" aria-current="page">Blank Page</li>-->
    </ol>
  </div>
  <div class="row">
    <div class="col-lg-12">
        <?php if(session()->getFlashdata('message') !== NULL){
            echo alertBS(session()->getFlashdata('message'),session()->getFlashdata('type'));
        } ?>
      <!-- Form Basic -->
      <div class="card mb-4">
        <div class="card-header py-1 d-flex flex-row align-items-center justify-content-between">
          <h6 class="m-0 font-weight-bold text-primary">Module List</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered align-items-center table-flush table-hover" id="dataTableHover">
                    <thead class="thead-light">
                        <tr>
                            <th>#</th>
                            <th>Module Name</th>
                            <?php if($course->course_cat == 'C'){ 
                                echo '<th>Full Marks</th>';
                            } ?>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(!empty($modules)){ 
                            $sn = 1;
                            foreach($modules as $list){  
                            if($list->status == 1){
                                $status = '<span class="badge badge-success">Active</span>'; 
                            }else{
                                $status = '<span class="badge badge-warning">Inactive</span>';
                            }  ?>
                            <tr>
                                <td><?=$sn++; ?></td>
                                <td><?=$list->module_name; ?></td>
                                <?php if($course->course_cat == 'C'){
                                    echo '<td>'.$list->full_marks.'</td>';
                                } ?>
                                <td><?=$status?></td>
                                <td><a href="<?= base_url('/admin/modules/'.$course->cid.'/'.$list->id) ?>" class="btn btn-outline-info" role="button" title="Edit"><i class="fas fa-edit"></i></a></td>
                            </tr>
                        <?php }
                        } ?>
                    </tbody>
                </table>
            </div>
        </div>
      </div><!-- end card -->
    </div><!-- end column -->

    <div class="col-lg-8">
        <div class="card mb-4">
            <div class="card-header py-1 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary"><?=(isset($singleModule))?'Edit ':'Add '?>Module</h6>
            </div>
            <div class="card-body">
                <form class="forms-sample" autocomplete="off" action="<?=current_url(); ?>" method="post" enctype="multipart/form-data">
                    <?= csrf_field(); ?>
                    
                    <div class="form-group">
                        <label for="module_name">Module name</label>
                        <input type="text" class="form-control" id="module_name" name="module_name" value="<?=set_value('module_name', (isset($singleModule->module_name))?$singleModule->module_name:''); ?>">
                        <span class="text-danger"><?= isset($validation) ? display_error($validation, 'module_name') : '' ?></span>
                    </div>
                    <?php if($course->course_cat == 'C'){ ?>
                    <div class="form-group">
                        <label for="full_marks">Full Marks</label>
                        <input type="text" class="form-control" id="full_marks" name="full_marks" value="<?=set_value('full_marks', (isset($singleModule->full_marks))?$singleModule->full_marks:''); ?>">
                        <span class="text-danger"><?= isset($validation) ? display_error($validation, 'full_marks') : '' ?></span>
                    </div>
                    <?php } ?>
                    
                    <div class="form-group">
                        <label for="status">Status</label>
                        <div class="form-check">
                            <label class="form-check-label">
                            <input type="radio" class="form-check-input" name="status" id="status" value="1" checked> Active </label>
                        </div>
                        <div class="form-check">
                            <label class="form-check-label">
                            <input type="radio" class="form-check-input" name="status" id="status2" value="0" <?=set_radio('status', 0, (isset($singleModule->status) && $singleModule->status == '0')?true:'')?>> Inactive </label>
                        </div>
                        <span class="text-danger"><?= isset($validation) ? display_error($validation, 'status') : '' ?></span>
                    </div>
                    <button type="submit" class="btn btn-primary me-2">Submit</button>
                    <a href="<?=base_url('admin/modules/'.$course->cid)?>" class="btn btn-info">Reset</a>
                    <a href="<?=base_url('admin/course_modules')?>" class="btn btn-warning">Cancel</a>
                </form>
            </div>
        </div>
    </div>

  </div><!-- end row -->
<?=$this->endSection()?>