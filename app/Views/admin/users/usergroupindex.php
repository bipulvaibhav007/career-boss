<?=$this->extend("admin/_layout/master") ?>
<?=$this->section("content") ?>

<div class="container-fluid" id="container-wrapper">
  <div class="d-sm-flex align-items-center justify-content-between mb-0">
    <h1 class="h3 mb-0 text-gray-800">User Groups</h1>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="<?=base_url('admin'); ?>">Admin</a></li>
      <li class="breadcrumb-item active" aria-current="page">user_groups</li>
    </ol>
  </div>
  <!-- Row -->
  <div class="row">
    <!-- Datatables -->
    <div class="col-lg-12">
        <?php if(session()->getFlashdata('message') !== NULL){
            echo alertBS(session()->getFlashdata('message'),session()->getFlashdata('type'));
        } ?>
      <div class="card mb-4">
        <div class="card-header py-1 d-flex flex-row align-items-center justify-content-between">
          <h6 class="m-0 font-weight-bold text-primary">User Group Index</h6>
          <div class="dropdown no-arrow">
            <?php if(is_privilege(2,2)) { ?>
            <a href="<?= base_url('admin/addgroup') ?>" class="btn btn-primary btn-sm">Add User Group</a>
            <?php } ?>
          </div>
          
        </div>
        <div class="card-body">
          <div class="table-responsive p-0">
            <table class="table align-items-center table-flush table-hover" id="dataTableHover">
              <thead class="thead-light">
                <tr>
                  <th>#</th>
                  <th>Group</th>
                  <th>Status</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
              <?php $n = 1;
              if(count($usersgrouplist) > 0){
                foreach($usersgrouplist as $list){
                  if($list->status == 1)
                    $status = '<span class="badge badge-success">Active</span>';
                  else
                    $status = '<span class="badge badge-warning">Inactive</span>';
                ?>
                <tr>
                  <td><?= $n++ ?></td>
                  <td><?= $list->post_name ?></td>
                  <td><?= $status ?></td>
                  <td>
                    <?php if(is_privilege(2,3)){ ?>
                    <a href="<?= base_url('/admin/editgroup/'.$list->privilege_id) ?>"><i class="fas fa-edit"></i></a>
                    <?php }if(is_privilege(2,4)){ ?>
                    <?php if($list->privilege_id != 1){ ?>
                    <a href="<?= base_url('/admin/deletegroup/'.$list->privilege_id) ?>" onclick="return confirm('Are you sure?');"><i class="fas fa-trash" style="color:red"></i></a>
                    <?php } }?>
                  </td>
                </tr>
                <?php } } ?>
              </tbody>
             </table>
          </div>
        </div>
      </div>
    </div>
   </div>
<?=$this->endSection()?>