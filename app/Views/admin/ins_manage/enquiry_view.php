<?=$this->extend("admin/_layout/master") ?>
<?=$this->section("content") ?>
<script language="Javascript" src="<?php echo base_url('editor/scripts/innovaeditor.js'); ?>"></script>
<div class="container-fluid" id="container-wrapper">
  <div class="d-sm-flex align-items-center justify-content-between mb-1">
    <h1 class="h3 mb-0 text-gray-800">View Enquiry</h1>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="<?=base_url('admin'); ?>">Admin</a></li>
      <li class="breadcrumb-item" aria-current="page">enquiry_view</li>
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
        <div class="card-header py-1 ">
          <?php /* <h6 class="m-0 font-weight-bold text-primary"><?php echo (isset($cms))?'Edit Enquiry':'Add Enquiry'; ?>
          </h6> */ ?>
          <div class="float-right">
            <a href="<?=base_url('admin/enquiry')?>" class="btn btn-primary btn-sm">Back</a>
          </div>
        </div>
        <div class="card-body">
          <table class="table">
            <tr>
              <th>Candidate Name</th>
              <td><?=$cms->c_name?></td>
              <th>Mobile No</th>
              <td><?=$cms->phone1?></td>
            </tr>
            <tr>
              <th>Address</th>
              <td><?=$cms->address?></td>
              <th>Course For</th>
              <td><?=$cms->course_full_name?></td>
            </tr>
            <tr>
              <th>Ref. By</th>
              <td><?=($cms->ref_by == 'other')?$cms->refree_name:$cms->ref_by?></td>
              <th>Status</th>
              <?php $statusBtn = array();
                    $statusArr = ($cms->status != '')?explode(',', $cms->status):array();
                    if(in_array(1, $statusArr)){
                      $statusBtn[] = '<span class="btn btn-primary btn-sm">New</span>';
                    }
                    if(in_array(2, $statusArr)){
                      $statusBtn[] = '<span class="btn btn-success btn-sm">WhatsApp</span>';
                    }
                    if(in_array(3, $statusArr)){
                      $statusBtn[] = '<span class="btn btn-dark btn-sm">Discussion</span>';
                    }
                    if(in_array(4, $statusArr)){
                      $statusBtn[] = '<span class="btn btn-success btn-sm">Completed</span>';
                    }
                    if(in_array(5, $statusArr)){
                      $statusBtn[] = '<span class="btn btn-danger btn-sm">Rejected</span>';
                    }
                    if(in_array(6, $statusArr)){
                      $statusBtn[] = '<span class="btn btn-info btn-sm">Follow-up</span>';
                    } 
                    if(in_array(7, $statusArr)){
                      $statusBtn[] = '<span class="btn btn-primary btn-sm">Non-WhatsApp</span>';
                    } 
                    if(in_array(8, $statusArr)){
                      $statusBtn[] = '<span class="btn btn-dark btn-sm">Do Online</span>';
                    } 
                    ?>
              <td>
                <?=(!empty($statusBtn))?implode(' ', $statusBtn):'--'?>
              </td>
            </tr>
          </table>
        </div>
      </div><!-- end card -->
      <div class="card mb-1">
        <div class="card-header">
          <h6 class="m-0 font-weight-bold text-primary">Change Status</h6>
        </div>
        <div class="card-body">
          <?php $statusAr = array();
          $statusAr = array(
            '1' => 'New',
            '2' => 'WhatsApp',
            '7' => 'Non-WhatsApp',
            '3' => 'Discussion',
            '4' => 'Completed',
            '5' => 'Rejected',
            '6' => 'Follow-up',
            '8' => 'Do Online'
          );
          ?>
          <div class="row">
            <div class="col-md-10">
              <form action="<?=current_url();?>" method="post">
              <?=csrf_field(); ?>
              <input type="hidden" name="enq_id" value="<?=$cms->enq_id?>">
              <div class="form-group">
                <label for="status">Status: </label>
                <?php foreach($statusAr as $key=>$status){ ?>
                <div class="form-check form-check-inline">
                  <input class="form-check-input statusCheck" data-key="<?=$key?>" name="status[]" type="checkbox"
                    value="<?=$key?>" id="status<?=$key?>" <?=(in_array($key, $statusArr))?'checked':''?>>
                  <label class="form-check-label" for="status<?=$key?>">
                    <?=$status?>
                  </label>
                </div>
                <?php } ?>

              </div>
              <div class="form-group" style="<?=(!in_array(6, $statusArr))?'display:none':''?>" id="followupdiv">
                <label for="followup_date" >Follow-up Date</label>
                <input type="date" class="form-control" name="followup_date" value="<?=$cms->followup_date?>" id="followup_date">
              </div>
              <div class="form-group">
                <label for="comment">Comment</label>
                <textarea name="comment" id="comment" rows="4" class="form-control"></textarea>
              </div>
              <div class="form-group">
                <button type="submit" class="btn btn-primary btn-sm">Submit</button>
              </div>
              </form>
            </div>
          </div>

        </div>
      </div><!-- end 2nd card -->

      <div class="card mb-1">
        <div class="card-header">
          <h6 class="m-0 font-weight-bold text-primary">Comment Log</h6>
        </div>
        <div class="card-body">
          <table class="table">
            <head>
              <tr>
                <th>#</th>
                <th>Date</th>
                <th>Comment</th>
                <th>Status</th>
              </tr>
            </head>
            <tbody>
              <?php if(!empty($commentlog)){ $sn=1;
                foreach($commentlog as $list){ ?>
                  <tr>
                    <td><?=$sn++;?></td>
                    <td><?=date('d-m-Y',strtotime($list->added_at))?></td>
                    <td><?=$list->comment?></td>
                    <?php $statusBtn = array();
                      $statusArr = ($list->status != '')?explode(',', $list->status):array();
                      if(in_array(1, $statusArr)){
                        $statusBtn[] = '<span class="btn btn-primary btn-sm">New</span>';
                      }
                      if(in_array(2, $statusArr)){
                        $statusBtn[] = '<span class="btn btn-success btn-sm">WhatsApp</span>';
                      }
                      if(in_array(3, $statusArr)){
                        $statusBtn[] = '<span class="btn btn-dark btn-sm">Discussion</span>';
                      }
                      if(in_array(4, $statusArr)){
                        $statusBtn[] = '<span class="btn btn-success btn-sm">Completed</span>';
                      }
                      if(in_array(5, $statusArr)){
                        $statusBtn[] = '<span class="btn btn-danger btn-sm">Rejected</span>';
                      }
                      if(in_array(6, $statusArr)){
                        $statusBtn[] = '<span class="btn btn-info btn-sm">Follow-up</span>';
                      }
                      if(in_array(7, $statusArr)){
                        $statusBtn[] = '<span class="btn btn-primary btn-sm">Non-WhatsApp</span>';
                      }
                      if(in_array(8, $statusArr)){
                        $statusBtn[] = '<span class="btn btn-dark btn-sm">Do Online</span>';
                      }
                      ?>
                    <td>
                      <?=(!empty($statusBtn))?implode(' ', $statusBtn):'--'?>
                    </td>
                  </tr>
              <?php }
              }else{
                echo '<tr class="text-center"><td colspan="4" class="text-danger ">No Comment</td></tr>';
              } ?>
            </tbody>
          </table>
        </div>
      </div><!-- end 3rd card -->

      <div class="card mb-1">
        <div class="card-header d-flex justify-content-between">
          <h6 class="m-0 font-weight-bold text-primary">Whatsapp Reply Log</h6>
          <span class="text-danger" style="display:none;" id="deletingErr">Deleting...</span>
          <button class="btn btn-warning btn-sm deleteWhLog">Delete WhatsApp Log</button>
        </div>
        <div class="card-body">
          <table class="table">
            <head>
              <tr>
                <th>#</th>
                <th>Mark for Delete &nbsp;&nbsp;<input type="checkbox" class="checkAll"> All</th>
                <th>Date</th>
                <th>Message</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
            </head>
            <tbody>
              <?php if(!empty($whatsappMessages)){ $sn=1;
                foreach($whatsappMessages as $list){ ?>
                  <tr>
                    <td><?=$sn++;?></td>
                    <td>
                      <input type="checkbox" name="log_id" value="<?=$list->log_id?>" class="logList">
                    </td>
                    <td><?=date('d-m-Y h:i A',strtotime($list->added_at))?></td>
                    <td><?=($list->message != '')?$list->message:'N/A'?></td>
                    
                    <td>
                      <?=get_badge_wh_status($list->status)?>
                    </td>
                    <td><a href="<?=base_url('admin/delete_whatsAppReplyLog/'.$list->log_id)?>" ><i class="fa fa-trash" style="color:red"></i></a></td>
                  </tr>
              <?php }
              }else{
                echo '<tr class="text-center"><td colspan="4" class="text-danger ">No Whatsapp reply!</td></tr>';
              } ?>
            </tbody>
          </table>
        </div>
      </div><!-- end 4th card -->
    </div><!-- end column -->
  </div><!-- end row -->

  <script>
    $(".statusCheck").click(function () {
      var key = $(this).data("key");
      if (key == 6) {
        if ($("#status6").is(":checked")) {
          //alert(key);
          $("#followupdiv").show();
        } else {
          $("#followupdiv").hide();
        }
      }

    });

    $(".checkAll").change(function(){
      if(this.checked){
        $(".logList").each(function() {
            this.checked=true;
        });
      }else{
        $(".logList").each(function() {
            this.checked=false;
        });
      }
    });

    $(".logList").change(function(){
      if(!$(this).prop("checked")) {
        $(".checkAll").prop("checked", false);
      }
    });

    $(".deleteWhLog").click(function(){
      var arr = [];
      $('input.logList:checkbox:checked').each(function () {
          arr.push($(this).val());
      });
      if(arr.length > 0){
        var log_ids = JSON.stringify(arr);
        
        $.ajax({
          url : "<?=base_url('admin/delete_whatsAppReplyLog_ByAjax')?>",
          type : "post",
          data : {log_ids:log_ids},
          beforeSend: function() {
            $("#deletingErr").show();
          },
          success: function(data) {
            console.log(data);
            if(data == 'success') {
              $("#deletingErr").hide();
              window.location.reload();
            }
          },
        });
      }else{
        alert('Please check for group Delete!');
      }
    });
  </script>
  <?=$this->endSection()?>