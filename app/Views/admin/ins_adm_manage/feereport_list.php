<?=$this->extend("admin/_layout/master") ?>
<?=$this->section("content") ?>
  <!-- Container Fluid-->
  <div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between my-3">
        <h1 class="h3 mb-0 text-gray-800"><?=$page_title.' ('.count($feereport_list).')';?></h1>
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
            <form action="<?=base_url('institute/payment_receipt')?>" method="get" id="stusearch">
                <div class="row">
                <div class="col-md-2">
                    <input type="text" class="form-control" name="date" id="date" placeholder="Date From" value="<?=(isset($_GET['date']) && $_GET['date'] != '')?$_GET['date']:''; ?>" title="Date From" autocomplete="off">
                </div>
                <div class="col-md-2">
                    <input type="text" class="form-control" name="dateto" id="dateto" placeholder="Date To" value="<?=(isset($_GET['dateto']) && $_GET['dateto'] != '')?$_GET['dateto']:''; ?>" title="Date To" autocomplete="off">
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
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary px-4">Filter</button>
                        <a href="<?=base_url('institute/reset_fee_collect_url')?>" class="btn btn-warning">Reset</a>
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
                    <th>Paid Date</th>
                    <th>Due Date</th>
                    <th>Photo</th>
                    <th>Student's Name</th>
                    <th>Roll No</th>
                    <th>Batch Name</th>
                    <!-- <th>Batch Time</th> -->
                    <th>Course Name</th>
                    <!-- <th>Mobile</th> -->
                    <th>Payment Type</th>
                    <th>Description</th>
                    <!-- <th>Email</th> -->
                    <th>Receipt No</th>
                    <th>Paid Amount</th>
                    <!-- <th>Status</th> -->
                    <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                    if(!empty($feereport_list)){
                    $sn=1; 
                    $total_paid_amount = 0;
                    foreach($feereport_list as $list){ 
                        //$total_adm_fee += $list->adm_fee;
                        $total_paid_amount += (int)$list->paid_amount;
                        if($list->stu_image != ''){
                        $image = $list->stu_image;
                        }else{
                        $image = 'dummy_stu.jpg';
                        }
                    ?>
                <tr>
                  <td><?=$sn ?></td>
                  <td><?=date('d-m-Y',strtotime($list->paid_date)) ?></td>
                  <td><?=($list->due_date != '0000-00-00')?date('M-Y',strtotime($list->due_date)):'--' ?></td>
                  <td><img src="<?=base_url('public/assets/upload/images/'.$image)?>" alt="stu_image" width="60px" height="60px"></td>
                  <td><?=$list->stu_name ?></td>
                  <td><?=$list->stu_roll_no ?></td>
                  <td><?=$list->batch_name ?></td>
                  <td><?=$list->c_f_name ?></td>
                  <!-- <td><?=$list->phone1 ?></td> -->
                  <td><?=strtoupper($list->payment_type)?></td>
                  <td><?=$list->description?></td>
                  <td><?=$list->receipt_no?></td>
                  <td><?=$list->paid_amount?></td>
                  <td>
                    <?php if(is_privilege(30,4)){ ?>
                      <a href="<?=base_url('institute/student_view/'.$list->stu_id);?>" title="View"><i class="fas fa-eye"></i></a>
                    <?php } ?>
                      <?php /* if(in_array(3, $crud)){ ?>
                      <a href="<?=base_url('institute/students/students_cu/'.$list->stu_id);?>" title="Edit"><i class="fas fa-edit"></i></a>
                      
                      <?php } if(in_array(5, $crud)){ ?>
                      <a onclick="return confirm('Are you sure?');" href="<?=base_url('institute/students/delete_one/'.$list->stu_id);?>" title="Delete"><i class="fas fa-trash" style="color:red;"></i></a>
                      <?php } */ ?>
                  </td>
                </tr>
                <?php $sn++; } ?>
                <tfoot>
                    <tr>
                        <td colspan="11"><strong>Total : </strong></td>
                        <td><strong><?=$total_paid_amount?></strong></td>
                        <td></td>
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
  