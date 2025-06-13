<?=$this->extend("admin/_layout/master") ?>
<?=$this->section("content") ?>
  <!-- Container Fluid-->
  <div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-1">
      <h1 class="h3 mb-0 text-gray-800">Testimonial</h1>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?=base_url('admin'); ?>">Admin</a></li>
        <li class="breadcrumb-item active" aria-current="page">testimonial</li>
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
          <h6 class="m-0 font-weight-bold text-primary">Testimonial List</h6>
          <div class="dropdown no-arrow">
            <?php if(is_privilege(10,2)){ ?>
            <a href="<?=base_url('admin/add_edit_testimonial')?>" class="btn btn-primary">Add Testimonial</a>
            <?php } ?>
          </div>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table align-items-center table-flush table-hover" id="dataTableHover">
              <thead class="thead-light">
                <tr>
                    <th>#</th>
                    <th>Type</th>
                    <th>image</th>
                    <th>Description/Video Link</th>
                    <th>Name</th>
                    <th>Post</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                <?php if(!empty($testimonial)){
                    $sn=1;
                    foreach($testimonial as $list){ ?>
                    <tr>
                        <td><?=$sn++?></td>
                        <td><?=($list->type == 'stu')?'<span class="text-primary">Student Stories</span>':'<span class="text-success">Success Stories</span>'?></td>
                        <td>
                            <img alt="image" src="<?=($list->logo != '')?base_url('public/assets/upload/images/'.$list->logo):base_url('public/assets/upload/images/dummy2.png')?>" weight="70px" height="50"/>
                        </td>
                        <td><?=($list->type == 'suc')?substr(strip_tags($list->description),0,50).'...':$list->youtube_vlink;?></td>
                        <td><?=$list->name?></td>
                        <td><?=$list->post?></td>
                        <td><?=($list->status=='1')?'<span class="badge badge-success">Active</span>':'<span class="badge badge-warning">InActive</span>'?></td>
                        <td>
                            <?php if(is_privilege(10,3)){ ?>
                            <a href="<?= base_url('/admin/add_edit_testimonial/'.$list->id) ?>" class="btn btn-outline-info"><i class="far fa-edit"></i></a>
                            <?php } ?>
                            <!--<a href="<?= base_url('/admin/users/view_one/'.$list->id) ?>"><i class="far fa-eye"></i></a>-->
                            <?php if(is_privilege(10,4)){ ?>
                            <a href="<?= base_url('/admin/delete_testimonial/'.$list->id) ?>" onclick="return confirm('Are you sure?')"  class="btn btn-outline-info" style="color:red"><i class="fas fa-trash"></i></a>
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
  