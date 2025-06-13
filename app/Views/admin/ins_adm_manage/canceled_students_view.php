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
            <div class="card-header py-3 d-flex justify-content-between" >
                <h2 class="h3 mb-0 text-gray-800">Canceled Students Details</h2>
                <div class="">
                    <a href="<?=isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : base_url('institute/students/student_listing');?>" class="d-none d-sm-inline-block btn btn-sm btn-primary">Back</a>
                </div>
            </div>
            <div class="card shadow mb-2">
                <!-- <div class="card-header py-3">
                <div class="row">
                    <div class="col-md-12">
                    <h2 class="h3 mb-0 text-gray-800"><?= isset($student)?'Edit Student':'Add Student'; ?></h2>
                    </div>
                </div>
                </div> -->
    
                <div class="card-body">
                    <div class="form-group row">
                        <label for="stu_name" class="col-sm-2 mb-3 mb-sm-0">Student's Name:</label>
                        <div class="col-sm-2">
                            <span><?=isset($student)?$student->stu_name:''; ?></span>
                        </div>
                        
                        <div class="col-sm-4">
                            <?php $STU_IMAGE = base_url('public/assets/upload/images/dummy_stu.jpg');
                            if($student->stu_image != ''){
                                $STU_IMAGE = base_url('public/assets/upload/images/'.$student->stu_image);
                            }?>
                            <img src="<?=$STU_IMAGE?>" alt="image" width="100px;" height="80px;">
                        </div>
                        <label for="f_name" class="col-sm-2 mb-3 mb-sm-0">Father's Name:</label>
                        <div class="col-sm-2">
                            <span><?=isset($student)?$student->f_name:''; ?></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="dob" class="col-sm-2 mb-3 mb-sm-0">DOB:</label>
                        <div class="col-sm-2">
                            <span><?=isset($student)?date('d M, Y',strtotime($student->dob)):''; ?></span>
                        </div>
                        <label for="age" class="col-sm-2 mb-3 mb-sm-0">Age:</label>
                        <div class="col-sm-2">
                            <span><?=isset($student)?$student->age:''; ?></span>
                        </div>
                        <label for="phone1" class="col-sm-2 mb-3 mb-sm-0">Mobile No:</label>
                        <div class="col-sm-2">
                            <span><?=isset($student)?$student->phone1:''; ?></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="phone2" class="col-sm-2 mb-3 mb-sm-0">Alternative Mobile No:</label>
                        <div class="col-sm-2">
                            <span><?=isset($student)?$student->phone2:''; ?></span>
                        </div>
                        <label for="email" class="col-sm-2 mb-3 mb-sm-0">Email:</label>
                        <div class="col-sm-2">
                            <span><?=isset($student)?$student->email:''; ?></span>
                        </div>
                        <label for="qualification" class="col-sm-2 mb-3 mb-sm-0">Last Qualification:</label>
                        <div class="col-sm-2">
                            <span><?=isset($student)?$student->qly_title:''; ?></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="co_address" class="col-sm-2 mb-3 mb-sm-0">Co Address:</label>
                        <div class="col-sm-2">
                            <span><?=isset($student)?$student->co_address:''; ?></span>
                        </div>
                        <label for="p_address" class="col-sm-2 mb-3 mb-sm-0">P Address:</label>
                        <div class="col-sm-2">
                            <span><?=isset($student)?$student->p_address:''; ?></span>
                        </div>
                        <label for="course_id" class="col-sm-2 mb-3 mb-sm-0">Course: </label>
                        <div class="col-sm-2">
                            <span><?=isset($student)?$student->c_f_name:''; ?></span>
                        </div>
                    </div>
                    <div class="form-group row">

                        <label for="batch_id" class="col-sm-2 mb-3 mb-sm-0">Batch: </label>
                        <div class="col-sm-2">
                            <span><strong><?=isset($student)?$student->batch_name:''; ?></strong></span>
                        </div>
                        <label for="batch_id" class="col-sm-2 mb-3 mb-sm-0">Reg. No: </label>
                        <div class="col-sm-2">
                            <span><strong><?=isset($student)?$student->stu_reg_no:''; ?></strong></span>
                        </div>
                        <label for="batch_id" class="col-sm-2 mb-3 mb-sm-0">Roll. No: </label>
                        <div class="col-sm-2">
                            <span><strong><?=isset($student)?$student->stu_roll_no:''; ?></strong></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="p_address" class="col-sm-2 mb-3 mb-sm-0">Course Fee:</label>
                        <div class="col-sm-2">
                            <span><?=isset($student)?'<strong>'.strtoupper($student->course_fee).'</strong>':''; ?></span>
                        </div>
                        <label for="p_address" class="col-sm-2 mb-3 mb-sm-0">Admission Fee:</label>
                        <div class="col-sm-2">
                            <span><?=isset($student)?'<strong>'.strtoupper($student->adm_fee).'</strong>':''; ?></span>
                        </div>
                        <label for="p_address" class="col-sm-2 mb-3 mb-sm-0">Discount Amount:</label>
                        <div class="col-sm-2">
                            <span><?=isset($student)?'<strong>'.strtoupper($student->dis_amount).'</strong>':''; ?></span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="p_address" class="col-sm-2 mb-3 mb-sm-0">Total Fee:</label>
                        <div class="col-sm-2">
                            <span><?=isset($student)?'<strong>'.strtoupper($student->total_fee).'</strong>':''; ?></span>
                        </div>
                        <label for="p_address" class="col-sm-2 mb-3 mb-sm-0">Paid Amount:</label>
                        <div class="col-sm-2">
                            <span><?=isset($student)?'<strong>'.strtoupper($student->paid_amount).'</strong>':''; ?></span>
                        </div>
                        <label for="p_address" class="col-sm-2 mb-3 mb-sm-0">Return Amount:</label>
                        <div class="col-sm-2">
                            <span><?=isset($student)?'<strong>'.strtoupper($student->return_amount).'</strong>':''; ?></span>
                        </div>
                        
                    </div>
                    <div class="form-group row">
                        <label for="adm_date" class="col-sm-2 mb-3 mb-sm-0">Admission Date: </label>
                        <div class="col-sm-2">
                            <span><?=isset($student)?date('d M, Y',strtotime($student->adm_date)):''; ?></span>
                        </div>
                        <label for="adm_date" class="col-sm-2 mb-3 mb-sm-0">Cancelation Date: </label>
                        <div class="col-sm-2">
                            <span><?=isset($student)?date('d M, Y',strtotime($student->cancelation_date)):''; ?></span>
                        </div>
                        <label for="image" class="col-sm-2 mb-3 mb-sm-0">Amount Return Date:</label>
                        <div class="col-sm-2">
                        <span><?=isset($student)?date('d M, Y',strtotime($student->amount_return_date)):''; ?></span>
                        </div>
                    </div>
                    <hr>
                    <strong>
                    <div class="form-group row">
                        <label for="beneficiary_name" class="col-sm-2 mb-3 mb-sm-0">Beneficiary Name:</label>
                        <div class="col-sm-2">
                            <span><?=$student->beneficiary_name; ?></span>
                        </div>
                        <label for="beneficiary_mob_no" class="col-sm-2 mb-3 mb-sm-0">Beneficiary Mobile No: </label>
                        <div class="col-sm-2">
                            <span><?=isset($student)?$student->beneficiary_mob_no:''; ?></span>
                        </div>
                        <label for="image" class="col-sm-2 mb-3 mb-sm-0">Bank Name:</label>
                        <div class="col-sm-2">
                            <span><?=isset($student)?$student->bank_name:''; ?></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="branch_name" class="col-sm-2 mb-3 mb-sm-0">Branch Name:</label>
                        <div class="col-sm-2">
                            <span><?=$student->branch_name; ?></span>
                        </div>
                        <label for="bank_ac_no" class="col-sm-2 mb-3 mb-sm-0">Bank A/c No: </label>
                        <div class="col-sm-2">
                            <span><?=isset($student)?$student->bank_ac_no:''; ?></span>
                        </div>
                        <label for="ifsc_code" class="col-sm-2 mb-3 mb-sm-0">IFSC Code:</label>
                        <div class="col-sm-2">
                            <span><?=isset($student)?$student->ifsc_code:''; ?></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="cancelation_date" class="col-sm-2 mb-3 mb-sm-0">Cancelation Date:</label>
                        <div class="col-sm-2">
                            <span><?=date('d-M-Y h:i:s A',strtotime($student->cancelation_date)); ?></span>
                        </div>
                        <label for="amount_return_date" class="col-sm-2 mb-3 mb-sm-0">Amount Return Date: </label>
                        <div class="col-sm-2">
                        <span><?=date('d-M-Y h:i:s A',strtotime($student->amount_return_date)); ?></span>
                        </div>
                        <label for="amount_return_by" class="col-sm-2 mb-3 mb-sm-0">Return Confirm By:</label>
                        <div class="col-sm-2">
                            <span><?=isset($student)?$student->return_confirm_name:''; ?></span>
                        </div>
                    </div>
                    </strong>
                </div> <!--card-->

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
  