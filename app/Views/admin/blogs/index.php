<?=$this->extend("admin/_layout/master") ?>
<?=$this->section("content") ?>
  <!-- Container Fluid-->
  <div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-1">
      <h1 class="h3 mb-0 text-gray-800">Blogs</h1>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?=base_url('admin'); ?>">Admin</a></li>
        <li class="breadcrumb-item active" aria-current="page">blogs</li>
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
          <h6 class="m-0 font-weight-bold text-primary">Blogs List</h6>
          <div class="dropdown no-arrow">
            <?php if(is_privilege(8,2)){ ?>
            <a href="<?=base_url('admin/add_edit_blog')?>" class="btn btn-primary">Add Blog</a>
            <?php } ?>
          </div>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table align-items-center table-flush table-hover" id="dataTableHover">
              <thead class="thead-light">
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Url</th>
                    <!-- <th>Description</th> -->
                    <th>Image</th>
                    <th>Status</th>
                    <th>Total Faq</th>
                    <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                $adminmodel = model('App\Models\Admin_model', false);

                if(!empty($blogs)){
                $sn=1;
                foreach($blogs as $list){ ?>
                <tr>
                    <td><?=$sn++?></td>
                    <td><?=$list->blog_title?></td>
                    <td><?=$list->blog_url?></td>
                    <?php /* <td><?=substr($list->blog_details,0,50).'...'?></td> */ ?>
                    <td><img alt="image" width="150px" height="70px" src="<?=($list->blog_image != '')?base_url('public/assets/upload/images/'.$list->blog_image):base_url('public/assets/upload/images/dummy2.png')?>" />
                    </td>
                    <td><?=($list->blog_status=='1')?'<span class="badge badge-success">Active</span>':'<span class="badge badge-warning">InActive</span>'?></td>
                    <td>
                      <?php $totalFaq = $adminmodel->get_total_blog_faq($list->blg_id); 
                      echo $totalFaq;?>
                    </td>
                    <td>
                        <?php if(is_privilege(8,3)){ ?>
                        <a href="<?= base_url('/admin/add_edit_blog/'.$list->blg_id) ?>" class="btn btn-outline-info"><i class="far fa-edit"></i></a>
                        <?php } ?>

                        <a href="<?= base_url('/admin/blog_faq/'.$list->blg_id) ?>" class="btn btn-primary btn-sm py-2">Faqs</a>

                        <?php if(is_privilege(8,4)){ ?>
                        <a href="<?= base_url('/admin/delete_blog/'.$list->blg_id) ?>" onclick="return confirm('Are you sure?')" class="btn btn-outline-info" style="color:red"><i class="fas fa-trash"></i></a>
                        <?php } ?>
                    </td>
                </tr>
                <?php } } else { ?>
                    <tr><td colspan="7">No Data Available</td></tr>
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
  