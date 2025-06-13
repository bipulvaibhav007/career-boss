<?=$this->extend("admin/_layout/master") ?>
<?=$this->section("content") ?>
  <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.3/themes/base/jquery-ui.css">
  <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
  <script src="https://code.jquery.com/ui/1.13.3/jquery-ui.js"></script> 
<div class="container-fluid" id="container-wrapper">
  <div class="d-sm-flex align-items-center justify-content-between mb-1">
    <h1 class="h3 mb-0 text-gray-800">Update University Info (<strong><?=$student->stu_name?></strong>)</h1>
    <?php $backURL = base_url('institute/completed_students');
    if(isset($_SERVER['HTTP_REFERER'])) {
      $backURL = $_SERVER['HTTP_REFERER'];
    } ?>
    <a href="<?=$backURL?>" class="btn btn-primary">Back</a>
  </div>
  <?php if(session()->getFlashdata('message') !== NULL){
      echo alertBS(session()->getFlashdata('message'),session()->getFlashdata('type'));
  } ?>
  <div class="row">
    <div class="col-lg-12">
      <!-- Form Basic -->
      <div class="card mb-4">
        <div class="card-header py-1 d-flex flex-row align-items-center justify-content-between">
          <!-- <h6 class="m-0 font-weight-bold text-primary">Edit Franchise</h6> -->
          <p class="text-danger">*Fields are mandatory.</p>
            
        </div>
        <div class="card-body">
            <div class="form-group row">
              <div class="col-md-6 my-1">
                <label class="mb-2">Student's Name: </label>
                <span><strong><?=ucwords($student->stu_name)?></strong></span>
                <?php /* <input class="form-control" type="text" name="frstu_name" id="frstu_name" value="<?=set_value('frstu_name', (isset($student))?$student->frstu_name:''); ?>">
                <span class="text-danger"><?=(isset($validation))?$validation->getError('frstu_name'):''?></span> */ ?>
              </div>
              <div class="col-md-6 my-1">
                <label class="mb-2">Photo:</label>
                <img src="<?=base_url('public/assets/upload/images/'.$student->stu_image)?>" alt="student image" width="70px" height="60px">
               </div>
            </div>
            <hr style="border-color: red; border-width: 2px; border-style: dashed;">
            <!-- <p class="mt-2 text-primary">Before Completion:</p> -->
            <form autocomplete="off" action="<?=current_url(); ?>" method="post" enctype="multipart/form-data">
            <?= csrf_field(); ?>
            <div class="form-group row">
              <div class="col-md-6 my-1">
                <label class="mb-2">University Name:<span class="text-danger">*</span></label>
                <input  class="form-control" type="text" name="u_name" id="u_name" value="<?=set_value('u_name', (isset($uniDtls))?$uniDtls->u_name:''); ?>">
                <span class="text-danger"><?=(isset($validation))?$validation->getError('u_name'):''?></span>
              </div>
              <div class="col-md-6 my-1">
                <label class="mb-2">Session</label>
                <input  class="form-control" type="text" name="session" id="session" value="<?=set_value('session', (isset($uniDtls))?$uniDtls->session:''); ?>">
              </div>
              <div class="col-md-6 my-1">
                <label class="mb-2">University Reg No:<span class="text-danger">*</span></label>
                <input  class="form-control" type="text" name="u_regno" id="u_regno" value="<?=set_value('u_regno', (isset($uniDtls))?$uniDtls->u_regno:''); ?>">
                <span class="text-danger"><?=(isset($validation))?$validation->getError('u_regno'):''?></span>
              </div>
              
              <div class="col-md-6 my-1">
                <label class="mb-2">University Roll No:<span class="text-danger">*</span></label>
                <input  class="form-control" type="text" name="u_rollno" id="u_rollno" value="<?=set_value('u_rollno', (isset($uniDtls))?$uniDtls->u_rollno:''); ?>">
                <span class="text-danger"><?=(isset($validation))?$validation->getError('u_rollno'):''?></span>
              </div>
              <div class="col-md-6 my-1">
                <label class="mb-2">Certificate No:<span class="text-danger">*</span></label>
                <input  class="form-control" type="text" name="cert_no" id="cert_no" value="<?=set_value('cert_no', (isset($uniDtls))?$uniDtls->cert_no:''); ?>">
                <span class="text-danger"><?=(isset($validation))?$validation->getError('cert_no'):''?></span>
              </div>
              <div class="col-md-6 my-1">
                <label class="mb-2">Upload University Certificate Copy (combind):</label>
                <input  class="form-control" type="file" name="uni_doc" id="uni_doc" >
                <?php $warning = 'File Not Yet upload!';
                if(isset($uniDtls) && $uniDtls->uni_doc != ''){
                  $warning = '<a href="javascript:void(0)" onclick="view_certificate(\'$list->cert_no\')">View</a>';
                }?>
                <span class="text-danger"><?=(isset($validation))?$validation->getError('uni_doc'):$warning?></span>
              </div>
              <div class="col-md-6 my-1">
                <label class="mb-2">Certificate Issue Date(On university cert):<span class="text-danger">*</span></label>
                <input class="form-control" type="date" name="cert_issue_date" id="cert_issue_date" value="<?=set_value('cert_issue_date',(isset($student->cert_issue_date) && $student->cert_issue_date != '0000-00-00')?date('Y-m-d',strtotime($student->cert_issue_date)):'')?>">
                <span class="text-danger"><?=(isset($validation))?$validation->getError('cert_issue_date'):''?></span>

              </div>
              <div class="col-md-6 my-1">
                <label class="mb-2">Status<span class="text-danger">*</span></label>
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="status" id="status4" value="4" <?=($student->status == 4)?'checked':''?>>
                  <label class="form-check-label" for="status4">
                    Certificate Issued
                  </label>
                </div>
                <span class="text-danger"><?=(isset($validation))?$validation->getError('status'):''?></span>
              </div>

              <div class="col-md-6 my-2">
                <button type="submit" class="btn btn-primary">Submit</button>
                <button type="reset" class="btn btn-info">Reset</button>
                <a href="<?=$backURL?>" class="btn btn-warning">Cancel</a>
              </div>
            </div>
            </form>
      </div><!-- end card -->
    </div><!-- end column -->
  </div><!-- end row -->

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

  <script type="text/javascript">
    function view_certificate(cert_no){
      certUrl = "<?=base_url('public/assets/pdf')?>"+"/"+cert_no+".pdf";
      //document.getElementById('certView').contentDocument.location.reload(true);
      $("#certView").attr("src", certUrl + "?" + new Date().getTime());
      $("#certificateViewModal").modal("show");
    }
    $( function() {
        $("#adm_date").datepicker(
            {dateFormat: 'dd-mm-yy'}
        );
    });
    /*function get_districs(){
        var stateId = $("#state").val();
        if(stateId){
            $.ajax({
                type: 'post',
                url: "<?=base_url('/get_districts')?>",
                data: {stateId : stateId},
                success: function(res){
                    console.log(res);
                    $("#district").html(res);
                }
            });
        }
    }
    function fill_course_duration(){
        var course_duration = $("#frcourse_id :selected").data("course_duration");
        var cid = $("#frcourse_id :selected").val();
        if(cid){
            $.ajax({
                type: 'post',
                url: "<?=base_url('/get_module_html')?>",
                data: {cid : cid},
                success: function(res){
                    console.log(res);
                    $("#modules").show();
                    $("#modules").html(res);
                    
                }
            });
        }
        $("#course_duration").val(course_duration);
    }*/
    
  </script>

    
<?=$this->endSection()?>