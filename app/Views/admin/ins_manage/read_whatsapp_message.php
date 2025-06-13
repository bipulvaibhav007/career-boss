<?=$this->extend("admin/_layout/master") ?>
<?=$this->section("content") ?>
<?php $adminmodel = model('App\Models\Admin_model', false); ?>
  <!-- Container Fluid-->
  <div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-1">
      <h1 class="h3 mb-0 text-gray-800">All Sent & Replied Messages</h1>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?=base_url('admin'); ?>">Admin</a></li>
        <li class="breadcrumb-item active" aria-current="page">readWhatsAppMessage</li>
      </ol>
    </div>
    
    <div class="row mb-3">
      <!-- Datatables -->
    <div class="col-lg-12">
      <?php if(session()->getFlashdata('message') !== NULL){
        echo alertBS(session()->getFlashdata('message'),session()->getFlashdata('type'));
      } ?>
      <div class="card mb-1">
        <div class="card-header">
          <div class="d-flex">
            <div class="mr-auto p-2">
              <h6 class="m-1 font-weight-bold text-primary"><span class="text-primary"><?=(isset($whatsappReplied[0]->c_name))?$whatsappReplied[0]->c_name.' '.$whatsappReplied[0]->phone1:'--';?></span></h6>
            </div>
            <div class="p-1">
              <a href="javascript:void(0);" class="btn btn-success whatsappReply" data-phone="<?=(isset($whatsappReplied[0]->phone1))?$whatsappReplied[0]->phone1:'';?>">Reply</a>
              <a href="<?=base_url('admin/whatsapp_replied?status=unread')?>" class="btn btn-primary">Back</a>
            </div>
           
          </div>
        </div>
        <div class="card-body">
          <?php /* <div class="table-responsive">
            <table class="table align-items-center table-flush table-hover" id="dataTableHover">
              <thead class="thead-light">
                <tr>
                    <th>#</th>
                    <th>Date Time</th>
                    <th>Message</th>
                </tr>
              </thead>
                <tbody>
                <?php if(!empty($whatsappReplied)){
                    $sn=1;
                    foreach($whatsappReplied as $list){ 
                    /*if($list->status == '1'){
                        $status = '<span class="badge badge-success">Active</span>'; 
                    }else{
                        $status = '<span class="badge badge-warning">Inactive</span>';
                    } *   
                    ?>
                    <tr>
                        <td><?=$sn++?></td>
                        <td><?=date('d-m-Y h:i:s A',strtotime($list->added_at))?></td>
                        <td>
                          <?=$list->message?>
                        </td>
                    </tr>
                    <?php } } else { ?>
                        <tr><td colspan="3">No Data Available</td></tr>
                    <?php } ?>
                </tbody>
             </table>
          </div> */ ?>
          <?php if(!empty($whatsappReplied)){
          foreach($whatsappReplied as $list){ 
          if($list->status == 2){ ?>
          <div class="row">
            <div class="col-sm-5">
              <div class="card text-white bg-info mb-3" style="max-width: 25rem;">
                <div class="card-body">
                  <h6 class="card-title">
                    <?=date('d-m-Y h:i:s A',strtotime($list->added_at))?>
                    <a href="<?=base_url('admin/delete_whatsAppReplyLog/'.$list->log_id)?>" class="float-right"><i class="fa fa-trash" style="color:red"></i></a>
                  </h6>
                  <p class="card-text"><?=$list->message?></p>
                </div>
              </div>
            </div>
            
          </div>
          <?php }else if($list->status == 5){ ?>

          <div class="row justify-content-end">
            <div class="col-sm-5">
              <div class="card text-white bg-primary mb-3" style="max-width: 25rem;">
                <div class="card-body">
                  <h6 class="card-title">
                    <?=date('d-m-Y h:i:s A',strtotime($list->added_at))?>
                    <a href="<?=base_url('admin/delete_whatsAppReplyLog/'.$list->log_id)?>" class="float-right"><i class="fa fa-trash" style="color:red"></i></a>
                  </h6>
                  <p class="card-text"><?=$list->message?></p>
                </div>
              </div>
            </div>
            
          </div>
          <?php } } } ?>
        </div>
      </div>
    </div>
  </div>
  <!---Container Fluid-->

  <!-- modal -->
  <div class="modal fade" id="whReplyModal" tabindex="-1" role="dialog" aria-labelledby="whReplyModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header bg-success text-white">
          <h5 class="modal-title" id="whReplyModalLabel">WhatsApp Reply </h5>
          <button type="button" class="close " data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="<?=current_url(); ?>" method="post" onsubmit="return validateReplyMessage()">
          <?=csrf_field()?>
          <input type="hidden" name="phone" id="phone" value="">
          <div class="modal-body">
            <div class="form-group row">
              <label for="" class="col-md-3">To:</label>
              <div class="col-md-9">
                <span id="phoneTxt"></span>
                <span class="text-danger" id="phoneErr"></span>
              </div>
            </div>
            <div class="form-group row">
              <label for="" class="col-md-3">Message:</label>
              <div class="col-md-9">
                <textarea name="message" id="message" rows="3" class="form-control"></textarea>
                <span class="text-danger" id="messageErr"></span>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Send</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!-- end modal -->


  <script>
    $(".whatsappReply").click(function(){
      $("#messageErr").html('');
      $("#phoneErr").html('');
      var phone = $(this).attr("data-phone");
      if(phone != '' || phone != 'undefined'){
        $("#phone").val(phone);
        $("#phoneTxt").html(phone);
        $("#whReplyModal").modal("show");
      }else{
        return false;
      }
    });
    function validateReplyMessage(){
      var phone = $("#phone").val();
      var message = $("#message").val();
      if(phone == ''){
        $("#phoneErr").html('Phone no not exist!');
        return false;
      }
      if(message == ''){
        $("#messageErr").html('Please enter message here!');
        return false;
      }
      return true;
    }
  </script>
<?=$this->endSection()?>
  