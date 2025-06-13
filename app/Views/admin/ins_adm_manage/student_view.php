<?=$this->extend("admin/_layout/master") ?>
<?=$this->section("content") ?>
  <!-- Container Fluid-->
  <div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between my-3">
        <h1 class="h3 mb-0 text-gray-800">Student Details</h1>
        <div class="">
          
          <a href="<?=base_url('institute/students')?>" class="btn btn-primary">Back</a>
        </div>
    </div>
    
    <div class="row mb-3">
        <div class="col-lg-12">
        <?php if(session()->getFlashdata('message') !== NULL){
            echo alertBS(session()->getFlashdata('message'),session()->getFlashdata('type'));
        } ?>
        
        </div>
    </div>

    <div class="card shadow mb-1">
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
                <div class="col-sm-4">
                    <span><?=isset($student)?$student->stu_name:''; ?></span>
                </div>
                
                <div class="col-sm-6">
                    <?php $STU_IMAGE = base_url('public/assets/upload/images/dummy_stu.jpg');
                    if($student->stu_image != ''){
                        $STU_IMAGE = base_url('public/assets/upload/images/'.$student->stu_image);
                    }?>
                    <img src="<?=$STU_IMAGE?>" alt="image" width="100px;" height="80px;">
                </div>
                
            </div>
            <div class="form-group row">
                <label for="f_name" class="col-sm-2 mb-3 mb-sm-0">Father's Name:</label>
                <div class="col-sm-10">
                    <span><?=isset($student)?$student->f_name:''; ?></span>
                </div>
            </div>
            <?php /* <div class="form-group row">
            <label for="batch_id" class="col-sm-2 mb-3 mb-sm-0">Batch: </label>
            <div class="col-sm-4">
                <span><strong><?=isset($student)?$student->batch_name:''; ?></strong></span>
            </div>
            <label for="batch_id" class="col-sm-2 mb-3 mb-sm-0">Batch Time: </label>
            <div class="col-sm-4">
                <span><strong><?=isset($student)?$student->time_from:''; ?></strong></span>
            </div>
            </div> */ ?>
            <div class="form-group row">
                <label for="dob" class="col-sm-2 mb-3 mb-sm-0">DOB:</label>
                <div class="col-sm-4">
                    <span><?=isset($student)?date('d M, Y',strtotime($student->dob)):''; ?></span>
                </div>
            
                <label for="age" class="col-sm-2 mb-3 mb-sm-0">Age:</label>
                <div class="col-sm-4">
                    <span><?=isset($student)?$student->age:''; ?></span>
                </div>
            </div>
            <div class="form-group row">
                <label for="phone1" class="col-sm-2 mb-3 mb-sm-0">Mobile No:</label>
                <div class="col-sm-4">
                    <span><?=isset($student)?$student->phone1:''; ?></span>
                </div>
                <label for="phone2" class="col-sm-2 mb-3 mb-sm-0">Alternative Mobile No:</label>
                <div class="col-sm-4">
                    <span><?=isset($student)?$student->phone2:''; ?></span>
                </div>
            </div>
            <div class="form-group row">
                <label for="co_address" class="col-sm-2 mb-3 mb-sm-0">Co Address:</label>
                <div class="col-sm-4">
                    <span><?=isset($student)?$student->co_address:''; ?></span>
                </div>
                <label for="p_address" class="col-sm-2 mb-3 mb-sm-0">P Address:</label>
                <div class="col-sm-4">
                    <span><?=isset($student)?$student->p_address:''; ?></span>
                </div>
            </div>
            <div class="form-group row">
                <label for="qualification" class="col-sm-2 mb-3 mb-sm-0">Last Qualification:</label>
                <div class="col-sm-4">
                <span><?=isset($student)?$student->qly_title:''; ?></span>
                </div>
                <label for="image" class="col-sm-2 mb-3 mb-sm-0">Status:</label>
                <div class="col-sm-4">
                <?php $status = '<span class="btn btn-warning btn-sm">Inactive</span>';
                if($student->status == '1'){
                    $status = '<span class="btn btn-primary btn-sm">Active</span>';
                }else if($student->status == '2'){
                    $status = '<span class="btn btn-success btn-sm">Completed</span>';
                }else if($student->status == '3'){
                    $status = '<span class="btn btn-danger btn-sm">Cancel</span>';
                } 
                echo $status; ?>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow mb-2">
        <div class="card-header">
        <div class="d-sm-flex align-items-center justify-content-between">
            <h2 class="h3 mb-0 text-gray-800">Course List</h2>
            <div>
            <?php /*if(isset($student->stu_id)){ ?>
            <a href="<?=base_url('institute/students/students_cu/'.$student->stu_id)?>" class="btn btn-warning btn-sm">Reset</a>
            <?php } */?>
            <?php if(!isset($return_URL)){ ?>
            <a href="<?=base_url('institute/students/')?>" class="btn btn-primary btn-sm">Back</a>
            <?php } ?>
            </div>
        </div>
        </div>
        <div class="card-body">
        <table class="table table-bordered table-responsive table-sm">
            <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Date</th>
                <th scope="col">Batch No</th>
                <th scope="col">Course</th>
                <th scope="col">Course Fee</th>
                <th scope="col">Admission Fee</th>
                <th scope="col">Discount</th>
                <th scope="col">Total Fee</th>
                <th scope="col">Total Paid</th>
                <th scope="col">Total Dues</th>
                <th scope="col">Payment Type</th>
                <th scope="col">Paid Inst./<br>Total Inst.</th>
                <th scope="col">Installment Amount</th>
                <th scope="col">Payable Amount</th>
                <th scope="col">Due Date</th>
                <th scope="col">Status</th>
                <th scope="col">Action</th>
            </tr>
            </thead>
            <tbody>
            <?php 
              $commonmodel = model('App\Models\Common_model', false);
              if(!empty($courseList)){ $sn = 1;
                foreach($courseList as $list){ ?>
                <tr <?=($list->status==3)?'style="color:red;"':''?>>
                    <td><?=$sn++; ?></td>
                    <td><?=date('d-m-Y',strtotime($list->adm_date))?></td>
                    <td><?=($list->course_type == 'NR')?'<span class="badge badge-danger">Non-Regular</span>':$list->batch_name?></td>
                    <td><?=strtoupper($list->c_f_name)?></td>
                    <td><?=$list->course_fee?></td>
                    <td><?=$list->adm_fee?></td>
                    <td><?=$list->dis_amount?></td>
                    <td><?=$list->total_fee?></td>
                    <td><?=$list->paid_amount?></td>
                    <td><?=$list->dues_amount?></td>
                    <td><?=$list->payment_type?></td>
                    <td><?=$list->paid_inst_no.'/'.$list->total_installment?></td>
                    <td><?=$list->ins_amount?></td>
                    <td><?=$list->payable_amount?></td>
                    <td><?=($list->payment_type == 'installment')?date('d-m-Y',strtotime($list->next_paid_date)):'--'?></td>
                    <td><?=get_student_status($list->status)?></td>
                    <td>
                    <?php /* <a href="<?=base_url('institute/students/students_cu/'.$student->stu_id.'/'.$list->id)?>" title="edit"><i class="fas fa-edit"></i></a> */ ?>
                    <?php if($list->status != 2 && $list->status != 4) { ?>
                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton<?=$sn?>" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Action
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton<?=$sn?>">
                        <a class="dropdown-item" href="javascript:void(0)" onclick="change_status(<?=$list->id.',\''.$list->c_f_name.'\','.$list->status.',\''.$list->course_cat.'\''?>)">Change Status</a>
                        
                        <?php if($list->course_cat == 'U'){ 
                        $uniDtls = $commonmodel->getOneRecord('tbl_cb_uni_student', ['cf_id'=>$list->id]);
                        if(!empty($uniDtls)){
                          $uniDtls = base64_encode(json_encode($uniDtls));
                        }else{
                          $uniDtls = '';
                        }

                        ?>
                        <a class="dropdown-item" href="javascript:void(0)" onclick="update_university(<?=$list->id.',\''.$list->c_f_name.'\',\''.$uniDtls.'\''?>)">Update/View University</a>
                        <?php } if($list->course_type == 'R'){ ?>
                        <a class="dropdown-item" href="javascript:void(0)" onclick="change_course(<?=$list->id.','.$list->batch_id.','. $list->course_id.',\''.$list->c_f_name.'\''.',\''.$list->course_fee.'\''?>);">Change Course</a>
                        <a class="dropdown-item" href="javascript:void(0)" onclick="payment_receive(<?=$list->id.',\''.$list->c_f_name.'\''?>);">Fee Deposit</a>
                        <a class="dropdown-item text-warning" href="javascript:void(0)" onclick="give_discount(<?=$list->id.',\''.$list->c_f_name.'\''?>);">Give Discount</a>
                        <?php if($list->status < 2){ ?>
                            <a class="dropdown-item text-danger" href="javascript:void(0)" onclick="cancel_course(<?=$list->id.',\''.$list->c_f_name.'\''?>);">Cancel Course</a>
                        <?php } if($list->status == 3){?>
                            <a class="dropdown-item text-danger" href="<?=base_url('institute/resume_course/'.$list->id.'/'.$list->stu_id)?>" onclick="return confirm('Are u sure to resume course?')">Resume Course</a>
                        <?php }
                        } ?>

                        </div>
                    </div>
                    <?php }
                    if($list->status == 4){
                      echo '<a href="'.base_url('institute/certified_students').'" class="btn btn-primary">View Cert</a>';
                    } ?>
                    </td>
                </tr>
            <?php }
            }else{
                echo '<tr><td colspan="11">No Course</td></tr>';
            } ?>
            </tbody>
        </table>
        </div>
    </div>
    <script>
        function payment_receive(id, course_name){
        $("#feeDepositeFormsData")[0].reset();
        $("#course_fee_id").val(id);
        $("#courseName").html(course_name);
        $("#feeDepositeModal").modal("show");
        }
        function change_course(id, batch_id, course_id, course_name, course_fee){
        $("#changeCourseFormsData")[0].reset();
        $("#course_fee_id2").val(id);
        $("#courseName2").html(course_name);
        $("#course_id").val(course_id);
        $("#batch_id").val(batch_id);
        $("#course_fee").val(course_fee);
        $("#changeCourseModal").modal("show");
        }
        function get_course_fee(){
        var course_fee = $('#course_id option:selected').data('course_fee');
        $("#course_fee").val(course_fee);
        }
        function change_status(id, course_name,status,course_cat){
        $("#changeStatusFormsData")[0].reset();
        $("#cerDtDiv").hide();

        $("#course_fee_id3").val(id);
        $("#course_cat").val(course_cat);

        $("#courseName3").html(course_name);
        $("#status").val(status);
        $("#changeStatusModal").modal("show");
        }
        function give_discount(id, course_name){
        $("#disAmountErr").html("");
        $("#giveDiscountFormsData")[0].reset();
        $("#course_fee_id4").val(id);
        $("#courseName4").html(course_name);
        $("#giveDiscountModal").modal("show");
        }
        function validate_give_discount(){
        $("#disAmountErr").html("");
        $("#descriptionErr").html("");
        var error = 0;
        if($("#disAmount").val() == ''){
            $("#disAmountErr").html("Please enter amount");
            error = 1;
        }
        if($("#description").val() == ''){
            $("#descriptionErr").html("Please enter reason");
            error = 1;
        }
        
        if(error){
            return false;
        }else{
            return true;
        }
        }
        function cancel_course(id,course_name){
        $("#course_fee_id5").val(id);
        $("#courseName5").html(course_name);
        // $("#status").val(status);
        $("#cancelCourseModal").modal("show");
        }
        function validate_cancel_course(){
        $("#beneficiary_nameErr,#beneficiary_mob_noErr,#bank_nameErr,#branch_nameErr,#bank_ac_noErr,#ifsc_codeErr,#cancelation_dateErr").html("");
        var error = 0;
        if($("#beneficiary_name").val() == ''){
            $("#beneficiary_nameErr").html("Please enter beneficiary_name");
            error = 1;
        }
        if($("#beneficiary_mob_no").val() == ''){
            $("#beneficiary_mob_noErr").html("Please enter beneficiary_mob_no");
            error = 1;
        }
        if($("#bank_name").val() == ''){
            $("#bank_nameErr").html("Please enter bank_name");
            error = 1;
        }
        if($("#branch_name").val() == ''){
            $("#branch_nameErr").html("Please enter branch_name");
            error = 1;
        }
        if($("#bank_ac_no").val() == ''){
            $("#bank_ac_noErr").html("Please enter bank_ac_no");
            error = 1;
        }
        if($("#ifsc_code").val() == ''){
            $("#ifsc_codeErr").html("Please enter ifsc_code");
            error = 1;
        }
        if($("#cancelation_date").val() == ''){
            $("#cancelation_dateErr").html("Please enter cancelation_date");
            error = 1;
        }
        
        if(error){
            return false;
        }else{
            return true;
        }
        }
        function edit_receipt(id,course_name,inst_id, paid_amount, receipt_no){
        // alert(id+course_name+inst_id);
        $("#course_fee_id6").val(id);
        $("#courseName6").html(course_name);
        $("#inst_id").val(inst_id);
        $("#paid_amount").val(paid_amount);
        $("#paid_amount_o").val(paid_amount);
        $("#receipt_no2").val(receipt_no);
        $("#receipt_no_o").val(receipt_no);
        $("#editReceiptModal").modal("show");
        }
        
    </script>

    <div class="card shadow mb-2">
        <div class="card-header">
        <div class="d-sm-flex align-items-center justify-content-between">
            <h2 class="h3 mb-0 text-gray-800">Ledger</h2>
            <div>
            <?php /*if(isset($student->stu_id)){ ?>
            <a href="<?=base_url('institute/students/students_cu/'.$student->stu_id)?>" class="btn btn-warning btn-sm">Reset</a>
            <?php } */?>
            <a href="<?=base_url('institute/students')?>" class="btn btn-primary btn-sm">Back</a>
            </div>
        </div>
        </div>
        <div class="card-body">
        <div class="row">
            <div class="col-md-6">
              <div class="table-responsive">
              <table class="table table-bordered">
                  <thead class="thead-dark">
                  <tr>
                      <th>#</th>
                      <th>Course</th>
                      <th>Course Fee</th>
                      <th>Admission Fee</th>
                      <th>Discount</th>
                      <th>Total Fee</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php $insmanagemodel = model('App\Models\InsManage_model', false);
                  if(!empty($courseList)){
                      
                      foreach($courseList as $key=>$list){ 
                      $cellHeight = count($insmanagemodel->get_paid_ins_list_by_coursefee_id($list->id)) + 1;
                  ?>
                      <tr style="border-bottom: double 3px; border-color: blue">
                          <td height="<?=$cellHeight * 80?>"><?=$key+1;?></td>
                          <!-- <td><?=$key+1;?></td> -->
                          <td><?=$list->c_f_name;?></td>
                          <td><?=$list->course_fee;?></td>
                          <td><?=$list->adm_fee;?></td>
                          <td><?=$list->dis_amount;?></td>
                          <td><?=$list->total_fee;?></td>
                      </tr>
                  <?php } } ?>
                  </tbody>
              </table>
              </div>
            </div>
            <div class="col-md-6">
            <div class="table-responsive">
            <table class="table table-bordered">
                <thead class="thead-dark">
                <tr>
                    <th>#</th>
                    <th>Date</th>
                    <th>Paid Amount</th>
                    <th>Receipt No</th>
                    <th>Description</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php if(!empty($courseList)){ 
                    foreach($courseList as $key=>$list){ 
                    $paid_ins = $insmanagemodel->get_paid_ins_list_by_coursefee_id($list->id);  
                    // print_r($paid_ins); exit;
                    if(!empty($paid_ins)){
                    $total_paid = 0;
                    $no = 1;
                    foreach($paid_ins as $list2){
                        echo 
                        '<tr>
                        <td>'.$no++.'</td>
                        <td>'.date('d-M-Y',strtotime($list2->paid_date)).'</td>
                        <td>'.$list2->paid_amount.'</td>
                        <td>'.$list2->receipt_no.'</td>
                        <td>'.$list2->description.'</td>';
                        if($list->status != 2 && $list->status != 4){
                        echo '<td><a href="javascript:void(0);" class="" onclick="edit_receipt('.$list->id.',\''.$list->c_f_name.'\','.$list2->inst_id.','.$list2->paid_amount.','.'\''.$list2->receipt_no.'\''.')"><i class="fas fa-edit"></i></a></td>
                        </tr>';
                        }
                        $total_paid += $list2->paid_amount;
                    }
                    echo '<tr class="text-primary" style="border-bottom: double 3px;">
                            <td colspan="2"><strong>Total</strong></td>
                            <td colspan="4"><strong style="border-bottom: double 3px;">'.$total_paid.'</strong></td>
                            </tr>';
                    }
                ?>
                <?php } } ?>
                </tbody>
            </table>
            </div>
            </div>
        </div>
        </div>
    </div>

    <div class="card shadow mb-2">
        <div class="card-header py-2">
        <div class="d-sm-flex align-items-center justify-content-between mb-2">
            <h2 class="h3 mb-0 text-gray-800">Course & Fee Update Log</h2>
            <?php /* <a href="javascript:void(0);" class="d-none d-sm-inline-block btn btn-sm btn-primary fee_deposite"> Fee Deposite</a> */ ?>
        </div>
        </div>
        <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover table-sm" id="dataTable" width="100%" cellspacing="0">
            <thead class="thead-dark">
                <tr>
                <th>Date</th>
                <th>Batch No</th>
                <th>Course</th>
                <th>Course Fee</th>
                <th>Admission Fee</th>
                <th>Discount</th>
                <th>Total Fee</th>
                <th>Total Paid</th>
                <th>Total Dues</th>
                <th>Payment Type</th>
                <th>Paid Inst./<br>Total Inst.</th>
                <th>Installment Amount</th>
                <th>Payable Amount</th>
                <th>Due Date</th>
                <th>Description</th>
                <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php if(!empty($courseList)){
                foreach($courseList as $key=>$cl){ 
                echo '<tr><td colspan="15" class="text-center"><span class="text-primary"><b>'.$cl->c_f_name.' Log</b></span></td></tr>';  
                $fee_log = $insmanagemodel->get_paid_installment_log_details($cl->id);
                foreach($fee_log as $list){
                ?>
                <tr>
                    <td><?=date('d-m-Y',strtotime($list->added_at))?></td>
                    <td><?=$list->batch_name?></td>
                    <td><?=$list->c_f_name?></td>
                    <td><?=$list->course_fee?></td>
                    <td><?=$list->adm_fee?></td>
                    <td><?=$list->dis_amount?></td>
                    <td><?=$list->total_fee?></td>
                    <td><?=$list->paid_amount?></td>
                    <td><?=$list->dues_amount?></td>
                    <td><?=$list->payment_type?></td>
                    <td><?=$list->paid_inst_no.'/'.$list->total_installment?></td>
                    <td><?=$list->ins_amount?></td>
                    <td><?=$list->payable_amount?></td>
                    <td><?=($list->payment_type == 'installment')?date('d-m-Y',strtotime($list->next_paid_date)):'--'?></td>
                    <td><?=$list->description?></td>
                    <td><?=get_student_status($list->status)?></td>

                </tr>
                <?php } } ?>
                
            </tbody>
            
            <?php } ?>
            </table>
        </div>
        </div>
    </div>
    
</div><!---Container Fluid-->
 
<!-- Modal -->
<div class="modal fade custom-modal" id="feeDepositeModal" tabindex="-1" role="dialog" aria-labelledby="customModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title" id="feeDepositeModalLabel">Fee Deposit</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="user" action="<?=base_url('institute/fee_deposite');?>" method="post" onsubmit="return validate_fee_deposite()" id="feeDepositeFormsData" autocomplete="off">
            <?=csrf_field() ?>
            <div class="modal-body" id="">
              <!--write body data here display to direct-->
              <div class="form-group row">
                <label for="stu_name" class="col-sm-3 mb-3 mb-sm-0">Student's Name</label>
                <div class="col-sm-9 mb-3 mb-sm-0">
                  <span><?=(isset($student))?$student->stu_name:''?></span>
                </div>
              </div>
              <div class="form-group row">
                <label for="course_name" class="col-sm-3 mb-3 mb-sm-0">Course</label>
                <div class="col-sm-9 mb-3 mb-sm-0">
                  <span id="courseName"></span>
                </div>
              </div>
              <input type="hidden" name="stu_id" id="stu_id" value="<?=(isset($student))?$student->stu_id:''?>">
              <input type="hidden" name="course_fee_id" id="course_fee_id" value="">
              <div class="form-group row">
                <label for="amount" class="col-sm-3 mb-3 mb-sm-0">Amount</label>
                <div class="col-sm-9 mb-3 mb-sm-0">
                  <input type="text" class="form-control" id="amount" placeholder="Amount" name="amount" value="" >
                  <span class="text-danger" id="err_amount"></span>
                </div>
              </div>
              <div class="form-group row">
                <label for="receipt_no" class="col-sm-3 mb-3 mb-sm-0">Receipt No</label>
                <div class="col-sm-9 mb-3 mb-sm-0">
                  <input type="text" class="form-control" id="receipt_no" placeholder="Receipt No" name="receipt_no" value="" >
                  <span class="text-danger" id="err_receipt_no"></span>
                </div>
              </div>
              <div class="form-group row">
                <label for="paid_date" class="col-sm-3 mb-3 mb-sm-0">Paid Date</label>
                <div class="col-sm-9 mb-3 mb-sm-0">
                  <input type="date" class="form-control" id="paid_date" name="paid_date" value="" >
                  <span class="text-danger" id="err_paid_date"></span>
                </div>
              </div>
                
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-primary" >Save changes</button>
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade custom-modal" id="changeCourseModal" tabindex="-1" role="dialog" aria-labelledby="customModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="changeCourseModalLabel">Change Course</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="user" action="<?=current_url();?>" method="post" id="changeCourseFormsData" autocomplete="off">
            <?=csrf_field() ?>
            <div class="modal-body" id="">
                <!--write body data here display to direct-->
                <div class="form-group row">
                  <label for="stu_name" class="col-sm-3 mb-3 mb-sm-0">Student's Name</label>
                  <div class="col-sm-9 mb-3 mb-sm-0">
                    <span><?=(isset($student))?$student->stu_name:''?></span>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="course_name" class="col-sm-3 mb-3 mb-sm-0">Course</label>
                  <div class="col-sm-9 mb-3 mb-sm-0">
                    <span id="courseName2"></span>
                  </div>
                </div>
                <input type="hidden" name="stu_id" id="stu_id" value="<?=(isset($student))?$student->stu_id:''?>">
                <input type="hidden" name="course_fee_id" id="course_fee_id2" value="">
                <input type="hidden" name="submit" value="changeCourse">
                <div class="form-group row">
                  <label for="batch_id" class="col-sm-3 mb-3 mb-sm-0">Batch No</label>
                  <div class="col-sm-9 mb-3 mb-sm-0">
                    <select name="batch_id" id="batch_id" class="form-control">
                    <?php if(!empty($batches)){
                    foreach($batches as $list){ ?>
                      <option value="<?=$list->batch_id?>"><?=$list->batch_name?></option>
                    <?php } } ?>
                    </select>
                    <span class="text-danger" id="err_batch_id"></span>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="course_id" class="col-sm-3 mb-3 mb-sm-0">Course</label>
                  <div class="col-sm-9 mb-3 mb-sm-0">
                    <select name="course_id" id="course_id" class="form-control" onchange="get_course_fee();">
                      <?php if(!empty($coursess)){
                      foreach($coursess as $list){ ?>
                        <option value="<?=$list->cid?>" data-course_fee="<?=$list->course_fee?>"><?=$list->c_f_name?></option>
                      <?php } } ?>
                    </select>
                    <span class="text-danger" id="err_course_id"></span>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="course_fee" class="col-sm-3 mb-3 mb-sm-0">Course Fee</label>
                  <div class="col-sm-9 mb-3 mb-sm-0">
                    <input type="text" name="course_fee" id="course_fee" class="form-control" value="">
                  </div>
                </div> 
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-primary" >Save changes</button>
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade custom-modal" id="changeStatusModal" tabindex="-1" role="dialog" aria-labelledby="customModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info text-white">
                <h5 class="modal-title" id="changeStatusModalLabel">Change Status</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="user" action="<?=current_url();?>" method="post" id="changeStatusFormsData">
            <?=csrf_field() ?>
            <div class="modal-body" id="" autocomplete="off">
                <!--write body data here display to direct-->
                <div class="form-group row">
                  <label for="stu_name" class="col-sm-3 mb-3 mb-sm-0">Student's Name</label>
                  <div class="col-sm-9 mb-3 mb-sm-0">
                    <span><?=(isset($student))?$student->stu_name:''?></span>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="course_name" class="col-sm-3 mb-3 mb-sm-0">Course</label>
                  <div class="col-sm-9 mb-3 mb-sm-0">
                    <span id="courseName3"></span>
                  </div>
                </div>
                <input type="hidden" name="stu_id" id="stu_id" value="<?=(isset($student))?$student->stu_id:''?>">
                <input type="hidden" name="course_fee_id" id="course_fee_id3" value="">
                <input type="hidden" name="course_cat" id="course_cat" value="">
                <input type="hidden" name="submit" value="changeStatus">
                <div class="form-group row">
                  <label for="status" class="col-sm-3 mb-3 mb-sm-0">Status</label>
                  <div class="col-sm-9 mb-3 mb-sm-0">
                    <select name="status" id="status" class="form-control" onchange="show_certificate_issue_date(this)">
                      <option value="0">Inactive</option>
                      <option value="1">Active</option>
                      <option value="2">Complete</option>
                    </select>
                    <span class="text-danger" id="err_status"></span>
                  </div>
                </div>
                <div class="form-group row" id="cerDtDiv" style="display:none;">
                  <label for="status" class="col-sm-3 mb-3 mb-sm-0">Certificate Isuue Date:</label>
                  <div class="col-sm-9 mb-3 mb-sm-0" id="">
                      <input type="date" name="cert_issue_date" value="<?=date('Y-m-d')?>" id="cert_issue_date" class="form-control">
                      <span class="text-danger" id="idateErr"></span>
                  </div>
                </div>
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-primary" >Save changes</button>
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade custom-modal" id="giveDiscountModal" tabindex="-1" role="dialog" aria-labelledby="customModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-warning text-white">
                <h5 class="modal-title" id="giveDiscountModalLabel">Give Discount</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="user" action="<?=current_url();?>" method="post" id="giveDiscountFormsData" onsubmit="return validate_give_discount();" autocomplete="off">
            <?=csrf_field() ?>
            <div class="modal-body" id="">
                <!--write body data here display to direct-->
                <div class="form-group row">
                  <label for="stu_name" class="col-sm-3 mb-3 mb-sm-0">Student's Name</label>
                  <div class="col-sm-9 mb-3 mb-sm-0">
                    <span><?=(isset($student))?$student->stu_name:''?></span>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="course_name" class="col-sm-3 mb-3 mb-sm-0">Course</label>
                  <div class="col-sm-9 mb-3 mb-sm-0">
                    <span id="courseName4"></span>
                  </div>
                </div>
                <input type="hidden" name="stu_id" id="stu_id" value="<?=(isset($student))?$student->stu_id:''?>">
                <input type="hidden" name="course_fee_id" id="course_fee_id4" value="">
                <input type="hidden" name="submit" value="giveDiscount">
                <div class="form-group row">
                  <label for="disAmount" class="col-sm-3 mb-3 mb-sm-0">Discount Amount</label>
                  <div class="col-sm-9 mb-3 mb-sm-0">
                    <input type="text" name="disAmount" id="disAmount" value="" class="form-control">
                    <span class="text-danger" id="disAmountErr"></span>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="description" class="col-sm-3 mb-3 mb-sm-0">Reason</label>
                  <div class="col-sm-9 mb-3 mb-sm-0">
                    <input type="text" name="description" id="description" value="" class="form-control">
                    <span class="text-danger" id="descriptionErr"></span>
                  </div>
                </div>
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-primary" >Save changes</button>
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade custom-modal" id="cancelCourseModal" tabindex="-1" role="dialog" aria-labelledby="customModal" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="cancelCourseModalLabel">Cancel Course</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="user" action="<?=current_url();?>" method="post" id="cancelCourseFormsData" onsubmit="return validate_cancel_course();" autocomplete="off">
            <?=csrf_field(); ?>
            <div class="modal-body" id="">
                <!--write body data here display to direct-->
                <div class="form-group row">
                  <label for="stu_name" class="col-sm-2 mb-3 mb-sm-0">Student's Name</label>
                  <div class="col-sm-4 mb-3 mb-sm-0">
                    <span><?=(isset($student))?$student->stu_name:''?></span>
                  </div>
                
                  <label for="course_name" class="col-sm-2 mb-3 mb-sm-0">Course</label>
                  <div class="col-sm-4 mb-3 mb-sm-0">
                    <span id="courseName5"></span>
                  </div>
                </div>
                <input type="hidden" name="stu_id" id="stu_id" value="<?=(isset($student))?$student->stu_id:''?>">
                <input type="hidden" name="course_fee_id" id="course_fee_id5" value="">
                <input type="hidden" name="submit" value="cancelCourse">
                <div class="form-group row">
                  <label for="beneficiary_name" class="col-sm-2 mb-3 mb-sm-0">Name of beneficiary:<span class="text-danger">*</span></label>
                  <div class="col-sm-4 mb-3 mb-sm-0">
                    <input type="text" name="beneficiary_name" id="beneficiary_name" value="<?=$student->beneficiary_name?>" class="form-control">
                    <span class="text-danger" id="beneficiary_nameErr"></span>
                  </div>
                
                  <label for="beneficiary_mob_no" class="col-sm-2 mb-3 mb-sm-0">Beneficiary Mobile No:<span class="text-danger">*</span></label>
                  <div class="col-sm-4 mb-3 mb-sm-0">
                    <input type="text" name="beneficiary_mob_no" id="beneficiary_mob_no" value="<?=$student->beneficiary_mob_no?>" class="form-control">
                    <span class="text-danger" id="beneficiary_mob_noErr"></span>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="bank_name" class="col-sm-2 mb-3 mb-sm-0">Bank Name:<span class="text-danger">*</span></label>
                  <div class="col-sm-4 mb-3 mb-sm-0">
                    <input type="text" name="bank_name" id="bank_name" value="<?=$student->bank_name?>" class="form-control">
                    <span class="text-danger" id="bank_nameErr"></span>
                  </div>
                
                  <label for="branch_name" class="col-sm-2 mb-3 mb-sm-0">Branch Name:<span class="text-danger">*</span></label>
                  <div class="col-sm-4 mb-3 mb-sm-0">
                    <input type="text" name="branch_name" id="branch_name" value="<?=$student->branch_name?>" class="form-control">
                    <span class="text-danger" id="branch_nameErr"></span>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="bank_ac_no" class="col-sm-2 mb-3 mb-sm-0">Bank Account No:<span class="text-danger">*</span></label>
                  <div class="col-sm-4 mb-3 mb-sm-0">
                    <input type="text" name="bank_ac_no" id="bank_ac_no" value="<?=$student->bank_ac_no?>" class="form-control">
                    <span class="text-danger" id="bank_ac_noErr"></span>
                  </div>
                
                  <label for="ifsc_code" class="col-sm-2 mb-3 mb-sm-0">IFSC Code:<span class="text-danger">*</span></label>
                  <div class="col-sm-4 mb-3 mb-sm-0">
                    <input type="text" name="ifsc_code" id="ifsc_code" value="<?=$student->ifsc_code?>" class="form-control">
                    <span class="text-danger" id="ifsc_codeErr"></span>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="cancelation_date" class="col-sm-2 mb-3 mb-sm-0">Cancelation Date:<span class="text-danger">*</span></label>
                  <div class="col-sm-4 mb-3 mb-sm-0">
                    <input type="date" name="cancelation_date" id="cancelation_date" value="" class="form-control">
                    <span class="text-danger" id="cancelation_dateErr"></span>
                  </div>
                </div>
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-primary" onclick="return confirm('Are u sure?');">Submit</button>
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade custom-modal" id="editReceiptModal" tabindex="-1" role="dialog" aria-labelledby="customModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="editReceiptModalLabel">Edit Receipt</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="user" action="<?=current_url();?>" method="post" id="editReceiptFormsData" onsubmit="return validate_edit_receipt();" autocomplete="off"> 
            <?=csrf_field()?>
            <div class="modal-body" id="">
                <!--write body data here display to direct-->
                <div class="form-group row">
                  <label for="stu_name" class="col-sm-3 mb-3 mb-sm-0">Student's Name</label>
                  <div class="col-sm-9 mb-3 mb-sm-0">
                    <span><?=(isset($student))?$student->stu_name:''?></span>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="course_name" class="col-sm-3 mb-3 mb-sm-0">Course</label>
                  <div class="col-sm-9 mb-3 mb-sm-0">
                    <span id="courseName6"></span>
                  </div>
                </div>
                <input type="hidden" name="stu_id" id="stu_id" value="<?=(isset($student))?$student->stu_id:''?>">
                <input type="hidden" name="course_fee_id" id="course_fee_id6" value="">
                <input type="hidden" name="inst_id" id="inst_id" value="">
                <input type="hidden" name="submit" value="editReceipt">
                <div class="form-group row">
                  <label for="paid_amount" class="col-sm-3 mb-3 mb-sm-0">Paid Amount</label>
                  <div class="col-sm-9 mb-3 mb-sm-0">
                    <input type="text" class="form-control" id="paid_amount" name="paid_amount" value="" >
                    <input type="hidden" name="paid_amount_o" id="paid_amount_o" value="">
                    <span class="text-danger" id="paid_amount_err"></span>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="receipt_no2" class="col-sm-3 mb-3 mb-sm-0">Receipt No</label>
                  <div class="col-sm-9 mb-3 mb-sm-0">
                    <input type="text" class="form-control" id="receipt_no2" name="receipt_no" value="" onkeyup="validate_receipt_no();">
                    <input type="hidden" name="receipt_no_o" id="receipt_no_o" value="">
                    <span class="text-danger" id="receipt_no_err"></span>
                  </div>
                </div>
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-primary" >Submit</button>
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade custom-modal" id="updateUniversityModal" tabindex="-1" role="dialog" aria-labelledby="customModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="updateUniversityModalLabel">Update/View University</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="user" action="<?=base_url('institute/update_uni_ajax');?>" method="post" id="updateUniFormsData" onsubmit="return validate_update_uni();" autocomplete="off"> 
            <?=csrf_field()?>
            <input type="hidden" name="uni_id" value="0" id="uni_id">
            <div class="modal-body" id="">
                <!--write body data here display to direct-->
                <div class="form-group row">
                  <label for="stu_name" class="col-sm-3 mb-3 mb-sm-0">Student's Name</label>
                  <div class="col-sm-9 mb-3 mb-sm-0">
                    <span><?=(isset($student))?$student->stu_name:''?></span>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="course_name" class="col-sm-3 mb-3 mb-sm-0">Course</label>
                  <div class="col-sm-9 mb-3 mb-sm-0">
                    <span id="courseName7"></span>
                  </div>
                </div>
                <input type="hidden" name="stu_id" id="stu_id" value="<?=(isset($student))?$student->stu_id:''?>">
                <input type="hidden" name="course_fee_id" id="course_fee_id7" value="">
                <!-- <input type="hidden" name="inst_id" id="inst_id" value=""> -->
                <!-- <input type="hidden" name="submit" value="editReceipt"> -->
                <div class="form-group row">
                  <label for="u_name" class="col-sm-3 mb-3 mb-sm-0">University Name<span class="text-danger">*</span></label>
                  <div class="col-sm-9 mb-3 mb-sm-0">
                    <input type="text" class="form-control" id="u_name" name="u_name" value="" >
                    <span class="text-danger" id="u_name_err"></span>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="session" class="col-sm-3 mb-3 mb-sm-0">Session<span class="text-danger">*</span></label>
                  <div class="col-sm-9 mb-3 mb-sm-0">
                    <input type="text" class="form-control" id="session" name="session" value="" >
                    <span class="text-danger" id="session_err"></span>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="u_rollno" class="col-sm-3 mb-3 mb-sm-0">University Roll No</label>
                  <div class="col-sm-9 mb-3 mb-sm-0">
                    <input type="text" class="form-control" id="u_rollno" name="u_rollno" value="" >
                    <span class="text-danger" id="u_rollno_err"></span>
                  </div>
                </div>
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-primary" >Submit</button>
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">
  $=jQuery;
  $(function(){
      $("#dob").datepicker({
        dateFormat: 'dd-MM-yy',
        todayHighlight: true,
      });
  });
  $(function(){
      $("#adm_date").datepicker({
        dateFormat: 'dd-MM-yy',
        todayHighlight: true,
      });
  });
  function update_university(id,course_name,uniDtls=''){
    $("#updateUniFormsData")[0].reset();
    // $("#course_fee_id2").val(id);
    $("#courseName7").html(course_name);
    $("#course_fee_id7").val(id);
    if(uniDtls != ''){
      uniDtls = JSON.parse(atob(uniDtls));
      $("#uni_id").val(uniDtls.uni_id);
      $("#u_name").val(uniDtls.u_name);
      $("#session").val(uniDtls.session);
      $("#u_rollno").val(uniDtls.u_rollno);
    }
    // console.log(uniDtls);return false;
    $("#updateUniversityModal").modal("show");
  }
  function validate_update_uni(){
    $("#u_name_err,#session_err").html("");
    var error = 0;
    if($("#u_name").val() == ''){
      $("#u_name_err").html("Please enter university name!");
      error = 1;
    }
    if($("#session").val() == ''){
      $("#session_err").html("Please enter session!");
      error = 1;
    }
    if(error){
      return false;
    }else{
      return true;
    }
  }
  $(function(){
      $("#dob").change(function(){
        var dob = $("#dob").val();
        var dob = new Date(dob);
        var today = new Date();
        var age = Math.floor((today-dob) / (365.25 * 24 * 60 * 60 * 1000));
        $('#age').val(age);
      });
  });

  function validate_edit_receipt(){
    $("#paid_amount_err,#receipt_no_err").html("");
    var error = 0;
    if($("#paid_amount").val() == ''){
      $("#paid_amount_err").html("Please enter amount");
      error = 1;
    }
    if($("#receipt_no2").val() == ''){
      $("#receipt_no_err").html("Please enter receipt no");
      error = 1;
    }
    if(error){
      return false;
    }else{
      return true;
    }
  }

  function validate_receipt_no(){
    $("#paid_amount_err,#receipt_no_err").html("");
    var receipt_no_o = $("#receipt_no_o").val();
    var receipt_no2 = $("#receipt_no2").val();
    if(receipt_no2 != receipt_no_o){
      $.ajax({
        type: "POST",
        url: "<?php echo base_url('institute/students/validate_receipt') ?>",
        data: {"receipt_no": receipt_no2},
        dataType: 'json',
        success: function(res){
          console.log(res);
          if(res.err != undefined && res.err == true){
            $("#receipt_no_err").attr('class','text-danger');
            $("#receipt_no_err").html(res.message);
          }else{

            $("#receipt_no_err").attr('class','text-success');
            $("#receipt_no_err").html('good to go');
          }
          
        }
      });
    }
  }
 
  $("#qualification").change(function(){
    var qly = $("#qualification").val();
    if(qly == 'other'){
      $("#other_qly").show();
    }else{
      $("#other_qly").hide();
    }
  });
  $(".fee_deposite").click(function(){
    $("#feeDepositeModal").modal("show");
  });
  function validate_fee_deposite(){
    $("#err_amount").html("");
    $("#err_receipt_no").html("");
    var error = 0;
    if($("#amount").val() == ''){
      $("#err_amount").html("Please enter amount");
      error = 1;
    }
    if($("#receipt_no").val() == ''){
      $("#err_receipt_no").html("Please enter receipt no.");
      error = 1;
    }
    if(error){
      return false;
    }else{
      return true;
    }
  }
  function show_certificate_issue_date(){
    var status = $("#status").val();
    var course_cat = $("#course_cat").val();
    if(status == 2 && course_cat == 'P'){
      $("#cerDtDiv").show();
    }else{
      $("#cerDtDiv").hide();
    }
  }
</script>
<?=$this->endSection()?>
  