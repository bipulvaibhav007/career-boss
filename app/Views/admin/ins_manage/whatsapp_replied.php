<?=$this->extend("admin/_layout/master") ?>
<?=$this->section("content") ?>
<?php $adminmodel = model('App\Models\Admin_model', false); ?>
  <!-- Container Fluid-->
  <div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-1">
      <h1 class="h3 mb-0 text-gray-800">WhatsApp Replied Message</h1>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?=base_url('admin'); ?>">Admin</a></li>
        <li class="breadcrumb-item active" aria-current="page">whatsapp_replied</li>
      </ol>
    </div>
    
    <div class="row mb-3">
      <!-- Datatables -->
    <div class="col-lg-12">
      <?php if(session()->getFlashdata('message') !== NULL){
        echo alertBS(session()->getFlashdata('message'),session()->getFlashdata('type'));
      } ?>
      <div class="card mb-1">
        <!-- <div class="card-header py-1 d-flex flex-row align-items-center justify-content-between"> -->
        <div class="card-header py-1">
          <!-- <h6 class="m-0 font-weight-bold text-primary">WhatsApp Replied Message List</h6> -->
          <a href="<?=base_url('admin/whatsapp_replied?status=unread')?>" class="btn btn-outline-primary <?=(isset($_GET['status']) && $_GET['status'] == 'unread')?'active':''?>">Unread</a>
          <a href="<?=base_url('admin/whatsapp_replied?status=read')?>" class="btn btn-outline-primary <?=(isset($_GET['status']) && $_GET['status'] == 'read')?'active':''?>">Read</a>
          <div class="dropdown no-arrow">
          </div>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table align-items-center table-flush table-hover" id="dataTableHover">
              <thead class="thead-light">
                <tr>
                    <th>#</th>
                    <th>Candidate Name</th>
                    <th>Mobile No</th>
                    <th>Read/ Unread</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
              </thead>
                <tbody>
                <?php if(!empty($whatsappReplied)){
                    $sn=1;
                    foreach($whatsappReplied as $list){ 
                    /*if($list->status == '1'){
                        $status = '<span class="badge badge-success">Active</span>'; 
                    }else{
                        $status = '<span class="badge badge-warning">Inactive</span>';
                    } */   
                    ?>
                    <tr>
                        <td><?=$sn++?></td>
                        <td><a href="<?=base_url('admin/enquiry_view/'.$list->enq_id)?>"><?=$list->c_name?></a></td>
                        <td><?=$list->phone1?></td>
                        <td>
                            <?php $countReadMsg = $adminmodel->getCountReadUnreadMessage($list->phone1, 1);
                                $countUnReadMsg = $adminmodel->getCountReadUnreadMessage($list->phone1);
                                echo $countReadMsg.'/ '.$countUnReadMsg;
                            ?>
                        </td>
                        <td>
                            <?php if($countReadMsg < $countUnReadMsg){
                                echo '<span class="badge badge-warning">Unread</span>';
                            }else{
                                echo '<span class="badge badge-success">Read</span>';
                            } ?>
                        </td>
                        <td>
                            <?php if(is_privilege(17,2)){ ?>
                            <a href="<?=base_url('admin/readWhatsAppMessage/'.$list->phone1); ?>" class="btn btn-outline-info btn-sm " role="button" title="Read Message">Read Message</a>
                            <?php } ?>
                            
                            <?php /* <a href="<?= base_url('/admin/delete_expert/'.$list->exp_id) ?>" onclick="return confirm('Are you sure?')" class="btn btn-outline-info" role="button" style="color:red" title="Delete"><i class="fas fa-trash"></i></a> */ ?>
                            
                        </td>
                    </tr>
                    <?php } } else { ?>
                        <tr><td colspan="6">No Data Available</td></tr>
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
  