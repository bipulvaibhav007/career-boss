<?=$this->extend("admin/_layout/master") ?>
<?=$this->section("content") ?>
  <!-- Container Fluid-->
  <div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-1">
      <h1 class="h3 mb-0 text-gray-800"><?=$blog->blog_title?></h1>
      <?php /* <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?=base_url('admin'); ?>">Admin</a></li>
        <li class="breadcrumb-item active" aria-current="page">blog_faq</li>
      </ol> */ ?>
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
            <?php /*if(is_privilege(8,2)){ ?>
            <a href="<?=base_url('admin/add_edit_blog')?>" class="btn btn-primary">Add Faq</a>
            <?php } */?>
            <a href="<?=base_url('admin/blogs')?>" class="btn btn-warning">Back</a>
          </div>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table align-items-center table-flush table-hover" id="dataTableHover">
              <thead class="thead-light">
                <tr>
                    <th>#</th>
                    <th>Faq Title</th>
                    <th>Faq Description</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                <?php if(!empty($blogFaqs)){
                $sn=1;
                foreach($blogFaqs as $list){ ?>
                <tr>
                    <td><?=$sn++?></td>
                    <td><?=$list->faq_title?></td>
                    <td><?=$list->faq_description?></td>
                    <?php /* <td><?=substr($list->blog_details,0,50).'...'?></td> */ ?>
                    <td><?=($list->status==1)?'<span class="badge badge-success">Active</span>':'<span class="badge badge-warning">InActive</span>'?></td>
                    <td>
                        <a href="<?= base_url('/admin/blog_faq/'.$list->blg_id.'/'.$list->id) ?>" class="btn btn-outline-info"><i class="far fa-edit"></i></a>

                        <a href="<?= base_url('/admin/delete_blog_faq/'.$list->blg_id.'/'.$list->id) ?>" onclick="return confirm('Are you sure?')" class="btn btn-outline-info" style="color:red"><i class="fas fa-trash"></i></a>
                    </td>
                </tr>
                <?php } } else { ?>
                    <tr><td colspan="5">No Data Available</td></tr>
                <?php } ?>
                </tbody>
            </table>
          </div>
        </div>
      </div>

      <div class="card mb-1">
        <div class="card-header py-1">
          <h6 class="m-0 font-weight-bold text-primary"><?=(isset($faq->id))?'Edit':'Add'?> Faq</h6>
        </div>
        <div class="card-body">
            <div class="add-faq">
                <form action="<?=current_url()?>" method="post">
                    <?=csrf_field(); ?>
                    <?=form_hidden('blg_id', $blog->blg_id) ?>
                    <?=form_hidden('type', 'add_faq') ?>
                    <div class="form-group row">
                        <label for="" class="col-md-2">Faq Title</label>
                        <div class="col-md-10">
                            <input type="text" name="faq_title" id="faq_title" class="form-control" value="<?=set_value('faq_title', isset($faq->faq_title)?$faq->faq_title:'')?>">
                            <span class="text-danger"><?= isset($validation) ? display_error($validation, 'faq_title') : '' ?></span>

                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-md-2">Faq Description</label>
                        <div class="col-md-10">
                            <textarea name="faq_description" id="faq_description" class="form-control" rows="4"><?=set_value('faq_description', isset($faq->faq_description)?$faq->faq_description:'')?></textarea>
                            <span class="text-danger"><?= isset($validation) ? display_error($validation, 'faq_description') : '' ?></span>

                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="status" class="col-md-2">Status</label>
                        <div class="col-md-10">
                            <div class="form-check">
                                <label class="form-check-label">
                                <input type="radio" class="form-check-input" name="status" id="status" value="1" checked <?=set_radio('status', 1, (isset($faq->status) && $faq->status == 1)?true:'')?>> Active </label>
                            </div>
                            <div class="form-check">
                                <label class="form-check-label">
                                <input type="radio" class="form-check-input" name="status" id="status0" value="0" <?=set_radio('status', 0, (isset($faq->status) && $faq->status == 0)?true:'')?>> Inactive </label>
                            </div>
                            <span class="text-danger"><?= isset($validation) ? display_error($validation, 'status') : '' ?></span>
                        </div>
                    </div>
                    <div class="float-right">
                        <button type="submit" class="btn btn-<?=(isset($faq->id))?'dark':'primary'?>"><?=(isset($faq->id))?'Update':'Add'?></button>
                        <a href="<?=site_url('admin/blog_faq/'.$blog->blg_id)?>" class="btn btn-warning">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
      </div>

    </div>
  </div>
  <!---Container Fluid-->
<?=$this->endSection()?>
  