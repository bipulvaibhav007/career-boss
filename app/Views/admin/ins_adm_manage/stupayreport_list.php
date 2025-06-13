<?=$this->extend("admin/_layout/master") ?>
<?=$this->section("content") ?>
  <!-- Container Fluid-->
  <div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between my-3">
        <h1 class="h3 mb-0 text-gray-800"><?=$page_title.' ('.count($stupayreport_list).')';?></h1>
        <?php /* <div class="">
        <?php if(is_privilege(29,2)){ ?>
            <a href="<?=base_url('institute/student_cu')?>" class="btn btn-primary">Add Students</a>
        <?php } ?>
        <a href="<?=base_url('institute/admission_cancelation_list')?>" class="btn btn-danger">Admission Cancelation List</a>
        </div> */ ?>
    </div>
    
    <div class="row mb-3">
      <!-- Datatables -->
    <div class="col-lg-12">
      <?php if(session()->getFlashdata('message') !== NULL){
        echo alertBS(session()->getFlashdata('message'),session()->getFlashdata('type'));
      } ?>
      <div class="card mb-1">
        <div class="card-header py-2">
            <form action="<?=base_url('institute/pending_amount')?>" method="get" id="stusearch">
                <div class="row">
                    <div class="col-md-3">
                        <input type="text" class="form-control" name="s" id="s" placeholder="Name, Mobile No" value="<?=(isset($_GET['s']) && $_GET['s'] != '')?$_GET['s']:''; ?>" title="Name, Mobile No" autocomplete="off">
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
                    <div class="col-md-3">
                        <button type="submit" class="btn btn-primary px-4">Filter</button>
                        <a href="<?=base_url('institute/reset_stu_pay_url')?>" class="btn btn-warning">Reset</a>
                        <a href="<?=base_url('/institute/payment_report_export')?>" class="btn btn-success">Download List</a>
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
                    <th>Due Date</th>
                    <th>Photo</th>
                    <th>Student's Name</th>
                    <th>Roll No</th>
                    <th>Batch Name</th>
                    <th>Course Name</th>
                    <th>Mobile</th>
                    <th>Installment Amount</th>
                    <th>Installment No</th>
                    <th>Payable Amount</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                    if(!empty($stupayreport_list)){
                    $sn=1; 
                    $total_payable_amount = 0;
                    foreach($stupayreport_list as $list){ 
                        $total_payable_amount += $list->payable_amount;
                        if($list->stu_image != ''){
                        $image = $list->stu_image;
                        }else{
                        $image = 'dummy_stu.jpg';
                        }
                    ?>
                <tr>
                  <td><?=$sn ?></td>
                  <td><?=date('M-Y',strtotime($list->next_paid_date))?></td>
                  <td><img src="<?=base_url('public/assets/upload/images/'.$image)?>" alt="stu_image" width="60px" height="60px"></td>
                  <td><?=$list->stu_name ?></td>
                  <td><?=$list->stu_roll_no?></td>
                  <td><?=$list->batch_name ?></td>
                  <td><?=$list->c_f_name ?></td>
                  <?php if($list->is_whatsapp_ph1){ ?>
                    <td><span class="d-flex align-items-center"><i class="fab fa-whatsapp-square mr-2" style="font-size:24px;color:red"></i><a href="https://api.whatsapp.com/send/?phone=%2B91<?=$list->phone1?>&text=Hello%20<?=$list->stu_name?>,%0A%0AYour%20payment%20(%20INR%20<?=$list->payable_amount?>%20)%20is%20due%20for%20<?=date('M-Y',strtotime($list->next_paid_date))?>,%20please%20pay%20the%20fee%20before%20<?=date('07-M-Y',strtotime($list->next_paid_date))?>.%0A%0AYou%20can%20use%20the%20below%20QR%20link%20for%20making%20payment.%0Ahttps://career-boss.com/qr/index.html%0A%0AThank%20you%0ACareer%20Boss&app_absent=0" target="_blank" ><?=$list->phone1?></a></span></td>
                  <?php }else{
                    echo '<td>'.$list->phone1.'</td>';
                  } ?>
                  <td><?=$list->ins_amount?></td>
                  <td><?=$list->paid_inst_no.' / '.$list->total_installment?></td>
                  <td><?=$list->payable_amount?></td>
                  
                  <th><span class="btn btn-warning btn-sm">Not Paid</span></th>
                  <td>
                      <a href="<?=base_url('institute/installment_payment/'.$list->id);?>" title="Payment" style="font-size:24px;"><i class="fa fa-credit-card" aria-hidden="true"></i></a>
                      <?php if($list->is_whatsapp_ph1){ ?>
                      <a href="<?=base_url('institute/whatsapp_mark_unmark/'.$list->stu_id);?>" title="WhatsApp UnMark"><i class='fab fa-whatsapp-square' style='font-size:24px'></i></a>
                      <?php }else{ ?>
                        <a href="<?=base_url('institute/whatsapp_mark_unmark/'.$list->stu_id);?>" title="WhatsApp Mark"><i class='fab fa-whatsapp-square' style='font-size:24px'></i></a>
                      <?php } ?>
                      <?php /*  if(in_array(3, $crud)){ ?>
                      <?php } if(in_array(4, $crud)){ ?>
                      <a href="<?=base_url('institute/students/students_view/'.$list->stu_id);?>" title="View"><i class="fas fa-eye"></i></a>
                      <?php } if(in_array(5, $crud)){ ?>
                      <a onclick="return confirm('Are you sure?');" href="<?=base_url('institute/students/delete_one/'.$list->stu_id);?>" title="Delete"><i class="fas fa-trash" style="color:red;"></i></a>
                      <?php } */ ?>
                  </td>
                </tr>
                <?php $sn++; } ?>
                    <tfoot>
                        <tr>
                            <td colspan="10"><strong>Total : </strong></td>
                            <td><strong><?=$total_payable_amount?></strong></td>
                            <td colspan="2"></td>
                        </tr>
                    </tfoot>
                <?php }else{ ?>
                    <tr>
                    <td colspan="11"><span class="text-danger">No Record Available</span></td>
                    </tr>
                <?php   }  ?>
            
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
  