<?=$this->extend("admin/_layout/master") ?>
<?=$this->section("content") ?>
  <!-- Container Fluid-->
  <div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-1">
      <h1 class="h3 mb-0 text-gray-800">Referral</h1>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?=base_url('admin'); ?>">Admin</a></li>
        <li class="breadcrumb-item active" aria-current="page">referral</li>
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
          <h6 class="m-0 font-weight-bold text-primary">Referral List</h6>
          <div class="dropdown no-arrow">
            <?php /*if(is_privilege(12,2)){ ?>
            <a href="<?=base_url('admin/add_edit_course')?>" class="btn btn-primary">Add Course</a>
            <?php } */?>
          </div>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table align-items-center table-flush table-hover" id="dataTableHover">
              <thead class="thead-light">
                <tr>
                    <th>#</th>
                    <th>Member Name</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>Students<br>New/Total</th>
                    <th>Total Earn</th>
                    <th>Total Credit</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
              </thead>
                <tbody>
                <?php 
                  $adminmodel = model('App\Models\Admin_model', false);
                  if(!empty($referral)){
                    $sn=1;
                    foreach($referral as $list){ 
                    if($list->status == 1){
                        $status = '<span class="badge badge-success">Active</span>'; 
                    }else{
                        $status = '<span class="badge badge-warning">Inactive</span>';
                    } 
                    $t_stu = $adminmodel->getCountReferralStudentByRefId($list->m_id);
                    $new_stu = $adminmodel->getCountReferralStudentByRefId($list->m_id, ['status'=>1]);
                    ?>
                    <tr>
                        <td><?=$sn++?></td>
                        
                        <td><a href="<?=base_url('/admin/referral_view/'.$list->m_id)?>"><?=$list->m_full_name?></a></td>
                        <td><?php echo $list->phone?></td>
                        <?php /* <td>
                            <img class="img-thumbnail" src="<?=base_url('public/assets/upload/images/'.$list->image) ?>" width="70px" height="70px"/>
                        </td> */ ?>
                        <td><?=$list->address?></td>
                        <td><?=$new_stu.'/'.$t_stu?></td>
                        <td><?=$list->earn_amount?></td>
                        <td><?=$list->credit_amount?></td>
                        
                        <td><?=$status?></td>
                        <td>
                            <?php if(is_privilege(18,2)){ ?>
                            <a href="<?= base_url('/admin/referral_view/'.$list->m_id) ?>" class="btn btn-outline-info" role="button" title="View"><i class="fas fa-eye"></i></a>
                            <?php }if(is_privilege(18,3)){ ?>
                            <a href="<?= base_url('/admin/delete_referral/'.$list->m_id) ?>" onclick="return confirm('Are you sure?')" class="btn btn-outline-info" role="button" style="color:red" title="Delete"><i class="fas fa-trash"></i></a>
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
<?=$this->endSection()?>
  