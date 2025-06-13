<?=$this->extend("admin/_layout/master") ?>
<?=$this->section("content") ?>
  <!-- Container Fluid-->
  <div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-1">
      <h1 class="h3 mb-0 text-gray-800">Courses</h1>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?=base_url('admin'); ?>">Admin</a></li>
        <li class="breadcrumb-item active" aria-current="page">courses</li>
      </ol>
    </div>
    
    <div class="row mb-3">
      <!-- Datatables -->
    <div class="col-lg-12">
      <?php if(session()->getFlashdata('message') !== NULL){
        echo alertBS(session()->getFlashdata('message'),session()->getFlashdata('type'));
      } ?>
      <div class="card mb-1">
        <div class="card-header py-1 d-flex flex-row align-items-center justify-content-between">
          <h6 class="m-0 font-weight-bold text-primary">Course List</h6>
          <div class="dropdown no-arrow">
            <?php if(is_privilege(12,2)){ ?>
            <a href="<?=base_url('admin/add_edit_course')?>" class="btn btn-primary">Add Course</a>
            <?php } ?>
          </div>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table align-items-center table-flush table-hover" id="dataTableHover">
              <thead class="thead-light">
                <tr>
                    <th>#</th>
                    <th>Course Name</th>
                    <th>Course Duration</th>
                    <th>Image</th>
                    <!-- <th>Cms Banner</th> -->
                    <!--<th>Description1</th>-->
                    <th>Status</th>
                    <th>Action</th>
                </tr>
              </thead>
                <tbody>
                <?php if(!empty($courses)){
                    $sn=1;
                    foreach($courses as $list){ 
                    if($list->status == '1'){
                        $status = '<span class="badge badge-success">Active</span>'; 
                    }else{
                        $status = '<span class="badge badge-warning">Inactive</span>';
                    }    
                    ?>
                    <tr>
                        <td><?=$sn++?></td>
                        
                        <td><?=$list->course_full_name?></td>
                        <td><?php echo $list->prg_duration_line1?></td>
                        <td>
                            <img class="img-thumbnail" src="<?=base_url('public/assets/upload/images/'.$list->image) ?>" width="70px" height="70px"/>
                        </td>
                        
                        <td><?=$status?></td>
                        <td>
                            <?php if(is_privilege(12,3)){ ?>
                            <a href="<?= base_url('/admin/add_edit_course/'.$list->course_id) ?>" class="btn btn-outline-info" role="button" title="Edit"><i class="fas fa-edit"></i></a>
                            <?php }if(is_privilege(12,4)){ ?>
                            <a href="<?= base_url('/admin/delete_course/'.$list->course_id) ?>" onclick="return confirm('Are you sure?')" class="btn btn-outline-info" role="button" style="color:red" title="Delete"><i class="fas fa-trash"></i></a>
                            <?php } ?>
                        </td>
                    </tr>
                    <?php } } else { ?>
                        <tr><td colspan="3">No Data Available</td></tr>
                    <?php } ?>
                </tbody>
             </table>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!---Container Fluid-->
<?=$this->endSection()?>
  