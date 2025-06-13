<?=$this->extend("admin/_layout/master") ?>
<?=$this->section("content") ?>
  <!-- Container Fluid-->
  <div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-1">
      <h1 class="h3 mb-0 text-gray-800">FAQ</h1>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?=base_url('admin'); ?>">Admin</a></li>
        <li class="breadcrumb-item active" aria-current="page">faq</li>
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
          <h6 class="m-0 font-weight-bold text-primary">Faq List</h6>
          <div class="dropdown no-arrow">
            <?php if(is_privilege(9,2)){ ?>
            <a href="<?=base_url('admin/add_edit_faq')?>" class="btn btn-primary">Add FAQ</a>
            <?php } ?>
          </div>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table align-items-center table-flush table-hover" id="dataTableHover">
              <thead class="thead-light">
                <tr>
                    <th>#</th>
                    <th>Faq Title</th>
                    <th>Description</th>
                    <th>Page for</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
              </thead>
                <tbody>
                <?php if(!empty($faqs)){
                    $sn=1;
                    foreach($faqs as $list){ ?>
                    <tr>
                        <td><?=$sn++?></td>
                        <td><?=$list->faq_title?></td>
                        <td><?=substr($list->faq_description,0,50).'...'?></td>
                        <td><?=$list->page_name?></td>
                        <td><?=($list->faq_status=='1')?'<span class="badge badge-success">Active</span>':'<span class="badge badge-warning">Inactive</span>'?></td>
                        <td>
                            <?php if(is_privilege(9,3)){ ?>
                            <a href="<?= base_url('/admin/add_edit_faq/'.$list->faq_id) ?>" class="btn btn-outline-info" title="Edit"><i class="fas fa-edit"></i></a>
                            <?php } ?>
                            <!--<a href="<?= base_url('/admin/users/view_one/'.$list->faq_id) ?>"><i class="far fa-eye"></i></a>-->
                            <?php if(is_privilege(9,4)){ ?>
                            <a href="<?= base_url('/admin/delete_faq/'.$list->faq_id) ?>" class="btn btn-outline-info" title="Delete" onclick="return confirm('Are you sure?')" style="color:red"><i class="fas fa-trash"></i></a>
                            <?php } ?>
                            
                        </td>
                    </tr>
                    <?php } } else { ?>
                        <tr><td colspan="6" class="text-center">No Data Available</td></tr>
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
  