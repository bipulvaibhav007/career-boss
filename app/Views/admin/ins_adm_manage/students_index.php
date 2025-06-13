<?=$this->extend("admin/_layout/master") ?>
<?=$this->section("content") ?>
  <!-- Container Fluid-->
  <div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between my-3">
        <h1 class="h3 mb-0 text-gray-800"><?=$page_title.' ('.$count_list.')';?></h1>
        <div class="">
        <?php if(is_privilege(29,2)){ ?>
            <a href="<?=base_url('institute/student_cu')?>" class="btn btn-primary">Add Students</a>
        <?php } ?>
        <a href="<?=base_url('institute/admission_cancelation_list')?>" class="btn btn-danger">Admission Cancelation List</a>
        <a href="javascript:void(0)" class="btn btn-info" style="background-image: linear-gradient(to right, #008000 0%, black  51%,  #008000  100%);" id="i_card" >I-Card</a>
        </div>
    </div>
    
    <div class="row mb-3">
      <!-- Datatables -->
    <div class="col-lg-12">
      <?php if(session()->getFlashdata('message') !== NULL){
        echo alertBS(session()->getFlashdata('message'),session()->getFlashdata('type'));
      } ?>
      <div class="card mb-1">
        <div class="card-header py-2">
            <form action="<?=base_url('institute/students')?>" method="get" id="stusearch">
                <div class="row">
                    <div class="col-md-3">
                        <input type="text" class="form-control" name="s" placeholder="Student Name, Phone, Email" value="<?=(isset($_GET['s']))?$_GET['s']:''; ?>" title="Student Name, Phone, Email">
                    </div>
                    <div class="col-md-3">
                        <select name="batch[]" id="batch_id" class="form-control" multiple>
                        <?php if(!empty($batches)){
                            foreach($batches as $batch){ 
                                $selected = '';
                                if(isset($_GET['batch']) && !empty($_GET['batch']) && in_array($batch->batch_id, $_GET['batch'])){
                                $selected = 'selected';
                                } ?>
                            <option value="<?=$batch->batch_id?>" <?=$selected?>><?=$batch->batch_name?></option>
                        <?php }
                        } ?>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <select name="course[]" id="course_id" class="form-control" multiple>
                        <?php if(!empty($coursess)){
                            foreach($coursess as $list){ 
                                $selected = '';
                                if(isset($_GET['course']) && !empty($_GET['course']) && in_array($list->cid, $_GET['course'])){
                                $selected = 'selected';
                                }?>
                            <option value="<?=$list->cid?>" <?=$selected?>><?=$list->c_f_name?></option>
                        <?php }
                        } ?>
                        </select>
                    </div>
                    <div class="col-md-2 offset-md-1 text-right">
                        <button type="submit" class="btn btn-primary px-4">Filter</button>
                        <a href="<?=base_url('institute/search_reset')?>" class="btn btn-warning">Reset</a>
                    </div>
                </div>
            </form>
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
                    <th>Photo</th>
                    <th>Reg.No</th>
                    <th>Roll No</th>
                    <th>Student's Name</th>
                    <th>Father's Name</th>
                    <th>Mobile</th>
                    <!-- <th>Batch Name</th> -->
                    <!-- <th>Batch Time</th> -->
                    <th>Course Name</th>
                    <!-- <th>Payment Type</th> -->
                    <!-- <th>Email</th> -->
                    <th>Status</th>
                    <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php if(!empty($student_list)){
                    $insmanagemodel = model('App\Models\InsManage_model', false);
                    $sn=1;
                    foreach($student_list as $list){ 
                    if($list->stu_image != ''){
                        $image = $list->stu_image;
                    }else{
                        $image = 'dummy_stu.jpg';
                    }
                    $status = '<span class="badge badge-warning ">Inactive</span>';
                    if($list->status == '1'){
                        $status = '<span class="badge badge-primary ">Active</span>';
                    }else if($list->status == '2'){
                        $status = '<span class="badge badge-success ">Completed</span>';
                    }else if($list->status == '3'){
                        $status = '<span class="badge badge-danger ">Cancel</span>';
                    }
                    $All_Course_Dtls = $insmanagemodel->get_students_course_list($list->stu_id);
                    $courseArr = (array_column($All_Course_Dtls, 'c_f_name')); 
                    ?>
                    <tr <?=($list->status=='3')?'style="color:red;"':''?>>
                        <td><?=$sn++?></td>
                        <td>
                            <div class="form-check">
                                <input class="form-check-input" name="checkedIds[]" type="checkbox" value="<?=$list->stu_id?>" id="Check<?=$list->stu_id?>">
                                <label class="form-check-label" for="Check<?=$list->stu_id?>"></label>
                            </div>
                        </td>
                        <td><img src="<?=base_url('public/assets/upload/images/'.$image) ?>" alt="stu_image" width="60px" height="60px"></td>
                        <td><?=$list->stu_reg_no?></td>
                        <td><?=$list->stu_roll_no?></td>
                        <td><?=$list->stu_name ?></td>
                        <td><?=$list->f_name ?></td>
                        <td><?=$list->phone1 ?></td>
                        <td><?=strtoupper(implode('<br>', $courseArr)) ?></td>
                        <td><?=$status?></td>
                        <td>
                            <?php if(is_privilege(29,3)){ ?>
                            <a href="<?= base_url('/institute/student_cu/'.$list->stu_id) ?>" class="mt-2 btn btn-outline-info" role="button" title="Edit"><i class="fas fa-edit"></i></a>
                            <?php } if(is_privilege(29,4)){ ?>
                            <a href="<?= base_url('/institute/student_view/'.$list->stu_id) ?>" class="mt-2 btn btn-outline-info" role="button" title="Modules"><i class="fa fa-eye"></i></a>
                            <?php } ?>
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
    $(document).ready(function() {
        $('#batch_id').multiselect({		
        nonSelectedText: 'Select Batch',
        enableFiltering: true,
        enableCaseInsensitiveFiltering: true,
        includeSelectAllOption: true,
        buttonWidth: '100%',
        maxWidth: 650,
        maxHeight: 350,				
        });
        $('#course_id').multiselect({		
        nonSelectedText: 'Select Course',
        enableFiltering: true,
        enableCaseInsensitiveFiltering: true,
        includeSelectAllOption: true,
        buttonWidth: '100%',
        maxWidth: 650,
        maxHeight: 350,				
        });
    });
</script>
<script>
  $("#CheckAll").click(function() {
    $("input:checkbox[name='checkedIds[]']").prop("checked", $(this).prop("checked"));
    // disable_enable_btn();
  });

  $("input:checkbox[name='checkedIds[]']").click(function() {
    if (!$(this).prop("checked")) {
      $("#CheckAll").prop("checked", false);
    }
    // disable_enable_btn();
  });
 /*function disable_enable_btn(){
    var checked = $('input[name="checkedIds[]"]:checked').length;
    if(checked >= 1){
      $('#i_card').removeAttr('disabled');
    }else{
      $('#i_card').attr('disabled', true);
    }
  }*/
  $("#i_card").click(function () {
    var checkedIds = [];
    $('input[name="checkedIds[]"]:checked').each(function (){
      checkedIds.push($(this).val());
    });
    if(checkedIds.length == 0){
      alert("Please select students for I-Card");
    }else{
      var url = btoa(JSON.stringify(checkedIds));
      url = "<?=base_url('institute/student-i-card')?>"+"/"+url;
      $("#i_card").attr('href', url);
    }
    
  });
</script> 

<?=$this->endSection()?>
  