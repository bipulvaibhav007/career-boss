<?=$this->extend("admin/_layout/master") ?>
<?=$this->section("content") ?>
  <!-- Container Fluid-->
  <div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-1">
      <h1 class="h3 mb-0 text-gray-800">Subscriber</h1>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?=base_url('admin'); ?>">Admin</a></li>
        <li class="breadcrumb-item active" aria-current="page">subscriber</li>
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
          <h6 class="m-0 font-weight-bold text-primary">Subscriber List</h6>
          <div class="dropdown no-arrow">
            <?php /* if(is_privilege(13,2)){ ?>
            <a href="<?=base_url('admin/experts_cu')?>" class="btn btn-primary">Add Expert</a>
            <?php } */ ?>
          </div>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table align-items-center table-flush table-hover" id="dataTableHover">
              <thead class="thead-light">
                <tr>
                    <th>#</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
              </thead>
                <tbody>
                <?php if(!empty($subscriber)){
                    $sn=1;
                    foreach($subscriber as $list){ 
                    if($list->status == '1'){
                        $status = '<span class="badge badge-success">Active</span>'; 
                    }else{
                        $status = '<span class="badge badge-warning">Inactive</span>';
                    }   
                    ?>
                    <tr>
                        <td><?=$sn++?></td>
                        <td><?=$list->email?></td>
                        <td><?=$status?></td>
                        <td>
                            <?php /* if(is_privilege(13,3)){ ?>
                            <a href="<?= base_url('/admin/experts_cu/'.$list->exp_id) ?>" class="btn btn-outline-info" role="button" title="Edit"><i class="fas fa-edit"></i></a>
                            <?php }if(is_privilege(13,4)){ ?>
                            <a href="<?= base_url('/admin/delete_expert/'.$list->exp_id) ?>" onclick="return confirm('Are you sure?')" class="btn btn-outline-info" role="button" style="color:red" title="Delete"><i class="fas fa-trash"></i></a>
                            <?php } */ ?>
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
  