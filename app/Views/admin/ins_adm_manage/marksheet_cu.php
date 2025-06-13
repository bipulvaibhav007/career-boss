<?=$this->extend("admin/_layout/master") ?>
<?=$this->section("content") ?>

  <!-- Container Fluid-->
  <div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between my-3">
        <h1 class="h3 mb-0 text-gray-800">Marks Details of <?=$courseDtls->stu_name.' ('.$courseDtls->c_f_name.')'?></h1>
        <div class="">
        <?php /* if(is_privilege(29,2)){ ?>
            <a href="<?=base_url('institute/student_cu')?>" class="btn btn-primary">Add Students</a>
        <?php } */ ?>
        <a href="<?=base_url('institute/completed_students')?>" class="btn btn-primary">Back</a>
        </div>
    </div>
    
    <div class="row mb-3">
      <!-- Datatables -->
    <div class="col-lg-12">
      <?php if(session()->getFlashdata('message') !== NULL){
        echo alertBS(session()->getFlashdata('message'),session()->getFlashdata('type'));
      } ?>
      <div class="card mb-1">
        <?php /* <div class="card-header py-2">
            <form action="<?=base_url('institute/completed_students')?>" method="get" id="stusearch">
                <div class="row">
                    <div class="col-md-3">
                        <input type="text" class="form-control" name="s" placeholder="Student Name, Phone, Email" value="<?=(isset($_GET['s']))?$_GET['s']:''; ?>" title="Student Name, Phone, Email">
                    </div>
                    <div class="col-md-3">
                        <select name="batch[]" id="batch_id" class="form-control" multiple>
                        <?php if(!empty($batches)){
                            foreach($batches as $batch){ 
                                $selected = '';
                                if(isset($_GET['batch']) && !empty($_GET['batch']) && in_array($batch->batch_id, $_GET['batch'])){
                                $selected = 'selected';
                                } ?>
                            <option value="<?=$batch->batch_id?>" <?=$selected?>><?=$batch->batch_name?></option>
                        <?php }
                        } ?>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <select name="course[]" id="course_id" class="form-control" multiple>
                        <?php if(!empty($coursess)){
                            foreach($coursess as $list){ 
                                $selected = '';
                                if(isset($_GET['course']) && !empty($_GET['course']) && in_array($list->cid, $_GET['course'])){
                                $selected = 'selected';
                                }?>
                            <option value="<?=$list->cid?>" <?=$selected?>><?=$list->c_f_name?></option>
                        <?php }
                        } ?>
                        </select>
                    </div>
                    <div class="col-md-2 offset-md-1 text-right">
                        <button type="submit" class="btn btn-primary px-4">Filter</button>
                        <a href="<?=base_url('institute/completed_students')?>" class="btn btn-warning">Reset</a>
                    </div>
                </div>
            </form>
        </div> */ ?>
        <div class="card-body">
            <form action="<?=current_url(); ?>" method="post">
            <?=csrf_field(); ?>
            <h3 class="text-danger">I. Marks Details:</h3>
            <div class="table-responsive">
                <table class="table align-items-center table-bordered" id="dataTableHover">
                <thead class="thead-light">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Module Name</th>
                        <?php if($courseDtls->course_cat == 'C'){ ?>
                            <th scope="col">Full Marks</th>
                            <th scope="col">Marks Obtained</th>
                        <?php }else{ ?>
                            <th scope="col">Speed (WPM)</th>
                        <?php } ?>
                    </tr>
                </thead>
                <tbody>
                    <?php if(!empty($modules)){
                        $sn = 1;
                        $moData = [];
                        if(isset($courseDtls) && $courseDtls->module_marks != '') {
                            $moData = json_decode($courseDtls->module_marks);
                        }
                        foreach($modules as $i=>$list){ 
                        $mo = '';
                        if(isset($moData[$i]) && $moData[$i]->id == $list->id){
                            $mo = $moData[$i]->mo;
                        }
                        ?>
                        <tr>
                            <td><?=$sn++?></td>
                            <td><?=$list->module_name?></td>
                            <?php if($courseDtls->course_cat == 'C'){ ?>
                                <td><?=$list->full_marks?></td>
                            <?php } ?>
                            <td>
                                <div class="form-group">
                                    <input type="hidden" name="module_name[<?=$i?>]" value="<?=$list->module_name?>">
                                    <input type="hidden" name="fm[<?=$i?>]" value="<?=$list->full_marks?>">
                                    <input type="hidden" name="id[<?=$i?>]" value="<?=$list->id?>">
                                    <input type="text" name="mo[<?=$i?>]" value="<?=set_value('mo['.$i.']', $mo)?>" id="mo<?=$i?>" class="form-control">
                                </div>
                                <?php if($i < 1){ ?>
                                    <span class="text-danger"><?=(isset($validation))?$validation->getError('mo.'.$i):''?></span>
                                <?php } ?>
                            </td>
                        </tr>
                    <?php }
                    }else{
                        $error = (isset($validation))?$validation->getError('mo.0'):'';
                        echo '<tr ><td colspan="4" class="text-danger text-center">Module not available. Please add the module first.<br>';
                        echo '<a href="'.base_url('admin/modules/'.$courseDtls->course_id).'" class="btn btn-primary">Add Module</a><br>';
                        echo '<span class="text-danger">'.$error.'</span></td></tr>';
                    }

                    ?>
                        
                </tbody>
                
                </table>
            </div>
            <h3 class="text-danger my-4">II. Date:</h3>
            <div class="form-group row">
                <label for="" class="col-md-3">Certificate Issue Date:</label>
                <div class="col-md-3">
                    <input type="date" name="cert_issue_date" value="<?=set_value('cert_issue_date', ($courseDtls->module_marks != '')?date('Y-m-d', strtotime($courseDtls->cert_issue_date)):'')?>" id="cert_issue_date" class="form-control">
                    <span class="text-danger"><?= isset($validation) ? display_error($validation, 'cert_issue_date') : '' ?></span>
                </div>
            </div>
            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-success">Save</button>
            </div>
            </form>
        </div>
      </div>
    </div>
  </div>
  <!---Container Fluid-->

    <!-- Modal -->
    <div class="modal fade" id="changestatusModal" tabindex="-1" role="dialog" aria-labelledby="changestatusModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
            <h5 class="modal-title text-light" id="changestatusModalLabel">Change Status</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <form action="<?=current_url();?>" method="post" >
            <?=csrf_field(); ?>
            <input type="hidden" name="ids" value="" id="ids">
            <input type="hidden" name="submit" value="changeStatus" id="changeStatus">
            <div class="modal-body">
            <!-- <div class="form-group row">
                <label for="stu_name" class="col-md-2">Name: </label>
                <div class="col-md-10">
                    <p><strong id="stu_name"></strong></p>
                </div>
            </div> -->
            <div class="form-group row">
                <label for="status" class="col-md-2">Status: </label>
                <div class="col-md-10 ">
                    <select name="status" id="status" class="form-control">
                    <option value="1" >Active</option>
                    <option value="0">Inactive</option>
                    </select>
                    <span class="text-danger" id="frst_statusErr"></span>
                </div>
            </div>
            <?php /* <div class="form-group row">
                <label for="stu_name" class="col-md-2">Description: </label>
                <div class="col-md-10 ">
                    <input type="text" name="description" id="description" class="form-control" value="">
                </div>
            </div> */ ?>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Submit</button>
            </div>
            </form>
        </div>
        </div>
    </div>

<script>
    $(document).ready(function() {
        $('#batch_id').multiselect({		
        nonSelectedText: 'Select Batch',
        enableFiltering: true,
        enableCaseInsensitiveFiltering: true,
        includeSelectAllOption: true,
        buttonWidth: '100%',
        maxWidth: 650,
        maxHeight: 350,				
        });
        $('#course_id').multiselect({		
        nonSelectedText: 'Select Course',
        enableFiltering: true,
        enableCaseInsensitiveFiltering: true,
        includeSelectAllOption: true,
        buttonWidth: '100%',
        maxWidth: 650,
        maxHeight: 350,				
        });
    });
</script>
<?php /* 
  <script>
    $("#CheckAll").click(function() {
      $("input:checkbox[name='checkedIds[]']").prop("checked", $(this).prop("checked"));
      disable_enable_btn();
    });

    $("input:checkbox[name='checkedIds[]']").click(function() {
      if (!$(this).prop("checked")) {
        $("#CheckAll").prop("checked", false);
      }
      disable_enable_btn();
    });
    function disable_enable_btn(){
      var checked = $('input[name="checkedIds[]"]:checked').length;
      if(checked >= 1){
        $('#Change_Status').removeAttr('disabled');
      }else{
        $('#Change_Status').attr('disabled', true);
      }
    }
    $("#Change_Status").click(function () {
      var checkedIds = [];
      $('input[name="checkedIds[]"]:checked').each(function (){
        checkedIds.push($(this).val());
      });
      $("#ids").val(checkedIds);

      $("#changestatusModal").modal("show");
    });
  </script> 
  */ ?>
<?=$this->endSection()?>
  