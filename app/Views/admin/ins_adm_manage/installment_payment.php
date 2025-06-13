<?=$this->extend("admin/_layout/master") ?>
<?=$this->section("content") ?>
  <!-- Container Fluid-->
  <div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between my-3">
        <h1 class="h3 mb-0 text-gray-800"><?=$page_title .' (Month - Year: '.date('M-Y',strtotime($student->next_paid_date)).')';?></h1>
        <div class="">
            <a href="<?=base_url('institute/pending_amount_listing')?>" class="btn btn-danger">Back</a>
        </div>
    </div>
    
    <div class="row mb-3">
      <!-- Datatables -->
        <div class="col-lg-12">
            <?php if(session()->getFlashdata('message') !== NULL){
                echo alertBS(session()->getFlashdata('message'),session()->getFlashdata('type'));
            } ?>
            <div class="card mb-2">
                
                <div class="card-body">
                    <div class="form-group row">
                        <label for="stu_name" class="col-sm-2 mb-3 mb-sm-0">Student's Name:</label>
                        <div class="col-sm-4">
                            <span><?=isset($student)?$student->stu_name:''; ?></span>
                        </div>
                        <?php if(isset($student) && $student->stu_image != ''){ ?>
                        <div class="col-sm-6">
                            <img src="<?=base_url('public/assets/upload/images/'.$student->stu_image)?>" alt="image" width="100px;" height="80px;">
                        </div>
                        <?php } ?>
                    </div>
                    <?php /*<div class="form-group row">
                        <label for="f_name" class="col-sm-2 mb-3 mb-sm-0">Father's Name:</label>
                        <div class="col-sm-10">
                            <span><?=isset($student)?$student->f_name:''; ?></span>
                        </div>
                    </div> */ ?>
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
                    <label for="batch_id" class="col-sm-2 mb-3 mb-sm-0">Batch: </label>
                    <div class="col-sm-4">
                        <span><strong><?=isset($student)?$student->batch_name:''; ?></strong></span>
                    </div>
                    <label for="course_id" class="col-sm-2 mb-3 mb-sm-0">Course: </label>
                    <div class="col-sm-4">
                        <span><?=isset($student)?$student->c_f_name:''; ?></span>
                    </div>
                    </div>
                    <div class="form-group row">
                    <label for="stu_roll_no" class="col-sm-2 mb-3 mb-sm-0">Roll No: </label>
                    <div class="col-sm-4">
                        <span><strong><?=isset($student)?$student->stu_roll_no:''; ?></strong></span>
                    </div>
                    <label for="stu_reg_no" class="col-sm-2 mb-3 mb-sm-0">Reg. No: </label>
                    <div class="col-sm-4">
                        <span><?=isset($student)?$student->stu_reg_no:''; ?></span>
                    </div>
                    </div>
                    <div class="form-group row">
                        <label for="course_fee" class="col-sm-2 mb-3 mb-sm-0">Course Fee:</label>
                        <div class="col-sm-4">
                            <span><?=isset($student)?'<strong>'.strtoupper($student->course_fee).'</strong>':''; ?></span>
                        </div>
                        <label for="adm_fee" class="col-sm-2 mb-3 mb-sm-0">Admission Fee:</label>
                        <div class="col-sm-4">
                            <span><?=isset($student)?'<strong>'.strtoupper($student->adm_fee).'</strong>':''; ?></span>
                        </div> 
                    </div>
                    <div class="form-group row">
                        <label for="co_address" class="col-sm-2 mb-3 mb-sm-0">Paid Amount:</label>
                        <div class="col-sm-4">
                            <span><?=isset($student)?$student->paid_amount:''; ?></span>
                        </div>
                    
                        <label for="dob" class="col-sm-2 mb-3 mb-sm-0">Amount Due:</label>
                        <div class="col-sm-4">
                            <span><?=isset($student)?$student->dues_amount:''; ?></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="age" class="col-sm-2 mb-3 mb-sm-0">Installment Amount:</label>
                        <div class="col-sm-4">
                            <span><?=isset($student)?$student->ins_amount:''; ?></span>
                        </div>
                        <label for="email" class="col-sm-2 mb-3 mb-sm-0">Installment No:</label>
                        <div class="col-sm-4">
                            <span><?=isset($student)?$student->paid_inst_no.' / '.$student->total_installment:''; ?></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="qualification" class="col-sm-2 mb-3 mb-sm-0"><strong>Payable Amount:</strong></label>
                        <div class="col-sm-4">
                            <span><strong><?=isset($student)?$student->payable_amount:''; ?></strong></span>
                        </div>
                        <label for="qualification" class="col-sm-2 mb-3 mb-sm-0"><strong>Status:</strong></label>
                        <div class="col-sm-4">
                        <?=get_student_status($student->status)?>
                        </div>
                    </div>
                    <hr>
                    <?php //if(isset($student) && $student->credit_status == '0'){ ?>
                    <form action="<?=current_url()?>" method="post" autocomplete="off">
                        <?=csrf_field(); ?>
                        <div class="form-group row">
                        <label for="amount" class="col-sm-2 mb-3 mb-sm-0">Payable Amount : </label>
                        <div class="col-sm-4">
                            <input type="text" name="amount" value="<?=set_value('amount'); ?>" class="form-control">
                            <span class="text-danger"><?= isset($validation) ? display_error($validation, 'amount') : '' ?></span>
                        </div> 
                        </div>
                        <div class="form-group row">
                        <label for="receipt_no" class="col-sm-2 mb-3 mb-sm-0">Receipt No : </label>
                        <div class="col-sm-4">
                            <input type="text" name="receipt_no" value="<?=set_value('receipt_no'); ?>" class="form-control">
                            <span class="text-danger"><?= isset($validation) ? display_error($validation, 'receipt_no') : '' ?></span>
                        </div> 
                        </div>
                        <div class="form-group row">
                        <label for="paid_date" class="col-sm-2 mb-3 mb-sm-0">Paid Date : </label>
                        <div class="col-sm-4">
                            <input type="date" name="paid_date" value="<?=date('Y-m-d'); ?>" class="form-control">
                        </div> 
                        </div>
                        <input type="hidden" name="id" value="<?=(isset($student))?$student->id:''?>">

                        <?php /*<input type="hidden" name="log_id" value="<?=(isset($student))?$student->log_id:''?>">
                        <input type="hidden" name="debit_amount" value="<?=(isset($student))?$student->debit_amount:''?>">
                        <input type="hidden" name="ins_amount" value="<?=(isset($student))?$student->ins_amount:''?>">
                        <input type="hidden" name="tot_no_of_ins" value="<?=(isset($student))?$student->tot_no_of_ins:''?>">
                        <input type="hidden" name="payable_ins_no" value="<?=(isset($student))?$student->payable_ins_no:''?>">
                        <input type="hidden" name="due_date" value="<?=(isset($student))?$student->due_date:''?>">
                        <input type="hidden" name="amount_payable" value="<?=(isset($student))?$student->amount_payable:''?>">
                        <input type="hidden" name="insert_place" value="<?=(isset($student))?$student->insert_place:''?>"> */?>
                        <button type="submit" class="btn btn-primary">Payment</button>
                    </form>
                </div>

            </div> <!-- 1st card end -->

            <div class="card shadow mb-2">
                <div class="card-header py-2">
                <div class="d-sm-flex align-items-center justify-content-between mb-2">
                    <h2 class="h3 mb-0 text-gray-800">Fee Log</h2>
                    <?php /* <a href="javascript:void(0);" class="d-none d-sm-inline-block btn btn-sm btn-primary fee_deposite"> Fee Deposite</a> */ ?>
                </div>
                </div>
                <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-sm" id="dataTable" width="100%" cellspacing="0">
                    <thead class="thead-dark">
                        <tr>
                        <th>#</th>
                        <th>Due Date</th>
                        <th>Paid Date</th>
                        <th>Receipt No.</th>
                        <th>Paid Amount</th>
                        <th>Description</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(!empty($fee_log)){
                        $sn=1; 
                        $totalAmt = 0;
                        foreach($fee_log as $key=>$list){ 
                        $totalAmt += $list->paid_amount;  
                        ?>
                        <tr>
                            <td><?=$sn++;?></td>
                            <td><?=($list->due_date != '0000-00-00')?date('M Y',strtotime($list->due_date)):'<span class="text-danger">--</span>';?></td>
                            <td><?=($list->paid_date != '0000-00-00')?date('d, M Y',strtotime($list->paid_date)):'<span class="text-danger">Not Paid</span>';?></td>
                            <td><?=$list->receipt_no?></td>
                            <td><?=$list->paid_amount?></td>
                            <td><?=$list->description?></td>
                        </tr>
                        <?php } ?>
                        
                    </tbody>
                    <tfoot>
                        <tr>
                        <td colspan="4"><b>Total</b></td>
                        <td colspan="2"><b><?=$totalAmt?></b></td>
                        </tr>
                    </tfoot>
                    
                    <?php } ?>
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

        $(function(){
          $("#date").datepicker({
            dateFormat: 'dd-MM-yy',
            todayHighlight: true,
          });
        });
        $(function() {
            $("#dateto").datepicker({
                dateFormat: 'dd-MM-yy',
                odayHighlight: true,
            });
        });
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
  