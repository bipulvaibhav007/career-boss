<?=$this->extend("admin/_layout/master") ?>
<?=$this->section("content") ?>
  <!-- Container Fluid-->
  <div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-1">
      <h1 class="h3 mb-0 text-gray-800">Banners</h1>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?=base_url('admin'); ?>">Admin</a></li>
        <li class="breadcrumb-item active" aria-current="page">banner</li>
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
          <h6 class="m-0 font-weight-bold text-primary">Banner List</h6>
          <div class="dropdown no-arrow">
            <?php if(is_privilege(11,2)){ ?>
            <a href="<?=base_url('admin/add_edit_banner')?>" class="btn btn-primary">Add Banner</a>
            <?php } ?>
          </div>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table align-items-center table-flush table-hover" id="dataTableHover">
              <thead class="thead-light">
                <tr>
                    <th>#</th>
                    <th>Banner Main Title</th>
                    <th>Banner Sub Title</th>
                    <th>Page For</th>
                    <th>Url</th>
                    <th>Brochure</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
              </thead>
                <tbody>
                <?php if(!empty($banner)){
                    $sn=1;
                    foreach($banner as $list){ ?>
                    <tr>
                        <td><?=$sn++?></td>
                        <td><?=$list->main_title?></td>
                        <td><?=$list->sub_title?></td>
                        <td><?=$list->page_name?></td>
                        <td><?=$list->url?></td>
                        <td>
                            <img alt="image" src="<?=($list->brochure != '')?base_url('public/assets/upload/images/'.$list->brochure):base_url('public/assets/upload/images/dummy.png')?>" weight="100px" height="80"/>
                        </td>
                        <td><?=($list->status=='1')?'<span class="badge badge-success">Active</span>':'<span class="badge badge-warning">InActive</span>'?></td>
                        <td>
                            <?php if(is_privilege(11,3)){ ?>
                            <a href="<?= base_url('/admin/add_edit_banner/'.$list->id) ?>" class="btn btn-outline-info"><i class="far fa-edit"></i></a>
                            <?php } ?>
                            <!--<a href="<?= base_url('/admin/users/view_one/'.$list->id) ?>"><i class="far fa-eye"></i></a>-->
                            <?php if(is_privilege(11,4)){ ?>
                            <a href="<?= base_url('/admin/delete_banner/'.$list->id) ?>" onclick="return confirm('Are you sure?')" class="btn btn-outline-info" style="color:red"><i class="fas fa-trash"></i></a>
                            <?php } ?>
                            
                        </td>
                    </tr>
                    <?php } } else { ?>
                        <tr><td colspan="8" class="text-center text-danger">No Data Available</td></tr>
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
  