<?=$this->extend("admin/_layout/master") ?>
<?=$this->section("content") ?>
  <!-- Container Fluid-->
  <div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-1">
      <h1 class="h3 mb-0 text-gray-800">WhatsApp message not send list</h1>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?=base_url('admin'); ?>">Admin</a></li>
        <li class="breadcrumb-item active" aria-current="page">enquiry</li>
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
            <a href="<?=base_url('admin/enquiry')?>" class="btn btn-primary">Back</a>
        <?php /* 
          <div class="row">
            <div class="col-md-12">
              <div class="newcnf">
                <a href="<?=base_url('admin/enquiry?status=1')?>" class="btn btn-outline-primary mr-1 d-inline-block <?=(isset($_GET['status']) && $_GET['status'] == 1)?'active':''?>">New (<?=$countNew?>)</a>
                <a href="<?=base_url('admin/enquiry?status=2')?>" class="btn btn-outline-primary <?=(isset($_GET['status']) && $_GET['status'] == 2)?'active':''?>">WhatsApp (<?=$countWhatsApp?>)</a>
                <a href="<?=base_url('admin/enquiry?status=3')?>" class="btn btn-outline-primary <?=(isset($_GET['status']) && $_GET['status'] == 3)?'active':''?>">Discussion (<?=$countDiscussion?>)</a>
                <a href="<?=base_url('admin/enquiry?status=4')?>" class="btn btn-outline-primary <?=(isset($_GET['status']) && $_GET['status'] == 4)?'active':''?>">Completed (<?=$countComp?>)</a>
                <a href="<?=base_url('admin/enquiry?status=5')?>" class="btn btn-outline-primary <?=(isset($_GET['status']) && $_GET['status'] == 5)?'active':''?>">Rejected (<?=$countReject?>)</a>
                <a href="<?=base_url('admin/enquiry?status=6')?>" class="btn btn-outline-primary <?=(isset($_GET['status']) && $_GET['status'] == 6)?'active':''?>">Follow-up (<?=$countFollowup?>)</a>
                <a href="<?=base_url('admin/enquiry?status=a')?>" class="btn btn-outline-primary <?=(isset($_GET['status']) && $_GET['status'] == 'a')?'active':''?>">All (<?=$countAll?>)</a>

              </div>
            </div>
            <div class="col-md-4 py-2">
              <div class="form-panel">
                <form class="d-flex" action="<?=base_url('admin/enquiry')?>" method="get">
                  <input type="hidden" name="status" value="a">
                  <input type="text" class="form-control mr-2 d-inline-block" name="search" value="<?=(isset($_GET['search']))?$_GET['search']:''?>" placeholder="Name & Mobile No" required>
                  <button type="submit" class="btn btn-primary mr-2">Search</button>
                  <a href="<?=base_url('admin/reset_enqurl')?>" class="btn btn-warning">Reset</a>
                </form>
              </div>
            </div>
            <div class="col-md-8 py-2">
              <a href="<?=base_url('admin/enquiry_export_to_excel/'.$_GET['status'])?>" class="btn btn-dark">Export to Excel</a>
              <?php if(isset($_GET['status']) && $_GET['status'] == 2){ ?>
                <a href="<?=base_url('admin/send_whatsapp_message_to_enquiry')?>" class="btn btn-success" onclick="return confirm('Are you sure want to send WhatsApp message?')">Send<i class="fab fa-whatsapp-square" style="font-size:24px;color:red"></i>Message</a>
              <?php } ?>
              <a href="<?=base_url('admin/enquiry_cu')?>" class="btn btn-primary">Add Enquiry</a>
            </div>
          </div>
          */ ?>
        </div>
        
        <div class="card-body">
          <div class="table-responsive">
            <table class="table align-items-center table-flush table-hover" id="dataTableHover">
              <thead class="thead-light">
                <tr>
                    <th>#</th>
                    <th>Candidate Name</th>
                    <th>Mobile No</th>
                    <th>Address</th>
                    <th>Course For</th>
                    <th>Ref. By</th>
                    <th>Status</th>
                    <!-- <th>Actions</th> -->
                </tr>
              </thead>
              <tbody>
                <?php if(!empty($enquiry)){
                    $sn=1;
                    foreach($enquiry as $list){ 
                    $statusArr = array();
                    $statusArr = explode(',', $list->status);
                    //$status = (isset($_GET['status']))?$_GET['status']:'';
                    $status = 2;
                    $statusTxt = '';
                    $stat = array();
                    if($status == 'a'){
                      if(in_array(1, $statusArr)){
                        $stat[] = '<span class="badge badge-primary ">New</span>';
                      }
                      if(in_array(2, $statusArr)){
                        $stat[] = '<span class="badge badge-success ">WhatsApp</span>';
                      }
                      if(in_array(3, $statusArr)){
                        $stat[] = '<span class="badge badge-dark ">Discussion</span>';
                      }
                      if(in_array(4, $statusArr)){
                        $stat[] = '<span class="badge badge-success ">Completed</span>';
                      }
                      if(in_array(5, $statusArr)){
                        $stat[] = '<span class="badge badge-danger ">Rejected</span>';
                      }
                      if(in_array(6, $statusArr)){
                        $stat[] = '<span class="badge badge-info ">Follow-up</span>';
                      }
                      $statusTxt = implode(' ', $stat);

                    }else{
                      if($status == '1' && in_array(1, $statusArr)){
                        $statusTxt = '<span class="badge badge-primary ">New</span>';
                      }elseif($status == '2' && in_array(2, $statusArr)){
                        $statusTxt = '<span class="badge badge-success ">WhatsApp</span>';
                      }elseif($status == '3' && in_array(3, $statusArr)){
                        $statusTxt = '<span class="badge badge-dark ">Discussion</span>';
                      }elseif($status == '4' && in_array(4, $statusArr)){
                        $statusTxt = '<span class="badge badge-success ">Completed</span>';
                      }elseif($status == '5' && in_array(5, $statusArr)){
                        $statusTxt = '<span class="badge badge-danger ">Rejected</span>';
                      }elseif($status == '6' && in_array(6, $statusArr)){
                        $statusTxt = '<span class="badge badge-info ">Follow-up</span>';
                      } 
                    } 
                    ?>
                    <tr>
                        <td><?=$sn++?></td>
                        <td><a href="<?= base_url('/admin/enquiry_view/'.$list->enq_id) ?>"><?=$list->c_name?></a></td>
                        <td><span class="d-flex align-items-center"><?=(in_array(2, $statusArr))?'<i class="fab fa-whatsapp-square mr-2" style="font-size:24px;color:red"></i>':''?><a href="https://api.whatsapp.com/send/?phone=%2B91<?=$list->phone1?>&text=Hello%20<?=$list->c_name?>,%0A%0AWe%20have%20received%20your%20response.%20Our%20team%20will%20contact%20you%20soon.%0A%0AYou%20can%20explore%20our%20channels%20and%20please%20do%20like,%20follow%20and%20subscribe.%0Ahttps://instagram.com/careerbossinstitute%0Ahttps://facebook.com/careerbossinstitute%0Ahttps://youtube.com/@careerbossinstitute%0A%0AThank%20you%0ACareer%20Boss%20Team&app_absent=0" target="_blank" ><?=$list->phone1?></a></span></td>
                        <td><?=$list->address?></td>
                        <td>
                            <?=$list->course_full_name ?>
                        </td>
                        <td><?=($list->ref_by == 'other')?$list->refree_name:$list->ref_by?></td>
                        <td><?=$statusTxt?></td>
                        <?php /* 
                        <td>
                            <a href="<?= base_url('/admin/enquiry_cu/'.$list->enq_id) ?>" class="btn btn-outline-info btn-sm" role="button" title="Edit"><i class="fas fa-edit"></i></a>
                            <a href="<?= base_url('/admin/enquiry_view/'.$list->enq_id) ?>" class="btn btn-outline-info btn-sm" role="button" title="View"><i class="fas fa-eye"></i></a>
                            <?php if(!in_array(2, $statusArr)){ ?>
                              <a href="<?=base_url('admin/set_enq_whatsapp_number/'.$list->enq_id.'/y')?>" class="btn btn-outline-warning btn-sm" role="button" title="WhatsApp Mark"><i class='fab fa-whatsapp-square' style='font-size:24px'></i></a>
                            <?php }else if(in_array(2, $statusArr)){ ?>
                              <a href="<?=base_url('admin/set_enq_whatsapp_number/'.$list->enq_id.'/n')?>" class="btn btn-outline-warning btn-sm" role="button" title="WhatsApp UnMark"><i class='fab fa-whatsapp-square' style='font-size:24px'></i></a>
                            <?php } ?>
                            <a href="<?= base_url('/admin/delete_enquiry/'.$list->enq_id) ?>" onclick="return confirm('Are you sure?')" class="btn btn-outline-info btn-sm" role="button" style="color:red" title="Delete"><i class="fas fa-trash"></i></a>
                        </td> */ ?>
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
  <div class="modal fade" id="changeStatusModal" tabindex="-1" role="dialog" aria-labelledby="changeStatusModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <form action="<?=base_url('admin/change_enquiry_status'); ?>" method="post" onsubmit="return validatechangestatus();">
          <?=csrf_field(); ?>
          <input type="hidden" name="enq_id" id="enq_id" value="">
          <div class="modal-header bg-primary">
            <h5 class="modal-title text-white" id="changeStatusModalLabel"> Change Status</h5>
            <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <label for="status">Status</label>
              <select name="status[]" id="status" class="form-control" multiple>
                <option value="">Select Multiple</option>
                <option value="1">New</option>
                <option value="2">WhatsApp</option>
                <!-- <option value="3">Cancel</option>
                <option value="4">CNF</option>
                <option value="5">Appeared</option>
                <option value="7">Backlog</option> -->
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

  <script>
    $(".changeStatus").click(function(){
      var id = $(this).data("id");
      var status = $(this).data("status");
      //const statusArr = status.split(",");
      //alert(statusArr[0]);return 0;
      $("#enq_id").val(id);
      //alert(id);
      $("#changeStatusModal").modal("show");

    });
    function validatechangestatus(){
      var status = $("#status").val();
      if(status == ''){
        $("#statusErr").html("Please select status!");
        return false;
      }
      return true;
    }
  </script>
<?=$this->endSection()?>
  