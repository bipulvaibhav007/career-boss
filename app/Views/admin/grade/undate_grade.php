<?=$this->extend("admin/_layout/master") ?>
<?=$this->section("content") ?>
<div class="container-fluid" id="container-wrapper">
  <div class="d-sm-flex align-items-center justify-content-between mb-1">
    <h1 class="h3 mb-0 text-gray-800">Grade</h1>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="<?=base_url('admin'); ?>">Admin</a></li>
      <li class="breadcrumb-item" aria-current="page">update_grade</li>
      <!--<li class="breadcrumb-item active" aria-current="page">Blank Page</li>-->
    </ol>
  </div>
  <div class="row">
    <div class="col-lg-12">
      <!-- Form Basic -->
      <div class="card mb-4">
        <div class="card-header py-1 d-flex flex-row align-items-center justify-content-between">
          <h6 class="m-0 font-weight-bold text-primary">Update Grade</h6>
            
        </div>
        <?php if(session()->getFlashdata('message') !== NULL){
            echo alertBS(session()->getFlashdata('message'),session()->getFlashdata('type'));
        } ?>
        <div class="card-body">
       
          <form autocomplete="off" action="<?=current_url(); ?>" method="post" enctype="multipart/form-data">
            <?= csrf_field(); ?>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Marks From</th>
                        <th scope="col">Marks To</th>
                        <th scope="col">Grade</th>
                        <th scope="col">Remarks</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(!empty($grades)){ $sn = 1;
                        foreach($grades as $k=>$list){ 
                            echo form_hidden('id[]', $list->id);
                            ?>
                            <tr>
                                <td><?=$sn++;?></td>
                                <td>
                                    <input type="text" name="marks_from[]" id="marks_from<?=$k?>" class="form-control" value="<?=$list->marks_from;?>"></td>
                                <td>
                                    <input type="text" name="marks_to[]" id="marks_to<?=$k?>" class="form-control" value="<?=$list->marks_to;?>"></td>
                                <td>
                                    <input type="text" name="grade[]" id="grade<?=$k?>" class="form-control" value="<?=$list->grade;?>"></td>
                                <td>
                                    <input type="text" name="remarks[]" id="remarks<?=$k?>" class="form-control" value="<?=$list->remarks;?>"></td>
                            </tr>

                    <?php }
                    } ?>
                    
                </tbody>
            </table>
            
            <?php /* 
            <div class="form-group row">
              <label for="status" class="col-md-2">Status<span class="text-danger">*</span></label>
              <div class="col-sm-10">
                <div class="custom-control custom-radio">
                  <input type="radio" id="status" name="status" value="1" class="custom-control-input" <?=set_radio('status', 1, ($memberDtls->status == 1)?TRUE:'')?>>
                  <label class="custom-control-label" for="status">Active</label>
                </div>
                <div class="custom-control custom-radio">
                  <input type="radio" id="status2" name="status" value="0" class="custom-control-input" <?=set_radio('status', 0, ($memberDtls->status < 1)?TRUE:'')?>>
                  <label class="custom-control-label" for="status2">Inactive</label>
                </div>
                <span class="text-danger"><?= isset($validation) ? display_error($validation, 'status') : '' ?></span>  
              </div>
            </div> */ ?>
            <?php if(is_privilege(24,2)){ ?>
            <button type="submit" class="btn btn-primary">Update</button>
            <?php } ?>
            <!-- <button type="reset" class="btn btn-info">Reset</button> -->
            <a href="<?=base_url('/admin')?>" class="btn btn-warning">Cancel</a>
          </form>
        </div>
      </div><!-- end card -->
    </div><!-- end column -->
  </div><!-- end row -->

    
<?=$this->endSection()?>