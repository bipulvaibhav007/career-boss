<?=$this->extend("admin/_layout/master") ?>
<?=$this->section("content"); ?>
<!-- <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.3/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://code.jquery.com/ui/1.13.3/jquery-ui.js"></script> -->
<script language="Javascript" src="<?php echo base_url('editor/scripts/innovaeditor.js'); ?>"></script>

<style>
  
  .loader {
    position: fixed;
    left: 50%;
    top: 50%;
    border: 16px solid #f3f3f3;
    border-radius: 50%;
    border-top: 16px solid blue;
    border-right: 16px solid green;
    border-bottom: 16px solid red;
    width: 120px;
    height: 120px;
    z-index: 9999;
    -webkit-animation: spin 2s linear infinite;
    animation: spin 2s linear infinite;
  }

  @-webkit-keyframes spin {
    0% { -webkit-transform: rotate(0deg); }
    100% { -webkit-transform: rotate(360deg); }
  }

  @keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
  }
</style>

<div class="container-fluid" id="container-wrapper">
  <div class="d-sm-flex align-items-center justify-content-between mb-1">
    <h1 class="h3 mb-0 text-gray-800">University Student Details ()</h1>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="<?=base_url('admin'); ?>">Admin</a></li>
      <li class="breadcrumb-item" aria-current="page">view_stuuniversityinfo</li>
      <!--<li class="breadcrumb-item active" aria-current="page">Blank Page</li>-->
    </ol>
  </div>
  <?php if(session()->getFlashdata('message') !== NULL){
    echo alertBS(session()->getFlashdata('message'),session()->getFlashdata('type'));
  } ?>
  <div class="row mb-3">
    <div class="col-lg-12">
      
      <!-- Form Basic -->
      <div class="card mb-4">
        <div class="card-header py-1 bg-dark d-flex justify-content-between text-light">
          <h6 class="m-0 font-weight-bold">Student Details</h6>
          <div class="">
            <?php /* <a href="javascript:void(0)" class="btn btn-success btn-sm" onclick="add_amount(<?=$franchiseDtls->m_id?>)">Add Amount</a>
            <a href="<?=base_url('admin/add_edit_franchise_student/'.$franchiseDtls->m_id)?>" class="btn btn-primary btn-sm">Add Student</a>
            <a href="<?=base_url('admin/wallet_history/'.$franchiseDtls->m_id)?>" class="btn btn-warning btn-sm">Wallet History</a>*/ ?>
            <a href="<?=base_url('admin/franchise_view/'.$student->franchise_id)?>" class="btn btn-danger btn-sm">Back</a>
          </div> 
          <!-- <div class="float-right">
          </div> -->
        </div>
        
        <div class="card-body">
          <table class="table table-bordered">
            <tbody>
            <tr>
              <th>Student Name</th>
              <td><?=($student->frstu_name != '')?$student->frstu_name:'--'?></td>
              <td colspan="2"><img src="<?=base_url('public/assets/upload/images/'.$student->photo)?>" alt="Logo" width="70px" height="60px"></td>
            </tr>
            <tr>
              <th>S/O W/O D/O</th>
              <td><?=$student->so_wo_do?></td>
              <th>Mother's Name</th>
              <td><?=$student->mother_name?></td>
            </tr>
            <tr>
              <th>Dob</th>
              <td><?=date('d M-Y',strtotime($student->dob))?></td>
              <th>Mobile No</th>
              <td><?=$student->phone?></td>
            </tr>
            <tr>
              <th>Email</th>
              <td><?=$student->email?></td>
              <th>Address</th>
              <td><?=$student->full_address?></td>
            </tr>
            <tr>
              <th>University Name</th>
              <td><?=$uniDtls->u_name ?? '--'?></td>
              <th>University RegNo</th>
              <td class=""><?=$uniDtls->u_regno ?? '--'?></td>
            </tr>
            <tr>
              <th>University Roll No</th>
              <td class=""><?=$uniDtls->u_rollno ?? '--'; ?></td>
              <th>Session</th>
              <td>
                <?=$uniDtls->session ?? '--';?>
              </td>
            </tr> 
            
            
            <tr>
              <th>Course Fee</th>
              <td><span class="badge badge-success"><?=$uniDtls->course_fee ?? '--'?></span></td>
              <th>Paid Amount</th>
              <td><span class="badge badge-success"><?=$uniDtls->paid_amount ?? '--'?></span></td>
            </tr>
            <tr class="">
                <th><strong class="m-0 font-weight-bold">Receipt No</strong></th>
                <td><?=$uniDtls->receipt_no ?? '--'?></td>
                <th>Dues Amount</th>
                <td><span class="badge badge-success"><?=$uniDtls->dues_amount ?? '--'?></span></td>
            </tr>
            <tr class="">
                <th><strong class="m-0 font-weight-bold">Course</strong></th>
                <td><?=$student->c_f_name?></td>
                <th>Admission Date</th>
                <td><?=isset($uniDtls)?date('d-m-Y',strtotime($uniDtls->adm_date)):'--'?></td>
            </tr>
            </tbody>
            
          </table>
        </div>
      </div><!-- end card -->
      
      <div class="card mb-2">
        <div class="card-header py-3 bg-dark text-light d-flex justify-content-between">
          <h6 class="m-0 font-weight-bold">Fee Deposit History</h6>
          <?php /* <div class="">
            <a href="<?=base_url('admin/add_edit_franchise_student/'.$franchiseDtls->m_id)?>" class="btn btn-primary btn-sm">Add Student</a>
            <button type="button" class="btn btn-danger btn-sm" id="Change_Status" disabled>Change Status</a>
            <button type="button" class="mx-2 btn btn-danger btn-sm" id="Generate_Cert" disabled>Generate Cert</a>

          </div> */ ?>
        </div>
        <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered">
            <thead >
              <tr>
                <th>#</th>
                <th>Date</th>
                <th>Receipt No</th>
                <th>Amount</th>
              </tr>
            </thead>
            <tbody>
              <?php if(!empty($feelog)){ 
                $sn = 1;
                foreach($feelog as $list){ 
                  
                ?>
                  <tr>
                    <td><?=$sn++;?></td>
                    <td><?=($list->paid_date != '0000-00-00 00:00:00')?date('d-M-Y',strtotime($list->paid_date)):'N/A'?></td>
                    <td><?=$list->receipt_no?></td>
                    <td><?=$list->amount?></td>
                  </tr>
              <?php }
              }else{
                echo '<tr class="text-center"><td colspan="4" class="text-danger ">No List</td></tr>';
              } ?>
            </tbody>
            <?php /*($rs_pagination != '')?$rs_pagination:''*/ ?>
          </table>
          </div>
        </div>
      </div><!-- end 3rd card -->

      <?php /* <div class="card mb-2">
        <div class="card-header py-3 bg-dark text-light d-flex justify-content-between">
          <h6 class="m-0 font-weight-bold">Student's List</h6>
          <div class="">
            
            <button type="button" class="btn btn-danger btn-sm" id="Change_Status" disabled>Change Status</a>
            <button type="button" class="mx-2 btn btn-danger btn-sm" id="Generate_Cert" disabled>Generate Cert</a>

          </div>
        </div>
        <div class="card-body">
          <table class="table table-bordered table-striped table-responsive">
            <thead >
              <tr>
                <th>#</th>
                <th>
                  <div class="form-group">
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="CheckAll">
                    <label class="form-check-label" for="CheckAll"> Check All</label>
                  </div>
                  </div>
                </th>
                <th>Issue Date</th>
                <th>Photo</th>
                <th>Student's Name</th>
                <th>SO/WO/DO</th>
                <th>Mother's Name</th>
                <th>DOB</th>
                <th>Course For</th>
                <th>Duration</th>
                <th>Type</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php if(!empty($stuData)){ 
                $sn=1;
                foreach($stuData as $list){ 
                  // echo '<pre>'; print_r($list); exit;
                  $is_module_marks = 'no';
                  if($list->module_marks != ''){
                    $is_module_marks = 'yes';
                  }
                  ?>
                  <tr>
                    <td><?=$sn++;?></td>
                    <td>
                      <?php //if($list->status == 4 || $list->cert_issue_date == '0000-00-00'){}else{ ?>
                        <div class="form-check">
                          <input class="form-check-input" name="checkedIds[]" type="checkbox" value="<?=$list->frst_id?>" data-cert_issue_date="<?=$list->cert_issue_date?>" data-is_module_marks="<?=$is_module_marks?>" data-status="<?=$list->status?>" data-course_cat="<?=$list->course_cat?>" data-grade="<?=$list->grade?>" id="Check<?=$list->frst_id?>">
                          <label class="form-check-label" for="Check<?=$list->frst_id?>"></label>
                        </div>
                      <?php //} ?>
                    </td>
                    <td><?php if($list->cert_issue_date != '0000-00-00'){
                        echo date('d-M-Y',strtotime($list->cert_issue_date));
                      }else{ ?>
                        <a href="javascript:void(0)" class="btn btn-danger btn-sm updateIssue" data-frst_id="<?=$list->frst_id?>">Enter Date</a>
                      <?php } ?></td>
                    <td><img src="<?=base_url('public/assets/upload/images/'.$list->photo)?>" alt="photo" width="60px" height="50px"></td>
                    <td><a href="javascript:void(0)" onclick="view_franchise_student(<?=$list->frst_id?>)"><?=$list->frstu_name?></a></td>
                    <td><?=$list->so_wo_do?></td>
                    <td><?=$list->mother_name?></td>
                    <td><?=($list->dob != '0000-00-00')?date('d-M-Y',strtotime($list->dob)):'N/A'?></td>
                    <td><?=$list->c_f_name?></td>
                    <td><?=$list->course_duration.' Months'?></td>
                    <td><?=($list->stu_type == 'NR')?'<span class="text-dark">None-Regular</span>':'<span class="text-success">Regular</span>'?></td>
                    <td>
                        <?php 
                          $status = get_franchise_student_status_txt($list->status);
                        
                          echo $status; ?>
                    </td>
                    <td>
                        <a href="javascript:void(0);" class="btn btn-outline-info btn-sm " onclick="view_franchise_student(<?=$list->frst_id?>)"><i class="fas fa-eye"></i></a>

                        <a href="<?=base_url('admin/add_edit_franchise_student/'.$franchiseDtls->m_id.'/'.$list->frst_id)?>" class="btn btn-outline-info btn-sm " ><i class="fas fa-edit"></i></a>
                        
                        <?php if($list->status < 1 || $list->status == 4){ ?>
                        <a href="<?=base_url('admin/delete_franchise_student/'.$franchiseDtls->m_id.'/'.$list->frst_id)?>" class="btn btn-outline-danger btn-sm" onclick="return confirm('Are u sure?')" ><i class="fas fa-trash"></i></a>
                        <?php } ?>
                      <?php /*  if(is_privilege(18,5)){ ?>
                        <?php if($list->status == 3 && $list->amount_status == 1){ ?>
                          
                          <a href="javascript:void(0);" class="btn btn-warning btn-sm paidToReferral" data-stu_id="<?=$list->stu_id?>" data-stu_name="<?=$list->stu_name?>" data-member_id="<?=$list->member_id?>">Paid To Referral</a>
                        <?php }else if($list->status == 3 && $list->amount_status == 2){ 
                          echo 'Amount Credited to referral';
                         }else{ ?>
                          <a href="javascript:void(0);" class="btn btn-primary btn-sm stuchangestatus" data-stu_id="<?=$list->stu_id?>" data-stu_name="<?=$list->stu_name?>" data-status="<?=$list->status?>" data-description="<?=$list->description?>">Change Status</a>
                        <?php } ?>
                      <?php } * ?>
                    </td>
                  </tr>
              <?php }
              }else{
                echo '<tr class="text-center"><td colspan="13" class="text-danger ">No List</td></tr>';
              } ?>
            </tbody>
          </table>
        </div>
      </div><!-- end 3rd card -->
      <div class="card mb-2">
        <div class="card-header py-2 bg-dark text-light d-flex justify-content-between">
          <h6 class="m-0 font-weight-bold">Certified Student's List (<?=count($certStuData).'/'.$TotCertStu?>)</h6>
          <form action="<?=current_url()?>" method="post">
            <?=csrf_field(); ?>
          <div class="d-flex flex-row bd-highlight">
            <input type="text" name="search" id="search" class="form-control" value="<?=set_value('search')?>" placeholder="Reg. No/Cert. No/Student's name" required>
            <input type="hidden" name="submit" value="certifiedStu">
            <button type="submit" class="mx-2 btn btn-primary btn-sm" >Search</button>
            <a href="<?=base_url('admin/franchise_view/'.$franchiseDtls->m_id)?>" class="btn btn-warning btn-sm" >Reset</a>
          </div>
          </form>
        </div>
        <div class="card-body">
          <table class="table table-bordered table-striped table-responsive">
            <thead>
              <tr>
                <th>#</th>
                <!-- <th>
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="CheckAll">
                    <label class="form-check-label" for="CheckAll"> Check All</label>
                  </div>
                </th> -->
                <th>Reg No/<br>Cert No</th>
                <th>Issue Date</th>
                <th>Photo</th>
                <th>Student's Name</th>
                <th>SO/WO/DO</th>
                <th>Mother's Name</th>
                <th>DOB</th>
                <th>Course For</th>
                <th>Duration</th>
                <!-- <th>Type</th> -->
                <th>Status</th>
                <th>Reg.Fee</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php if(!empty($certStuData)){ 
                $page = (isset($_GET['cs-page']))?$_GET['cs-page']:1;
                if($page == 1){
                    $sn=1;
                }else{
                    $sn = $limit * ($page-1) + 1;
                }
                foreach($certStuData as $list){ 
                  
                ?>
                  <tr>
                    <td><?=$sn++;?></td>
                    <?php /* <td>
                        <div class="form-check">
                          <input class="form-check-input" name="checkedIds[]" type="checkbox" value="<?=$list->frst_id?>" id="Check<?=$list->frst_id?>">
                          <label class="form-check-label" for="Check<?=$list->frst_id?>"></label>
                        </div>
                    </td>* ?>
                    <td><?=$list->reg_no.'/<br>'.$list->cert_no?></td>
                    <td><?=($list->cert_issue_date != '0000-00-00')?date('d-M-Y',strtotime($list->cert_issue_date)):'N/A'?></td>
                    <td><img src="<?=base_url('public/assets/upload/images/'.$list->photo)?>" alt="photo" width="60px" height="50px"></td>
                    <td><a href="javascript:void(0)" onclick="view_franchise_student(<?=$list->frst_id?>)"><?=$list->frstu_name?></a></td>
                    <td><?=$list->so_wo_do?></td>
                    <td><?=$list->mother_name?></td>
                    <td><?=($list->dob != '0000-00-00')?date('d-M-Y',strtotime($list->dob)):'N/A'?></td>
                    <td><?=$list->c_f_name?></td>
                    <td><?=$list->course_duration.' Months'?></td>
                    <!-- <td><?=($list->stu_type == 'NR')?'<span class="text-dark">None-Regular</span>':'<span class="text-success">Regular</span>'?></td> -->
                    <td>
                        <?php 
                          $status = get_franchise_student_status_txt($list->status);
                        
                          echo $status; ?>
                    </td>
                    <td><?=($list->reg_fee_status == 'D')?'<span class="btn btn-danger btn-sm">DUES</span>':'<span class="btn btn-success btn-sm">PAID</span>'?></td>
                    <td>
                        <a href="javascript:void(0);" class="btn btn-outline-info btn-sm " onclick="view_franchise_student(<?=$list->frst_id?>)"><i class="fas fa-eye"></i></a>
                        <a href="javascript:void(0);" class="btn btn-outline-info btn-sm " onclick="view_certificate('<?=$list->cert_no?>')">View Cert</a>
                        <?php if($list->course_cat == 'C'){ ?>
                        <a href="javascript:void(0);" class="btn btn-outline-info btn-sm " onclick="view_marksheet('<?=$list->cert_no?>')">View Marksheet</a>
                        <?php } ?>
                        <a href="<?=base_url('admin/reject_cert/'.$list->frst_id.'/'.$list->franchise_id)?>" class="btn btn-outline-danger btn-sm" onclick="return confirm('Are u sure to reject certificate?')">Reject</a>
                        
                      <?php /*  if(is_privilege(18,5)){ ?>
                        <?php if($list->status == 3 && $list->amount_status == 1){ ?>
                          
                          <a href="javascript:void(0);" class="btn btn-warning btn-sm paidToReferral" data-stu_id="<?=$list->stu_id?>" data-stu_name="<?=$list->stu_name?>" data-member_id="<?=$list->member_id?>">Paid To Referral</a>
                        <?php }else if($list->status == 3 && $list->amount_status == 2){ 
                          echo 'Amount Credited to referral';
                         }else{ ?>
                          <a href="javascript:void(0);" class="btn btn-primary btn-sm stuchangestatus" data-stu_id="<?=$list->stu_id?>" data-stu_name="<?=$list->stu_name?>" data-status="<?=$list->status?>" data-description="<?=$list->description?>">Change Status</a>
                        <?php } ?>
                      <?php } * ?>
                    </td>
                  </tr>
              <?php }
              }else{
                echo '<tr class="text-center"><td colspan="10" class="text-danger ">No List</td></tr>';
              } ?>
            </tbody>
            <?=($cs_pagination != '')?$cs_pagination:''?>
          </table>
        </div>
      </div><!-- end 3rd card --> */ ?>


    </div><!-- end column -->
  </div><!-- end row -->

  <div class="loader" id="loader" style="display:none;"></div>

  <!-- Modal -->
  <div class="modal fade" id="addAmountModal" tabindex="-1" role="dialog" aria-labelledby="addAmountModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header bg-success">
          <h5 class="modal-title text-light" id="addAmountModalLabel">Add Amount</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="<?=current_url();?>" method="post" onsubmit="return validate_amount();">
        <?=csrf_field(); ?>
        <input type="hidden" name="m_id" value="" id="m_id">
        <input type="hidden" name="submit" value="addAmount" id="addAmount">
        <div class="modal-body">
          <div class="form-group row">
              <label for="amount" class="col-md-2">Amount: </label>
              <div class="col-md-10 ">
                <input type="number" name="amount" id="amount" class="form-control" value="" placeholder="Ex:5000">
                <span class="text-danger" id="amountErr"></span>
              </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>
        </form>
      </div>
    </div>
  </div>
  <!-- Modal -->
  <div class="modal fade" id="stuchangestatusModal" tabindex="-1" role="dialog" aria-labelledby="stuchangestatusModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header bg-primary">
          <h5 class="modal-title text-light" id="stuchangestatusModalLabel">Change Status</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="<?=current_url();?>" method="post" onsubmit="return validate_changeStatus();">
        <?=csrf_field(); ?>
        <input type="hidden" name="frst_id" value="" id="frst_id">
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
                <select name="status" id="frst_status" class="form-control">
                  <option value="">Select One</option>
                  <?php $statusArr = franchise_statuses();
                  foreach($statusArr as $val=>$statusname){
                    echo '<option value="'.$val.'">'.$statusname.'</option>';
                  } ?>
                </select>
                <span class="text-danger" id="frst_statusErr"></span>
              </div>
          </div>
          <div class="form-group row" >
              <label for="reg_fee2" class="col-md-2">Reg Fee: </label>
              <div class="col-md-10 ">
                <input type="text" name="reg_fee" id="reg_fee2" value="" class="form-control">
                <span class="text-danger" id="regFeeErr"></span>
              </div>
          </div>
          <div class="form-group row">
              <label for="stu_name" class="col-md-2">Description: </label>
              <div class="col-md-10 ">
                <input type="text" name="description" id="description" class="form-control" value="">
              </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Modal -->
  <div class="modal fade" id="unistuchangestatusModal" tabindex="-1" role="dialog" aria-labelledby="unistuchangestatusModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header bg-success">
          <h5 class="modal-title text-light" id="unistuchangestatusModalLabel">Change Status (University Student)</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="<?=current_url();?>" method="post" >
        <?=csrf_field(); ?>
        <input type="hidden" name="frst_id" value="" id="frst_id4">
        <input type="hidden" name="submit" value="unichangeStatus" id="unichangeStatus">
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
                <select name="status" id="frst_status3" class="form-control" >
                  <option value="">Select One</option>
                  <option value="5">On Approval</option>
                  <option value="6">Approved</option>
                  <option value="7">Denied</option>
                  <!-- <option value="2">Edit</option> -->
                  <!-- <option value="1">Inprogress</option> -->
                  
                </select>
                <span class="text-danger" id="frst_statusErr2"></span>
              </div>
          </div>
          <?php /* <div class="form-group row" >
              <label for="reg_fee" class="col-md-2">Reg Fee: </label>
              <div class="col-md-10 ">
                <input type="text" name="reg_fee" id="reg_fee" value="<?=$franchiseDtls->reg_fee?>" class="form-control">
                <span class="text-danger" id="regFeeErr"></span>
              </div>
          </div> 
          <div class="form-group row" >
              <label for="desc" class="col-md-2">Description: </label>
              <div class="col-md-10 ">
                <input type="text" name="desc" id="desc" value="" class="form-control">
                <span class="text-danger" id="descErr"></span>
              </div>
          </div>*/ ?>
          
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Modal -->
  <div class="modal fade" id="regstuchangestatusModal" tabindex="-1" role="dialog" aria-labelledby="regstuchangestatusModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header bg-primary">
          <h5 class="modal-title text-light" id="regstuchangestatusModalLabel">Change Status</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="<?=current_url();?>" method="post" >
        <?=csrf_field(); ?>
        <input type="hidden" name="frst_id" value="" id="frst_id3">
        <input type="hidden" name="submit" value="regchangeStatus" id="regchangeStatus">
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
                <select name="status" id="frst_status3" class="form-control" >
                  <option value="">Select One</option>
                  <option value="5">On Approval</option>
                  <option value="6">Approved</option>
                  <option value="7">Denied</option>
                  <option value="2">Edit</option>
                  <option value="1">Inprogress</option>
                  
                </select>
                <span class="text-danger" id="frst_statusErr2"></span>
              </div>
          </div>
          <div class="form-group row" >
              <label for="reg_fee" class="col-md-2">Reg Fee: </label>
              <div class="col-md-10 ">
                <input type="text" name="reg_fee" id="reg_fee" value="" class="form-control">
                <span class="text-danger" id="regFeeErr"></span>
              </div>
          </div>
          <div class="form-group row" >
              <label for="desc" class="col-md-2">Description: </label>
              <div class="col-md-10 ">
                <input type="text" name="desc" id="desc" value="" class="form-control">
                <span class="text-danger" id="descErr"></span>
              </div>
          </div>
          
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>
        </form>
      </div>
    </div>
  </div>
  

  <!--issue date modal -->
  <div class="modal fade" id="issueDateModal" tabindex="-1" role="dialog" aria-labelledby="issueDateModalLabel" aria-hidden="true" >
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header bg-primary">
          <h5 class="modal-title text-light" id="issueDateModalLabel">Enter Issue Date</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="<?=current_url();?>" method="post" onsubmit="return validate_issueDate();">
        <?=csrf_field(); ?>
        <input type="hidden" name="frst_id" value="" id="frst_id2">
        <input type="hidden" name="submit" value="issueDate" id="issueDate">
        <div class="modal-body">
          <!-- <div class="form-group row">
              <label for="stu_name" class="col-md-2">Name: </label>
              <div class="col-md-10">
                <p><strong id="stu_name"></strong></p>
              </div>
          </div> -->
          <div class="form-group row">
              <label for="cert_issue_date" class="col-md-3">Enter Issue Date: </label>
              <div class="col-md-9 ">
                <input type="text" name="cert_issue_date" id="cert_issue_date" value="" class="form-control" placeholder="DD-MM-YYYY" autocomplete="off">
                <span class="text-danger" id="issueDateErr"></span>
              </div>
          </div>
          
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>
        </form>
      </div>
      
    </div>
  </div>

  <!-- Bank Details Status Modal -->
  <div class="modal fade" id="certificateViewModal" tabindex="-1" role="dialog" aria-labelledby="certificateViewModalLabel" aria-hidden="true" >
    <div class="modal-dialog modal-lg" role="document" >
      <div class="modal-content" >
        <div class="modal-header bg-info">
          <h5 class="modal-title text-light" id="certificateViewModalLabel">Certificate</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        
        <div class="modal-body" >
          
          <iframe id="certView" src="" width="780px" style="height:700px" title="Certificate"></iframe>
          
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

  <!-- franchiseStudent Modal -->
  <div class="modal fade" id="franchiseStudentModal" tabindex="-1" role="dialog" aria-labelledby="franchiseStudentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document" >
      <div class="modal-content">
        <div class="modal-header bg-success">
          <h5 class="modal-title text-light" id="franchiseStudentModalLabel">Student Details</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body" id="franchiseStudentModalBody">
          
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <!-- <button type="submit" class="btn btn-primary">Submit</button> -->
        </div>
      </div>
    </div>
  </div>
  
  <script>
    function add_amount(m_id){
      $("#m_id").val(m_id);
      $("#amount").val('');
      $("#amountErr").html('');
      $("#addAmountModal").modal('show');

    }
    function validate_amount(){
      $("#amountErr").html('');
      var amount = $("#amount").val();
      if(amount == '' || amount < 1){
        $("#amountErr").html('Please enter amount!');
        return false;
      } 
      return true;
    }
    $( function() {
      $("#cert_issue_date").datepicker(
          {dateFormat: 'dd-mm-yy'}
      );
      
    });
    function view_certificate(cert_no){
      certUrl = "<?=base_url('public/assets/pdf')?>"+"/"+cert_no+".pdf";
      $("#certView").attr("src", certUrl);
      $("#certificateViewModal").modal("show");
    }
    function view_marksheet(cert_no){
      certUrl = "<?=base_url('public/assets/pdf')?>"+"/"+cert_no+"M.pdf";
      $("#certView").attr("src", certUrl);
      $("#certificateViewModal").modal("show");
    }
    function view_franchise_student(frst_id){
      if(frst_id){
        $.ajax({
          type: "post",
          url: "<?=base_url('admin/view_franchise_student_by_ajax');?>",
          data: {frst_id:frst_id},
          beforeSend: function() {
            // loader open
            $("#loader").show();
          },
          success: function(res){
            console.log(res);
            $("#loader").hide();
            $("#franchiseStudentModalBody").html(res);
            $("#franchiseStudentModal").modal("show");
          }
        })
      }
    }

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
        $('#Change_Status, #Generate_Cert').removeAttr('disabled');
      }else{
        $('#Change_Status, #Generate_Cert').attr('disabled', true);
      }
    }

    $("#Change_Status").click(function () {
      var checkedIds = [];
      $('input[name="checkedIds[]"]:checked').each(function (){
        checkedIds.push($(this).val());
      });
      $("#frst_id").val(checkedIds);

      $("#stuchangestatusModal").modal("show");
    });
    function validate_changeStatus(){
      $("#frst_statusErr").html('');
      var status = $("#frst_status").val();
      if(status == ''){
        $("#frst_statusErr").html('Please select status!');
        return false;
      } 
      return true;
    }
    function validate_issueDate(){
      $("#issueDateErr").html('');
      var i_date = $("#cert_issue_date").val();
      if(i_date == ''){
        $("#issueDateErr").html('Please Enter Date!');
        return false;
      } 
      return true;
    }

     $("#Generate_Cert").click(function(){
      if(confirm('Are u sure want to generate certificate?')){
        var frstIds = [];
        var error = 0;
        var alertMsg = '';
        $('input[name="checkedIds[]"]:checked').each(function (){

          var status = $(this).attr('data-status');
          if(status != 1){
            error = 1;
            alertMsg = 'Please change status into Inprogress.';
            return false;
          }
          // var grade = $(this).attr('data-grade');
          // if(grade == ''){
          //   error = 1;
          //   alertMsg = 'Please enter the grade.';
          //   return false;
          // }
          var course_cat = $(this).attr('data-course_cat');
          if(course_cat == 'C' || course_cat == 'T'){
            var is_module_marks = $(this).attr('data-is_module_marks');
            if(is_module_marks == 'no'){
              error = 1;
              alertMsg = 'Please enter module marks';
              return false;
            }
          }
          var cert_issue_date = $(this).attr('data-cert_issue_date');
          if(cert_issue_date == '0000-00-00'){
            error = 1;
            alertMsg = 'Please fill issue date!';
            return false;
          }
          frstIds.push($(this).val());
        });
        if(error){
          alert(alertMsg);
          return false;
        }else{
          var frst_ids = frstIds.toString();
          var m_id = '';
          $.ajax({
            type: "post",
            url: "<?=base_url('admin/generate_cert_by_ajax');?>",
            data: {frst_ids:frst_ids, m_id:m_id},
            dataType: 'json',
            beforeSend: function() {
              // loader open
              $("#loader").show();
            },
            success: function(res){
              console.log(res);
              $("#loader").hide();
              if(res.res != undefined){
                window.location.href = res.url;
              }
              // $("#franchiseStudentModalBody").html(res);
              // $("#franchiseStudentModal").modal("show");
            }
          });
        }
      }else{
        return false;
      }
      // alert(checkedIds);
    });

    $(".updateIssue").click(function(){
      $("#cert_issue_date").val('');
      var frst_id = $(this).data("frst_id");
      $("#frst_id2").val(frst_id);
      $("#issueDateModal").modal("show");
      
    });

    $(".reg_stu_change_status").click(function(){
      var frst_id = $(this).data("frst_id");
      // var status = $(this).data("status");
      $("#frst_id3").val(frst_id);
      // $("#frst_status3").val(status);
      $("#regstuchangestatusModal").modal("show");
    });
    $(".uni_stu_change_status").click(function(){
      var frst_id = $(this).data("frst_id");
      // var status = $(this).data("status");
      $("#frst_id4").val(frst_id);
      // $("#frst_status3").val(status);
      $("#unistuchangestatusModal").modal("show");
    });
  </script>
  <?=$this->endSection()?>