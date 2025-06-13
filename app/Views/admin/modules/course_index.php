<?=$this->extend("admin/_layout/master") ?>
<?=$this->section("content") ?>
  <!-- Container Fluid-->
  <div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-1">
      <h1 class="h3 mb-0 text-gray-800">Courses & Modules</h1>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?=base_url('admin'); ?>">Admin</a></li>
        <li class="breadcrumb-item active" aria-current="page">modules</li>
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
            <?php if(is_privilege(25,2)){ ?>
                <a href="<?=base_url('admin/course_cu')?>" class="btn btn-primary">Add Course</a>
            <?php } ?>
            <?php if(is_privilege(25,4)){ ?>
                <button type="button" class="btn btn-danger" id="Change_Status" disabled>Change Status</a>
            <?php } ?>
          </div>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table align-items-center table-flush table-hover" id="dataTableHover">
              <thead class="thead-light">
                <tr>
                    <th>#</th>
                    <th>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="CheckAll">
                            <label class="form-check-label" for="CheckAll"> Check All</label>
                        </div>
                    </th>
                    <th>Course Name</th>
                    <th>Full Course Name</th>
                    <th>Course<br>Category</th>
                    <th>Course Fee</th>
                    <th>Course Duration</th>
                    <th>Total Module</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                <?php if(!empty($courses)){
                    $commonmodel = model('App\Models\Common_model', false);
                    $sn=1;
                    foreach($courses as $list){ 
                    if($list->status == 1){
                        $status = '<span class="badge badge-success">Active</span>'; 
                    }else{
                        $status = '<span class="badge badge-warning">Inactive</span>';
                    }  
                    
                    ?>
                    <tr>
                        <td><?=$sn++?></td>
                        <td>
                            <div class="form-check">
                                <input class="form-check-input" name="checkedIds[]" type="checkbox" value="<?=$list->cid?>" id="Check<?=$list->cid?>">
                                <label class="form-check-label" for="Check<?=$list->cid?>"></label>
                            </div>
                        </td>
                        <td><?=$list->c_name?></td>
                        <td><?=$list->c_f_name?></td>
                        <td><?=get_course_cat($list->course_cat)?></td>
                        <td><?=($list->course_fee != '')?number_format($list->course_fee):'--' ?></td>
                        <td><?=($list->course_duration == 1)?$list->course_duration.' Month':$list->course_duration.' Months'; ?></td>
                        <td>
                            <?php $allModule = $commonmodel->getAllRecord('tbl_module',['cid'=>$list->cid]);
                            echo count($allModule); ?> 
                        </td>
                        <td><?=$status?></td>
                        <td>
                            <?php if(is_privilege(25,3)){ ?>
                            <a href="<?= base_url('/admin/course_cu/'.$list->cid) ?>" class="mt-2 btn btn-outline-info" role="button" title="Edit"><i class="fas fa-edit"></i></a>
                            <?php } if(is_privilege(25,5)){ 
                            if($list->course_cat == 'C' || $list->course_cat == 'T') {
                            ?>
                            <a href="<?= base_url('/admin/modules/'.$list->cid) ?>" class="mt-2 btn btn-outline-info" role="button" title="Modules"><i class="fa fa-list-alt"></i></a>
                            <?php } }?>
                        </td>
                    </tr>
                    <?php } } else { ?>
                        <tr><td colspan="6" class="text-danger text-center">No Data Available</td></tr>
                    <?php } ?>
                </tbody>
             </table>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!---Container Fluid-->

<!-- Modal -->
<div class="modal fade" id="changestatusModal" tabindex="-1" role="dialog" aria-labelledby="changestatusModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header bg-primary">
          <h5 class="modal-title text-light" id="changestatusModalLabel">Change Status</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="<?=current_url();?>" method="post" >
        <?=csrf_field(); ?>
        <input type="hidden" name="ids" value="" id="ids">
        <input type="hidden" name="submit" value="changeStatus" id="changeStatus">
        <div class="modal-body">
          <!-- <div class="form-group row">
              <label for="stu_name" class="col-md-2">Name: </label>
              <div class="col-md-10">
                <p><strong id="stu_name"></strong></p>
              </div>
          </div> -->
          <div class="form-group row">
              <label for="status" class="col-md-2">Status: </label>
              <div class="col-md-10 ">
                <select name="status" id="status" class="form-control">
                  <option value="1" >Active</option>
                  <option value="0">Inactive</option>
                </select>
                <span class="text-danger" id="frst_statusErr"></span>
              </div>
          </div>
          <?php /* <div class="form-group row">
              <label for="stu_name" class="col-md-2">Description: </label>
              <div class="col-md-10 ">
                <input type="text" name="description" id="description" class="form-control" value="">
              </div>
          </div> */ ?>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>
        </form>
      </div>
    </div>
</div>




  <script>
    $("#CheckAll").click(function() {
      $("input:checkbox[name='checkedIds[]']").prop("checked", $(this).prop("checked"));
      disable_enable_btn();
    });

    $("input:checkbox[name='checkedIds[]']").click(function() {
      if (!$(this).prop("checked")) {
        $("#CheckAll").prop("checked", false);
      }
      disable_enable_btn();
    });
    function disable_enable_btn(){
      var checked = $('input[name="checkedIds[]"]:checked').length;
      if(checked >= 1){
        $('#Change_Status').removeAttr('disabled');
      }else{
        $('#Change_Status').attr('disabled', true);
      }
    }
    $("#Change_Status").click(function () {
      var checkedIds = [];
      $('input[name="checkedIds[]"]:checked').each(function (){
        checkedIds.push($(this).val());
      });
      $("#ids").val(checkedIds);

      $("#changestatusModal").modal("show");
    });
  </script>
<?=$this->endSection()?>
  