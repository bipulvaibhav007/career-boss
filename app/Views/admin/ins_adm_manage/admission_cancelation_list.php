<?=$this->extend("admin/_layout/master") ?>
<?=$this->section("content") ?>
  <!-- Container Fluid-->
  <div class="container-fluid" id="container-wrapper">
    <?php /* <div class="d-sm-flex align-items-center justify-content-between my-3">
        <h1 class="h3 mb-0 text-gray-800"><?=$page_title.' ('.$count_list.')';?></h1>
        <div class="">
        <?php if(is_privilege(29,2)){ ?>
            <a href="<?=base_url('institute/student_cu')?>" class="btn btn-primary">Add Students</a>
        <?php } ?>
        <a href="<?=base_url('institute/admission_cancelation_list')?>" class="btn btn-danger">Admission Cancelation List</a>
        </div>
    </div> */ ?>
    
    <div class="row mb-3">
      <!-- Datatables -->
    <div class="col-lg-12">
      <?php if(session()->getFlashdata('message') !== NULL){
        echo alertBS(session()->getFlashdata('message'),session()->getFlashdata('type'));
      } ?>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h2 class="h3 mb-0 text-gray-800">Student List for cancelation</h2>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-sm" id="dataTable" width="100%" cellspacing="0">
                    <thead class="thead-dark">
                        <tr>
                        <th>#</th>
                        <th>Photo</th>
                        <th>Reg.No</th>
                        <th>Roll No</th>
                        <th>Student's Name</th>
                        <th>Father's Name</th>
                        <th>Batch Name</th>
                        <th>Batch Time</th>
                        <th>Course Name</th>
                        <th>Mobile</th>
                        <th>Payment Type</th>
                        <!-- <th>Email</th> -->
                        <th>Status</th>
                        <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                        if(!empty($cancel_student_list)){
                        $sn=1; 
                        foreach($cancel_student_list as $list){ 
                            if($list->stu_image != ''){
                            $image = $list->stu_image;
                            }else{
                            $image = 'dummy_stu.jpg';
                            }
                            $status = '<span class="btn btn-warning btn-sm">Inactive</span>';
                            if($list->status == '1'){
                            $status = '<span class="btn btn-primary btn-sm">Active</span>';
                            }else if($list->status == '2'){
                            $status = '<span class="btn btn-success btn-sm">Completed</span>';
                            }else if($list->status == '3'){
                            $status = '<span class="btn btn-danger btn-sm">Cancel</span>';
                            }
                        ?>
                            <tr <?=($list->status=='3')?'style="color:red;"':''?>>
                            <td><?=$sn ?></td>
                            <td><img src="<?=base_url('/public/assets/upload/images/'.$image)?>" alt="stu_image" width="60px" height="60px"></td>
                            <td><?=$list->stu_reg_no?></td>
                            <td><?=$list->stu_roll_no?></td>
                            <td><a href="<?=base_url('institute/cancel_admission/'.$list->id)?>"><?=$list->stu_name ?></a></td>
                            <td><?=$list->f_name ?></td>
                            <td><?=$list->batch_name ?></td>
                            <td><?=$list->time_from?></td>
                            <td><?=$list->c_f_name ?></td>
                            <td><?=$list->phone1 ?></td>
                            <td><?=strtoupper($list->payment_type)?></td>
                            <?php /* <td><a href="<?=base_url('institute/students/students_view/'.$list->stu_id);?>"><?=$list->email ?></a> </td>*/ ?>
                            
                            <th><?=$status?></th>
                            <td>
                                <a href="<?=base_url('institute/cancel_admission/'.$list->id);?>" title="Edit"><i class="fas fa-edit"></i></a>
                                <?php /* 
                                <a href="<?=base_url('institute/students/students_view/'.$list->stu_id);?>" title="View"><i class="fas fa-eye"></i></a>
                                
                                <a onclick="return confirm('Are you sure?');" href="<?=base_url('institute/students/delete_one/'.$list->stu_id);?>" title="Delete"><i class="fas fa-trash" style="color:red;"></i></a>
                                <a onclick="return confirm('Are you sure to cancel this admission?');" href="<?=base_url('institute/students/admission_cancel_process_start/'.$list->stu_id);?>" title="Admission Cancel" ><i class="fa fa-times" aria-hidden="true" style="font-size:24px;color:red"></i></a>
                                */ ?>
                            </td>
                            </tr>
                        <?php $sn++; }
                        }else{ ?>
                            <tr>
                            <td colspan="13" class="text-center"><span class="text-danger">No Record Available</span></td>
                            </tr>
                        <?php   }  ?>
                        
                    </tbody>
                    <!--<tfoot>
                        <tr>
                        <th colspan="4" style="text-align:right">Sum</th>
                        <th style="text-align:right">number_format($sum)</th>
                        <th colspan="2"></th>
                        </tr>
                    </tfoot>-->
                    </table>
                </div>
            </div>
        </div>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h2 class="h3 mb-0 text-gray-800">Canceled Student List </h2>
            </div>
            <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover table-sm" id="dataTable" width="100%" cellspacing="0">
                <thead class="thead-dark">
                    <tr>
                    <th>#</th>
                    <th>Photo</th>
                    <th>Reg.No</th>
                    <th>Roll No</th>
                    <th>Student's Name</th>
                    <th>Father's Name</th>
                    <th>Batch Name</th>
                    <th>Batch Time</th>
                    <th>Course Name</th>
                    <th>Mobile</th>
                    <th>Return Amount</th>
                    <th>Status</th>
                    <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                <?php $total = 0;
                    if(!empty($canceled_student_list)){
                    $sn=1;  
                    foreach($canceled_student_list as $list){ 
                        if($list->stu_image != ''){
                        $image = $list->stu_image;
                        }else{
                        $image = 'dummy_stu.jpg';
                        }
                        $status = '<span class="btn btn-danger btn-sm">Canceled</span>';
                        $total += $list->paid_amount;
                    ?>
                        <tr>
                        <td><?=$sn ?></td>
                        <td><img src="<?=base_url('/public/assets/upload/images/'.$image)?>" alt="stu_image" width="60px" height="60px"></td>
                        <td><?=$list->stu_reg_no?></td>
                        <td><?=$list->stu_roll_no?></td>
                        <td><a href="<?=base_url('institute/canceled_students_view/'.$list->id)?>"><?=$list->stu_name ?></a></td>
                        <td><?=$list->f_name ?></td>
                        <td><?=$list->batch_name ?></td>
                        <td><?=$list->time_from?></td>
                        <td><?=$list->c_f_name ?></td>
                        <td><?=$list->phone1 ?></td>
                        <td style="text-align:right"><?=$list->return_amount?></td>
                        
                        <th><?=$status?></th>
                        <td>
                            <a href="<?=base_url('institute/canceled_students_view/'.$list->id);?>" title="View"><i class="fas fa-eye"></i></a>
                            <?php /* 
                            
                            <a onclick="return confirm('Are you sure?');" href="<?=base_url('institute/students/delete_one/'.$list->stu_id);?>" title="Delete"><i class="fas fa-trash" style="color:red;"></i></a>
                            <a onclick="return confirm('Are you sure to cancel this admission?');" href="<?=base_url('institute/students/admission_cancel_process_start/'.$list->stu_id);?>" title="Admission Cancel" ><i class="fa fa-times" aria-hidden="true" style="font-size:24px;color:red"></i></a>
                            */ ?>
                        </td>
                        </tr>
                    <?php $sn++; }
                    }else{ ?>
                        <tr>
                        <td colspan="13" class="text-center"><span class="text-danger">No Record Available</span></td>
                        </tr>
                    <?php   }  ?>
                    
                </tbody>
                <?php if($total){ ?>
                <tfoot>
                    <tr>
                    <th colspan="10" style="text-align:right">Sum</th>
                    <th style="text-align:right"><?=number_format($total)?></th>
                    <th colspan="2"></th>
                    </tr>
                </tfoot>
                <?php } ?>
                </table>
            </div>
            </div>
        </div>
        <?php /* <div class="card-header py-2">
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
        </div> */ ?>
        <?php /* <div class="card-body">
          <div class="table-responsive">
            <table class="table align-items-center table-flush table-hover" id="dataTableHover">
              <thead class="thead-light">
                <tr>
                    <th>#</th>
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
        </div> */ ?>

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
<?php /* 
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
  */ ?>
<?=$this->endSection()?>
  