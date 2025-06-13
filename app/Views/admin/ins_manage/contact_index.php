<?=$this->extend("admin/_layout/master") ?>
<?=$this->section("content") ?>

<style>
.card .table td, .card .table th {
    padding-right: 0.7rem;
    padding-left: 0.7rem;
}



</style>

  <!-- Container Fluid-->
  <div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-1">
      
      <h1 class="h3 mb-0 text-gray-800">Contact-us (<?=$totcount?>)</h1>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?=base_url('admin'); ?>">Admin</a></li>
        <li class="breadcrumb-item active" aria-current="page">contact-us</li>
      </ol>
    </div>
    
    <div class="row mb-3">
      <!-- Datatables -->
    <div class="col-lg-12">
      <?php if(session()->getFlashdata('message') !== NULL){
        echo alertBS(session()->getFlashdata('message'),session()->getFlashdata('type'));
      } ?>
      <div class="card mb-1">
        <div class="card-header py-1 d-flex flex-row align-items-center justify-content-between">
         <div class="newcnf">
          <a href="<?=base_url('admin/contact-us?status=1')?>" class="btn btn-outline-primary mr-2 d-inline-block <?=(isset($_GET['status']) && $_GET['status'] == 1)?'active':''?>">New (<?=$newcount?>)</a>
          <a href="<?=base_url('admin/contact-us?status=7')?>" class="btn btn-outline-primary <?=(isset($_GET['status']) && $_GET['status'] == 7)?'active':''?>">Backlog (<?=$bkpcount?>)</a>
          <a href="<?=base_url('admin/contact-us?status=4')?>" class="btn btn-outline-primary <?=(isset($_GET['status']) && $_GET['status'] == 4)?'active':''?>">Confirmed (<?=$cnfcount?>)</a>
          <a href="<?=base_url('admin/contact-us?status=3')?>" class="btn btn-outline-primary <?=(isset($_GET['status']) && $_GET['status'] == 3)?'active':''?>">Cancel (<?=$cancount?>)</a>
          <a href="<?=base_url('admin/contact-us?status=5')?>" class="btn btn-outline-primary <?=(isset($_GET['status']) && $_GET['status'] == 5)?'active':''?>">Appeared (<?=$apdcount?>)</a>
          <a href="<?=base_url('admin/contact-us?status=6')?>" class="btn btn-outline-primary <?=(isset($_GET['status']) && $_GET['status'] == 6)?'active':''?>">Result (<?=$rescount?>)</a>
        </div>
        <div class="form-panel">
          <form class="d-flex" action="<?=base_url('admin/contact_us')?>" method="get">
            <input type="hidden" name="status" value="<?=(isset($_GET['status']))?$_GET['status']:1?>">
          <input type="text" class="form-control mr-2 d-inline-block" name="search" value="<?=(isset($_GET['search']))?$_GET['search']:''?>" placeholder="Name, Reg.No, Roll.No or Phone" required>
          <button type="submit" class="btn btn-primary mr-2">Search</button>
          <a href="<?=base_url('admin/reset_contacturl')?>" class="btn btn-warning">Reset</a>
          </form>
        </div>
          <!-- <h6 class="m-0 font-weight-bold text-primary">Contact-us List</h6> -->
          <?php if(is_privilege(14,4)){ ?>
          <div class="dropdown no-arrow">
            <?php $status = (isset($_GET['status']) && $_GET['status'] != '')?$_GET['status']:''; ?>
            <a href="<?=base_url('admin/export_to_excel/'.$status)?>" class="btn btn-dark">Export to Excel</a>
          </div>
          <?php } ?>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table align-items-center table-flush table-hover" id="dataTableHover">
              <thead class="thead-light">
                <tr>
                    <th>#</th>
                    <th>Date</th>
                    <th>Name</th>
                    <!-- <th>Email</th> -->
                    <th>Reg.No</th>
                    <th>Roll No</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>Course</th>
                    <th>Submit From</th>
                    <?php if(isset($_GET['status']) && $_GET['status'] == 6){
                      echo '<th>Marks Obtained</th>';
                    } ?>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
              </thead>
                <tbody>
                  <?php if(!empty($contactuslist)){
                    $sn=1;
                    foreach($contactuslist as $list){ 
                    if($list->status == 2){
                        $status = '<span class="badge badge-success">Replied</span>'; 
                    }else if($list->status == 3){
                        $status = '<span class="badge badge-danger">Cancel</span>';
                    }else if($list->status == 4){
                        $status = '<span class="badge badge-primary">Confirmed</span>';
                    }else if($list->status == 5){
                        $status = '<span class="badge badge-success">Appeared</span>';
                    }else if($list->status == 6){
                        $status = '<span class="badge badge-primary">'.$list->result_percentage.'%</span>';
                    }else{
                        $status = '<span class="badge badge-warning">New</span>';
                    }  
                    $courseName = $list->course_full_name ?? '';
                    $string = rawurlencode('Thank you for your enquiry through our Facebook Ads regarding our '.$courseName.'!

Learn from experts, gain hands-on experience, and get hired by top industries!

Our executive will be reaching out soon to guide you through the admission process. In the meantime, feel free to reach out on this WhatsApp Number if you have any questions.

Looking forward to welcoming you on board!

You can explore our channels and please do like, follow and subscribe for your better career tomorrow.
https://instagram.com/careerbossinstitute
https://facebook.com/careerbossinstitute
https://youtube.com/@careerbossinstitute') ;
                  ?>
                    <tr>
                        <td><?=$sn++?></td>
                        <td><?=date('d M, Y',strtotime($list->added_at))?></td>
                        <td><?=$list->name?></td>
                        <!-- <td><?=$list->email?></td> -->
                        <td><?=($list->reg_no != '')?$list->reg_no:'--'?></td>
                        <td><?=($list->roll_no != '')?$list->roll_no:'--'?></td>
                        <?php /* <td><span class="d-flex align-items-center"><?=($list->is_whatsapp == 1)?'<i class="fab fa-whatsapp-square mr-2" style="font-size:24px;color:red"></i>':''?><a href="https://api.whatsapp.com/send/?phone=%2B91<?=$list->phone?>&text=Hello%20<?=$list->name?>,%0A%0AWe%20have%20received%20your%20response%20to%20the%20Pratibha%20Khoj%20Scholarship%20Competition.%20We%20will%20announce%20the%20final%20date%20for%20the%20scholarship%20competition%20and%20inform%20you%20soon.%0A%0AYou%20can%20explore%20our%20channels%20and%20please%20do%20like,%20follow%20and%20subscribe.%0Ahttps://instagram.com/careerbossinstitute%0Ahttps://facebook.com/careerbossinstitute%0Ahttps://youtube.com/@careerbossinstitute%0A%0AThank%20you%0ACareer%20Boss%20Team&app_absent=0" target="_blank" rel="noopener noreferrer"><?=$list->phone?></a></span></td> */ ?>
                        <td><span class="d-flex align-items-center"><?=($list->is_whatsapp == 1)?'<i class="fab fa-whatsapp-square mr-2" style="font-size:24px;color:red"></i>':''?><a href="https://api.whatsapp.com/send/?phone=%2B91<?=$list->phone?>&text=Dear%20<?=$list->name?>,<?=$string?> Thank%20you%0ACareer%20Boss%20Team&app_absent=0" target="_blank" rel="noopener noreferrer"><?=$list->phone?></a></span></td>
                        <?php /* <td><a class="showMessage" data-message="<?=str_replace('"',' ',$list->message).'. Email: '.$list->email?>" href="javascript:void(0)" title="click to show message"><?php echo substr($list->message,0,30)?></a></td> */ ?>
                        <td><?=($list->address != '')?$list->address:'--'?></td>
                        <td><?=($list->course_full_name != '')?$list->course_full_name:'--'?></td>
                        <td><?=$list->submit_from?></td>
                        <?php if(isset($_GET['status']) && $_GET['status'] == 6){
                          echo '<td>'.$list->marks_obtained.'</td>';
                        } ?>
                        <td><?=$status?></td>
                        <td>
                            <?php if(is_privilege(14,2)){ ?>
                            <a href="javascript:void(0)" class="btn btn-outline-info reply" data-id="<?=$list->id?>" role="button" title="Reply">Reply</a>
                            <?php } ?>
                            <?php if($list->status == 3){ 
                            if(is_privilege(14,5)){?>
                            <a href="<?= base_url('/admin/delete-contact/'.$list->id) ?>" onclick="return confirm('Are you sure?')" class="btn btn-outline-info" role="button" style="color:red" title="Delete"><i class="fas fa-trash"></i></a>
                            <?php } } ?>
                            <?php if($list->is_whatsapp == 0){ 
                              if(is_privilege(14,3)){ ?>
                              <a href="<?=base_url('admin/set_whatsapp_number/'.$list->id.'/y')?>" class="btn btn-outline-warning" role="button" title="WhatsApp Mark"><i class='fab fa-whatsapp-square' style='font-size:24px'></i></a>
                            <?php } }else if($list->is_whatsapp == 1){ ?>
                              <a href="<?=base_url('admin/set_whatsapp_number/'.$list->id.'/n')?>" class="btn btn-outline-warning" role="button" title="WhatsApp UnMark"><i class='fab fa-whatsapp-square' style='font-size:24px'></i></a>
                            <?php } ?>
                            <?php if($list->status == 5){ ?>
                            <a href="javascript:void(0)" class="btn btn-outline-info enterMarks" data-id="<?=$list->id?>" role="button" title="Enter Marks"><i class="fas fa-edit"></i></a>
                            <?php } ?>
                        </td>
                    </tr>
                    <?php } } else { ?>
                        <tr><td colspan="3">No Data Available</td></tr>
                    <?php } ?>
                </tbody>
             </table>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!---Container Fluid-->
  <!-- Modal -->
  <div class="modal fade" id="replyModal" tabindex="-1" role="dialog" aria-labelledby="replyModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <form action="<?=base_url('admin/change-status'); ?>" method="post" onsubmit="return validatereply();">
          <?=csrf_field(); ?>
          <input type="hidden" name="contact_id" id="contact_id" value="">
          <div class="modal-header bg-primary">
            <h5 class="modal-title text-white" id="replyModalLabel"> Reply</h5>
            <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <label for="status">Status</label>
              <select name="status" id="status" class="form-control">
                <option value="">Select One</option>
                <option value="1">New</option>
                <option value="2">Replied</option>
                <option value="3">Cancel</option>
                <option value="4">CNF</option>
                <option value="5">Appeared</option>
                <option value="7">Backlog</option>
              </select>
              <span class="text-danger" id="statusErr"></span>
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
  <div class="modal fade" id="marksModal" tabindex="-1" role="dialog" aria-labelledby="marksModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <form action="<?=base_url('admin/marks_update'); ?>" method="post" >
          <?=csrf_field(); ?>
          <input type="hidden" name="contact_id" id="contact_id" value="">
          <div class="modal-header bg-primary">
            <h5 class="modal-title text-white" id="marksModalLabel"> Marks</h5>
            <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <label for="status">Enter Marks</label>
              <input type="text" class="form-control" name="marks_obtained" id="marks_obtained" value="" required>
              <span class="text-danger" id="marksErr"></span>
            </div>
          </div>
          <input type="hidden" name="con_id" value="" id="con_id">
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Submit</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <script>
    $(".reply").click(function(){
      var id = $(this).data("id");
      $("#contact_id").val(id);
      //alert(id);
      $("#replyModal").modal("show");

    });
    function validatereply(){
      var status = $("#status").val();
      if(status == ''){
        $("#statusErr").html("Please select status!");
        return false;
      }
      return true;
    }

    $(".showMessage").click(function(){
      var message = $(this).attr("data-message");
      alert(message);
    });
    $(".enterMarks").click(function(){
      var con_id = $(this).attr("data-id");
      $("#con_id").val(con_id);
      $("#marksModal").modal("show");
    })
  </script>
<?=$this->endSection()?>
  