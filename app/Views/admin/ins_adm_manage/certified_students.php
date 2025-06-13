<?=$this->extend("admin/_layout/master") ?>
<?=$this->section("content") ?>
<style>
  
  .loader {
    position: fixed;
    left: 50%;
    top: 50%;
    border: 16px solid #f3f3f3;
    border-radius: 50%;
    border-top: 16px solid blue;
    border-right: 16px solid green;
    border-bottom: 16px solid red;
    width: 120px;
    height: 120px;
    z-index: 9999;
    -webkit-animation: spin 2s linear infinite;
    animation: spin 2s linear infinite;
  }

  @-webkit-keyframes spin {
    0% { -webkit-transform: rotate(0deg); }
    100% { -webkit-transform: rotate(360deg); }
  }

  @keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
  }
</style>
  <!-- Container Fluid-->
  <div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between my-3">
        <h1 class="h3 mb-0 text-gray-800"><?=$page_title.' ('.$count_list.')';?></h1>
        <?php /* <div class="">
        <?php if(is_privilege(29,2)){ ?>
            <a href="<?=base_url('institute/student_cu')?>" class="btn btn-primary">Add Students</a>
        <?php } ?>
        <a href="<?=base_url('institute/admission_cancelation_list')?>" class="btn btn-danger">Admission Cancelation List</a>
        </div> */ ?>
    </div>
    
    <div class="row mb-3">
      <!-- Datatables -->
    <div class="col-lg-12">
      <?php if(session()->getFlashdata('message') !== NULL){
        echo alertBS(session()->getFlashdata('message'),session()->getFlashdata('type'));
      } ?>
      <div class="card mb-1">
        <div class="card-header py-2">
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
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table align-items-center table-flush table-hover" id="dataTableHover">
              <thead class="thead-light">
                <tr>
                    <th>#</th>
                    <th>Photo</th>
                    <th>Reg.No <br>Cert. No.</th>
                    <th>Course Type</th>
                    <th>Student's Name</th>
                    <th>Father's Name</th>
                    <!-- <th>Mobile</th> -->
                    <!-- <th>Batch Name</th> -->
                    <!-- <th>Batch Time</th> -->
                    <th>Course Name</th>
                    <!-- <th>Payment Type</th> -->
                    <!-- <th>Email</th> -->
                    <th>Status</th>
                    <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php if(!empty($student_list)){
                    $insmanagemodel = model('App\Models\InsManage_model', false);
                    $sn=1;
                    foreach($student_list as $list){ 
                    if($list->stu_image != ''){
                        $image = $list->stu_image;
                    }else{
                        $image = 'dummy_stu.jpg';
                    }
                    
                    $course_type = '<span class="badge badge-success ">Regular</span>';
                    if($list->course_type == 'NR'){
                      $course_type = '<span class="badge badge-danger ">Non-Regular</span>';
                    }
                    /*$All_Course_Dtls = $insmanagemodel->get_students_course_list($list->stu_id);
                    $courseArr = (array_column($All_Course_Dtls, 'c_f_name')); */
                    ?>
                    <tr <?=($list->status=='3')?'style="color:red;"':''?>>
                        <td><?=$sn++?></td>
                        <td><img src="<?=base_url('public/assets/upload/images/'.$image) ?>" alt="stu_image" width="60px" height="60px"></td>
                        <td><?=$list->stu_reg_no.'<br>'.$list->cert_no?></td>
                        <td><?=$course_type?></td>
                        <td><?=$list->stu_name ?></td>
                        <td><?=$list->f_name ?></td>
                        <?php /* <td><?=$list->phone1 ?></td>
                        <td><?=strtoupper(implode('<br>', $courseArr)) ?></td> */ ?>
                         <td><?=$list->c_f_name?></td>
                        <td><?=get_student_status($list->status)?></td>
                        <td>
                            
                            <div class="dropdown">
                                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton<?=$sn?>" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Action
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton<?=$sn?>">
                                  <?php if(is_privilege(33,2)){ ?> 
                                  <a class="dropdown-item" href="javascript:void(0)" onclick="view_certificate('<?=$list->cert_no?>')">View Cert</a>
                                  <?php if($list->course_cat == 'C'){ ?>
                                  <a class="dropdown-item" href="javascript:void(0)" onclick="view_marksheet('<?=$list->cert_no?>')">View Marksheet</a>
                                  <?php } }
                                  if(is_privilege(33,3)){ 
                                  if($list->course_cat != 'U'){ ?>
                                  <a class="dropdown-item text-danger" href="<?=base_url('institute/cancel_cert/'.$list->id)?>" onclick="return confirm('Are u sure to cancel certificate?')">Cancel Cert</a>
                                  <?php } }
                                  if($list->course_cat == 'U'){ ?>
                                  <a class="dropdown-item" href="<?=base_url('institute/universityinfo_cu/'.$list->id)?>">Edit University</a>
                                  <?php } ?>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <?php } } else { ?>
                        <tr><td colspan="10" class="text-danger text-center">No Data Available</td></tr>
                    <?php } ?>
                </tbody>
             </table>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!---Container Fluid-->
  <div class="loader" id="loader" style="display:none;"></div>

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

  <div class="modal fade" id="certificateViewModal" tabindex="-1" role="dialog" aria-labelledby="certificateViewModalLabel" aria-hidden="true" >
    <div class="modal-dialog modal-lg" role="document" >
      <div class="modal-content" >
        <div class="modal-header bg-info">
          <h5 class="modal-title text-light" id="certificateViewModalLabel">Certificate</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        
        <div class="modal-body" >
          
          <iframe id="certView" src="" width="780px" style="height:700px" title="Certificate"></iframe>
          
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
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

    $(".Generate_Cert").click(function(){
      if(confirm('Are u sure want to generate certificate?')){
        var url = "<?=base_url('institute/completed_students')?>";
        var id = $(this).attr("data-id");
        // alert(id);
        if(id){
          $.ajax({
            type: "post",
            url: "<?=base_url('institute/generate_certificate');?>",
            data: {id:id},
            dataType: 'json',
            beforeSend: function() {
              // loader open
              $("#loader").show();
            },
            success: function(res){
              console.log(res);
              $("#loader").hide();
              if(res.res != undefined){
                window.location.href = url;
              }
              // $("#franchiseStudentModalBody").html(res);
              // $("#franchiseStudentModal").modal("show");
            }
          });
        }
      }else{
        return false;
      }
    });

    function view_certificate(cert_no){
      certUrl = "<?=base_url('public/assets/pdf')?>"+"/"+cert_no+".pdf";
      //document.getElementById('certView').contentDocument.location.reload(true);
      $("#certView").attr("src", certUrl + "?" + new Date().getTime());
      $("#certificateViewModal").modal("show");
    }
    function view_marksheet(cert_no){
      certUrl = "<?=base_url('public/assets/pdf')?>"+"/"+cert_no+"M.pdf";
      //document.getElementById('certView').contentDocument.location.reload(true);
      $("#certView").attr("src", certUrl + "?" + new Date().getTime());
      $("#certificateViewModal").modal("show");
    }
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
  