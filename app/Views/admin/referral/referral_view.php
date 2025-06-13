<?=$this->extend("admin/_layout/master") ?>
<?=$this->section("content") ?>
<script language="Javascript" src="<?php echo base_url('editor/scripts/innovaeditor.js'); ?>"></script>
<div class="container-fluid" id="container-wrapper">
  <div class="d-sm-flex align-items-center justify-content-between mb-1">
    <h1 class="h3 mb-0 text-gray-800">Referral View</h1>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="<?=base_url('admin'); ?>">Admin</a></li>
      <li class="breadcrumb-item" aria-current="page">referral_view</li>
      <!--<li class="breadcrumb-item active" aria-current="page">Blank Page</li>-->
    </ol>
  </div>
  <div class="row mb-3">
    <div class="col-lg-12">
      <?php if(session()->getFlashdata('message') !== NULL){
        echo alertBS(session()->getFlashdata('message'),session()->getFlashdata('type'));
      } ?>
      <!-- Form Basic -->
      <div class="card mb-4">
        <div class="card-header py-1 bg-dark d-flex justify-content-between text-light">
          <h6 class="m-0 font-weight-bold">Personal Details</h6>
          <a href="<?=base_url('admin/referral')?>" class="btn btn-danger btn-sm">Back</a>
          <!-- <div class="float-right">
          </div> -->
        </div>
        <div class="card-body">
          <table class="table">
            <tr>
              <th>Name</th>
              <td><?=$referralDtls->m_full_name?></td>
              <th>Mobile No</th>
              <td><?=$referralDtls->phone?></td>
            </tr>
            <tr>
              <th>Address</th>
              <td><?=$referralDtls->address?></td>
              <th>Status</th>
                <?php 
                    if($referralDtls->status == 1){
                        $status = '<span class="btn btn-success btn-sm">Active</span>';
                    }else{
                        $status = '<span class="btn btn-warning btn-sm">Inactive</span>';
                    }
                ?>
              <td>
                <?=$status?>
              </td>
            </tr>
            <tr>
              <th>Total Earn</th>
              <td><span class="badge badge-warning"><?=$referralDtls->earn_amount?></span></td>
              <th>Total Credit</th>
              <td><span class="badge badge-success"><?=$referralDtls->credit_amount?></span></td>
            </tr>
            <tr class="bg-dark text-light">
                <td colspan="3"><strong class="m-0 font-weight-bold">Bank Details</strong></td>
                <?php if(isset($referralDtls->bnkdtlsstatus)){ ?>
                <td>
                  <?php if(is_privilege(18,4)){ ?>
                  <a href="javascript:void(0);" class="btn btn-danger btn-sm float-right changeBnkDtls" data-mid="<?=$referralDtls->m_id?>" data-bnkdtlsstatus="<?=$referralDtls->bnkdtlsstatus?>">Change Bank Details Status</a>
                  <?php } ?>
                </td>
                <?php }else{
                  echo '<td><a href="javascript:void(0);" class="btn btn-danger btn-sm float-right">Not Yet Upload</a></td>';
                } ?>
            </tr>
            <tr>
                <th>Account Holder name</th>
                <td><?=(isset($referralDtls->acc_holder_name))?$referralDtls->acc_holder_name:'N/A'?></td>
                <th>Bank Name</th>
                <td><?=(isset($referralDtls->bank_name))?$referralDtls->bank_name:'N/A'?></td>
            </tr>
            <tr>
                <th>Account No</th>
                <td><?=(isset($referralDtls->acc_no))?$referralDtls->acc_no:'N/A'?></td>
                <th>IFSC Code</th>
                <td><?=(isset($referralDtls->ifsc_code))?$referralDtls->ifsc_code:'N/A'?></td>
            </tr>
            <tr>
                <th>Bank Address</th>
                <td><?=(isset($referralDtls->bank_address))?$referralDtls->bank_address:'N/A'?></td>
                <th>Status</th>
                <td>
                    <?php $bankDtlsStatus = 'N/A';
                    if(isset($referralDtls->bnkdtlsstatus) && $referralDtls->bnkdtlsstatus == 1){
                        $bankDtlsStatus = '<span class="btn btn-success btn-sm">Approved</span>';
                    }else if(isset($referralDtls->bnkdtlsstatus) && $referralDtls->bnkdtlsstatus == 2){
                        $bankDtlsStatus = '<span class="btn btn-danger btn-sm">Rejected</span>';
                    }else if(isset($referralDtls->bnkdtlsstatus) && $referralDtls->bnkdtlsstatus == 0){
                      $bankDtlsStatus = '<span class="btn btn-info btn-sm">Pending</span>';
                    }
                    echo $bankDtlsStatus; ?>
                </td>
            </tr>
            <?php if($referralDtls->comment != ''){ ?>
            <tr>
              <th>Comment</th>
              <td colspan="3"><pre><?=$referralDtls->comment?></pre></td>
            </tr>
            <?php } ?>
          </table>
        </div>
      </div><!-- end card -->
      
      <div class="card mb-1">
        <div class="card-header py-3 bg-dark text-light">
          <h6 class="m-0 font-weight-bold">Student's List</h6>
        </div>
        <div class="card-body">
          <table class="table">
            <head>
              <tr>
                <th>#</th>
                <th>Date</th>
                <th>Student's Name</th>
                <th>Address</th>
                <th>Phone</th>
                <th>Course For</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
            </head>
            <tbody>
              <?php if(!empty($stuData)){ 
                $sn=1;
                foreach($stuData as $list){ ?>
                  <tr>
                    <td><?=$sn++;?></td>
                    <td><?=date('d-m-Y',strtotime($list->added_at))?></td>
                    <td><?=$list->stu_name?></td>
                    <td><?=$list->address?></td>
                    <td><?=$list->phone?></td>
                    <td><?=$list->course_full_name?></td>
                    <td>
                        <?php if($list->status == 2){
                            $status = '<span class="btn btn-warning btn-sm" title="'.$list->description.'">Under Discussion</span>';
                        }else if($list->status == 3){
                            $status = '<span class="btn btn-success btn-sm" title="'.$list->description.'">Admitted</span>';
                        }else if($list->status == 4){
                            $status = '<span class="btn btn-danger btn-sm" title="'.$list->description.'">Reject</span>';
                        }else{
                            $status = '<span class="btn btn-primary btn-sm" >New</span>';
                        }
                        echo $status; ?>
                    </td>
                    <td>
                      <?php if(is_privilege(18,5)){ ?>
                        <?php if($list->status == 3 && $list->amount_status == 1){ ?>
                          
                          <a href="javascript:void(0);" class="btn btn-warning btn-sm paidToReferral" data-stu_id="<?=$list->stu_id?>" data-stu_name="<?=$list->stu_name?>" data-member_id="<?=$list->member_id?>">Paid To Referral</a>
                        <?php }else if($list->status == 3 && $list->amount_status == 2){ 
                          echo 'Amount Credited to referral';
                         }else{ ?>
                          <a href="javascript:void(0);" class="btn btn-primary btn-sm stuchangestatus" data-stu_id="<?=$list->stu_id?>" data-stu_name="<?=$list->stu_name?>" data-status="<?=$list->status?>" data-description="<?=$list->description?>">Change Status</a>
                        <?php } ?>
                      <?php } ?>
                    </td>
                  </tr>
              <?php }
              }else{
                echo '<tr class="text-center"><td colspan="8" class="text-danger ">No List</td></tr>';
              } ?>
            </tbody>
          </table>
        </div>
      </div><!-- end 3rd card -->
    </div><!-- end column -->
  </div><!-- end row -->


  

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
        <form action="<?=current_url();?>" method="post">
        <?=csrf_field(); ?>
        <input type="hidden" name="stu_id" value="" id="stu_id">
        <div class="modal-body">
          <div class="form-group row">
              <label for="stu_name" class="col-md-2">Name: </label>
              <div class="col-md-10">
                <p><strong id="stu_name"></strong></p>
              </div>
          </div>
          <div class="form-group row">
              <label for="stu_name" class="col-md-2">Status: </label>
              <div class="col-md-10">
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="status" value="1" id="statusnew">
                  <label class="form-check-label" for="statusnew">
                    New
                  </label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="status" value="2" id="statusud" >
                  <label class="form-check-label" for="statusud">
                    Under Discussion
                  </label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="status" value="3" id="statusadm" >
                  <label class="form-check-label" for="statusadm">
                    Admitted
                  </label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="status" value="4" id="statusrej" >
                  <label class="form-check-label" for="statusrej">
                    Reject
                  </label>
                </div>
              </div>
          </div>
          <div class="form-group row">
              <label for="stu_name" class="col-md-2">Description: </label>
              <div class="col-md-10">
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

  <!-- Bank Details Status Modal -->
  <div class="modal fade" id="changeBnkStatusModal" tabindex="-1" role="dialog" aria-labelledby="changeBnkStatusModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header bg-info">
          <h5 class="modal-title text-light" id="changeBnkStatusModalLabel">Change Bank Details Status</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="<?=base_url('admin/update_bank_details_status');?>" method="post">
        <?=csrf_field(); ?>
        <input type="hidden" name="m_id" value="" id="m_id">
        <div class="modal-body">
          
          <div class="form-group row">
              <label for="stu_name" class="col-md-2">Status: </label>
              <div class="col-md-10">
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="status" value="0" id="status0">
                  <label class="form-check-label" for="status0">
                    Pending
                  </label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="status" value="1" id="status1" >
                  <label class="form-check-label" for="status1">
                    Approved
                  </label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="status" value="2" id="status2" >
                  <label class="form-check-label" for="status2">
                    Reject
                  </label>
                </div>
              </div>
          </div>
          <div class="form-group row">
              <label for="stu_name" class="col-md-2">Comment: </label>
              <div class="col-md-10">
                <textarea class="form-control" name="comment" id="comment" rows="4"></textarea>
                <span class="text-danger" id="commentErr"></span>
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

  <!-- Paid to referral Modal -->
  <div class="modal fade" id="paidtoreferralModal" tabindex="-1" role="dialog" aria-labelledby="paidtoreferralModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header bg-success">
          <h5 class="modal-title text-light" id="paidtoreferralModalLabel">Paid To Referral</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="<?=base_url('admin/amount_paid_to_referral');?>" method="post">
        <?=csrf_field(); ?>
        <input type="hidden" name="stu_id" value="" id="stu_id2">
        <input type="hidden" name="m_id" value="" id="m_id2">
        <div class="modal-body">
          <div class="form-group row">
              <label for="stu_name2" class="col-md-2">Name: </label>
              <div class="col-md-10">
                <p><strong id="stu_name2"></strong></p>
              </div>
          </div>
          <div class="form-group row">
              <label for="refAmount" class="col-md-2">Amount: </label>
              <div class="col-md-10">
                <input type="text" name="refAmount" id="refAmount" class="form-control" value="1000" readonly>
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
  <script>
    $(".stuchangestatus").click(function () {
      var stu_id = $(this).data("stu_id");
      var stu_name = $(this).data("stu_name");
      var status = $(this).data("status");
      var description = $(this).data("description");
      $("#stu_name").html(stu_name);
      $("#stu_id").val(stu_id);
      if(status == 2){
        $("#statusud").prop('checked', true);
      }else if(status == 3){
        $("#statusadm").prop('checked', true);
      }else if(status == 4){
        $("#statusrej").prop('checked', true);
      }else{
        $("#statusnew").prop('checked', true);
      }
      $("#description").val(description);

      //alert(stu_id);
      $("#stuchangestatusModal").modal("show");
    });

    $(".changeBnkDtls").click(function(){
      var mid = $(this).data("mid");
      var bnkdtlsstatus = $(this).data("bnkdtlsstatus");
      $("#m_id").val(mid);
      if(bnkdtlsstatus == 1){
        $("#status1").prop('checked', true);
      }else if(bnkdtlsstatus == 2){
        $("#status2").prop('checked', true);
      }else{
        $("#status0").prop('checked', true);
      }
      // alert(mid+" "+bnkdtlsstatus);
      $("#comment").val('');
      $("#changeBnkStatusModal").modal("show");
    })

    $(".paidToReferral").click(function(){
      var stu_id = $(this).data("stu_id");
      var stu_name = $(this).data("stu_name");
      var member_id = $(this).data("member_id");
      $("#stu_name2").html(stu_name);
      $("#stu_id2").val(stu_id);
      $("#m_id2").val(member_id);
      $("#paidtoreferralModal").modal("show");
      
    });
  </script>
  <?=$this->endSection()?>