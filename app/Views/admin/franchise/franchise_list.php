<?=$this->extend("admin/_layout/master") ?>
<?=$this->section("content") ?>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <!-- Container Fluid-->
  <div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-1">
      <h1 class="h3 mb-0 text-gray-800">Franchise</h1>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?=base_url('admin'); ?>">Admin</a></li>
        <li class="breadcrumb-item active" aria-current="page">franchise</li>
      </ol>
    </div>
    <?php if(session()->getFlashdata('message') !== NULL){
        echo alertBS(session()->getFlashdata('message'),session()->getFlashdata('type'));
    } ?>
    
    <div class="row mb-3">
      <!-- Datatables -->
    <div class="col-lg-12">
      <div class="card mb-1">
        <div class="card-header py-1 ">
          <h6 class="m-0 font-weight-bold text-primary">Franchise List</h6>
          <form action="<?=current_url()?>" method="get">
          <div class="my-1 d-flex flex-row align-items-center justify-content-between">
            <input type="text" name="search" id="search" value="<?=(isset($_GET['search']))?$_GET['search']:''?>" class="form-control" placeholder="Name/Phone/Center name">
            <select name="status" id="status" class="ml-2 form-control">
              <option value="">---Select Status---</option>
              <option value="1" <?=(isset($_GET['status']) && $_GET['status'] == 1)?'selected':''?>>Active</option>
              <option value="0" <?=(isset($_GET['status']) && $_GET['status'] == 0)?'selected':''?>>Inactive</option>
            </select>
            <button type="submit" class="ml-2 btn btn-primary">Submit</button>
            <a href="<?=base_url('admin/franchise')?>" class="ml-2 btn btn-warning">Reset</a>
          </div>
          </form>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table align-items-center table-flush table-hover" id="dataTableHover">
              <thead class="thead-light">
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Code</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Center Name</th>
                    <th>Center Address</th>
                    <th>Students<br>New/Total</th>
                    <!-- <th>Total Earn</th> -->
                    <!-- <th>Total Credit</th> -->
                    <th>Status</th>
                    <th>Action</th>
                </tr>
              </thead>
                <tbody>
                <?php 
                  $adminmodel = model('App\Models\Admin_model', false);
                  if(!empty($franchises)){
                    $sn=1;
                    foreach($franchises as $list){ 
                    if($list->status == 1){
                        $status = '<span class="badge badge-success">Active</span>'; 
                    }else{
                        $status = '<span class="badge badge-warning" title="'.$list->comment.'">Inactive</span>';
                    } 
                    $new_stu = $adminmodel->getCountFranchiseStudentByRefId($list->m_id, ['status <'=>1]);
                    $t_stu = $adminmodel->getCountFranchiseStudentByRefId($list->m_id);
                    $cert_stu = $adminmodel->getCountFranchiseStudentByRefId($list->m_id, ['status'=>3]);
                    $inpro_stu = $adminmodel->getCountFranchiseStudentByRefId($list->m_id, ['status'=>1]);

                    ?>
                    <tr>
                        <td><?=$sn++?></td>
                        
                        <td><a href="<?=base_url('/admin/franchise_view/'.$list->m_id)?>"><?=$list->m_full_name?></a></td>
                        <td><?=($list->member_code != '')?$list->member_code:'--'?></td>
                        <td><?php echo $list->phone?></td>
                        <td><?php echo $list->email?></td>
                        <td><?=$list->center_name?></td>
                        <td><?=$list->center_address?></td>
                        <?php /* <td>
                            <img class="img-thumbnail" src="<?=base_url('public/assets/upload/images/'.$list->image) ?>" width="70px" height="70px"/>
                        </td>
                        <td><?=$list->address?></td> */ ?>
                        <td><?=$new_stu.'/'.$t_stu?></td>
                        <?php /*<td><?=$list->earn_amount?></td>
                        <td><?=$list->credit_amount?></td>*/ ?>
                        
                        <td><?=$status?></td>
                        <td>
                            <?php if(is_privilege(23,3)){ ?>
                            <a href="<?= base_url('/admin/franchise_CU/'.$list->m_id) ?>" class="mt-2 btn btn-outline-info" role="button" title="Edit"><i class="fas fa-edit"></i></a>
                            <?php } ?>
                            <?php if(is_privilege(23,4)){ ?>
                            <a href="<?= base_url('/admin/franchise_view/'.$list->m_id) ?>" class="mt-2 btn btn-outline-info" role="button" title="View"><i class="fas fa-eye"></i></a>
                            <?php } ?>
                            <?php if(is_privilege(23,5)){ 
                              if($cert_stu < 1 && $inpro_stu < 1){?>
                                <a href="<?= base_url('/admin/delete_franchise/'.$list->m_id) ?>" onclick="return confirm('Are you sure?')" class="mt-2 btn btn-outline-info" role="button" style="color:red" title="Delete"><i class="fas fa-trash"></i></a>
                            <?php } } ?>
                            <?php if(is_privilege(23,6)){ ?>
                            <a href="javascript: void(0); " onclick="resetpassword('<?=$list->m_id ?>')" class="mt-2 btn btn-outline-info" role="button" title="Reset Password"><i class="fa fa-key" aria-hidden="true"></i></a>
                            <?php } ?>
                            <a href="javascript: void(0); " onclick="changeStatus('<?=$list->m_id ?>')" class="mt-2 btn btn-outline-info" role="button" title="Change Status"><i class="fas fa-signal"></i></a>
                            <a href="<?=base_url('/admin/wallet_history/'.$list->m_id) ?>" class="mt-2 btn btn-outline-info" role="button" title="Wallet History"><i class="fas fa-wallet" aria-hidden="true"></i></a>
                        </td>
                    </tr>
                    <?php } } else { ?>
                        <tr><td colspan="6" class="text-center text-danger">No Data Available</td></tr>
                    <?php } ?>
                </tbody>
             </table>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!---Container Fluid-->

    <!-- Modal Reset Password -->
    <div class="modal fade bd-example-modal-lg resetpassmodal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ResetModalLabel"><b>Reset Password</b></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?=base_url('admin/reset_password');?>" method="post" name="ResetFormsData" id="ResetFormsData" enctype="multipart/form-data">
            <?=csrf_field(); ?>
            <div class="modal-body" id="resetpassdetails">
            <!--write body data here display to direct-->
                <input type="hidden" name="m_id" value="" id="m_id">
                <div class="form-group row" id="resetpasswordiv">
                  <label for="password" class="col-sm-3">Password</label>
                  <div class="col-sm-8">
                      <input type="text" class="form-control" id="resetpassword" name="resetpassword" value="" readonly>
                      <span class="text-danger" id="resetpassword_err"></span>
                  </div>
                  <div class="col-sm-1">
                      <a href="javascript:void(0);"><i class="fa fa-refresh" style="font-size:36px;color:green" id="reset-refresh"></i></a>
                  </div>
                </div>
            
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Reset Password</button>
            </div>
            </form>
        </div>
        </div>
    </div>

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
        <form action="<?=current_url();?>" method="post">
        <?=csrf_field(); ?>
        <input type="hidden" name="m_id" value="" id="m_id2">
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
                <select name="status" id="m_status" class="form-control">
                  <option value="1">Active</option>
                  <option value="0">Inactive</option>
                  
                </select>
                <span class="text-danger" id="frst_statusErr"></span>
              </div>
          </div>
          <div class="form-group row">
              <label for="comment" class="col-md-2">Comment: </label>
              <div class="col-md-10 ">
                <input type="text" name="comment" id="comment" class="form-control" value="">
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
      function resetpassword(mid){
          if(mid >= 1){
              $('#m_id').val(mid);
              let x = Math.floor((Math.random() * 100000000) + 1);
              $('#resetpassword').val(x);
              $('.resetpassmodal').modal({
                  backdrop: 'static',
                  show: true
              });
          }
      }
      $('#reset-refresh').click(function(){
        $( this ).addClass( 'fa-spin' );
        setTimeout(function(){
          $( '#reset-refresh' ).removeClass( 'fa-spin' );
          let x = Math.floor((Math.random() * 100000000) + 1);
          $('#resetpassword').val(x);
        }, 1000);
      });
      function changeStatus(m_id){
        $("#m_id2").val(m_id);
        $("#changestatusModal").modal("show");
        // alert(m_id);
      }
    </script>
<?=$this->endSection()?>
  